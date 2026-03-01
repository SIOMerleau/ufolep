@extends('layout.admin.admin')
@section('title', 'Liste des utilisateurs - Tennis de table 17')
@section('content')

<h2>Gestion des utilisateurs</h2>
<h6>Vous pouvez gérer les utilisateurs (Arbitres/Gérants) de l'application SANA depuis cette interface.</h6>
<hr>

<div>
    <a class="button primarybuttonBlue" href="{{route('admin.formUser')}}">
    <i class="fas fa-plus fa-sm"></i>&nbsp Nouvel utilisateur </a>
</div>
<div>
    <input type="text" class="form-control" id="searchInput" onkeyup="searchUser()" placeholder="Rechercher un utilisateur par prénom ou nom">
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <table class="data-table left sober">
        <thead>
            <tr>
                <th>Nom d'utilisateur</th>
                <th>Type</th>
                <th>Propriétaire</th>
                <th>E-mail</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $u)
            @php
            //Surligner la case de notre compte
            $isMyAccount = $u->idCompte === Auth::user()->idCompte;
            @endphp
                <tr <?= $isMyAccount ? "class=\"highlighted\"" : "" ?>>
                    <td>{{$u->identifiant}}</td>
                    <td>{!! $u->typeCompte === "GÉRANT" ? "<b class='label-gerant'>Gérant</b>" 
                                                        : "<b class='label-arbitre'>Arbitre</b>" !!}
                    </td>
                    <td>
                        @if($u->personne)
                            {{$u->personne->nom}} {{$u->personne->prenom}}
                            </td>
                            <td>{{$u->personne->mail ? $u->personne->mail : 'Aucune'}}</td>
                        @else
                            Aucune personne n'est liée à ce compte
                            </td>
                            <td>Aucun mail</td>
                        @endif
                    <td class="row">
                        <a class="button primarybuttonBlue col-lg text-center" href="{{route('admin.modifUser', ['id' => $u->idCompte])}}">Gérer</a>
                        <a class="button dangerbutton col-lg text-center" <?= $isMyAccount ? "style='display: none;'" : "" ?>
                            href="{{route('admin.deleteUser', ['id' => $u->idCompte])}}">Supprimer</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

<script>
    //Script pour la recherche dans le tableau des utilisateurs
    function searchUser() {
    var input, filter, table, tr, td, i, txtValue;
    // Récupérer la valeur de l'input
    input = document.getElementById("searchInput");
    // Mettre la valeur dans le filtre
    filter = input.value.toUpperCase();
    // Récupérer le tableau
    table = document.querySelector(".data-table tbody");
    tr = table.getElementsByTagName("tr");

    //Parcourir le tableau entier
    for (i = 0; i < tr.length; i++) {
        // Récupérer les cellules
        td = tr[i].getElementsByTagName("td");
        if (td.length > 0) {
            let found = false;
            // Parcourir les cellules
            for (let j = 0; j < td.length; j++) {
                if (td[j]) {
                    // Récupérer le texte de la cellule
                    txtValue = td[j].textContent || td[j].innerText;
                    // Si le texte contient le filtre, on affiche la ligne
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
            }
            // Si on a pas trouvé, on cache la ligne
            tr[i].style.display = found ? "" : "none";
        }
    }
}
</script>


@endsection