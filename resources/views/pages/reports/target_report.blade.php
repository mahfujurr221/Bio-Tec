@extends('layouts.master')
@section('title', 'Members Report')

@section('page-header')
    <header class="header bg-ui-general">
        <div class="header-info">
            <h1 class="header-title">
                <strong>Members Report</strong>
            </h1>
        </div>
    </header>
@endsection

@section('content')
    <div class="col-12">
        <div class="card card-body mb-2 print_hidden">
            <form action="{{ route('target_report') }}">
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
                </div>
                <div class="form-row mt-2">
                    <div class="form-group float-right">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-sliders"></i>
                            Filter
                        </button>
                        <a href="{{ route('target_report') }}" class="btn btn-info">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card-body card-body-soft">
        @if ($members->count() > 0)
            <div class="table-responsive table-bordered">
                <table class="table table-soft">
                    <thead>
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
                    </thead>
                    <tbody>
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
                                            @if ($member->designation->name == 'MPO')
                                                <a class="dropdown-item"
                                                    href="{{ route('daily_invoice.invoice', $member->id) }}">
                                                    <i class="fa fa-edit"></i>
                                                    Todays Invoice
                                                </a>
                                            @endif
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
