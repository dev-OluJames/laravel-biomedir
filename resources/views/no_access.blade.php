@extends('master')
@section('content')
{{View::make('header')}}
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/contact_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/contact_responsive.css')}}">
<br><br><br>
<div class="container">
    <div class="card">
        <h3 class="card-header">No Access/Accès Refusé</h3>
        <div class="card-body">
            <h4 class="card-title">Accès Non Autorisé</h4>
            <p class="card-text">Vous ne pouvez pas avoir accès à cette page Veuillez Consulter l'Administrateur</p>
            <a href={{url('index')}} class="btn btn-primary">Acceuil</a>
        </div>
    </div>
</div>

@endsection('content')
