@extends('layouts.default')

@section('content')
    <style>
        .show {
            display: unset;
        }

        .hide {
            display: none;
        }

        .list {
            margin: 24px 12px;
        }
    </style>
    <div class="col-lg-4 w-100" id="fridge-container">
        <img src="{{ URL::to('/') }}/images/fridge_closed.png" alt="fridge">
    </div>
    <div class="col-lg-4 w-100" id="cabinet-container">
        <img src="{{ URL::to('/') }}/images/cabinet_closed.png" alt="cabinet">
    </div>
    <div class="col-lg-4 mt-5">
        <a href="/recepies">
            <img src="{{ URL::to('/') }}/images/table.jpg" alt="table" class="img-fluid" style="margin-top: 100px">
        </a>

        <!-- Modal -->
        <div class="modal" id="fridge-products-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{url('products/add')}}" method="post">
                        @csrf
                        <div class="hide" id="fridge-products">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Šaldytuvas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="m-4 modal-body">
                                <h4>Produktai:</h4>
                                @if(isset($products['fridge']))
                                    @foreach ($products['fridge'] as $product)
                                        <p>{{ $product['data']->name }}
                                            <input type="checkbox" class="ml-2 product-checked" name="selected[{{ $product['data']->id }}]" data-product="{{ $product['data']->id }}">

                                        <div id="quantity-wrap-{{ $product['data']->id }}" class="hide">
                                            <input type="number" class="ml-2" step="0.01"  name="quantity[{{ $product['data']->id }}]" min="0.01" max="10000">

                                            <select name="units[{{ $product['data']->id }}]">
                                                @foreach ($product['units'] as $unit_id => $unit)
                                                    <option value="{{ $unit_id }}">{{ $unit }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        </p>
                                    @endforeach
                                @endif
                                <input type="hidden" disabled name="type" value="fridge" id="type-fridge">

                            </div>
                        </div>
                        <div class="hide" id="cabinet-products">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Spintelė</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="m-4">
                                <h4>Produktai:</h4>
                                @if(isset($products['cabinet']))
                                    @foreach ($products['cabinet'] as $product)
                                        <p>{{ $product['data']->name }}
                                            <input type="checkbox" class="ml-2 product-checked" name="selected[{{ $product['data']->id }}]" data-product="{{ $product['data']->id }}">

                                        <div id="quantity-wrap-{{ $product['data']->id }}" class="hide">
                                            <input type="number" class="ml-2" step="0.01"  name="quantity[{{ $product['data']->id }}]" min="0.01" max="10000">

                                            <select name="units[{{ $product['data']->id }}]">
                                                @foreach ($product['units'] as $unit_id => $unit)
                                                    <option value="{{ $unit_id }}">{{ $unit }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        </p>

                                    @endforeach
                                @endif
                                <input type="hidden" disabled name="type" value="cabinet" id="type-cabinet">

                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Uždaryti</button>
                            <button type="submit" class="btn btn-primary">Išsaugoti</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>

    <div class="row w-100">

        <div class="col-12">
            <div class="alert alert-primary text-center" role="alert">
                Pasirinkite produktus
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ URL::asset('js/start.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/products.js') }}"></script>
@endsection
