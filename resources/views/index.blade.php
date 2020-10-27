@extends('master')
@section('content')
{{View::make('header')}}

<!-- Banner -->

<div class="banner">
    <div class="banner_background" style="background-image:url({{asset('asset/images/banner_background.jpg')}})"></div>
    <div class="container fill_height">
        <div class="row fill_height">
            <div class="banner_product_image"><img src="{{asset('asset/images/banner_product.png')}}" alt=""></div>
            <div class="col-lg-5 offset-lg-4 fill_height">
                <div class="banner_content">
                    <h1 class="banner_text">Distribution de Matériels Médicaux</h1>
                    <div class="banner_price"><h2>+1000 Matériels</h2></div>
                    <div class="button banner_button"><a href="#">Contactez Nous</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Characteristics -->

    <div class="characteristics">
        <div class="container">
            <div class="row">

                <!-- Char. Item -->
                <div class="col-lg-3 col-md-6 char_col">

                    <div class="char_item d-flex flex-row align-items-center justify-content-start">
                        <div class="char_icon"><img src="asset/images/char_1.png" alt=""></div>
                        <div class="char_content">
                            <div class="char_title">Livraison Gratuite</div>
                            <div class="char_subtitle"></div>
                        </div>
                    </div>
                </div>

                <!-- Char. Item -->
                <div class="col-lg-3 col-md-6 char_col">

                    <div class="char_item d-flex flex-row align-items-center justify-content-start">
                        <div class="char_icon"><img src="asset/images/char_2.png" alt=""></div>
                        <div class="char_content">
                            <div class="char_title">Installation Gratuite</div>
                            <div class="char_subtitle"></div>
                        </div>
                    </div>
                </div>

                <!-- Char. Item -->
                <div class="col-lg-3 col-md-6 char_col">

                    <div class="char_item d-flex flex-row align-items-center justify-content-start">
                        <div class="char_icon"><img src="asset/images/char_3.png" alt=""></div>
                        <div class="char_content">
                            <div class="char_title">Meilleur Prix</div>
                            <div class="char_subtitle"></div>
                        </div>
                    </div>
                </div>

                <!-- Char. Item -->
                <div class="col-lg-3 col-md-6 char_col">

                    <div class="char_item d-flex flex-row align-items-center justify-content-start">
                        <div class="char_icon"><img src="asset/images/char_4.png" alt=""></div>
                        <div class="char_content">
                            <div class="char_title">Garantie</div>
                            <div class="char_subtitle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Deals of the week -->

    <div class="deals_featured">
        <div class="container">
            <div class="row">
                <div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">

                    <!-- Deals -->

                    <div class="deals">
                        <div class="deals_title">Deals of the Week</div>
                        <div class="deals_slider_container">

                            <!-- Deals Slider -->
                            <div class="owl-carousel owl-theme deals_slider">

                                <!-- Deals Item -->

                                @foreach($articles as $item)
                                @if($item->medweek)
                                <div class="owl-item deals_item">
                                    <div class="deals_image"><img src="{{asset('asset/images/'.$item->article_image1)}}" alt=""></div>
                                    <div class="deals_content">
                                        <div class="deals_info_line d-flex flex-row justify-content-start">
                                            <div class="deals_item_category"><a href="#">{{$item->category_name}}</a></div>
                                            <div class="deals_item_price_a ml-auto">$300</div>
                                        </div>
                                        <div class="deals_info_line d-flex flex-row justify-content-start">
                                            <div class="deals_item_name">{{$item->article_name}}</div>
                                            <div class="deals_item_price ml-auto">{{$item->article_model}}</div>
                                        </div>

                                        <div class="deals_timer d-flex flex-row align-items-center justify-content-start">
                                            <div class="deals_timer_title_container">
                                                <div class="deals_timer_title">Hurry Up</div>
                                                <div class="deals_timer_subtitle">Offer ends in:</div>
                                            </div>
                                            <div class="deals_timer_content ml-auto">
                                                <div class="deals_timer_box clearfix" data-target-time="">
                                                    <div class="deals_timer_unit">
                                                        <div id="deals_timer1_hr" class="deals_timer_hr"></div>
                                                        <span>hours</span>
                                                    </div>
                                                    <div class="deals_timer_unit">
                                                        <div id="deals_timer1_min" class="deals_timer_min"></div>
                                                        <span>mins</span>
                                                    </div>
                                                    <div class="deals_timer_unit">
                                                        <div id="deals_timer1_sec" class="deals_timer_sec"></div>
                                                        <span>secs</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach

                            </div>

                        </div>

                        <div class="deals_slider_nav_container">
                            <div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i></div>
                            <div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i></div>
                        </div>
                    </div>

                    <!-- Featured -->
                    <div class="featured">
                        <div class="tabbed_container">
                            <div class="tabs">
                                <ul class="clearfix">
                                    <li class="active">Hematologie</li>
                                    <li>Biochimie</li>
                                    <li>Consommables</li>
                                    <li>Autres</li>
                                </ul>
                                <div class="tabs_line"><span></span></div>
                            </div>

                            <!-- Product Panel -->
                            <div class="product_panel panel active">
                                <div class="featured_slider slider">
                                @foreach($articles as $item)
                                        @if($item->category_name == 'Hématologie')
                                            <!-- Slider Item -->
                                            <div class="featured_slider_item">
                                                <div class="border_active"></div>
                                                @if($item->article_promotion !=0)
                                                    <div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                                 @elseif($item->article_version)
                                                    <div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                                 @else
                                                    <div class="product_item  d-flex flex-column align-items-center justify-content-center text-center">
                                                 @endif
                                                    <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset('asset/images/'.$item->article_image1)}}" alt="" width="115" height="115"></div>
                                                    <div class="product_content">
                                                        <!--div class="product_price discount">$225<span>$300</span></div-->
                                                        <div class="product_name"><div>{{$item->article_name}}<br>{{$item->article_model}}</div></div>
                                                        <div class="product_extras">
                                                            <a href="{{url('show_article/'.$item->slug)}}"><button class="product_cart_button">Voir</button></a>
                                                        </div>
                                                    </div>
                                                    <div class="product_fav"><i class="fas fa-heart"></i></div>
                                                    <ul class="product_marks">
                                                        <li class="product_mark product_discount">-{{$item->article_promotion}}</li>
                                                        <li class="product_mark product_new">new</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                @endforeach
                                </div>
                                <div class="featured_slider_dots_cover"></div>
                            </div>

                            <!-- Product Panel -->

                            <div class="product_panel panel">
                                <div class="featured_slider slider">

                                    @foreach($articles as $item)
                                    @if($item->category_name == 'Biochimie')
                                    <!-- Slider Item -->
                                    <div class="featured_slider_item">
                                        <div class="border_active"></div>
                                        @if($item->article_promotion !=0)
                                        <div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                            @elseif($item->article_version)
                                            <div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                                @else
                                                <div class="product_item  d-flex flex-column align-items-center justify-content-center text-center">
                                                    @endif
                                                    <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset('asset/images/'.$item->article_image1)}}" alt="" width="115" height="115"></div>
                                                    <div class="product_content">
                                                        <!--div class="product_price discount">$225<span>$300</span></div-->
                                                        <div class="product_name"><div>{{$item->article_name}}<br>{{$item->article_model}}</div></div>
                                                        <div class="product_extras">
                                                            <a href="{{url('show_article/'.$item->slug)}}"><button class="product_cart_button">Voir</button></a>
                                                        </div>
                                                    </div>
                                                    <div class="product_fav"><i class="fas fa-heart"></i></div>
                                                    <ul class="product_marks">
                                                        <li class="product_mark product_discount">-{{$item->article_promotion}}</li>
                                                        <li class="product_mark product_new">new</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                </div>
                                <div class="featured_slider_dots_cover"></div>
                            </div>

                            <!-- Product Panel -->

                            <div class="product_panel panel">
                                <div class="featured_slider slider">

                                    @foreach($articles as $item)
                                    @if($item->category_name == 'Consommables Laboratoire' )
                                    <!-- Slider Item -->
                                    <div class="featured_slider_item">
                                        <div class="border_active"></div>
                                        @if($item->article_promotion !=0)
                                        <div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                            @elseif($item->article_version)
                                            <div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                                @else
                                                <div class="product_item  d-flex flex-column align-items-center justify-content-center text-center">
                                                    @endif
                                                    <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset('asset/images/'.$item->article_image1)}}" alt="" width="115" height="115"></div>
                                                    <div class="product_content">
                                                        <!--div class="product_price discount">$225<span>$300</span></div-->
                                                        <div class="product_name"><div>{{$item->article_name}}<br>{{ \Illuminate\Support\Str::limit($item->article_model, 20, $end='...') }}</div></div>
                                                        <div class="product_extras">
                                                            <a href="{{url('show_article/'.$item->slug)}}"><button class="product_cart_button">Voir</button></a>
                                                        </div>
                                                    </div>
                                                    <div class="product_fav"><i class="fas fa-heart"></i></div>
                                                    <ul class="product_marks">
                                                        <li class="product_mark product_discount">-{{$item->article_promotion}}</li>
                                                        <li class="product_mark product_new">new</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                <div class="featured_slider_dots_cover"></div>
                            </div>
                            <!-- Product Panel -->

                            <div class="product_panel panel">
                                <div class="featured_slider slider">

                                    @foreach($articles as $item)
                                    @if($item->category_name == 'Autres Laboratoire' or $item->category_name == 'Bactériologie-Virologie-Parasitologie'  )
                                    <!-- Slider Item -->
                                    <div class="featured_slider_item">
                                        <div class="border_active"></div>
                                        @if($item->article_promotion !=0)
                                        <div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                            @elseif($item->article_version)
                                            <div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                                @else
                                                <div class="product_item  d-flex flex-column align-items-center justify-content-center text-center">
                                                    @endif
                                                    <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset('asset/images/'.$item->article_image1)}}" alt="" width="115" height="115"></div>
                                                    <div class="product_content">
                                                        <!--div class="product_price discount">$225<span>$300</span></div-->
                                                        <div class="product_name"><div>{{$item->article_name}}<br>{{ \Illuminate\Support\Str::limit($item->article_model, 20, $end='...') }}</div></div>
                                                        <div class="product_extras">
                                                            <a href="{{url('show_article/'.$item->slug)}}"><button class="product_cart_button">Voir</button></a>
                                                        </div>
                                                    </div>
                                                    <div class="product_fav"><i class="fas fa-heart"></i></div>
                                                    <ul class="product_marks">
                                                        <li class="product_mark product_discount">-{{$item->article_promotion}}</li>
                                                        <li class="product_mark product_new">new</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                <div class="featured_slider_dots_cover"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
 <!-- Trends -->

