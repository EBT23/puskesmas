@extends('layouts.base', ['title' => "$title - Admin"])

@section('content')
    @include('sweetalert::alert')
    <div class="content-header" id="ref">
        <h2>Daftar Antrian Aktif</h2>
        <button class="item_done btn btn-outline-primary mr-2 refresh"
            style="margin-left: 1050px;
margin-top: -63px;">Refresh</button>
        <div class="container-fluid">
            <div class="card shadow">

                <div class="card-body">

                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td width="5%">No</td>
                                <td>Nama </td>
                                <td>Antrian </td>
                                <td>Poli </td>
                                <td>Tanggal </td>
                                <td>Status </td>
                                <td>Action</td>

                            </tr>
                        </thead>
                        <tbody id="show_dataAktif">


                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="content-header">
        <h2>Daftar Antrian Selesai</h2>

        <div class="container-fluid">
            <div class="card shadow">

                <div class="card-body">

                    <table id="datatableNoAktif" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td width="5%">No</td>
                                <td>Nama </td>
                                <td>Antrian </td>
                                <td>Poli </td>
                                <td>Tanggal </td>
                                <td>Status </td>
                                <td>Action</td>

                            </tr>
                        </thead>
                        <tbody id="show_data">


                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <input type="text" id="poli_code" value="{{ $poli_code }}" hidden>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function getAntrian(id) {
            $.ajax({
                type: "GET",
                cache: false,
                url: "{{ url('doneAntrian') }}/" + id,

                success: function() {


                }
            });
            return false;
        };
    </script>
    <script>
        $(document).ready(function() {
            tampil_NoAktif();
            tampil_Aktif();
            $('#ref').on('click', '.refresh', function() {
                tampil_NoAktif();
                tampil_Aktif();
            });

            function tampil_Aktif() {
                var poli_code = $('#poli_code').val();
                $.ajax({
                    type: 'GET',
                    url: '{{ route('load_data') }}',
                    async: true,
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        poli_code: poli_code
                    },
                    success: function(antrian) {
                        var html = '';
                        var i;
                        var no = 1;
                        var symbol =
                            '<i class="fa fa-check"></i>'
                        for (i = 0; i < antrian.length; i++) {
                            html += '<tr>' +
                                '<td>' + no++ + '</td>' +
                                '<td>' + antrian[i].full_name + '</td>' +
                                '<td>' + antrian[i].antrian + '</td>' +
                                '<td>' + antrian[i].nama_poli + '</td>' +
                                '<td>' + antrian[i].created_at + '</td>' +
                                '<td>' + antrian[i].status + '</td>' +
                                '<td>' +
                                '<a href="javascript:;" class="item_done btn btn-outline-primary mr-2" data="' +
                                antrian[i].id_antrian + '">' + symbol + '</a>' +
                                '</td>' +
                                '</tr>';
                        }
                        $('#show_dataAktif').html(html);
                    }
                });
            }
            $('#show_dataAktif').on('click', '.item_done', function() {
                var id = $(this).attr('data');
                $.ajax({
                    type: "GET",
                    cache: false,
                    dataType: 'json',
                    url: "{{ url('doneAntrian') }}/" + id,

                    success: function() {
                        tampil_NoAktif();
                        tampil_Aktif();

                    }
                });
                return false;
            });

            function tampil_NoAktif() {
                var poli_code = $('#poli_code').val();
                $.ajax({
                    type: 'GET',
                    url: '{{ route('load_dataNoAktif') }}',
                    async: true,
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        poli_code: poli_code
                    },
                    success: function(data) {
                        var html = '';
                        var i;
                        var no = 1;
                        var symbol =
                            '<i class="fas fa-undo-alt"></i>'
                        for (i = 0; i < data.length; i++) {
                            html += '<tr>' +
                                '<td>' + no++ + '</td>' +
                                '<td>' + data[i].full_name + '</td>' +
                                '<td>' + data[i].antrian + '</td>' +
                                '<td>' + data[i].nama_poli + '</td>' +
                                '<td>' + data[i].created_at + '</td>' +
                                '<td>' + data[i].status + '</td>' +
                                '<td>' +
                                '<a href="javascript:;" class="item_back btn btn-outline-warning mr-2" data="' +
                                data[i].id_antrian + '">' + symbol + '</a>' +
                                '</td>' +
                                '</tr>';
                        }
                        $('#show_data').html(html);
                    }
                });
            }
            $('#show_data').on('click', '.item_back', function() {
                var id = $(this).attr('data');
                $.ajax({
                    type: "GET",
                    cache: false,
                    dataType: 'json',
                    url: "{{ url('backAntrian') }}/" + id,

                    success: function() {
                        tampil_NoAktif();
                        tampil_Aktif();

                    }
                });
                return false;
            });


        });
    </script>
    <!-- /.content-header -->
@endsection
