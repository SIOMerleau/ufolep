@extends('layout.admin.admin')
@section('title', 'Gestion des championnats - Tennis de table 17')

@section('content')

    <h2>Liste des championnats</h2>

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

    <a href="{{ route ('admin.championnat.create')}}"
        class="button primarybuttonBlue">
         <i class="fas fa-plus fa-sm"></i>&nbsp Nouveau championnat</a>

    @if(isset($championnats) && count($championnats) > 0)
    <table class=' data-table sober left-align-table'>
        <thead class="thead-titre">
            <tr>
                <th>Nom</th>
                <th>Type</th>
                <th>Division</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($championnats as $championnat)  {{-- Correction : $championnats et $championnat --}}
                <tr>
                    <td>{{ $championnat->nomChampionnat }}</td>
                    <td>{{ $championnat->typeChampionnat }}</td>
                    <td>{{ $championnat->division->nomDivision ?? 'Non défini' }}</td>
                    <td>
                        <a href="{{ route('admin.championnat.showAdmin', $championnat) }}" class="button primarybuttonBlue">Voir les matchs</a>
                        <a href="{{route('classement', ['id' => $championnat->idChampionnat])}}"  class="button primarybuttonWhite">Voir le classement</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Aucun championnat trouvé.</p>
    @endif

@endsection