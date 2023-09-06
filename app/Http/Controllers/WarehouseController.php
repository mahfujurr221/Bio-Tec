<?php

namespace App\Http\Controllers;

use App\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:create-warehouse',  ['only' => ['create', 'store']]);
        $this->middleware('can:edit-warehouse',  ['only' => ['edit', 'update']]);
        $this->middleware('can:delete-warehouse', ['only' => ['destroy']]);
        $this->middleware('can:list-warehouse', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouses = Warehouse::latest()->paginate(10);
        return view('pages.warehouse.index',compact('warehouses'));
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
        $this->validate($request, [
            'name' => 'required',
        ]);
        Warehouse::create([
            'name' => $request->name,
        ]);

        session()->flash('success', 'Added Successfully!');
        return redirect()->back();
    }


    public function show(Warehouse $warehouse)
    {
        //
    }

    public function edit(Warehouse $warehouse)
    {
        return view('pages.warehouse.edit',compact('warehouse'));
    }


    public function update(Request $request, Warehouse $warehouse)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $warehouse->update([
            'name' => $request->name
        ]);

        session()->flash('success', 'Updated Successfully!');
        return back();
    }


    public function destroy(Warehouse $warehouse)
    {
        session()->flash('error', 'Deletion Failed.');
        return redirect()->back();

        if($warehouse->is_default){
            session()->flash('success', 'This Warehouse Can not be Deleted.');
            return back();
        }

        if ($warehouse->delete()) {
            session()->flash('success', 'Deleted Successfully.');
        } else {
            session()->flash('warning', 'Deletion Failed.');
        }
    }
}