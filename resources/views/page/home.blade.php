@extends('index')
@section('title', __('Integrasi Laravel-Xendit | Home'))

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <h3>Welcome to Integration Laravel with Xendit</h3>
            <hr>
            <span>
                <h5>Sebelum penggunaan, lakukan hal tersebut :</h5>
                1. Download Aplikasi dari Github
                <br>
                2. Cantumkan XENDIT_SECRET_KEY, XENDIT_PUBLIC_KEY, XENDIT_VERIFY_TOKEN, dari akun xendit Anda
                <br>
                3. Buat database bernama "xendit"
                <br>
                4. Jika sudah, lakukan migration "php artisan migrate"
                <br>
                5. Silahkan Gunakan.
                <br>
                <br>
                <strong>NOTE : </strong> GUNAKAN NGROK LALU GANTI URL CALL DI AKUN XENDIT ANDA MENGGUNAKAN URL NGROK ANDA.
                <br>
                <small>Created By : Apip Rahman Syahidan</small>
            </span>
        </div>
    </div>
@endsection