<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
        <title>Laporan Data Presensi</title>
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
        <div class="title">LAPORAN DATA PRESENSI</div>
        <div class="subtitle">
            Tanggal {{date('d-m-Y', strtotime($date_start))}} s/d {{date('d-m-Y', strtotime($date_end))}} 
        </div>
        <table>
            <thead>
                <tr>
                    <th>No Id</th>
                    <th>Nama Pekerja</th>
                    <th>Departemen</th>
                    <th>Tanggal</th>
                    <th>Jadwal Masuk</th>
                    <th>Jadwal Pulang</th>
                    <th>Absen Masuk</th>
                    <th>Absen Pulang</th>
                    <th>Telat</th>
                    <th>Pulang Awal</th>
                </tr>
            </thead>
            <tbody>
            @foreach($datareport as $data)
                <tr>
                    <td>{{ $data['noid'] }}</td>
                    <td>{{ $data['name'] }}</td>
                    <td>{{ $data['departemen'] }}</td>
                    <td>{{ date('d-m-Y', strtotime($data['date'])) }}</td>
                    <td>{{ $data['on_duty'] }}</td>
                    <td>{{ $data['off_duty'] }}</td>
                    <td>{{ $data['check_in'] }}</td>
                    <td>{{ $data['check_out'] }}</td>
                    <td>{{ $data['late'] }}</td>
                    <td>{{ $data['early'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </body>
</html>