{{-- @extends('layouts.base', ['title' => "Kartu - Pasien"])

@section('content') --}}
<div class="content-header">
    <div class="container-fluid">
        {{-- <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $title }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div>
            
        </div> --}}
        <div class="form group">
            <div class="card-body" align="center">
                <table class="table bg-gradient-white table-borderless table-white shadow p-3 mb-5 bg-white rounded" border="1" align="center" style="width: 70%">
                    <tr>
                        <td colspan="3" align="center"><b>
                            PEMERINTAH KABUPATEN BANTUL <br>
                            KARTU PASIEN<br>
                            PUSKESMAS SEWON
                        </b>
                        </td>
                      </tr>
                    @foreach ($cetakPDF as $item)
                        <tr>
                            <th style="width: 30%" align="left">NO RM</th>
                            <th style="width: 1%" align="left">:</th>
                            <td>{{ $item->no_rm }}</td>
                        </tr>
                        <tr>
                            <th style="width: 30%" align="left">NIK</th>
                            <th style="width: 1%" align="left">:</th>
                            <td>{{ $item->nik }}</td>
                        </tr>
                        <tr>
                            <th style="width: 30%" align="left">NAMA</th>
                            <th style="width: 1%" align="left">:</th>
                            <td>{{ Auth::user()->full_name }}</td>
                        </tr>
                        <tr>
                            <th style="width: 30%" align="left">TGL LAHIR</th>
                            <th style="width: 1%" align="left">:</th>
                            <td>{{ $item->tgl_lahir }}&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<b>L/P</b></td>
                        </tr>
                        <tr>
                            <th style="width: 30%" align="left">ALAMAT</th>
                            <th style="width: 1%" align="left">:</th>
                            <td>{{ $item->alamat }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" align=" center"><b>KARTU INI HARUS DIBAWA TIAP BEROBAT</b></td>
                    </tr>
                </table>
            </div>
        </div>
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
</div>
</div>
<!-- /.content-header -->
{{-- 
@endsection --}}