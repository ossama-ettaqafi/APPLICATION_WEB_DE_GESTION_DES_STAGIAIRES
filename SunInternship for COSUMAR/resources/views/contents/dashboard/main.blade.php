<h1>Statistiques</h1>
<div class="allstats-container">
  <div class="card">
    <div class="title">Stagiaires</div>
    <div class="stats-container">
      <i class="fas fa-users icon"></i>
      <span class="stats interns">{{ $internCount > 0 ? $internCount : 0 }}</span>
    </div>
  </div>

  <div class="card">
    <div class="title">Secteurs</div>
    <div class="stats-container">
      <i class="fas fa-building icon"></i>
      <span class="stats sectors">{{ $sectorsCount > 0 ? $sectorsCount : 0 }}</span>
    </div>
  </div>

  <div class="card">
    <div class="title">Stagiaires proches de la fin</div>
    <div class="stats-container">
      <i class="fas fa-graduation-cap icon"></i>
      <span class="stats near-completion">{{ $nearCompletionCount > 0 ? $nearCompletionCount : 0 }}</span>
    </div>
  </div>
</div>


<h1>Stagiaires</h1>
<div class="interns-container">
@if($interns->isNotEmpty())
  @foreach ($interns as $intern)
  <div class="intern-card" onclick="showInternDetails({{ $intern->id }})">
    <div class="image-container">
      <img
        class="intern-image-card"
        src="{{ asset($intern->image) }}"
        alt="Image du stagiaire"
      />
    </div>
    <div class="details">
      <h3 class="name">
      @php
        $fullName = $intern->firstName . ' ' . $intern->lastName;
        $shortName = strlen($fullName) > 8 ? substr($fullName, 0, 8) . '.' : $fullName;
        echo $shortName;
      @endphp
      </h3>
      <p class="sector">
        @php
          $sector = $intern->sector;
          $shortSec = strlen($sector) > 10 ? substr($sector, 0, 10) . '.' : $sector;
          echo $shortSec;
        @endphp
      </p>
      <span>{{ $intern->id }}</span>
    </div>
  </div>

  <div id="overlay-container-{{ $intern->id }}" class="overlay-container">
    <div class="overlay-card-info">
      <div class="overlay-card">
        <div class="close-button" onclick="hideInternDetails({{ $intern->id }})">×</div>
        <div class="image-container">
          <img class="overlay-image" src="{{ $intern->image }}" alt="Image du stagiaire" />
        </div>
        <div class="details">
          <h3 class="overlay-name">{{ $intern->firstName }} {{ $intern->lastName }}</h3>
          <p class="overlay-sector">{{ $intern->sector }}</p>

          <ul class="overlay-info">
            <li>
              <strong>ID :</strong>
              <span class="overlay-id">{{ $intern->id }}</span>
            </li>
            <li>
              <strong>Prénom :</strong>
              <span class="overlay-firstname">{{ $intern->firstName }}</span>
            </li>
            <li>
              <strong>Nom :</strong>
              <span class="overlay-lastname">{{ $intern->lastName }}</span>
            </li>
            <li>
              <strong>Âge :</strong>
              <span class="overlay-age">{{ $intern->age }}</span>
            </li>
            <li>
              <strong>CIN :</strong>
              <span class="overlay-cin">{{ $intern->cin }}</span>
            </li>
            <li>
              <strong>Téléphone :</strong>
              <span class="overlay-phone">{{ $intern->phone }}</span>
            </li>
            <li>
              <strong>Adresse :</strong>
              <span class="overlay-address">{{ $intern->address }}</span>
            </li>
            <li>
              <strong>École :</strong>
              <span class="overlay-school">{{ $intern->school }}</span>
            </li>
            <li>
              <strong>Secteur :</strong>
              <span class="overlay-sector">{{ $intern->sector }}</span>
            </li>
            <li>
              <strong>Date de début :</strong>
              <span class="overlay-startdate">{{ $intern->startDate }}</span>
            </li>
            <li>
              <strong>Date de fin :</strong>
              <span class="overlay-enddate">{{ $intern->endDate }}</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  @endforeach
@else
<p class="text-explanation">Aucun stagiaire !</p>
@endif
</div>

<h1>Détails des stagiaires</h1>

