@extends('index')
@section('title', __('Integrasi Laravel-Xendit | After Pay'))

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            @if ($message == "success")
                <div class="alert alert-success">
                    <Strong>Payment Success!</Strong>
                    <br>
                    <span>Anda telah melakukkan transaksi, terimakasih!</span>
                </div>
            @elseif ($message == "failure")
                <div class="alert alert-danger">
                    <Strong>Payment Failure!</Strong>
                    <br>
                    <span>Transaksi anda gagal, silahkan lakukan lagi!</span>
                </div>
            @endif
        </div>
    </div>
@endsection