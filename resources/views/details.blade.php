@extends('layouts.header')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<div class="container mt-5">
    <div class="row" style="margin-top:150px">
        
            <form class="row" method="post" action="{{route('create.add')}}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-fn">Model</label>
                        <input class="form-control" type="text" id="account-fn" name="model" value="" required="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-fn">Brand</label>
                        <input class="form-control" type="text" id="account-fn" name="brand" value="" required="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-fn">Price</label>
                        <input class="form-control" type="number" id="account-fn" name="price" value="" required="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-fn">Seats</label>
                        <input class="form-control" type="number" id="account-fn" name="seats" value="" required="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-fn">Doors</label>
                        <input class="form-control" type="number" id="account-fn" name="doors" value="" required="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-fn">Bags</label>
                        <input class="form-control" type="number" id="account-fn" name="bags" value="" required="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="engine">Engine</label>
                        <select class="form-select" id="engine" name="engine">
                            <option value="" disabled selected>Select an engine type</option>
                            <option value="Gasoline">Gasoline</option>
                            <option value="Diesel">Diesel</option>
                            <option value="Electric">Electric</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="transmission">Transmission</label>
                        <select class="form-select" id="transmission" name="transmission">
                            <option value="" disabled selected>Select a transmission</option>
                            <option value="Manual">Manual</option>
                            <option value="Automatic">Automatic</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="transmission">Air-conditioning</label>
                        <select class="form-select" id="air_conditioning" name="air_conditioning">
                            <option value="" disabled selected>Select an option</option>
                            <option value="0">Yes</option>
                            <option value="1">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="image">Image</label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <label class="input-group-text" for="image">Choose file</label>
                        </div>
                    </div>
                </div>
                
                <div class="col-12">
                    <hr class="mt-2 mb-3">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <button class="btn btn-style-1 btn-primary" type="submit" data-toast="" data-toast-position="topRight" data-toast-type="success" data-toast-icon="fe-icon-check-circle" data-toast-title="Success!" data-toast-message="Your profile updated successfuly.">Add car</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection