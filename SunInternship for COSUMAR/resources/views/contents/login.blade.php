<div class="container">
    <div class="card">
        <div class="left-section">
            <img class="login-image" src="{{ asset('images/login.png') }}" alt="Image de connexion" />
        </div>

        <form action="{{ route('login') }}" method="POST" class="right-section">
            <h1>Connexion</h1>
            @csrf
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="text" name="email" placeholder="Email" />
            </div>
            @error('email')
            <span class="error-message">{{ $message }}</span>
            @enderror
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Mot de passe" />
            </div>
            @error('password')
            <span class="error-message">{{ $message }}</span>
            @enderror
            <button type="submit">Se connecter</button>
            <p class="create-account">
                Vous n'avez pas de compte ? <a href="{{ route('register') }}">S'inscrire</a>
            </p>
        </form>
    </div>
</div>