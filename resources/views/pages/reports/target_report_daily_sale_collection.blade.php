@extends('layouts.master')
@section('title', 'Daily Sales and Collection Report')

@section('page-header')
    <header class="header bg-ui-general">
        <div class="header-info">
            <h1 class="header-title">
                <strong>Daily Sales and Collection Report</strong>
            </h1>
        </div>
    </header>
@endsection
@section('content')
    <div class="col-12">
        <div class="card card-body mb-2 print_hidden">
            <form action="{{ route('target_summary') }}">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <select name="designation_id" id="" class="form-control" data-provide="selectpicker"
                            data-live-search="true" data-size="10">
                            <option value="">Designation</option>
                            @foreach (\App\SalesDesignation::all() as $item)
                                <option value="{{ $item->id }}"
                                    {{ request()->designation_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <select name="member_id" id="" class="form-control" data-provide="selectpicker"
                            data-live-search="true" data-size="10">
                            <option value="">Select a Member</option>
                            @foreach (\App\SalesMember::all() as $item)
                                <option value="{{ $item->id }}"
                                    {{ request()->member_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <select name="area_id" id="" class="form-control" data-provide="selectpicker"
                            data-live-search="true" data-size="10">
                            <option value="">Select Area</option>
                            @foreach (\App\SalesArea::all() as $item)
                                <option value="{{ $item->id }}" {{ request()->area_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row mt-2">
                    <div class="form-group float-right">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-sliders"></i>
                            Filter
                        </button>
                        <a href="{{ route('target_summary') }}" class="btn btn-info">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card-body card-body-soft">
            {{-- @if ($members->count() > 0) --}}
            <div class="table-responsive table-bordered">
                <table class="table table-soft text-center">
                    <thead>
                        <tr class="bg-primary">
                            <th>#</th>
                            <th>Member</th>
                            @foreach ($targeted_products as $product)
                                <th>{{ $product->product->code }}</th>
                            @endforeach
                            <th>Total</th>
                        </tr>
                    </thead>
                    @php
                        $grandTotalAmount = 0;
                        $totalQuantities = [];
                    @endphp
                    <tbody>
                        @foreach ($members as $member)
                            @php
                                $totalAmount = 0;
                            @endphp
                            <tr>
                                <td></td>
                                <td>
                                    {{ $member->name }}
                                </td>
                                @foreach ($targeted_products as $product)
                                    <td>
                                        {{ $product->todaySaleQuantity($product->product_id, $item->customer_id) }}
                                        @php
                                            $totalAmount += $product->todaySaleAmount($product->product_id, $item->customer_id);
                                            $quantity = $product->todaySaleQuantity($product->product_id, $item->customer_id);
                                            if (array_key_exists($product->product_id, $totalQuantities)) {
                                                $totalQuantities[$product->product_id] += $quantity;
                                            } else {
                                                $totalQuantities[$product->product_id] = $quantity;
                                            }
                                        @endphp
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tr>
                    </tbody>
                </table>
                {{-- {{ $members->links() }} --}}
            </div>
            {{-- @else
            <div class="alert alert-danger" role="alert">
                <strong>No Data Found.</strong>
            </div>
            @endif --}}
        </div>
    </div>
@endsection

@section('styles')
    <style>
        @media print {

            table,
            table th,
            table td {
                color: black !important;
            }
        }
    </style>
@endsection

@section('scripts')

@endsection
