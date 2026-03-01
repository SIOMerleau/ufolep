@extends('layout.admin.admin')
@section('title', 'Gestion des personnes - Tennis de table 17')


@section('content')
@auth
<h2>Liste des personnes</h2>
<h6>Vous pouvez gérer les adhérents en tant que joueur et/ou Arbitre/Gérant.</h6>
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
    <a href="{{route('admin.formPersonne')}}" class="button primarybuttonBlue"><i class="fas fa-plus fa-sm"></i>&nbsp Nouvel adhérent</a>
</div>
<div>
    <input type="text" class="form-control" id="searchInput" onkeyup="searchPersonne()" placeholder="Rechercher une personne par prénom ou nom">
</div>
<br>

<div class="data-table">
    @foreach($personnes as $p)
    @php $isMyAccount = $p->idPersonne == Auth::user()->idPersonne; @endphp
    <div class="<?= $isMyAccount ? "highlighted" : "" ?> person-container col-lg-9 col-md-12 col-12 mx-0 row">
        <div class="col">
            <div class="row">
                <div class="col-lg-9 col-md-8 col-6">
                    <div class="row">
                        <div class="col px-0">
                            <span><b>{{$p->nom}} {{$p->prenom}}</b>
                                {!! $p->age > 0 ? "<span style='opacity: 0.5'> • " . $p->age . " ans</span>" : "" !!}
                            </span>
                            <i class="fas fa-<?= $p["sexe"] === "M" ? "mars" : "venus" ?>"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row p-1"><span class="data-indicator">E-mail</span><span>{{$p->mail ? $p->mail : "aucune"}}</span></div>
                            <div class="row p-1"><span class="data-indicator">Adresse</span><span>{{$p->adresse ? $p->adresse : "aucune"}}</span></div>
                        </div>
                    </div>
                </div>
                <div class="button-container col-lg-3 col-md-4 col-6">
                    <div class="row">
                        <div class="col">
                            <a href="{{route('admin.modifPersonne', ['id'=> $p->idPersonne])}}" class="button primarybuttonBlue col-lg text-center">Gérer</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <a class="button dangerbutton col-lg text-center" <?= $isMyAccount ? "style='display: none;'" : "" ?>
                            href="{{route('admin.deletePersonne', ['id' => $p->idPersonne])}}">Supprimer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<script>
    //Script pour la recherche de personne dans la liste
    function searchPersonne() {
    var input, filter, dataTable, personContainers, span, i, txtValue;
    //Récupérer la valeur dans l'input
    input = document.getElementById('searchInput');
    // Mettre la valeur dans le filtre
    filter = input.value.toLowerCase();
    // Récupérer le tableau
    dataTable = document.getElementsByClassName('data-table')[0];
    personContainers = dataTable.getElementsByClassName('person-container');
    // Parcourir les personnes et cacher celles qui ne correspondent pas à la recherche
    for (i = 0; i < personContainers.length; i++) {
        span = personContainers[i].getElementsByTagName('span')[0];
        txtValue = span.textContent || span.innerText;
        // Si le texte contient le filtre, on affiche la ligne
        if (txtValue.toLowerCase().indexOf(filter) > -1) {
            personContainers[i].style.display = "";
        } else {
            // Sinon, on cache la ligne
            personContainers[i].style.display = "none";
        }
    }
}
</script>


@endauth
@endsection