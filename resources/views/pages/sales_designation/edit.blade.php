@extends('layouts.master')
@section('title', 'Edit Designation')

@section('page-header')
    <header class="header bg-ui-general">
        <div class="header-info">
          <h1 class="header-title">
            <strong>Edit Designation</strong>
          </h1>
        </div>

        <div class="header-action">
          <nav class="nav">
              <a class="nav-link" href="{{ route('sales-designation.index') }}">
                  Sales Desigantion
              </a>
              <a class="nav-link active" href="#">
                  Edit Designation
              </a>
          </nav>
      </div>
      </header>
@endsection

@section('content')
  <div class="col-12">
    <div class="card">
      <h4 class="card-title">Edit Designation</h4>

    <form action="{{ route('sales-designation.update', $sales_designation) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
      <div class="card-body">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="">Name<span class="field_required"></span></label>
            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid': '' }}" name="name" value="{{ $sales_designation->name }}">
            @if($errors->has('name'))
                <span class="invalid-feedback">{{ $errors->first('name') }}</span>
            @endif
          </div>

          <div class="form-group col-md-6">
            <label for="">Level</label>
            <input type="text" name="level"
                value="{{ old('level', $sales_designation->level) }}"
                class="form-control">
            @if ($errors->has('level'))
                <div class="alert alert-danger">{{ $errors->first('level') }}</div>
            @endif
        </div>

        <div class="form-group col-md-6">
            <label for="">Commission</label>
            <input type="text" name="commission_percentage" value="{{ old('commission_percentage', $sales_designation->commission_percentage) }}"
                class="form-control">
            @if ($errors->has('commission_percentage'))
                <div class="alert alert-danger">{{ $errors->first('commission_percentage') }}</div>
            @endif
        </div>

          <div class="col-12">
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
