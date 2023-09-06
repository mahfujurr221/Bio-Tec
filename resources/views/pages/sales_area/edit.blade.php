@extends('layouts.master')
@section('title', 'Edit Sales Area')

@section('page-header')
    <header class="header bg-ui-general">
        <div class="header-info">
            <h1 class="header-title">
                <strong>Edit Sales Area</strong>
            </h1>
        </div>

        <div class="header-action">
            <nav class="nav">
                <a class="nav-link" href="{{ route('sales-area.index') }}">
                    Sales Area
                </a>
                <a class="nav-link active" href="#">
                    Edit Sales Area
                </a>
            </nav>
        </div>
    </header>
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <h4 class="card-title">Edit Sales Area</h4>

            <form action="{{ route('sales-area.update', $salesArea) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="">Name<span class="field_required"></span></label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                name="name" value="{{ $salesArea->name }}">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Warehouse</label>
                                <select name="warehouse_id"
                                    class="form-control {{ $errors->has('warehouse_id') ? 'is-invalid' : '' }}" required>
                                    <option value="">Select Warehouse</option>
                                    @foreach ($warehouses as $warehouse)
                                        <option value="{{ $warehouse->id }}"
                                            {{ $salesArea->warehouse_id == $warehouse->id ? 'selected' : '' }}>
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
                            <input type="submit" class="btn btn-success" value="Update">
                        </div>

                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

@section('styles')

@endsection

@section('scripts')

@endsection
