@extends('master')
@section('content')
{{View::make('header')}}
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/shop_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/shop_responsive.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/blog_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/blog_responsive.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/contact_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/contact_responsive.css')}}">

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src={{asset('asset/images/'.$data[0]->category_icon)}}></div>
    <div class="home_overlay"></div>
    <div class="home_content d-flex flex-column align-items-center justify-content-center">
        <h2 class="home_title">Matériels de {{$data[0]->category_name}}</h2>
    </div>
</div>
<div class="shop">
    <div class="container">
 <div class="navbar bg-blue breadcrumb-bar ">
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{url('index')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('categories')}}">Equipements</a></li>
                @if($category)
                <li class="breadcrumb-item active"><a href="{{url('show_categories/'.$category->slug)}}">{{$category->category_name}}</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{$data[0]->category_name}}</li>
          </ol>
      </nav>
</div>
@if(Auth::check() and ($aUser['user_type']=='admin' or $aUser['user_type']=='super_admin') and $aUser['user_state']=='actif')
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="contact_form_container">
                        <form action="show_categories"  method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="contact_form_title">Modifier la catégorie: {{$data[0]->category_name}} </div>
                                            <p>
                                                Modifier le nom ,l'image et l'Equipement auquel appartien cette Catégorie de cette catégorie d'article. Si l'Equipement
                                                ne figurent pas dans la liste déroulante veuillez l'ajouter <a href={{url('add_categories')}}>ici</a>
                                            </p>
                                        </div>
                                        <div class="col-md-44">
                                            <img src="{{asset('asset/images/'. $data[0]->category_icon )}}" alt="..." class="img-thumbnail" height="200" width="200"><br><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="id" value={{$data[0]->id}}>
                                    <label for="">Nom de Catégorie</label>
                                  <input type="text" id="category_name" class="form-control" placeholder="Nom de Catégorie" required="required" name="category_name" value="{{$data[0]->category_name}}">
                                    @if ($errors->has('category_name'))
                                    <span class="error">{{ $errors->first('category_name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                        @if($category)
                                            <label for="">Equipements de</label>
                                            <select name="categorie_id" id="inputState" class="form-control" >
                                                <option selected>{{$category->category_name}}</option>
                                        @else
                                           <select name="categorie_id" id="inputState" class="form-control" readonly>
                                           <option selected>choose....</option>
                                        @endif
                                        @if($listCateg)
                                            @foreach($listCateg as $item)
                                               <option>{{$item->category_name}}</option>
                                            @endforeach
                                         @else
                                            <option>Choix Vide</option>
                                        @endif

                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="file" class="form-control-file" id="category_icon" name="category_icon" >
                                </div>
                            </div>
                            <div class="contact_form_button">
                                <button type="submit" class="button contact_submit_button">Modifier</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
</div>
</div>
@endif
    <br><br><br>
@if(count($items) != 0)
<!-- Shop -->
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
                            <li><a href="#">{{$item->category_name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="sidebar_section filter_by_section">
                        <div class="sidebar_title">Filter By</div>
                        <div class="sidebar_subtitle">Price</div>
                        <div class="filter_price">
                            <div id="slider-range" class="slider_range"></div>
                            <p>Range: </p>
                            <p><input type="text" id="amount" class="amount" readonly style="border:0; font-weight:bold;"></p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-9">

                <!-- Shop Content -->

                <div class="shop_content">
                    <div class="shop_bar clearfix">
                        @if(Auth::check() and ($aUser['user_type']=='admin' or $aUser['user_type']=='super_admin') and $aUser['user_state']=='actif')
                        <button type="button" class="btn btn-outline-primary"><a href={{url('add_new/'.$data[0]->slug) }}>Ajouter Article</a></button>
                        <br><br>
                        @endif
                        <div class="shop_product_count"><span>{{count($items)}}</span> products found</div>
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
                        @foreach($items as $item)
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

                    <!-- Shop Page Navigation -->

                    <div class="shop_page_nav d-flex flex-row">
                        <div class="page_prev d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-left"></i></div>
                        <ul class="page_nav d-flex flex-row">
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">...</a></li>
                            <li><a href="#">21</a></li>
                        </ul>
                        <div class="page_next d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-right"></i></div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<!-- Recently Viewed -->

<div class="viewed">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="viewed_title_container">
                    <h3 class="viewed_title">Recently Viewed</h3>
                    <div class="viewed_nav_container">
                        <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                    </div>
                </div>

                <div class="viewed_slider_container">

                    <!-- Recently Viewed Slider -->

                    <div class="owl-carousel owl-theme viewed_slider">

                        <!-- Recently Viewed Item -->
                        <div class="owl-item">
                            <div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="viewed_image"><img src="images/view_1.jpg" alt=""></div>
                                <div class="viewed_content text-center">
                                    <div class="viewed_price">$225<span>$300</span></div>
                                    <div class="viewed_name"><a href="#">Beoplay H7</a></div>
                                </div>
                                <ul class="item_marks">
                                    <li class="item_mark item_discount">-25%</li>
                                    <li class="item_mark item_new">new</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Recently Viewed Item -->
                        <div class="owl-item">
                            <div class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="viewed_image"><img src="images/view_2.jpg" alt=""></div>
                                <div class="viewed_content text-center">
                                    <div class="viewed_price">$379</div>
                                    <div class="viewed_name"><a href="#">LUNA Smartphone</a></div>
                                </div>
                                <ul class="item_marks">
                                    <li class="item_mark item_discount">-25%</li>
                                    <li class="item_mark item_new">new</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Recently Viewed Item -->
                        <div class="owl-item">
                            <div class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="viewed_image"><img src="images/view_3.jpg" alt=""></div>
                                <div class="viewed_content text-center">
                                    <div class="viewed_price">$225</div>
                                    <div class="viewed_name"><a href="#">Samsung J730F...</a></div>
                                </div>
                                <ul class="item_marks">
                                    <li class="item_mark item_discount">-25%</li>
                                    <li class="item_mark item_new">new</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Recently Viewed Item -->
                        <div class="owl-item">
                            <div class="viewed_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="viewed_image"><img src="images/view_4.jpg" alt=""></div>
                                <div class="viewed_content text-center">
                                    <div class="viewed_price">$379</div>
                                    <div class="viewed_name"><a href="#">Huawei MediaPad...</a></div>
                                </div>
                                <ul class="item_marks">
                                    <li class="item_mark item_discount">-25%</li>
                                    <li class="item_mark item_new">new</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Recently Viewed Item -->
                        <div class="owl-item">
                            <div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="viewed_image"><img src="images/view_5.jpg" alt=""></div>
                                <div class="viewed_content text-center">
                                    <div class="viewed_price">$225<span>$300</span></div>
                                    <div class="viewed_name"><a href="#">Sony PS4 Slim</a></div>
                                </div>
                                <ul class="item_marks">
                                    <li class="item_mark item_discount">-25%</li>
                                    <li class="item_mark item_new">new</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Recently Viewed Item -->
                        <div class="owl-item">
                            <div class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="viewed_image"><img src="images/view_6.jpg" alt=""></div>
                                <div class="viewed_content text-center">
                                    <div class="viewed_price">$375</div>
                                    <div class="viewed_name"><a href="#">Speedlink...</a></div>
                                </div>
                                <ul class="item_marks">
                                    <li class="item_mark item_discount">-25%</li>
                                    <li class="item_mark item_new">new</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@elseif(count($sub_categ)!=0)
<div class="shop">
   <div class="container">
        @if(Auth::check() and ($aUser['user_type']=='admin' or $aUser['user_type']=='super_admin') and $aUser['user_state']=='actif')
        <div class="contact_form_title">Catégories  de l'équipement de {{$data[0]->category_name}} </div>
        <div><button type="button" class="btn btn-outline-info"><a href={{url('sub_categories/'.$data[0]->slug) }}>Ajouter une nouvelle catégorie de Matériel pour  {{$data[0]->category_name}}</a></button><br><br></div>
        @endif
        <div class="row">
            <div class="col">
                <div class="blog_posts d-flex flex-row align-items-start justify-content-between">
                    @foreach($sub_categ as $item)
                    <!-- Blog post -->
                    <div class="blog_post">
                        <div class="blog_image" style="background-image:url({{asset('asset/images/'. $item->category_icon )}})"></div>
                        <div class="blog_text"><h3>{{$item->category_name}} </h3>
                            @if(Auth::check() and ($aUser['user_type']=='admin' or $aUser['user_type']=='super_admin') and $aUser['user_state']=='actif')
                            <button type="button" class="btn btn-outline-primary"><a href={{url('add_new/'.$item->slug) }}>Ajouter Article</a></button>
                            @endif
                        </div>
                        <div class="blog_button col"><a href={{url('show_categories/'.$item->slug) }} >Voire</a></div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
@else
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <h5 class="card-title">Pas de Catégorie</h5>
                @if(Auth::check() and ($aUser['user_type']=='admin' or $aUser['user_type']=='super_admin') and $aUser['user_state']=='actif')
                    <p class="card-text">Il n'existe pas encore de Catégories pour l'équipements de {{$data[0]->category_name}}</p>
                    <a href={{url('sub_categories/'.$data[0]->slug) }} class="btn btn-primary">Ajouter</a>
                Ou
                    <a href={{url('add_new/'.$data[0]->slug) }} class="btn btn-primary">Ajouter Article</a>
                @else
                    <p class="card-text">Il n'existe pas encore de Catégories pour l'équipements de {{$data[0]->category_name}}</p>
                @endif

            </div>
        </div>
    </div>
</div>
@endif
@endsection('content')
