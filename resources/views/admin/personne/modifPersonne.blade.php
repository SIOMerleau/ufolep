@extends('layout.admin.admin')
@section('title', 'Modifier une personne - Tennis de table 17')
@section('content')

<h2>Modification d'une personne</h2>
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


<table class="form-table">
    <form action="{{route('admin.updatePersonne',['id' => $personne->idPersonne])}}" method="POST">
        @csrf
        @METHOD('PUT')
        <tr>
            <td>
                <label for="prenom">Prénom</label><span style="color: red;">*</span>
            </td>
            <td>
                <input type="text" class="form-control" id="prenom" name="prenom" maxlength="64" value="{{$personne->prenom}}" required>
            </td>
        </tr>
        <tr>
            <td>
                <label for="nom">Nom</label><span style="color: red;">*</span>
                <aside>Pour les noms composés, veuillez insérer un - entre les noms.</aside>
            </td>
            <td>
                <input type="text" class="form-control" id="nom" name="nom" maxlength="64" value="{{$personne->nom}}" required>
            </td>
        </tr>
        <tr>
            <td>
                <label for="date_naissance">Date de naissance</label>
                <aside>(facultatif)</aside>
            </td>
            <td>
                <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="{{$personne->date_naissance ? $personne->date_naissance : ''}}">
            </td>
        </tr>
        <tr>
            <td>
                <label for="age">Age</label>
                <aside>(facultatif)</aside>
            </td>
            <td>
                <input type="number" class="form-control" id="age" name="age" min="0" max="100" value="{{$personne->age ? $personne->age : ''}}">
            </td>
        </tr>
        <tr>
            <td>
                <label for="sexe">Genre</label><span style="color: red;">*</span>
            </td>
            <td>
                    <input class="form-check-input" type="radio" name="sexe" id="sexe_homme" value="M" {{ $personne->sexe == 'M' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="sexe_homme">
                        Homme
                    </label>
                    <input class="form-check-input" type="radio" name="sexe" id="sexe_femme" value="F" {{$personne->sexe == 'F' ? 'checked' : ''}} required>
                    <label class="form-check-label" for="sexe_femme">
                        Femme
                    </label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="adresse">Adresse</label>
                <aside>(facultatif)</aside>
            </td>
            <td>
                <input type="text" class="form-control" id="adresse" name="adresse" maxlength="255"
                placeholder="ex : 123, Av. de la République 12345 Saint-Jean" value="{{$personne->adresse ? $personne->adresse : ''}}">
            </td>
        </tr>
        <tr>
            <td>
                <label for="mail">E-Mail</label>
                <aside>(facultatif)</aside>
            </td>
            <td>
                <input type="email" class="form-control" id="mail" name="mail" maxlength="255" value="{{$personne->mail ? $personne->mail : ''}}">
            </td>
        </tr>
        <tr>
            <td>
            <a class="button primarybuttonWhite"
                   href="{{route('admin.listePersonne')}}">Retour</a>
                <input id="submitButton" class="primarybuttonBlue" type="submit" value="Enregistrer">
            </td>
        </tr>

    </form>
</table>

<script>
    //Script pour calculer l'age en fonction de date_naissance et d'insérer l'âge dans l'input age
    document.getElementById('date_naissance').addEventListener('change', function() {
        var birthDate = new Date(this.value);
        var age = calculateAge(birthDate);
        document.getElementById('age').value = age;
    });

    //Script pour calculer l'age en fonction de date_naissance
    function calculateAge(birthDate) {
        var today = new Date();
        var age = today.getFullYear() - birthDate.getFullYear();
        var monthDifference = today.getMonth() - birthDate.getMonth();
        if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return age;
    }
</script>

@endsection