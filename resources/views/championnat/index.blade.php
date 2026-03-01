@extends('layout.guest.default')
@section('title', 'Championnat - Tennis de table 17')

@section('content')
    <p class="text-primary">Coucou</p>
    @auth
        <p>Vous êtes connecté</p>
        @if(Auth::user()->typeCompte == 'ARBITRE')
            <p>Vous êtes Arbitre</p>

           

        @elseif(Auth::user()->typeCompte == 'GÉRANT')
            <p>Vous êtes Gérant</p>
        @endif
    @endauth
    @guest
        <p>Vous n'êtes pas connecté</p>
    @endguest

    

@endsection



