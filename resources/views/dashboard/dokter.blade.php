@extends('layouts.base', ['title' => "$title - Admin"])

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
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
                    <h3 class="card-title">Data Dokter</h3>
                </div>
                <div class="card-header">
                    <form action="{{ route('dokter.post') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="nama_dokter">Nama Dokter</label>
                                <input type="text" class="form-control" id="nama_dokter" name="nama_dokter"
                                    aria-describedby="nama_dokter" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="poli">Poli</label>
                                <select class="form-control" id="poli" name="poli" required>
                                    <option value="" disabled selected>Pilih Poli</option>
                                    @foreach ($poli as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama_poli }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" name="alamat" id="alamat"></textarea>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                    aria-describedby="tempat_lahir" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                    aria-describedby="tanggal_lahir" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="no_telepon">No Telepon</label>
                                <input type="text" class="form-control" id="no_telepon" name="no_telepon"
                                    aria-describedby="no_telepon" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                    <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
                <!-- /.card-header -->
                <div class="card-body col-lg">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kode Poli</th>
                                <th scope="col">Nama Poli</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($poli as $p)
                                <tr>
                                    <th scope="row">{{ $no }}</th>
                                    <td>{{ $p->poli_code }}</td>
                                    <td>{{ $p->nama_poli }}</td>
                                    <td>
                                        <a class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModal1{{ $p->id }}">Edit</a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal1{{ $p->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit poli</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('poli.edit', ['id' => $p->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="kode_poli">Kode Poli</label>
                                                                <input type="text" class="form-control" id="kode_poli"
                                                                    value="{{ $p->poli_code }}" name="kode_poli"
                                                                    aria-describedby="kode_poli">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nama_poli">Nama Poli</label>
                                                                <input type="text" class="form-control" id="nama_poli"
                                                                    value="{{ $p->nama_poli }}" name="nama_poli"
                                                                    aria-describedby="nama_poli">
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <form action="hapus_poli/{{ $p->id }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Anda yakin akan menghapus ini? ')"
                                                class="btn btn-danger" type="submit">Hapus</button>
                                        </form>
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
