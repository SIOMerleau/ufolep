@extends('layout.guest.default')
@section('title', 'Championnat - Tennis de table 17')
@section('content')

<div>
    <h3>Journée N° {{ $rencontre->journee->numJournee }}</h3>
</div>

<br>
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


<div>
    <table border=1 class="data-table sober">
        <thead class="text-center">
            <tr>
                <th>NOM PRENOM Juge Arbitre</th>
                <th>Date :</th>
                <th>Heure :</th>
                <th>Lieu :</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    @if ($rencontre->arbitre)
                        {{ $rencontre->arbitre->personne->nom ?? '' }} {{ $rencontre->arbitre->personne->prenom ?? '' }}
                    @else
                        Non défini
                    @endif
                </td>
                <td>{{ $rencontre->date }}</td>
                <td>{{ $rencontre->heure }}</td>
                <td>{{ $rencontre->lieu }}</td>
            </tr>
        </tbody>
    </table>
</div>
<br>

<div>
    <table border=1 class="data-table sober" id="player-table">
        <thead class="text-center">
            <tr>
                <th colspan="{{ strpos($rencontre->equipeA->nomEquipe, 'Smash') !== false ? 4 : 3 }}">Equipe {{ $rencontre->equipeA->nomEquipe }}</th>
                <th colspan="{{ strpos($rencontre->equipeB->nomEquipe, 'Smash') !== false ? 4 : 3 }}">Equipe {{ $rencontre->equipeB->nomEquipe }}</th>
            </tr>
            <tr>
                <th>Clé</th>
                <th>NOM PRENOM</th>
                <th>Licence</th>
                <th>Classement</th>
                <th>Clé</th>
                <th>NOM PRENOM</th>
                <th>Licence</th>
                <th>Classement</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rencontre->detailsMatch as $key => $detail)
                <tr>
                    @if ($key < 3 || strpos($rencontre->equipeA->nomEquipe, 'Smash') !== false && $key < 4)
                        <td class="player-letter">{{ $detail->lettreR ?? '' }}</td>
                        <td>{{ $detail->joueurA->personne->nom ?? '' }} {{ $detail->joueurA->personne->prenom ?? '' }}</td>
                        <td>{{ strtoupper($detail->joueurA->licenceJoueur) }}</td>
                        <td>{{ $detail->classementJoueurA ?? $detail->JoueurA->classement }}</td>
                    @endif
                    @if ($key < 3 || strpos($rencontre->equipeB->nomEquipe, 'Smash') !== false && $key < 4)
                        <td class="player-letter">{{ $detail->lettreV ?? '' }}</td>
                        <td>{{ $detail->joueurB->personne->nom ?? '' }} {{ $detail->joueurB->personne->prenom ?? '' }}</td>
                        <td>{{ strtoupper($detail->joueurB->licenceJoueur) }}</td>
                        <td>{{ $detail->classementJoueurB ?? $detail->JoueurB->classement }}</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<br>


<div>
    <table border='1' class="data-table sober">
        <thead>
            <tr>
                <th>Clés</th>
                <th>Joueurs club</th>
                <th>Joueurs visiteurs</th>
                <th>Manche 1</th>
                <th>Manche 2</th>
                <th>Manche 3</th>
                <th>Manche 4</th>
                <th>Manche 5</th>
                <th>Points club</th>
                <th>Points visiteurs</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rencontre->detailsMatch as $detail)
                <tr>
                    <td>
                        @if ($detail->joueurA && $detail->joueurB)
                            {{ $detail->joueurA->lettre ?? '' }}-{{ $detail->joueurB->lettre ?? '' }}
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $detail->joueurA->personne->nom ?? '' }} {{ $detail->joueurA->personne->prenom ?? '' }}</td>
                    <td>{{ $detail->joueurB->personne->nom ?? '' }} {{ $detail->joueurB->personne->prenom ?? '' }}</td>
                    <td>{{ $detail->M1 ?? '-' }}/
                        {{ $detail->M1B ?? '-' }}
                    </td>
                    <td>{{ $detail->M2 ?? '-' }}
                        /{{ $detail->M2B ?? '-' }}
                    </td>
                    <td>{{ $detail->M3 ?? '-' }}/
                        {{ $detail->M3B ?? '-' }}
                    </td>
                    <td>{{ $detail->M4 ?? '-' }}/
                        {{ $detail->M4B ?? '-' }}
                    </td>
                    <td>{{ $detail->M5 ?? '-' }}/
                        {{ $detail->M5B ?? '-' }}
                    </td>
                    <td>{{ $detail->pointsA ?? '-' }}</td>
                    <td>{{ $detail->pointsB ?? '-' }}</td>
                </tr>
            @endforeach

            <tr>
                <td colspan="3">Double</td>
                <td>{{ $rencontre->D1 ?? '-' }}/
                    {{ $rencontre->D1B ?? '-' }}
                </td>
                <td>{{ $rencontre->D2 ?? '-' }}/
                    {{ $rencontre->D2B ?? '-' }}
                </td>
                <td>{{ $rencontre->D3 ?? '-' }}/
                    {{ $rencontre->D3B ?? '-' }}
                </td>
                <td>{{ $rencontre->D4 ?? '-' }}/
                    {{ $rencontre->D4B ?? '-' }}
                </td>
                <td>{{ $rencontre->D5 ?? '-' }}/
                    {{ $rencontre->D5B ?? '-' }}
                </td>
                <td>{{ $rencontre->ptsDbA ?? '-' }}</td>
                <td>{{ $rencontre->ptsDbB ?? '-' }}</td>
            </tr>
            <tr>
                <td colspan="3">Score final</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $rencontre->scoreFinalA ?? '-' }}</td>
                <td>{{ $rencontre->scoreFinalB ?? '-' }}</td>
            </tr>
        </tbody>
    </table>
</div>
<br>
<div>
    <table border=1 class="data-table sober">
        <thead class="text-center">
            <th colspan=3>Résultats</th>
        </thead>
        <tbody>
            <tr>
                @if ($rencontre->scoreFinalA == $rencontre->scoreFinalB)
                    <td>Match Nul</td>
                @else
                    <td>Victoire de l'équipe :</td>
                    <td>
                        @if ($rencontre->scoreFinalA > $rencontre->scoreFinalB)
                            {{ $rencontre->equipeA->nomEquipe }}
                        @else
                            {{ $rencontre->equipeB->nomEquipe }}
                        @endif
                    </td>
                @endif
            </tr>
        </tbody>
    </table>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const playerRows = document.querySelectorAll('#player-table tbody tr');
        const letterSet = new Set();
        playerRows.forEach(row => {
            const letterElements = row.querySelectorAll('.player-letter');
            letterElements.forEach(letterElement => {
                const letter = letterElement.textContent.trim();
                if (letterSet.has(letter)) {
                    row.style.display = 'none'; // Make duplicate rows invisible
                } else {
                    letterSet.add(letter);
                }
            });
        });
    });
</script>
@endsection
