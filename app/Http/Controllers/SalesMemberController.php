<?php

namespace App\Http\Controllers;

use App\SalesMember;
use App\SalesArea;
use App\Warehouse;
use Illuminate\Http\Request;

class SalesMemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:create-sales-member', ['only' => ['create', 'store']]);
        $this->middleware('can:edit-sales-member', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete-sales-member', ['only' => ['destroy']]);
        $this->middleware('can:list-sales-member', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('WarehouseAdmin')) {
            $members = SalesMember::where('warehouse_id', auth()->user()->warehouse_id)->latest()->paginate(10);
        } else {
            $members = SalesMember::latest()->paginate(10);
        }
        return view('pages.sales_team.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $salesArea = SalesArea::get();
        $warehouses = Warehouse::get();
        return view('pages.sales_team.create', compact('salesArea', 'warehouses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $this->validate($request, [
            'name' => 'required',
            'mobile' => 'string|required|max:30',
            'sales_designation_id' => 'integer|required',
            'address' => 'nullable|string|max:2000',
            'supirior_id' => 'nullable|integer',
            'warehouse_id' => 'nullable|integer',
            'sales_area_id' => 'nullable|integer',
        ]);

        $salesman = new SalesMember();
        $salesman->name = $request->name;
        $salesman->mobile = $request->mobile;
        $salesman->sales_designation_id = $request->sales_designation_id;
        $salesman->address = $request->address;
        $salesman->supirior_id = $request->supirior_id;
        if (auth()->user()->hasRole('WarehouseAdmin')) {
            $salesman->warehouse_id = auth()->user()->warehouse_id;
        } else {
            $salesman->warehouse_id = $request->warehouse_id;
        }
        $salesman->sales_area_id = $request->sales_area_id;
        $salesman->save();

        session()->flash('success', 'Added Successfully!');
        return redirect()->back();
    }

    public function show(SalesMember $sales_member)
    {
        //
    }

    public function edit(SalesMember $sales_member)
    {
        $warehouses = Warehouse::get();
        return view('pages.sales_team.edit', compact('sales_member', 'warehouses'));
    }

    public function update(Request $request, SalesMember $sales_member)
    {
        $validated = $this->validate($request, [
            'name' => 'required',
            'mobile' => 'string|required|max:30',
            'sales_designation_id' => 'integer|required',
            'address' => 'nullable|string|max:2000',
            'supirior_id' => 'nullable|integer',
            'warehouse_id' => 'nullable|integer',
            'sales_area_id' => 'nullable|integer',
        ]);

        if (!$request->supirior_id) {
            $validated['supirior_id'] = null;
        }
        $sales_member->update($validated);
        session()->flash('success', 'Updated Successfully!');
        return back();
    }
    public function destroy(SalesMember $sales_member)
    {
        // dd($sales_member);
        $sales_member->delete();
        session()->flash('success', 'Deleted Successfully!');
        return back();
    }
}