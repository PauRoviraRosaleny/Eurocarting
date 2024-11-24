@extends('layouts.header')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<link rel="stylesheet" href="{{asset('css/index.css')}}">

<style>
    body{
        background-image: url('{{ asset('Uploads/background.jpg')}}');
        background-size: cover; /* Ajusta el tamaño de la imagen para cubrir toda la página */
        background-repeat: no-repeat; /* Evita la repetición de la imagen */
        background-attachment: fixed; /* Fija la imagen de fondo para que no se desplace con el contenido */
        overflow-y: hidden;
    }

    header{
    border-bottom: none;

    }

    footer{
    border-top: none;

    }
</style>
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



<div class="container">
    <div class="searchContainer">
        <form action="{{ route('searchCars') }}" method="GET" class="searchForm">
            @csrf
            <div class="mb-3 text-center">
                <label for="startDate" class="form-label">{{__('messages.Fechaderecogida:')}}</label>
                <input type="text" id="startDate" name="startDate" class="form-control text-center" placeholder="" value="{{ $startDate ?? old('startDate') }}">
            </div>
            <div class="mb-3 text-center">
                <label for="endDate" class="form-label">{{__('messages.Fechadedevolución:')}}</label>
                <input type="text" id="endDate" name="endDate" class="form-control text-center" placeholder="" value="{{ $endDate ?? old('endDate') }}">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-danger searchCars" name="searchCars">{{__('messages.Buscar')}}</button>
            </div>
        </form>
    </div>
</div>

@endsection
