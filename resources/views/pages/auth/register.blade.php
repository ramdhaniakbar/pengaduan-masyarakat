@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">Register</div>
            <div class="card-body">
               <form method="POST" action="{{ route('register') }}">
                  @csrf
                  <div class="form-group row justify-content-center">
                     <label for="name" class="col-md-4 col-form-label text-md-right">Nama</label>
                     <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                           name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>

                  <div class="form-group row justify-content-center my-3">
                     <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>

                     <div class="col-md-6">
                        <input id="username" type="username"
                           class="form-control @error('username') is-invalid @enderror" name="username"
                           value="{{ old('username') }}" autocomplete="username">

                        @error('username')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>

                  <div class="form-group row justify-content-center my-3">
                     <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                     <div class="col-md-6">
                        <input id="password" type="password"
                           class="form-control @error('password') is-invalid @enderror" name="password"
                           autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>

                  <div class="form-group row justify-content-center my-3">
                     <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Konfirmasi
                        Password</label>

                     <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                           autocomplete="new-password">
                     </div>
                  </div>

                  <div class="form-group row justify-content-center my-3 mb-0">
                     <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                           Register
                        </button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection