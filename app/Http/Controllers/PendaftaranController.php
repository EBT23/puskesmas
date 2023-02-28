<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Contracts\Service\Attribute\Required;
use Barryvdh\DomPDF\Facade\Pdf;
use RealRashid\SweetAlert\Facades\Alert;

class PendaftaranController extends Controller
{

    public function index()
    {

        $data['title'] = 'Pendaftaran';
        return view('pendaftaran.index', $data);
    }

    public function pendaftaran_action(Request $request)
    {

        $user = Auth::user()->id;

        $request->validate([
            'nama' => 'required',
            'nik' => 'required',
            'tgl_lahir' => 'required',
            'tempat_lahir' => 'required',
            'alamat' => 'required',
            'nama_kk' => 'required',
            'jk' => 'required',
            'status' => 'required',
            'agama' => 'required',
            'no_telp' => 'required',
            'pekerjaan' => 'required',
            'pendidikan_terakhir' => 'required',
            'jaminan_asuransi' => 'required',
            'no_jaminan' => 'required',
        ]);

        Pendaftaran::create([
            'id_user' => $user,
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tgl_lahir' => $request->tgl_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'alamat' => $request->alamat,
            'nama_kk' => $request->nama_kk,
            'jk' => $request->jk,
            'status' => $request->status,
            'agama' => $request->agama,
            'no_telp' => $request->no_telp,
            'pekerjaan' => $request->pekerjaan,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'jaminan_asuransi' => $request->jaminan_asuransi,
            'no_jaminan' => $request->no_jaminan,
            'no_rm' =>  'RM' . rand(100000, 99999),
            'created_at' => now()
        ]);

        $data['title'] = 'Kartu Pasien';
        return view('pendaftaran/kartuPasien', $data)->with('success', 'Task Created Successfully!');
    }

    public function kartuPasien()
    {
        $user = auth()->id();
        $getKartu = Pendaftaran::where('id_user', $user)->get();

        return view('pendaftaran/kartuPasien', [
            'title' => 'Kartu Pasien',
            'data' => (object) [
                'pasien' => $getKartu

            ],
        ]);
    }

    public function cetakPDF()
    {
        $user = auth()->id();
        $getPDF = Pendaftaran::where('id_user', $user)->get();

        $pdf = Pdf::loadView('pendaftaran/cetakPDF', ['cetakPDF' => $getPDF]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('kartu_pasien.pdf');
    }

    public function kajian_awal()
    {

        $data['title'] = 'kajian awal';
        return view('pendaftaran.kajian_awal', $data);
    }

    function kajianawalPost(Request $request)
    {

        $data = [
            'id_user' => Auth::user()->id,
            'status' => $request->status,
            'riwayat_penyakit_terdahulu' => $request->riwayat_penyakit_terdahulu,
            'riwayat_penyakit_keluarga' => $request->riwayat_penyakit_keluarga,
            'pengkajian_psikologis' => $request->pengkajian_psikologis,
            'riwayat_gangguan_jiwa' => $request->riwayat_gangguan_jiwa,
            'keluarga_gangguan_jiwa' => $request->keluarga_gangguan_jiwa,
            'tinggal_dengan' => $request->tinggal_dengan,
            'hambatan_bahasa' => $request->hambatan_bahasa,
            'hambatan_budaya' => $request->hambatan_budaya,
            'hambatan_mobilitas' => $request->hambatan_mobilitas,
            'date_created' => now(),
            'update_created' => now(),
        ];
        // dd($data);
        DB::table('kajian_awal')->insert($data);
        Alert::success('Success', 'Pengisian kajian awal!');
        return redirect()->route('kajian_awal');
    }
}
