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
                        <input type="date" id="tanggal_awal" name="tanggal_awal" value="{{ Request::old('tanggal_awal') }}"
                            class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="">Tanggal akhir</label>
                        <input type="date" id="tanggal_akhir" name="tanggal_akhir" value="{{ old('tanggal_akhir') }}"
                            class="form-control">
                    </div>
                    <div class="col-md-3">
                        {{-- <button type="submit" class="btn btn-outline-primary" style="margin-top: 31px;">Filter</button> --}}
                        @if ($pemeriksaan == true)
                            <a onclick="cetakAll()" class="btn btn-outline-success" style="margin-top: 31px;">Excel</a>
                            <a onclick="cetakAllPdf()"  class="btn btn-outline-danger" id="pdf"
                                style="margin-top: 31px;">Pdf</a>
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
                                <td>Antrian </td>
                                <td>Dokter </td>
                                <td>Penyakit </td>
                                <td>Obat </td>
                                <td>Tanggal </td>
                                <td>Action</td>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($pemeriksaan as $i => $dp)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $dp->full_name }}</td>
                                    <td>{{ $dp->antrian }}</td>
                                    <td>{{ $dp->nama_dokter }}</td>
                                    <td>
                                        @foreach (json_decode($dp->penyakit) as $key)
                                            {{ $key }},
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach (json_decode($dp->obat) as $key)
                                            {{ $key }},
                                        @endforeach
                                    </td>
                                    <td>{{ $dp->tgl_diperiksa }}</td>
                                    <td class="d-flex">
                                        <a href="cetakExcelRow/{{ $dp->id }}" type="button"
                                            class="btn btn-outline-success mr-2"><i class="fas fa-print"></i></a>

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
                    url: "{{ url('cetakAll') }}/",
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
            var tanggal_awal = $("#tanggal_awal").val();
            var tanggal_akhir = $("#tanggal_akhir").val();
            // console.log(tanggal_awal);

            if (tanggal_awal == "" || tanggal_akhir == "") {
                alert("Masukan Tanggal Awal dan Tanggal Akhir");
            } else {
                $.ajax({
                    type: "GET",
                    cache: false,
                    dataType: 'json',
                    url: "{{ url('cetakAllPdf') }}/",
                    data: {
                        tanggal_awal: tanggal_awal,
                        tanggal_akhir: tanggal_akhir
                    },
                    success: function(data) {
                        // console.log(data);
                        // var redirectWindow = window.open('/cetakAllPdf', '_blank');
                        // redirectWindow.location;
                    }

                });

                return false;

            }

        }
        // $('#pdf').click(function() {

        // });
    </script>

    <!-- /.content-header -->
@endsection
