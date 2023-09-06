@extends('layouts.master')
@section('title', 'Transfer Stock')

@section('page-header')
    <header class="header bg-ui-general">
        <div class="header-info">
            <h1 class="header-title">
                <strong>Transfer Stock</strong>
            </h1>
        </div>
    </header>
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="card-title" style="display: inline-block">Transfer Stock</h4>
                </div>
            </div>
            <form action="{{ route('stock.transfer_stock') }}" method="POST" onkeydown="return event.key != 'Enter';">
                @csrf
                <div class="card-body">
                    <div class="form-row">

                        <div class="form-group col-6">
                            <label for="">Transfer To</label>
                            <select name="to_warehouse" id="" class="form-control"
                                @if (auth()->user()->hasRole('WarehouseAdmin')) disabled @endif>
                                @foreach (\App\Warehouse::where('is_default', 0)->get() as $item)
                                    <option value="{{ $item->id }}" @if (auth()->user()->warehouse_id == $item->id) SELECTED @endif>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('to_warehouse'))
                                <div class="alert alert-danger">{{ $errors->first('to_warehouse') }}</div>
                            @endif
                        </div>
                        <div class="form-group col-6">
                            <label for="Product">Product</label>
                            <input type="text" id="product_search" class="form-control" placeholder="Write product."
                                onkeydown="return event.keyCode !== 13">
                        </div>
                        <hr>
                        <div class="form-group col-6">
                            <label for="">Date</label>
                            <input type="text" data-provide="datepicker" data-date-today-highlight="true"
                                data-date-format="yyyy-mm-dd" class="form-control" name="date"
                                value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group col-6">
                            <label for="">Note</label>
                            <textarea name="note" id="" cols="30" rows="2" class="form-control">{{ old('note') }}</textarea>
                        </div>
                        <div class="col-12 mt-5">
                            <div class="row">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th style="width:80px">#SL</th>
                                            <th>Product</th>
                                            <th>Rate</th>
                                            <th style="width:320px;">Qty</th>
                                            <th>Sub Total</th>
                                            <th style="width:50px">
                                                <i class="fa fa-trash"></i>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_body">

                                    </tbody>
                                    <tfoot class="bg-light">
                                        <tr>
                                            <td colspan="3"></td>
                                            <td>
                                                <span>Total Qty: </span> <span id="total_qty">0</span>
                                            </td>
                                            <td colspan="2">
                                                <strong>Grand Total: <span id="total">0</span> TK</strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12 mt-4">
                                <button type="submit" class="btn btn-primary mx-auto">
                                    <i class="fa fa-money"></i>
                                    Trsnasfer Stock
                                </button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .table tr td {
            text-align: center;
            vertical-align: baseline;
            padding: 4px;
        }

        .table tr th {
            text-align: center;
            padding: 5px;
        }

        .table tr td input {
            text-align: center;
        }

        .header {
            margin-bottom: 10px;
        }

        .main-content {
            padding-top: 10px;
        }
    </style>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    @include('pages.stock.script')
    <script src="{{ asset('js/modal_form.js') }}"></script>
@endsection
