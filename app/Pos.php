<?php

namespace App;

use App\Payment;
use App\PosItem;
use App\Customer;
use App\Services\TransactionService;
use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    protected $guarded = [];

    /**
     * Relations
     */
    public function payments()
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }

    public function items()
    {
        return $this->hasMany(PosItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    public function returns()
    {
        return $this->hasMany(OrderReturn::class);
    }


    public function sales_man()
    {
        return $this->belongsTo(User::class, 'sale_by');
    }

    public function transaction()
    {
        return $this->morphOne(Transaction::class, 'transactable');
    }
    // CUSTOM METHODS

    // ****************CUSTOM  CALCULATIONS & REPORT *****************************
    public function previous_returned_product_value()
    {
        return $this->returns->sum('return_product_value');
    }

    public function return_payable()
    {
        return $this->returns->sum('return_product_value');
    }

    public function previous_returnable()
    {
        return $this->returns->sum('return_product_value');
    }


    public function profit()
    {
        // dd($this->returns->count());
        if ($this->returns->count() == 0) {

            return [
                'sell_value' => $this->receivable,
                'purchase_cost' => 0,
                'profit' => $this->receivable - $this->total_purchase_cost
            ];
        } else {
            // dd("HAS RETURNS");
            $total_sell_value = 0;
            $total_purchase_cost = 0;
            foreach ($this->items as $item) {
                if ($item->remaining_quantity() > 0) {
                    // find sell value
                    // sell stock
                    // foreach ($item->stock as $stock) {
                    //     info($stock->remaining());
                    //     if ($stock->remaining() > 0) {
                    //         // sell value purchase value
                    //         $total_sell_value += $stock->product->quantity_worth($stock->remaining(),$item->rate) ;
                    //         // $total_purchase_cost += $stock->product->quantity_worth($stock->remaining(), $stock->purchase_item->rate);
                    //     }
                    // }
                    // find purchase cost
                    $total_sell_value += $item->remaining_quantity() * $item->rate;
                }
            }

            $discounted_sell_value = 0;

            if ($total_sell_value > 0) {
                // Sell value considering profit
                if (strpos($this->discount, '%') !== false) {
                    $discount = (float) str_replace("%", " ", $this->discount);

                    $discount_amount = $total_sell_value * ($discount / 100);

                    $discounted_sell_value = $total_sell_value - $discount_amount;
                } else {
                    $discounted_sell_value = $total_sell_value - $this->discount;
                }
            }
            // else {
            //     return 0;
            // }

            // dd($discounted_sell_value);
            // dd($total_purchase_cost);
            return [
                'sell_value' => $discounted_sell_value,
                'purchase_cost' => 0,
                'profit' => $discounted_sell_value - $total_purchase_cost
            ];
            // return $discounted_sell_value - $total_purchase_cost;
        }

        // if no return
        // sell_amount-purchase

        // if return
        // get purchase cost - of remaining products
        // get sell value of remaining products ->considering discount

        // then sell value- purchase cost

    }

    public function update_total_returned()
    {
        $total = 0;
        if ($this->returns->count() > 0) {
            $total = $this->returns()->sum('return_product_value');

        }
        $this->update([
            'returned' => $total
        ]);
    }


    public function update_paid()
    {
        $this->update([
            'paid' => $this->payments()->sum('pay_amount')
        ]);
    }

    public function update_calculated_data()
    {
        // dd("HERE");
        // update_total_returned
        $this->update_total_returned();
        // update paid
        $this->update_paid();

        $details = $this->profit();
        $this->update([
            'final_receivable' => $details['sell_value'],
        ]);


        $due = $this->receivable - $this->paid - $this->returned;

        // update_due
        $this->update([
            'due' => $due
        ]);

        if ($this->customer) {
            $this->customer->update_calculated_data();
        }
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($pos) {
            TransactionService::create_pos_transaction($pos);
        });

        static::updated(function ($pos) {
            // TransactionService::update_pos_transaction($pos); 
            // ** Moving To controller -> this is being called every time a payment is made
            //which is not good for performance
        });



        // static::deleting(function ($pos) {
        //     // dd($pos->returns);

        //     // }
        // });

        static::deleting(function ($pos) {
            foreach ($pos->items as $item) {
                $item->delete();
            }

            foreach ($pos->returns as $item) {
                // dd($item);
                $item->delete();
            }

            foreach ($pos->payments as $payment) {
                $payment->delete();
            }
        });

        static::deleted(function ($pos) {
            if ($pos->transaction) {
                $pos->transaction->delete();
            }

            if ($pos->customer) {
                $pos->customer->update_calculated_data();
            }
        });
    }


    // *********OLD CODE**********


    public function totalProductCosts($start = false, $end = false)
    {
        $productCosts = 0;

        if ($start != false && $end != false) {
            $pos = Pos::whereBetween('sale_date', [$start, $end])->get('id');
        } else {
            $pos = Pos::get('id');
        }

        foreach ($pos as $po) {
            foreach ($po->items as $posItem) {
                $productCosts += $posItem->product->cost * $posItem->qty;
            }
        }

        return $productCosts;
    }





    public function todayReceive()
    {
        $today = date('Y-m-d');
        $posList = Pos::where('sale_date', $today)->get();
        $totalCash = 0;
        foreach ($posList as $pos) {
            $totalCash += $pos->payments->sum('pay_amount');
        }
        return $totalCash;
    }

    public function totalCash()
    {
        $posList = Pos::all();
        $totalCash = 0;
        foreach ($posList as $pos) {
            $totalCash += $pos->payments->sum('pay_amount');
        }
        return $totalCash;
    }

    // public function todaySale()
    // {
    //     return Pos::where('sale_date', date('Y-m-d'))->get();
    // }

    public function totalSaleAmount($start = false, $end = false)
    {
        return $this->totalSale($start, $end)->sum('receivable');
    }

    function daily_total_receivable()
    {
        return Pos::where('sale_date', date('Y-m-d'))->sum('receivable');
    }

    public function filter($request, $sales)
    {
        if ($request->start_date) {
            $sales = $sales->whereDate('sale_date', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $sales = $sales->whereDate('sale_date', '<=', $request->end_date);
        }

        if ($request->customer) {
            $sales = $sales->where('customer_id', $request->customer);
        }

        if ($request->bill_no) {
            $sales = $sales->where('id', $request->bill_no);
        }

        if ($request->product_id) {
            $sales = $sales->whereHas('items', function ($items) use ($request) {
                $items->where('product_id', $request->product_id);
            });
        }

        return $sales;
    }

    //total sale quantity of a product in today 
    
    // public function courier()
    // {
    //     return $this->belongsTo(Courier::class);
    // }

    public function delivery_method()
    {
        return $this->belongsTo(DeliveryMethod::class);
    }



}