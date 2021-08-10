@extends('layouts.default')

@section('content')
    <div class="col-md-6 p-4">
        @if(isset($myProducts))
        <h3>Mano produktai</h3>
            @foreach ($myProducts as $product)
                <div class="card mt-2" style="width: 10rem;">
                    <img class="card-img-top"  src="{{ URL::to('/') }}/images/food.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->quantity }}  {{ $product->unit }}</p>
                    </div>
                </div>
            @endforeach
        @endif

        @if(count($myProducts) == 0)
            <div class="alert alert-primary" role="alert">
                Nėra produktų
            </div>
        @endif
    </div>

    <div class="col-6 p-4">
        @if(isset($recepies))
        <h3>Receptai</h3>
            @foreach ($recepies as $recepie)
                <div class="card  {{$statuses[$recepie->recepy_id]}} mt-2" style="width: 18rem;">
                    <img class="card-img-top" src="{{ URL::to('/') }}/images/recepy.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $recepie->name }}</h5>
                        <p class="card-text">
                            {{ $recepie->description }}
                            <hr>
                            <h6>Ingredientai</h6>

                            <ul>
                                @foreach ($ingridients[$recepie->recepy_id] as $ingridient)
                                    <li>
                                        {{ $ingridient->product }}
                                        {{ $ingridient->quantity }}
                                        {{ $ingridient->unit }}
                                    </li>
                                @endforeach
                            </ul>
                        </p>
                    </div>
                </div>
            @endforeach
        @endif

        @if(count($recepies) == 0)
            <div class="alert alert-primary" role="alert">
                No recepies
            </div>
        @endif
    </div>
@endsection
