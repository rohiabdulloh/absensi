<html>
    <head>
        <title>Data User</title>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th colspan="6" style="text-align: center; font-size: 16pt; font-weight: bold;">Data User</th>
                </tr>
                <tr>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">No</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Nama Lengkap</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Nama User</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Alamat Email</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Perusahaan</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Grup</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td style="border: 1pt solid #000">{{ $loop->iteration }}</td>
                    <td style="border: 1pt solid #000">{{ $user->name }}</td>
                    <td style="border: 1pt solid #000">{{ $user->username }}</td>
                    <td style="border: 1pt solid #000">{{ $user->email }}</td>
                    <td style="border: 1pt solid #000">{{ $user->company }}</td>
                    <td style="border: 1pt solid #000">{{ $user->group }}</td>
                </tr>
            @endforeach
            </tbody>
    </table>
    </body>
</html>