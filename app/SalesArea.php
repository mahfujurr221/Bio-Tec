<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesArea extends Model
{
    //join with warehouse
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
    use HasFactory;
    protected $guarded = [];
}
