@extends('layouts.app')

@section('title', 'Buat Tanggapan')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">Buat Tanggapan</div>

            <div class="card-body">

               <form method="POST" action="{{ route('backsite.store_user') }}">
                  @csrf
                  @method('POST')

                  <div class="form-group row justify-content-center my-3">
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
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                           name="username" value="{{ old('username') }}" autocomplete="username" autofocus>

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

                  <div class="form-group row justify-content-center my-3">
                     <label for="role" class="col-md-4 col-form-label text-md-right">Role</label>

                     <div class="col-md-6">
                        <select name="role" id="role" class="form-select" aria-label="role_id">
                           <option selected value="1">Masyarakat</option>
                           <option value="2">Admin</option>
                           <option value="3">Petugas</option>
                        </select>

                        @error('role')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>

                  <div class="form-group row justify-content-center my-3 mb-0">
                     <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                           Submit
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