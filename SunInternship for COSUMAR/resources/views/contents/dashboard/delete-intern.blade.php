<div class="container">
    <h1>Supprimer un Stagiaire</h1>

    <div class="input-container">
        <input
            type="text"
            id="searchInput"
            placeholder="Filtrer les stagiaires..."
        />
        <i class="fas fa-filter search-icon"></i>
    </div>

    @if ($interns->isEmpty())
        <p class="text-explanation">Aucun Stagiaire !</p>
    @else

        <p id="nothing-found" class="text-explanation" style="display: none">
            Rien trouvé !
        </p>
        
        <p id="textExplanation" class="text-explanation">
            Sélectionnez les stagiaires en cochant les cases. Les stagiaires sélectionnés seront supprimés.
        </p>
    @endif

    @if(session('success'))
    <p class="success-message">{{ session('success') }}</p>
    @endif

    <div class="intern-list">
        @foreach ($interns as $intern)
            <div class="intern-item" data-id="{{ $intern->id }}" style="cursor:pointer">
                <div class="intern-card">
                    <div class="image-card-container">
                        <img
                            src="{{ asset($intern->image) }}"
                            alt="Stagiaire {{ $intern->id }}"
                        />
                    </div>
                    <div class="intern-details">
                        <span class="intern-id">{{ $intern->id }}</span>
                        <span class="intern-name">{{ $intern->firstName }} {{ $intern->lastName }}</span>
                    </div>
                    <div class="delete-checkbox" style="display:none">
                        <input type="checkbox" class="intern-checkbox" data-id="{{ $intern->id }}" onchange="handleCheckboxChange()" />
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="delete-icon" title="Supprimer les stagiaires sélectionnés" onclick="deleteInterns()">
        <i class="fas fa-trash"></i>
    </div>

    <form id="delete-form" method="POST" action="{{ route('interns.deleteSelected') }}">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <!-- Rest of the form code -->
    </form>

</div>