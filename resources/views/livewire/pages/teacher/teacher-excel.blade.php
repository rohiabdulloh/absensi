<html>
    <head><title>Data Guru</title></head>
    <body>
        <table>
            <thead>
                <tr>
                    <th colspan="4" style="text-align: center; font-size:16pt; font-weight:bold;">Data Guru</th>
                </tr>
                <tr>
                    <th style="text-align:center;border:1px solid #000;background-color:gray">No</th>
                    <th style="text-align:center;border:1px solid #000;background-color:gray">NIP</th>
                    <th style="text-align:center;border:1px solid #000;background-color:gray">Nama</th>
                    <th style="text-align:center;border:1px solid #000;background-color:gray">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($teachers as $t)
                <tr>
                    <td style="border:1px solid #000">{{ $loop->iteration }}</td>
                    <td style="border:1px solid #000">{{ $t->nip }}</td>
                    <td style="border:1px solid #000">{{ $t->name }}</td>
                    <td style="border:1px solid #000">{{ optional($t->user)->email }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
