@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">Dashboard</div>

            <div class="card-body">
               @if (session('status'))
               <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ session('status') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>
               @endif
               <div class="d-flex justify-content-between mb-3">
                  <h3>Pengaduan Masyarakat</h3>
               </div>
               @if (count($complaints) > 0)
               <table class="table table-striped table-bordered border">
                  <tr class="bg-white">
                     <th>Foto Bukti</th>
                     <th>Isi Laporan</th>
                     <th>Tanggal Pengaduan</th>
                     <th>Status</th>
                     <th>Actions</th>
                  </tr>
                  @foreach ($complaints as $complaint)
                  <tr>
                     <td><img style="width: 100px; height: 65px;" src="/storage/images/{{ $complaint->image }}" alt="">
                     </td>
                     <td>{{ Str::limit($complaint->content_report, 35, '...') }}</td>
                     <td>{{ $complaint->complaint_date }}</td>
                     <td>
                        <span
                           class="{{ $complaint->status == 'pending' ? 'text-capitalize badge text-bg-secondary' : ($complaint->status == 'rejected' ? 'text-capitalize badge text-bg-danger' : 'text-capitalize badge text-bg-success') }}">{{
                           $complaint->status }}
                        </span>
                     </td>
                     <td>
                        @if ($complaint->status == 'rejected')
                        <a href="{{ route('complaint.show', $complaint->id) }}" class="btn btn-light btn-sm border">
                           <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('backsite.unreject_status', $complaint->id) }}" class="btn btn-info btn-sm">
                           <i class="bi bi-arrow-repeat"></i>
                        </a>
                        @elseif ($complaint->status == 'completed')
                        <a href="{{ route('complaint.show', $complaint->id) }}" class="btn btn-light btn-sm border">
                           <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('backsite.edit_response', $complaint->id) }}" class="btn btn-warning btn-sm">
                           <i class="bi bi-pencil-square"></i>
                        </a>
                        @else
                        <a href="{{ route('complaint.show', $complaint->id) }}" class="btn btn-light btn-sm border">
                           <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('backsite.create_response', $complaint->id) }}"
                           class="btn btn-primary btn-sm">
                           <i class="bi bi-plus-circle"></i>
                        </a>
                        <a href="{{ route('backsite.reject_status', $complaint->id) }}" class="btn btn-danger btn-sm">
                           <i class="bi bi-x-circle"></i>
                        </a>
                        @endif
                     </td>
                  </tr>
                  @endforeach
               </table>
               <div class="d-flex justify-content-end">
                  {{ $complaints->links() }}
               </div>
               @else
               <p class="text-center">Kamu belum pernah buat pengaduan</p>
               @endif
            </div>
         </div>
      </div>
   </div>
</div>
@endsection