<!-- Recently Viewed -->

<div class="viewed">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="viewed_title_container">
                    <h3 class="viewed_title">Most Viewed</h3>
                    <div class="viewed_nav_container">
                        <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                    </div>
                </div>

                <div class="viewed_slider_container">

                    <!-- Recently Viewed Slider -->

                    <div class="owl-carousel owl-theme viewed_slider">

                        <!-- Recently Viewed Item -->
                        @foreach($recent as $item)
                        <div class="owl-item ">
                            @if($item->article_promotion != 0)
                            <div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                @elseif($item->article_version)
                                <div class="viewed_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                    @else
                                    <div class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                        @endif
                                        <div class="viewed_image"><img src="{{asset('asset/images/'.$item->article_image1)}}" alt="" width="115" height="115"></div>
                                        <div class="viewed_content text-center">
                                            <div class="viewed_name"><a href="{{url('show_article/'.$item->slug)}}">{{$item->article_name}}<br>{{$item->article_model}}</a></div>
                                        </div>
                                        <ul class="item_marks">
                                            <li class="item_mark item_discount">{{$item->article_promotion}}</li>
                                            <li class="item_mark item_new">new</li>
                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
