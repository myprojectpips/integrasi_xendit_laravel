@extends('index')
@section('title', __('Integrasi Laravel-Xendit | Ewallet'))

@section('content')
    <div class="card mx-auto shado-sm">
        <div class="card-body">
            <h3 class="text-center">Integrasi Xendit Ewallet (Testing)</h3>
            <hr>

            {{-- Error --}}
            @if ($msg = Session::get('error'))
                <div class="alert alert-danger">
                    {{ $msg }}
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('ewallet.createCharge') }}" method="POST">
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

                <hr>
                
                <div class="row">
                    <div class="mb-3 col">
                        <label for="">Payment Method</label>
                        <select name="payment_method" id="" class="form-select">
                            @foreach ($paymentChannel as $key)
                                @if ($key['channel_category'] == "EWALLET" && $key['channel_code'] == "DANA" || $key['channel_code'] == "LINKAJA")
                                    <option value="ID_{{ $key['channel_code'] }}">{{ $key['channel_code'] }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <button class="btn btn-primary btn-pay">Proceed to Checkout</button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm mt-3">
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>Payment ID</th>
                    <th>Reference ID</th>
                    <th>Payment Channel</th>
                    <th>Channel Code</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Pay At</th>
                </tr>

                @foreach ($dataEwallet as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->reference_id }}</td>
                        <td>{{ $data->payment_channel }}</td>
                        <td>{{ $data->channel_code }}</td>
                        <td>{{ $data->amount }}</td>
                        <td>{{ $data->status }}</td>
                        <td>{{ $data->pay_at }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection