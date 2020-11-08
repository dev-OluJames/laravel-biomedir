@extends('master')
@section('content')
{{view('admin.header')}}
<div class="container" style="padding-top: 50px">
    <form action="admin" enctype="multipart/form-data" method="POST">
        {{ csrf_field() }}
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Email</label>
                <input type="hidden" value="{{$user->id}}" name="id">
                <input type="email" class="form-control" id="inputEmail4" value="{{$user->email}}" readonly style="background: white">
            </div>
            <div class="form-group col-md-6">
                <label for="inputName">Name</label>
                <input type="text" class="form-control" id="inputName" value="{{$user->name}}" style="background: white">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="Pas d'address" value="{{$user->user_address}}" readonly style="background: white">
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputState">Role</label>
                <select id="inputState" class="form-control" name="type">
                    @if($user->user_type == 'super_admin')
                    <option selected>{{$user->user_type}}</option>
                    <option>admin</option>
                    <option></option>
                    @elseif($user->user_type == 'admin')
                    <option selected>admin</option>
                    <option >suer_admin</option>
                    <option></option>
                    @else
                    <option selected></option>
                    <option >admin</option>
                    <option>suer_admin</option>
                    @endif
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Etat</label>
                <select id="inputState" class="form-control" name="state">
                    @if($user->user_state == 'actif')
                    <option selected>{{$user->user_state}}</option>
                    <option>inactif</option>
                    @else
                    <option selected>inactif</option>
                    <option>actif</option>
                    @endif
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>
@endsection('content')
