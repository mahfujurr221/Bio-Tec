@extends('layouts.master')
@section('title', 'Sales - Members')

@section('page-header')
    <header class="header bg-ui-general">
        <div class="header-info">
            <h1 class="header-title">
                <strong>Sales Target</strong>
            </h1>
        </div>

        <div class="header-action">
            <nav class="nav">
                <a class="nav-link active" href="{{ route('sales-target.index') }}">
                    Sales Target
                </a>
                <a class="nav-link" href="{{ route('sales-target.create') }}">
                    <i class="fa fa-plus"></i>
                    Add Target
                </a>
            </nav>
        </div>

    </header>
@endsection

@section('content')
    <div class="col-12">

        <div class="card">
            <h4 class="card-title"><strong>Sales Target</strong></h4>

            <div class="card-body card-body-soft">
                @if ($targets->count() > 0)
                    <div class="table-responsive table-bordered">
                        <table class="table table-soft">
                            <thead>
                                <tr class="bg-primary">
                                    <th>#</th>
                                    <th>Member</th>
                                    <th>Start Date</th>
                                    <th>12 Month Deadline</th>
                                    <th style="width:20%;">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($targets as $key => $target)
                                    <tr>
                                        <th scope="row">
                                            {{ $loop->iteration + $targets->perPage() * ($targets->currentPage() - 1) }}
                                        </th>

                                        <td>{{ $target->sales_member->name }}</td>
                                        <td>{{ $target->start_date }}</td>
                                        <td>{{ $target->twelve_month_date }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fa fa-cogs"></i>
                                                    Manage
                                                </button>
                                                <div class="dropdown-menu" x-placement="bottom-start">
                                                    {{-- <a class="dropdown-item"
                                                        href="{{ route('sales-target.edit', $target) }}">
                                                        <i class="fa fa-edit"></i>
                                                        Edit
                                                    </a> --}}

                                                    <a class="dropdown-item"
                                                        href="{{ route('sales-target.show', $target) }}">
                                                        <i class="fa fa-desktop"></i>
                                                        Show
                                                    </a>
                                                    <a class="dropdown-item delete"
                                                        href="{{ route('sales-target.destroy', $target) }}">
                                                        <i class="fa fa-trash"></i>
                                                        Delete
                                                    </a>
                                                </div>
                                            </div>
                                            {{-- sale-target report download --}}
                                            <a class="btn btn-primary" href="{{ route('sales-target.show', $target) }}">
                                                <i class="fa fa-download"></i>
                                                Sale Report
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $targets->links() }}
                    </div>
                @else
                    <div class="alert alert-danger" role="alert">
                        <strong>No Data Found.</strong>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@section('styles')

@endsection

@section('scripts')
    @include('includes.delete-alert')
@endsection
