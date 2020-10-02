@extends('layouts.admin')

@section('content')
    <div class="jumbotron" style="text-align: center">
        <h1>Payment Methods</h1>
    </div>

    <br>

    <div class="container">
        <div class="media mb-2" style="border: 2px solid black">
            <img class="mr-3" src="{{asset('adminComponents/logo/cod.jpg')}}" height="200px" width="200px" alt="Generic placeholder image">
            <div class="media-body">
                <h1 class="mt-0">Cash On Delivery</h1><br>
                <div class="row">
                    <div class="col-8">
                        <p>This option will let customers place an order through cash on delivery process!</p>
                        <form action="{{route('admin.payment.dcharge.update')}}" method="POST">
                            @csrf
                            <label for="">Delivery Charge</label>
                            <input class="form-control" type="text" value="{{$settings[0]->delivery_charge}}" name="delivery_charge">
                            <button class="btn btn-warning mb-1">Update</button>
                        </form>
                    </div>
                    <div class="col-4">
                        @if($settings[0]->cod_status == 0)
                            <a class="btn btn-success" href="{{route('admin.payment.method.switch', 'cod_status')}}">Activate</a>
                            <button class="btn btn-danger" disabled>Deactivated</button>
                        @else
                            <button class="btn btn-success" disabled>Activated</button>
                            <a class="btn btn-danger" href="{{route('admin.payment.method.switch', 'cod_status')}}">Deactivate</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="media" style="border: 2px solid black">
            <img class="mr-3" src="{{asset('adminComponents/logo/bkash.png')}}" height="200px" width="200px" alt="Generic placeholder image">
            <div class="media-body">
                <h1 class="mt-0">Bkash Payment</h1>
                <div class="row">
                    <div class="col-8">
                        <p>This option will let customers place an order through Bkash Payment and sharing TrxID!</p>
                        <form action="{{route('admin.payment.bkash.update.num')}}" method="POST">
                            @csrf
                            <label for="">Change Bkash Number</label>
                            <input class="form-control" type="text" value="{{$settings[0]->bkash_num}}" name="bkash_num">
                            <button class="btn btn-warning mb-1">Update</button>
                        </form>
                    </div>
                    <div class="col-4">
                        @if($settings[0]->bkash_status == 0)
                            <a class="btn btn-success" href="{{route('admin.payment.method.switch', 'bkash_status')}}">Activate</a>
                            <button class="btn btn-danger" disabled>Deactivated</button>
                        @else
                            <button class="btn btn-success" disabled>Activated</button>
                            <a class="btn btn-danger" href="{{route('admin.payment.method.switch', 'bkash_status')}}">Deactivate</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection