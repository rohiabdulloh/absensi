<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
        <title>Laporan Rekap Absensi Siswa</title>
        <style>
            body{font-family: Arial, sans-serif; font-size: 12pt;}
            table{border-collapse: collapse; width: 100%;}
            td{font-size: 10pt; padding: 2px; border: 1pt solid #000;}
            th{font-size: 10pt;text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray;}
            .title{text-align: center; font-size: 16pt; font-weight: bold; margin-bottom: 10px;}
            .subtitle{text-align: center; font-size: 12pt; font-weight: bold; margin-bottom: 10px;}
        </style>
    </head>
    <body>
        <div class="title">LAPORAN REKAP ABSENSI SISWA</div>
        @if($classname != '-')  
        <div class="title">KELAS {{$classname}}</div>
        @endif
        <div class="subtitle">
            Tanggal {{date('d-m-Y', strtotime($date))}} 
        </div>
        <table>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Izin</th>
                    <th>Sakit</th>
                    <th>Alfa</th>
                    <th>Terlambat</th>
                </tr>
            </thead>
            <tbody>
            @foreach($datareport as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data['student_nis'] }}</td>
                    <td>{{ $data['student_name'] }}</td>
                    <td>{{ $data['class_name'] }}</td>
                    <td>{{ $data['izin'] }}</td>
                    <td>{{ $data['sakit'] }}</td>
                    <td>{{ $data['alfa'] }}</td>
                    <td>{{ $data['terlambat'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </body>
</html>