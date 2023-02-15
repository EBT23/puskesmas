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
                @foreach ($dataAdmin as $da )
                <form method="POST" action="{{ route('editProfilAdmin',['id'=>$da->id]) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ $da->full_name }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $da->email }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                @endforeach
            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->

</div>
</div>
<!-- /.content-header -->
@endsection
