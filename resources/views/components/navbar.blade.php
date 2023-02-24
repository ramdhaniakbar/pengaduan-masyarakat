<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
   <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
         <img style="width: 40px; height: 40px;" src="{{ asset('assets/images/public.png') }}" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
         aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
         <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <!-- Left Side Of Navbar -->
         <ul class="navbar-nav me-auto">
            <li class="nav-item">
               <a class="nav-link active" aria-current="page" href="{{ route('index') }}">Home</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="#">Services</a>
            </li>
         </ul>

         <!-- Right Side Of Navbar -->
         <ul class="navbar-nav ms-auto">
            <!-- Authentication Links -->
            @guest
            @if (Route::has('login'))
            <li class="nav-item">
               <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
            @endif

            @if (Route::has('register'))
            <li class="nav-item">
               <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>
            @endif
            @endguest

            @auth
            <li class="nav-item dropdown">
               <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ auth()->user()->name }}
               </a>

               <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <a href="{{ auth()->user()->role_id == 1 ? route('dashboard') : route('backsite.dashboard') }}"
                     class="dropdown-item">Dashboard</a>
                  <form action="{{ route('logout') }}" method="POST">
                     @csrf
                     <button type="submit" class="dropdown-item" role="button">
                        Logout
                     </button>
                  </form>
               </div>
            </li>
            @endauth
         </ul>
      </div>
   </div>
</nav>