<html>
    <head>
        <title>Data Siswa</title>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th colspan="6" style="text-align: center; font-size: 16pt; font-weight: bold;">Data Siswa</th>
                </tr>
                <tr>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">No</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">NIS</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Nama Siswa</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Jenis Kelamin</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">HP Orang Tua</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Tahun Masuk</th>
                </tr>
            </thead>
            <tbody>
            @foreach($students as $student)
                <tr>
                    <td style="border: 1pt solid #000">{{ $loop->iteration }}</td>
                    <td style="border: 1pt solid #000">{{ $student->nis }}</td>
                    <td style="border: 1pt solid #000">{{ $student->name }}</td>
                    <td style="border: 1pt solid #000">
                        {{ $student->gender === 'M' ? 'L' : 'P' }}
                    </td>
                    <td style="border: 1pt solid #000">{{ $student->parent_hp }}</td>
                    <td style="border: 1pt solid #000">{{ $student->year_entry }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </body>
</html>