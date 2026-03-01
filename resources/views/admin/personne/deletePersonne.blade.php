@extends('layout.admin.admin')
@section('title', 'Suppression d\'une personne - Tennis de table 17')
@section('content')

<h2>Suppression d'une personne</h2>
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


<h3>{{$personne->nom}} {{$personne->prenom}}</h3>

<h4>Liaison</h4>
<hr>

@if($personne->user !== null)
	<p>Cette personne est lié à un compte utilisateur -> {{$personne->user->identifiant}}, de type {{$personne->user->typeCompte}}.</p>
@else
	<p>Cette personne n'est lié avec aucun compte utilisateur !</p>
@endif

@if($personne->joueur !== null)
    <p>Cette personne est lié à un joueur -> du club {{$personne->joueur->club->nomClub}}.</p>
@else
    <p>Cette personne n'est lié avec aucun joueur !</p>
@endif

<br>

<h4>Suppression</h4>
<h6>Quand vous supprimez une personne, vous supprimez aussi son compte utilisateur et le joueur qui appartient à cette personne.</h6>
<hr>

<p>Suppresion de la <b>personne</b>
@if($personne->user !==null || $personne->joueur !==null)
    , du <b>joueur</b> et du <b>compte utilisateur</b> si associée.</p>
@else
    </p>
@endif

<form action="{{ route('admin.deletePersonne', ['id' => $personne->idPersonne]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="button dangerbutton">Suppression</button>
    <aside>Attention cette action est irréverssible !</aside>
</form>

<script>
    //Script pour confirmer la suppression
    document.querySelector('.button').addEventListener('click', function(e){
        if(!confirm('Voulez-vous vraiment supprimer cette personne ?')){
            e.preventDefault();
        }
    });
</script>

@endsection