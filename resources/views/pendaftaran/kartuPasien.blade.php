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
			<div class="form group">
				<div class="text-left ml-3">
					<a href="{{ url('cetakKartu') }}" target="_blank" class="btn btn-primary">
						<i class="fas fa-print"></i> Cetak
					</a>
				</div>
				<div class="card-body row">
					<span align="center" style="position: relative; z-index: 1; top: 0px;">
						<img src="{{ asset('assets/dist/img/kartu-1.jpg') }}">
					</span>
					<div class="row" style="position: relative; top: -270px; z-index: 2;color: #000000; margin-left: 20px; ">
						@foreach ($data->pasien as $item)
						<span>
							<table style="  font-size: 18px;">
								<tr style=" padding: 10px;">
									<th style=" padding: 10px;">No RM</th>
									<td style=" padding: 10px;">:</td>
									<td style=" padding: 10px; width: 90%;">{{ $item->no_rm }}</td>
								</tr>
								<tr style=" padding: 10px;">
									<th style=" padding: 10px;">Nama</th>
									<td style=" padding: 10px;">:</td>
									<td style=" padding: 10px; width: 90%;">{{ Auth::user()->full_name }}</td>
								</tr>
								<tr style=" padding: 10px;">
									<th style=" padding: 10px;">NIK</th>
									<td style=" padding: 10px;">:</td>
									<td style=" padding: 10px; width: 90%;">{{ $item->nik }}</td>
								</tr>
								<tr style=" padding: 10px;">
									<th style=" padding: 10px;">Alamat</th>
									<td style=" padding: 10px;">:</td>
									<td style=" padding: 10px; width: 200%;">{{ $item->alamat }}</td>
								</tr>	
							</table>
						</span>
						@endforeach
					</div>
					
					
				</div>
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	</div>
	<!-- /.content-header -->
@endsection
