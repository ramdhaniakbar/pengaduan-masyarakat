<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>{{ $title }}</title>
</head>

<body>
   <h3>Diprint oleh {{ $employee }}</h3>
   <table border="1" cellspacing="0" cellpadding="2">
      <thead>
         <tr>
            <th>No</th>
            <th>Isi Laporan</th>
            <th>Isi Tanggapan</th>
            <th>Tanggal Pengaduan</th>
            <th>Status</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($complaints as $complaint)
         <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $complaint->content_report }}</td>
            <td>{{ $complaint->response->response ?? 'Belum ditanggapi' }}</td>
            <td>{{ $complaint->complaint_date }}</td>
            <td>{{ $complaint->status }}</td>
         </tr>
         @endforeach
      </tbody>
   </table>
</body>

</html>