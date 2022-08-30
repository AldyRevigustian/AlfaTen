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
            <div class="col-md-9 col-sm-12">
                <h3>Daftar Produk</h3>
                <div class="card mt-3 p-3 border-0 shadow-sm rounded" style="min-height: 130px">
                    @foreach ($carts as $cart)
                        <div class="row">
                            <div class="col col-3 mb-3" style="display: flex; align-items: center; justify-content:center;">
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

                                <!-- Modal -->
                                <div class="modal fade" id="detail-{{ $cart->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detail Produk
                                                    {{ $cart->product->name }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('customer.updatecart', $cart->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <input type="hidden" value="{{ $cart->product->id }}"
                                                        name="product_id">
                                                    <div class="text-center mb-2" style="height: 150px;">
                                                        <img src="/storage/products/{{ $cart->product->thumbnail }}"
                                                            alt="" height="100%">
                                                    </div>
                                                    <h5>
                                                        Nama Produk : <b>{{ $cart->product->name }}</b>
                                                    </h5>
                                                    <h6>
                                                        Harga : Rp. {{ $cart->product->new_price }}
                                                    </h6>
                                                    {{-- Harga : {{ $cart->product->diskon }}<br> --}}
                                                    <h6> Quantity : </h6>
                                                    <div class="input-group" style="max-width: 150px">
                                                        <span class="input-group-btn">
                                                            <button type="button" style="border-radius: 5px 0px 0px 5px"
                                                                class="btn btn-danger btn-number" data-type="minus"
                                                                data-field="quantity">
                                                                <i class="bi bi-dash-lg"></i>
                                                            </button>
                                                        </span>
                                                        <input type="text" name="quantity"
                                                            class="form-control input-number" value="{{ $cart->quantity }}"
                                                            min="1" max="100">
                                                        <span class="input-group-btn">
                                                            <button type="button" style="border-radius: 0px 5px 5px 0px"
                                                                class="btn btn-success btn-number" data-type="plus"
                                                                data-field="quantity">
                                                                <i class="bi bi-plus-lg"></i>
                                                            </button>
                                                        </span>
                                                    </div>
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


                                <button class="btn btn-danger btn-sm" type="button" data-bs-toggle="modal"
                                    data-bs-target="#delete-{{ $cart->id }}">
                                    <i class="bi bi-trash-fill"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="delete-{{ $cart->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detail Produk
                                                    {{ $cart->product->name }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('customer.deletecart', $cart->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body">
                                                    Are You Sure Want To Delete This Product?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Oke</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    @endforeach
                </div>

            </div>
            <div class="col-md-3 col-sm-12 mt-4">
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
                                <h6>Rp. {{ $cart->product->new_price * $cart->quantity }}</h6>
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

@push('scripts')
    <script>
        $('.btn-number').click(function(e) {
            e.preventDefault();

            fieldName = $(this).attr('data-field');
            type = $(this).attr('data-type');
            var input = $("input[name='" + fieldName + "']");
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if (type == 'minus') {

                    if (currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if (type == 'plus') {

                    if (currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(0);
            }
        });
        $('.input-number').focusin(function() {
            $(this).data('oldValue', $(this).val());
        });
        $('.input-number').change(function() {

            minValue = parseInt($(this).attr('min'));
            maxValue = parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());

            name = $(this).attr('name');
            if (valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if (valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }


        });
        $(".input-number").keydown(function(e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    </script>
@endpush
