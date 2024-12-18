@extends('layouts.header')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
<link rel="stylesheet" href="{{asset('css/login.css')}}">

<style>
    body{
        background-image: url('{{ asset('Uploads/background.jpg')}}');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        overflow-y: hidden;
    }

    header{
    border-bottom: none;

    }

</style>


<section class="sign-in">
    <div class="form-container">
        <div class="signup-content">
            <div class="signup-form">
                <h2 class="form-title">{{__('messages.Registro')}}</h2>
                <br>
                <form method="POST" class="register-form" id="register-form" action="{{route('reg')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="name" id="name" placeholder="{{__('messages.Nombredeusuario')}}" value="{{old('name')}}"/>
                        @error('name')
                            <p style="color: red">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="email" name="email" id="email" placeholder="{{__('messages.Email')}}" value="{{old('email')}}"/>
                        @error('email')
                            <p style="color: red">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone"><i class="zmdi zmdi-phone"></i></label>
                        <input type="number" name="phone" id="phone" placeholder="{{__('messages.Numerodetelefono')}}" value="{{old('phone')}}"/>
                        @error('phone')
                            <p style="color: red">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="pass" ><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="password" id="pass" placeholder="{{__('messages.Contraseña')}}"/>
                        @error('password')
                            <p style="color: red">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                        <input type="password" name="password_confirmation" id="re_pass" placeholder="{{__('messages.ConfirmarContraseña')}}"/>
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>

                    <div class="form-group form-button">
                        <input type="submit" name="signup" id="signup" class="form-submit" value="{{__('messages.Registrarse')}}"/>
                    </div>
                </form>
            </div>
            <div class="signin-image">
                <figure><img src="{{ asset('Uploads/logo.png') }}" alt="sing up image" style="margin-top: 50px"></figure>
                <a href="{{route('login')}}" class="signup-image-link">{{__('messages.Yatengounacuenta')}}</a>
            </div>
        </div>
    </div>
</section>

@endsection
