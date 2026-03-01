@extends('layout.guest.default')

@section('title', 'Aide - Tennis de table 17')

@section('content')


<h2>Aide Disponible</h2>
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

<table class="data-table left-align-table">
    <thead class="thead-titre">
        <tr>
            <th class="blue text-center">Titre</th>
            <th class="blue text-center">Lien</th>
        </tr>
    </thead>
    <tbody>
    @if($aides->isEmpty())
        <tr>
            <td>Aucune aide disponible</td>
            <td>N/A</td>
        </tr>
    @else
        @foreach($aides as $a)
        <tr>
            <td>
                @auth
                    @if(Auth::user()->typeCompte === "GÉRANT")
                        <a href="{{ route('aide.modif', ['id' => $a->id]) }}" title="Cliquez pour modifier">{{$a->titre_aide}}</a>
                    @endif
                @endauth
                @guest
                    {{$a->titre_aide}}
                @endguest
            </td>
            <td>
                <a href="{{$a->lien}}" target="_blank">{{$a->lien}}</a>
            </td>
        </tr>
        @endforeach
    @endif
    </tbody>
</table>
<br>
@auth
    @if(Auth::user()->typeCompte === "GÉRANT")
        <a class="button primarybuttonBlue" href="{{route('aide.ajout')}}">Ajouter une aide</a>
    @endif
@endauth
@endsection