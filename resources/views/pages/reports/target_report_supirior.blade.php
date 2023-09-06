@extends('layouts.master')
@section('title', 'Sales - Members')

@section('page-header')
    <header class="header bg-ui-general">
        <div class="header-info">
            <h1 class="header-title">
                {{ $supirior->designation->name }} : {{ $supirior->name }}'s Target Report
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
                                <h6 class="text-white text-uppercase">Total Member</h6>
                                <p class="fs-18 fw-700">
                                    {{ $members->count() }}
                                </p>
                            </div>
                            <div class="card card-body bg-primary">
                                <h6 class="text-white text-uppercase">Total Target Product (year)</h6>
                                <p class="fs-18 fw-700">
                                    @if ($supirior->designation->name == 'TM')
                                        {{ $supirior->getTwelveMonthsQuantityByTM($supirior->id) }} pc
                                    @elseif ($supirior->designation->name == 'JR. RSM')
                                        {{ $supirior->getTwelveMonthsQuantityByJRSM($supirior->id) }} pc
                                    @elseif($supirior->designation->name == 'RSM')
                                        {{ $supirior->getTwelveMonthsQuantityByRSM($supirior->id) }} pc
                                    @elseif($supirior->designation->name == 'ASM')
                                        {{ $supirior->getTwelveMonthsQuantityByASM($supirior->id) }} pc
                                    @elseif ($supirior->designation->name == 'NSM')
                                        {{ $supirior->getTwelveMonthsQuantityByNSM($supirior->id) }} pc
                                    @endif
                                </p>
                            </div>
                            <div class="card card-body bg-warning">
                                <h6 class="text-white text-uppercase">Total Product Sale (year)</h6>
                                <p class="fs-18 fw-700">
                                    @if ($supirior->designation->name == 'TM')
                                        {{ $supirior->getTwelveMonthsSaleQuantityByTM($supirior->id) }} pc
                                    @elseif ($supirior->designation->name == 'JR. RSM')
                                        {{ $supirior->getTwelveMonthsSaleQuantityByJRSM($supirior->id) }} pc
                                    @elseif($supirior->designation->name == 'RSM')
                                        {{ $supirior->getTwelveMonthsSaleQuantityByRSM($supirior->id) }} pc
                                    @elseif($supirior->designation->name == 'ASM')
                                        {{ $supirior->getTwelveMonthsSaleQuantityByASM($supirior->id) }} pc
                                    @elseif ($supirior->designation->name == 'NSM')
                                        {{ $supirior->getTwelveMonthsSaleQuantityByNSM($supirior->id) }} pc
                                    @endif
                                </p>
                            </div>
                            <div class="card card-body bg-pink">
                                <h6 class="text-white text-uppercase">Total Target Amount (year)</h6>
                                <p class="fs-18 fw-700">৳
                                    @if ($supirior->designation->name == 'TM')
                                        {{ $supirior->getTwelveMonthsAmountByTM($supirior->id) }} taka
                                    @elseif ($supirior->designation->name == 'JR. RSM')
                                        {{ $supirior->getTwelveMonthsAmountByJRSM($supirior->id) }} taka
                                    @elseif($supirior->designation->name == 'RSM')
                                        {{ $supirior->getTwelveMonthsAmountByRSM($supirior->id) }} taka
                                    @elseif($supirior->designation->name == 'ASM')
                                        {{ $supirior->getTwelveMonthsAmountByASM($supirior->id) }} taka
                                    @elseif ($supirior->designation->name == 'NSM')
                                        {{ $supirior->getTwelveMonthsAmountByNSM($supirior->id) }} taka
                                    @endif
                                </p>
                            </div>
                            <div class="card card-body bg-success">
                                <h6 class="text-white text-uppercase">Total Sale Amount (year)</h6>
                                <p class="fs-18 fw-700">৳
                                    @if ($supirior->designation->name == 'TM')
                                        {{ $supirior->getTwelveMonthsSaleAmountByTM($supirior->id) }} taka
                                    @elseif ($supirior->designation->name == 'JR. RSM')
                                        {{ $supirior->getTwelveMonthsSaleAmountByJRSM($supirior->id) }} taka
                                    @elseif($supirior->designation->name == 'RSM')
                                        {{ $supirior->getTwelveMonthsSaleAmountByRSM($supirior->id) }} taka
                                    @elseif($supirior->designation->name == 'ASM')
                                        {{ $supirior->getTwelveMonthsSaleAmountByASM($supirior->id) }} taka
                                    @elseif ($supirior->designation->name == 'NSM')
                                        {{ $supirior->getTwelveMonthsSaleAmountByNSM($supirior->id) }} taka
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body card-body-soft">
            @if ($members->count() > 0)
                <div class="table-responsive table-bordered">
                    <table class="table table-soft">
                        <thead>
                            <tr class="bg-primary">
                            <tr class="bg-primary">
                                <th>#</th>
                                <th>Member</th>
                                <th>Designation</th>
                                <th>Supirior</th>
                                <th>Total Target(Yearly)</th>
                                <th>Total Target Amount(Yearly)</th>
                                <th>Total Product Sale(Yearly)</th>
                                <th>Total Product Sale Amount(Yearly)</th>
                                <th style="width:20%;">#</th>
                            </tr>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($targets as $key => $target)
                                <tr>
                                    <th scope="row">
                                        {{ $loop->iteration + $targets->perPage() * ($targets->currentPage() - 1) }}
                                    </th>
                                    <td>{{ $target->product->name }}</td>
                                    <td>{{ $target->twelve_month_quantity }}pc</td>
                                    <td>{{ round($target->twelve_month_quantity / 12) }}pc</td>
                                    <td>{{ $target->getTwelveMonthsAmountByProduct() }} taka</td>
                                    <td>{{ round($target->getTwelveMonthsAmountByProduct() / 12) }} taka</td>
                                    <td>{{ $target->getTwelveMonthsSaleQuantityByProduct() }} pc</td>
                                    <td>{{ $target->getTwelveMonthsSaleAmountByProduct() }} taka</td>
                                    <td>{{ $target->getTargetMonthCount() }}</td>
                                    <td>{{ $target->getCommission() }} taka</td>
                                </tr>
                            @endforeach --}}
                            @foreach ($members as $key => $member)
                                <tr>
                                    <th scope="row">
                                        {{ $loop->iteration + $members->perPage() * ($members->currentPage() - 1) }}
                                    </th>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->designation->name }}</td>
                                    <td>{{ $member->supirior ? $member->supirior->name : '' }}</td>
                                    <td>
                                        @if ($member->designation->name == 'MPO')
                                            {{ $member->getTwelveMonthsQuantity() }} pc
                                        @elseif ($member->designation->name == 'TM')
                                            {{ $member->getTwelveMonthsQuantityByTM($member->id) }} pc
                                        @elseif ($member->designation->name == 'JR. RSM')
                                            {{ $member->getTwelveMonthsQuantityByJRSM($member->id) }} pc
                                        @elseif ($member->designation->name == 'RSM')
                                            {{ $member->getTwelveMonthsQuantityByRSM($member->id) }} pc
                                        @elseif ($member->designation->name == 'ASM')
                                            {{ $member->getTwelveMonthsQuantityByASM($member->id) }} pc
                                        @elseif ($member->designation->name == 'NSM')
                                            {{ $member->getTwelveMonthsQuantityByNSM($member->id) }} pc
                                        @endif
                                    </td>
                                    {{-- <td>{{ $member->getTwelveMonthsAmount() }} Taka</td> --}}
                                    <td>
                                        @if ($member->designation->name == 'MPO')
                                            {{ $member->getTwelveMonthsAmount() }} Taka
                                        @elseif ($member->designation->name == 'TM')
                                            {{ $member->getTwelveMonthsAmountByTM($member->id) }} Taka
                                        @elseif ($member->designation->name == 'JR. RSM')
                                            {{ $member->getTwelveMonthsAmountByJRSM($member->id) }} Taka
                                        @elseif ($member->designation->name == 'RSM')
                                            {{ $member->getTwelveMonthsAmountByRSM($member->id) }} Taka
                                        @elseif ($member->designation->name == 'ASM')
                                            {{ $member->getTwelveMonthsAmountByASM($member->id) }} Taka
                                        @elseif ($member->designation->name == 'NSM')
                                            {{ $member->getTwelveMonthsAmountByNSM($member->id) }} Taka
                                        @endif
                                    </td>
                                    {{-- <td>{{ $member->getTwelveMonthsSaleQuantity() }}pc</td> --}}
                                    <td>
                                        @if ($member->designation->name == 'MPO')
                                            {{ $member->getTwelveMonthsSaleQuantity() }} pc
                                        @elseif ($member->designation->name == 'TM')
                                            {{ $member->getTwelveMonthsSaleQuantityByTM($member->id) }} pc
                                        @elseif ($member->designation->name == 'JR. RSM')
                                            {{ $member->getTwelveMonthsSaleQuantityByJRSM($member->id) }} pc
                                        @elseif ($member->designation->name == 'RSM')
                                            {{ $member->getTwelveMonthsSaleQuantityByRSM($member->id) }} pc
                                        @elseif ($member->designation->name == 'ASM')
                                            {{ $member->getTwelveMonthsSaleQuantityByASM($member->id) }} pc
                                        @elseif ($member->designation->name == 'NSM')
                                            {{ $member->getTwelveMonthsSaleQuantityByNSM($member->id) }} pc
                                        @endif
                                    </td>
                                    {{-- <td>{{ $member->getTwelveMonthsSaleAmount() }} Taka</td> --}}
                                    <td>
                                        @if ($member->designation->name == 'MPO')
                                            {{ $member->getTwelveMonthsSaleAmount() }} Taka
                                        @elseif ($member->designation->name == 'TM')
                                            {{ $member->getTwelveMonthsSaleAmountByTM($member->id) }} Taka
                                        @elseif ($member->designation->name == 'JR. RSM')
                                            {{ $member->getTwelveMonthsSaleAmountByJRSM($member->id) }} Taka
                                        @elseif ($member->designation->name == 'RSM')
                                            {{ $member->getTwelveMonthsSaleAmountByRSM($member->id) }} Taka
                                        @elseif ($member->designation->name == 'ASM')
                                            {{ $member->getTwelveMonthsSaleAmountByASM($member->id) }} Taka
                                        @elseif ($member->designation->name == 'NSM')
                                            {{ $member->getTwelveMonthsSaleAmountByNSM($member->id) }} Taka
                                        @endif
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa fa-cogs"></i>
                                                Manage
                                            </button>
                                            <div class="dropdown-menu" x-placement="bottom-start">
                                                <a class="dropdown-item"
                                                    href="{{ route('target_report.member', $member->id) }}">
                                                    <i class="fa fa-edit"></i>
                                                    Report Details
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('daily_invoice.invoice', $member->id) }}">
                                                    <i class="fa fa-edit"></i>
                                                    Todays Invoice
                                                </a>
                                                <a class="dropdown-item delete"
                                                    href="{{ route('sales-member.destroy', $member->id) }}">
                                                    <i class="fa fa-trash"></i>
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $members->links() }}
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
