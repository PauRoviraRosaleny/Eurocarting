@extends('layouts.header')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<link rel="stylesheet" href="{{asset('css/cars.css')}}">

<script>
    $(document).ready(function(){
        $('#startDate').datepicker({
            dateFormat: 'yy-mm-dd',
            startDate: 'today',
            autoclose: true,
            inline: true,
            minDate: 0, // Set minimum date to today
            onSelect: function(selectedDate) {
                $('#endDate').datepicker('option', 'minDate', selectedDate);
            }
        });

        $('#endDate').datepicker({
            dateFormat: 'yy-mm-dd',
            startDate: 'today',
            autoclose: true,
            inline: true,
            onSelect: function(selectedDate) {
                $('#startDate').datepicker('option', 'maxDate', selectedDate);
            }
        });
    });
</script>



<div class="container text-center searchContainter" style=" margin-top:50px; margin-bottom: -30px">
    <form action="{{ route('searchCars') }}" method="GET" class="d-flex align-items-center justify-content-center">
       @csrf
       <div class="col-md-4 col-6 mb-3 me-3">
           <div class="mb-3">
               <label for="startDate" class="form-label">{{__('messages.Fechaderecogida')}}:</label>
               <input type="text" id="startDate" name="startDate" class="form-control" placeholder="" value="{{ $startDate ?? old('startDate') }}">
           </div>
       </div>
       <div class="col-md-4 col-6 mb-3 me-3">
           <div class="mb-3">
               <label for="endDate" class="form-label">{{__('messages.Fechadedevolución')}}:</label>
               <input type="text" id="endDate" name="endDate" class="form-control" placeholder="" value="{{ $endDate ?? old('endDate') }}">
           </div>
       </div>
       <button type="submit" class="btn btn-danger" name="searchCars">{{__('messages.BuscarVehiculos')}}</button>
    </form>
</div>



