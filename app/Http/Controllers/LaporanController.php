<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Outlet;
use App\Models\Outlet_User;
use App\Exports\LaporanExport;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use PDF;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth()->user()->role != 'admin') {
            $laporan = Transaksi::where('id_user', auth()->user()->id)->orderBy('tgl','DESC')->get();
        } else {
            $laporan = Transaksi::orderBy('tgl','DESC')->get();
        }

        $outlet = Outlet::orderBy('nama','ASC')->get();

        return view('laporan.index', compact('laporan','outlet'));
    }

    public function cari(Request $request)
    {
        $outlet = Outlet::orderBy('nama','ASC')->get();
        
        // Inisialisasi
        $tgl = $request->q;
        $bts = $request->s;
        $ot = $request->o;
        $sts = $request->st;

        $cari = Transaksi::where('tgl','LIKE','%'.$tgl.'%')->where('batas_waktu','<=', $bts)->where('id_outlet','LIKE','%'.$ot.'%')->where('status','LIKE','%'.$sts.'%')->get();

        return view('laporan.cari', compact('cari','outlet'));
    }

    // Export
    public function exportExcel() 
    {
        $hari = date('d ');
        $bulanArray = array(
                '01' => 'Januari',
                '02' => 'Februari',
                '03' => 'Maret',
                '04' => 'April',
                '05' => 'Mei',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'Agustus',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember',
        );

        $bulan = $bulanArray[date('m')];
        $tahun = date(' Y');
        
        return Excel::download(new LaporanExport, 'Laporan Laundry '.$hari.$bulan.$tahun.'.xlsx');
    }

    public function exportPdf()
    {
        $laporan = Transaksi::orderBy('tgl','DESC')->where('status','diambil')->get();

        $hari = date('d ');
        $bulanArray = array(
                '01' => 'Januari',
                '02' => 'Februari',
                '03' => 'Maret',
                '04' => 'April',
                '05' => 'Mei',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'Agustus',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember',
        );

        $bulan = $bulanArray[date('m')];
        $tahun = date(' Y');

        $pdf = PDF::loadView('laporan.pdf', ['data' => $laporan])->setPaper('a4', 'landscape')->setWarnings(false);
        return $pdf->download('Laporan Laundry '.$hari.$bulan.$tahun.'.pdf');
    }

    // Owner
    public function laporanOwner()
    {
        $idO = Outlet_User::where('id_user', auth()->user()->id)->get('id_outlet');

        $laporan = Transaksi::whereIn('id_outlet', $idO)->get();
        $outlet = Outlet::orderBy('nama','ASC')->get();

        return view('owner.laporan', compact('laporan', 'outlet'));
    }
}
