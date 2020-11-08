@extends('master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/cart_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/cart_responsive.css')}}">
{{View::make('header')}}

<style>
    .form-control {
        color: #0e8ce4;
    }
</style>
<div class="container" style="padding-top: 50px">
    <div class="cart_title">Mettez à jour vos informations</div>
    <form action="account" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" id="inputEmail4" name="email" value="{{$user->email}}">
                @if ($errors->has('email'))
                <span class="error">{{ $errors->first('email') }}</span>
                @endif
                <input type="hidden" class="form-control" id="inputEmail4" name="id" value="{{$user->id}}">
            </div>
            <div class="form-group col-md-6">
                <label for="inputName">Name</label>
                <input type="text" class="form-control" id="inputName" name="name" value="{{$user->name}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="Ajouter Une address" name="address" value="{{$user->user_address}}">
        </div>
        <div class="form-group">
            <label for="inputPhone">Telephone</label>
            <input type="text" class="form-control" id="inputPhone" placeholder="Votre Numéro" value="{{$user->phone_number}}" name="phone">
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>

@endsection('content')
@section('script_content')
<script src="{{asset('asset/js/cart_custom.js')}}"></script>
@endsection('script_content')
