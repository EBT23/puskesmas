@extends('layouts.base', ['title' => "Jadwal - Pasien"])

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Jadwal</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Jadwal</li>
                </ol>
            </div><!-- /.col -->
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Jadwal Dokter</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="POST" action="{{ route('jadwal.post') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dokter_id">Nama Dokter</label>
                                <input type="text" class="form-control" id="dokter_id" name="dokter_id" placeholder="Nama Dokter">
                            </div>
                            <div class="form-group">
                                <label for="hari">hari</label>
                                <input type="date" class="form-control" id="hari" name="hari" placeholder="Hari">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dari_jam">Dari Jam </label>
                                <input type="time" class="form-control" id="dari_jam" name="dari_jam" placeholder="Dari Jam">
                            </div>
                            <div class="form-group">
                                <label for="sampai_jam">Sampai Jam</label>
                                <input type="time" class="form-control" id="sampai_jam" name="sampai_jam" placeholder="Sampia Jam">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <hr>
            <div class="card-body">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped" style="text-justify: center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Hari</th>
                                <th>Dari Jam</th>
                                <th>Sampai Jam</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwalDokter as $dj )
                            <tr>
                                <td>1</td>
                                <td>{{$dj->dokter_id}}</td>
                                <td>{{$dj->hari}}</td>
                                <td>{{$dj->dari_jam}}</td>
                                <td>{{$dj->sampai_jam}}</td>
                                <td>

                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">Edit</button>


                                    <button class="btn btn-danger" type="reset">Hapus</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Hari</th>
                                <th>Dari Jam</th>
                                <th>Sampai Jam</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div><!-- /.row -->
        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Large Modal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('jadwal.post') }}">
                            @csrf
                            <div class="row">
                                @foreach ($jadwalDokter as $jd )
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dokter_id">Nama Dokter</label>
                                        <input type="text" class="form-control" id="dokter_id" name="dokter_id" value="{{ $jd->dokter_id }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="hari">hari</label>
                                        <input type="date" class="form-control" id="hari" name="hari" value="{{ $jd->hari }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dari_jam">Dari Jam </label>
                                        <input type="time" class="form-control" id="dari_jam" name="dari_jam" value="{{ $jd->dari_jam }}">

                                    </div>
                                    <div class="form-group">
                                        <label for="sampai_jam">Sampai Jam</label>
                                        <input type="time" class="form-control" id="sampai_jam" name="sampai_jam" value="{{ $jd->sampai_jam }}">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                    <div class="modal-footer justify-content-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>

            </div>

        </div>


    </div><!-- /.container-fluid -->
</div>
</div>
<!-- /.content-header -->
@endsection
