@extends('layouts.header')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<link rel="stylesheet" href="{{asset('css/create.css')}}">

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('image-preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form class="row" method="post" action="{{route('edit.update', $car->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6 mt-3">
                    <div class="form-group" style="margin-top: 100px">
                        <div class="input-group" style="border: 2px solid #ced4da; border-radius: 0.25rem;">
                            <label for="image" style="cursor: pointer;">
                                <img id="image-preview" src="{{ asset($car->image) }}" class="img-fluid mb-3" alt="Current Image">
                                <input type="file" id="image" name="image" accept="image/*" style="display: none;" onchange="previewImage(event);">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="account-fn">{{__('messages.Modelo')}}</label>
                                <input class="form-control" type="text" id="account-fn" name="model" value="{{ $car->model}}" required="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="account-fn">{{__('messages.Marca')}}</label>
                                <input class="form-control" type="text" id="account-fn" name="brand" value="{{ $car->brand}}" required="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="account-fn">{{__('messages.Precio')}}</label>
                                <input class="form-control" type="number" id="account-fn" name="price" value="{{ $car->price}}" required="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="account-fn">{{__('messages.Plazas')}}</label>
                                <input class="form-control" type="number" id="account-fn" name="seats" value="{{ $car->seats}}" required="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="account-fn">{{__('messages.Puertas')}}</label>
                                <input class="form-control" type="number" id="account-fn" name="doors" value="{{ $car->doors}}" required="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="account-fn">{{__('messages.Bolsas')}}</label>
                                <input class="form-control" type="number" id="account-fn" name="bags" value="{{ $car->bags}}" required="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="engine">{{__('messages.Motor')}}</label>
                                <select class="form-select" id="engine" name="engine" >
                                    <option value="" disabled>{{__('messages.SeleccionaMotor')}}</option>
                                    <option value="Gasoline" {{ $car->engine === 'Gasoline' ? 'selected' : '' }}>{{__('messages.Gasolina')}}</option>
                                    <option value="Diesel" {{ $car->engine === 'Diesel' ? 'selected' : '' }}>{{__('messages.Diesel')}}</option>
                                    <option value="Electric" {{ $car->engine === 'Electric' ? 'selected' : '' }}>{{__('messages.Electrico')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="transmission">{{__('messages.Transmision')}}</label>
                                <select class="form-select" id="transmission" name="transmission">
                                    <option value="" disabled>{{__('messages.SeleccionaTransmision')}}</option>
                                    <option value="Manual" {{ $car->transmission === 'Manual' ? 'selected' : '' }}>{{__('messages.Manual')}}</option>
                                    <option value="Automatic" {{ $car->transmission === 'Automatic' ? 'selected' : '' }}> {{__('messages.Automatica')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="air_conditioning">{{__('messages.AireAcondicionado')}}</label>
                                <select class="form-select" id="air_conditioning" name="air_conditioning">
                                    <option value="" disabled>{{__('messages.SeleccionaOpcion')}}</option>
                                    <option value="0" {{ $car->air_conditioning == 0 ? 'selected' : '' }}>{{__('messages.Si')}}</option>
                                    <option value="1" {{ $car->air_conditioning == 1 ? 'selected' : '' }}>{{__('messages.No')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <hr class="mt-2 mb-3">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <button class="btn btn-style-1 btn-danger" type="submit" data-toast="" data-toast-position="topRight" data-toast-type="success" data-toast-icon="fe-icon-check-circle" data-toast-title="Success!" data-toast-message="Your profile updated successfuly.">{{__('messages.ActualizarVehiculo')}}</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