<div class="search-container">
  <input type="text" class="search-input" placeholder="Rechercher..." />
  <button class="search-btn" onclick="startSearch()">
    <i class="fas fa-search"></i>
  </button>
</div>

<div class="table-container">
  <div class="add-new-intern-button">
    <button><i class="fas fa-plus"></i> Ajouter un nouveau stagiaire</button>
  </div>

  @if($interns->isNotEmpty())
  <div class="export-buttons">
    <a href="{{ route('interns.export.pdf') }}">
      <i class="fas fa-file-pdf"></i> Exporter en PDF
    </a>
    <a href="{{ route('interns.export.excel') }}">
      <i class="fas fa-file-excel"></i> Exporter en Excel
    </a>
  </div>
  @endif

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Âge</th>
        <th>CIN</th>
        <th>Téléphone</th>
        <th>Adresse</th>
        <th>École</th>
        <th>Secteur</th>
        <th>Date de début</th>
        <th>Date de fin</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @if($interns->isEmpty())
      <tr class="no-results-row">
        <td colspan="12">Aucun stagiaire !</td>
      </tr>
      @else
      @foreach ($interns as $intern)
      <tr class="no-results-row" style="display: none">
        <td colspan="12">Aucun résultat trouvé.</td>
      </tr>
      <tr>
        <td>{{ $intern->id }}</td>
        <td>
          <img
            src="{{ asset($intern->image) }}"
            alt="Image du stagiaire"
            class="intern-image"
          />
        </td>
        <td>{{ $intern->firstName }}</td>
        <td>{{ $intern->lastName }}</td>
        <td>{{ $intern->age }}</td>
        <td>{{ $intern->cin }}</td>
        <td>{{ $intern->phone }}</td>
        <td>{{ $intern->address }}</td>
        <td>{{ $intern->school }}</td>
        <td>{{ $intern->sector }}</td>
        <td>{{ $intern->startDate }}</td>
        <td>{{ $intern->endDate }}</td>
        <td>

          <button type="submit" class="delete-btn show-message-btn" data-intern-id="{{ $intern->id }}">
            <i class="fas fa-trash"></i>
          </button>

          <button class="modify-btn" onclick="editIntern(this)">
            <i class="fas fa-edit"></i>
          </button>

          <a href="{{ route('interns.attestation', ['id' => $intern->id]) }}" class="print-btn" target="_blank"  title="Imprimer">
              <i class="fas fa-print"></i>
          </a>
        </td>
      </tr>
    @endforeach
    @endif
    </tbody>
  </table>
</div>

@if(isset($intern))
  <form action="{{ route('interns.destroy', ['id' => $intern->id]) }}" method="POST" class="delete-form">
    @csrf
    @method('DELETE')
  </form>
@endif

<div class="form-overlay">
  <div class="form-container">
    <h2>Modifier les détails du stagiaire</h2>
    @if(isset($intern))
    <form id="edit-form" action="{{ route('fastEdit', ['id' => $intern->id]) }}" method="POST">
    @csrf
    @method('PUT')      
    <div class="form-group">
        <label for="edit-firstname"><i class="fas fa-user"></i></label>
        <input
          type="text"
          id="edit-firstname"
          name="edit-firstname"
          placeholder="Prénom"
          required
        />
      </div>
      <div class="form-group">
        <label for="edit-lastname"><i class="fas fa-user"></i></label>
        <input
          type="text"
          id="edit-lastname"
          name="edit-lastname"
          placeholder="Nom"
          required
        />
      </div>
      <div class="form-group">
        <label for="edit-age"><i class="fas fa-birthday-cake"></i></label>
        <input
          type="number"
          id="edit-age"
          name="edit-age"
          placeholder="Âge"
          required
        />
      </div>
      <div class="form-group">
        <label for="edit-cin"><i class="fas fa-id-card-alt"></i></label>
        <input
          type="text"
          id="edit-cin"
          name="edit-cin"
          placeholder="CIN"
          required
        />
      </div>
      <div class="form-group">
        <label for="edit-phone"><i class="fas fa-phone"></i></label>
        <input
          type="text"
          id="edit-phone"
          name="edit-phone"
          placeholder="Téléphone"
          required
        />
      </div>
      <div class="form-group">
        <label for="edit-address"><i class="fas fa-map-marker-alt"></i></label>
        <input
          type="text"
          id="edit-address"
          name="edit-address"
          placeholder="Adresse"
          required
        />
      </div>
      <div class="form-group">
        <label for="edit-school"><i class="fas fa-graduation-cap"></i></label>
        <input
          type="text"
          id="edit-school"
          name="edit-school"
          placeholder="École"
          required
        />
      </div>
      <div class="form-group">
        <label for="edit-sector"><i class="fas fa-industry"></i></label>
        <input
          type="text"
          id="edit-sector"
          name="edit-sector"
          placeholder="Secteur"
          required
        />
      </div>
      <div class="form-group">
        <label for="edit-startdate"><i class="fas fa-calendar-alt"></i></label>
        <input type="date" id="edit-startdate" name="edit-startdate" required />
      </div>
      <div class="form-group">
        <label for="edit-enddate"><i class="fas fa-calendar-alt"></i></label>
        <input type="date" id="edit-enddate" name="edit-enddate" required />
      </div>
      <div class="form-buttons">
        <button type="submit" class="submit-button">Enregistrer</button>
        <button type="button" class="cancel-button">Annuler</button>
      </div>
    </form>
    @endif
  </div>
