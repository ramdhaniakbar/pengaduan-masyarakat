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
               <div class="alert alert-success" role="alert">
                  {{ session('status') }}
               </div>
               @endif
               <div class="d-flex justify-content-between mb-3">
                  <h3>Pengaduan Kamu</h3>
                  <a href="{{ route('complaint.create') }}" class="btn btn-primary">Buat Pengaduan</a>
               </div>
               <table class="table table-striped table-bordered border">
                  <tr class="bg-white">
                     <th>Name</th>
                     <th>Username</th>
                     <th>NIK</th>
                  </tr>
                  <tr>
                     <td>Gonalu Kaler</td>
                     <td>gonalukaler</td>
                     <td>320000000000000000</td>
                  </tr>
                  <tr>
                     <td>Ramdhani Akbar</td>
                     <td>ramdhaniakbar</td>
                     <td>320000000000000000</td>
                  </tr>
                  <tr>
                     <td>Ramdhani Akbar</td>
                     <td>ramdhaniakbar</td>
                     <td>320000000000000000</td>
                  </tr>
                  <tr>
                     <td>Ramdhani Akbar</td>
                     <td>ramdhaniakbar</td>
                     <td>320000000000000000</td>
                  </tr>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection