{{-- @extends('layouts.base', ['title' => "Kartu - Pasien"])

@section('content') --}}
<div class="content-header">
    <div class="container-fluid">
        <div class="form group">
            <div class="card-body row">
                <span align="center" style="position: relative; z-index: 1; top: 0px;">
                    <img src="assets/dist/img/kartu-1.jpg" alt="image" width="700px">
                </span>
                <br>
                <div class="row" style="position: relative; top: -270px; z-index: 2;color: #000000; margin-left: 20px; ">
                    @foreach ($cetakPDF as $item)
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
                                <td style=" padding: 10px; width: 90%;">{{ $item->nik }} </td>
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
        </div>
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
</div>
</div>
<!-- /.content-header -->
{{-- 
@endsection --}}