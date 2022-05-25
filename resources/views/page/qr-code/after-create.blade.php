@extends('index')
@section('title', __('Integrasi Laravel-Xendit | QR Code'))

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            
            <div class="container">
                <div class="card mx-auto col-sm-3 p-0">
                    <div class="card-body">
                        <div class="text-center">
                            <img src = 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={{ $dataQR['qr_string'] }}&choe=UTF-8' class="img-fluid">
                        </div>
                        <span class="badge bg-info">{{ $dataQR['status'] }}</span>
                        <br>
                        <span>External ID : {{ $dataQR['external_id'] }}</span>
                        <hr>
                        <span>
                            1. Buka Ewallet Anda Seperti DANA,OVO,ShoppePay,dll.
                            <br>
                            2. Lalu Scan Kode QR/QRIS Tersebut Untuk Melakukkan Transaksi.
                            <br>
                            3. Silahkan Melakukkan Pembayaran.
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection