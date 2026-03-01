@extends('layout.admin.admin')
@section('title', 'Créer les journées - Championnat - Tennis de table 17')
@section('content')

<h1>Créer les journées</h1>
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



<p>Vous vous appretez à créer {{$nombre_journees}} journées pour le {{$championnat->nomChampionnat . ' ' . $championnat->division->nomDivision}}.</p>
<p>Vous devez renseigner les dates des journées et les lieux des rencontres.</p>
<p>Vous devez également renseigner les équipes qui s'affronteront lors de chaque journée. Chaque équipe doit affronter tous les autres équipes 1 fois.</p>

<form action="{{route('championnat.storeJournees', [$championnat->idChampionnat, $nombre_journees])}}" method="POST">
    @CSRF
    @METHOD('POST')
    @php $jour = 1;  @endphp

@for($i = 1; $i <= $nombre_journees; $i++)
    <label for="datePrev-{{$i}}">Date de la {{$jour}}e journée:</label>
    <input type="date" name="datePrev-{{$i}}" id="datePrev-{{$i}}" required>
    @php $jour++; @endphp
    <br><br>

    @for($j = 1; $j <= 3; $j++)
        <label for="lieu_{{$i}}_{{$j}}">Lieu de la rencontre {{$j}}</label>
        <select name="lieu_{{$i}}_{{$j}}" id="lieu_{{$i}}_{{$j}}">
            <option value="">Sélectionner un lieu</option>
            @foreach($ville as $v)
                <option value="{{ $v->nomVille }}">{{ $v->nomVille }}</option>
            @endforeach
        </select>

        <label for="idEquipeA_{{$i}}_{{$j}}">Equipe Résidente {{$j}}</label>
        <select name="idEquipeA_{{$i}}_{{$j}}" id="idEquipeA_{{$i}}_{{$j}}">
            <option value="">Sélectionner une équipe</option>
            @foreach($equipes as $equipe)
                <option value="{{ $equipe->idEquipe }}">{{ $equipe->nomEquipe }}</option>
            @endforeach
        </select>

        <label for="idEquipeB_{{$i}}_{{$j}}">Equipe Visiteuse {{$j}}</label>
        <select name="idEquipeB_{{$i}}_{{$j}}" id="idEquipeB_{{$i}}_{{$j}}">
            <option value="">Sélectionner une équipe</option>
            @foreach($equipes as $equipe)
                <option value="{{ $equipe->idEquipe }}">{{ $equipe->nomEquipe }}</option>
            @endforeach
        </select>
        <br><br>
    @endfor

    <hr>
    <br>
@endfor
<br>
<button type="submit">Créer les journées</button>
</form>


<script>
    
</script>
@endsection