@extends('layout.admin.admin')

@section('title', 'Gestion des rencontres - Tennis de table 17')

@section('content')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">

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


    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <h1>{{ $championnat->nomChampionnat }}</h1>
    <p>Type : {{ $championnat->typeChampionnat }}</p>
    <p>Division : {{ $championnat->division->nomDivision }}</p>

    @if ($championnat->journees->isNotEmpty())
        <h2>Journées :</h2>
        @foreach ($championnat->journees as $journee)
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <table style="width: 100%" class="data-table">
                            <thead class="text-center">
                                <tr>
                                    <th colspan="7">
                                        Journée {{ $journee->numJournee }}  </br> ({{ $journee->datePrev }})
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($journee->rencontres->isNotEmpty())
                                    @foreach ($journee->rencontres as $rencontre)
                                        <tr>
                                            @if ($rencontre->equipeA && $rencontre->equipeB)
                                                <td style='width:20%'>{{ $rencontre->equipeA->nomEquipe ?? 'Équipe inconnue' }}</td>
                                                <td style='width:20%'></td>
                                                @if ($rencontre->scoreFinalA !== null && $rencontre->scoreFinalB !== null)
                                                    <td style='width:5%'>                                                        
                                                        {{ $rencontre->scoreFinalA }}
                                                    </td>
                                                    <td style="width: 5%">
                                                        @if ($rencontre->idArbitre == 0 || $rencontre->idArbitre == null || $rencontre->idArbitre == 81)
                                                            <a href="{{ route('admin.championnat.rencontreCreate', [ 'rencontre' => $rencontre->idRencontre]) }}" class="button primarybuttonWhite">
                                                                Compléter la rencontre
                                                            </a>
                                                        @else
                                                            <a href="{{ route('admin.championnat.editDetailsMatch', ['championnatId' => $championnat->idChampionnat, 'rencontreId' => $rencontre->idRencontre]) }}" class="button primarybuttonBlue">
                                                                Feuille de match
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td style='width:5%'>
                                                        {{ $rencontre->scoreFinalB }}
                                                    </td>
                                                @else
                                                    <td colspan="3">
                                                        <a href="{{ route('admin.championnat.rencontreCreate', ['championnat' => $championnat->idChampionnat, 'journee' => $journee->idJournee]) }}">
                                                            Créer le match
                                                        </a>
                                                    </td>
                                                @endif
                                                <td style='width:40%'>{{ $rencontre->equipeB->nomEquipe ?? 'Équipe inconnue' }}</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">Aucune rencontre pour cette journée.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <br />
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>Aucune journée pour ce championnat.</p>
    @endif

    <a href="{{ route('admin.listeChampionnat') }}" class="btn btn-secondary">Retour à la liste des championnats</a>

@endsection