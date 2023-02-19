@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">Homepage</div>
            <div class="card-body text-center">
               <h1>Pengaduan Masyarakat</h1>
               <p>Ini adalah platform yang dikhususkan untuk membantu masyarakat untuk mengadukan masalah yang ada di
                  sekitar
                  masyarakat.</p>
               @guest
               <p>
                  <a class="btn btn-primary" href="{{ route('login') }}" role="button">Login</a>
                  <a class="btn btn-success" href="{{ route('register') }}" role="button">Register</a>
               </p>
               @endguest
            </div>
         </div>
      </div>
   </div>
</div>
@endsection