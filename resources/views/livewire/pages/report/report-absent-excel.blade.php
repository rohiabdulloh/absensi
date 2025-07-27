<html>
    <head>
        <title>Laporan Data Siswa Absen</title>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th colspan="5" style="text-align: center; font-size: 16pt; font-weight: bold;">LAPORAN DATA SISWA ABSEN</th>
                </tr>
                @if($classname!='-')                    
                    <tr>
                        <th colspan="5" style="text-align: center; font-size: 16pt; font-weight: bold;">
                            KELAS {{$classname}} 
                        </th>
                    </tr>
                @endif
                <tr>
                    <th colspan="5" style="text-align: center; font-size: 12pt; font-weight: bold;">
                        Tanggal {{date('d-m-Y', strtotime($date))}} 
                    </th>
                </tr>
                <tr>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">NO</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">NIS</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Nama Siswa</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Kelas</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Keterangan</th>
                </tr>
            </thead>
            <tbody>
            @foreach($datareport as $data)
                <tr>
                    <td style="border: 1pt solid #000">{{ $loop->iteration }}</td>
                    <td style="border: 1pt solid #000">{{ $data['student_nis'] }}</td>
                    <td style="border: 1pt solid #000">{{ $data['student_name'] }}</td>
                    <td style="border: 1pt solid #000; text-align: center;">{{ $data['class_name'] }}</td>
                    <td style="border: 1pt solid #000; text-align: center;">{{ $data['attendance_status'] }}</td>
                </tr>
            @endforeach
            </tbody>
    </table>
    </body>
</html>