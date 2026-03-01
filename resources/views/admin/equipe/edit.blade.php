@extends('layout.admin.admin')
@section('title', 'Modification d\'une équipe')
@section('content')

@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@elseif(session()->has('success'))
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

<h2>Modification de {{$equipe->nomEquipe}}</h2>
<hr>

<form action="{{route('admin.equipe.update', ['id' => $equipe->idEquipe])}}" method="post">
    @csrf
    @METHOD('POST')
    <label for="nomEquipe">Nom d'équipe</label>
    <input type="text" name="nomEquipe" value="{{$equipe->nomEquipe}}">
<br>
    <label for="idClub">Club</label>
    <select name="idClub">
        @foreach($clubs as $c)
            <option value="{{$c->idClub}}" @if($c->idClub == $equipe->idClub) selected @endif>{{$c->nomClub}}</option>
        @endforeach
    </select>
<br>
    <label for="idDivision">Division</label>
    <select name="idDivision">
        @foreach($divisions as $d)
            <option value="{{$d->idDivision}}" @if($d->idDivision == $equipe->idDivision) selected @endif>{{$d->nomDivision}}</option>
        @endforeach
    </select>
<br>
<br>
    <button type="submit" class="button primarybuttonBlue">Modifier</button>
</form>
@endsection