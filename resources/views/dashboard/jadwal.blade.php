@extends('layouts.base', ['title' => "Jadwal - Pasien"])

@section('content')
@include('sweetalert::alert')
@if ($errors->any())
@foreach ($errors->all() as $err)
    <p class="alert alert-danger">{{ $err }}</p>
@endforeach
@endif
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
                                <select class="form-control" name="dokter_id" id="dokter_id">
                                    <option value="">-pilih-</option>
                                    @foreach ($dataDokter as $dd )
                                    <option value="{{ $dd->id }}">{{ $dd->nama_dokter}}</option>
                                    @endforeach
                                </select>
                                
                                {{-- <input type="text" class="form-control" id="dokter_id" name="dokter_id" placeholder="Nama Dokter"> --}}
                            </div>
                            <div class="form-group">
                                <label for="hari">hari</label>
                                <select name="hari" id="hari" class="form-control">
                                    <option value="Senin">--pilih--</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="jumat">jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>
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
                                <th width="10%">No</th>
                                <th>Nama</th>
                                <th>Hari</th>
                                <th>Dari Jam</th>
                                <th>Sampai Jam</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwalDokter as $i => $jd )
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{$jd->nama_dokter}}</td>
                                <td>{{$jd->hari}}</td>
                                <td>{{$jd->dari_jam}}</td>
                                <td>{{$jd->sampai_jam}}</td>
                                <td class="d-flex">
                                    <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#modal-lg{{ $jd->id }}">Edit</button>
                                    <form action="hapusjadwal/{{$jd->id }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger" type="submit">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th width="10%">No</th>
                                <th>Nama</th>
                                <th>Hari</th>
                                <th>Dari Jam</th>
                                <th>Sampai Jam</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div><!-- /.row -->
        @foreach ($jadwalDokter as $jd )
        <div class="modal fade" id="modal-lg{{ $jd->id }}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('editJadwal', ['id'=>$jd->id]) }}">
                            @csrf
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dokter_id">Nama Dokter</label>
                                        <select class="form-control" name="dokter_id" id="dokter_id">
                                            @foreach ($dataDokter as $dd )
                                            <option @if($jd->dokter_id == $dd->id) selected @endif value="{{ $dd->id }}">{{ $dd->nama_dokter}}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="hari">hari</label>
                                        <select name="hari" id="hari" class="form-control">
                                            <option value="{{ $jd->hari }}" selected>{{ $jd->hari }}</option>
                                            <option value="Senin">Senin</option>
                                            <option value="Selasa">Selasa</option>
                                            <option value="Rabu">Rabu</option>
                                            <option value="Kamis">Kamis</option>
                                            <option value="jumat">jumat</option>
                                            <option value="Sabtu">Sabtu</option>
                                            <option value="Minggu">Minggu</option>
                                        </select>
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
                            </div>
                    </div>
                    <div class="modal-footer justify-content-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    </form>
                </div>

            </div>

        </div>
        @endforeach



    </div><!-- /.container-fluid -->
</div>
</div>
<!-- /.content-header -->
@endsection
