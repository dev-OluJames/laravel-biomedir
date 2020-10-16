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
                    <li class="breadcrumb-item"><a href="{{url('index')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{url('categories')}}">Equipements</a></li>
                    @if($parent_categ)
                    <li class="breadcrumb-item active"><a href="{{url('show_categories/'.$parent_categ->slug)}}">{{$parent_categ->category_name}}</a></li>
                    @endif
                    @if($category)
                    <li class="breadcrumb-item active"><a href="{{url('show_categories/'.$category->slug)}}">{{$category->category_name}}</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">Ajouter</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="contact_form_container">
                    <div class="contact_form_title">Ajouter une Catégorie d'articles pour l'Equipement {{$category->category_name}}</div>

                    <form action="add_categories" id="contact_form" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-6">
                                <label >Catégorie d'Article</label>
                                <input type="text" id="category_name" class="form-control" placeholder="Nom de Catégorie" required="required" name="category_name">
                                @if ($errors->has('category_name'))
                                <span class="error">{{ $errors->first('category_name') }}</span>
                                @endif
                            </div>
                            <div class="col-6">
                                <label >Equipement </label>
                                <select name="categorie_id" id="inputState" class="form-control">
                                    <option selected>{{$category->category_name}}</option>
                                @foreach(App\Models\Categorie::find($category->id)->child as $sub_category)
                                    <option>{{$sub_category->category_name}}</option>
                                @endforeach
                                </select>
                                <br>
                            </div
                        </div>
                        <div class="col-6">
                            <input type="file" class="form-control-file" id="category_icon" name="category_icon" >
                            <div class="contact_form_button">
                                <button type="submit" class="button contact_submit_button">Ajouter</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content')
