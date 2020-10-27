@extends('master')
@section('content')
{{View::make('header')}}
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/shop_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/shop_responsive.css')}}">

<div class="shop">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">

                <!-- Shop Sidebar -->
                <div class="shop_sidebar">
                    <div class="sidebar_section">
                            <div class="sidebar_title">Categories</div>
                            <ul class="sidebar_categories">
                                @foreach($listCateg as $item)
                                <li>
                                    <a href="#{{$item->slug}}" data-toggle="collapse" aria-expanded="true">&rsaquo;  {{$item->category_name}}</a>

                                    <ul class="collapse list-unstyled" id="{{$item->slug}}">
                                        @foreach(App\Models\Categorie::find($item->id)->child as $sub_category)
                                        <li><a href="{{url('show_categories/'.$sub_category->slug)}}" style="color: #0e8ce4">{{$sub_category->category_name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">

                <!-- Shop Content -->

                <div class="shop_content">
                    <div class="shop_bar clearfix">
                        <div class="shop_product_count">Showing <span>{{count($articles)}}</span> products</div>
                        <div class="shop_sorting">
                            <span>Sort by:</span>
                            <ul>
                                <li>
                                    <span class="sorting_text">highest rated<i class="fas fa-chevron-down"></span></i>
                                    <ul>
                                        <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "original-order" }'>highest rated</li>
                                        <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name</li>
                                        <li class="shop_sorting_button"data-isotope-option='{ "sortBy": "price" }'>price</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="product_grid">
                        <div class="product_grid_border"></div>

                        @foreach($articles as $item)
                        <!-- Product Item -->
                        @if($item->article_version)
                        <div class="product_item is_new">
                            @elseif($item->article_promotion != 0)
                            <div class="product_item discount">
                                @else
                                <div class="product_item">
                                    @endif
                                    <div class="product_border"></div>
                                    <div class="product_image d-flex flex-column align-items-center justify-content-center"><a
                                            href="{{url('show_article/'.$item->slug)}}"><img src="{{asset('asset/images/'. $item->article_image1)}}" alt="" width="115" height="115"></a></div>
                                    <div class="product_content">
                                        <div class="product_name"><div><a href="{{url('show_article/'.$item->slug)}}" tabindex="0">{{$item->article_name}}<br>{{$item->article_model}}</a></div></div>

                                    </div>
                                    <div class="product_fav"><i class="fas fa-heart"></i></div>
                                    <ul class="product_marks">
                                        <li class="product_mark product_discount">{{$item->article_promotion}}</li>
                                        <li class="product_mark product_new">new</li>
                                    </ul>
                                </div>
                        @endforeach
                    </div>
                     {{$articles->links('vendor.pagination.custom')}}
                     <style>
                        .w-5{
                            display: none;
                        }
                     </style>

                    <!-- Shop Page Navigation -->



                </div>

            </div>
        </div>
    </div>
</div>

{{View::make('most_viewed')}}
@endsection('content')
@section('script_content')
<script src="{{asset('asset/js/shop_custom.js')}}"></script>
@endsection('script_content')
