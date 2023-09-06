@extends('layouts.master')
@section('title', 'Members Report')

@section('page-header')
    <header class="header bg-ui-general">
        <div class="header-info">
            <h1 class="header-title">
                <strong>Members Target Summary Report</strong>
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
            @if ($members->count() > 0)
                <div class="table-responsive table-bordered">
                    <table class="table table-soft text-center">
                        <thead>
                            <tr class="bg-primary">
                                <th>#</th>
                                <th>Member</th>
                                <th>Monthly Target</th>
                                <th>Yearly Target Amount</th>
                                @for ($month = 1; $month <= 12; $month++)
                                    <th>{{ date('M', mktime(0, 0, 0, $month, 1)) }}</th>
                                @endfor
                                <th>Achivement</th>
                                <th>Due of Target</th>
                                <th>Comission</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $key => $member)
                                <tr>
                                    <th scope="row">
                                        {{ $loop->iteration + $members->perPage() * ($members->currentPage() - 1) }}
                                    </th>
                                    <td>{{ $member->name }} ({{ $member->designation->name }})</td>
                                    <td>
                                        @if ($member->designation->name == 'MPO')
                                            {{ number_format($member->getTwelveMonthsAmount() / 12, 2) }}
                                        @elseif ($member->designation->name == 'TM')
                                            {{ number_format($member->getTwelveMonthsAmountByTM($member->id) / 12, 2) }}
                                        @elseif ($member->designation->name == 'JR. RSM')
                                            {{ number_format($member->getTwelveMonthsAmountByJRSM($member->id) / 12, 2) }}
                                        @elseif ($member->designation->name == 'RSM')
                                            {{ number_format($member->getTwelveMonthsAmountByRSM($member->id) / 12, 2) }}
                                        @elseif ($member->designation->name == 'ASM')
                                            {{ number_format($member->getTwelveMonthsAmountByASM($member->id) / 12, 2) }}
                                        @elseif ($member->designation->name == 'NSM')
                                            {{ number_format($member->getTwelveMonthsAmountByNSM($member->id) / 12, 2) }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($member->designation->name == 'MPO')
                                            {{ number_format($member->getTwelveMonthsAmount(), 2) }}
                                        @elseif ($member->designation->name == 'TM')
                                            {{ number_format($member->getTwelveMonthsAmountByTM($member->id), 2) }}
                                        @elseif ($member->designation->name == 'JR. RSM')
                                            {{ number_format($member->getTwelveMonthsAmountByJRSM($member->id), 2) }}
                                        @elseif ($member->designation->name == 'RSM')
                                            {{ number_format($member->getTwelveMonthsAmountByRSM($member->id), 2) }}
                                        @elseif ($member->designation->name == 'ASM')
                                            {{ number_format($member->getTwelveMonthsAmountByASM($member->id), 2) }}
                                        @elseif ($member->designation->name == 'NSM')
                                            {{ number_format($member->getTwelveMonthsAmountByNSM($member->id), 2) }}
                                        @endif
                                    </td>
                                    @for ($month = 1; $month <= 12; $month++)
                                        <td>
                                            @if ($member->designation->name == 'MPO')
                                                {{ $member->getMonthAmount($member->id, $month) }}
                                            @elseif ($member->designation->name == 'TM')
                                                {{ $member->getMonthAmountByTM($member->id, $month) }}
                                            @elseif ($member->designation->name == 'JR. RSM')
                                                {{ $member->getMonthAmountByJRSM($member->id, $month) }}
                                            @elseif ($member->designation->name == 'RSM')
                                                {{ $member->getMonthAmountByRSM($member->id, $month) }}
                                            @elseif ($member->designation->name == 'ASM')
                                                {{ $member->getMonthAmountByASM($member->id, $month) }}
                                            @elseif ($member->designation->name == 'NSM')
                                                {{ $member->getMonthAmountByNSM($member->id, $month) }}
                                            @endif
                                        </td>
                                    @endfor
                                    <td>
                                        @if ($member->designation->name == 'MPO')
                                            {{ number_format($member->getTwelveMonthsSaleAmount(), 2) }}
                                        @elseif ($member->designation->name == 'TM')
                                            {{ number_format($member->getTwelveMonthsSaleAmountByTM($member->id), 2) }}
                                        @elseif ($member->designation->name == 'JR. RSM')
                                            {{ number_format($member->getTwelveMonthsSaleAmountByJRSM($member->id), 2) }}
                                        @elseif ($member->designation->name == 'RSM')
                                            {{ number_format($member->getTwelveMonthsSaleAmountByRSM($member->id), 2) }}
                                        @elseif ($member->designation->name == 'ASM')
                                            {{ number_format($member->getTwelveMonthsSaleAmountByASM($member->id), 2) }}
                                        @elseif ($member->designation->name == 'NSM')
                                            {{ number_format($member->getTwelveMonthsSaleAmountByNSM($member->id), 2) }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($member->designation->name == 'MPO')
                                            {{ number_format($member->getTwelveMonthsAmount() - $member->getTwelveMonthsSaleAmount(), 2) }}
                                        @elseif ($member->designation->name == 'TM')
                                            {{ number_format($member->getTwelveMonthsAmountByTM($member->id) - $member->getTwelveMonthsSaleAmountByTM($member->id), 2) }}
                                        @elseif ($member->designation->name == 'JR. RSM')
                                            {{ number_format($member->getTwelveMonthsAmountByJRSM($member->id) - $member->getTwelveMonthsSaleAmountByJRSM($member->id), 2) }}
                                        @elseif ($member->designation->name == 'RSM')
                                            {{ number_format($member->getTwelveMonthsAmountByRSM($member->id) - $member->getTwelveMonthsSaleAmountByRSM($member->id), 2) }}
                                        @elseif ($member->designation->name == 'ASM')
                                            {{ number_format($member->getTwelveMonthsAmountByASM($member->id) - $member->getTwelveMonthsSaleAmountByASM($member->id), 2) }}
                                        @elseif ($member->designation->name == 'NSM')
                                            {{ number_format($member->getTwelveMonthsAmountByNSM($member->id) - $member->getTwelveMonthsSaleAmountByNSM($member->id), 2) }}
                                        @endif
                                    </td>
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
