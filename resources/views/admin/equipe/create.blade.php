@extends('layout.admin.admin')
@section('title', 'Gestion des joueurs - Tennis de table 17')

@section('content')


<h2>Nouvelle équipe</h2>
<hr>
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

<form action="{{ route('equipe.store') }}" method="POST">
    @csrf  {{-- Ajoutez le token CSRF pour la sécurité --}}

    <label for="nomEquipe">Nom de l'équipe:</label>
    <input class="form-control" type="text" name="nomEquipe" id="nomEquipe" value="{{ old('nomEquipe') }}" size="20" required>
    @error('nomEquipe')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <label for="idClub">Club:</label>
    <select class="form-control" name="idClub" id="idClub" required>
        <option value="">Sélectionnez un club</option>  @foreach ($clubs as $c)
            <option value="{{ $c->idClub }}" {{ old('idClub') == $c->idClub ? 'selected' : '' }}>
                {{ $c->nomClub }}
            </option>
        @endforeach
    </select>
    </select>
    @error('idClub')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label for="idDivision">Division:</label>
    <select class="form-control" name="idDivision" id="idDivision" required>
        @foreach ($divisions as $division)
            <option value="{{ $division->idDivision }}" {{ old('idDivision') == $division->idDivision ? 'selected' : '' }}>
                {{ $division->nomDivision }}
            </option>
        @endforeach
    </select>
    @error('idDivision')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <br>

    <a class="button primarybuttonWhite" href="{{ route('admin.equipe.listeEquipe') }}">Annuler</a>
    <input class="primarybuttonBlue" type="submit" value="Enregistrer" name="creerEquipe">
</form>

@endsection