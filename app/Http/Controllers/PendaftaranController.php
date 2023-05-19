<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use RealRashid\SweetAlert\Facades\Alert;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Symfony\Contracts\Service\Attribute\Required;

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

        $getUser = DB::select('SELECT * from users');
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
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream('kartu_pasien.pdf');
    }

    public function kajian_awal()
    {
        $data['title'] = 'kajian awal';
        return view('pendaftaran.kajian_awal', $data);
    }
    public function pendaftarExport()
    {
        $data['title'] = 'Pendaftar';
        $data['pendaftaran'] = DB::select('select p.*, u.full_name from pendaftaran p left join users u on p.id_user=u.id');
        return view('dashboard.pendaftarExport', $data);
    }
    public function cetakAll(Request $request)
    {
        // dd($request->all());
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()->setTitle('Pemeriksaan');
        $spreadsheet->getProperties()
            ->setCreator("'" . Auth::user()->username . "'")
            ->setLastModifiedBy("'" . Auth::user()->username . "'")
            ->setTitle("'" . Auth::user()->username . "'")
            ->setSubject("'" . Auth::user()->username . "'");
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Puskesmas')
        ->setCellValue('A2', 'Pemeriksaan: Dari Tanggal ' . $request->tanggal_awal . ' Sampai Tanggal ' . $request->tanggal_akhir . '')
            ->setCellValue('A3', 'Dicetak: ' . date('Y-m-d') . '');

        $getPemeriksaan = DB::select('select p.*, u.full_name from pendaftaran p left join users u on p.id_user=u.id where p.created_at BETWEEN "' .  $request->tanggal_awal . '" and "' . $request->tanggal_akhir . '"');
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A5', 'Nama Lengkap');
        $sheet->setCellValue('B5', 'Nik');
        $sheet->setCellValue('C5', 'Tanggal Lahir');
        $sheet->setCellValue('D5', 'Tempat Lahir');
        $sheet->setCellValue('E5', 'Alamat');
        $sheet->setCellValue('F5', 'Jenis Kelamin');
        $rows = 6;
        // dd($getPemeriksaan);
        foreach ($getPemeriksaan as $pemDetails) {
            $sheet->setCellValue('A' . $rows, $pemDetails->full_name);
            $sheet->setCellValue('B' . $rows, $pemDetails->nik);
            $sheet->setCellValue('C' . $rows, $pemDetails->tgl_lahir);
            $sheet->setCellValue('D' . $rows, $pemDetails->tempat_lahir);
            $sheet->setCellValue('E' . $rows, $pemDetails->alamat);
            $sheet->setCellValue('F' . $rows, $pemDetails->jk);
            $rows++;
        }
        $Sheet = $spreadsheet->getActiveSheet();
        $lABC1 = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
        $lABC2 = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

        for (
            $I = 0;
            $I < count($lABC1);
            $I++
        ) :
            $Sheet->getColumnDimension($lABC1[$I])->setAutoSize(true);
            for ($J = 0; $J < 6; $J++) {
                $Sheet->getColumnDimension($lABC2[$J] . $lABC1[$I])->setAutoSize(true);
            }
        endfor;
        $spreadsheet->getActiveSheet()->calculateColumnWidths();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Pemeriksaan_Tanggal ' . $request->tanggal_awal . ' Sampai Tanggal ' . $request->tanggal_akhir . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        // $writer->save('php://output');


        ob_start();
        $writer->save("php://output");
        $xlsData = ob_get_contents();
        ob_end_clean();

        $response =  array(
            'op' => 'ok',
            'file' => "data:application/vnd.ms-excel;base64," . base64_encode($xlsData)
        );
        // dd(response());
        die(json_encode($response));
    }
    public function cetakExcelRow($id)
    {
        $getName =
            DB::select('SELECT p.*, u.full_name from pendaftaran p left join users u on p.id_pendaftaran=u.id where p.id_pendaftaran = "' . $id . '"');
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()->setTitle('Pemeriksaan');
        $spreadsheet->getProperties()
            ->setCreator("'" . Auth::user()->username . "'")
            ->setLastModifiedBy("'" . Auth::user()->username . "'")
            ->setTitle("'" . Auth::user()->username . "'")
            ->setSubject("'" . Auth::user()->username . "'");
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Puskesmas')
        ->setCellValue('A2', 'Pemeriksaan: ' . $getName[0]->full_name . '')
            ->setCellValue('A3', 'Dicetak: ' . date('Y-m-d') . '');

        $getPemeriksaan = DB::select('select p.*, u.full_name from pendaftaran p left join users u on p.id_user=u.id where p.id_pendaftaran = "' . $id . '"');
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A5', 'Nama Lengkap');
        $sheet->setCellValue('B5', 'Nik');
        $sheet->setCellValue('C5', 'Tanggal Lahir');
        $sheet->setCellValue('D5', 'Tempat Lahir');
        $sheet->setCellValue('E5', 'Alamat');
        $sheet->setCellValue('F5', 'Jenis Kelamin');
        $rows = 6;
        // dd($getPemeriksaan);
        foreach ($getPemeriksaan as $pemDetails) {
            $sheet->setCellValue('A' . $rows, $pemDetails->full_name);
            $sheet->setCellValue('B' . $rows, $pemDetails->nik);
            $sheet->setCellValue('C' . $rows, $pemDetails->tgl_lahir);
            $sheet->setCellValue('D' . $rows, $pemDetails->tempat_lahir);
            $sheet->setCellValue('E' . $rows, $pemDetails->alamat);
            $sheet->setCellValue('F' . $rows, $pemDetails->jk);
            $rows++;
        }
        $Sheet = $spreadsheet->getActiveSheet();
        $lABC1 = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
        $lABC2 = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

        for (
            $I = 0;
            $I < count($lABC1);
            $I++
        ) :
            $Sheet->getColumnDimension($lABC1[$I])->setAutoSize(true);
            for ($J = 0; $J < 6; $J++) {
                $Sheet->getColumnDimension($lABC2[$J] . $lABC1[$I])->setAutoSize(true);
            }
        endfor;
        $spreadsheet->getActiveSheet()->calculateColumnWidths();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Pemeriksaan_' . $getName[0]->full_name . '_' . date('Y-m-d') . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
    public function cetakAllPdf(Request $request)
    {
        $pendaftaran = DB::select('select p.*, u.full_name from pendaftaran p left join users u on p.id_user=u.id where p.created_at BETWEEN "' .  $request->tanggal_awal . '" and "' . $request->tanggal_akhir . '"');
        $data = [
            'title' => 'Welcome to Puskesmas',
            'date' => date('m/d/Y'),
            'pendaftaran' => $pendaftaran
        ];
        $pdf = PDF::loadView('dashboard.exportPdfPendaftaran', $data);
        $fileName =  'pendaftaran.pdf';
        $pdf->save(public_path() . '/storage/pdf/' . $fileName);
        $pdf = public_path() . '/storage/pdf/' . $fileName;
        return response()->download($pdf);
    }
}
