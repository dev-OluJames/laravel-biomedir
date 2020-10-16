@extends('master')
@section('content')
{{View::make('header')}}
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/blog_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/blog_responsive.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/contact_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/contact_responsive.css')}}">

<div class="section">
<div class="contact_form">
    <div class="container">
        <div class="navbar bg-white breadcrumb-bar ">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{url('categories')}}">Gestion Articles</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ajouter</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="contact_form_container">
                    <div class="contact_form_title">Ajouter une Catégorie</div>

                    <form action="add_categories" id="contact_form" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-6">
                                <label >Equipement</label>
                                <input type="text" id="category_name" class="form-control" placeholder="Nom de Catégorie" required="required" name="category_name">
                                @if ($errors->has('category_name'))
                                <span class="error">{{ $errors->first('category_name') }}</span>
                                @endif
                            </div>
                            <div class="ml-md-3">
                                <br>
                                <label for="exampleFormControlFile1">Image de la catégorie</label>
                                <input type="file" class="form-control-file" id="category_icon" name="category_icon" >
                            </div>
                        </div>

                        <div class="contact_form_button">
                            <button type="submit" class="button contact_submit_button">Ajouter</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content')
