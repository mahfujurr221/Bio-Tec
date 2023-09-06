@extends('layouts.master')
@section('title', 'Stock Transfer History')

@section('page-header')
<header class="header bg-ui-general">
     <div class="header-info">
          <h1 class="header-title">
               <strong>Stock Transfer History</strong>
          </h1>
     </div>
</header>
@endsection

@section('content')
<div class="col-12">

    {{-- <div class="card card-body mb-2 print_hidden">
        <form action="{{ route('stock.index') }}">
            <div class="form-row">
                <div class="form-group col-md-3">
                  <select name="product_id" id="" class="form-control" data-provide="selectpicker"
                data-live-search="true" data-size="10">
                      <option value="">Select a Product</option>
                    @foreach (\App\Product::all() as $item)
                      <option value="{{ $item->id }}" {{ isset($product_id)&&$product_id==$item->id?"SELECTED":"" }}>{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group col-md-3">
                  <select name="warehouse_id" id="" class="form-control">
                    <option value="">Select Warehouse</option>
                    @foreach (\App\Warehouse::get() as $item)
                      <option value="{{ $item->id }}" {{ request("warehouse_id")==$item->id?"SELECTED":"" }}>{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group col-md-3">
                    <input type="text" name="code" class="form-control" placeholder="Product Code" value="{{ isset($code)?$code:"" }}">
                </div>
                <div class="form-group col-md-3">
                    <input type="text" class="form-control" name="name" placeholder="Product Name">
                </div>
                <div class="form-group col-md-3">
                    <div class="form-group">
                        <select name="category" id="" class="form-control" data-provide="selectpicker" data-live-search="true" data-size="10">
                        <option value="">Select Category</option>
                        @foreach (\App\Category::all() as $item)
                            <option value="{{ $item->id }}" {{ isset($category)&&$category==$item->id?"SELECTED":"" }}>{{ $item->name }}</option>
                        @endforeach
                        </select>
                        @if($errors->has('category'))
                        <div class="alert alert-danger">{{ $errors->first('category') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <div class="form-group">
                        <select name="brand" id="" class="form-control" data-provide="selectpicker" data-live-search="true" data-size="10">
                        <option value="">Select Brand</option>
                        @foreach (\App\Brand::all() as $item)
                            <option value="{{ $item->id }}" {{ isset($brand)&&$brand==$item->id?"SELECTED":"" }}>{{ $item->name }}</option>
                        @endforeach
                        </select>
                        @if($errors->has('brand'))
                        <div class="alert alert-danger">{{ $errors->first('brand') }}</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-row mt-2">
                <div class="form-group float-right">
                    <button class="btn btn-primary" type="submit">
                            <i class="fa fa-sliders"></i>
                            Filter
                    </button>
                    <a href="{{ route('stock.index') }}" class="btn btn-info">Reset</a>
                </div>
            </div>
        </form>
    </div>
    @php 
          $warehouse_id=1;
          if(request('warehouse_id')){
               $warehouse_id=request('warehouse_id');
          }
     @endphp --}}

    <div class="card print_area">
     <div class="row">
         <div class="col-12" style="display:flex; justify-content:space-between">
             <h4 class="card-title"><strong>Stock Transfer History</strong></h4>
             <a href="" class="btn btn-primary print_hidden mt-2 mr-2" onclick="window.print()"
                 style="height: fit-content;">Print</a>
         </div>
     </div>

          <div class="card-body">
               @if($transfers->count() > 0)
               <div class="">
                    <table class="table table-responsive table-bordered pt-2"
                    {{-- data-provide="datatables" --}}
                    >
                         <thead>
                              <tr class="bg-primary">
                                   <th>#</th>
                                   <th>Product</th>
                                   <th>To Warehouse</th>
                                   <th>Date</th>
                                   <th>Quantity</th>
                                   <th>Note</th>
                              </tr>
                         </thead>
                         <tbody>
                              @foreach($transfers as $key => $item)
                              @php 
                                   $product=$item->product;
                              @endphp
                              <tr>
                                   <th scope="row">{{ ++$key }}</th>
                                   <td>
                                        <a href="#">{{ $product->name." - ".$product->code  }}</a>
                                   </td>
                                   <td>{{ $item->warehouse->name }}</td>
                                   <td>{{ date('d/m/Y',strtotime($item->date)) }}</td>

                                   <td>
                                        {{ $product->readable_qty($item->qty) }}
                                   </td>
                                   <td>{{ $item->note }}</td>
                              </tr>
                              @endforeach
                         </tbody>
                    </table>
                    <div class="print_hidden">
                        {!! $transfers->appends(Request::except("_token"))->links() !!}
                    </div>
               </div>
               @else
               <div class="alert alert-danger" role="alert">
                    <strong>No Data Found!</strong>
               </div>
               @endif
          </div>

        </div>
     </div>
</div>
@endsection

@section('styles')
<style>
     .table tr td {
          vertical-align: middle;
          padding: 5px;
          text-align: center;
          font-weight: bold;
     }

     .table tr th {
          text-align: center;
     }


</style>
@endsection

@section('scripts')
<script>

</script>
@endsection
