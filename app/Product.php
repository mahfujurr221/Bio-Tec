<?php

namespace App;

use App\Brand;
use App\Image;
use App\PosItem;
use App\Category;
use App\PurchaseItem;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function sale()
    {
        return $this->hasMany(PosItem::class);
    }

    public function purchase()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    public function main_unit()
    {
        return $this->belongsTo(Unit::class, 'main_unit_id');
    }

    public function sub_unit()
    {
        return $this->belongsTo(Unit::class, 'sub_unit_id');
    }

    // CUSTOM

    public function average_cost()
    {
        $items = PurchaseItem::where('product_id', $this->id);

        $number = $items->count();
        // dd($number);
        $total_cost = $items->sum('rate');

        if ($this->opening_stock != 0 && $this->opening_stock != null) {
            $total_cost += $this->cost;
            ++$number;
        }

        $average = 0;
        if ($number != 0) {
            $average = $total_cost / $number;
        }

        if ($average == 0) {
            return $this->cost;
        }

        return $total_cost / $number;
    }



    public function sell_count($warehouse_id)
    {
        if (auth()->user()->hasRole('WarehouseAdmin')) {
            return PosItem::where('product_id', $this->id)->whereHas('pos', function ($pos) use ($warehouse_id) {
                $pos->where('warehouse_id', auth()->user()->warehouse_id);
            })->sum('qty');
        } else {
            return PosItem::where('product_id', $this->id)->sum('qty');
        }


    }


    public function purchase_count($warehouse_id)
    {
        // if (auth()->user()->hasRole('WarehouseAdmin')) {
        //     return PurchaseItem::where('product_id', $this->id)->whereHas('purchase', function ($purchase) use ($warehouse_id) {
        //         $purchase->where('warehouse_id', auth()->user()->warehouse_id);
        //     })->sum('qty');
        // } else {
        //     return PurchaseItem::where('product_id', $this->id)->sum('qty');
        // }
        return PurchaseItem::where('product_id', $this->id)->sum('qty');
    }

    public function damage_count($warehouse_id)
    {
        return Damage::where('product_id', $this->id)->where('warehouse_id', $warehouse_id)->sum('qty');
    }

    public function return_count($warehouse_id)
    {
        return ReturnItem::where('product_id', $this->id)->whereHas('return', function ($return) use ($warehouse_id) {
            $return->whereHas('pos', function ($pos) use ($warehouse_id) {
                $pos->where('warehouse_id', $warehouse_id);
            });
        })->sum('qty');
    }

    public function transferred_in($warehouse_id)
    {
        if (auth()->user()->hasRole('WarehouseAdmin')) {
            return StockTransfer::where('product_id', $this->id)->where('to_warehouse', $warehouse_id)->sum('qty');
        } else {
            return StockTransfer::where('product_id', $this->id)->where('to_warehouse', $warehouse_id)->sum('qty');
        }
    }

    public function transferred_out()
    {
        if (auth()->user()->hasRole('WarehouseAdmin')) {
            return StockTransfer::where('product_id', $this->id)->where('to_warehouse', auth()->user()->warehouse_id)->sum('qty');
        } else {
            return StockTransfer::where('product_id', $this->id)->sum('qty');
        }
    }


    public function stock($warehouse_id = null)
    {
        if (!$warehouse_id) {
            $warehouse_id = 1;
        }
        $stock = 0;
        if ($warehouse_id == 1) {
            $stock += $this->purchase_count($warehouse_id);
            $stock -= $this->transferred_out();
        }
        // all added stock will be added to the main warehouse
        //other warehouse gets stock from transferred stock

        // $stock = 0;\
        $stock += $this->transferred_in($warehouse_id);
        $stock -= $this->sell_count($warehouse_id);
        // Return Count

        // Damage Count
        $stock -= $this->damage_count($warehouse_id);

        // return
        $stock += $this->return_count($warehouse_id);

        // dd($stock);

        return $stock > 0 ? $stock : 0;
    }


    public function separate_main_sub_qty($quantity)
    {
        $main_unit = $this->main_unit;

        $main_qty = 0;
        $main_qty_as_sub = 0;
        $sub_qty = 0;


        if ($this->sub_unit_id && $quantity != 0 && $main_unit->related_by != null) {
            $main_qty = (int) ($quantity / $main_unit->related_by);
            $main_qty_as_sub = $main_qty * $main_unit->related_by;
            $sub_qty = $quantity - $main_qty_as_sub;
        } else {
            $main_qty = $quantity;
            $sub_qty = 0;
        }

        return [
            'main_qty' => $main_qty,
            'sub_qty' => $sub_qty
        ];
    }


    public function readable_qty($quantity)
    {
        $separated = $this->separate_main_sub_qty($quantity);
        // dd($separated);
        $readable_stock = "";

        $readable_stock .= $separated['main_qty'] . " " . $this->main_unit->name;
        if ($this->sub_unit) {
            $readable_stock .= " " . $separated['sub_qty'] . " " . $this->sub_unit->name;
        }

        return $readable_stock;
        // in units and sub_units
    }

    // Convert all quantity to sub_unit quantity
    public function to_sub_quantity($main_quantity, $sub_quantity)
    {

        $main_unit = $this->main_unit;

        $related_by = 1;
        if ($this->sub_unit_id && $main_unit->related_by != null) {
            $related_by = $main_unit->related_by;
        }

        return ($main_quantity * $related_by) + $sub_quantity;
    }


    public function calculate_worth($main_qty, $sub_qty, $unit_price)
    {
        $main_unit = $this->main_unit;
        $sub_unit_price = 0;

        if ($main_unit->related_by) {
            $sub_unit_price = $unit_price / $main_unit->related_by;
        }

        $main_price = $main_qty * $unit_price;
        $sub_price = $sub_qty * $sub_unit_price;

        return $main_price + $sub_price;
    }

    public function quantity_worth($qty, $unit_price)
    {
        $separated = $this->separate_main_sub_qty($qty);
        return $this->calculate_worth($separated['main_qty'], $separated['sub_qty'], $unit_price);
    }

    // Don't delete if any relation is existing
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($rel) {
            $relationMethods = ['sale', 'purchase'];

            foreach ($relationMethods as $relationMethod) {
                if ($rel->$relationMethod()->count() > 0) {
                    return false;
                }
            }
        });
    }
}