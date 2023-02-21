@extends('layouts.base', ['title' => "$title - Pasien"])

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
                <h3 class="card-title">Data Pasien</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body col-lg">
                <form method="POST" action="{{ route('pendaftaran') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" id="nama" name="nama" placeholder="Nama Lengkap">
                                @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" id="nik" name="nik" placeholder="NIK">
                                @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir') }}" id="tgl_lahir" name="tgl_lahir" placeholder="Tanggal Lahir">
                                @error('tgl_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir">
                                @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}" id="alamat" name="alamat" placeholder="Alamat">
                                @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama_kk">Nama Kepala Keluarga</label>
                                <input type="text" class="form-control @error('nama_kk') is-invalid @enderror" value="{{ old('nama_kk') }}" id="nama_kk" name="nama_kk" placeholder="Nama Kepala Keluarga">
                                @error('nama_kk')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jk">Jenis Kelamin</label>
                                <select class="form-control "  id="jk" name="jk">
                                    <option>Jenis Kelamin</option>
                                    <option>Laki-laki</option>
                                    <option>Perempuan</option>
                                </select>
                               
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status Perkawinan</label>
                                <select class="form-control "  id="status" name="status">
                                    <option>Status</option>
                                    <option>Belum Kawin</option>
                                    <option>Kawin</option>
                                    <option>Cerai Hidup</option>
                                    <option>Cerai Mati</option>
                                </select>
                               
                            </div>
                            <div class="form-group">
                                <label for="agama">Agama</label>
                                <select class="form-control" id="agama" name="agama">
                                    <option>Pilih Agama</option>
                                    <option>Budha</option>
                                    <option>Hindu</option>
                                    <option>Islam</option>
                                    <option>Kristen</option>
                                    <option>Katolik</option>
                                    <option>Konghucu</option>
                                </select>
                               
                            </div>
                            <div class="form-group">
                                <label for="no_telp">No Telepon</label>
                                <input type="text" class="form-control @error('no_telp') is-invalid @enderror" value="{{ old('no_telp') }}" id="no_telp" name="no_telp" placeholder="No Telepon">
                                @error('no_telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan">Pekerjaan</label>
                                <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" value="{{ old('pekerjaan') }}" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan">
                                @error('pekerjaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                <input type="text" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" value="{{ old('pendidikan_terakhir') }}" id="pendidikan_terakhir" name="pendidikan_terakhir" placeholder="Pendidikan Terakhir">
                                @error('pendidikan_terakhir')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jaminan_asuransi">Jaminan Asuransi</label>
                                <select class="form-control "  id="jaminan_asuransi" name="jaminan_asuransi">
                                    <option>Pilih Asuransi</option>
                                    <option>BPJS</option>
                                    <option>JKN</option>
                                    <option>Jamkesda</option>
                                    <option>Jamkesos</option>
                                    <option>Tidak Ada</option>
                                </select>
                               
                            </div>
                            <div class="form-group">
                                <label for="no_jaminan">No Jaminan</label>
                                <input type="text" class="form-control @error('no_jaminan') is-invalid @enderror" value="{{ old('no_jaminan') }}" id="no_jaminan" name="no_asuransi" placeholder="No Jaminan">
                                @error('no_jaminan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-check">
                              <input type="checkbox" class="form-check-input" id="exampleCheck1">
                              <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div> --}}
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <!-- /.card-body -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
</div>
<!-- /.content-header -->
@endsection
