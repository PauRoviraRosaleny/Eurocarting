@extends('layouts.header')
@section('content')

<link rel="stylesheet" href="{{asset('css/account.css')}}">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">



<div class="container mb-4 main-container" style="margin-top: 150px">
    <div class="row">
        <div class="col-lg-4 pb-5">
            <!-- Account Sidebar-->
            <div class="author-card pb-3">

                <div class="author-card-profile" style="">
                    <div class="author-card-avatar"><img src="{{Asset(Auth::user()->image)}}" alt="">
                    </div>
                    <div class="author-card-details">
                        <h5 class="author-card-name text-lg">{{ Auth::user()->name }}</h5><span class="author-card-position">{{ Auth::user()->email }}</span>
                    </div>
                </div>
            </div>
            <div class="wizard">
                <nav class="list-group list-group-flush">
                    <a class="list-group-item active" href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><i class="bi bi-bag mr-1 text-muted"></i>
                                <div class="d-inline-block font-weight-medium text-uppercase">{{__('messages.Listadepedidos')}}</div>
                            </div><span class="badge badge-secondary">6</span>
                        </div>
                    </a><a class="list-group-item" href="{{route('settings')}}"><i class="bi bi-person text-muted"></i>{{__('messages.Ajustesdelperfil')}}</a>
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
        <!-- Orders Table-->
        <div class="col-lg-8 pb-5">
            <div class="d-flex justify-content-end pb-3">
                <div class="form-inline">
                    <label class="text-muted mr-3" for="order-sort">{{__('messages.Filtrarpedidos')}}</label>
                    <select class="form-control" id="order-sort" onchange="filterLoans()">
                        <option value="all">{{__('messages.Todos')}}</option>
                        <option value="active">{{__('messages.Activo')}}</option>
                        <option value="inactive">{{__('messages.Inactivo')}}</option>
                    </select>

                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>{{__('messages.Pedido')}} #</th>
                            <th>{{__('messages.Fechaderecogida')}}</th>
                            <th>{{__('messages.Fechadedevolución')}}</th>
                            <th>{{__('messages.Vehiculo')}}</th>
                            <th>{{__('messages.Estado')}}</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loans as $loan)
                        @csrf


                        <tr>
                            <td><a class="navi-link" href="#order-details" data-toggle="modal" style="color: #83072D; font-weight: bold">{{$loan->id}}</a></td>
                            <td>{{$loan->start_date }}</td>
                            <td><span>{{$loan->end_date }}</span></td>
                            <td><span>{{$loan->car_name}}</span></td>
                            @if ($loan->active == 0)
                            <td><span>{{__('messages.Activo')}}</span></td>
                            @else
                            <td><span>{{__('messages.Inactivo')}}</span></td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
