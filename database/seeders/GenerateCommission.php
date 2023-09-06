<?php

namespace Database\Seeders;

use App\Pos;
use App\PosItem;
use App\SalesTarget;
use App\Services\SummaryService;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenerateCommission extends Seeder
{
    private function sold($product_id, $sales_member_id, $start_date, $end_date)
    {
        $sold_qty = PosItem::where('product_id', $product_id)
            ->whereHas('pos', function ($pos) use ($sales_member_id, $start_date, $end_date) {
                $pos->whereDate('sale_date', '>=', $start_date)
                    ->whereDate('sale_date', '<=', $end_date)
                    ->whereHas('customer', function ($customer) use ($sales_member_id) {
                        $customer->where('sales_member_id', $sales_member_id);
                    })
                    ;
            })
            ->sum('qty');

        // Pos::->sum('final_receivable');

        return $sold_qty;
    }

    private function is_eligible_for_commission($sales_target, $start_date, $end_date, $month)
    {
        $is_eligible = true;
        foreach ($sales_target->sales_target_items as $item) {
            $target = 0;
            if ($month == 3) {
                $target = $item->three_month_quantity;
            }

            if ($month == 6) {
                $target = $item->six_month_quantity;
            }

            if ($month == 9) {
                $target = $item->nine_month_quantity;
            }

            if ($month == 12) {
                $target = $item->twelve_month_quantity;
            }
            $sold = $this->sold($item->product_id, $sales_target->sales_member_id, $start_date, $end_date);
            if ($target > $sold) {
                $is_eligible = false;
            }
        }

        return $is_eligible;
    }

    private function has_commission_been_given_for_month($target, $month)
    {
        $commission_given = $target
            ->commissions()
            ->where('commission_month', $month)
            ->first();
        if ($commission_given) {
            return $commission_given;
        }
        return false;
    }

    private function give_commission($target, $month, $start_date, $end_date)
    {
        $sales_member_id = $target->sales_member_id;
        $sales_amount_for_previously_given_commission = $target->commissions()->sum('sale_amount') ?? 0;
        $total_sold = Pos::whereDate('sale_date', '>=', $start_date)
            ->whereDate('sale_date', '<=', $end_date)
            ->whereHas('customer', function ($customer) use ($sales_member_id) {
                $customer->where('sales_member_id', $sales_member_id);
            })
            ->sum('final_receivable');

        $remaining_sales = $total_sold - $sales_amount_for_previously_given_commission;

        $receipient = $target->sales_member;

        while ($receipient) {
            $percentage = $receipient->designation->commission_percentage;

            $commission = $remaining_sales * ($percentage / 100);

            $receipient->sales_commissions()->create([
                'sales_target_id' => $target->id,
                'sale_amount' => $remaining_sales,
                'percentage' => $percentage,
                'amount' => $commission,
                'commission_month' => $month,
            ]);

            $receipient = $receipient->supirior;
        }
    }

    private function process_commission($target, $commission_month, $end_date)
    {
        // has the commission for **** months been given
        $commission_given = $this->has_commission_been_given_for_month($target, $commission_month);
        if (!$commission_given) {
            // if not -> is the salesman eligible to get that commission
            $is_eligible = $this->is_eligible_for_commission($target, $target->start_date, $end_date, $commission_month);
            if ($is_eligible) {
                $this->give_commission($target, $commission_month, $target->start_date, $end_date);
            }
        }
    }

    public function run()
    {
        // 12 months commission
        foreach (
            SalesTarget::where('start_date', '<=', date('Y-m-d'))
                ->where('processed', 0)
                ->get()
            as $target
        ) {
            // if it is already 12 months -> how many months passed
            $startDate = Carbon::parse($target->start_date);
            $endDate = Carbon::parse(date('y-m-d'));

            $monthsPassed = $startDate->diffInMonths($endDate);
            if ($monthsPassed >= 12) {
                $this->process_commission($target, 12, $target->twelve_month_date);
                $target->update([
                    'processed' => 1,
                ]);
            } elseif ($monthsPassed >= 9) {
                $this->process_commission($target, 9, $target->nine_month_date);
            } elseif ($monthsPassed >= 6) {
                $this->process_commission($target, 6, $target->six_month_date);
            } elseif ($monthsPassed >= 3) {
                $this->process_commission($target, 3, $target->three_month_date);
            }
        }

    }
}
