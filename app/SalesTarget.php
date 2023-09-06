<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesTarget extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sales_member()
    {
        return $this->belongsTo(SalesMember::class);
    }

    public function sales_target_items()
    {
        return $this->hasMany(SalesTargetItem::class);
    }

    public function commissions()
    {
        return $this->hasmany(SalesCommission::class);
    }
    //join with pos table 
    public function pos()
    {
        return $this->hasMany(Pos::class, 'sales_member_id', 'sales_member_id');
    }

    // sales member wise sales target (yearly)
    public function getTwelveMonthsQuantity()
    {
        $sales_target_items = $this->sales_target_items()->selectRaw('sum(twelve_month_quantity) as quantity')->groupBy('sales_target_id')->get();
        return $sales_target_items->sum('quantity');
    }

    // sales member wise sales target amount (yearly) from product table
    public function getTwelveMonthsAmount()
    {
        $sales_target_items = $this->sales_target_items()->join('products', 'sales_target_items.product_id', '=', 'products.id')
            ->selectRaw('sum(sales_target_items.twelve_month_quantity * products.price) as amount')
            ->groupBy('sales_target_items.sales_target_id')
            ->get();
        return $sales_target_items->sum('amount');
    }

    // get total sale quantity by sales member from pos table
    public function getTwelveMonthsSaleQuantity()
    {
        $sales_target_items = $this->pos()->join('pos_items', 'pos.id', '=', 'pos_items.pos_id')
            ->selectRaw('sum(pos_items.qty) as quantity')
            ->groupBy('pos.sales_member_id')
            ->get();
        return $sales_target_items->sum('quantity');
    }
    

    // get total sale amount by sales member from pos table
    public function getTwelveMonthsSaleAmount()
    {
        $sales_target_items = $this->pos()->join('pos_items', 'pos.id', '=', 'pos_items.pos_id')
            ->selectRaw('sum(pos_items.sub_total) as amount')
            ->groupBy('pos.sales_member_id')
            ->get();
        return $sales_target_items->sum('amount');
    }

    
}