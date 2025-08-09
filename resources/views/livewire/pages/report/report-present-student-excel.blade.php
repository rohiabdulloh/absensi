<html>
    <head>
        <title>Laporan Data Presensi</title>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th colspan="5" style="text-align: center; font-size: 16pt; font-weight: bold;">LAPORAN DATA PRESENSI</th>
                </tr>                
                @if($student)                    
                    <tr>
                        <th colspan="5" style="text-align: center; font-size: 16pt; font-weight: bold;">
                            {{$student->name ?? ''}} 
                        </th>
                    </tr>
                @endif
                <tr>
                    <th colspan="5" style="text-align: center; font-size: 12pt; font-weight: bold;">
                        Bulan {{$month}} 
                    </th>
                </tr>
                <tr>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">NO</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Tanggal</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Masuk</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Pulang</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Keterangan</th>
                </tr>
            </thead>
            <tbody>
            @foreach($datareport as $data)
                <tr>
                    <td style="border: 1pt solid #000">{{ $loop->iteration }}</td>
                    <td style="border: 1pt solid #000">{{ \Carbon\Carbon::parse($data['date'])->translatedFormat('l, d F Y') }}</td>
                    <td style="border: 1pt solid #000; text-align: center;">{{ $data['check_in'] }}</td>
                    <td style="border: 1pt solid #000; text-align: center;">{{ $data['check_out'] }}</td>
                    <td style="border: 1pt solid #000; text-align: center;">
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