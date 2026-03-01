@extends('layout.admin.admin')
@section('title', 'Mon Profil - Tennis de Table 17')
@section('content')

<h2>Mon Compte</h2>
<h6>Vous êtes en train de paramétrer votre compte.</h6>
<hr>

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

@if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif

@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif

<table class="form-table">
    <form action="{{route('admin.updateMonCompte', ['id' => $user->idCompte])}}" method="POST">
        @csrf
        @METHOD('POST')
        <tr>
            <td>
                <label for="identifiant">Nom d'utilisateur</label>
            </td>
            <td>
                <input type="text" class="form-control" value="{{$user->identifiant}}" required readonly>
            </td>
        </tr>
        <tr>
            <td>
                <label for="password">Modification du mot de passe</label><span style="color: red;">*</span>
                <aside>8 caractères, 1 Majusucle, 1 minuscules et 1 chiffre minimum !</aside>
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
                <br>
                <a class="button primarybuttonWhite" href="{{route('admin.listeUser')}}">Retour</a>
                <input id="submitButton" class="primarybuttonBlue" type="submit" value="Créer">
            </td>
        </tr>
    </form>
</table>


@endsection