<header>
    <nav class="navbar">
        <a href="{{ route('accueil') }}" class="logo" title="Cliquez pour allez vers l'accueil"><img src="{{ asset('images/suninternship.png') }}" alt="Logo"></a>
        <ul>
            <li><a href="{{ route('about') }}">À propos</a></li>
            <li><a href="{{ route('service') }}">Service</a></li>
            <li><a href="{{ route('about.contact') }}">Contact</a></li>
            <li>
                @if(Route::currentRouteName() === 'login')
                    <a href="{{ route('register') }}" class="login">S'inscrire</a>
                @elseif(Route::currentRouteName() === 'register')
                    <a href="{{ route('login') }}" class="login">Se connecte</a>
                @else
                    <a href="{{ route('login') }}" class="login">Se connecter</a>
                @endif
            </li>
        </ul>
    </nav>
    <ul class="breadcrumb">
    <?php
    // Get the current route name
    $currentRouteName = Route::currentRouteName();

    // Define the breadcrumb routes and their associated names
    $breadcrumbRoutes = [
        'accueil' => 'Accueil',
        'about' => 'À Propos',
        'about.contact' => 'Contact',
        'service' => 'Service',
        'login' => 'Connexion',
        'register' => 'Inscription',
    ];

    // Generate the breadcrumb based on the current route
    foreach ($breadcrumbRoutes as $routeName => $name) {
        if ($currentRouteName === $routeName) {
            echo '<li class="active">' . $name . '</li>';
        } else {
            echo '<li><a href="' . route($routeName) . '">' . $name . ' > </a></li>';
        }
    }
    ?>
</ul>

</header>

<script>
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