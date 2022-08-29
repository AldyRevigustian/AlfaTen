@extends('layouts.app')

@section('navbar')
    @php $page = 'Home'; @endphp
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
                                                <img src="/storage/products/{{ $product->thumbnail }}" alt=""
                                                    height="100%">
                                            </div>
                                            <div class="card-body">
                                                {{ $product->name }}
                                                <br>
                                                {!! $product->new_price !== $product->price ? "<s>Rp. $product->price</s> " : "Rp. $product->price" !!}
                                                {{ $product->new_price !== $product->price ? "Rp. $product->new_price" : '' }}
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
                                                                    {{ $product->name }}
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('customer.addToCart') }}" method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <input type="hidden" value="{{ $product->id }}"
                                                                        name="product_id">
                                                                    <div class="text-center mb-2" style="height: 150px;">
                                                                        <img src="/storage/products/{{ $product->thumbnail }}"
                                                                            alt="" height="100%">
                                                                    </div>
                                                                    <h5>
                                                                        Nama Produk : <b>{{ $product->name }}</b>
                                                                    </h5>
                                                                    <h6>
                                                                        Harga : Rp. {{ $product->new_price }}
                                                                    </h6>
                                                                    {{-- Harga : {{ $product->diskon }}<br> --}}
                                                                    <h6> Quantity : </h6>
                                                                    <div class="input-group" style="max-width: 150px">
                                                                        <span class="input-group-btn">
                                                                            <button type="button"
                                                                                style="border-radius: 5px 0px 0px 5px"
                                                                                class="btn btn-danger btn-number"
                                                                                data-type="minus" data-field="quantity">
                                                                                <i class="bi bi-dash-lg"></i>
                                                                            </button>
                                                                        </span>
                                                                        <input type="text" name="quantity"
                                                                            class="form-control input-number" value="1"
                                                                            min="1" max="100">
                                                                        <span class="input-group-btn">
                                                                            <button type="button"
                                                                                style="border-radius: 0px 5px 5px 0px"
                                                                                class="btn btn-success btn-number"
                                                                                data-type="plus" data-field="quantity">
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

@push('scripts')
    <script>
        //plugin bootstrap minus and plus
        //http://jsfiddle.net/laelitenetwork/puJ6G/
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
