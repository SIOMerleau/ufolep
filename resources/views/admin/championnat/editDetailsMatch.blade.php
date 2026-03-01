@extends('layout.guest.default')
@section('title', 'Championnat - Tennis de table 17')
@section('content')

<style>
 
 .manche-cell {
        padding: 0;
        white-space: nowrap;
    }

    .manche-cell input {
        width: 40px;
        display: inline-block;
        margin: 2px;
    }

    .small-input {
        width: 60px;
        height: 40px;
        font-size: 14px;
        padding: 2px;
    }

    table {
        border-collapse: collapse;
    }

    td {
        padding: 5px;
    }

    .manche-input {
        width: 40px !important;
    }

    .points-input{
        width: 80px;
        height: 30px;
    
    }
    
    .points-input-double{
        width: 80px;
        height: 30px;
    
    }

    .score-input {
        width: 80px;
        height: 30px;
    
    }

</style>

    <h1>Modifier les détails du match</h1>
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


@php
// var_dump($equipeA[1][1]['idJoueur']);
@endphp

    <form action="{{ route('championnat.updateDetailsMatch', ['championnat' => $championnat->idChampionnat, 'rencontreId' => $rencontre->idRencontre]) }}"  onsubmit="return confirmEnregistrement()" method="POST">
        @csrf
        @method('PUT')

        <div>
            <h3>Journée N° {{ $rencontre->journee->numJournee }}</h3>
        </div>

        <br>
        <hr>
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
                            @if ($key < 3 || (strpos(strtolower($rencontre->equipeA->nomEquipe), 'smash') !== false && $key < 4))
                                <td class="player-letter">{{ $detail->lettreR ?? '' }}</td>
                                <td>
                                    <input type="text" name="joueurA_nom_{{ $detail->id }}" value="{{ $detail->joueurA->personne->nom ?? '' }}" readonly>
                                    <input type="text" name="joueurA_prenom_{{ $detail->id }}" value="{{ $detail->joueurA->personne->prenom ?? '' }}" readonly>
                                </td>
                                <td><input type="text" name="joueurA_licence_{{ $detail->id }}" value="{{ strtoupper($detail->joueurA->licenceJoueur) }}" readonly></td>
                                <td><input type="number" name="joueurA_classement_{{ $detail->id }}" value="{{ $detail->classementJoueurA ?? $detail->JoueurA->classement}}" readonly></td>
                            @endif
                
                            @if ($key < 3 || (strpos(strtolower($rencontre->equipeB->nomEquipe), 'smash') !== false && $key < 4))
                                <td class="player-letter">{{ $detail->lettreV ?? '' }}</td>
                                <td>
                                    <input type="text" name="joueurB_nom_{{ $detail->id }}" value="{{ $detail->joueurB->personne->nom ?? '' }}" readonly>
                                    <input type="text" name="joueurB_prenom_{{ $detail->id }}" value="{{ $detail->joueurB->personne->prenom ?? '' }}" readonly>
                                </td>
                                <td><input type="text" name="joueurB_licence_{{ $detail->id }}" value="{{ strtoupper($detail->joueurB->licenceJoueur) }}" readonly></td>
                                <td><input type="number" name="joueurB_classement_{{ $detail->id }}" value="{{ $detail->classementJoueurB ?? $detail->JoueurB->classement }}" readonly></td>
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
                            <input type="hidden" name="joueurA_id_{{ $detail->idMatch }}" value="{{ $detail->joueurA->idJoueur ?? '' }}">
                            <input type="hidden" name="joueurB_id_{{ $detail->idMatch }}" value="{{ $detail->joueurB->idJoueur ?? '' }}">
        
                            <td>
                                @if ($detail->joueurA && $detail->joueurB)
                                    {{ $detail->joueurA->lettre ?? '' }}-{{ $detail->joueurB->lettre ?? '' }}
                                @else
                                    -
                                @endif
                            </td>
                           
                            <td>
                                <input type="text" name="joueurA_nom_match_{{ $detail->id }}" value="{{ $detail->joueurA->personne->nom ?? '' }} {{ $detail->joueurA->personne->prenom ?? '' }}" readonly>
                            </td>
                            <td>
                                <input type="text" name="joueurB_nom_match_{{ $detail->id }}" value="{{ $detail->joueurB->personne->nom ?? '' }} {{ $detail->joueurB->personne->prenom ?? '' }}"readonly>
                            </td>
                            <td class="manche-cell">
                                <input type="number" name="M1_{{ $detail->idMatch }}" value="{{ $detail->M1 ?? '-' }}" class="manche-input small-input" data-match-id="{{ $detail->idMatch }}" data-player="A">/
                                <input type="number" name="M1B_{{ $detail->idMatch }}" value="{{ $detail->M1B ?? '-' }}" class="manche-input small-input" data-match-id="{{ $detail->idMatch }}" data-player="B">
                            </td>
                            <td class="manche-cell">
                                <input type="number" name="M2_{{ $detail->idMatch }}" value="{{ $detail->M2 ?? '-' }}" class="manche-input small-input" data-match-id="{{ $detail->idMatch }}" data-player="A">/
                                <input type="number" name="M2B_{{ $detail->idMatch }}" value="{{ $detail->M2B ?? '-' }}" class="manche-input small-input" data-match-id="{{ $detail->idMatch }}" data-player="B">
                            </td>
                            <td class="manche-cell">
                                <input type="number" name="M3_{{ $detail->idMatch }}" value="{{ $detail->M3 ?? '-' }}" class="manche-input small-input" data-match-id="{{ $detail->idMatch }}" data-player="A">/
                                <input type="number" name="M3B_{{ $detail->idMatch }}" value="{{ $detail->M3B ?? '-' }}" class="manche-input small-input" data-match-id="{{ $detail->idMatch }}" data-player="B">
                            </td>
                            <td class="manche-cell">
                                <input type="number" name="M4_{{ $detail->idMatch }}" value="{{ $detail->M4 ?? '-' }}" class="manche-input small-input" data-match-id="{{ $detail->idMatch }}" data-player="A">/
                                <input type="number" name="M4B_{{ $detail->idMatch }}" value="{{ $detail->M4B ?? '-' }}" class="manche-input small-input" data-match-id="{{ $detail->idMatch }}" data-player="B">
                            </td>
                            <td class="manche-cell">
                                <input type="number" name="M5_{{ $detail->idMatch }}" value="{{ $detail->M5 ?? '-' }}" class="manche-input small-input" data-match-id="{{ $detail->idMatch }}" data-player="A">/
                                <input type="number" name="M5B_{{ $detail->idMatch }}" value="{{ $detail->M5B ?? '-' }}" class="manche-input small-input" data-match-id="{{ $detail->idMatch }}" data-player="B">
                            </td>
                            <td><input type="number" name="pointsA_{{ $detail->idMatch }}" value="{{ $detail->pointsA ?? '-' }}" class="points-input" data-match-id="{{ $detail->idMatch }}" data-player="A"></td>
                            <td><input type="number" name="pointsB_{{ $detail->idMatch }}" value="{{ $detail->pointsB ?? '-' }}" class="points-input" data-match-id="{{ $detail->idMatch }}" data-player="B"></td>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="3">Double</td>
                        <td class="manche-cell">
                            <input type="number" name="D1" value="{{ $rencontre->D1 ?? '-' }}" class="manche-input-double small-input">/
                            <input type="number" name="D1B" value="{{ $rencontre->D1B ?? '-' }}" class="manche-input-double small-input">
                        </td>
                        <td class="manche-cell">
                            <input type="number" name="D2" value="{{ $rencontre->D2 ?? '-' }}" class="manche-input-double small-input">/
                            <input type="number" name="D2B" value="{{ $rencontre->D2B ?? '-' }}" class="manche-input-double small-input">
                        </td>
                        <td class="manche-cell">
                            <input type="number" name="D3" value="{{ $rencontre->D3 ?? '-' }}" class="manche-input-double small-input">/
                            <input type="number" name="D3B" value="{{ $rencontre->D3B ?? '-' }}" class="manche-input-double small-input">
                        </td>
                        <td class="manche-cell">
                            <input type="number" name="D4" value="{{ $rencontre->D4 ?? '-' }}" class="manche-input-double small-input">/
                            <input type="number" name="D4B" value="{{ $rencontre->D4B ?? '-' }}" class="manche-input-double small-input">
                        </td>
                        <td class="manche-cell">
                            <input type="number" name="D5" value="{{ $rencontre->D5 ?? '-' }}" class="manche-input-double small-input">/
                            <input type="number" name="D5B" value="{{ $rencontre->D5B ?? '-' }}" class="manche-input-double small-input">
                        </td>
                        <td>
                            <input type="number" name="pointsADouble" value="{{ $rencontre->ptsDbA ?? '-' }}" class="points-input-double" data-player="A">
                        </td>
                        <td>
                            <input type="number" name="pointsBDouble" value="{{ $rencontre->ptsDbB ?? '-' }}" class="points-input-double" data-player="B">
                        </td>
                    </tr>
                        <td colspan="3">Score final</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        @php
                            //Gestion des forfaits
                            @endphp
                        @if($rencontre->WO == 'A')
                            <td><input class="score-input" type="number" name="scoreFinalA" id="scoreFinalA" value="11" readonly></td>
                            <td><input class="score-input" type="number" name="scoreFinalB" id="scoreFinalB" value="0" readonly></td>
                        @elseif($rencontre->WO == 'B')
                            <td><input class="score-input" type="number" name="scoreFinalA" id="scoreFinalA" value="0" readonly></td>
                            <td><input class="score-input" type="number" name="scoreFinalB" id="scoreFinalB" value="11" readonly></td>
                        @else
                            <td><input class="score-input" type="number" name="scoreFinalA" id="scoreFinalA" value="{{ $rencontre->scoreFinalA ?? '-' }}" onchange="updateResult()"></td>
                            <td><input class="score-input" type="number" name="scoreFinalB" id="scoreFinalB" value="{{ $rencontre->scoreFinalB ?? '-' }}" onchange="updateResult()"></td>
                        @endif
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
                        <td>
                            @php
                            //Gestion des forfaits
                            @endphp
                            @if($rencontre->WO == 'A')
                                <label for="resultat">Victoire de {{ $rencontre->equipeA->nomEquipe }} par forfait</label>
                            @elseif($rencontre->WO == 'B')
                                <label for="resultat">Victoire de {{ $rencontre->equipeB->nomEquipe }} par forfait</label>
                            @else
                                <label for="resultat" id="resultat"></label>
                                <input type='hidden' name="victoire" id="victoire" value="N" required readonly/>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <button type="submit">Enregistrer les modifications</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const playerRows = document.querySelectorAll('#player-table tbody tr');
            const letterSet = new Set();
    
            playerRows.forEach(row => {
                const letterElements = row.querySelectorAll('.player-letter');
                letterElements.forEach(letterElement => {
                    const letter = letterElement.textContent.trim();
                    if (letterSet.has(letter)) {
                        row.style.display = 'none';
                    } else {
                        letterSet.add(letter);
                    }
                });
            });
    
            const scoreFinalA = document.getElementById('scoreFinalA');
            const scoreFinalB = document.getElementById('scoreFinalB');
            const resultat = document.getElementById('resultat');
            const victoireInput = document.getElementById('victoire');
    
            window.onload = updateResult;
            window.onload = calculateTotalPoints;
    
            function updateResult() {
                const scoreA = parseInt(scoreFinalA.value) || 0;
                const scoreB = parseInt(scoreFinalB.value) || 0;
                if (scoreA > scoreB) {
                    resultat.textContent = "Victoire de {{ $rencontre->equipeA->nomEquipe }}";
                    victoireInput.value = "A";
                } else if (scoreA < scoreB) {
                    resultat.textContent = "Victoire de {{ $rencontre->equipeB->nomEquipe }}";
                    victoireInput.value = "B";
                } else {
                    resultat.textContent = "Match nul";
                    victoireInput.value = "N";
                }
            }
    
            scoreFinalA.addEventListener('input', updateResult);
            scoreFinalB.addEventListener('input', updateResult);
    
            const mancheInputs = document.querySelectorAll('.manche-input');
    
            mancheInputs.forEach(input => {
                input.addEventListener('input', function() {
                    const matchId = this.dataset.matchId;
    
                    const mancheScores = [];
                    for (let i = 1; i <= 5; i++) {
                        const scoreA = parseInt(document.querySelector(`input[name="M${i}_${matchId}"]`).value) || 0;
                        const scoreB = parseInt(document.querySelector(`input[name="M${i}B_${matchId}"]`).value) || 0;
                        mancheScores.push({ A: scoreA, B: scoreB });
                    }
                    //Score final des manches
                    let winsA = 0;
                    let winsB = 0;
                    mancheScores.forEach(scores => {
                        if (scores.A > scores.B) {
                            winsA++;
                        } else if (scores.B > scores.A) {
                            winsB++;
                        }
                    });
    
                    const pointsInputA = document.querySelector(`input[name="pointsA_${matchId}"]`);
                    const pointsInputB = document.querySelector(`input[name="pointsB_${matchId}"]`);
    
                    if (winsA >= 3) {
                        pointsInputA.value = 1;
                        pointsInputB.value = 0;
                        updateClassement(matchId, 'A');
                    } else if (winsB >= 3) {
                        pointsInputA.value = 0;
                        pointsInputB.value = 1;
                        updateClassement(matchId, 'B');
                    } else {
                        pointsInputA.value = 0;
                        pointsInputB.value = 0;
                    }
    
                    calculateTotalPoints();
                });
            });
    
            function calculateTotalPoints() {
                let totalPointsA = 0;
                let totalPointsB = 0;
    
                const pointsInputs = document.querySelectorAll('.points-input');
                pointsInputs.forEach(input => {
                    const player = input.dataset.player;
                    const points = parseInt(input.value) || 0;
                    if (player === 'A') {
                        totalPointsA += points;
                    } else {
                        totalPointsB += points;
                    }
                });
    
                const pointsADouble = parseInt(document.querySelector('input[name="pointsADouble"]').value) || 0;
                const pointsBDouble = parseInt(document.querySelector('input[name="pointsBDouble"]').value) || 0;
                totalPointsA += pointsADouble;
                totalPointsB += pointsBDouble;
    
                const scoreFinalAInput = document.getElementById('scoreFinalA');
                const scoreFinalBInput = document.getElementById('scoreFinalB');
    
                scoreFinalAInput.value = totalPointsA;
                scoreFinalBInput.value = totalPointsB;
    
                updateResult();
            }
    
            calculateTotalPoints();
    
            const pointsInputs = document.querySelectorAll('.points-input');
            pointsInputs.forEach(input => {
                input.addEventListener('input', calculateTotalPoints);
            });
    
            const mancheInputsDouble = document.querySelectorAll('.manche-input-double');
            mancheInputsDouble.forEach(input => {
                input.addEventListener('input', calculateDoublePoints);
            });
    
            function calculateDoublePoints() {
                let winsA = 0;
                let winsB = 0;
                for (let i = 1; i <= 5; i++) {
                    const scoreA = parseInt(document.querySelector(`input[name="D${i}"]`).value) || 0;
                    const scoreB = parseInt(document.querySelector(`input[name="D${i}B"]`).value) || 0;
                    if (scoreA > scoreB) {
                        winsA++;
                    } else if (scoreB > scoreA) {
                        winsB++;
                    }
                }
    
                const pointsInputADouble = document.querySelector('input[name="pointsADouble"]');
                const pointsInputBDouble = document.querySelector('input[name="pointsBDouble"]');
    
                if (winsA >= 3) {
                    pointsInputADouble.value = 1;
                    pointsInputBDouble.value = 0;
                } else if (winsB >= 3) {
                    pointsInputADouble.value = 0;
                    pointsInputBDouble.value = 1;
                } else {
                    pointsInputADouble.value = 0;
                    pointsInputBDouble.value = 0;
                }
    
                calculateTotalPoints();
            }
    
            
        });
        function confirmEnregistrement() {
                return confirm("Êtes-vous sûr de vouloir enregistrer les modifications ?");
            }
    </script>
@endsection