@extends('layout.guest.default')

@section('title', 'Championnat - Tennis de table 17')

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

    <h1>{{ $championnat->nomChampionnat }}</h1>
    <h3>Type : {{ $championnat->typeChampionnat }}</h3>
    <h3>Division : {{ $championnat->division->nomDivision }}</h3>
    <a href="{{ route('championnat.ancienneListe') }}" class="button primarybuttonWhite">Retour à la liste des championnats</a>
    @if ($championnat->journees->isNotEmpty())
        <h2>Journées :</h2>
        @foreach ($championnat->journees as $journee)
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <table style="width: 100%" class="data-table">  {{-- Ajout de la classe custom-table --}}
                            <thead class="text-center">
                                <tr>
                                    <th colspan="7">J{{ $journee->numJournee }}<br>{{ $journee->datePrev }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @if ($journee->rencontres->isNotEmpty())
                                    @foreach ($journee->rencontres as $rencontre)
                                        <tr>
                                            @if ($rencontre->equipeA && $rencontre->equipeB)
                                                <td style='width:20%'><a href="{{route('equipe.listeEquipeJoueur', ['equipe'=> $rencontre->equipeA->idEquipe])}}" >{{ $rencontre->equipeA->nomEquipe ?? 'Équipe inconnue' }} </td>
                                                <td style='width:20%'></td>
                                                @if ($rencontre->scoreFinalA !== null && $rencontre->scoreFinalB !== null)
                                                    <td style='width:5%'>{{ $rencontre->scoreFinalA }}</td>
                                                    <td style="width: 5%"><a href="{{ route('championnat.detailMatch', ['championnat' => $championnat->idChampionnat, 'rencontre' => $rencontre->idRencontre]) }}">
                                                            <i class="far fa-list-alt" aria-hidden="true"></i>
                                                        </a></td>
                                                    <td style='width:5%'>{{ $rencontre->scoreFinalB }}</td>
                                                @endif
                                                <td style='width:40%'><a href="{{route('equipe.listeEquipeJoueur', ['equipe'=> $rencontre->equipeB->idEquipe])}}" >{{ $rencontre->equipeB->nomEquipe ?? 'Équipe inconnue' }}</td>
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

   

@endsection