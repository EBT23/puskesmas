@extends('layouts.base', ['title' => "$title"])

@section('content')
@include('sweetalert::alert')
@if ($errors->any())
@foreach ($errors->all() as $err)
    <p class="alert alert-danger">{{ $err }}</p>
@endforeach
@endif
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
					<h3 class="card-title">Data Jadwal Dokter</h3>
				</div>
				<!-- /.card-header -->
				<div class="card-body col-lg">
					<div>

						@if (session()->has('message'))
							<div class="alert alert-success alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h5><i class="icon fas fa-check"></i> Berhasil!</h5>
								Profil Anda Berhasil diperbaharui..
							</div>
						@endif

					</div>
					<form method="POST" action="{{ route('editProfilAdmin') }}">
						@csrf
						@method('put')
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="full_name">Nama</label>
									<input type="text" class="form-control" id="full_name" name="full_name"
										value="{{ old('full_name', Auth::user()->full_name) }}">
									@error('full_name')
										<div>{{ $message }}</div>
									@enderror
								</div>
								<div class="form-group">
									<label for="email">Email</label>
									<input type="email" class="form-control" id="email" name="email"
										value="{{ old('email', Auth::user()->email) }}">
									@error('email')
										<div>{{ $message }}</div>
									@enderror
								</div>
							</div>
						</div>
						<button type="submit" class="btn btn-outline-primary">Simpan</button>
					</form>
				</div>
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->

	</div>
	</div>
	<!-- /.content-header -->
@endsection
