@extends('master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/blog_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/blog_responsive.css')}}">
{{view('admin.header')}}
<div class="container">

    <h1 class="display-4">Admins</h1>
    <div class="table-responsive">
    <table class="table">
        <caption>List of users</caption>
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom Complet</th>
            <th scope="col">Email</th>
            <th scope="col">Etat</th>
            <th scope="col">Operations</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            @if($user->user_state == "actif")
            <td style="color: #28d04f; font: inherit; font-weight: bold; font-size: 24px"> Actif </td>
            @else
            <td style="color: gray; font:  inherit; font-weight: bold; font-size: 24px"> Inactif </td>
            @endif
            <td>
                <button type="button" class="btn btn-primary btn-sm"><a href="{{url('admin/'.$user->name.'/'.$user->id)}}" style="color: white">Edit</a></button>
                <button type="button" class="btn btn-danger btn-sm">Delete</button>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection('content')

