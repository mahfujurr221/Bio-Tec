<?php

namespace App\Http\Controllers;

use App\SalesTarget;
use App\SalesTargetItem;
use Illuminate\Http\Request;

class SalesTargetController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:create-sales-target',  ['only' => ['create', 'store']]);
        // $this->middleware('can:edit-sales-target',  ['only' => ['edit', 'update']]);
        $this->middleware('can:show-sales-target',  ['only' => ['show']]);
        $this->middleware('can:delete-sales-target', ['only' => ['destroy']]);  
        $this->middleware('can:list-sales-target', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $targets=SalesTarget::paginate(20);
        return view('pages.sales_target.index',compact('targets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     return view('pages.sales_target.create');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'sales_member_id'=>'required|integer',
            'start_date'=>'required|date'
        ]);

        // dd(date('Y-m-d',strtotime('+3 months',strtotime($request->start_date))));
        // $validated['three_month_date']=date('Y-m-d',strtotime('+3 months',strtotime($request->start_date)));
        // $validated['six_month_date']=date('Y-m-d',strtotime('+6 months',strtotime($request->start_date)));
        // $validated['nine_month_date']=date('Y-m-d',strtotime('+9 months',strtotime($request->start_date)));
        $validated['twelve_month_date']=date('Y-m-d',strtotime('+12 months',strtotime($request->start_date)));

        $target=SalesTarget::create($validated);
        if($target){
            session()->flash('success','Target Created.');
            return redirect()->route('sales-target.show',$target);
        }

        session()->flash('warning','Something went wrong!');
        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SalesTarget  $salesTarget
     * @return \Illuminate\Http\Response
     */
    public function show(SalesTarget $sales_target)
    {
        return view('pages.sales_target.show',compact('sales_target'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SalesTarget  $salesTarget
     * @return \Illuminate\Http\Response
     */
    public function edit(SalesTarget $salesTarget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SalesTarget  $salesTarget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalesTarget $salesTarget)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SalesTarget  $salesTarget
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalesTarget $salesTarget)
    {
        //
    }

    public function store_item(SalesTarget $sales_target,Request $request){
        $validated=$request->validate([
            'product_id'=>'required|integer',
            'twelve_month_quantity'=>'nullable'
        ]);
        // dd($validate);

        $exist=$sales_target->sales_target_items()->where('product_id',$request->product_id)->first();
        if(!$exist){
            // dd($exist);
            $sales_target->sales_target_items()->create($validated);
            session()->flash('success','Added Successfully!');
            return back();
        }else{
            session()->flash('warning','Already Exist!');
            return back();
        }
    }

    public function update_item(SalesTargetItem $sales_target_item,Request $request){
        $validated=$request->validate([
            'twelve_month_quantity'=>'nullable'
        ]);

        $sales_target_item->update($validated);
        session()->flash('success','Updated Successfully!');
        return back();
    }
}
