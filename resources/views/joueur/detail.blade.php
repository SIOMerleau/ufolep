@extends('layout.guest.default')
@section('title', 'Détail Joueur - Tennis de table 17')

@section('content')

<h2>
    {!! $joueur->personne->sexe === "M" ? '<b style="color: #1811d9;">H</b>' : '<b style="color: #c918d9;">F</b>' !!}
    {{$joueur->personne->nom}} {{$joueur->personne->prenom}}
</h2>
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

@if(Auth::check() && Auth::user()->typeCompte === 'GÉRANT')

@php /* Vue pour les gérants */ @endphp

<form action="{{route('joueur.update' , ['id' => $joueur->idJoueur])}}" METHOD="POST">
    @csrf
    @METHOD('PUT')
    <h3>Changer les informations personnelles</h3>
    <hr>
    <div>
        <label for="visible"></label><b>Visibilité</b></label>
        <select name="visible" required>
            <option value="">Choisir une option</option>
            <option value="2" {{$joueur->visible == 2 ? 'selected' : ''}}>Pour tout le monde</option>
            <option value="1" {{$joueur->visible == 1 ? 'selected' : ''}}>Seulement gérant</option>
            <option value="0" {{$joueur->visible == 0 ? 'selected' : ''}}>Pour personne</option>
        </select>
    </div>
    <br>
    <h3>Changer le classement</h3>
    <hr>
    <div>
        <label for="classement">Modification du classement UFOLEP</label>
        <input type="number" value="{{$joueur->classement}}" name="classement" min="500" required>
    </div>
    <div>
        <label for="classement_fftt">Modification du classement FFTT</label>
        <input type="number" value="{{$joueur->classement_fftt}}" name="classement_fftt" required>
    </div>

    <br>
    <h3>Changement de la licence</h3>
    <hr>
    <div>
        <label for="licenceJoueur">Modification de la licence</label>
        <input type="text" value="{{$joueur->licenceJoueur}}" name="licenceJoueur" maxlength="32" required>
    </div>

    <br>
    <h3>Changer d'équipe</h3>
    <hr>
    <div>
        <label for="idEquipe">Choix de l'équipe</label>
        <select class='form-control' name="idEquipe" id="idEquipe" required onchange="onChangeEquipe()">
            @foreach($equipes as $e)
            <option value="{{$e->idEquipe}}" {{$e->idEquipe == $joueur->idEquipe ? 'selected' : ''}}>{{$e->nomEquipe}}</option>
            @endforeach
        </select>
    </div>
    <br>
    <div>
        <label>Club Correspondant</label>
        <br>

        <input class="form-control" type="text" name="nomClub" id="nomClub" readonly>
        <input type="hidden" name="idClub" id="idClub">
    </div>
    <br>
    <input type="submit" value="Enregistrer" class="primarybuttonBlue" >
</form>

<script>
    //Script repris de l'ancienne version du site
    function onChangeEquipe() {
        // Récupérez l'élément <select> par son nom
        var selectEquipe = document.querySelector('select[name="idEquipe"]');

        // Récupérez la valeur de l'option sélectionnée
        var selectedId = selectEquipe.value;

        // Récupérez les données du tableau PHP pour les équipes et les clubs
        var equipes = <?php echo json_encode($equipes); ?>;
        var clubs = <?php echo json_encode($clubs); ?>;

        // Parcourez le tableau des équipes pour trouver la correspondance avec l'ID sélectionné
        for (var equipe of equipes) {
            if (equipe.idEquipe == selectedId) {
                // Trouvez le club correspondant dans le tableau des clubs
                var clubCorrespondant = clubs.find(function (club) {
                    return club.idClub == equipe.idClub;
                });

                // Mettez à jour le champ de texte avec le nom du club associé
                document.getElementById("nomClub").value = clubCorrespondant.nomClub;

                // Mettez à jour la valeur de l'input caché pour l'ID du club
                document.getElementById("idClub").value = clubCorrespondant.idClub;
                break; // Sortez de la boucle une fois que la correspondance est trouvée
            }
        }
    }

    // Appeler la fonction au chargement de la page
    window.onload = function () {
        onChangeEquipe();

        // Sélectionnez le club du joueur dès le départ
        var selectedClubId = <?php echo json_encode($joueur->idClub); ?>;
        document.getElementById("idClub").value = selectedClubId;
    };
</script>

@else

@php /* Vue pour les utilisateurs/arbitre */ @endphp
<div>
    <b>Club :</b>
    <label>{{$joueur->club->nomClub ? $joueur->club->nomClub : ''}}</label>
    <b>Équipe :</b>
    <label>{{$joueur->equipe->nomEquipe ? $joueur->equipe->nomEquipe : 'Aucune équipe'}}</label>
</div>
<div>
    <b>Date de naissance :</b>
    <label for="date_naissance">{{$joueur->personne->date_naissance ? $joueur->personne->date_naissance : 'Aucune date de naissance'}}</label>
</div>
<div>
    <b>Email :</b>
    <label for="mail">{{$joueur->mail ? $joueur->mail : 'Aucun mail'}}</label>
</div>
<div>
    <b>Adresse :</b>
    <label for="adresse">{{$joueur->adresse ? $joueur->adresse : 'Aucune adresse'}}</label>
</div>
<div>
    <b>Licence :</b>
    <label for="licenceJoueur">{{$joueur->licenceJoueur ? $joueur->licenceJoueur : 'Aucune licenceJoueur'}}</label>
</div>
<div>
    <b>Classement UFOLEP (points) :</b>
    <label for="classement">{{$joueur->classement ? $joueur->classement : 'Non classé'}}</label>
</div>
<div>
    <b>Classement FFTT (points) :</b>
    <label for="classement_fftt">{{$joueur->classement_fftt ? $joueur->classement_fftt : 'Non classé'}}</label>
</div>
<hr>
<a class="button primarybuttonBlue"
    href="{{route('joueur.liste')}}">Retour</a>

@endif

@endsection