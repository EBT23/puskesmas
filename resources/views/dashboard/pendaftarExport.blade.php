@extends('layouts.base', ['title' => "$title - Admin"])

@section('content')
@include('sweetalert::alert')
<div class="content-header">
    <form method="GET" action="{{ route('filter.excel') }}">
        @csrf
        <div class="card">
            <div class="row" style="margin: 10px;">

                <div class="col-md-3">
                    <label for="0">Tanggal Awal</label>
                    <input type="date" id="tanggal_awal" name="tanggal_awal" value="{{ Request::old('tanggal_awal') }}" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="">Tanggal akhir</label>
                    <input type="date" id="tanggal_akhir" name="tanggal_akhir" value="{{ old('tanggal_akhir') }}" class="form-control">
                </div>
                <div class="col-md-3">
                    {{-- <button type="submit" class="btn btn-outline-primary" style="margin-top: 31px;">Filter</button> --}}
                    @if ($pendaftaran == true)
                    <a onclick="cetakAll()" class="btn btn-outline-success" style="margin-top: 31px;">Excel</a>
                    <a onclick="cetakAllPdf()" class="btn btn-outline-danger" id="pdf" style="margin-top: 31px;">Pdf</a>
                    @endif

                </div>

            </div>
        </div>
    </form>
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <td width="5%">No</td>
                            <td>Nama </td>
                            <td>Nik </td>
                            <td>Tanggal Lahir </td>
                            <td>Tempat Lahir </td>
                            <td>Alamat </td>
                            <td>Action</td>

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
                            <td class="d-flex">
                                <a href="pendaftarExport/cetakExcelRow/{{ $dp->id_pendaftaran  }}" type="button" class="btn btn-outline-success mr-2"><i class="fas fa-print"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<script>
    function cetakAll() {
        var tanggal_awal = $("#tanggal_awal").val();
        var tanggal_akhir = $("#tanggal_akhir").val();
        console.log(tanggal_awal);
        if (tanggal_awal == "" || tanggal_akhir == "") {
            alert("Masukan Tanggal Awal dan Tanggal Akhir");
        } else {
            $.ajax({
                type: "GET",
                cache: false,
                dataType: 'json',
                url: "{{ url('/pendaftarExport/cetakAll') }}/",
                data: {
                    tanggal_awal: tanggal_awal,
                    tanggal_akhir: tanggal_akhir
                },

                success: function(response) {
                    // window.open(this.url, '_blank');
                    var win = window.open("", "_blank");
                    win.location.href = response.file;
                }
            });
            return false;
        }
    }

    function cetakAllPdf() {
        var _tanggal_awal = $("#tanggal_awal").val();
        var _tanggal_akhir = $("#tanggal_akhir").val();
        // console.log(tanggal_awal);

        if (tanggal_awal == "" || tanggal_akhir == "") {
            alert("Masukan Tanggal Awal dan Tanggal Akhir");
        } else {
            $.ajax({
                type: "GET",
                cache: false,
                dataType: 'json',
                url: "{{ url('pendaftarExport/cetakAllPdf') }}",
                data: {
                    tanggal_awal: _tanggal_awal,
                    tanggal_akhir: _tanggal_akhir
                },
                // contentType: false,
                // processData: false,
                success: function(response) {
                    console.log(response.data);
                    window.open(response.data, '_blank');
                }

            });



        }

    }
    // $('#pdf').click(function() {

    // });
</script>

<!-- /.content-header -->
@endsection