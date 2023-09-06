@extends('layouts.master')
@section('title', 'Daily Invoice')
@section('content')
    <div class="col-md-12">
        <div class="row justify-content-center">
            <div class="col-md-7 card card-body print">
                <div id="print-area">
                    <div class="invoice-header">
                        <div class="logo-area">
                            @if ($pos_setting->invoice_logo_type == 'Logo' && $pos_setting->logo != null)
                                <img src="{{ asset($pos_setting->logo) }}" alt="logo">
                            @elseif($pos_setting->invoice_logo_type == 'Name' && $pos_setting->company != null)
                                {{-- <img src="{{ asset($pos_setting->logo) }}" alt="logo"> --}}
                                <h4>{{ $pos_setting->company }}</h4>
                            @else
                                <img src="{{ asset($pos_setting->logo) }}" alt="logo">
                                <div class="clearfix"></div>
                                <h4>{{ $pos_setting->company }}</h4>
                            @endif
                        </div>
                        <address>
                            Address : <strong>{{ $pos_setting->address }}</strong>
                            <br>
                            Phone : <strong>{{ $pos_setting->phone }}</strong>
                            <br>
                            Email : <strong>{{ $pos_setting->email }}</strong>
                        </address>
                    </div>

                    <div class=" mt-4">
                        <div class="bill-date">
                            <div class="date">
                                Date: <span>{{ date('d-m-Y') }}</span>
                            </div>
                        </div>
                        <div class="name">
                            Salesman Name :
                            <span>{{ $member->name }}</span>
                        </div>
                        <div class="address">
                            Address :
                            <span>{{ $member->address }}</span>
                        </div>
                    </div>
                    @php
                        $grandTotalAmount = 0;
                        $totalQuantities = [];
                    @endphp
                    {{-- items Design --}}
                    <table class="table table-bordered table-plist my-3 order-details">
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Address</th>
                        @foreach ($targeted_products as $product)
                            <th>
                                {{-- @php
                                    $words = explode(' ', $product->product->name);
                                    $firstLetters = array_map(function ($word) {
                                        return substr($word, 0, 1);
                                    }, $words);
                                    echo implode(' ', $firstLetters);
                                @endphp --}}
                                {{$product->product->code}}
                            </th>
                        @endforeach
                        <th>Amount</th>
                        @foreach ($pos as $key => $item)
                            @php
                                $totalAmount = 0;
                            @endphp
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->customer->name }}</td>
                                <td>{{ $item->customer->address }}</td>
                                @foreach ($targeted_products as $product)
                                    <td>
                                        {{ $product->todaySaleQuantity($product->product_id, $item->customer_id) }}
                                        @php
                                            $totalAmount += $product->todaySaleAmount($product->product_id, $item->customer_id);
                                            $quantity = $product->todaySaleQuantity($product->product_id, $item->customer_id);
                                            if (array_key_exists($product->product_id, $totalQuantities)) {
                                                $totalQuantities[$product->product_id] += $quantity;
                                            } else {
                                                $totalQuantities[$product->product_id] = $quantity;
                                            }
                                        @endphp
                                    </td>
                                @endforeach
                                <td>
                                    {{ $totalAmount }} taka
                                </td>
                            </tr>
                            @php
                                $grandTotalAmount += $totalAmount;
                            @endphp
                        @endforeach
                        <tr></tr>
                        <tr>
                            <td colspan="3" class="text-start"><b>Grand Total</b></td>
                            @foreach ($targeted_products as $product)
                                <td><b>{{ $totalQuantities[$product->product_id] ?? 0 }} pc</b></td>
                            @endforeach
                            <td><b>{{ $grandTotalAmount }} taka</b></td>
                        </tr>
                    </table>
                    <hr>
                    <p class="text-center lead"><small>Software Developed by SOFTGHOR LTD. For query: 01958-104250</small>
                    </p>
                </div>
                <button class="btn btn-secondary btn-block print_hidden" onclick="print_receipt('print-area')">
                    <i class="fa fa-print"></i>
                    Print
                </button>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <a href="{{ route('pos.create') }}" class="btn btn-primary btn-block">
                            <i class="fa fa-reply"></i>
                            New Sale
                        </a>
                    </div>

                    <div class="col-md-6">
                        <a href="{{ route('pos.index') }}" class="btn btn-primary btn-block">
                            <i class="fa fa-reply"></i>
                            Sale List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link href="https://fonts.googleapis.com/css?family=Petrona&display=swap" rel="stylesheet">
    <style rel="stylesheet">
        .page-footer hr {
            margin: 2px;
        }

        .signature {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }

        .signature p {
            margin-top: -10px;
        }


        .order-details th {
            font-weight: bold;
        }

        strong {
            font-weight: 800;
        }

        address {
            margin-bottom: 0px;
        }

        .invoice-header {
            width: 100%;
            display: block;
            box-sizing: border-box;
            overflow: hidden;
            text-align: center;
        }

        .invoice-header address {
            /*width: 50%;*/
            /*float: left;*/
            padding: 0px;
            line-height: 1.5;
        }

        .logo-area img {
            @if ($pos_setting->invoice_logo_type == 'Both')
                width: 30%;
            @else
                width: 40%;
            @endif
            display: inline;
            float: left;
        }

        .logo-area h1 {
            display: inline;
            float: left;
            font-size: 17px;
            padding-left: 8px;
        }

        .logo-area h4 {
            font-weight: bold;
            margin-top: 0px;
            margin-bottom: 0px;
            padding: 0px;
            line-height: 1;
        }

        .invoice-header .logo-area {
            /*width: 50%;*/
            /*float: left;*/
            padding: 5px;
        }

        .bill-date {
            width: 100%;
            border: 1px solid #000;
            overflow: hidden;
            padding: 0 15px;
        }

        .date {
            width: 50%;
            float: left;
        }

        .bill-no {
            width: 50%;
            float: left;
        }

        .name,
        .address,
        .mobile-no,
        .cus_info {
            width: 100%;
            border-left: 1px solid #000;
            border-bottom: 1px solid #000;
            border-right: 1px solid #000;
            padding: 0 15px;
        }

        .name span,
        .address span,
        .mobile-no span,
        .cus_info span {
            padding-left: 15px;
            font-weight: 800;
        }

        .sign {
            width: 250px;
            border-top: 1px solid #000;
            float: right;
            margin: 40px 20px 0 0;
            text-align: center;
        }

        @media print {
            body * {
                visibility: visible;
            }

            body {
                font-size: 9px !important;
            }

            .table-rheader td {
                border-top: 0px;
                padding: 5px;
                vertical-align: baseline !important;
            }

            .table-plist td {
                padding: 0px !important;
                text-align: center;
            }

            .table-plist th {
                padding: 0px !important;
                text-align: center;
            }

            .border-bottom {
                border-bottom: 1px dotted #000;
            }

            .print {
                margin-bottom: 0;
            }

            .table-bordered td,
            .table-bordered th {
                border: 1px solid #000 !important;
            }
        }

        body {
            font-family: 'Petrona', serif;
        }

        .bill-no,
        .date,
        .name,
        .mobile-no,
        .address,
        th,
        td,
        address,
        h4 {
            color: black;
        }

        .name,
        .address,
        .mobile-no,
        .cus_info,
        .bill-no,
        .date,
        .name,
        .mobile-no,
        .address,
        th,
        td,
        address,
        h4 {
            line-height: 1.7 !important;
        }
    </style>

    <style>
        .table-rheader td {
            border-top: 0px;
            padding: 5px;
            vertical-align: baseline !important;
        }

        .table-plist td {
            padding: 0px;
            text-align: center;
        }

        .table-plist th {
            padding: 0px;
            text-align: center;
            background: #ddd;
        }

        .border-bottom {
            border-bottom: 1px dotted #000;
        }
    </style>
@endsection

@section('scripts')
    <script>
        // clear localstore
        localStorage.removeItem('pos-items');

        function print_receipt(divName) {
            let printDoc = $('#' + divName).html();
            let originalContents = $('body').html();
            $("body").html(printDoc);
            window.print();
            $('body').html(originalContents);
        }
    </script>
@endsection
