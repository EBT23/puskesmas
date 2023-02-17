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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data {{ $title }}</h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body" style="height: 120px; ">

                    <div class="row">

                        @foreach ($poli as $po)
                            <form method="POST" action="{{ route('noAntrian.add') }}">
                                @csrf
                                <div class="col-md-3" >
                                    <input type="text" name="nama_poli" value="{{ $po->nama_poli }}" hidden>
                                    <input type="text" name="id_poli" value="{{ $po->id }}" hidden>
                                    <button type="submit" class="btn btn-secondary"
                                        style="font-size: 200%; ">{{ $po->nama_poli }}</button>

                                </div>
                            </form>
                        @endforeach

                    </div>

                </div>

                <!-- /.card-body -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->


    </div>
    <!-- /.content-header -->
@endsection
