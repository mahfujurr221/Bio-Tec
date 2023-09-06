@extends('layouts.master')
@section('title', 'Add Stock')

@section('page-header')
    <header class="header bg-ui-general">
        <div class="header-info">
            <h1 class="header-title">
                <strong>Purchase</strong>
            </h1>
        </div>

        <div class="header-action">
            <nav class="nav">
                <a class="nav-link" href="{{ route('stock.index') }}">
                    Purchases
                </a>
                <a class="nav-link active" href="{{ route('stock.index') }}">
                    <i class="fa fa-plus"></i>
                    Add Stock
                </a>
            </nav>
        </div>

    </header>
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="card-title" style="display: inline-block">Add Stock</h4>
                </div>
            </div>
            <form action="{{ route('stock.add_stock') }}" method="POST" onkeydown="return event.key != 'Enter';">
                @csrf
                <div class="card-body">
                    <div class="form-row">
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
                        <div class="form-group col-12">
                            <label for="">Note</label>
                            <textarea name="note" id="" cols="30" rows="4" class="form-control">{{ old('note') }}</textarea>
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
                                    Add Stock
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