</div>


<div class="overlay">
  <div class="form-wrapper">
    <h2>Ajouter un nouveau stagiaire</h2>
    <form id="add-form" action="{{ route('fastAdd') }}" method="POST">
      @csrf
      <div class="input-group">
        <label for="new-firstname"><i class="fas fa-user"></i></label>
        <input
          type="text"
          id="new-firstname"
          name="new-firstname"
          placeholder="Prénom"
          required
        />
      </div>
      <div class="input-group">
        <label for="new-lastname"><i class="fas fa-user"></i></label>
        <input
          type="text"
          id="new-lastname"
          name="new-lastname"
          placeholder="Nom"
          required
        />
      </div>
      <div class="input-group">
        <label for="new-age"><i class="fas fa-calendar"></i></label>
        <input
          type="number"
          id="new-age"
          name="new-age"
          placeholder="Âge"
          required
        />
      </div>

      <div class="form-group">
        <label for="new-cin"><i class="fas fa-id-card-alt"></i></label>
        <input
          type="text"
          id="new-cin"
          name="new-cin"
          placeholder="CIN"
          required
        />
      </div>

      <div class="form-group">
        <label for="new-address"><i class="fas fa-map-marker-alt"></i></label>
        <input
          type="text"
          id="new-address"
          name="new-address"
          placeholder="Adresse"
          required
        />
      </div>

      <div class="form-group">
        <label for="new-phone"><i class="fas fa-phone"></i></label>
        <input
          type="text"
          id="new-phone"
          name="new-phone"
          placeholder="Téléphone"
          required
        />
      </div>

      <div class="input-group">
        <label for="new-school"><i class="fas fa-graduation-cap"></i></label>
        <input
          type="text"
          id="new-school"
          name="new-school"
          placeholder="École"
          required
        />
      </div>
      <div class="input-group">
        <label for="new-sector"><i class="fas fa-industry"></i></label>
        <input
          type="text"
          id="new-sector"
          name="new-sector"
          placeholder="Secteur"
          required
        />
      </div>
      <div class="input-group">
        <label for="new-startdate"><i class="fas fa-calendar-alt"></i></label>
        <input type="date" id="new-startdate" name="new-startdate" required />
      </div>
      <div class="input-group">
        <label for="new-enddate"><i class="fas fa-calendar-alt"></i></label>
        <input type="date" id="new-enddate" name="new-enddate" required />
      </div>
      <div class="button-group">
        <button type="submit" class="submit-button">Enregistrer</button>
        <button type="button" class="cancel-button">Annuler</button>
      </div>
    </form>
  </div>
</div>

<div id="message" class="message-overlay" style="display: none">
  <div class="message-container">
    <p>Êtes-vous sûr(e) de vouloir supprimer le stagiaire ?</p>
    <p>ID : <span id="intern-id"></span></p>
    <div class="confirmation-buttons">
      <button id="confirm-delete-btn" class="confirm-delete">Oui</button>
      <button id="cancel-delete-btn" class="cancel-delete">Annuler</button>
    </div>
  </div>
</div>