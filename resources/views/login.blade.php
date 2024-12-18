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
        <div class="signin-content">
            <div class="signin-image">
                <figure><img src="{{ asset('Uploads/logo.png') }}" alt="sing up image"></figure>
                <a href="{{route('register')}}" class="signup-image-link">{{__('messages.CrearCuenta')}}</a>
            </div>

            <div class="signin-form">
                <h2 class="form-title">{{__('messages.IniciodeSesion')}}</h2>
                <br>
                <form method="POST" class="register-form" id="login-form" action="{{route('log')}}">
                    @csrf
                    <div class="form-group">
                        <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="name" id="your_name" placeholder="{{__('messages.Nombredeusuario')}}" value="{{old('name')}}"/>
                        @error('name')
                            <p style="color: red">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="password" id="your_pass" placeholder="{{__('messages.Contraseña')}}" value="{{old('password')}}"/>
                        @error('password')
                            <p style="color: red">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                        <label for="remember-me" class="label-agree-term"><span><span></span></span>{{__('messages.Recordarme')}}</label>
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="signin" id="signin" class="form-submit" value="{{__('messages.IniciarSesion')}}"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
