@extends('layouts.master')
@section('title', 'Create Sales Member')

@section('page-header')
    <header class="header bg-ui-general">
        <div class="header-info">
            <h1 class="header-title">
                <strong>New Member</strong>
            </h1>
        </div>
        <div class="header-action">
            <nav class="nav">
                <a class="nav-link" href="{{ route('sales-member.index') }}">
                    Sales Team
                </a>
                <a class="nav-link active" href="{{ route('sales-member.create') }}">
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
            <div class="row">
                <div class="col-12" style="">
                    <h4 class="card-title" style="display: inline-block;">New Member</h4>
                    {{-- <a href="{{ route('product.add_category') }}" class="edit btn btn-info-outline float-right mt-2 ml-4"
          data-target="#edit" id="Add Category">Add Category</a> --}}
                </div>
            </div>

            <form action="{{ route('sales-member.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                            @error('name')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">Mobile</label>
                            <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control">
                            @error('mobile')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Warehouse</label>
                                <select name="warehouse_id" id="warehouseId"
                                    class="form-control  {{ $errors->has('warehouse_id') ? 'is-invalid' : '' }}" required>
                                    <option value="">Select Warehouse</option>
                                    @foreach ($warehouses as $warehouse)
                                        <option value="{{ $warehouse->id }}"
                                            @if (auth()->user()->warehouse_id == $warehouse->id) selected @endif>
                                            {{ $warehouse->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('warehouse_id'))
                                    <div class="invalid-feedback">{{ $errors->first('warehouse_id') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sales Area</label>
                                <select name="sales_area_id" id="salesAreaId" required class="form-control">
                                    {{-- <option value="">Select Sales Area</option>
                                    @foreach ($salesArea as $area)
                                        <option {{ old('warehouse_id') == $area->id ? 'selected' : '' }}
                                            value="{{ $area->id }}">{{ $area->name }}</option>
                                    @endforeach --}}
                                </select>

                                {{-- @if ($errors->has('sales_area_id'))
                                    <div class="invalid-feedback">{{ $errors->first('sales_area_id') }}</div>
                                @endif --}}
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="">Address</label>
                            <textarea name="address" id="" cols="30" rows="4" class="form-control">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        @livewire('member-designation-supiror', ['designation_id' => old('sales_designation_id', 1), 'supirior_id' => old('supirior_id', 1)])
                    </div>
                    <hr>
                    <div class="form-row justify-content-center">
                        <div class="form-group ">
                            <button type="submit" class="btn btn-info">
                                <i class="fa fa-save"></i>
                                Add Member
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('styles')
    {{--
<link rel="stylesheet" href="{{ asset('back/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}"> --}}
    <style>
        .form-control {
            border-color: #b5b1b1;
        }

        label {
            font-size: 13px;
            font-weight: 600;
        }
    </style>
    @livewireStyles
@endsection

@section('scripts')

    <script src="{{ asset('js/modal_form_no_reload.js') }}"></script>

    @include('includes.placeholder_model')
    @livewireScripts
    <script>
        $(document).ready(function() {
            var role = "{{ auth()->user()->roles->first()->name }}";
            // alert(role);
            if (role == 'admin') {
                $('#warehouseId').on('change', function() {
                    var warehouseId = $(this).val();
                    var url = "{{ route('sales-area.show', ':id') }}";
                    url = url.replace(':id', warehouseId);

                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            $('#salesAreaId').empty();
                            $('#salesAreaId').append(
                                '<option value="">Select Sales Area</option>');
                            $.each(data, function(key, value) {
                                $('#salesAreaId').append(
                                    `<option value="${value.id}">                    
                                ${value.name}</option>`);
                            });
                        }
                    });
                });
            } else {
                //make warehouseId prevent from change 
                $('#warehouseId').attr('disabled', 'disabled');
                var warehouseId = $('#warehouseId').val();
                var url = "{{ route('sales-area.show', ':id') }}";
                url = url.replace(':id', warehouseId);

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        $('#salesAreaId').empty();
                        $('#salesAreaId').append('<option value="">Select Sales Area</option>');
                        $.each(data, function(key, value) {
                            $('#salesAreaId').append(
                                `<option value="${value.id}">                    
                            ${value.name}</option>`);
                        });
                    }
                });
            }
        });
    </script>
@endsection
