@extends('layouts.app')

@section('navbar')
    @php $page = 'Carts'; @endphp
    @include('layouts.nav.customer')
@endsection

@section('content')
    <style>
        s {
            color: red
        }
    </style>
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
            <div class="col col-md-9 col-sm-12 ">
                <h3>Daftar Produk</h3>
                <div class="card mt-3 p-3 border-0 shadow-sm rounded">
                    @foreach ($carts as $cart)
                        <div class="row">
                            <div class="col col-3 mb-3">
                                <div style="width:150px" class="text-center">
                                    <img src="/storage/products/{{ $cart->product->thumbnail }}"
                                        style="max-width:100px;max-height:100px">
                                </div>
                            </div>
                            <div class="col col-9 mt-2 mb-3">
                                <h5 class="fw-bold">{{ $cart->product->name }}</h5>
                                <h6>Rp. {{ $cart->product->new_price }} -</h6>
                                <h6>Qty : {{ $cart->quantity }}</h6>
                                <form action=""></form>
                                <button class="btn btn-success btn-sm" type="button" data-bs-toggle="modal"
                                data-bs-target="#detail-{{ $cart->id }}">
                                    <i class="bi bi-pencil-fill text-light"></i>
                                </button>
                                <form action="{{ route('customer.deletecart', $cart->id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="detail-{{ $cart->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Detail Produk
                                                #{{ $cart->product->id }}
                                            </h5>
                                            <button type="button" class="btn-close"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('customer.updatecart', $cart->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <input type="hidden" value="{{ $cart->product->id }}"
                                                    name="product_id">
                                                Nama Produk : {{ $cart->product->name }}<br>
                                                Harga : {{ $cart->product->new_price }}<br>
                                                Jumlah Beli : <input type="number" name="quantity" value="{{ $cart->quantity }}"
                                                    class="form-control">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save
                                                    changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
            <div class="col col-md-3 col-sm-12">
                <h3>Total Harga</h3>

                <div class="card mt-3 p-3  border-0 shadow-sm rounded">
                    @foreach ($carts as $cart)
                        <div class="row">
                            <div class="col col-7">
                                <div class="d-flex">
                                    <h6>{{ $cart->product->name }}&nbsp;</h6>
                                    <h6>x {{ $cart->quantity }}</h6>
                                </div>
                            </div>
                            <div class="col- col-5">
                                <h6>{{ $cart->product->new_price * $cart->quantity }}</h6>
                            </div>
                        </div>
                    @endforeach
                    <hr>
                    <div class="row">
                        <div class="col col-7">
                            <h6>Total</h6>
                        </div>
                        <div class="col col-5">
                            <h6>Rp. {{ $total_harga }}</h6>
                        </div>
                    </div>
                    <button class="btn btn-primary">
                        Pesan
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
