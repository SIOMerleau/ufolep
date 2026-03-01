@extends('layout.guest.default')

@section('title', 'Modifier Aide - Tennis de table 17')

@section('content')

@auth
    <h1>Modifier l'aide</h1>
    <hr>
    <h3>{{$aide->titre_aide}}</h3>
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


    <form action="{{route('aide.modif', ['id' => $aide->id])}}" method="post">
        @csrf
        @METHOD('POST')
        <div>
            <b>Modification du titre d'aide:</b>
            <label for="titre_aide">
                <input type="text" value="{{$aide->titre_aide}}" name="titre_aide" id="titre_aide" required>
            </label>
        </div>
        <div>
            <b>Modification du lien:</b>
            <label for="lien">
                <input type="text" value="{{$aide->lien}}" name="lien" id="lien" required>
            </label>
        </div>
        <br>
        <a href="{{route('aide.liste')}}" class="buton primarybuttonWhite">Annuler</a>
        <input type="submit" value="Enregistrer" class="primarybuttonBlue" name="submit">
    </form>

    <br>

    <form method="POST" action="{{route('aide.destroy', ['id' => $aide->id])}}">
        @csrf
        @METHOD('DELETE')
        <input type="submit" value="Supprimer" class="primarybuttonRed" name="submit">
    </form>


    <script>
        // Confirmation de l'envoie du formulaire de suppression d'aide
        document.querySelector('form[action="{{route('aide.destroy', ['id' => $aide->id])}}"]').addEventListener('submit', function(event) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer cette aide ?')) {
                event.preventDefault();
            }
        });
    </script>

@endauth

@endsection