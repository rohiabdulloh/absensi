<html>
    <head>
        <title>Laporan Data Presensi</title>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th colspan="10" style="text-align: center; font-size: 16pt; font-weight: bold;">LAPORAN DATA PRESENSI</th>
                </tr>
                <tr>
                    <th colspan="10" style="text-align: center; font-size: 12pt; font-weight: bold;">
                        Tanggal {{date('d-m-Y', strtotime($date_start))}} s/d {{date('d-m-Y', strtotime($date_end))}} 
                    </th>
                </tr>
                <tr>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">No Id</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Nama Pekerja</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Departemen</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Tanggal</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Jadwal Masuk</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Jadwal Pulang</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Absen Masuk</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Absen Pulang</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Telat</</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Pulang Awal</th>
                </tr>
            </thead>
            <tbody>
            @foreach($datareport as $data)
                <tr>
                    <td style="border: 1pt solid #000">{{ $data['noid'] }}</td>
                    <td style="border: 1pt solid #000">{{ $data['name'] }}</td>
                    <td style="border: 1pt solid #000">{{ $data['departemen'] }}</td>
                    <td style="border: 1pt solid #000">{{ date('d-m-Y', strtotime($data['date'])) }}</td>
                    <td style="border: 1pt solid #000">{{ $data['on_duty'] }}</td>
                    <td style="border: 1pt solid #000">{{ $data['off_duty'] }}</td>
                    <td style="border: 1pt solid #000">{{ $data['check_in'] }}</td>
                    <td style="border: 1pt solid #000">{{ $data['check_out'] }}</td>
                    <td style="border: 1pt solid #000">{{ $data['late'] }}</td>
                    <td style="border: 1pt solid #000">{{ $data['early'] }}</td>
                </tr>
            @endforeach
            </tbody>
    </table>
    </body>
</html>