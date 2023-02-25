@extends('layouts.app')

@section('title', 'Buat Tanggapan')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">Buat Tanggapan</div>

            <div class="card-body">

               <form method="POST" action="{{ route('backsite.store_response', $complaint->id) }}">
                  @csrf

                  <div class="form-group row justify-content-center my-3">
                     <label for="response" class="col-md-4 col-form-label text-md-right">Tanggapan</label>

                     <div class="col-md-6">
                        <textarea id="response" type="text" class="form-control @error('response') is-invalid @enderror"
                           name="response" id="" cols="30" rows="8" autocomplete="response"></textarea>

                        @error('response')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>

                  <div class="form-group row justify-content-center my-3">
                     <label for="response_date" class="col-md-4 col-form-label text-md-right">Tanggal Tanggapan</label>

                     <div class="col-md-6">
                        <input id="response_date" type="date"
                           class="form-control @error('response_date') is-invalid @enderror" name="response_date"
                           autocomplete="response_date">

                        @error('response_date')
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