@extends('layouts.master')
@section('title', 'Sales Area')

@section('page-header')
    <header class="header bg-ui-general">
        <div class="header-info">
            <h1 class="header-title">
                <strong>Sales Area</strong>
            </h1>
        </div>

        <div class="header-action">
            <nav class="nav">
                <a class="nav-link active" href="{{ route('sales-area.index') }}">
                    Sales Area
                </a>
            </nav>
        </div>

    </header>
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <h4 class="card-title">Add Sales Area</h4>
            <div class="card-body">
                <form action="{{ route('sales-area.store') }}" method="POST" class="form-row">
                    @csrf
                    <div class="form-group col-md-4">
                        <label for="">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                        @if ($errors->has('name'))
                            <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Warehouse</label>
                            <select name="warehouse_id"
                                class="form-control {{ $errors->has('warehouse_id') ? 'is-invalid' : '' }}" required>
                                <option value="">Select Warehouse</option>
                                @foreach ($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}" {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                        {{ $warehouse->name }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($errors->has('warehouse_id'))
                                <div class="invalid-feedback">{{ $errors->first('warehouse_id') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-2" style="margin: 31px 0px 0px 5px;">
                        <input type="submit" class="btn btn-success" value="Add Area">
                    </div>
                </form>
            </div>
        </div>


        <div class="card">
            <h4 class="card-title"><strong>Sales Area</strong></h4>

            <div class="card-body card-body-soft">
                @if ($salesAreas->count() > 0)
                    <div class="table-responsive table-bordered">
                        <table class="table table-soft">
                            <thead>
                                <tr class="bg-primary">
                                    <th>#</th>
                                    <th>Area Name</th>
                                    <th>Warehouse Name</th>
                                    <th style="width:20%;">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($salesAreas as $key => $area)
                                    <tr>
                                        <th scope="row">
                                            {{ $loop->iteration + $salesAreas->perPage() * ($salesAreas->currentPage() - 1) }}
                                        </th>

                                        <td>{{ $area->name }}</td>
                                        <td>{{ $area->warehouse->name }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fa fa-cogs"></i>
                                                    Manage
                                                </button>
                                                <div class="dropdown-menu" x-placement="bottom-start">
                                                    <a class="dropdown-item"
                                                        href="{{ route('sales-area.edit', $area->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                        Edit
                                                    </a>
                                                    <a class="dropdown-item delete"
                                                        href="{{ route('sales-area.destroy', $area->id) }}">
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
                        {{ $salesAreas->links() }}
                    </div>
                @else
                    <div class="alert alert-danger" role="alert">
                        <strong>No Sales Area Found.</strong>
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
