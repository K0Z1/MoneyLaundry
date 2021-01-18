<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outlet;
use App\Models\Outlet_User;
use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Auth;

class DashboardController extends Controller
{
	public function admin()
	{
		// Count
		$totalOutlet = Outlet::count();
		$totalPengguna = User::count();
		$totalPelanggan = Pelanggan::count();
		$totalTransaksiBaru = Transaksi::where('status','baru')->count();
		$totalSemuaTransaksi = Transaksi::count();

		// Transaksi
		$transaksi = Transaksi::where('status','baru')->orderBy('tgl', 'DESC')->paginate(5);

		return view('dashboard.adminDashboard', compact('totalOutlet','totalPengguna','totalPelanggan','totalTransaksiBaru','totalSemuaTransaksi','transaksi'));
	}

	public function kasir()
	{
		// Id User
		$idU = Auth::id();

		// Count
		$totalTransaksiBaru = Transaksi::where('status','baru')->where('id_user', $idU)->count();
		$totalTransaksiProses = Transaksi::where('status','proses')->where('id_user', $idU)->count();
		$totalTransaksiSelesai = Transaksi::where('status','selesai')->where('id_user', $idU)->count();
		$totalTransaksiDiambil = Transaksi::where('status','diambil')->where('id_user', $idU)->count();

		// Transaksi
		$transaksi = Transaksi::where('status','baru')->where('id_user', $idU)->orderBy('tgl', 'DESC')->paginate(5);

		return view('dashboard.kasirDashboard', compact('totalTransaksiBaru','totalTransaksiProses','totalTransaksiSelesai','totalTransaksiDiambil','transaksi'));
	}

	public function owner()
	{
		$bulanArray = array(
                '01' => 'JANUARI',
                '02' => 'FEBRUARI',
                '03' => 'MARET',
                '04' => 'APRIL',
                '05' => 'MEI',
                '06' => 'JUNI',
                '07' => 'JULI',
                '08' => 'AGUSTUS',
                '09' => 'SEPTEMBER',
                '10' => 'OKTOBER',
                '11' => 'NOVEMBER',
                '12' => 'DESEMBER',
        );

        $bulan = $bulanArray[date('m')];
        $tanggal = date('d').' '.(ucwords($bulanArray[date('m')])).' '.date('Y');

        // Laporan
        $idO = Outlet_User::where('id_user', auth()->user()->id)->get('id_outlet');
        $m = date('Y-m');
        $laporan = Transaksi::whereIn('id_outlet', $idO)->where('tgl', '>=', $m)->count();

        // Count
        $baru = Transaksi::whereIn('id_outlet', $idO)->where('status','baru')->count();
        $proses = Transaksi::whereIn('id_outlet', $idO)->where('status','proses')->count();
        $selesai = Transaksi::whereIn('id_outlet', $idO)->where('status','selesai')->count();
        $diambil = Transaksi::whereIn('id_outlet', $idO)->where('status','diambil')->count();
        

		return view('dashboard.ownerDashboard', compact('bulan','tanggal','laporan','baru','proses','selesai','diambil'));
	}
}
