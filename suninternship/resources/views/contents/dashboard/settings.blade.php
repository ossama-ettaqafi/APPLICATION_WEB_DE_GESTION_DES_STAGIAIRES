<div class="my-container">
  <div class="my-row">
    <div class="my-column">
      <h1>Paramètres</h1>
    </div>
  </div>

  <div class="my-row">
    <div class="my-column">
      <div class="profile-tab-nav">
        <div class="my-profile-content">
          <div class="image-container">
            @if (Auth::check() && Auth::user()->image)
              <img src="{{ asset(Auth::user()->image) }}" alt="Photo de profil">
            @endif
          </div>
          <div class="text-center">
            <h5>{{ Auth::user()->fullname }}</h5>
            <p>Admin</p>
          </div>
          <ul class="my-nav">
            <li class="my-nav-item">
              <a class="my-nav-link active" href="#profile">
                <i class="fas fa-user"></i> <span>Profil</span>
              </a>
            </li>
            <li class="my-nav-item">
              <a class="my-nav-link" href="#account">
                <i class="fas fa-key"></i> <span>Compte</span>
              </a>
            </li>
            <li class="my-nav-item">
              <a class="my-nav-link" href="#notifications">
                <i class="fas fa-bell"></i> <span>Notifications</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="my-column">
      <div class="my-tab-content">
        <div id="profile" class="my-tab-pane active">
          <form action="{{ route('user.updateProfile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="my-form-group">
              <label for="name">Nom Complet</label>
              <input type="text" class="my-form-control" id="name" name="name" placeholder="Entrez votre nom complet" value="{{ old('name', Auth::user()->fullname) }}">
              @error('name')
                <div class="my-error-message">{{ $message }}</div>
              @enderror
            </div>
            <div class="my-form-group">
              <label for="email">Email</label>
              <input type="email" class="my-form-control" id="email" name="email" placeholder="Entrez votre email" value="{{ old('email', Auth::user()->email) }}">
              @error('email')
                <div class="my-error-message">{{ $message }}</div>
              @enderror
            </div>
            <div class="my-form-group">
              <label for="profile-image">Image de profil</label>
              <input type="file" class="my-form-control" id="profile-image" name="profile_image" accept="image/*">
              @error('profile_image')
                <div class="my-error-message">{{ $message }}</div>
              @enderror
            </div>
            <div class="buttons">
              <button type="submit" class="my-btn my-btn-primary">Enregistrer</button>
            </div>
            @if (session('success'))
              <div class="my-success-message">{{ session('success') }}</div>
            @endif
          </form>
        </div>
        <div id="account" class="my-tab-pane">
          <form action="{{ route('user.updatePassword') }}" method="POST">
            @csrf
            <div class="my-form-group">
              <label for="password">Mot de passe</label>
              <input type="password" class="my-form-control" id="password" name="password" placeholder="Entrez votre mot de passe">
              @error('password')
                <div class="my-error-message">{{ $message }}</div>
              @enderror
            </div>
            <div class="my-form-group">
              <label for="confirm-password">Confirmez le mot de passe</label>
              <input type="password" class="my-form-control" id="confirm-password" name="password_confirmation" placeholder="Confirmez votre mot de passe">
            </div>
            <div class="buttons">
              <button type="submit" class="my-btn my-btn-primary">Enregistrer</button>
            </div>
            @if (session('password'))
              <div class="my-success-message">{{ session('password') }}</div>
            @endif
          </form>
        </div>
        <div id="notifications" class="my-tab-pane">
          <form action="{{ route('user.updateNotifications') }}" method="POST">
            @csrf
            <div class="my-form-group">
              <label for="email-notifications">Notifications par email</label>
              <div class="my-form-check">
                <input
                  type="checkbox"
                  class="my-form-check-input"
                  id="email-notifications"
                  name="email_notifications"
                  {{ Auth::user()->email_notifications ? 'checked' : '' }}
                />
                <label class="my-form-check-label" for="email-notifications">
                  Recevoir des notifications par email pour chaque activité sur votre compte
                </label>
              </div>
            </div>
            <div class="buttons">
              <button type="submit" class="my-btn my-btn-primary">Enregistrer</button>
            </div>
            @if (session('notification'))
              <div class="my-success-message">{{ session('notification') }}</div>
            @endif
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Get the 'profile-image' input element
  var profileImageInput = document.getElementById('profile-image');

  // Add an event listener to handle the file selection
  profileImageInput.addEventListener('change', function(event) {
    // Get the selected file
    var selectedFile = event.target.files[0];

    // Perform any additional actions with the file, such as displaying a preview or uploading it to the server

    // Example: Displaying a preview of the selected image
    var previewImage = document.createElement('img');
    previewImage.src = URL.createObjectURL(selectedFile);
    previewImage.alt = 'Preview Image';

    // Append the preview image to a container element
    var previewContainer = document.querySelector('.image-container');
    previewContainer.innerHTML = '';
    previewContainer.appendChild(previewImage);
  });
</script>