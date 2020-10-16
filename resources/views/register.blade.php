
@extends('master')
@section('content')
{{View::make('header')}}
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/blog_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/blog_responsive.css')}}">

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="logo text-center"><a href="#">Create Account</a></div>
                             <div class="card-body">
                                <form action="{{url('post-register')}}" method="POST" id="regForm">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input class="form-control py-4" id="inputFirstName" type="text" name="name" placeholder="Enter Full Name" />
                                        @if ($errors->has('name'))
                                        <span class="error">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                         <input class="form-control py-4" id="inputEmailAddress" type="email" aria-describedby="emailHelp" name="email" placeholder="Enter email address" />
                                        @if ($errors->has('email'))
                                        <span class="error">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control py-4" id="inputPassword" type="password" name="password" placeholder="Enter password" />
                                        @if ($errors->has('password'))
                                        <span class="error">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control py-4" id="inputPassword" type="password" name="confirm_password" placeholder="Enter password" />
                                        @if ($errors->has('password'))
                                        <span class="error">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mt-4 mb-0">
                                        <button class="btn btn-primary btn-block" type="submit">Create Account</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center">
                                <div class=""><a href="{{url('login')}}">Have an account? Go to login</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection('content)
