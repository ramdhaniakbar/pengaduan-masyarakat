@extends('layouts.app')

@section('title', 'Buat Pengaduan')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">Buat Pengaduan</div>

            <div class="card-body">
               @if (session('status'))
               <div class="alert alert-success" role="alert">
                  {{ session('status') }}
               </div>
               @endif
               <form method="POST" action="{{ route('complaint.store') }}" enctype="multipart/form-data">
                  @csrf

                  <div class="form-group row justify-content-center my-3">
                     <label for="nik" class="col-md-4 col-form-label text-md-right">NIK</label>

                     <div class="col-md-6">
                        <input id="nik" type="text" class="form-control @error('nik') is-invalid @enderror" name="nik"
                           value="{{ old('nik') }}" autocomplete="nik" autofocus>

                        @error('nik')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>

                  <div class="form-group row justify-content-center my-3">
                     <label for="isi_laporan" class="col-md-4 col-form-label text-md-right">Isi Laporan</label>

                     <div class="col-md-6">
                        <textarea id="isi_laporan" type="text"
                           class="form-control @error('isi_laporan') is-invalid @enderror" name="isi_laporan" id=""
                           cols="30" rows="8" autocomplete="isi_laporan"></textarea>

                        @error('isi_laporan')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>

                  <div class="form-group row justify-content-center my-3">
                     <label for="foto" class="col-md-4 col-form-label text-md-right">Bukti Foto</label>

                     <div class="col-md-6">
                        <input id="foto" type="file" class="form-control @error('foto') is-invalid @enderror"
                           name="foto" autocomplete="foto">

                        @error('foto')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>

                  <div class="form-group row justify-content-center my-3">
                     <label for="tgl_pengaduan" class="col-md-4 col-form-label text-md-right">Tanggal Pengaduan</label>

                     <div class="col-md-6">
                        <input id="tgl_pengaduan" type="date"
                           class="form-control @error('tgl_pengaduan') is-invalid @enderror" name="tgl_pengaduan"
                           autocomplete="tgl_pengaduan">

                        @error('tgl_pengaduan')
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