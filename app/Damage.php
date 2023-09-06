<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Damage extends Model
{
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(DamageItem::class);
    }

    public function stock()
    {
        return $this->morphMany(Stock::class, 'stockable');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function warehouse(){
        return $this->belongsTo(Warehouse::class);
    }

    public static function boot()
    {
        parent::boot();
    }
}
