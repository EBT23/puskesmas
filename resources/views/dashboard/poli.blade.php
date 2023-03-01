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
			<div class="card shadow">
				<div class="card-header bg-success card-outline card-warning">
					<h3 class="card-title">Data Poli</h3>
				</div>
				<div class="card-header">
					<form action="{{ route('poli.post') }}" method="POST">
						@csrf
						<div class="form-group">
							<label for="kode_poli">Kode Poli</label>
							<input type="text" class="form-control" id="kode_poli" name="kode_poli" aria-describedby="kode_poli" required>
						</div>
						<div class="form-group">
							<label for="nama_poli">Nama Poli</label>
							<input type="text" class="form-control" id="nama_poli" name="nama_poli" aria-describedby="nama_poli" required>
						</div>
						<button type="submit" class="btn btn-outline-primary">Tambah</button>
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
								<th scope="col" width="15%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							@foreach ($poli as $p)
								<tr>
									<th scope="row" width="10%">{{ $no }}</th>
									<td>{{ $p->poli_code }}</td>
									<td>{{ $p->nama_poli }}</td>
									<td class="d-flex">
										<a class="btn btn-outline-primary mr-2" data-toggle="modal" data-target="#exampleModal1{{ $p->id }}"><i class="fas fa-pencil-alt"></i></a>

										<!-- Modal -->
										<div class="modal fade" id="exampleModal1{{ $p->id }}" tabindex="-1"
											aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header bg-success card-outline card-warning">
														<h5 class="modal-title" id="exampleModalLabel">Edit poli</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<form action="{{ route('poli.edit', ['id' => $p->id]) }}" method="POST">
															@csrf
															<div class="form-group">
																<label for="kode_poli">Kode Poli</label>
																<input type="text" class="form-control" id="kode_poli" value="{{ $p->poli_code }}" name="kode_poli"
																	aria-describedby="kode_poli" required>
															</div>
															<div class="form-group">
																<label for="nama_poli">Nama Poli</label>
																<input type="text" class="form-control" id="nama_poli" value="{{ $p->nama_poli }}" name="nama_poli"
																	aria-describedby="nama_poli" required>
															</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
														<button type="submit" class="btn btn-outline-primary">Simpan</button>
													</div>
													</form>
												</div>
											</div>
										</div>

										<form action="hapus_poli/{{ $p->id }}" method="POST">
											@method('DELETE')
											@csrf
											<button onclick="return confirm('Anda yakin akan menghapus ini? ')" class="btn btn-outline-danger"
												type="submit"><i class="fas fa-trash-alt"></i></button>
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
