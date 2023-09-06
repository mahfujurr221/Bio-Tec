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
            <form action="">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <input type="date" name="from_date" id="" class="form-control"
                            value="{{ request()->from_date }}">
                    </div>
                    <div class="form-group col-md-3">
                        <input type="date" name="to_date" id="" class="form-control"
                            value="{{ request()->to_date }}">
                    </div>
                </div>
                <div class="form-row mt-2">
                    <div class="form-group float-right">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-sliders"></i>
                            Filter
                        </button>
                        <a href="{{ route('target_report.daily_sale_collection') }}" class="btn btn-secondary">
                            <i class="fa fa-redo"></i>
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card-body card-body-soft">
            {{-- @if ($members->count() > 0) --}}
            <div class="table-responsive table-bordered">
                <table class="table table-soft">
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
                                <td>
                                    {{ $loop->index + 1 }}
                                </td>
                                <td>
                                    {{ $member->name }}
                                </td>
                                @foreach ($targeted_products as $product)
                                    <td>
                                        {{ $product->allMembersSaleQuantity($product->product_id, $member->id) }}
                                        @php
                                            $totalAmount += $product->allMembersSaleAmount($product->product_id, $member->id);
                                            $quantity = $product->allMembersSaleQuantity($product->product_id, $member->id);
                                            if (array_key_exists($product->product_id, $totalQuantities)) {
                                                $totalQuantities[$product->product_id] += $quantity;
                                            } else {
                                                $totalQuantities[$product->product_id] = $quantity;
                                            }
                                        @endphp
                                    </td>
                                @endforeach
                                <td>
                                    {{ $totalAmount }} taka
                                </td>
                            </tr>
                            @php
                                $grandTotalAmount += $totalAmount;
                            @endphp
                        @endforeach
                    </tbody>
                    <tr>
                        <td colspan="2" class="text-right"><b>Grand Total</b></td>
                        @foreach ($targeted_products as $product)
                            <td><b>{{ $totalQuantities[$product->product_id] ?? 0 }} pc</b></td>
                        @endforeach
                        <td><b>{{ $grandTotalAmount }} taka</b></td>
                    </tr>
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
