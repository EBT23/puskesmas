@extends('layouts.base', ['title' => "$title - Admin"])

@section('content')
    @include('sweetalert::alert')
    <div class="content-header">
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
										<a href="cetakExcelRow/{{$dp->id}}" type="button" class="btn btn-outline-success mr-2" 
											><i class="fas fa-print"></i></a>
										
									</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->
@endsection
