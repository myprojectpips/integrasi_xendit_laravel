@extends('index')
@section('title', __('Integrasi Laravel-Xendit | QR Code'))

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="text-center">Integrasi Xendit QR Code (Testing)</h3>
            <hr>

            {{-- Error --}}
            @if ($msg = Session::get('error'))
                <div class="alert alert-danger">
                    {{ $msg }}
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('qrCode.create') }}" method="POST">
                @csrf

                <div class="">
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="">Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                        </div>
                        <div class="mb-3 col">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="">No Telp.</label>
                            <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp') }}" required>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary btn-pay">Proceed to Checkout</button>
            </form>
        </div>
    </div>

    <div class="card mx-auto shadow-sm mt-3">
        <div class="card-body table-responsive">
            <table class="table table-sm table-bordered">
                <tr>
                    <th>No.</th>
                    <th>External ID</th>
                    <th>Payment Channel</th>
                    <th>Nominal</th>
                    <th>Status</th>
                    <th>Pay At</th>
                    <th>Source</th>
                </tr>
                @foreach ($dataQRCode as $data)
                    <tr>
                        <td>{{ $data->count }}</td>
                        <td>{{ $data->external_id }}</td>
                        <td>{{ $data->payment_channel }}</td>
                        <td>{{ $data->nominal }}</td>
                        <td>{{ $data->status }}</td>
                        <td>{{ $data->pay_at }}</td>
                        <td>{{ $data->source }}</td>
                    </tr>
                @endforeach
            </table>
            
        </div>
    </div>
@endsection