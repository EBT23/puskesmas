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
                <h3 class="card-title">Data Jadwal Dokter</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body col-lg">
                <form method="POST" action="{{ route('jadwal.post') }}">
                    @csrf
                    <div class="form-group">
                        <label for="dokter_id">Nama Dokter</label>
                        <input type="text" class="form-control" id="dokter_id" name="dokter_id" placeholder="Nama Dokter">
                    </div>
                    <div class="form-group">
                        <label for="hari">hari</label>
                        <input type="date" class="form-control" id="hari" name="hari" placeholder="Hari">
                    </div>
                    <div class="form-group">
                        <label for="dari_jam">Dari Jam </label>
                        <input type="time" class="form-control" id="dari_jam" name="dari_jam" placeholder="Dari Jam">
                    </div>
                    <div class="form-group">
                        <label for="sampai_jam">Sampai Jam</label>
                        <input type="time" class="form-control" id="sampai_jam" name="sampai_jam" placeholder="Sampia Jam">
                    </div>
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
