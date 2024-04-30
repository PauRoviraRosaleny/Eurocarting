@extends('layouts.header')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<link rel="stylesheet" href="{{asset('css/index.css')}}">

<div class="container mt-5">
    <div class="row">
        <!-- Barra de filtros -->
        <div class="col-md-3">
            <form action="{{route('search')}}" method="GET">
                @csrf
                <!-- Aquí puedes agregar los elementos de filtro -->
                <h4>Brands</h4>
                <!-- Por ejemplo, un filtro por marca -->
                <select name="brand" class="form-select">
                    <option value="all" selected>All</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->brand }}"
                            @if (isset($_GET['brand']))
                                {{ $_GET['brand'] == $brand->brand ? 'selected' : ''}}
                            @endif
                        >
                            {{ $brand->brand }}
                        </option>
                    @endforeach
                </select>
                <br>

                <h4>Price</h4>
                <!-- Slider de rango de precios -->
                <div class="mb-3">
                    <label for="priceRangeMin" class="form-label">Min Price:</label>
                    <input type="number" class="form-control" id="priceRangeMin" name="priceRangeMin" value="{{ isset($_GET['priceRangeMin']) ? $_GET['priceRangeMin'] : 0 }}" min="0" max="10000">
                </div>
                <div class="mb-3">
                    <label for="priceRangeMax" class="form-label">Max Price:</label>
                    <input type="number" class="form-control" id="priceRangeMax" name="priceRangeMax" value="{{ isset($_GET['priceRangeMax']) ? $_GET['priceRangeMax'] : 10000 }}" min="0" max="10000">
                </div>
                <br>

                <h4>Transmission</h4>
                <select name="transmission" class="form-select">
                    <option value="all" selected>All</option>
                    @foreach ($transmissions as $transmission)
                        <option value="{{ $transmission->transmission }}"
                            @if (isset($_GET['transmission']))
                                {{ $_GET['transmission'] == $transmission->transmission ? 'selected' : ''}}
                            @endif
                        >
                            {{ $transmission->transmission }}
                        </option>
                    @endforeach
                </select>
                <br>

                <h4>Engine</h4>
                <select name="engine" class="form-select">
                    <option value="all" selected>All</option>
                    @foreach ($engines as $engine)
                        <option value="{{ $engine->engine }}"
                            @if (isset($_GET['engine']))
                                {{ $_GET['engine'] == $engine->engine ? 'selected' : ''}}
                            @endif
                        >
                            {{ $engine->engine }}
                        </option>
                    @endforeach
                </select>
                <br>

                <h4>Seats</h4>
                <div class="mt-1">
                    <input type="checkbox" id="seats" name="seats" value="1" {{ isset($_GET['seats']) && $_GET['seats'] == 1 ? 'checked' : ''}}>
                    <label for="seats">More than 5 seats</label>
                </div>
                <br>

                <h4>Air-conditioning</h4>
                <div class="mt-1">
                    <input type="checkbox" id="air-conditioning" name="air_conditioning" value="2" {{ isset($_GET['air_conditioning']) && $_GET['air_conditioning'] == 2 ? 'checked' : ''}}>
                    <label for="air-conditioning">Air-conditioning</label>
                </div>
                <br>

                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        <!-- Tarjetas de coches -->
        <div class="col-md-9">
            @foreach ($cars as $car)
                @if ($car->rented == 0)
                    <div class="container mt-3 mb-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="p-2 bg-white border rounded">
                                    <div class="row">
                                        <div class="col-md-4 mt-1 text-center">
                                            <h3>{{ $car->brand }} {{ $car->model }}</h3><p>o similar</p>
                                            <img class="img-fluid img-responsive rounded product-image" src="{{asset($car->image)}}" style="max-height: 200px; margin-bottom: 20px;">
                                        </div>
                                        <div class="col-md-5 mt-1 d-flex justify-content-center align-items-center">
                                            <div class="d-flex flex-wrap">
                                                <span class="data mb-2 mr-3" title="{{ $car->transmission }}"><img src="{{asset('/Uploads/Icons/gearbox.png')}}" alt="" class="icon"> {{ $car->transmission }}</span>
                                                <span class="data mb-2 mr-3" title="{{ $car->engine }}"><img src="{{asset('/Uploads/Icons/gas.png')}}" alt="" class="icon"> {{ $car->engine }}</span>
                                                <span class="data mb-2 mr-3" title="Nº of doors"><img src="{{asset('/Uploads/Icons/door.png')}}" alt="" class="icon"> {{ $car->doors }}</span>
                                                <span class="data mb-2 mr-3" title="Nº of bags"><img src="{{asset('/Uploads/Icons/bag.png')}}" alt="" class="icon"> {{ $car->bags }}</span>
                                                <span class="data mb-2 mr-3" title="Nº of seats"><img src="{{asset('/Uploads/Icons/seat.png')}}" alt="" class="icon">{{ $car->seats }}</span>
                                                <span class="data mb-2" title="Air-conditioning"><img src="{{asset('/Uploads/Icons/ac.png')}}" alt="" class="icon">@if ($car->air_conditioning == 0) Yes @else No @endif</span>
                                            </div>
                                        </div>
                                        <div class="align-items-center col-md-3 border-left mt-1 d-flex flex-column justify-content-center">
                                            <div class="align-items-center">
                                                <h4 class="mr-1"> {{ $car->price }}€/day</h4>
                                            </div>
                                            <div class="d-flex flex-column mt-4">
                                                @auth
                                                    @if (Auth::user()->role == 'admin')
                                                        <form action="{{ route('edit', $car->id) }}" method="GET">
                                                            <button name="details" class="btn btn-primary btn-sm" style="width: 100%" type="">Edit</button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('details', $car->id) }}" method="GET">
                                                            <button name="details" class="btn btn-primary btn-sm" style="width: 100%">Rent</button>
                                                        </form>
                                                    @endif
                                                @endauth

                                                @guest
                                                    <form action="{{ route('details', $car->id) }}" method="GET">
                                                        <button name="details" class="btn btn-primary btn-sm" style="width: 100%">Rent</button>
                                                    </form>
                                                @endguest
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

@endsection
