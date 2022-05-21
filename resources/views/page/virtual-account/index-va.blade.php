@extends('index')
@section('title', __('Integrasi Laravel-Xendit | Ewallet'))

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="text-center">Integrasi Xendit Virtual Account (Testing)</h3>
            <hr>

            {{-- Error --}}
            @if ($msg = Session::get('error'))
                <div class="alert alert-danger">
                    {{ $msg }}
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('va.createVa') }}" method="POST">
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
                            @foreach ($vaBank as $key)
                                @if ($key['is_activated'] == true)
                                    <option value="{{ $key['code'] }}">{{ $key['code'] }}</option>
                                @endif
                            @endforeach
                        </select>
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
                    <th>Payment ID</th>
                    <th>External ID</th>
                    <th>Bank</th>
                    <th>Account Number</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Expire At</th>
                    <th>Pay At</th>
                </tr>
                @foreach ($dataVaBank as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->external_id }}</td>
                        <td>{{ $data->bank }}</td>
                        <td>{{ $data->account_number }}</td>
                        <td>{{ $data->amount }}</td>
                        <td>{{ $data->status }}</td>
                        <td>{{ $data->expire_at }}</td>
                        <td>{{ $data->pay_at }}</td>
                    </tr>
                @endforeach
            </table>
            
        </div>
    </div>
@endsection