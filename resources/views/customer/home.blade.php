@extends('layouts.app')

@section('navbar')
    @php $page = 'Home'; @endphp
    @include('layouts.nav.customer')
@endsection

@section('content')

    <style>
        s{
            color: red
        }
    </style>
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="row justify-content-center">
            @foreach ($categories as $category)
                <div class="col-md-12 mb-3">
                    <div class="card">
                    <div class="card-header">{{ $category->name }}</div>

                        <div class="card-body">
                            <div class="row">
                                @foreach ($category->products as $product)
                                    <div class="col col-2 mb-3">
                                        <div class="card">
                                            <div class="card-header text-center" style="height: 150px;">
                                                <img src="/storage/products/{{ $product->thumbnail }}" alt="" height="100%" >
                                            </div>
                                            <div class="card-body">
                                                {{ $product->name }}
                                                <br>
                                                {!! $product->new_price !== $product->price ? "<s>$product->price</s> " : $product->price !!}
                                                {{ $product->new_price !== $product->price ? $product->new_price : '' }}
                                                <div class="d-grid gap2">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#detail-{{ $product->id }}">Detail</button>
                                                </div>

                                                <!-- Modal -->
                                                <div class="modal fade" id="detail-{{ $product->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Detail Produk
                                                                    #{{ $product->id }}
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('customer.addToCart') }}" method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <input type="hidden" value="{{ $product->id }}"
                                                                        name="product_id">
                                                                    Nama Produk : {{ $product->name }}<br>
                                                                    Harga : {{ $product->price }}<br>
                                                                    {{-- Harga : {{ $product->diskon }}<br> --}}
                                                                    Jumlah Beli : <input type="number" name="quantity"
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
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
