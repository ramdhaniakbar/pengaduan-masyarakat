@extends('layouts.app')

@section('title', 'Edit Pengaduan')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">Edit Pengaduan</div>

            <div class="card-body">

               <form method="POST" action="{{ route('complaint.update', $complaint->id) }}"
                  enctype="multipart/form-data">
                  @csrf
                  @method('PUT')

                  <div class="form-group row justify-content-center my-3">
                     <label for="content_report" class="col-md-4 col-form-label text-md-right">Isi Laporan</label>

                     <div class="col-md-6">
                        <textarea id="content_report" type="text"
                           class="form-control @error('content_report') is-invalid @enderror" name="content_report"
                           id="" cols="30" rows="8"
                           autocomplete="content_report">{{ $complaint->content_report }}</textarea>

                        @error('content_report')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>

                  <div class="form-group row justify-content-center my-3">
                     <label for="image" class="col-md-4 col-form-label text-md-right">Bukti Foto</label>

                     <div class="col-md-6">
                        <input id="image" type="file" class="form-control @error('image') is-invalid @enderror"
                           name="image" autocomplete="image">

                        @if ($complaint->image)
                        <img src="/storage/images/{{ $complaint->image }}" alt="" class="img-thumbnail"
                           style="max-height: 150px; margin-top: 6px;">
                        @endif

                        @error('image')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>

                  <div class="form-group row justify-content-center my-3">
                     <label for="complaint_date" class="col-md-4 col-form-label text-md-right">Tanggal Pengaduan</label>

                     <div class="col-md-6">
                        <input id="complaint_date" type="date"
                           class="form-control @error('complaint_date') is-invalid @enderror" name="complaint_date"
                           value="{{ $complaint->complaint_date }}" autocomplete="complaint_date">

                        @error('complaint_date')
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