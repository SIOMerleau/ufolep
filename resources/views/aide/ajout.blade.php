@extends('layout.guest.default')

@section('title', 'Ajouter Aide - Tennis de table 17')

@section('content')
@auth

<h2>Nouvelle aide</h2>
<br>

@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@elseif(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@elseif($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif

<form method="POST" action="{{route('aide.store')}}">
    @csrf
    @METHOD('POST')
        <label for="titre_aide">Titre de l'aide</label>
        <input class="form-control" type="text" name="titre_aide" value="" size="20" maxlength="255" required />

        <label for="lien">Lien</label>
        <input class="form-control" type="text" name="lien" value="" size="20" maxlength="255" required />
        <br>
        <a class="button primarybuttonWhite" href="{{route('aide.liste')}}">Annuler</a>
        <input class="button primarybuttonBlue" type="submit" value="Enregistrer" name="submit" />
    </form>

@endauth
@endsection




