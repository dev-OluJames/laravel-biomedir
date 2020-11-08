<div class="super_container">

    <!-- Header -->

    <header class="header">

        <!-- Top Bar -->

        <div class="top_bar">
            <div class="container">
                <div class="row">
                    <div class="col d-flex flex-row">
                        <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{asset('asset/images/phone.png')}}" alt=""></div>+229 90 94 33 35</div>
                        <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{asset('asset/images/mail.png')}}" alt=""></div><a href="mailto:fastsales@gmail.com">info@biomedir.com</a></div>
                        <div class="top_bar_content ml-auto">
                            @guest
                            <div class="top_bar_user">
                                <div class="user_icon"><img src="{{asset('asset/images/user.svg')}}" alt=""></div>
                                    <div><a href={{url('register')}}>Register</a></div>
                                    <div><a href={{url('login')}}>Sign in</a></div>
                            </div>
                            @endguest
                            @auth
                            <div class="top_bar_user">
                                <div class="user_icon"><img src="{{asset('asset/images/user.svg')}}" alt=""></div>
                                <div><a href="{{url('dashboard')}}">{{$aUser->name}}</a></div>
                                <div>
                                    <ul class="standard_dropdown main_nav_dropdown">
                                        <li class="hassubs">
                                            <div class="cart_text">Mon Compte</div>
                                            <ul>
                                                <li><a href="{{url('account/'.$aUser->name.'/'.$aUser->id)}}">Account<i class="fas fa-chevron-down"></i></a></li>
                                                <li><a href="{{url('logout')}}">Logout<i class="fas fa-chevron-down"></i></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Main -->

        <div class="header_main">
            <div class="container">
                <div class="row">

                    <!-- Logo -->
                    <div class="col-lg-2 col-sm-3 col-3 order-1">
                        <div class="logo_container">
                            <div class="logo"><a href={{url('index')}}>Biomedir</a></div>
                        </div>
                    </div>

                    <!-- Search -->
                    <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                        <div class="header_search">
                            <div class="header_search_content">
                                <div class="header_search_form_container">
                                    <form action="#" class="header_search_form clearfix">
                                        <input type="search" required="required" class="header_search_input" placeholder="Search for products...">
                                        <div class="custom_dropdown">
                                            <div class="custom_dropdown_list">
                                                <span class="custom_dropdown_placeholder clc">All Categories</span>
                                                <i class="fas fa-chevron-down"></i>
                                                <ul class="custom_list clc">
                                                    @foreach($listCateg as $item)
                                                    <li><a class="clc" href="#">{{$item->category_name}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <button type="submit" class="header_search_button trans_300" value="Submit"><img src="{{asset('asset/images/search.png')}}" alt=""></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Wishlist -->
                    <div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
                        <div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
                            <div class="wishlist d-flex flex-row align-items-center justify-content-end">
                                <div class="wishlist_icon"><img src="{{asset('asset/images/heart.png')}}" alt=""></div>
                                @auth
                                <div class="wishlist_content">
                                    <div class="wishlist_text"><a href="#">Wishlist</a></div>
                                    <div class="wishlist_count">0</div>
                                </div>
                                @endauth
                                @guest
                                <div class="wishlist_content">
                                    <div class="wishlist_text"><a href="#">Wishlist</a></div>
                                    <div class="wishlist_count">0</div>
                                </div>
                            </div>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Navigation -->

        <nav class="main_nav">
            <div class="container">
                <div class="row">
                    <div class="col">

                        <div class="main_nav_content d-flex flex-row">

                            <!-- Categories Menu -->

                            <div class="cat_menu_container">
                                <div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
                                    <div class="cat_burger"><span></span><span></span><span></span></div>
                                    <div class="cat_menu_text">categories</div>
                                </div>

                                <ul class="cat_menu">
                                    <!--li><a href="#">Computers & Laptops <i class="fas fa-chevron-right ml-auto"></i></a></li>
                                    <li><a href="#">Cameras & Photos<i class="fas fa-chevron-right"></i></a></li-->
                                    @foreach($listCateg as $item)
                                        <li class="hassubs">
                                        <a href="{{url('show_categories/'.$item->slug)}}">{{$item->category_name}}<i class="fas fa-chevron-right"></i></a>
                                        <ul>
                                            @foreach(App\Models\Categorie::find($item->id)->child as $sub_category)
                                            <li><a href="{{url('show_categories/'.$sub_category->slug)}}">{{$sub_category->category_name}}</a></li>
                                            @endforeach
                                        </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Main Nav Menu -->

                            <div class="main_nav_menu ml-auto">
                                <ul class="standard_dropdown main_nav_dropdown">
                                    <li><a href={{url('categories')}}>Catalogue<i class="fas fa-chevron-down"></i></a></li>
                                    <li class="hassubs">
                                        <a href="{{url('product')}}">Articles</a>
                                    </li>
                                    <li class="hassubs">
                                        <a href="#">Installations</i></a>
                                    </li>
                                    <li class="hassubs">
                                        <a href="#">Agences<i class="fas fa-chevron-down"></i></a>
                                        <ul>
                                            <li><a href="#">Lome<i class="fas fa-chevron-down"></i></a></li>
                                            <li><a href="#">Atakpame<i class="fas fa-chevron-down"></i></a></li>
                                            <li><a href="#">Kara<i class="fas fa-chevron-down"></i></a></li>
                                        </ul>
                                    </li>
                                    <li class="hassubs">
                                        <a href="#">Pages<i class="fas fa-chevron-down"></i></a>
                                        <ul>
                                            <li><a href="shop.html">Blog<i class="fas fa-chevron-down"></i></a></li>
                                            <li><a href="product.html">Promotions<i class="fas fa-chevron-down"></i></a></li>
                                            <li><a href="blog.html">Carrière<i class="fas fa-chevron-down"></i></a></li>
                                            <li><a href="blog_single.html">Financement<i class="fas fa-chevron-down"></i></a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{url('about')}}">A Propos<i class="fas fa-chevron-down"></i></a></li>
                                    <li><a href="{{url('contact')}}">Contact<i class="fas fa-chevron-down"></i></a></li>
                                </ul>
                            </div>

                            <!-- Menu Trigger -->

                            <div class="menu_trigger_container ml-auto">
                                <div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
                                    <div class="menu_burger">
                                        <div class="menu_trigger_text">menu</div>
                                        <div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Menu -->

        <div class="page_menu">
            <div class="container">
                <div class="row">
                    <div class="col">

                        <div class="page_menu_content">

                            <div class="page_menu_search">
                                <form action="#">
                                    <input type="search" required="required" class="page_menu_search_input" placeholder="Search for products...">
                                </form>
                            </div>
                            <ul class="page_menu_nav">
                                @auth
                                <li class="page_menu_item has-children">
                                    <a href="{{url('dashboard')}}">{{$aUser->name}}<i class="fa fa-angle-down"></i></a>
                                    <ul class="page_menu_selection">
                                        <li class="page_menu_item"><a href="{{url('dashboard')}}">Page<i class="fa fa-angle-down"></i></a></li>
                                        <li class="page_menu_item"><a href="{{url('account/'.$aUser->name.'/'.$aUser->id)}}">Mon Compte</a></li>
                                        <li class="page_menu_item"><a href="{{url('logout')}}">Logout</a></li>
                                    </ul>
                                </li>
                                @endauth
                                <li class="page_menu_item">
                                    <a href="{{url('index')}}">Home<i class="fa fa-angle-down"></i></a>
                                </li>
                                <li class="page_menu_item">
                                    <a href="{{url('categories')}}">Catalogue<i class="fa fa-angle-down"></i></a>
                                </li>
                                <li class="page_menu_item">
                                    <a href="{{url('product')}}">Articles<i class="fa fa-angle-down"></i></a>
                                </li>
                                <li class="page_menu_item">
                                    <a href="{{url('index')}}">Installation<i class="fa fa-angle-down"></i></a>
                                </li>
                                <li class="page_menu_item">
                                    <a href="{{url('index')}}">Agences<i class="fa fa-angle-down"></i></a>
                                </li>
                                <li class="page_menu_item has-children">
                                    <a href="{{url('show_categories/'.$item->slug)}}">Pages<i class="fa fa-angle-down"></i></a>
                                    <ul class="page_menu_selection">
                                        <li class="page_menu_item"><a href="{{url('blog')}}">Blog</a></li>
                                        <li class="page_menu_item"><a href="{{url('promotion')}}">promotion</a></li>
                                        <li class="page_menu_item"><a href="{{url('carrière/')}}">Carrière</a></li>
                                        <li class="page_menu_item"><a href="{{url('financement/')}}">Financement</a></li>
                                    </ul>
                                </li>
                                <li class="page_menu_item"><a href="{{url('about')}}">About<i class="fa fa-angle-down"></i></a></li>
                                <li class="page_menu_item"><a href="{{url('contact')}}">contact<i class="fa fa-angle-down"></i></a></li>
                            </ul>

                            <div class="menu_contact">
                                <div class="menu_contact_item"><div class="menu_contact_icon"><img src="{{asset('asset/images/phone_white.png')}}" alt=""></div>+228 90 94 33 35</div>
                                <div class="menu_contact_item"><div class="menu_contact_icon"><img src="{{asset('asset/images/mail_white.png')}}" alt=""></div><a href="mailto:fastsales@gmail.com">info@biomedir.com</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </header>

