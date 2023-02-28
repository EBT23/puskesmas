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
}
