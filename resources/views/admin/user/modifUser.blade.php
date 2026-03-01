@extends('layout.admin.admin')
@section('title', 'Modification d\'un utilisateur - Tennis de table 17')
@section('content')

<h2>Modification d'un utilisateur</h2>
<h6>Vous ne pouvez que changez le mot de passe et le rôle.</h6>
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
    <form action="{{route('admin.updateUser', ['id' => $user->idCompte])}}" method="POST">
        @csrf
        @METHOD('PUT')
        <tr>
            <td>
                <label for="idPersonne">Choississez le propriétaire du compte</label>
                <select name="idPersonne" id="idPersonne" class="form-control" required readonly>
                    <option value="{{$user->personne->idPersonne}}">{{$user->personne->nom}} {{$user->personne->prenom}}</option>
                </select>
            </td>
            <td>
                <label for="identifiant">Identifiant</label>
                <input type="text" class="form-control" id="identifiant" name="identifiant" value="{{$user->identifiant}}" readonly required>
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
                    <option value="GÉRANT" {{ $user->typeCompte === "GÉRANT" ? 'selected' : '' }}>Gérant</option>
                    <option value="ARBITRE" {{ $user->typeCompte === "ARBITRE" ? 'selected' : '' }}>Arbitre</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
            <a class="button primarybuttonWhite" href="{{route('admin.listeUser')}}">Retour</a>
            <input id="submitButton" class="primarybuttonBlue" type="submit" value="Modifier">
            </td>
        </tr>
    </form>
</table>


@endsection