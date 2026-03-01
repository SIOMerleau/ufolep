<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'SANA - Tennis de table 17')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <!--Script -->
    <script src="https://kit.fontawesome.com/165449b566.js" crossorigin="anonymous"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg justify-content-between">
            <a class="navbar-brand link" href="{{route('championnats.listeActuelle')}}">
                <img id="logo" width="125px" height="50px" src="{{ asset('img/logo_site2.png') }}" alt="Logo de l'UFOLEP"/>
            </a>

            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Dérouler le menu">
                <i class="fas fa-bars fa-lg"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto"></ul>
                <ul class="navbar-nav" style="padding-right:50px;">
                    <li class="nav-item">
                        <a class="nav-link link" href="{{route('championnats.listeActuelle')}}">Championnats
                        <?=(date ("n")>=10 )?(date('Y') ) . '-' . (date('Y')+1):(date('Y') - 1) . '-' . (date('Y')); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link" href="{{route('championnat.ancienneListe')}}">Historique Championnats</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link" href="{{route('joueur.liste')}}">Classement individuel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link" href="{{route('aide.liste')}}">Aide</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link" href="{{route('info.contact')}}">Contact</a>
                    </li>
                </ul>
            

                <ul class="navbar-nav">
                    <li class="nav-item active">
                    @php /* Si l'utilisateur est connecté */ @endphp
                        @if(Auth::check())
                            <a href="{{route('admin.listeChampionnat')}}" class="nav-link link special-link">Mon espace</a>  
                    @php /* Sinon */ @endphp
                        @else 
                            <a href="{{route('auth.index')}}" class="nav-link link special-link">Connexion</a>
                        @endif
                    </li>
                    @php /* Si l'utilisateur est connecté */ @endphp
                    @if(Auth::check())
                        <li class="nav-item active">
                            <a href="{{route('auth.logout')}}" class="nav-link link special-link">Déconnexion</a>
                        </li>
                    @endif
                </ul>
        </nav>
    </header>

    <section id="main-section" class="container-fluid">
        @yield('content')
    </section>

@php /**Footer */ @endphp
@include('layout.guest.footer')


</body>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
        
</html>