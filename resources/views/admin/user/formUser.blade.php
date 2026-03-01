@extends('layout.admin.admin')
@section('title', 'Création d\'un utilisateur - Tennis de table 17')
@section('content')

<h2>Création d'une personne</h2>
<hr>

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    @if ($error == 'validation.confirmed')
                        <li>La confirmation du mot de passe ne correspond pas.</li>
                    @else
                        <li>{{ $error }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
@endif

<table class="form-table">
    <form action="{{route('admin.createUser')}}" method="POST">
        @csrf
        @METHOD('POST')
        <tr>
            <td>
                <label for="idPersonne">Choississez le propriétaire du compte</label><span style="color: red;">*</span>
                <select name="idPersonne" id="idPersonne" class="form-control" required>
                    <option value="">Choissisez une personne</option>
                    @foreach($personnes as $p)
                        <option value="{{ $p->idPersonne }}" data-nom="{{ $p->nom }}" data-prenom="{{ $p->prenom }}">{{ $p->nom }} {{ $p->prenom }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <label for="identifiant">Identifiant</label><span style="color: red;">*</span>
                <input type="text" class="form-control" id="identifiant" name="identifiant" readonly required>
            </td>
        </tr>
        <tr>
            <td>
                <label for="password">Mot de passe</label><span style="color: red;">*</span>
                <aside>Doit contenir minimum 8 caractères : 1 majuscule, 1 minusucle, 1 chiffre</aside>
            </td>
            <td>
                <input type="password" class="form-control" id="password" name="password" placeholder="••••••" required>
            </td>
        </tr>
        <tr>
            <td>
                <label for="password_confirmation">Confirmation du mot de passe</label><span style="color: red;">*</span>
            </td>
            <td>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="••••••" required>
            </td>
        </tr>
        <tr>
            <td>
                <label for="typeCompte">Rôle</label><span style="color: red;">*</span>
            </td>
            <td>
                <select name="typeCompte" id="typeCompte" class="form-control" required>
                    <option value="">Choissisez un rôle</option>
                    <option value="GÉRANT">Gérant</option>
                    <option value="ARBITRE">Arbitre</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
            <a class="button primarybuttonWhite" href="{{route('admin.listeUser')}}">Retour</a>
            <input id="submitButton" class="primarybuttonBlue" type="submit" value="Créer">
            </td>
        </tr>
    </form>
</table>

<script>
    //Script pour créer l'identifiant à partir du nom et prénom de la personne
    document.getElementById('idPersonne').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        //Récupération du nom et prénom de la personne
        var nom = selectedOption.getAttribute('data-nom').toLowerCase();
        var prenom = selectedOption.getAttribute('data-prenom').toLowerCase();
        //Création de l'identifiant
        var identifiant = nom + prenom.charAt(0);
        //Insertion de l'identifiant dans l'input
        document.getElementById('identifiant').value = identifiant;
    });
</script>

@endsection