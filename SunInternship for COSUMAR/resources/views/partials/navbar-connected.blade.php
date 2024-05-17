<header>
  <nav class="navbar">
    <span>
      <i class="fa-solid fa-bars" id="sidebar-close"></i>
      <a href="{{ route('dashboard.main') }}" class="logo">
        <img src="{{ asset('images/suninternship.png') }}" alt="Logo" />
      </a>
    </span>
    <ul>
      <li><a href="{{ route('dashboard.main') }}">Tableau de bord</a></li>

      <li>
        <div class="user-menu">
          @if (Auth::check() && Auth::user()->image)
            <img src="{{ asset(Auth::user()->image) }}" alt="Image de l'utilisateur" />
          @endif

          <ul class="user-menu-items">
            <li>
              <a href="#fullscreen" onclick="toggleFullScreen()"
                ><i class="fa-solid fa-expand-arrows-alt"></i
                ><span class="tooltip">Plein écran</span></a
              >
            </li>
            <li>
              <a href="{{ route('logout') }}" class="logout-btn">
                <i class="fa-solid fa-sign-out-alt"></i>
                <span class="tooltip">Déconnexion</span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <li class="more-items">
        <a href="#"><i class="fa-solid fa-ellipsis-h"></i></a>
        <ul class="hidden-menu">
          <li><a href="{{ route('about') }}">Propos</a></li>
          <li><a href="{{ route('service') }}">Service</a></li>
          <li><a href="{{ route('about.contact') }}">Contact</a></li>
        </ul>
      </li>
    </ul>
  </nav>

  <ul class="breadcrumb">
    <?php
    // Get the current route name
    $currentRouteName = Route::currentRouteName();

    // Define the breadcrumb routes and their associated names
    $breadcrumbRoutes = [
      'dashboard.add-intern' => 'Ajouter un stagiaire',
      'dashboard.delete-intern' => 'Supprimer un stagiaire',
      'dashboard.edit-intern' => 'Modifier un stagiaire',
      'dashboard.settings' => 'Paramètre',
      'dashboard.help' => 'Aide',
    ];

    // Output the root breadcrumb element
    if ($currentRouteName === 'dashboard.main') {
      echo '<li>Tableau de bord</li>';
    } else {
      echo '<li><a href="' . route('dashboard.main') . '">Tableau de bord</a></li>';
    }

    // Generate the breadcrumb based on the current route
    foreach ($breadcrumbRoutes as $routeName => $name) {
      if ($currentRouteName === $routeName) {
        echo '<li class="active"> > ' . $name . '</li>';
      } else {
        echo '<li><a href="' . route($routeName) . '">' . $name . '</a></li>';
      }
    }
    ?>
  </ul>
</header>

<script>
  var isFullScreen = false;

function toggleFullScreen() {
    var elem = document.documentElement;
    if (!isFullScreen) {
      if (elem.requestFullscreen) {
        elem.requestFullscreen().catch(handleError);
      } else if (elem.mozRequestFullScreen) { // Firefox
        elem.mozRequestFullScreen().catch(handleError);
      } else if (elem.webkitRequestFullscreen) { // Chrome, Safari and Opera
        elem.webkitRequestFullscreen().catch(handleError);
      } else if (elem.msRequestFullscreen) { // IE/Edge
        elem.msRequestFullscreen().catch(handleError);
      }
      isFullScreen = true;
    } else {
      if (document.exitFullscreen) {
        document.exitFullscreen();
      } else if (document.mozCancelFullScreen) { // Firefox
        document.mozCancelFullScreen();
      } else if (document.webkitExitFullscreen) { // Chrome, Safari and Opera
        document.webkitExitFullscreen();
      } else if (document.msExitFullscreen) { // IE/Edge
        document.msExitFullscreen();
      }
      isFullScreen = false;
    }
  }

  function handleError(error) {
    console.log('Error attempting to enable full-screen mode:', error.message);
  }

    // Hide breadcrumb items until they are accessed
    (function() {
      var breadcrumbItems = document.querySelectorAll('.breadcrumb li');
      var activeItemIndex = -1;

      for (var i = 0; i < breadcrumbItems.length; i++) {
        var item = breadcrumbItems[i];
        if (item.classList.contains('active')) {
          activeItemIndex = i;
          break;
        }
      }

      for (var j = 0; j < breadcrumbItems.length; j++) {
        if (j === 0 || j === activeItemIndex) {
          breadcrumbItems[j].style.display = 'list-item';
        } else {
          breadcrumbItems[j].style.display = 'none';
        }
      }
    })();

</script>
