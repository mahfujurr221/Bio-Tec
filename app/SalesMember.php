<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesMember extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function designation()
    {
        return $this->belongsTo(SalesDesignation::class, 'sales_designation_id');
    }
    //warehouse
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    function supirior()
    {
        return $this->belongsTo(SalesMember::class, 'supirior_id');
    }

    public function sales_commissions()
    {
        return $this->hasMany(SalesCommission::class);
    }
    public function sales_targets()
    {
        return $this->hasMany(SalesTarget::class);
    }

    public function sales_target_items()
    {http://127.0.0.1:8000/back/bank_account
        return $this->hasMany(SalesTargetItem::class);
    }

    // sales member wise sales target (yearly)
    public function getTwelveMonthsQuantity()
    {
        //if sales designation id is 1 then 
        $sales_target_items = $this->sales_targets()->join('sales_target_items', 'sales_targets.id', '=', 'sales_target_items.sales_target_id')
            ->selectRaw('sum(sales_target_items.twelve_month_quantity) as quantity')
            ->groupBy('sales_targets.id')
            ->get();
        return $sales_target_items->sum('quantity');
    }

    // sales member wise sales target amount (yearly) from product table 
    public function getTwelveMonthsAmount()
    {
        $sales_target_items = $this->sales_targets()->join('sales_target_items', 'sales_targets.id', '=', 'sales_target_items.sales_target_id')
            ->join('products', 'sales_target_items.product_id', '=', 'products.id')
            ->selectRaw('sum(sales_target_items.twelve_month_quantity * products.cost) as amount')
            ->groupBy('sales_targets.id')
            ->get();
        return $sales_target_items->sum('amount');
    }

    // get total sale quantity by sales member from pos table 
    public function getTwelveMonthsSaleQuantity()
    {
        $sales_target_items = $this->sales_targets()->join('pos', 'sales_targets.sales_member_id', '=', 'pos.sales_member_id')
            ->join('pos_items', 'pos.id', '=', 'pos_items.pos_id')
            ->selectRaw('sum(pos_items.qty) as quantity')
            ->groupBy('sales_targets.sales_member_id')
            ->get();
        return $sales_target_items->sum('quantity');
    }

    // get total sale amount by sales member from pos table
    public function getTwelveMonthsSaleAmount()
    {
        $sales_target_items = $this->sales_targets()->join('pos', 'sales_targets.sales_member_id', '=', 'pos.sales_member_id')
            ->join('pos_items', 'pos.id', '=', 'pos_items.pos_id')
            ->selectRaw('sum(pos_items.sub_total) as amount')
            ->groupBy('sales_targets.sales_member_id')
            ->get();
        return $sales_target_items->sum('amount');
    }


    //get total target of TM where sales members supirior id is TM id 
    public function getTwelveMonthsQuantityByTM($id)
    {
        //get all members 
        $sales_members = $this->where('supirior_id', $id)->get();
        $total = 0;
        foreach ($sales_members as $sales_member) {
            $total += $sales_member->getTwelveMonthsQuantity();
        }
        return $total;
    }
    public function getTwelveMonthsQuantityByJRSM($id)
    {
        //get all members 
        $sales_members = $this->where('supirior_id', $id)->get();
        $total = 0;
        foreach ($sales_members as $sales_member) {
            $total += $sales_member->getTwelveMonthsQuantityByTM($sales_member->id);
        }
        return $total;
    }

    //get total target of RSM 
    public function getTwelveMonthsQuantityByRSM($id)
    {
        //get all members 
        $sales_members = $this->where('supirior_id', $id)->get();
        $total = 0;
        foreach ($sales_members as $sales_member) {
            $total += $sales_member->getTwelveMonthsQuantityByJRSM($sales_member->id);
        }
        return $total;
    }

    //get total target of ASM 
    public function getTwelveMonthsQuantityByASM($id)
    {
        //get all members 
        $sales_members = $this->where('supirior_id', $id)->get();
        $total = 0;
        foreach ($sales_members as $sales_member) {
            $total += $sales_member->getTwelveMonthsQuantityByRSM($sales_member->id);
        }
        return $total;
    }

    //get total target of NSM 
    public function getTwelveMonthsQuantityByNSM($id)
    {
        //get all members 
        $sales_members = $this->where('supirior_id', $id)->get();
        $total = 0;
        foreach ($sales_members as $sales_member) {
            $total += $sales_member->getTwelveMonthsQuantityByASM($sales_member->id);
        }
        return $total;
    }

    //get total target amount of Tm 
    public function getTwelveMonthsAmountByTM($id)
    {
        //get all members 
        $sales_members = $this->where('supirior_id', $id)->get();
        $total = 0;
        foreach ($sales_members as $sales_member) {
            $total += $sales_member->getTwelveMonthsAmount();
        }
        return $total;
    }
    public function getTwelveMonthsAmountByJRSM($id)
    {
        //get all members 
        $sales_members = $this->where('supirior_id', $id)->get();
        $total = 0;
        foreach ($sales_members as $sales_member) {
            $total += $sales_member->getTwelveMonthsAmountByTM($sales_member->id);
        }
        return $total;
    }
    //get total target amount of RSM
    public function getTwelveMonthsAmountByRSM($id)
    {
        //get all members 
        $sales_members = $this->where('supirior_id', $id)->get();
        $total = 0;
        foreach ($sales_members as $sales_member) {
            $total += $sales_member->getTwelveMonthsAmountByJRSM($sales_member->id);
        }
        return $total;
    }

    //get total target amount of ASM
    public function getTwelveMonthsAmountByASM($id)
    {
        //get all members 
        $sales_members = $this->where('supirior_id', $id)->get();
        $total = 0;
        foreach ($sales_members as $sales_member) {
            $total += $sales_member->getTwelveMonthsAmountByRSM($sales_member->id);
        }
        return $total;
    }

    //get total target amount of NSM
    public function getTwelveMonthsAmountByNSM($id)
    {
        //get all members 
        $sales_members = $this->where('supirior_id', $id)->get();
        $total = 0;
        foreach ($sales_members as $sales_member) {
            $total += $sales_member->getTwelveMonthsAmountByASM($sales_member->id);
        }
        return $total;
    }

    //get total sale quantity of TM
    public function getTwelveMonthsSaleQuantityByTM($id)
    {
        //get all members 
        $sales_members = $this->where('supirior_id', $id)->get();

        $total = 0;
        foreach ($sales_members as $sales_member) {
            $total += $sales_member->getTwelveMonthsSaleQuantity();
        }
        return $total;
    }
