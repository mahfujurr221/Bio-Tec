@extends('layouts.master')
@section('title', 'Edit Warehouse')

@section('page-header')
    <header class="header bg-ui-general">
        <div class="header-info">
          <h1 class="header-title">
            <strong>Edit Warehouse</strong>
          </h1>
        </div>
      </header>
@endsection

@section('content')
  <div class="col-12">
    <div class="card">
      <h4 class="card-title">Edit Warehouse</h4>

    <form action="{{ route('warehouse.update', $warehouse) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
      <div class="card-body">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="">Warehouse Name<span class="field_required"></span></label>
            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid': '' }}" name="name" value="{{ $warehouse->name }}">
            @if($errors->has('name'))
                <span class="invalid-feedback">{{ $errors->first('name') }}</span>
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
