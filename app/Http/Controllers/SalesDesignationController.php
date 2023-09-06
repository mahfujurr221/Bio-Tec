<?php

namespace App\Http\Controllers;

use App\SalesDesignation;
use Illuminate\Http\Request;

class SalesDesignationController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:create-sales-designation',  ['only' => ['create', 'store']]);
        $this->middleware('can:edit-sales-designation',  ['only' => ['edit', 'update']]);
        $this->middleware('can:delete-sales-designation', ['only' => ['destroy']]);
        $this->middleware('can:list-sales-designation', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $designations = SalesDesignation::paginate(10);
        return view('pages.sales_designation.index',compact('designations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated=$this->validate($request, [
            'name' => 'required',
            'level'=>'integer|required',
            'commission_percentage'=>'required|numeric',
        ]);
        SalesDesignation::create($validated);

        session()->flash('success', 'Added Successfully!');
        return redirect()->back();
    }


    public function show(SalesDesignation $sales_designation)
    {
        //
    }

    public function edit(SalesDesignation $sales_designation)
    {
        return view('pages.sales_designation.edit',compact('sales_designation'));
    }


    public function update(Request $request, SalesDesignation $sales_designation)
    {
        $validated=$this->validate($request, [
            'name' => 'required',
            'level'=>'integer|required',
            'commission_percentage'=>'required|numeric'
        ]);
        $sales_designation->update($validated);

        session()->flash('success', 'Updated Successfully!');
        return back();
    }


    public function destroy(SalesDesignation $sales_designation)
    {
        session()->flash('error', 'Deletion Failed.');

        return redirect()->back();
        if($sales_designation->is_default){
        session()->flash('success', 'This Designation Can not be Deleted.');
            return back();
        }
        if ($sales_designation->delete()) {
            session()->flash('success', 'Deleted Successfully.');
        } else {
            session()->flash('warning', 'Deletion Failed.');
        }
    }
}