//get total sale quantity of JRSM
public function getTwelveMonthsSaleQuantityByJRSM($id)
{
    //get all members 
    $sales_members = $this->where('supirior_id', $id)->get();

    $total = 0;
    foreach ($sales_members as $sales_member) {
        $total += $sales_member->getTwelveMonthsSaleQuantityByTM($sales_member->id);
    }
    return $total;
}
    //get total sale quantity of RSM
    public function getTwelveMonthsSaleQuantityByRSM($id)
    {
        //get all members 
        $sales_members = $this->where('supirior_id', $id)->get();

        $total = 0;
        foreach ($sales_members as $sales_member) {
            $total += $sales_member->getTwelveMonthsSaleQuantityByJRSM($sales_member->id);
        }
        return $total;
    }

    //get total sale quantity of ASM
    public function getTwelveMonthsSaleQuantityByASM($id)
    {
        //get all members 
        $sales_members = $this->where('supirior_id', $id)->get();

        $total = 0;
        foreach ($sales_members as $sales_member) {
            $total += $sales_member->getTwelveMonthsSaleQuantityByRSM($sales_member->id);
        }
        return $total;
    }

    //get total sale quantity of NSM
    public function getTwelveMonthsSaleQuantityByNSM($id)
    {
        //get all members 
        $sales_members = $this->where('supirior_id', $id)->get();

        $total = 0;
        foreach ($sales_members as $sales_member) {
            $total += $sales_member->getTwelveMonthsSaleQuantityByASM($sales_member->id);
        }
        return $total;
    }

    //get total sale amount of TM
    public function getTwelveMonthsSaleAmountByTM($id)
    {
        //get all members 
        $sales_members = $this->where('supirior_id', $id)->get();

        $total = 0;
        foreach ($sales_members as $sales_member) {
            $total += $sales_member->getTwelveMonthsSaleAmount();
        }
        return $total;
    }

    //get total sale amount of RSM
    public function getTwelveMonthsSaleAmountByJRSM($id)
    {
        //get all members 
        $sales_members = $this->where('supirior_id', $id)->get();

        $total = 0;
        foreach ($sales_members as $sales_member) {
            $total += $sales_member->getTwelveMonthsSaleAmountByTM($sales_member->id);
        }
        return $total;
    }

    //get total sale amount of RSM
    public function getTwelveMonthsSaleAmountByRSM($id)
    {
        //get all members 
        $sales_members = $this->where('supirior_id', $id)->get();

        $total = 0;
        foreach ($sales_members as $sales_member) {
            $total += $sales_member->getTwelveMonthsSaleAmountByJRSM($sales_member->id);
        }
        return $total;
    }

    //get total sale amount of ASM
    public function getTwelveMonthsSaleAmountByASM($id)
    {
        //get all members 
        $sales_members = $this->where('supirior_id', $id)->get();

        $total = 0;
        foreach ($sales_members as $sales_member) {
            $total += $sales_member->getTwelveMonthsSaleAmountByRSM($sales_member->id);
        }
        return $total;
    }

    //get total sale amount of NSM
    public function getTwelveMonthsSaleAmountByNSM($id)
    {
        //get all members 
        $sales_members = $this->where('supirior_id', $id)->get();
        $total = 0;
        foreach ($sales_members as $sales_member) {
            $total += $sales_member->getTwelveMonthsSaleAmountByASM($sales_member->id);
        }
        return $total;
    }

    // //count total member of TM
    // public function countMemberByTM($id)
    // {
    //     return $this->where('supirior_id', $id)->count();
    // }

    // //count total member of RSM
    // public function countMemberByRSM($id)
    // {
    //     // get total tm members value from countMemberByTM function 
    //     $total = 0;
    //     $sales_members = $this->where('supirior_id', $id)->get();
    //     foreach ($sales_members as $sales_member) {
    //         $total += $sales_member->countMemberByTM($sales_member->id);
    //     }
    //     return $total;
    // }

    // //count total member of ASM
    // public function countMemberByASM($id)
    // {
    //     // get total tm members value from countMemberByTM function 
    //     $total = 0;
    //     $sales_members = $this->where('supirior_id', $id)->get();
    //     foreach ($sales_members as $sales_member) {
    //         $total += $sales_member->countMemberByRSM($sales_member->id);
    //     }
    //     return $total;
    // }

    // //count total member of NSM
    // public function countMemberByNSM($id)
    // {
    //     // get total tm members value from countMemberByTM function 
    //     $total = 0;
    //     $sales_members = $this->where('supirior_id', $id)->get();
    //     foreach ($sales_members as $sales_member) {
    //         $total += $sales_member->countMemberByASM($sales_member->id);
    //     }
    //     return $total;
    // }

    // //count commission of TM
    // // public function getTwelveMonthsCommissionByTM($id)
    // // {
    // //     $target_quantity = $this->sales_targets()->join('sales_target_items', 'sales_targets.id', '=', 'sales_target_items.sales_target_id')
    // //         ->selectRaw('sum(sales_target_items.twelve_month_quantity) as quantity')
    // //         ->groupBy('sales_targets.id')
    // //         ->get();
    // //     $target_quantity = $target_quantity->sum('quantity');
    // //     $monthly_target_quantity = $target_quantity / 12;
    // //     $sale_quantity = $this->getTwelveMonthsSaleQuantityByProduct();
    // //     $percentage = $target_quantity > 0 ? ($sale_quantity / $monthly_target_quantity) * 100 : 0;
    // //     if ($percentage >= 80) {
    // //         $commission = $this->product->cost * $sale_quantity * 0.02;
    // //     } else {
    // //         $commission = 0;
    // //     }
    // //     return $commission;
    // }

    // calculate month wise sale amount 
    public function getMonthAmount($id, $month)
    {
        $sales_target_items = $this->sales_targets()->join('pos', 'sales_targets.sales_member_id', '=', 'pos.sales_member_id')
            ->join('pos_items', 'pos.id', '=', 'pos_items.pos_id')
            ->selectRaw('sum(pos_items.sub_total) as amount')
            ->groupBy('sales_targets.sales_member_id')
            ->where('sales_targets.sales_member_id', $id)
            ->whereMonth('pos.sale_date', $month)
            ->get();
        return $sales_target_items->sum('amount');
    }

    //get amount by jr tm 
    // public function getMonthAmountByJRTM($id, $month)
    // {
    //     $sales_members = $this->where('supirior_id', $id)->get();
    //     $total = 0;
    //     foreach ($sales_members as $sales_member) {
    //         $total += $sales_member->getMonthAmount($sales_member->id, $month);
    //     }
    //     return $total;
    // }

    public function getMonthAmountByTM($id, $month)
    {
        $sales_members = $this->where('supirior_id', $id)->get();
        $total = 0;
        foreach ($sales_members as $sales_member) {
            $total += $sales_member->getMonthAmount($sales_member->id, $month);
        }
        return $total;
    }
    public function getMonthAmountByJRSM($id, $month)
    {
        $sales_members = $this->where('supirior_id', $id)->get();
        $total = 0;
        foreach ($sales_members as $sales_member) {
            $total += $sales_member->getMonthAmountByTM($sales_member->id, $month);
        }
        return $total;
    }

    public function getMonthAmountByRSM($id, $month)
    {
        $sales_members = $this->where('supirior_id', $id)->get();
        $total = 0;
        foreach ($sales_members as $sales_member) {
            $total += $sales_member->getMonthAmountByJRSM($sales_member->id, $month);
        }
        return $total;
    }

    public function getMonthAmountByASM($id, $month)
    {
        $sales_members = $this->where('supirior_id', $id)->get();
        $total = 0;
        foreach ($sales_members as $sales_member) {
            $total += $sales_member->getMonthAmountByRSM($sales_member->id, $month);
        }
        return $total;
    }

    public function getMonthAmountByNSM($id, $month)
    {
        $sales_members = $this->where('supirior_id', $id)->get();
        $total = 0;
        foreach ($sales_members as $sales_member) {
            $total += $sales_member->getMonthAmountByASM($sales_member->id, $month);
        }
        return $total;
    }
}