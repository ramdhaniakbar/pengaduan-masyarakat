@extends('layouts.app')

@section('title', 'Detail Pengaduan')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card mb-4">
            <div class="card-header">Detail Pengaduan</div>

            <div class="card-body">
               <div class="d-flex justify-content-center">
                  <img style="width: 75%; height: 350px; border-radius: 10px;"
                     src="/storage/images/{{ $complaint->image }}" alt="" srcset="">
               </div>
               <div class="d-flex justify-content-between mt-4">
                  <p class="fs-4 p-0">{{ $complaint->content_report }}</p>
                  <div class="ms-5">
                     <span
                        class="{{ $complaint->status == 'pending' ? 'text-capitalize badge text-bg-secondary' : ($complaint->status == 'rejected' ? 'text-capitalize badge text-bg-danger' : 'text-capitalize badge text-bg-success') }}"
                        style="font-size: 14px">{{
                        $complaint->status }}
                     </span>
                  </div>
               </div>
               <hr>
               <div class="d-flex justify-content-between">
                  <span class="fw-semibold">{{ $user_complaint->name }}</span>
                  <span class="fw-normal p-0">{{ $complaint->complaint_date }}</span>
               </div>
            </div>

            <div class="card-footer text-muted">
               <div class="d-flex justify-content-between align-items-center">
                  <div>
                     <a href="{{ auth()->user()->role_id == 1 ? route('dashboard') : route('backsite.dashboard') }}"
                        class="btn btn-light btn-sm border">
                        <i class="bi bi-arrow-left"></i> Kembali
                     </a>
                  </div>
                  <div>
                     @if (auth()->user()->role_id == 1)
                     <a href="{{ route('complaint.edit', $complaint->id) }}" class="btn btn-warning btn-sm border my-2">
                        <i class="bi bi-pencil-square"></i>
                     </a>
                     <a href="{{ route('complaint.destroy', $complaint->id) }}"
                        class="btn btn-danger btn-sm border my-2">
                        <i class="bi bi-x-circle"></i>
                     </a>
                     @endif
                  </div>
               </div>
            </div>

         </div>

         <div class="card">
            <div class="card-header">
               Tanggapan
            </div>

            <div class="card-body">
               @if ($response)
               <p class="fs-4 p-0">{{ $response->response }}</p>
               <div class="d-flex justify-content-between">
                  <p>{{ $response->response_date }}</p>
                  <p>Ditanggapi oleh <span class="badge text-bg-dark badge-pill">{{ $user_response->name }}</span></p>
               </div>
               @elseif ($complaint->status == 'rejected')
               <div class="d-flex justify-content-between align-items-center">
                  <span>Aduan ditolak</span>
                  @if (auth()->user()->role_id !== 1)
                  <a href="{{ route('backsite.unreject_status', $complaint->id) }}" class="btn btn-info btn-sm">
                     <i class="bi bi-arrow-repeat"></i> Batalkan aduan ditolak
                  </a>
                  @endif
               </div>
               @else
               <div class="d-flex justify-content-between align-items-center">
                  <span>Belum ditanggapi</span>
                  @if (auth()->user()->role_id !== 1)
                  <div>
                     <a href="{{ route('backsite.create_response', $complaint->id) }}"
                        class="btn btn-primary btn-sm border my-2">
                        <i class="bi bi-plus-circle"></i> Tanggapi
                     </a>
                     <a href="{{ route('backsite.reject_status', $complaint->id) }}" class="btn btn-danger btn-sm">
                        <i class="bi bi-x-circle"></i> Tolak
                     </a>
                  </div>
                  @endif
               </div>
               @endif
            </div>

            <div class="card-footer text-muted">
               <div class="d-flex justify-content-between align-items-center">
                  <div>
                     @if (auth()->user()->role_id !== 1 && $response)
                     <a href="{{ route('backsite.edit_response', $complaint->id) }}"
                        class="btn btn-warning btn-sm border my-2">
                        <i class="bi bi-pencil-square"></i> Edit Tanggapan
                     </a>
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
@endsection