@extends('layouts.base', ['title' => "$title - Admin"])

@section('content')
@include('sweetalert::alert')
@if ($errors->any())
@foreach ($errors->all() as $err)
    <p class="alert alert-danger">{{ $err }}</p>
@endforeach
@endif
	<div class="content-header">
		<div class="container-fluid">
			{{-- @if (Session::has('success'))
				<div class="alert alert-success">
					{{ Session::get('success') }}
				</div>
			@endif --}}
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
								<input type="text" class="form-control" id="nama_dokter" name="nama_dokter" aria-describedby="nama_dokter"
									required>
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
								<input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" aria-describedby="tempat_lahir"
									required>
							</div>
							<div class="form-group col-sm-6">
								<label for="tanggal_lahir">Tanggal Lahir</label>
								<input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
									aria-describedby="tanggal_lahir" required>
							</div>
							<div class="form-group col-sm-6">
								<label for="no_telepon">No Telepon</label>
								<input type="text" class="form-control" id="no_telepon" name="no_telepon" aria-describedby="no_telepon"
									required>
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
								<th scope="col" class="10%">#</th>
								<th scope="col">Nama Dokter</th>
								<th scope="col">Poli</th>
								<th scope="col">Alamat</th>
								<th scope="col">Tempat Lahir</th>
								<th scope="col">Tanggal Lahir</th>
								<th scope="col">No Telepon</th>
								<th scope="col">Jenis Kelamin</th>
								<th scope="col" width="15%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							@foreach ($dokter as $d)
								<tr>
									<th scope="row">{{ $no }}</th>
									<td>{{ $d->nama_dokter }}</td>
									<td>{{ $d->nama_poli }}</td>
									<td>{{ $d->alamat }}</td>
									<td>{{ $d->tempat_lahir }}</td>
									<td>{{ $d->tgl_lahir }}</td>
									<td>{{ $d->no_telp }}</td>
									<td>{{ $d->jk }}</td>
									<td class="d-flex">
										<a class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal1{{ $d->id }}">Edit</a>

										<!-- Modal -->
										<div class="modal fade" id="exampleModal1{{ $d->id }}" tabindex="-1"
											aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Edit dokter</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<form action="{{ route('dokter.edit', ['id' => $d->id]) }}" method="POST">
															@csrf
															<div class="row">
																<div class="form-group col-sm-6">
																	<label for="nama_dokter">Nama Dokter</label>
																	<input type="text" class="form-control" value="{{ $d->nama_dokter }}" id="nama_dokter"
																		name="nama_dokter" aria-describedby="nama_dokter" required>
																</div>
																<div class="form-group col-sm-6">
																	<label for="poli">Poli</label>
																	<select class="form-control" id="poli" name="poli" required>
																		<option value="" disabled selected>Pilih Poli
																		</option>
																		@foreach ($poli as $p)
																			<option value="{{ $p->id }}">
																				{{ $p->nama_poli }}</option>
																		@endforeach
																	</select>
																</div>
																<div class="form-group col-sm-6">
																	<label for="alamat">Alamat</label>
																	<textarea class="form-control" name="alamat" id="alamat">{{ $d->alamat }}</textarea>
																</div>
																<div class="form-group col-sm-6">
																	<label for="tempat_lahir">Tempat Lahir</label>
																	<input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
																		value="{{ $d->tempat_lahir }}" aria-describedby="tempat_lahir" required>
																</div>
																<div class="form-group col-sm-6">
																	<label for="tanggal_lahir">Tanggal Lahir</label>
																	<input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
																		value="{{ $d->tgl_lahir }}" aria-describedby="tanggal_lahir" required>
																</div>
																<div class="form-group col-sm-6">
																	<label for="no_telepon">No Telepon</label>
																	<input type="text" class="form-control" id="no_telepon" name="no_telepon"
																		value="{{ $d->no_telp }}" aria-describedby="no_telepon" required>
																</div>
																<div class="form-group col-sm-6">
																	<label for="jenis_kelamin">Jenis Kelamin</label>
																	<select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
																		<option value="" selected disabled>Pilih
																			Jenis Kelamin</option>
																		<option value="Laki-laki">Laki-laki</option>
																		<option value="Perempuan">Perempuan</option>
																	</select>
																</div>
															</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
														<button type="submit" class="btn btn-primary">Save
															changes</button>
													</div>
													</form>
												</div>
											</div>
										</div>

										<form action="hapus_dokter/{{ $d->id }}" method="POST">
											@method('DELETE')
											@csrf
											<button onclick="return confirm('Anda yakin akan menghapus ini? ')" class="btn btn-danger"
												type="submit">Hapus</button>
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
