<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesTargetItem extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function sales_target()
    {
        return $this->belongsTo(SalesTarget::class);
    }
    //join with pos item table 
    public function pos_items()
    {
        return $this->hasMany(PosItem::class, 'product_id', 'product_id');
    }

    //product wise sales target (yearly)
    public function getTwelveMonthsAmountByProduct()
    {
        $sales_target_items = $this->product()->join('sales_target_items', 'products.id', '=', 'sales_target_items.product_id')
            ->selectRaw('sum(sales_target_items.twelve_month_quantity * products.cost) as amount')
            ->groupBy('sales_target_items.product_id')
            ->get();
        return $sales_target_items->sum('amount');
    }
    //get monthly target Amount 
    public function getMonthlyTargetAmount()
    {
        //divide yearly target by 12
        $monthly_target_amount = $this->getTwelveMonthsAmountByProduct() / 12;
        return $monthly_target_amount;
    }
    //product wise sale from pos table
    public function getTwelveMonthsSaleQuantityByProduct()
    {
        $sales_target_items = $this->sales_target()->join('pos', 'sales_targets.sales_member_id', '=', 'pos.sales_member_id')
            ->join('pos_items', 'pos.id', '=', 'pos_items.pos_id')
            ->selectRaw('sum(pos_items.qty) as quantity')
            ->where('pos_items.product_id', $this->product_id)
            ->get();
        return $sales_target_items->sum('quantity');
    }

    //this month sales quantity from pos table
    public function getThisMonthSaleQuantity()
    {
        $sales_target_items = $this->pos_items()->join('pos', 'pos_items.pos_id', '=', 'pos.id')
            ->selectRaw('sum(pos_items.qty) as quantity')
            ->groupBy('pos.sales_member_id')
            ->where('pos.sale_date', '>=', date('Y-m-01'))
            ->get();
        return $sales_target_items->sum('quantity');
    }

    //this month sale amount from pos table 
    public function getThisMonthSaleAmount()
    {
        $sales_target_items = $this->pos_items()->join('pos', 'pos_items.pos_id', '=', 'pos.id')
            ->selectRaw('sum(pos_items.sub_total) as amount')
            ->groupBy('pos.sales_member_id')
            ->where('pos.sale_date', '>=', date('Y-m-01'))
            ->get();
        return $sales_target_items->sum('amount');
    }

    //product wise sales amount from pos table
    public function getTwelveMonthsSaleAmountByProduct()
    {
        $sales_target_items = $this->sales_target()->join('pos', 'sales_targets.sales_member_id', '=', 'pos.sales_member_id')
            ->join('pos_items', 'pos.id', '=', 'pos_items.pos_id')
            ->selectRaw('sum(pos_items.sub_total) as amount')
            ->where('pos_items.product_id', $this->product_id)
            ->get();
        return $sales_target_items->sum('amount');
    }

    // count target month
    public function getTargetMonthCount()
    {
        $start_date = $this->sales_target->start_date;
        //get todays date 
        $end_date = date('Y-m-d');
        //if current date is greater than 30 days from start date then count 
        if (strtotime($end_date) > strtotime($start_date . "+30 days")) {
            $end_date = date('Y-m-d', strtotime($start_date . "+30 days"));
        }
        //get difference between two dates
        $diff = abs(strtotime($end_date) - strtotime($start_date));
        //get days
        $days = floor($diff / (60 * 60 * 24));
        //get months
        $months = floor($days / 30);
        return $months;
    }

    //calculate comission 
    public function getCommission()
    {
        $commissionPercentage = $this->sales_target()->join('sales_members', 'sales_targets.sales_member_id', '=', 'sales_members.id')
            ->join('sales_designations', 'sales_members.sales_designation_id', '=', 'sales_designations.id')
            ->select('sales_designations.commission_percentage as percentage')
            ->first();
        //make this value into 0.percentage
        $commissionPercentage = $commissionPercentage->percentage / 100;
        // dd($percentage);

        $target_quantity = $this->twelve_month_quantity;
        $monthly_target_quantity = $target_quantity / 12;
        $sale_quantity = $this->getThisMonthSaleQuantity();
        $sale_amount = $this->getThisMonthSaleAmount();
        $percentage = $target_quantity > 0 ? ($sale_quantity / $monthly_target_quantity) * 100 : 0;
        if ($percentage >= 80) {
            $commission = $sale_amount * $commissionPercentage;
        } else {
            $commission = 0;
        }
        return $commission;
    }

    //daily sales quantity of a product
    public function todaySaleQuantity($product_id, $customer_id)
    {
        $pos = Pos::where('sale_date', date('Y-m-d'))->where('customer_id', $customer_id)->get();
        $total = 0;
        foreach ($pos as $pos) {
            $total += $pos->items->where('product_id', $product_id)->sum('qty');
        }
        return $total;
    }
    //daily sales amount of a product 
    public function todaySaleAmount($product_id, $customer_id)
    {
        $pos = Pos::where('sale_date', date('Y-m-d'))->where('customer_id', $customer_id)->get();
        $total = 0;
        foreach ($pos as $pos) {
            $total += $pos->items->where('product_id', $product_id)->sum('sub_total');
        }
        return $total;
    }

    //all members sales quantity of a product 
    public function allMembersSaleQuantity($product_id, $member_id)
    {
        $pos = Pos::where('sale_date', date('Y-m-d'))->where('sales_member_id', $member_id)->get();
        $total = 0;
        foreach ($pos as $pos) {
            $total += $pos->items->where('product_id', $product_id)->sum('qty');
        }
        return $total;
    } //allMembersSaleAmount 
    public function allMembersSaleAmount($product_id, $member_id)
    {
        $pos = Pos::where('sale_date', date('Y-m-d'))->where('sales_member_id', $member_id)->get();
        $total = 0;
        foreach ($pos as $pos) {
            $total += $pos->items->where('product_id', $product_id)->sum('sub_total');
        }
        return $total;
    }
    //calculate due of a product 
    public function getDue($product_id, $sales_member_id)
    {
        $pos = $this->pos_items()->join('pos', 'pos_items.pos_id', '=', 'pos.id')
            ->where('pos_items.product_id', $product_id)
            ->where('pos.sales_member_id', $sales_member_id)
            ->get();
        //get total due
        $total_due = $pos->sum('due');
        return $total_due;
    }
    //calculate over achieved amount 
    public function getOverAchievedAmount()
    {
        $target_quantity = $this->twelve_month_quantity;
        $monthly_target_quantity = $target_quantity / 12;
        $sale_quantity = $this->getThisMonthSaleQuantity();
        $sale_amount = $this->getThisMonthSaleAmount();
        $percentage = $target_quantity > 0 ? ($sale_quantity / $monthly_target_quantity) * 100 : 0;
        if ($percentage > 100) {
            $over_achieved_amount = ($sale_amount - ($monthly_target_quantity * $this->product->cost));
        } else {
            $over_achieved_amount = 0;
        }
        return $over_achieved_amount;
    }
}