<div class="trends">
  <div class="trends_background" style="background-image:url(asset/images/trends_background.jpg)"></div>
    <div class="trends_overlay"></div>
      <div class="container">
        <div class="row">
           <!-- Trends Content -->
             <div class="col-lg-3">
                 <div class="trends_container">
                   <h2 class="trends_title">Récemment Ajouté</h2>
                   <div class="trends_text"><p>Articles de Laboratoire récemment ajourté</p></div>
                   <div class="trends_slider_nav">
                   <div class="trends_prev trends_nav"><i class="fas fa-angle-left ml-auto"></i></div>
                    <div class="trends_next trends_nav"><i class="fas fa-angle-right ml-auto"></i></div>
                 </div>
                 </div>
             </div>

                <!-- Trends Slider -->
             <div class="col-lg-9">
                 <div class="trends_slider_container">
                 <!-- Trends Slider -->
                 <div class="owl-carousel owl-theme trends_slider">
                 <!-- Trends Slider Item -->
                 @foreach($labo as $item)

                 <div class="owl-item">
                     @if($item->article_version)
                     <div class="trends_item is_new">
                      @elseif($item->article_promotion)
                         <div class="trends_item discount">
                      @else
                         <div class="trends_item ">
                      @endif
                        <div class="trends_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset('asset/images/'.$item->article_image1)}}" alt=""></div>
                       <div class="trends_content">
                           <div class="trends_category"><a href="#">{{$item->category_name}}</a></div>
                           <div class="trends_info clearfix">
                               <div class="trends_name"><a href="product.html">{{$item->article_name}}</a></div>
                               <div class="trends_price">{{$item->article_model}}</div>
                           </div>
                       </div>
                       <ul class="trends_marks">
                           <li class="trends_mark trends_discount">-25%</li>
                           <li class="trends_mark trends_new">new</li>
                       </ul>
                       <div class="trends_fav"><i class="fas fa-heart"></i></div>
                   </div>
                 </div>
                 @endforeach
             </div>
        </div>
      </div>
     </div>
  </div>
