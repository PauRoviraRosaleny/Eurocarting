@extends('layouts.header')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" href="{{asset('css/contact.css')}}">

<div class="container mt-5">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <h2 class="text-center mb-4">{{__('messages.Contacto')}}</h2>
      <form method="POST" action="{{ route('contact.send') }}">
        @csrf
        <div class="form-group">
          <label for="name">{{__('messages.Nombre')}}</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="{{__('messages.Nombre')}}" required>
        </div>
        <div class="form-group">
          <label for="email">{{__('messages.Email')}}</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="{{__('messages.Email')}}" required>
        </div>
        <div class="form-group">
          <label for="message">{{__('messages.Mensaje')}}</label>
          <textarea class="form-control" id="message" name="message" rows="5" placeholder="{{__('messages.Mensaje')}}" required></textarea>
        </div>
        <button type="submit" class="btn btn-danger btn-block">{{__('messages.EnviarMensaje')}}</button>
      </form>
    </div>
  </div>
</div>
@endsection
