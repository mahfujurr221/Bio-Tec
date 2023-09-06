@extends('layouts.master')
@section('title', 'Sales - Members')

@section('page-header')
    <header class="header bg-ui-general">
        <div class="header-info">
            <h1 class="header-title">
                Sales Target for <strong>{{ $sales_target->sales_member->name }}</strong>
            </h1>
        </div>

        {{-- <div class="header-action">
            <nav class="nav">
                <a class="nav-link active" href="{{ route('sales-member.index') }}">
                    Sales Team
                </a>
                <a class="nav-link" href="{{ route('sales-member.create') }}">
                    <i class="fa fa-plus"></i>
                    Add Member
                </a>
            </nav>
        </div> --}}

    </header>
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('sales_target.store_item', $sales_target) }}" method="POST" class="form-row">
                    @csrf
                    <div class="col-12">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="">Product</label>
                                <select name="product_id" id="" class="form-control" data-provide="selectpicker"
                                    data-live-search="true" data-size="10">
                                    @foreach (\App\Product::get() as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('product_id') == $item->id ? 'SELECTED' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('product_id'))
                                    <div class="alert alert-danger">{{ $errors->first('product_id') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-3 col-sm-6">
                                <label for="">One Year Target</label>
                                <input type="text" name="twelve_month_quantity"
                                    value="{{ old('twelve_month_quantity') }}" class="form-control">
                                @if ($errors->has('twelve_month_quantity'))
                                    <div class="alert alert-danger">{{ $errors->first('twelve_month_quantity') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-2" style="margin-top: 32px;">
                                <input type="submit" class="btn btn-success" value="Add Item">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <h4 class="card-title"><strong>Sales Target</strong></h4>
            <div class="card-body card-body-soft">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            {{-- <th>Three Month Target</th>
                            <th>Six Month Target</th>
                            <th>Nine Month Target</th> --}}
                            <th>Twelve Month Target</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales_target->sales_target_items as $item)
                            <tr>
                                <form action="{{ route('sales_target.update_item', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <td>{{ $item->product->name }}</td>
                                    {{-- <td>
                                        <input type="text" name="three_month_quantity" value="{{ $item->three_month_quantity }}">
                                    </td>
                                    <td>
                                        <input type="text" name="six_month_quantity" value="{{ $item->six_month_quantity }}">
                                    </td>
                                    <td>
                                        <input type="text" name="nine_month_quantity" value="{{ $item->nine_month_quantity }}">
                                    </td> --}}
                                    <td>
                                        <input type="text" name="twelve_month_quantity"
                                            value="{{ $item->twelve_month_quantity }}">
                                    </td>
                                    <td>
                                        <input type="submit" class="btn btn-info" value="Update">
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('styles')

@endsection

@section('scripts')
    @include('includes.delete-alert')
@endsection
