<div class="container">
  <div class="card inverse">
    <div class="left-section">
      <img
        src="{{ asset('images/register.png') }}"
        alt="Image d'inscription"
        class="login-image"
      />
    </div>
    <form
      action="{{ route('register') }}"
      method="POST"
      class="right-section"
      enctype="multipart/form-data"
    >
      @method('post') @csrf
      <h1>Inscription</h1>
      <div class="input-group">
        <i class="fa fa-user"></i>
        <input type="text" name="fullname" placeholder="Nom complet" />
      </div>
      @error('fullname')
      <span class="error-message">{{ $message }}</span>
      @enderror
      <div class="input-group">
        <i class="fa fa-envelope"></i>
        <input type="email" name="email" placeholder="Email" />
      </div>
      @error('email')
      <span class="error-message">{{ $message }}</span>
      @enderror
      <div class="input-group">
        <i class="fa fa-lock"></i>
        <input type="password" name="password" placeholder="Mot de passe" />
      </div>
      @error('password')
      <span class="error-message">{{ $message }}</span>
      @enderror
      <div class="input-group">
        <div class="upload-details" onclick="selectImage()">
          <label for="upload-input" class="upload-logo">
            <i class="fa fa-cloud-upload"></i>
          </label>
          <span id="file-name" class="upload-file-name">Choisir une image</span>
        </div>
      </div>
      <input
        type="file"
        id="upload-input"
        class="upload-input"
        name="image"
        accept="image/*"
        style="display: none"
      />

      @error('image')
      <span class="error-message">{{ $message }}</span>
      @enderror
      <button type="submit">S'inscrire</button>
      <p class="create-account">
        Vous avez déjà un compte ?
        <a href="{{ route('login') }}">Se connecter</a>
      </p>
    </form>
  </div>
</div>

<script>
    function selectImage() {
        document.getElementById('upload-input').click();
    }

    document.getElementById('upload-input').addEventListener('change', function() {
        var fileInput = this;
        var fileName = document.getElementById('file-name');

        if (fileInput.files && fileInput.files.length > 0) {
            fileName.textContent = fileInput.files[0].name;
        } else {
            fileName.textContent = 'Choisir une image';
        }
    });
</script>