@extends('layouts.master')
@section('title', 'Sales - Members')
@section('page-header')
    <header class="header bg-ui-general">
        <div class="header-info">
            <h1 class="header-title">
                {{ $target->sales_member->designation->name }}: {{ $target->sales_member->name }}'s Target Report
            </h1>
        </div>
    </header>
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="card containing-card col-12">
                    <div class="card-header ">
                        <h3 class="card-title ">Detailed Report</h3>
                    </div>
                    <div class="card-body">
                        <div class="grid-of-4">
                            <div class="card card-body bg-primary">
                                <h6 class="text-white text-uppercase">Total Target Product (year)</h6>
                                <p class="fs-18 fw-700">
                                    {{ $target->getTwelveMonthsQuantity() }} pc
                                </p>
                            </div>
                            <div class="card card-body bg-warning">
                                <h6 class="text-white text-uppercase">Total Product Sale (year)</h6>
                                <p class="fs-18 fw-700">
                                    {{ $target->getTwelveMonthsSaleQuantity() }} pc
                                </p>
                            </div>
                            <div class="card card-body bg-pink">
                                <h6 class="text-white text-uppercase">Total Target Amount (year)</h6>
                                <p class="fs-18 fw-700">৳
                                    {{ $target->getTwelveMonthsAmount() }} taka
                                </p>
                            </div>
                            <div class="card card-body bg-success">
                                <h6 class="text-white text-uppercase">Total Target Amount (year)</h6>
                                <p class="fs-18 fw-700">৳
                                    {{ $target->getTwelveMonthsSaleAmount() }} taka
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body card-body-soft mb-5">
            @if ($productTargets->count() > 0)
                <div class="table-responsive table-bordered">
                    <table class="table table-soft">
                        <thead>
                            <tr class="bg-primary">
                                <th>#</th>
                                <th>Product</th>
                                <th>Yearly Target</th>
                                <th>Yearly Target Amount</th>
                                <th>Monthly Target</th>
                                <th>Monthly Target Amount</th>
                                {{-- <th>Total Product Sale(Yearly)</th> --}}
                                {{-- <th>Total Product Sale Amount(Yearly)</th> --}}
                                {{-- <th>Month Running</th> --}}
                                <th>Monthly Sale Quantity</th>
                                <th>Monthly Sale Amount</th>
                                <th>Due of target</th>
                                <th>Comission</th>
                                <th>Over Achivement</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalComission = 0;
                                $totalDue = 0;
                            @endphp
                            @foreach ($productTargets as $key => $target)
                                <tr>
                                    <th scope="row">
                                        {{ $loop->iteration + $productTargets->perPage() * ($productTargets->currentPage() - 1) }}
                                    </th>
                                    <td>{{ $target->product->name }}</td>
                                    <td>{{ $target->twelve_month_quantity }}pc</td>
                                    <td>{{ number_format($target->twelve_month_quantity * $target->product->price, 2) }}tk
                                    <td>{{ round($target->twelve_month_quantity / 12) }}pc</td>
                                    <td>{{ number_format(($target->twelve_month_quantity / 12) * $target->product->price, 2) }}
                                        tk</td>
                                    {{-- <td>{{ $target->getTwelveMonthsSaleQuantityByProduct() }}pc</td> --}}
                                    {{-- <td>{{ number_format($target->getTwelveMonthsSaleAmountByProduct(),2) }}tk</td> --}}
                                    {{-- <td>{{ $target->getMonthRunning() }}pc</td> --}}
                                    <td>{{ $target->getThisMonthSaleQuantity() }}pc</td>
                                    <td>{{ number_format($target->getThisMonthSaleAmount(), 2) }}tk</td>
                                    {{-- total target amount- this month sale amount --}}
                                    <td>{{ $target->getDue($target->product->id, $target->sales_target->sales_member_id) }}tk
                                    <td>{{ $target->getCommission() }}tk</td>
                                    {{-- <td>{{ $target->getDue($target->product->id, $target->sales_target->sales_member_id) }}tk --}}
                                    </td>
                                    <td>{{ $target->getOverAchievedAmount() }}tk</td>
                                </tr>
                                @php
                                    $totalComission += $target->getCommission();
                                    $totalDue += $target->getDue($target->product->id, $target->sales_target->sales_member_id);
                                @endphp
                            @endforeach
                            <tr>
                                <th colspan="8" class="text-right">Total</th>
                                <th class="font-weight-bold">{{ number_format($totalComission) }}tk</th>
                                <th class="font-weight-bold">{{ number_format($totalDue) }}tk</th>
                                <th></th>
                        </tbody>
                    </table>
                    {{ $productTargets->links() }}
                </div>
            @else
                <div class="alert alert-danger" role="alert">
                    <strong>No Data Found.</strong>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('styles')
    <style>
        .main-content {
            padding-top: 25px;
        }

        @media (min-width: 250px) {
            .grid-of-5 {
                width: 100%;
                display: grid;
                grid-template-columns: repeat(2, minmax(100px, auto));
                grid-column-gap: 1.5%;
            }

            .grid-of-4 {
                width: 100%;
                display: grid;
                grid-template-columns: repeat(2, minmax(100px, auto));
                grid-column-gap: 1.5%;
            }
        }

        @media (min-width: 768px) {
            .grid-of-5 {
                width: 100%;
                display: grid;
                grid-template-columns: repeat(4, minmax(100px, 1fr));
                grid-column-gap: 1.5%;
            }

            .grid-of-4 {
                width: 100%;
                display: grid;
                grid-template-columns: repeat(4, minmax(100px, 1fr));
                grid-column-gap: 1.5%;
            }
        }

        @media (min-width: 992px) {
            .grid-of-5 {
                width: 100%;
                display: grid;
                grid-template-columns: repeat(5, minmax(100px, 1fr));
                grid-column-gap: 1.5%;
            }
        }

        .grid-of-2 {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(2, minmax(100px, 1fr));
            grid-column-gap: 1.5%;
        }

        .card .card {
            margin-bottom: 10px;
        }

        .containing-card>.card-body {
            padding: 10px;
        }

        .card-header {
            padding: 5px;
        }
    </style>
@endsection

@section('scripts')
    @include('includes.delete-alert')
@endsection
