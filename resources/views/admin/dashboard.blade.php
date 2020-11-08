@extends('master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/blog_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/blog_responsive.css')}}">
{{view('admin.header')}}
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Admin Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">{{$data->name}}</li>
                </ol>
                @if($data->user_state == 'actif')
                <div class="row">
                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-header"><a href="{{url('categories')}}" style="color: white; font-size: 30px" >Gestion +</a></div>
                            <div class="card-body">
                                <h5 class="card-title">Gestion des Articles</h5>
                                <p class="card-text" style="color: white">Dans cet espace vous pouvez gérer vos Mtériels.
                                    Vous pouvez ajouter, modifier et suprimer des Equipements, les catégories  et les Matériels</p>
                            </div>
                        </div>
                    </div>
                    @if($data->user_type == 'super_admin')
                    <div class="col-xl-4 col-md-6">
                        <div class="card text-white bg-info mb-4">
                            <div class="card-header"  style="color: white; font-size: 30px"><a href="{{url('admins')}}" style="color: white; font-size: 30px" >Admin +</a></div>
                            <div class="card-body">
                                <h5 class="card-title">Gestion des Utilisateurs</h5>
                                <p class="card-text" style="color: white">Dans cet espace vous pouvez gérer les Utilisateurs ayant accès.
                                    Vous pouvez ajouter, modifier et suprimer des Utilisateurs pouvant administrer le site</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="col-xl-4 col-md-6">
                        <div class="card text-white bg-secondary mb-4">
                            <div class="card-header"  style="color: white; font-size: 30px">Analyse +</div>
                            <div class="card-body">
                                <h5 class="card-title">Statistique du Site</h5>
                                <p class="card-text" style="color: white">Informer vous de qui accède au site, d'où accède t-ils, qu'elle page ou article ont-ils visité et bien plus <br><br>
                                </p>
                            </div>
                    </div>
                </div>
                @else
                    <div class="card">
                        <h5 class="card-header">Bienvenu {{$data->name}}</h5>
                        <div class="card-body">
                            <h5 class="card-title">Espace Administration</h5>
                            <p class="card-text">Veuillez Patienter, l'administrateur de votre site validera votre compte pour votre accès</p>
                            <a href="#" class="btn btn-primary">Ok</a>
                        </div>
                    </div>
                @endif
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; XpertPhp 2020</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

@endsection('content')
