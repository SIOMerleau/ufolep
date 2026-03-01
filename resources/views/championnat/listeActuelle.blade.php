@extends('layout.guest.default')

@section('title', 'Liste des championnats')

@section('content')
    <h1>Liste des championnats</h1>

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


    @if(isset($championnats) && count($championnats) > 0)
        <table class=' data-table sober'>
            <thead>
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
                            <a href="{{ route('championnat.show', $championnat) }}" class="button primarybuttonBlue">Voir les matchs</a>
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