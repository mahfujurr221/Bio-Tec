<?php

namespace App\Http\Livewire\Pos;

use App\Customer;
use Livewire\Component;

class SalesmanCustomer extends Component
{
    public $sales_man;
    public $customers=[];

    public function updatedSalesMan($value){
        // dd($value);
        $this->customers=Customer::where('sales_member_id',$value)->get();
    }

    public function render()
    {
        return view('livewire.pos.salesman-customer');
    }
}
