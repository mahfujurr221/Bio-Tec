@extends('layouts.master')
@section('title', 'Designations')

@section('page-header')
    <header class="header bg-ui-general">
        <div class="header-info">
            <h1 class="header-title">
                <strong>Designations</strong>
            </h1>
        </div>

        <div class="header-action">
          <nav class="nav">
              <a class="nav-link active" href="{{ route('sales-designation.index') }}">
                  Sales Desigantion
              </a>
          </nav>
      </div>

    </header>
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <h4 class="card-title">Add Designation</h4>
            <div class="card-body">
                <form action="{{ route('sales-designation.store') }}" method="POST" class="form-row">
                    @csrf
                    <div class="form-group col-md-6">
                        <label for="">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                        @if ($errors->has('name'))
                            <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label for="">Level</label>
                        <input type="text" name="level"
                            value="{{ old('level', \App\SalesDesignation::orderBy('id', 'desc')->first()->id + 1) }}"
                            class="form-control">
                        @if ($errors->has('level'))
                            <div class="alert alert-danger">{{ $errors->first('level') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label for="">Commission</label>
                        <input type="text" name="commission_percentage" value="{{ old('commission_percentage') }}"
                            class="form-control">
                        @if ($errors->has('commission_percentage'))
                            <div class="alert alert-danger">{{ $errors->first('commission_percentage') }}</div>
                        @endif
                    </div>


                    <div class="col-12">
                        <input type="submit" class="btn btn-success" value="Add Designation">
                    </div>
                </form>
            </div>
        </div>


        <div class="card">
            <h4 class="card-title"><strong>Designations</strong></h4>

            <div class="card-body card-body-soft">
                @if ($designations->count() > 0)
                    <div class="table-responsive table-bordered">
                        <table class="table table-soft">
                            <thead>
                                <tr class="bg-primary">
                                    <th>#</th>
                                    <th>Designation</th>
                                    <th>Level</th>
                                    <th>Commission</th>
                                    <th style="width:20%;">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @dd($designations) --}}
                                @foreach ($designations as $key => $designation)
                                    <tr>
                                        <th scope="row">
                                            {{ $loop->iteration + $designations->perPage() * ($designations->currentPage() - 1) }}
                                        </th>

                                        <td>{{ $designation->name }}</td>
                                        <td>{{ $designation->level }}</td>
                                        <td>{{ $designation->commission_percentage }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fa fa-cogs"></i>
                                                    Manage
                                                </button>
                                                <div class="dropdown-menu" x-placement="bottom-start">
                                                    <a class="dropdown-item"
                                                        href="{{ route('sales-designation.edit', $designation->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                        Edit
                                                    </a>
                                                    <a class="dropdown-item delete"
                                                        href="{{ route('sales-designation.destroy', $designation->id) }}">
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
                        {{ $designations->links() }}
                    </div>
                @else
                    <div class="alert alert-danger" role="alert">
                        <strong>No Designation Found.</strong>
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
