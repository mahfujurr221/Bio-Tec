@extends('layouts.master')
@section('title', 'Sales Target')

@section('page-header')
    <header class="header bg-ui-general">
        <div class="header-info">
            <h1 class="header-title">
                <strong>Sales Target</strong>
            </h1>
        </div>

        <div class="header-action">
            <nav class="nav">
                <a class="nav-link" href="{{ route('sales-target.index') }}">
                    Sales Target
                </a>
                <a class="nav-link active" href="{{ route('sales-target.create') }}">
                    <i class="fa fa-plus"></i>
                    Add Sales Target
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
                    <h4 class="card-title" style="display: inline-block;">Add Sales Target</h4>

                    {{-- <a href="{{ route('product.add_category') }}" class="edit btn btn-info-outline float-right mt-2 ml-4"
          data-target="#edit" id="Add Category">Add Category</a> --}}

                </div>
            </div>


            <form action="{{ route('sales-target.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="">Member</label>
                          <select name="sales_member_id" id="" class="form-control" data-provide="selectpicker"
                          data-live-search="true" data-size="10"v>
                            <option value="">Select Salesman</option>
                            @foreach (\App\SalesMember::where('sales_designation_id',1)->get() as $item)
                              <option value="{{ $item->id }}" {{ old("sales_member_id")==$item->id?"SELECTED":"" }}>{{ $item->name }}</option>
                            @endforeach
                          </select>
                          @if($errors->has('sales_member_id'))
                            <div class="alert alert-danger">{{ $errors->first('sales_member_id') }}</div>
                          @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">Start Date</label>
                            <input type="text" data-provide="datepicker" data-date-today-highlight="true"
                                   data-orientation="bottom" data-date-format="yyyy-mm-dd" data-date-autoclose="true"
                                   class="form-control" name="start_date" placeholder="Start Date" autocomplete="off" value="{{ old('start_date',date('Y-m-d')) }}">
                        </div>

                    </div>

                    <hr>
                    <div class="form-row justify-content-center">
                        <div class="form-group ">
                            <button type="submit" class="btn btn-info">
                                <i class="fa fa-save"></i>
                                Add Target
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
