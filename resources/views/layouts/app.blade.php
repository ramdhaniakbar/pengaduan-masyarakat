<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   @include('includes.meta')

   <title>{{ config('app.name', 'Pengaduan Masyarakat') }} | @yield('title')</title>

   @include('includes.style')
</head>

<body>
   <div id="app">
      @include('components.navbar')
      <main class="container py-4">
         <div class="row justify-content-center">
            <div class="col-md-8">
               @include('components.messages')
            </div>
         </div>
         @yield('content')
      </main>
   </div>

   @include('includes.script')
</body>

</html>