@extends('layout.guest.default')
@section('title', 'Connexion - Tennis de table 17')

@section('content')
<section class="row d-flex justify-content-center mx-0">
    <div class="form-container col-lg-4 col-md-7 col-sm-9">

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

        <form class="form-horizontal" method="post" action="{{route('auth.login')}}">
            @csrf
            @METHOD('POST')

            <fieldset>

                <!-- Form Name -->
                <h2>Connectez-vous !</h2>
                <!-- Text input-->
                <br>
                <div class="form-group">
                    <label class="control-label" for="textinput">Identifiant</label>
                    <div>
                        <input id="user" name="user" class="form-control input-md" type="text"
                                autofocus required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="textinput">Mot de passe</label>
                    <div>
                        <input id="password" name="passwd" placeholder="••••••••" class="form-control input-md"
                               type="password"  required>
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <label class="control-label" for="singlebutton"></label>
                    <div>
                        <button type="submit" id="singlebutton" name="singlebutton" class="primarybuttonBlue">Connexion</button>
                    </div>
                </div>

            </fieldset>
        </form>

    </div>
</section>
@endsection
