@extends('layout.admin.admin')
@section('title', 'Suppression d\'un utilisateur - Tennis de table 17')
@section('content')

<h2>Suppression d'un utilisateur</h2>
<hr>

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<h6>Vous souhaitez supprimer un compte d'un utilisateur. Cette action est <b>irréversible</b>.</h6>

<p>Ce compte est lié à <b>{{$user->personne->prenom}} {{$user->personne->nom}}</b>.</p>
@if($user->personne === 'M')
    <p>Si vous souhaitez supprimer cet utilisateur, la personne ne sera plus lié à ce compte !</p>
    <p>Si vous souhaitez supprimer le compte et la personne vous pouvez le faire directement dans Gestion des Personnes</p>
@else
    <p>Si vous souhaitez supprimer cette utilisatrice, la personne ne sera plus liée à ce compte !</p>
    <p>Si vous souhaitez supprimer le compte et la personne vous pouvez le faire directement dans Gestion des Personnes</p>
@endif
<br>
<br>

<form action="{{route('admin.deleteUser', ['id' => $user->idCompte])}}" method="POST">
    @csrf
    @METHOD('DELETE')
    <button class="button dangerbutton" type="submit">Supprimer</button>
</form>

<script>
    //Script pour confirmer la suppression d'un utilisateur
    document.querySelector('form').addEventListener('submit', function(event) {
        if (!confirm('Êtes-vous sûr de vouloir supprimer cet.te utilisateur.rice ? Cette action est irréversible.')) {
            event.preventDefault();
        }
    });
</script>

@endsection