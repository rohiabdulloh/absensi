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
        @if($student)  
        <div class="title">{{$student->name ?? ''}}</div>
        @endif
        <div class="subtitle">
            Bulan {{$month}} 
        </div>
        <table>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Tanggal</th>
                    <th>Masuk</th>
                    <th>Pulang</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
            @foreach($datareport as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{  \Carbon\Carbon::parse($data['date'])->translatedFormat('l, d F Y')}}</td>
                    <td style="text-align: center;">{{ $data['check_in'] }}</td>
                    <td style="text-align: center;">{{ $data['check_out'] }}</td>
                    <td style="text-align: center;">
                        @if (!empty($data['special_day']))
                            {{ $data['special_day'] }}
                        @else
                            {{ $data['status'] }}
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </body>
</html>