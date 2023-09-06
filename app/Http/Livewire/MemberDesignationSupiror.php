<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MemberDesignationSupiror extends Component
{
    public $designation_id;
    public $supirior_id;
    public $sales_member;
    public function render()
    {
        return view('livewire.member-designation-supiror');
    }
}
