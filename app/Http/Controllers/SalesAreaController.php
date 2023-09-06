<?php

namespace App\Http\Controllers;

use App\SalesArea;
use App\Warehouse;
use Illuminate\Http\Request;

class SalesAreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:create-sales-area', ['only' => ['create', 'store']]);
        $this->middleware('can:edit-sales-area', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete-sales-area', ['only' => ['destroy']]);
        $this->middleware('can:list-sales-area', ['only' => ['index']]);
        $this->middleware('can:show-sales-area', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouses = Warehouse::get();
        $salesAreas = SalesArea::latest()->paginate(10);
        return view('pages.sales_area.index', compact('salesAreas', 'warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'name' => 'required',
            'warehouse_id' => 'required',
        ]);
        SalesArea::create($validated);

        session()->flash('success', 'Area Added Successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $salesArea = SalesArea::where('warehouse_id', $id)->get();
        return response()->json($salesArea);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $warehouses = Warehouse::get();
        $salesArea = SalesArea::find($id);
        return view('pages.sales_area.edit', compact('salesArea', 'warehouses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $this->validate($request, [
            'name' => 'required',
            'warehouse_id' => 'required',
        ]);
        $salesArea = SalesArea::find($id);
        $salesArea->update($validated);

        session()->flash('success', 'Area Updated Successfully!');
        return redirect()->route('sales-area.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete area 
        $salesArea = SalesArea::find($id);
        $salesArea->delete();
        session()->flash('success', 'Area Deleted Successfully!');
        return redirect()->back();
    }

    //get warehouse wise area
    // public function getArea($id)
    // {
    //     $salesAreas = SalesArea::where('warehouse_id', $id)->get();
    //     return response()->json($salesAreas);
    // }

}