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
                <form method="POST" action="{{ route('kajian_awal.post') }}">

                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status Di KK</label>
                                <select class="form-control" id="status" name="status">
                                    <option>Pilih Status</option>
                                    <option>Kepala Keluarga</option>
                                    <option>Suami</option>
                                    <option>Istri</option>
                                    <option>Anak</option>
                                    <option>orang Tua</option>
                                    <option>Menantu</option>
                                    <option>Pembantu</option>
                                    <option>Lain-lian</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="riwayat_penyakit_terdahulu">Riwayat Penyakit Terdahulu</label>
                                <input type="text" class="form-control" id="riwayat_penyakit_terdahulu" name="riwayat_penyakit_terdahulu" placeholder="Riwayat Penyakit Terdahulu">
                            </div>
                            <div class="form-group">
                                <label for="riwayat_penyakit_keluarga">Riwayat penyakit keluarga</label>
                                <input type="text" class="form-control" id="riwayat_penyakit_keluarga" name="riwayat_penyakit_keluarga" placeholder="Riwayat penyakit keluarga">
                            </div>
                            <div class="form-group">
                                <label for="pengkajian_psikologis">Pengkajian psikologis</label>
                                <input type="text" class="form-control" id="pengkajian_psikologis" name="pengkajian_psikologis" placeholder="Pengkajian psikologis">
                            </div>
                            <div class="form-group">
                                <label for="riwayat_gangguan_jiwa">Riwayat gangguan jiwa</label>
                                <input type="text" class="form-control" id="riwayat_gangguan_jiwa" name="riwayat_gangguan_jiwa" placeholder="Riwayat gangguan jiwa">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="keluarga_gangguan_jiwa">Ada keluarga yang gangguan jiwa</label>
                                <input type="text" class="form-control" id="keluarga_gangguan_jiwa" name="keluarga_gangguan_jiwa" placeholder="Ada keluarga yang gangguan jiwa">
                            </div>
                            <div class="form-group">
                                <label for="tinggal_dengan">Tinggal dengan</label>
                                <input type="text" class="form-control" id="tinggal_dengan" name="tinggal_dengan" placeholder="Tinggal dengan">
                            </div>
                            <div class="form-group">
                                <label for="hambatan_bahasa">Hambatan Bahasa</label>
                                <input type="text" class="form-control" id="hambatan_bahasa" name="hambatan_bahasa" placeholder="Hambatan Bahasa">
                            </div>
                            <div class="form-group">
                                <label for="hambatan_budaya">Hambatan Budaya</label>
                                <input type="text" class="form-control" id="hambatan_budaya" name="hambatan_budaya" placeholder="Hambatan Budaya">
                            </div>
                            <div class="form-group">
                                <label for="hambatan_mobilitas">Hambatan Mobilitas Fisik</label>
                                <input type="text" class="form-control" id="hambatan_mobilitas" name="hambatan_mobilitas" placeholder="Hambatan Mobilitas Fisik">
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
