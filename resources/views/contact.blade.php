@extends('master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/contact_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/contact_responsive.css')}}">
{{View::make('header')}}


<!-- Contact Info -->

<div class="contact_info">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="contact_info_container d-flex flex-lg-row flex-column justify-content-between align-items-between">

                    <!-- Contact Item -->
                    <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                        <div class="contact_info_image"><img src="{{asset('asset/images/contact_1.png')}}" alt=""></div>
                        <div class="contact_info_content">
                            <div class="contact_info_title">Phone</div>
                            <div class="contact_info_text">+228 90 94 33 35</div>
                        </div>
                    </div>

                    <!-- Contact Item -->
                    <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                        <div class="contact_info_image"><img src="{{asset('asset/images/contact_2.png')}}" alt=""></div>
                        <div class="contact_info_content">
                            <div class="contact_info_title">Email</div>
                            <div class="contact_info_text">info@biomedir.com</div>
                        </div>
                    </div>

                    <!-- Contact Item -->
                    <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                        <div class="contact_info_image"><img src="{{asset('asset/images/contact_3.png')}}" alt=""></div>
                        <div class="contact_info_content">
                            <div class="contact_info_title">Address</div>
                            <div class="contact_info_text">Ancien rue Prinda Bè Pa de Souza Lomé - Togo</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Form -->

<div class="contact_form">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="contact_form_container">
                    <div class="contact_form_title">Get in Touch</div>
                    @if($aUser)
                    <form action="contact" id="contact_form" method="POST">
                        {{ csrf_field() }}
                        <div class="contact_form_inputs d-flex flex-md-row flex-column justify-content-between align-items-between">
                            <input type="hidden" name="id" id="contact_form_name" class="contact_form_name input_field" value="{{$aUser->id}}">
                            <input type="text" name="name" id="contact_form_name" class="contact_form_name input_field" placeholder="Votre nom" value="{{$aUser->name}}" required="required" data-error="Name is required.">
                            <input type="text" name="email" id="contact_form_email" class="contact_form_email input_field" placeholder="Votre email" value="{{$aUser->email}}" required="required" data-error="Email is required.">
                            <input type="text" name="phone" id="contact_form_phone" class="contact_form_phone input_field" placeholder="Votre Numéro Telephone">
                        </div>
                        <div class="contact_form_inputs d-flex flex-md-row flex-column justify-content-between align-items-between">
                        <input type="text" name="subject" id="contact_form_phone" class="contact_form_phone input_field" placeholder="Sujet du mail" required="required">
                        </div>
                            <div class="contact_form_text">
                            <textarea id="contact_form_message" class="text_field contact_form_message" name="message" rows="4" placeholder="Message" required="required" data-error="Please, write us a message."></textarea>
                        </div>
                        <div class="contact_form_button">
                            <button type="submit" class="button contact_submit_button">Send Message</button>
                        </div>
                    </form>
                    @else
                    <form action="send_email" id="contact_form" method="POST">
                        {{ csrf_field() }}
                        <div class="contact_form_inputs d-flex flex-md-row flex-column justify-content-between align-items-between">
                            <input type="text" name="name" id="contact_form_name" class="contact_form_name input_field" placeholder="Your name" required="required" data-error="Name is required.">
                            <input type="text" name="email" id="contact_form_email" class="contact_form_email input_field" placeholder="Your email" required="required" data-error="Email is required.">
                            <input type="text" name="phone" id="contact_form_phone" class="contact_form_phone input_field" placeholder="Your phone number">
                        </div>
                        <div class="contact_form_text">
                            <textarea id="contact_form_message" class="text_field contact_form_message" name="message" rows="4" placeholder="Message" required="required" data-error="Please, write us a message."></textarea>
                        </div>
                        <div class="contact_form_button">
                            <button type="submit" class="button contact_submit_button">Send Message</button>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="panel"></div>
</div>

<!-- Map -->

<div class="contact_map">
    <div id="google_map" class="google_map">
        <div class="map_container">
            <div id="map"></div>
        </div>
    </div>
</div>
@endsection('content')
@section('script_content')
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
<script src="{{asset('asset/js/contact_custom.js')}}"></script>
@endsection('script_content')
