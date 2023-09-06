@extends('layouts.master')
@section('title', 'Sales - Members')

@section('page-header')
    <header class="header bg-ui-general">
        <div class="header-info">
            <h1 class="header-title">
                <strong>Sales Team</strong>
            </h1>
        </div>

        <div class="header-action">
            <nav class="nav">
                <a class="nav-link active" href="{{ route('sales-member.index') }}">
                    Sales Team
                </a>
                <a class="nav-link" href="{{ route('sales-member.create') }}">
                    <i class="fa fa-plus"></i>
                    Add Member
                </a>
            </nav>
        </div>

    </header>
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <h4 class="card-title"><strong>Sales Team</strong></h4>

            <div class="card-body card-body-soft">
                @if ($members->count() > 0)
                    <div class="table-responsive table-bordered">
                        <table class="table table-soft">
                            <thead>
                                <tr class="bg-primary">
                                    <th>#</th>
                                    <th>Member</th>
                                    <th>Designation</th>
                                    <th>Warehouse</th>
                                    <th>Supirior</th>
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
                                        <td>{{ $member->warehouse->name }}</td>
                                        <td>{{ $member->supirior ? $member->supirior->name : '' }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fa fa-cogs"></i>
                                                    Manage
                                                </button>
                                                <div class="dropdown-menu" x-placement="bottom-start">
                                                    <a class="dropdown-item"
                                                        href="{{ route('sales-member.edit', $member->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                        Edit
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
    </div>

@endsection

@section('scripts')
    @include('includes.delete-alert')
@endsection