<div class="container mt-5">
    <div class="row">
        <!-- Barra de filtros -->
        <div class="col-md-3">
            <form action="{{route('searchFilters')}}" method="GET">
                @csrf
                <!-- Aquí puedes agregar los elementos de filtro -->
                <h4>{{__('messages.Marca')}}</h4>
                <!-- Por ejemplo, un filtro por marca -->
                <select name="brand" class="form-select">
                    <option value="all" selected>{{__('messages.Todas')}}</option>
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

                <h4>{{__('messages.Precio')}}</h4>
                <!-- Slider de rango de precios -->
                <div class="mb-3">
                    <label for="priceRangeMin" class="form-label">{{__('messages.Minimo')}}:</label>
                    <input type="number" class="form-control" id="priceRangeMin" name="priceRangeMin" value="{{ isset($_GET['priceRangeMin']) ? $_GET['priceRangeMin'] : 0 }}" min="0" max="10000">
                </div>
                <div class="mb-3">
                    <label for="priceRangeMax" class="form-label">{{__('messages.Maximo')}}:</label>
                    <input type="number" class="form-control" id="priceRangeMax" name="priceRangeMax" value="{{ isset($_GET['priceRangeMax']) ? $_GET['priceRangeMax'] : 10000 }}" min="0" max="10000">
                </div>
                <br>

                <h4>{{__('messages.Transmision')}}</h4>
                <select name="transmission" class="form-select">
                    <option value="all" selected>{{__('messages.Todas')}}</option>
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

                <h4>{{__('messages.Motor')}}</h4>
                <select name="engine" class="form-select">
                    <option value="all" selected>{{__('messages.Todos')}}</option>
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

                <h4>{{__('messages.Plazas')}}</h4>
                <div class="mt-1">
                    <input type="checkbox" id="seats" name="seats" value="1" {{ isset($_GET['seats']) && $_GET['seats'] == 1 ? 'checked' : ''}}>
                    <label for="seats">{{__('messages.Plazas2')}}</label>
                </div>
                <br>

                <h4>{{__('messages.AireAcondicionado')}}</h4>
                <div class="mt-1">
                    <input type="checkbox" id="air-conditioning" name="air_conditioning" value="2" {{ isset($_GET['air_conditioning']) && $_GET['air_conditioning'] == 2 ? 'checked' : ''}}>
                    <label for="air-conditioning">{{__('messages.AireAcondicionado')}}</label>
                </div>
                <br>
                <input type="hidden" id="hiddenStartDate" name="hiddenStartDate" value="{{ $startDate ?? old('startDate') }}">
                <input type="hidden" id="hiddenEndDate" name="hiddenEndDate" value="{{ $endDate ?? old('endDate') }}">
                <button type="submit" class="btn btn-danger">{{__('messages.Filtrar')}}</button>
            </form>
        </div>
        <!-- Tarjetas de coches -->
        <div class="col-md-9">
            @foreach ($cars as $car)

                <div class="container mt-3 mb-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="p-2 bg-white border rounded">
                                <div class="row">
                                    <div class="col-md-4 mt-1 text-center">
                                        <h3>{{ $car->brand }} {{ $car->model }}</h3><p>{{__('messages.Similar')}}</p>
                                        <img class="img-fluid img-responsive rounded product-image" src="{{asset($car->image)}}" style="max-height: 200px; margin-bottom: 20px;">
                                    </div>
                                    <div class="col-md-5 mt-1 d-flex justify-content-center align-items-center">
                                        <div class="d-flex flex-wrap">
                                            <span class="data mb-2 mr-3" title="{{ $car->transmission }}"><img src="{{asset('/Uploads/Icons/gearbox.png')}}" alt="" class="icon"> {{ $car->transmission }}</span>
                                            <span class="data mb-2 mr-3" title="{{ $car->engine }}"><img src="{{asset('/Uploads/Icons/gas.png')}}" alt="" class="icon"> {{ $car->engine }}</span>
                                            <span class="data mb-2 mr-3" title="Nº de puertas"><img src="{{asset('/Uploads/Icons/door.png')}}" alt="" class="icon"> {{ $car->doors }}</span>
                                            <span class="data mb-2 mr-3" title="Nº de bolsas"><img src="{{asset('/Uploads/Icons/bag.png')}}" alt="" class="icon"> {{ $car->bags }}</span>
                                            <span class="data mb-2 mr-3" title="Nº de plazas"><img src="{{asset('/Uploads/Icons/seat.png')}}" alt="" class="icon">{{ $car->seats }}</span>
                                            <span class="data mb-2" title="Aire acondicionado"><img src="{{asset('/Uploads/Icons/ac.png')}}" alt="" class="icon">@if ($car->air_conditioning == 0) {{__('messages.Si')}} @else {{__('messages.No')}} @endif</span>
                                        </div>
                                    </div>
                                    <div class="align-items-center col-md-3 border-left mt-1 d-flex flex-column justify-content-center">
                                        <div class="align-items-center">
                                            <h4 class="mr-1"> {{ $car->price }}€/{{__('messages.Dia')}}</h4>
                                            <p class="">( {{ $car->price }}€ 1 {{__('messages.Dia')}} )</p>
                                        </div>
                                        <div class="d-flex flex-column mt-4">
                                            @auth
                                                @if (Auth::user()->role == 'admin')
                                                    <form action="{{ route('edit', $car->id) }}" method="GET">
                                                        <button name="details" class="btn btn-danger btn-sm" style="width: 150px;">{{__('messages.Editar')}}</button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('details', $car->id) }}" method="GET">
                                                        <input type="hidden" id="hiddenStartDate" name="hiddenStartDate" value="{{ $startDate ?? old('startDate') }}">
                                                        <input type="hidden" id="hiddenEndDate" name="hiddenEndDate" value="{{ $endDate ?? old('endDate') }}">
                                                        <input type="text" id="" name="" disabled value="" style="background-color: white; border: none">
                                                        <button name="details" class="btn btn-danger btn-sm" style="width: 80%; margin-left: 25px">{{__('messages.Alquilar')}}</button>
                                                    </form>
                                                @endif
                                            @endauth
                                         @guest
                                                <form action="{{ route('details', $car->id) }}" method="GET">
                                                    <input type="hidden" id="hiddenStartDate" name="hiddenStartDate" value="{{ $startDate ?? old('startDate') }}">
                                                    <input type="hidden" id="hiddenEndDate" name="hiddenEndDate" value="{{ $endDate ?? old('endDate') }}">
                                                    <input type="text" id="" name="" disabled value="" style="background-color: white; border: none">
                                                        <button name="details" class="btn btn-danger btn-sm" style="width: 80%; margin-left: 25px">{{__('messages.Alquilar')}}</button>
                                                </form>
                                            @endguest
                                        </div>
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

@endsection
