<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NihonHub</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
           
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    @stack('style')

</head>

<body>
    <header>
        {{-- navbar --}}

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <img class="logo-navbar" src="css/img/logo2.png" alt="logo">
            <a class="navbar-brand" href="{{ route('home') }}">NihonHub</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse d-flex flex-row-reverse" id="navbarNav">
                               
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link {{Request::routeIs('home') ? 'active' : ''}}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{Request::routeIs('admin.dashboard') ? 'active' : ''}}" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{Request::routeIs('email') ? 'active' : ''}}" href="{{ route('email') }}">Contatti</a>
                    </li>
                    
                    @guest
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('sconti') }}">Sconti</a>
                    </li>
                    <li class="nav-item">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link"
                                style="display: inline; cursor: pointer;">Logout</button>
                        </form>
                    </li>
                    
                    
                    @endguest

                    <li>
                      <form id="searchForm" class="d-flex" action="{{ route('courses.search')}}" method="GET">
                        <input id="searchInput" class="form-control me-2" type="search" placeholder="Cerca corso" aria-label="Search" name="search">
                        <button class="btn btn-outline-danger" type="submit">Cerca</button>
                        </form>
                    </li>   
                </ul>
            </div>
        </div>
    </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1>Welcome to NihonHub</h1>
            <p>Il tuo ponte verso il Giappone</p>
        </div>
    </section>

    <!-- Login -->
    <section class="content-section py-1">
        <div class="container text-center">
            @yield('login')
        </div>
    </section>


    <!-- chi siamo -->
    <section class="content-section py-3">
        <div class="container">
            @yield('content')
        </div>
    </section>
    
    <!-- Card Corsi -->
    <section class="content-section py-5">
        <div class="container">
            @yield('corsi')
        </div>
    </section>

  
    
    <!-- Footer -->
<footer class="footer-section">
    <div class="container text-center">
        <p>&copy; 2024 NihonHub. All Rights Reserved.</p>
    </div>
</footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;
        
        for (i = 0; i < acc.length; i++) {
          acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
              panel.style.display = "none";
            } else {
              panel.style.display = "block";
            }
          });
        }
        </script>
        
    @stack('scripts')
</body>

</html>