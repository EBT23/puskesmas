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
            <div class="card-body" align="center">
                {{-- <p align="center"><b>Kartu Pasien</b></p> --}}
                <table class="table bg-gradient-white table-borderless table-white shadow p-3 mb-5 bg-white rounded" border="3" align="center" style="width: 60%">
                @forelse ($data->pasien as $item)
                    <tr>
                        <td colspan="3" align="center"><b>
                            PEMERINTAH KABUPATEN BANTUL <br>
                            KARTU PASIEN<br>
                            PUSKESMAS SEWON
                        </b>
                        </td>
                      </tr>
                    @foreach ($data->pasien as $item)
                        <tr>
                            <th style="width: 30%">NO RM</th>
                            <th>:</th>
                            <td>{{ $item->no_rm }}</td>
                        </tr>
                        <tr>
                            <th>NIK</th>
                            <th>:</th>
                            <td>{{ $item->nik }}</td>
                        </tr>
                        <tr>
                            <th>NAMA</th>
                            <th>:</th>
                            <td>{{ Auth::user()->full_name }}</td>
                        </tr>
                        <tr>
                            <th>TGL LAHIR</th>
                            <th>:</th>
                            <td>{{ $item->tgl_lahir }}&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<b>L/P</b></td>
                        </tr>
                        <tr>
                            <th>ALAMAT</th>
                            <th>:</th>
                            <td>{{ $item->alamat }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" align=" center"><b>KARTU INI HARUS DIBAWA TIAP BEROBAT</b></td>
                    </tr>
                    
                </table>
                <a class="btn btn-outline-info" href="{{ url('cetakKartu') }}" target="_blank" role="button"><i class="fas fa-print"></i> Cetak Kartu</a>
                    @empty
                    
                        <p class="px-4 py-3 bg-info text-white" align="center" >
                            <b>Kartu Berobat Belum Tersedia!</b>
                        </p>
                    
                    @endforelse
            </div>
        </div>
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
</div>
</div>
<!-- /.content-header -->

@endsection