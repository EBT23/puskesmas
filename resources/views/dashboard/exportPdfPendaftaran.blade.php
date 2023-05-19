<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>

</head>

<body>

    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped" onload="window.print()">
<thead>
                        <tr>
                            <td width="5%">No</td>
                            <td>Nama </td>
                            <td>Nik </td>
                            <td>Tanggal Lahir </td>
                            <td>Tempat Lahir </td>
                            <td>Alamat </td>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($pendaftaran as $i => $dp)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $dp->full_name }}</td>
                            <td>{{ $dp->nik }}</td>
                            <td>{{ $dp->tgl_lahir }}</td>
                            <td>{{ $dp->tempat_lahir }}</td>
                            <td>{{ $dp->alamat }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</body>
<script type='text/javascript'>
    window.onload = function() {
        window.print();
    }
</script>

</html>