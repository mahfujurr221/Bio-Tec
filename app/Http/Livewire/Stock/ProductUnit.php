<?php

namespace App\Http\Livewire\Stock;

use App\Product;
use Livewire\Component;

class ProductUnit extends Component
{
    public  $selected_product="";
    public $product;

    public function updatedSelectedProduct($value="")
    {
        // dd($value);
        if($value==""){
            $this->product=null;
        }

        $this->product=Product::find($value);


    }

    public function render()
    {
        return view('livewire.stock.product-unit');
    }
}
