<html>
    <head>
        <title>Data Guru</title>
        <style>
            @page { size: A4 portrait; margin:20px; }
            body { font-family: sans-serif; font-size: 10pt; }
            table { width:100%; border-collapse: collapse; margin-top:10px; }
            th, td { padding:5px; border:1px solid #000; text-align:center; }
            thead th { background-color: gray; font-weight:bold; }
        </style>
    </head>
    <body>
        <h1 style="font-size:16pt; text-align:center;font-weight: bold;">Data Guru</h1>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama</th>
                </tr>
            </thead>
            <tbody>
                @foreach($teachers as $t)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $t->nip }}</td>
                    <td>{{ $t->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
