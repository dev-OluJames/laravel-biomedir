@extends('master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/blog_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/styles/blog_responsive.css')}}">

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href={{url('index')}}>Biomedire</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button
    ><!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
            <div class="input-group-append">
                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">Mon Compte</a><a class="dropdown-item" href="#">Notifications</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{url('logout')}}">Logout</a>
            </div>
        </li>
    </ul>
</nav>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Admin Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">{{$aUser->name}}</li>
                </ol>
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
