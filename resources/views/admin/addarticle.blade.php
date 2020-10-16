@extends('master')
@section('content')
{{view('header')}}
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/blog_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/blog_responsive.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/contact_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/contact_responsive.css')}}">
<script src="https://cdn.ckeditor.com/4.15.0/full/ckeditor.js"></script>

<div class="section">
    <div class="container">
        </div>
        <div class="navbar bg-white breadcrumb-bar ">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{url('categories')}}">Equipements</a></li>
                    @if(empty($category))
                    <li class="breadcrumb-item active" ><a href="{{url('show_categories/'.$sub_category[0]->slug)}}">{{$sub_category[0]->category_name}}</a></li>
                    @else
                    <li class="breadcrumb-item active"><a href="{{url('show_categories/'.$category->slug)}}">{{$category->category_name}}</a></li>
                    <li class="breadcrumb-item active" ><a href="{{url('show_categories/'.$sub_category[0]->slug)}}">{{$sub_category[0]->category_name}}</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">Nouveau Article</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="contact_form_container">
                    <div class="contact_form_title">Ajouter un article</div>
                    @if($article->exists != true)
                    <form action="add_new" id="contact_form" enctype="multipart/form-data" method="POST">
                    @else
                        <form action="edit_article" id="contact_form" enctype="multipart/form-data" method="POST">
                     @endif
                        {{ csrf_field() }}
                        <div class="contact_form_inputs d-flex flex-md-row flex-column justify-content-between align-items-between">

                            <input type="hidden" name="id" value={{$article->id}}>
                            <input type="text" id="contact_form_name" value="{{$article->article_name}}" class="contact_form_name input_field" placeholder="Nom de l'Article" required="required" name="article_name" >
                            @if ($errors->has('article_name'))
                            <span class="error">{{ $errors->first('article_name') }}</span>
                            @endif
                            <input type="text" required="required" id="contact_form_email" value="{{$article->article_model}}" class="contact_form_email input_field" placeholder="Model de l'Article"  name="article_model">
                            @if ($errors->has('article_model'))
                            <span class="error">{{ $errors->first('article_model') }}</span>
                            @endif
                            <textarea id="contact_form_phone"  rows="4" class="contact_form_phone input_field" placeholder="Details" name="article_details">
                                {{$article->article_details}}
                            </textarea>
                            @if ($errors->has('article_details'))
                            <span class="error">{{ $errors->first('article_details') }}</span>
                            @endif
                        </div>

                        <div class="contact_form_inputs d-flex flex-md-row flex-column justify-content-between align-items-between">
                            <input type="number" id="pourcentage" value="{{$article->article_promotion}}" class="contact_form_name input_field" placeholder="Appliquer un Pourcentage" required="required" name="article_promotion" >
                            <!--span >Appliquer un pourcentage</span-->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="article_available" checked>
                                <label class="form-check-label" for="defaultCheck1">
                                    Disponible
                                </label>
                            </div>
                            <select id="inputState" class="form-control  input_field" name="categorie_id">
                                <option selected >{{$sub_category[0]->category_name}}</option>
                                @foreach($subCateg as $item)
                                    @if($item->category_name != $sub_category[0]->category_name)
                                        <option>{{$item->category_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="contact_form_text" id="editor">
                           <textarea id="contact_form_message"  class="text_field contact_form_message" name="article_description" rows="4" placeholder="Description" required="required" data-error="Veuillez rentrer La description de l'article">
                               {{$article->article_description}}
                           </textarea>

                            @if ($errors->has('article_description'))
                                <span class="error">{{ $errors->first('article_description') }}</span>
                            @endif
                        </div>
                        <script>
                            CKEDITOR.replace( 'article_description' );
                        </script>
                        <div class="form-check ml-3">
                            <input class="form-check-input" name="article_version" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">New Version</label>
                        </div>

                        <div class="row">

                            @if($article->exists != false)
                            <div class="col-4">
                                <label for="exampleFormControlFile1">Image de l'article 1</label>
                                <input type="file" value="{{$article->article_image1}}" name="article_image1" class="form-control-file" id="exampleFormControlFile1">
                                <img src=" {{asset('asset/images/'.$article->article_image1)}}" alt="" height="200" width="200">
                            </div>
                            <div class="col-4">
                                <label for="exampleFormControlFile1">Image de l'article 2</label>
                                <input type="file" name="article_image2" class="form-control-file" id="exampleFormControlFile2">
                                <img src=" {{asset('asset/images/'.$article->article_image2)}}" alt="" height="200" width="200">
                            </div>
                            <div class="col-4">
                                <label for="exampleFormControlFile1">Image de l'article 3 </label>
                                <input type="file" name="article_image3" class="form-control-file" id="exampleFormControlFile3">
                                <img src=" {{asset('asset/images/'.$article->article_image3)}}" alt="" height="200" width="200">
                            </div>
                            @else
                            <div class="col-4">
                                <label for="exampleFormControlFile1">Image de l'article 1</label>
                                <input type="file" value="{{$article->article_image1}}" name="article_image1" class="form-control-file" id="exampleFormControlFile1">
                            </div>
                            <div class="col-4">
                                <label for="exampleFormControlFile1">Image de l'article 2</label>
                                <input type="file" name="article_image2" class="form-control-file" id="exampleFormControlFile2">
                            </div>
                            <div class="col-4">
                                <label for="exampleFormControlFile1">Image de l'article 3 </label>
                                <input type="file" name="article_image3" class="form-control-file" id="exampleFormControlFile3">
                            </div>
                            @endif
                        </div>
                        <div class="contact_form_button">
                            <button type="submit" class="button contact_submit_button">Ajouter</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="panel"></div>
</div>

@endsection('content')
