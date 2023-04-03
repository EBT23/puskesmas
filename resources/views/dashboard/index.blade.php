@extends('layouts.base', ['title' => 'Dashboard - Administrator - Laravel 9'])

@section('content')
    @include('layouts.header', ['title' => 'Dashboard', 'action' => 'Dashboard'])

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info" align="center">
                        <div class="inner">
                            <h1>{{ $dokter->count() }}</h1>
                            <hr>
                            <h4>Jumlah Dokter</h4>
                        </div>
                   </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-cyan " align="center">
                        <div class="inner">
                            <h1>{{ $pemeriksaan->count() }}</h1>
                            <hr>
                            <h4>Jumlah Pemeriksaan</h4>
                        </div>
                   </div>
                </div>
              
            </div>
          </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
