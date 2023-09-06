<?php

namespace App\Http\Controllers;

use App\Product;
use App\PurchaseItem;
use App\StockTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:stock', ['only' => ['index']]);
    }

    public function index(Request $request)
    {
        $products = new Product();
        $data = [];

        if ($request->product_id != null) {
            $products = $products->where('id', $request->product_id);
            $data['product_id'] = $request->product_id;
        }

        if ($request->code != null) {
            $products = $products->where('code', $request->code);
            $data['code'] = $request->code;
        }

        if ($request->name != null) {
            $products = $products->where('name', 'like', '%' . $request->name . '%');
            $data['name'] = $request->name;
        }

        if ($request->category != null) {
            $products = $products->where('category_id', $request->category);
            $data['category'] = $request->category;
        }

        if ($request->brand != null) {
            $products = $products->where('brand_id', $request->brand);
            $data['brand'] = $request->brand;
        }

        $products = $products->paginate(20);
        //find stock product by warehouse id

        return view('pages.stock.index', $data, compact('products'));
    }

    function create()
    {
        return view('pages.stock.add_stock');
    }

    function add_stock(Request $request)
    {
        if($request->new_product == null){
            session()->flash('error', 'Please add at least one product.');
            return back();
        }
        foreach ($request->new_product as $key => $product_id) {
            $data = [];
            $main_qty = 0;
            $sub_qty = 0;
            $qty = 0;
            $product = Product::find($product_id);

            $main_qty = $request->new_main_qty[$product_id];
            // dd($main_qty);

            $qty = $product->to_sub_quantity($main_qty, $sub_qty);
            // dd($qty);
            $data['main_unit_qty'] = $main_qty;
            $data['sub_unit_qty'] = $sub_qty;
            $data['qty'] = $qty;
            $data['product_id'] = $product_id;

            $data['note'] = $request->note;
            $data['date'] = $request->date;

            PurchaseItem::create($data);
        }
        session()->flash('success', 'Added Successfully.');
        return back();
    }

    public function history(Request $request)
    {
        $additions = PurchaseItem::orderBy('id', 'desc')->paginate(20);
        return view('pages.stock.addition_history', compact('additions'));
    }

    public function transfer_index()
    {
        return view('pages.stock.transfer_stock');
    }

    public function transfer_stock(Request $request)
    {
        //if $request warehouse_id is null then show error msg 
        if ($request->to_warehouse == null) {
            session()->flash('error', 'Please select a warehouse.');
            return back();
        }
        if ($request->new_product == null) {
            session()->flash('error', 'Please select a product.');
            return back();
        }
        
        foreach($request->new_product as $product_id)
        {
            $product = Product::find($product_id);
            $data = [];
            $main_qty = 0;
            $sub_qty = 0;
            $qty = 0;
            $main_qty = $request->new_main_qty[$product_id];
            $qty = $product->to_sub_quantity($main_qty, $sub_qty);
            $data['main_unit_qty'] = $main_qty;
            $data['sub_unit_qty'] = $sub_qty;
            $data['qty'] = $qty;
            $data['product_id'] = $product_id;
            $data['to_warehouse'] = $request->to_warehouse;
            $data['note'] = $request->note;
            $data['date'] = $request->date;
            StockTransfer::create($data);
        }
        session()->flash('success', 'Transfered Successfully.');
        return back();
    }


    public function transfer_history(Request $request)
    {
        $transfers = StockTransfer::orderBy('id', 'desc')->paginate(20);
        return view('pages.stock.transfer_history', compact('transfers'));
    }
}