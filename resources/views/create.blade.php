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

    function validateForm() {
        var imageInput = document.getElementById('image');
        if (imageInput.files.length === 0) {
            alert('{{__("messages.Eligeunaimagen")}}.');
            return false;
        }
        return true;
    }
</script>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form class="row" method="post" action="{{route('create.add')}}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6 mt-3">
                    <div class="form-group" style="margin-top: 100px">
                        <label for="image" style="cursor: pointer;">
                            <div class="input-group" style="border: 2px solid #ced4da; border-radius: 0.25rem; min-height: 300px; min-width: 300px; display: flex; justify-content: center; align-items: center;">
                                <img id="image-preview" src="" class="img-fluid mb-3" alt="{{__('messages.Imagen')}}">
                                <input type="file" id="image" name="image" accept="image/*" style="display: none;" onchange="previewImage(event);">
                            </div>
                            @error('image')
                                    <p style="color: red">{{$message}}</p>
                            @enderror
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="account-fn">{{__('messages.Modelo')}}</label>
                                <input class="form-control" type="text" id="account-fn" name="model" value="" required="">
                                @error('model')
                                    <p style="color: red">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="account-fn">{{__('messages.Marca')}}</label>
                                <input class="form-control" type="text" id="account-fn" name="brand" value="" required="">
                                @error('brand')
                                    <p style="color: red">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="account-fn">{{__('messages.Precio')}}</label>
                                <input class="form-control" type="number" id="account-fn" name="price" value="" required="">
                                @error('price')
                                    <p style="color: red">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="account-fn">{{__('messages.Plazas')}}</label>
                                <input class="form-control" type="number" id="account-fn" name="seats" value="" required="">
                                @error('seats')
                                    <p style="color: red">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="account-fn">{{__('messages.Puertas')}}</label>
                                <input class="form-control" type="number" id="account-fn" name="doors" value="" required="">
                                @error('doors')
                                    <p style="color: red">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="account-fn">{{__('messages.Bolsas')}}</label>
                                <input class="form-control" type="number" id="account-fn" name="bags" value="" required="">
                                @error('bags')
                                    <p style="color: red">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="engine">{{__('messages.Motor')}}</label>
                                <select class="form-select" id="engine" name="engine" required>
                                    <option value="" disabled selected>{{__('messages.SeleccionaMotor')}}</option>
                                    <option value="Gasoline">{{__('messages.Gasolina')}}</option>
                                    <option value="Diesel">{{__('messages.Diesel')}}</option>
                                    <option value="Electric">{{__('messages.Electrico')}}</option>
                                </select>
                                @error('engine')
                                    <p style="color: red">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="transmission">{{__('messages.Transmision')}}</label>
                                <select class="form-select" id="transmission" name="transmission" required>
                                    <option value="" disabled selected>{{__('messages.SeleccionaTransmision')}}</option>
                                    <option value="Manual">{{__('messages.Manual')}}</option>
                                    <option value="Automatic">{{__('messages.Automatica')}}</option>
                                </select>
                                @error('transmission')
                                    <p style="color: red">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="transmission">{{__('messages.AireAcondicionado')}}</label>
                                <select class="form-select" id="air_conditioning" name="air_conditioning" required>
                                    <option value="" disabled selected>{{__('messages.SeleccionaOpcion')}}</option>
                                    <option value="0">{{__('messages.Si')}}</option>
                                    <option value="1">{{__('messages.No')}}</option>
                                </select>
                                @error('air_conditioning')
                                    <p style="color: red">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <hr class="mt-2 mb-3">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <button class="btn btn-style-1 btn-danger" type="submit" onclick="return validateForm()">{{__('messages.AñadirVehiculo')}}</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
