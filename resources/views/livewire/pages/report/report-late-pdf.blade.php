<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
        <title>Laporan Data Siswa Terlambat</title>
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
        <div class="title">LAPORAN DATA SISWA TERLAMBAT</div>
        @if($classname!='-') 
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
                    <th>Masuk</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
            @foreach($datareport as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data['student_nis'] }}</td>
                    <td>{{ $data['student_name'] }}</td>
                    <td>{{ $data['class_name'] }}</td>
                    <td style="text-lign: center">{{ $data['attendance_checkin'] }}</td>
                    <td style="text-lign: center">{{ $data['attendance_status'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </body>
</html>