</div>

    <!-- Popular Categories -->
    <div class="popular_categories">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="popular_categories_content">
                        <div class="popular_categories_title">Popular Categories</div>
                        <div class="popular_categories_slider_nav">
                            <div class="popular_categories_prev popular_categories_nav"><i class="fas fa-angle-left ml-auto"></i></div>
                            <div class="popular_categories_next popular_categories_nav"><i class="fas fa-angle-right ml-auto"></i></div>
                        </div>
                        <div class="popular_categories_link"><a href="#">full catalog</a></div>
                    </div>
                </div>

                <!-- Popular Categories Slider -->

                <div class="col-lg-9">
                    <div class="popular_categories_slider_container">
                        <div class="owl-carousel owl-theme popular_categories_slider">
                @foreach($listCateg as $item)
                            <!-- Popular Categories Item -->
                            <div class="owl-item">
                                <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                    <div class="popular_category_image"><img src="{{asset('asset/images/'.$item->category_icon)}}" alt=""></div>
                                    <div class="popular_category_text">{{$item->category_name}}</div>
                                </div>
                            </div>
                @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Banner -->

    <div class="banner_2">
        <div class="banner_2_background" style="background-image:url(asset/images/banner_2_background.jpg)"></div>
        <div class="banner_2_container">
            <div class="banner_2_dots"></div>
            <!-- Banner 2 Slider -->

            <div class="owl-carousel owl-theme banner_2_slider">

                @foreach($articles as $item)
                @if($item->trends)
                <!-- Banner 2 Slider Item -->
                <div class="owl-item">
                    <div class="banner_2_item">
                        <div class="container fill_height">
                            <div class="row fill_height">
                                <div class="col-lg-4 col-md-6 fill_height">
                                    <div class="banner_2_content">
                                        <div class="banner_2_category">{{$item->category_name}}</div>
                                        <div class="banner_2_title">{{$item->article_name}}</div>
                                        <div class="banner_2_text">{{ $item->article_model }}</div>
                                        <div class="rating_r rating_r_4 banner_2_rating"><i></i><i></i><i></i><i></i><i></i></div>
                                        <div class="button banner_2_button"><a href="{{('show_article/'.$item->slug)}}">Explore</a></div>
                                    </div>

                                </div>
                                <div class="col-lg-8 col-md-6 fill_height">
                                    <div class="banner_2_image_container">
                                        <div class="banner_2_image"><img src="{{asset('asset/images/'.$item->article_image1)}}" alt="" height="550" width="500"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>

    <!-- Hot New Arrivals -->

    <div class="new_arrivals">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="tabbed_container">
                        <div class="tabs clearfix tabs-right">
                            <!--div class="new_arrivals_title">Hot New Arrivals</div-->
                            <ul class="clearfix">
                                <li class="active">Chirurgie</li>
                                <li>Equip. Médicaux</li>
                                <li>Gynécologie & Obstétrique</li>
                            </ul>
                            <div class="tabs_line"><span></span></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-9" style="z-index:1;">

                                <!-- Product Panel -->
                                <div class="product_panel panel active">
                                    <div class="arrivals_slider slider">
                                      @foreach($chirurgie as $item)
                                        <!-- Slider Item -->
                                        <div class="arrivals_slider_item">
                                            <div class="border_active"></div>
                                            @if($item->article_promotion !=0)
                                            <div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                                @elseif($item->article_version)
                                                <div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                                    @else
                                                    <div class="product_item  d-flex flex-column align-items-center justify-content-center text-center">
                                                        @endif
                                                        <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset('asset/images/'.$item->article_image1)}}" alt="" width="115" height="115"></div>
                                                        <div class="product_content">
                                                            <div class="product_name"><div><a href="product.html">{{$item->article_name}}<br>{{ \Illuminate\Support\Str::limit($item->article_model, 20, $end='...') }}</a></div></div>
                                                            <div class="product_extras">
                                                                <a href="{{url('show_article/'.$item->slug)}}"><button class="product_cart_button">Voir</button></a>
                                                            </div>
                                                        </div>
                                                        <div class="product_fav"><i class="fas fa-heart"></i></div>
                                                        <ul class="product_marks">
                                                            <li class="product_mark product_discount">{{$item->article_promotion}}</li>
                                                            <li class="product_mark product_new">new</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                        @endforeach
                                    </div>
                                    <div class="arrivals_slider_dots_cover"></div>
                                </div>

                                <!-- Product Panel -->
                                <div class="product_panel panel">
                                    <div class="arrivals_slider slider">

                                        @foreach($articles as $item)
                                        @if($item->category_name == 'Médecine Générale & Hospitalisation')
                                        <!-- Slider Item -->
                                        <div class="arrivals_slider_item">
                                            <div class="border_active"></div>
                                            @if($item->article_promotion !=0)
                                            <div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                                @elseif($item->article_version)
                                                <div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                                    @else
                                                    <div class="product_item  d-flex flex-column align-items-center justify-content-center text-center">
                                                        @endif
                                                        <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset('asset/images/'.$item->article_image1)}}" alt="" width="115" height="115"></div>
                                                        <div class="product_content">
                                                            <div class="product_name"><div><a href="product.html">{{$item->article_name}}<br>{{ \Illuminate\Support\Str::limit($item->article_model, 20, $end='...') }}</a></div></div>
                                                            <div class="product_extras">
                                                                <a href="{{url('show_article/'.$item->slug)}}"><button class="product_cart_button">Voir</button></a>
                                                            </div>
                                                        </div>
                                                        <div class="product_fav"><i class="fas fa-heart"></i></div>
                                                        <ul class="product_marks">
                                                            <li class="product_mark product_discount">{{$item->article_promotion}}</li>
                                                            <li class="product_mark product_new">new</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                @endif
                                                @endforeach
                                    </div>
                                    <div class="arrivals_slider_dots_cover"></div>
                                </div>

                                <!-- Product Panel -->
                                <div class="product_panel panel">
                                    <div class="arrivals_slider slider">

                                        <!-- Slider Item -->
                                        <div class="arrivals_slider_item">
                                            <div class="border_active"></div>
                                            <div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="asset/images/biomedir.jpg" alt=""></div>
                                                <div class="product_content">
                                                    <div class="product_name"><div><a href="product.html">nom article...</a></div></div>
                                                    <div class="product_extras">
                                                        <div class="product_color">
                                                            <input type="radio" checked name="product_color" style="background:#b19c83">
                                                            <input type="radio" name="product_color" style="background:#000000">
                                                            <input type="radio" name="product_color" style="background:#999999">
                                                        </div>
                                                        <button class="product_cart_button">Add to Cart</button>
                                                    </div>
                                                </div>
                                                <div class="product_fav"><i class="fas fa-heart"></i></div>
                                                <ul class="product_marks">
                                                    <li class="product_mark product_discount">-25%</li>
                                                    <li class="product_mark product_new">new</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="arrivals_slider_dots_cover"></div>
                                </div>

                            </div>

                            <!--div class="col-lg-5">
                                <div class="arrivals_single clearfix">
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <div class="arrivals_single_image"><img src="asset/images/new_single.png" alt=""></div>
                                        <div class="arrivals_single_content">
                                            <div class="arrivals_single_category"><a href="#">Smartphones</a></div>
                                            <div class="arrivals_single_name_container clearfix">
                                                <div class="arrivals_single_name"><a href="#">LUNA Smartphone</a></div>
                                                <div class="arrivals_single_price text-right">$379</div>
                                            </div>
                                            <div class="rating_r rating_r_4 arrivals_single_rating"><i></i><i></i><i></i><i></i><i></i></div>
                                            <form action="#"><button class="arrivals_single_button">Add to Cart</button></form>
                                        </div>
                                        <div class="arrivals_single_fav product_fav active"><i class="fas fa-heart"></i></div>
                                        <ul class="arrivals_single_marks product_marks">
                                            <li class="arrivals_single_mark product_mark product_new">new</li>
                                        </ul>
                                    </div>
                                </div>
                            </div-->

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Best Sellers -->

    <div class="best_sellers">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="tabbed_container">
                        <div class="tabs clearfix tabs-right">
                            <div class="new_arrivals_title"></div>
                            <ul class="clearfix">
                                <li class="active">Imagerie</li>
                                <li>Orl</li>
                                <li>Equipements & Accessoires</li>
                            </ul>
                            <div class="tabs_line"><span></span></div>
                        </div>

                        <div class="bestsellers_panel panel active">

                            <!-- Best Sellers Slider -->

                            <div class="bestsellers_slider slider">
                            @foreach($imagerie as $item)
                                <!-- Best Sellers Item -->
                                @if($item->article_promotion !=0)
                                <div class="bestsellers_item discount">
                                @elseif($item->article_version)
                                 <div class="bestsellers_item is_new">
                                @else
                                 <div class="bestsellers_item ">
                                 @endif
                                    <div class="bestsellers_item_container d-flex flex-row align-items-center justify-content-start">
                                        <div class="bestsellers_image"><img src="asset/images/best_1.png" alt=""></div>
                                        <div class="bestsellers_content">
                                            <div class="bestsellers_category"><a href="#">Headphones</a></div>
                                            <div class="bestsellers_name"><a href="product.html">Xiaomi Redmi Note 4</a></div>
                                            <div class="rating_r rating_r_4 bestsellers_rating"><i></i><i></i><i></i><i></i><i></i></div>
                                            <div class="bestsellers_price discount">$225<span>$300</span></div>
                                        </div>
                                    </div>
                                    <div class="bestsellers_fav active"><i class="fas fa-heart"></i></div>
                                    <ul class="bestsellers_marks">
                                        <li class="bestsellers_mark bestsellers_discount">-25%</li>
                                        <li class="bestsellers_mark bestsellers_new">new</li>
                                    </ul>
                                </div>
                             @endforeach
                            </div>
                        </div>

                        <div class="bestsellers_panel panel">

                            <!-- Best Sellers Slider -->

                        <div class="bestsellers_slider slider">
                            @foreach($imagerie as $item)
                            <!-- Best Sellers Item -->
                            @if($item->article_promotion !=0)
                            <div class="bestsellers_item discount">
                             @elseif($item->article_version)
                                <div class="bestsellers_item is_new">
                              @else
                                 <div class="bestsellers_item ">
                              @endif
                                        <!-- Best Sellers Item -->
                                <div class="bestsellers_item discount">
                                    <div class="bestsellers_item_container d-flex flex-row align-items-center justify-content-start">
                                        <div class="bestsellers_image"><img src="asset/images/best_1.png" alt=""></div>
                                        <div class="bestsellers_content">
                                            <div class="bestsellers_category"><a href="#">Headphones</a></div>
                                            <div class="bestsellers_name"><a href="product.html">Xiaomi Redmi Note 4</a></div>
                                            <div class="rating_r rating_r_4 bestsellers_rating"><i></i><i></i><i></i><i></i><i></i></div>
                                            <div class="bestsellers_price discount">$225<span>$300</span></div>
                                        </div>
                                    </div>
                                    <div class="bestsellers_fav active"><i class="fas fa-heart"></i></div>
                                    <ul class="bestsellers_marks">
                                        <li class="bestsellers_mark bestsellers_discount">-25%</li>
                                        <li class="bestsellers_mark bestsellers_new">new</li>
                                    </ul>
                                </div>
                            @endforeach
                            </div>
                        </div>

                        <div class="bestsellers_panel panel">

                            <!-- Best Sellers Slider -->

                         <div class="bestsellers_slider slider">
                             @foreach($imagerie as $item)
                             <!-- Best Sellers Item -->
                             @if($item->article_promotion !=0)
                             <div class="bestsellers_item discount">
                             @elseif($item->article_version)
                              <div class="bestsellers_item is_new">
                             @else
                               <div class="bestsellers_item ">
                             @endif
                                 <!-- Best Sellers Item -->
                                <div class="bestsellers_item discount">
                                    <div class="bestsellers_item_container d-flex flex-row align-items-center justify-content-start">
                                        <div class="bestsellers_image"><img src="asset/images/best_1.png" alt=""></div>
                                        <div class="bestsellers_content">
                                            <div class="bestsellers_category"><a href="#">Headphones</a></div>
                                            <div class="bestsellers_name"><a href="product.html">Xiaomi Redmi Note 4</a></div>
                                            <div class="rating_r rating_r_4 bestsellers_rating"><i></i><i></i><i></i><i></i><i></i></div>
                                            <div class="bestsellers_price discount">$225<span>$300</span></div>
                                        </div>
                                    </div>
                                    <div class="bestsellers_fav active"><i class="fas fa-heart"></i></div>
                                    <ul class="bestsellers_marks">
                                        <li class="bestsellers_mark bestsellers_discount">-25%</li>
                                        <li class="bestsellers_mark bestsellers_new">new</li>
                                    </ul>
                                </div>
                              @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- Reviews -->

    <div class="reviews">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="reviews_title_container">
                        <h3 class="reviews_title">Latest Reviews</h3>
                        <div class="reviews_all ml-auto"><a href="#">view all <span>reviews</span></a></div>
                    </div>

                    <div class="reviews_slider_container">

                        <!-- Reviews Slider -->
                        <div class="owl-carousel owl-theme reviews_slider">

                            <!-- Reviews Slider Item >
                            <div class="owl-item">
                                <div class="review d-flex flex-row align-items-start justify-content-start">
                                    <div><div class="review_image"><img src="asset/images/review_1.jpg" alt=""></div></div>
                                    <div class="review_content">
                                        <div class="review_name">Roberto Sanchez</div>
                                        <div class="review_rating_container">
                                            <div class="rating_r rating_r_4 review_rating"><i></i><i></i><i></i><i></i><i></i></div>
                                            <div class="review_time">2 day ago</div>
                                        </div>
                                        <div class="review_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum laoreet.</p></div>
                                    </div>
                                </div>
                            </div-->
                        </div>
                        <div class="reviews_dots"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{View::make('most_viewed')}}
@endsection('content')
@section('script_content')
<script src="{{asset('asset/js/custom.js')}}"></script>
@endsection('script_content')
