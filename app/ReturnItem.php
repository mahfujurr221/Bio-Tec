<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturnItem extends Model
{
    protected $guarded = [];

    public function return()
    {
        return $this->belongsTo(OrderReturn::class,'order_return_id');
    }

    public function stock()
    {
        return $this->morphMany(Stock::class, 'stockable');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function boot()
    {
        parent::boot();
    }
}
