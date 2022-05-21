@extends('index')
@section('title', __('Integrasi Laravel-Xendit | Home'))

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <h3>Segera Lakukkan Pembayaran</h3>
            <hr>
            <div class="card mx-auto col-sm-5">
                <div class="card-body">
                    Status : {{ $status }}
                    <br>
                    Name : {{ $name }}
                    <br>
                    Account Number : {{ $account_number }}
                    <br>
                    Amount : {{ $expected_amount }}
                    <br>
                    Bank : {{ $bank_code }}
                    <br>
                    Expire : {{ $expiration_date }}
                    <br>
                    ID : {{ $id }}
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection