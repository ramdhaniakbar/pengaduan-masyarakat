@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">Login</div>
            <div class="card-body">
               <form method="POST" action="{{ route('login.store') }}">
                  @csrf

                  <div class="form-group row justify-content-center my-3">
                     <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>

                     <div class="col-md-6">
                        <input id="username" type="username"
                           class="form-control @error('username') is-invalid @enderror" name="username"
                           value="{{ old('username') }}" autocomplete="username" autofocus>

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

                  <div class="form-group row justify-content-center my-3 mb-0">
                     <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                           Login
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