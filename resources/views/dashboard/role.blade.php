@extends('layouts.base', ['title' => "$title - Admin"])

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
                <h3 class="card-title">Data Role</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body col-lg">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Role</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; ?>
                    @foreach ( $role as  $r)                            
                      <tr>
                        <th scope="row">{{ $no }}</th>
                        <td>{{ $r->nama_role }}</td>
                        <td>
                            <span class="badge badge-pill badge-warning">Edit</span>
                            <span class="badge badge-pill badge-danger">Hapus</span>
                        </td>
                      </tr>
                      <?php $no++; ?>
                      @endforeach
                    </tbody>
                  </table>
            </div>
            <!-- /.card-body -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
</div>
<!-- /.content-header -->
@endsection
