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
        <h1 style="text-align: center; font-size: 16pt; font-weight: bold;">Data Siswa</h1>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>HP Orang Tua</th>
                    <th>Tahun Masuk</th>
                </tr>
            </thead>
            <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->nis }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->gender === 'M' ? 'L' : 'P' }}</td>
                    <td>{{ $student->parent_hp }}</td>
                    <td>{{ $student->year_entry }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </body>
</html>
