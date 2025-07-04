<html>
    <head>
        <title>Data Siswa</title>
        <style>
            @page {
                size: A4 landscape;
                margin: 20px;
            }
            body {
                font-family: sans-serif;
                font-size: 10pt;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 10px;
            }
            th, td {
                padding: 5px;
                border: 1pt solid #000;
                text-align: center;
            }
            thead th {
                background-color: gray;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th colspan="7" style="text-align: center; font-size: 16pt; font-weight: bold;">Data Siswa</th>
                </tr>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Tahun Masuk</th>
                    <th>Kelas</th>
                    <th>Periode</th>
                </tr>
            </thead>
            <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->nis }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->gender === 'M' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td>{{ $student->year_entry }}</td>
                    <td>{{ optional($student->classroom)->name }}</td>
                    <td>{{ optional($student->period)->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </body>
</html>
