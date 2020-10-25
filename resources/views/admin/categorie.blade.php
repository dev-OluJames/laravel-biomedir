@extends('master')
@section('content')
{{View::make('header')}}
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/blog_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/blog_responsive.css')}}">

<!-- Home -->
<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{asset('asset/images/shop_background.jpg')}}"></div>
    <div class="home_overlay"></div>
    <div class="home_content d-flex flex-column align-items-center justify-content-center">
        <h2 class="home_title">List des Catégories</h2>
    </div>
</div>
<div class="blog">
    <div class="container">
        <div class="row">
            <div class="col">
                @if(($aUser['user_type']=='admin' or $aUser['user_type']=='super_admin') and $aUser['user_state']=='actif')
                <button type="button" class=" btn btn-primary btn-lg btn-block"><a href="{{url('add_categories')}}" style="color: whitesmoke">Ajouter Une Catégorie</a></button>
                <br><br>
                @endif
                <div class="blog_posts d-flex flex-row align-items-start justify-content-between">
                    @foreach($data as $item)
                    <!-- Blog post -->
                    <div class="blog_post">
                        <div class="blog_image" style="background-image:url({{asset('asset/images/'. $item->category_icon )}})"></div>
                        <div class="blog_text"><h3>{{$item->category_name}}</h3></div>
                        <div class="blog_button"><a href={{url('show_categories/'.$item->slug) }} >Voire</a></div>
                    </div>
                    @endforeach

                </div>
            </div>

        </div>
        @if(($aUser['user_type']=='admin' or $aUser['user_type']=='super_admin') and $aUser['user_state']=='actif')
        <button type="button" class=" btn btn-primary btn-lg btn-block"><a href="{{url('add_categories')}}" style="color: whitesmoke">Ajouter Une Catégorie</a></button>
        @endif
    </div>
</div>
<!-- /row -->
<!-- /container -->
</div>
@endsection('content')
@section('script_content')
<script src="{{asset('asset/js/shop_custom.js')}}"></script>
@endsection('script_content')
