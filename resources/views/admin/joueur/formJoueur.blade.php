@extends('layout.admin.admin')
@section('title', 'Gestion des joueurs - Tennis de table 17')

@section('content')
<h2>Nouveau joueur</h2>
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

<form action="{{route('admin.createJoueur')}}" method="POST">
    @csrf
    @METHOD('POST')
    
    <label for="idPersonne">Adhérent</label>
    <select class="form-control" name="idPersonne" required>
       @if(isset($nouveau))
            <option value="{{$nouveau->idPersonne}}">{{$nouveau->nom}} {{$nouveau->prenom}}</option>
       @else
            <option value="">Choisissez un adhérent</option>
            @foreach($personnes as $p)
                <option value="{{$p->idPersonne}}">{{$p->nom}} {{$p->prenom}}</option>
            @endforeach
        @endif
    </select>
    <label for="visible"></label><b>Visible</b></label>
    <select class="form-control" name="visible" required>
        <option value="">Choisir une option</option>
        <option value="1">Oui</option>
        <option value="0">Non</option>
    </select>

    <br>
    <h3>Classement</h3>
    <hr>
    <label for="classement"><b>Classement Ufolep</b></label>
    <input type="number" class="form-control" value="500" name="classement" min="500" required>

    <label for="classement_fftt"><b>Classement FFTT</b></label>
    <input type="number" class="form-control" value="0" name="classement_fftt" required>

    <br>
    <h3>Licence</h3>
    <hr>
    <label for="licenceJoueur"><b>Licence</b></label><span style="color: red;">*</span>
    <input type="text" class="form-control" name="licenceJoueur" maxlength="32" value="017_" required>

    <br>
    <h3>Équipe</h3>
    <hr>
    <label for="idEquipe"><b>Choix de l'équipe</b></label><span style="color: red;">*</span>
        <select class='form-control' name="idEquipe" id="idEquipe" required onchange="onChangeEquipe()">
            <option value="">Choisissez une équipe</option>
            @foreach($equipes as $e)
                <option value="{{$e->idEquipe}}">{{$e->nomEquipe}}</option>
            @endforeach
        </select>

    <label for="idClub">Club Correspondant</label>
    <br>
    <input class="form-control" type="text" name="nomClub" id="nomClub" readonly>
    <input type="hidden" name="idClub" id="idClub">

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
</script>

@endsection