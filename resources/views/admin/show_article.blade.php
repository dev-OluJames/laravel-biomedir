@extends('master')
@section('content')
{{View::make('header')}}
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/product_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/product_responsive.css')}}">
@section('title')
{{$article->article_name}}-{{$article->article_model}}
@endsection('title')
<meta property="og:title" content="{{$sub_category->category_name}} - {{$article->article_name}}\{{$article->article_model}}" />
<meta property="og:image" itemprop="image" content="{{secure_asset('asset/images/'.$article->article_image1)}}">
<meta property="og:image:width" content="115">
<meta property="og:image:height" content="115">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
<!-- Single Product -->

<div class="single_product">

    <div class="container">
        @if(Auth::check() and ($aUser['user_type']=='admin' or $aUser['user_type']=='super_admin') and $aUser['user_state']=='actif')
            <button type="button" class="btn btn-outline-primary"><a href={{url('edit/'.$article->slug) }}>Modifier</a></button>
            <button type="button" class="btn btn-outline-danger"><a onclick="return confirm('Are you sure you want to delete this item?');" style="color: red" href={{url('delete/'.$article->id) }}>Delete</a></button>
        <br><br>
        @endif
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-5">
                <div class="social-buttons" style="padding-bottom: 20px">
                    <a href="https://www.facebook.com/sharer.php?u=http://biomedir.herokuapp.com/show_article/{{$article->slug}}"><i class="fab fa-facebook-f" style="color: #ffffff"></i></a>
                    <a href="#"><i class="fab fa-twitter" style="color: #ffffff"></i></a>
                    <a href="#"><i class="fab fa-instagram"style="color: #ffffff"></i></a>
                    <a href="whatsapp://send?text={{$article->article_name}} {{$article->article_model}} http://biomedir.herokuapp.com/show_article/{{$article->slug}}"><i class="fab fa-whatsapp" style="color: #ffffff"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Images -->
            <div class="col-lg-2 order-lg-1 order-2">
                <ul class="image_list">
                    <li data-image="{{asset('asset/images/'.$article->article_image1)}}"><img src="{{asset('asset/images/'.$article->article_image1)}}" alt=""></li>
                    <li data-image="{{asset('asset/images/'.$article->article_image2)}}"><img src="{{asset('asset/images/'.$article->article_image2)}}" alt=""></li>
                    <li data-image="{{asset('asset/images/'.$article->article_image3)}}"><img src="{{asset('asset/images/'.$article->article_image3)}}" alt=""></li>
                </ul>
            </div>

            <!-- Selected Image -->
            <div class="col-lg-5 order-lg-2 order-1">
                <div class="image_selected"><img src="{{asset('asset/images/'.$article->article_image1)}}" height="400" width="400"  alt=""></div>
            </div>

            <!-- Description -->
            <div class="col-lg-5 order-3">
                <div class="product_description">
                    <div class="product_category"><a href="{{url('show_categories/'.$sub_category->slug)}}">{{$sub_category->category_name}}</a></div>
                    <div class="product_name">{{$article->article_name}}</div>
                    <div class="product_name">{{$article->article_model}}</div>
                    <div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div>
                    <div class="product_text"><p>{!! $article->article_details !!}</p></div>
                    <div class="order_info d-flex flex-row">
                        <div class="button_container">
                                <button type="button" class="button cart_button">Contactez nous</button>
                                <div class="product_fav"><i class="fas fa-heart"></i></div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="product_text">{!! $article->article_description !!}</div>
    </div>
</div>

{{View::make('most_viewed')}}
@endsection('content')
@section('script_content')
<script src="{{asset('asset/js/product_custom.js')}}"></script>
@endsection('script_content')
