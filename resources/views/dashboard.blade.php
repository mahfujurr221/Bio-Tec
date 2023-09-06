@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')

<div class="row">
    <div class="col-md-6">
        <a href="{{ route('process-commission') }}" class="btn btn-info">Process Commission</a>
    </div>
</div>

@endsection

@section('styles')
    <style>
        .main-content {
            padding-top: 25px;
        }

        @media (min-width: 250px) {
            .grid-of-5 {
                width: 100%;
                display: grid;
                grid-template-columns: repeat(2, minmax(100px, auto));
                grid-column-gap: 1.5%;
            }

            .grid-of-4 {
                width: 100%;
                display: grid;
                grid-template-columns: repeat(2, minmax(100px, auto));
                grid-column-gap: 1.5%;
            }
        }

        @media (min-width: 768px) {
            .grid-of-5 {
                width: 100%;
                display: grid;
                grid-template-columns: repeat(4, minmax(100px, 1fr));
                grid-column-gap: 1.5%;
            }

            .grid-of-4 {
                width: 100%;
                display: grid;
                grid-template-columns: repeat(4, minmax(100px, 1fr));
                grid-column-gap: 1.5%;
            }
        }

        @media (min-width: 992px) {
            .grid-of-5 {
                width: 100%;
                display: grid;
                grid-template-columns: repeat(5, minmax(100px, 1fr));
                grid-column-gap: 1.5%;
            }
        }

        .grid-of-2 {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(2, minmax(100px, 1fr));
            grid-column-gap: 1.5%;
        }

        .card .card {
            margin-bottom: 10px;
        }

        .containing-card>.card-body {
            padding: 10px;
        }

        .card-header {
            padding: 5px;
        }
    </style>
@endsection


@section('scripts')
    <script>
        localStorage.removeItem('pos-items');
    </script>
@endsection
