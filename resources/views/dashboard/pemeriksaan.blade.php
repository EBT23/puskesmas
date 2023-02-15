@extends('layouts.base', ['title' => " $title - Pasien"])


@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $title }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div><!-- /.col -->
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pemeriksaan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="POST" action="{{ route('pemeriksaan.Post') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_user">Nama Pasien</label>
                                <select class="form-control" id="id_user" name="id_user">
                                    <option>-pilih-</option>
                                    @foreach ($dataPasien as $dapa )
                                    <option value="{{ $dapa->id }}">{{ $dapa->full_name }}</option>

                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="id_kajian">Kajian Awal</label>
                                <select class="form-control" id="id_kajian" name="id_kajian">
                                    <option>-pilih-</option>
                                    @foreach ($dataKajian as $dk )
                                    <option value="{{ $dk->id }}">{{ $dk->id }}</option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_tujuan">Tujuan Pemeriksaan</label>
                                <select class="form-control" id="id_tujuan" name="id_tujuan">
                                    <option>-pilih-</option>
                                    @foreach ($dataTujuan as $dt )
                                    <option value="{{ $dt->id }}">{{ $dt->id }}</option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_get_antrian">Data Antrian</label>
                                <select class="form-control" id="id_get_antrian" name="id_get_antrian">
                                    <option>-pilih-</option>
                                    @foreach ($dataAntrian as $da )
                                    <option value="{{ $da->id }}">{{ $da->id }}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_dokter">Data Dokter</label>
                                <select class="form-control" id="id_dokter" name="id_dokter">
                                    <option>-pilih-</option>
                                    @foreach ($dataDokter as $dd)
                                    <option value="{{ $dd->id }}">{{ $dd->nama_dokter }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_penyakit">Data Penyakit</label>
                                <select class="form-control" id="id_penyakit" name="id_penyakit">
                                    <option>-pilih-</option>
                                    @foreach ($dataPenyakit as $dp )
                                    <option value="{{ $dp->id }}">{{ $dp->nama_penyakit }}</option>

                                    @endforeach
                                </select>
                            </div>
                            <div class=" form-group">
                                <label for="id_obat">Data Obat</label>
                                <select class="form-control" id="id_obat" name="id_obat">
                                    <option>-pilih-</option>
                                    @foreach ($dataObat as $do )
                                    <option value="{{ $do->id }}">{{ $do->nama_obat }}</option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tgl_diperiksa">Tanggal Diperiksa</label>
                                <input type="date" class="form-control" id="tgl_diperiksa" name="tgl_diperiksa" placeholder="Tanggal Diperiksa">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <hr>
            {{-- <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <td width="10%">No</td>
                            <td>Nama Penyakit</td>
                            <td width="15%">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($dataPenyakit as $i => $dp )

                        <tr>
                            <td>{{ $i+1 }}</td>
            <td>{{ $dp->nama_penyakit }}</td>
            <td class="d-flex">
                <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#modal-lg{{ $dp->id }}">Edit</button>
                <form action="hapuspenyakit/{{$dp->id }}" method="POST">
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
                    <td width="10%">No</td>
                    <td>Nama Penyakit</td>
                    <td width="15%">Aksi</td>
                </tr>
            </tfoot>
            </table>

            </div> --}}




        </div><!-- /.row -->




    </div><!-- /.container-fluid -->
</div>
</div>
<!-- /.content-header -->
@endsection
