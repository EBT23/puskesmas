@extends('layouts.base', ['title' => "$title - Pasien"])

@section('content')
    @include('sweetalert::alert')
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
            <div class="card shadow">
                <div class="card-header bg-success card-outline card-warning">
                    <h3 class="card-title">Data {{ $title }}</h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body" style="height: auto; ">
                    <div class="row">
                        @foreach ($poli as $po)
                            <form method="POST" action="{{ route('noAntrian.add') }}">
                                @csrf
                                <div class="card text-white bg-dark mb-3" style="max-width: auto; margin-right: 30px;">
                                    <input type="text" name="nama_poli" value="{{ $po->nama_poli }}" hidden>
                                    <input type="text" name="id_poli" value="{{ $po->id }}" hidden>
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-secondary btn-lg"
                                            style="font-size: 300%; width: 400px;
height: 180px;"><i class="fa fa-link"></i>
                                            <br>{{ $po->nama_poli }}</button>
                                    </div>
                                </div>
                                {{-- <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-8">
                                            <input type="text" name="nama_poli" value="{{ $po->nama_poli }}" hidden>
                                            <input type="text" name="id_poli" value="{{ $po->id }}" hidden>
                                            <button type="submit" class="btn btn-secondary btn-lg"
                                                style="font-size: 300%; "><i class="fa fa-link"></i>
                                                <br>{{ $po->nama_poli }}</button>
                                        </div>
                                    </div>
                                </div> --}}
                            </form>
                        @endforeach
                    </div>
                </div>
                <!-- /.card-body -->
            </div><!-- /.row -->
            <section class="content">
                <!-- Default box -->
                <div class="card shadow card-solid">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($antrian as $ant)
                                <div class="col-md-12 d-flex align-items-stretch flex-column">
                                    <div class="card bg-light d-flex flex-fill">
                                        <div class="card-header text-muted border-bottom-0">
                                            <h1>Poli {{ $ant->nama_poli }}</h1>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h4>Nama:</h4>
                                                    <h1 class="lead"><b>{{ $ant->full_name }}</b></h1>
                                                    <p class="text-muted text-sm"><b>Waktu: </b> {{ $ant->created_at }} </p>

                                                </div>
                                                <div class="col-5 text-center">
                                                    <h1>Nomor Antrian</h1>
                                                    <h2 style="font-size: 500%;">{{ $ant->antrian }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-right">
                                                <a href="/cetakAntrian/{{ $ant->id_antrian }}" target="_blank"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fas fa-print"></i> Cetak
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </div><!-- /.container-fluid -->


    </div>
    <!-- /.content-header -->
@endsection
