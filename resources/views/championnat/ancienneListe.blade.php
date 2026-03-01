@extends('layout.guest.default')
@section('title', 'Championnat - Tennis de table 17')
@section('content')
    <h1>Liste des Championnats</h1>

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
            @foreach ($championnats as $championnat)
                <tr><div class="row">
                    <td>{{ $championnat->nomChampionnat }}</td>
                    <td>{{ $championnat->typeChampionnat }}</td>
                    <td>{{ $championnat->division->nomDivision }}</td> {{-- Accès à la division --}}
                    
                    <td>
                        <a href="{{ route('championnat.show', $championnat) }}" class="button primarybuttonWhite col-lg text-center">Voir les matchs</a> {{-- Lien vers la nouvelle route --}}
                        <a href="{{route('classement', ['id' => $championnat->idChampionnat])}}" class="button primarybuttonBlue col-lg text-center">Classement</a>
                    </td>
                    </div>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
    


    
