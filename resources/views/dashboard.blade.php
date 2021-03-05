@extends('master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/cart_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/cart_responsive.css')}}">
{{View::make('header')}}

<!-- Cart -->

<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cart_container">
                        <div class="cart_title">List de Vos Favoris</div>
                        <div class="cart_items">
                            <ul class="cart_list">
                                @if(sizeof($favories) != 0)
                                @foreach ($favories as $favori)
                                <li class="cart_item clearfix">
                                    <div class="cart_item_image"><img src="{{asset('asset/images/'.$favori->article_image1)}}" alt=""></div>
                                    <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                        <div class="cart_item_name cart_info_col">
                                            <div class="cart_item_text"><a href="{{url('show_article/'.$favori->slug)}}">{{$favori->article_name}} {{$favori->article_model}}</a></div>
                                        </div>
                                        <!--div class="cart_item_quantity cart_info_col">
                                            <div class="cart_item_title">Categorie</div>
                                            <div class="cart_item_text">{{App\Models\Categorie::find($favori->categorie_id)->category_name}}</div>
                                        </div-->
                                        <div class="cart_item_quantity cart_info_col">
                                            <div class="cart_item_title"></div>
                                            <div class="cart_item_text"><button type="button" class="btn btn-outline-danger">Retirer</button></div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="cart_buttons">
                            <button type="button" class="button cart_button_checkout">Demandez un Devis</button>
                        </div>
                        @else
                        <li class="cart_item clearfix">
                            <div class="cart_item_image"><img src="{{asset('asset/images/favoris.jpg')}}" alt=""></div>
                            <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                <div class="cart_item_name cart_info_col">
                                    <div class="cart_item_text">Vous n'avez aucun article dans la liste des favoris. Veuillez en ajouter.</div>
                                </div>
                                <!--div class="cart_item_quantity cart_info_col">
                                    <div class="cart_item_title">Categorie</div>
                                    <div class="cart_item_text">App\Models\Categorie::find($favori->categorie_id)->category_name</div>
                                </div-->
                                <div class="cart_item_quantity cart_info_col">
                                    <div class="cart_item_title"></div>
                                    <div class="cart_item_text"><button type="button" class="btn btn-outline-primary">
                                            <a href="{{url('product')}}">Ajout favoris</a</button></div>
                                </div>
                            </div>
                        </li>
                        </ul>
                    </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <br><br>
                <div class="card" style="width: 18rem;">
                    <img src="{{asset('asset/images/shopping_cart.jpg')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$aUser->name}}</h5>
                        <p class="card-text">Nous préservons vos données confidentielles</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"> Email: {{$aUser->email}}</li>
                        <li class="list-group-item">Adresse: {{$aUser->user_address}}</li>
                        <li class="list-group-item">Numéro:  {{$aUser->phone_number}}</li>
                    </ul>
                    <div class="card-body">
                        <a href="{{url('account/'.$aUser->name.'/'.$aUser->id)}}" class="btn btn-primary">Modifier</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content')
@section('script_content')
<script src="{{asset('asset/js/cart_custom.js')}}"></script>
@endsection('script_content')
