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
					<form method="POST" action="{{ route('penyakit.post') }}">
						@csrf
						{{ method_field('DELETE') }}
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="nama_penyakit">Nama Penyakit</label>
									<input type="text" class="form-control" id="nama_penyakit" name="nama_penyakit" placeholder="Nama Penyakit">
								</div>
							</div>
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
				<div class="card-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<td width="5%">No</td>
								<td>Nama Penyakit</td>
								<td width="15%">Aksi</td>
							</tr>
						</thead>
						<tbody>

							@foreach ($dataPenyakit as $i => $dp)
								<tr>
									<td>{{ $i + 1 }}</td>
									<td>{{ $dp->nama_penyakit }}</td>
									<td class="d-flex">
										<button type="button" class="btn btn-primary mr-2" data-toggle="modal"
											data-target="#modal-lg{{ $dp->id }}">Edit</button>
										<form action="hapuspenyakit/{{ $dp->id }}" method="POST">
											@method('DELETE')
											@csrf
											<button class="btn btn-danger" type="submit">Hapus</button>
										</form>
									</td>


								</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<td width="10%">No</td>
								<td>Nama Penyakit</td>
								<td width="15%">Aksi</td>
							</tr>
						</tfoot>
					</table>

				</div>
				<!-- /.card-body -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
		@foreach ($dataPenyakit as $dp)
			<div class="modal fade" id="modal-lg{{ $dp->id }}">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Edit Data</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="POST" action="{{ route('editPenyakit', ['id' => $dp->id]) }}">
								@csrf
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="nama_penyakit">Nama Penyakit</label>
											<input type="text" class="form-control" id="nama_penyakit" name="nama_penyakit"
												value="{{ $dp->nama_penyakit }}">
										</div>
									</div>

								</div>
						</div>
						<div class="modal-footer justify-content-right">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save changes</button>
						</div>
						</form>
					</div>

				</div>

			</div>
		@endforeach

	</div>
	</div>
	<!-- /.content-header -->
@endsection
