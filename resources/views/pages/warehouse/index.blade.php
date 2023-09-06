@extends('layouts.master')
@section('title', 'Brand List')

@section('page-header')
    <header class="header bg-ui-general">
        <div class="header-info">
          <h1 class="header-title">
            <strong>Warehouses</strong>
          </h1>
        </div>

      </header>
@endsection

@section('content')
    <div class="col-12">
      <div class="card">
        <h4 class="card-title">Add Warehosue</h4>
        <div class="card-body">
          <form action="{{ route('warehouse.store') }}" method="POST">
            @csrf
            <div class="form-group col-6">
              <label for="">Name</label>
              <input type="text" name="name" value="{{ old("name") }}" class="form-control">
              @if($errors->has('name'))
                <div class="alert alert-danger">{{ $errors->first('name') }}</div>
              @endif
            </div>

            <div class="col-12">
              <input type="submit" class="btn btn-success" value="Add Warehouse">
            </div>
          </form>
        </div>
      </div>


            <div class="card">
              <h4 class="card-title"><strong>Warehosues</strong></h4>

              <div class="card-body card-body-soft">
                   @if($warehouses->count() > 0)
                <div class="table-responsive table-bordered">
                  <table class="table table-soft">
                    <thead>
                      <tr class="bg-primary">
                        <th>#</th>
                        <th>Warehouse</th>
                        <th style="width:20%;">#</th>
                      </tr>
                    </thead>
                    <tbody>
                         @foreach($warehouses as $key => $warehouse)
                      <tr>
                        <th scope="row">
                            {{ $loop->iteration + $warehouses->perPage() * ($warehouses->currentPage() - 1) }}
                        </th>

                        <td>{{ $warehouse->name }}</td>
                        <td>
                          <div class="btn-group">
                            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                              <i class="fa fa-cogs"></i>
                              Manage
                              </button>
                            <div class="dropdown-menu" x-placement="bottom-start">
                              <a class="dropdown-item" href="{{ route('warehouse.edit', $warehouse->id) }}">
                                <i class="fa fa-edit"></i>
                                Edit
                              </a>
                              <a class="dropdown-item delete" href="{{ route('warehouse.destroy',$warehouse->id) }}" >
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
                  {{ $warehouses->links() }}
                </div>
                @else
                <div class="alert alert-danger" role="alert">
                     <strong>You have no Warehouse</strong>
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