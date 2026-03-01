@extends('layout.guest.default')
@section('title', 'Championnat - Tennis de table 17')
@section('content')

<!DOCTYPE html>
<html>
<head>
  <title>Créer un Championnat</title>
</head>
<body>
  <h1>Créer un Championnat</h1>

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


  <form action="{{ route('championnat.store') }}" method="POST">
    @csrf

    <label for="nomChampionnat">Nom du Championnat:</label>
    <input type="number" name="nomChampionnat" id="nomChampionnat" value="{{$anneeActuelle}}" required>
    <br><br>

    <label for="typeChampionnat">Type de Championnat:</label>
    <select name="typeChampionnat" id="typeChampionnat">
      <option value="Départemental" {{ old('typeChampionnat') == 'Départemental' ? 'selected' : '' }}>Départemental</option>
      <option value="Régional" {{ old('typeChampionnat') == 'Régional' ? 'selected' : '' }}>Régional</option>
      <option value="National" {{ old('typeChampionnat') == 'National' ? 'selected' : '' }}>National</option>
    </select>
    <br><br>

    <label for="idDivision">Division:</label>
    <select name="idDivision">
      <option value="">Sélectionner une division</option>
      @foreach($divisions as $division)
        <option value="{{ $division->idDivision }}"
          @if(isset($championnat) && $championnat->idDivision == $division->idDivision) selected @endif>
          {{ $division->nomDivision }}
        </option>
      @endforeach
    </select>
    <br><br>

    <label for="nomPoule">Nom de la Poule (Optionnel):</label>
    <input type="text" name="nomPoule" id="nomPoule" value="{{ old('nomPoule') }}">
    <br><br>

    <label for="nombre_journees">Nombre de Journées:</label>
    <input type="number" name="nombre_journees" id="nombre_journees" min="1" value="14" required>
    <br><br>

    <button type="submit">Créer</button>
  </form>
  <br><br>

  <div id="teamsContainer"></div>
  <br>
  <a href="{{ route('championnats.listeActuelle') }}">Retour</a>
</body>

<script>
  //Script pour afficher le nombre et les noms des équipes concernés
  document.addEventListener('DOMContentLoaded', function () {
    //Récupération des éléments du DOM
    const divisionSelect = document.querySelector('select[name="idDivision"]');
    const teamsContainer = document.getElementById('teamsContainer');
    //Récupération des équipes envoyés depuis le controller
    const allTeams = @json($equipes);

    //Affichage des équipes en fonction de la division sélectionnée
    divisionSelect.addEventListener('change', function () {
      const divisionId = this.value;
      teamsContainer.innerHTML = '';
      //Si une division est sélectionnée
      if (divisionId) {
        const teams = allTeams.filter(team => team.idDivision == divisionId);
        //Ajout de la ligne
        const h4 = document.createElement('h4');
        h4.textContent = 'Vous vous appretez à créer un championnat pour ' + teams.length + ' équipes.';
        teamsContainer.prepend(h4);
        //Si des équipes sont trouvées pour cette division
        if (teams.length > 0) {
          //Création de la liste des équipes
          const ul = document.createElement('ul');
          teams.forEach(team => {
            const li = document.createElement('li');
            li.textContent = team.nomEquipe;
            ul.appendChild(li);            
          });
          teamsContainer.appendChild(ul);
        } else {
          teamsContainer.textContent = 'Aucune équipe trouvée pour cette division.';
        }
      }
    });
  });
</script>
</html>

@endsection