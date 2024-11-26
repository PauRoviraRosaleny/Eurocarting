@extends('layouts.header')
@section('content')


<link rel="stylesheet" href="{{asset('css/account.css')}}">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">


<div class="container mt-5">
    <div class="row" style="margin-top:150px">
        <div class="col-lg-4 pb-5">
            <!-- Account Sidebar-->
            <div class="author-card pb-3">

                <div class="author-card-profile">
                    <div class="author-card-avatar"><img src="{{Asset(Auth::user()->image)}}" alt="">
                    </div>
                    <div class="author-card-details">
                        <h5 class="author-card-name text-lg">{{ Auth::user()->name }}</h5><span class="author-card-position">{{ Auth::user()->email }}</span>
                    </div>
                </div>
            </div>
            <div class="wizard">
                <nav class="list-group list-group-flush">
                    <a class="list-group-item" href="{{route('account')}}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><i class="bi bi-bag mr-1 text-muted"></i>
                                <div class="d-inline-block font-weight-medium text-uppercase">{{__('messages.Listadepedidos')}}</div>
                            </div><span class="badge badge-secondary">6</span>
                        </div>
                    </a><a class="list-group-item active" ><i class="bi bi-person text-muted"></i>{{__('messages.Ajustesdelperfil')}}</a>
                    <a class="list-group-item" href="{{route('logout')}}" tagert="__blank">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><i class="bi bi-box-arrow-left mr-1 text-muted"></i>
                                <div class="d-inline-block font-weight-medium text-uppercase">{{__('messages.Cerrarsesion')}}</div>
                            </div><span class="badge badge-secondary">3</span>
                        </div>
                    </a>
                </nav>
            </div>
        </div>
        <!-- Profile Settings-->
        <div class="col-lg-8 pb-5" style="margin-top: 70px">
            <form class="row" method="post" action="{{route('settings.update')}}">
                @csrf
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-fn">{{__('messages.Nombre')}}</label>
                        <input class="form-control" type="text" id="account-fn" name="name" value="{{Auth::user()->name}}" required="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-email">{{__('messages.Email')}}</label>
                        <input class="form-control" type="email" id="account-email" name="email" value="{{Auth::user()->email}}" disabled="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-phone">{{__('messages.Numerodetelefono')}}</label>
                        <input class="form-control" type="text" id="account-phone" name="phone" value="{{Auth::user()->phone}}" required="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-pass">{{__('messages.NuevaContraseña')}}</label>
                        <input class="form-control" type="password" id="account-pass" name="password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-confirm-pass">{{__('messages.ConfirmarContraseña')}}</label>
                        <input class="form-control" type="password" id="account-confirm-pass" name="password_confirmation">
                    </div>
                </div>
                <div class="col-12">
                    <hr class="mt-2 mb-3">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <button class="btn btn-style-1 btn-danger" type="submit" data-toast="" data-toast-position="topRight" data-toast-type="success" data-toast-icon="fe-icon-check-circle" data-toast-title="Success!" data-toast-message="Your profile updated successfuly.">{{__('messages.ActualizarPerfil')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
