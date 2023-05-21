<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use NunoMaduro\Collision\Writer;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use RealRashid\SweetAlert\Facades\Alert;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PemeriksaanController extends Controller
{
    public function pemeriksaan()
    {
        $data['title'] = 'Pemeriksaan';
        $dataAdmin = DB::select('SELECT * from users WHERE role_id=1;');
        $dataPasien = DB::select('SELECT * FROM users WHERE role_id=2;');
        $dataDokter = DB::table('dokter')->get();
        $dataKajian = DB::table('kajian_awal')->get();
        $dataPenyakit = DB::table('penyakit')->get();
        $dataObat = DB::table('obat')->get();
        $dataTujuan = DB::table('pemeriksaan')->get();
        $dataAntrian = DB::table('antrian')->get();
        return view('dashboard.pemeriksaan', [
            'dataPasien' => $dataPasien,
            'dataDokter' => $dataDokter,
            'dataKajian' => $dataKajian,
            'dataPenyakit' => $dataPenyakit,
            'dataObat' => $dataObat,
            'dataTujuan' => $dataTujuan,
            'dataAntrian' => $dataAntrian,
        ], $data);
    }
    function addKajianAwal($id_user)
    {
        $query = DB::table('kajian_awal')->where('id_user', $id_user)->get();
        $data = "<option value=''> - Pilih Kajian - </option>";
        foreach ($query as $value) {
            $data .= "<option value='" . $value->id . "'>" . $value->id . "</option>";
        }
        return response()->json(['data' => $data]);
    }
    function addTujuanPemeriksaan($id_user)
    {
        $query = DB::table('tujuan_pemeriksaan')->where('user_id', $id_user)->get();
        $data = "<option value=''> - Pilih Tujuan Pemeriksaan - </option>";
        foreach ($query as $value) {
            $data .= "<option value='" . $value->id . "'>" . $value->id . "</option>";
        }
        return response()->json(['data' => $data]);
    }
    function addAntrian($id_user)
    {
        $query = DB::select("select a.*, p.nama_poli from antrian a left join poli p on a.id_poli=p.id where id_user = " . $id_user . " and created_at like '%" . date('Y-m-d') . "%'");
        // dd($query);
        $data = "<option value=''> - Pilih Antrian - </option>";
        foreach ($query as $value) {
            $data .= "<option value='" . $value->id . "'>Nomor Antrian " . $value->antrian . "</p> | Poli " . $value->nama_poli . "</option>";
        }
        return response()->json(['data' => $data]);
    }

    function pemeriksaanPost(Request $request)
    {
        $data = [
            'id_user' => $request->id_user,

            'id_get_antrian' => $request->id_get_antrian,
            'id_dokter' => $request->id_dokter,
            'penyakit' => json_encode($request->penyakit),
            'obat' => json_encode($request->obat),
            'tgl_diperiksa' => $request->tgl_diperiksa,
            'date_created' => date('Y-m-d'),
            'update_created' => date('Y-m-d'),
        ];
        DB::table('pemeriksaan')->insert($data);
        Alert::success('Success', 'Pemeriksaan berhasil ditambah!!');
        return redirect()->route('pemeriksaan');
    }
    public function exportExcel()
    {
        $data['title'] = 'Export Excel';
        $pemeriksaan = DB::select('SELECT p.*, u.full_name, d.nama_dokter, a.antrian from pemeriksaan p left join users u on p.id_user=u.id left join dokter d on p.id_dokter=d.id left join antrian a on p.id_get_antrian=a.id');
        // dd($dataTujuan);
        return view('dashboard.exportExcel', [

            'pemeriksaan' => $pemeriksaan,

        ], $data);
    }
    public function filterExcel(Request $request)
    {
        // dd($request->all());
        $data['title'] = 'Export Excel';
        $pemeriksaan = DB::select('SELECT p.*, u.full_name, d.nama_dokter, a.antrian from pemeriksaan p left join users u on p.id_user=u.id left join dokter d on p.id_dokter=d.id left join antrian a on p.id_get_antrian=a.id where p.tgl_diperiksa BETWEEN "' .  $request->tanggal_awal . '" and "' . $request->tanggal_akhir . '"');
        // dd($pemeriksaan);
        // session()->flashInput($request->input());
        return view('dashboard.exportExcel', [

            'pemeriksaan' => $pemeriksaan,

        ], $data);
    }
    public function cetakAll(Request $request)
    {

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

        $getPemeriksaan = DB::select('SELECT p.*, u.full_name, d.nama_dokter, a.antrian from pemeriksaan p left join users u on p.id_user=u.id left join dokter d on p.id_dokter=d.id left join antrian a on p.id_get_antrian=a.id where p.tgl_diperiksa BETWEEN "' .  $request->tanggal_awal . '" and "' . $request->tanggal_akhir . '"');
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A5', 'Nama Lengkap');
        $sheet->setCellValue('B5', 'Antrian');
        $sheet->setCellValue('C5', 'Dokter');
        $sheet->setCellValue('D5', 'Penyakit');
        $sheet->setCellValue('E5', 'Obat');
        $sheet->setCellValue('F5', 'Tanggal Pemeriksaan');
        $rows = 6;
        // dd($getPemeriksaan);
        foreach ($getPemeriksaan as $pemDetails) {
            $sheet->setCellValue('A' . $rows, $pemDetails->full_name);
            $sheet->setCellValue('B' . $rows, $pemDetails->antrian);
            $sheet->setCellValue('C' . $rows, $pemDetails->nama_dokter);
            $sheet->setCellValue('D' . $rows, preg_replace('/[][{}""]+/', ' ', $pemDetails->penyakit));
            $sheet->setCellValue('E' . $rows, preg_replace('/[][{}""]+/', ' ', $pemDetails->obat));
            $sheet->setCellValue('F' . $rows, $pemDetails->tgl_diperiksa);
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
            DB::select('SELECT p.*, u.full_name, d.nama_dokter, a.antrian from pemeriksaan p left join users u on p.id_user=u.id left join dokter d on p.id_dokter=d.id left join antrian a on p.id_get_antrian=a.id where p.id = "' . $id . '"');
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

        $getPemeriksaan =
            DB::select('SELECT p.*, u.full_name, d.nama_dokter, a.antrian from pemeriksaan p left join users u on p.id_user=u.id left join dokter d on p.id_dokter=d.id left join antrian a on p.id_get_antrian=a.id where p.id = "' . $id . '"');
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A5', 'Nama Lengkap');
        $sheet->setCellValue('B5', 'Antrian');
        $sheet->setCellValue('C5', 'Dokter');
        $sheet->setCellValue('D5', 'Penyakit');
        $sheet->setCellValue('E5', 'Obat');
        $sheet->setCellValue('F5', 'Tanggal Pemeriksaan');
        $rows = 6;
        foreach ($getPemeriksaan as $pemDetails) {
            $sheet->setCellValue('A' . $rows, $pemDetails->full_name);
            $sheet->setCellValue('B' . $rows, $pemDetails->antrian);
            $sheet->setCellValue('C' . $rows, $pemDetails->nama_dokter);
            $sheet->setCellValue('D' . $rows, preg_replace('/[][{}""]+/', ' ', $pemDetails->penyakit));
            $sheet->setCellValue('E' . $rows, preg_replace('/[][{}""]+/', ' ', $pemDetails->obat));
            $sheet->setCellValue('F' . $rows, $pemDetails->tgl_diperiksa);
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
        // dd($request->all());
        $pemeriksaan = DB::select('SELECT p.*, u.full_name, d.nama_dokter, a.antrian from pemeriksaan p left join users u on p.id_user=u.id left join dokter d on p.id_dokter=d.id left join antrian a on p.id_get_antrian=a.id where p.tgl_diperiksa BETWEEN "' .  $request->tanggal_awal . '" and "' . $request->tanggal_akhir . '"');


        $data = [
            'title' => 'Welcome to Puskesmas',
            'date' => date('m/d/Y'),
            'pemeriksaan' => $pemeriksaan
        ];
        $pdf = PDF::loadView('dashboard.exportPdf', $data);
        $fileName =  'pemeriksaan.pdf';
        $pdf->save(public_path() . '/storage/pdf/' . $fileName);
        $pdf = public_path() . '/storage/pdf/' . $fileName;
        return response()->download($pdf);
    }
}
