<html>
    <head>
        <title>Data Siswa</title>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th colspan="8" style="text-align: center; font-size: 16pt; font-weight: bold;">Data Siswa</th>
                </tr>
                <tr>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">No</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">NIS</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Nama</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Jenis Kelamin</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Tahun Masuk</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Kelas</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Periode</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Email</th>
                </tr>
            </thead>
            <tbody>
            @foreach($students as $student)
                <tr>
                    <td style="border: 1pt solid #000">{{ $loop->iteration }}</td>
                    <td style="border: 1pt solid #000">{{ $student->nis }}</td>
                    <td style="border: 1pt solid #000">{{ $student->name }}</td>
                    <td style="border: 1pt solid #000">
                        {{ $student->gender === 'M' ? 'Laki-laki' : 'Perempuan' }}
                    </td>
                    <td style="border: 1pt solid #000">{{ $student->year_entry }}</td>
                    <td style="border: 1pt solid #000">{{ optional($student->classroom)->name }}</td>
                    <td style="border: 1pt solid #000">{{ optional($student->period)->name }}</td>
                    <td style="border: 1pt solid #000">{{ optional($student->user)->email }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </body>
</html>