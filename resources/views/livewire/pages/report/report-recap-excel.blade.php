<html>
    <head>
        <title>Laporan Rekap Absensi Siswa</title>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th colspan="10" style="text-align: center; font-size: 16pt; font-weight: bold;">LAPORAN REKAP ABSENSI SISWA</th>
                </tr>
                @if($classname!='-')                    
                    <tr>
                        <th colspan="10" style="text-align: center; font-size: 16pt; font-weight: bold;">
                            KELAS {{$classame}} 
                        </th>
                    </tr>
                @endif
                <tr>
                <tr>
                    <th colspan="10" style="text-align: center; font-size: 12pt; font-weight: bold;">
                        Tanggal {{date('d-m-Y', strtotime($date_start))}} s/d {{date('d-m-Y', strtotime($date_start))}}
                    </th>
                </tr>
                <tr>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">NO</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">NIS</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Nama Siswa</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Kelas</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Izin</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Sakit</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Alfa</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Terlambat</th>
                </tr>
            </thead>
            <tbody>
            @foreach($datareport as $data)
                <tr>
                    <td style="border: 1pt solid #000">{{ $loop->iteration }}</td>
                    <td style="border: 1pt solid #000">{{ $data['student_nis'] }}</td>
                    <td style="border: 1pt solid #000">{{ $data['student_name'] }}</td>
                    <td style="border: 1pt solid #000">{{ $data['class_name'] }}</td>
                    <td style="border: 1pt solid #000">{{ $data['izin'] }}</td>
                    <td style="border: 1pt solid #000">{{ $data['sakit'] }}</td>
                    <td style="border: 1pt solid #000">{{ $data['alfa'] }}</td>
                    <td style="border: 1pt solid #000">{{ $data['terlambat'] }}</td>
                </tr>
            @endforeach
            </tbody>
    </table>
    </body>
</html>