<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outlet;
use App\Models\Paket;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\Outlet_User;
use App\Models\DetailTransaksi;
use Yajra\DataTables\DataTables;
use DB;
use Auth;
use DateTime;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role == 'admin') {
          $outlet = Outlet::orderBy('nama','ASC')->get();
        } else {
            $outlet = DB::table('outlet_user')
            ->join('tb_outlet', 'tb_outlet.id', '=', 'outlet_user.id_outlet')
            ->select('outlet_user.id_user','tb_outlet.id','tb_outlet.nama')
            ->where('id_user', auth()->user()->id)
            ->get();
        }
        
        $pelanggan = Pelanggan::orderBy('nama', 'ASC')->get();
        
        return view('transaksi.index', compact('outlet','pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $outlet = Outlet::orderBy('nama', 'DESC')->get();
        $pelanggan = Pelanggan::orderBy('nama', 'DESC')->get();

        return view('transaksi.tambah_transaksi', compact('outlet','pelanggan'));
    }

    public function cariMember($id)
    {
        $member = Pelanggan::find($id);

        return $member;
    }

    public function jsonStatus($id)
    {
        $transaksi = Transaksi::where('id', $id)->first();

        return $transaksi;
    }

    public function statusUpdate(Request $request, $id)
    {
        $data = [
            'status' => $request->status_pesanan,
        ];

        Transaksi::where('id', $id)->update($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_outlet' => 'required',
            'id_member' => 'required'
        ]);

				date_default_timezone_set('Asia/Jakarta');
				
        // Insert tb_transaksi
        $transaksi = new Transaksi;
        $transaksi->id_outlet = $request->id_outlet;
        $transaksi->kode_invoice = 'INV-'.mt_rand(100000, 999999).date('s');
        $transaksi->id_member = $request->id_member;
        $transaksi->tgl = date('Y-m-d H:i:s');
        $transaksi->batas_waktu = $request->batas_waktu;
        $transaksi->tgl_bayar = $request->tgl_bayar;
        $transaksi->status = 'baru';
        $transaksi->dibayar = 'belum_dibayar';
        $transaksi->id_user = Auth::user()->id;
        $transaksi->save();

        // Deklarasi var yang akan di parsing
        $idTransaksi = $transaksi->id;
        $idOutlet = $request->id_outlet;

        return redirect('tambah-paket/'.$idTransaksi.'/transaksi/'.$idOutlet.'');
    }

    public function tPaket($idTransaksi, $idOutlet)
    {
        $transaksi = Transaksi::where('id', $idTransaksi)->first();
        $outlet = Outlet::where('id', $idOutlet)->first();
        $id = DetailTransaksi::where('id_transaksi', $idTransaksi)->get();

        return view('transaksi.tambah_paket', compact('transaksi', 'outlet'));
    }

    public function tPaketStore(Request $request, $id)
    {
        $detailTransaksi = new DetailTransaksi;
        $detailTransaksi->id_transaksi = $id;
        $detailTransaksi->id_paket = $request->id_paket;
        $detailTransaksi->qty = $request->qty;
        $detailTransaksi->keterangan = $request->keterangan;
        $detailTransaksi->save();

        return $detailTransaksi;
    }

    public function updateTransaksi(Request $request, $id)
    {
        $cariKode = Transaksi::where('id', $id)->first();
        $kode_invoice = $cariKode->kode_invoice;

				$data = [
					'biaya_tambahan' => $request->biaya_tambahan,
					'pajak' => $request->pajak,
					'diskon' => $request->diskon,
					'status' => $request->status,
					'dibayar' => $request->dibayar,
				];

				$transaksi = Transaksi::where('id', $id)->update($data);

				return redirect('/detail-transaksi/'.$kode_invoice.'/cucian')->with('suksesTransaksi','');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
         // Cari id_transaksi
        $idT = $transaksi->id;
        $idO = $transaksi->id_outlet;
        $invoices = DetailTransaksi::where('id_transaksi', $transaksi->id)->get();

        // Total Harga
        $harga = DB::table('tb_detail_transaksi')
            ->join('tb_paket', 'tb_paket.id', '=', 'tb_detail_transaksi.id_paket')
            ->select('tb_detail_transaksi.id','tb_paket.id', DB::raw('SUM(tb_detail_transaksi.qty * tb_paket.harga) as TotalHarga'))
            ->where('id_transaksi', $idT)
            ->get();

        return view('transaksi.invoice', compact('invoices','harga'), ['data' => $transaksi]);
    }

    public function detailView($kodeinvoice)
    {
        // Cari id_transaksi
        $data = Transaksi::where('kode_invoice', $kodeinvoice)->first();
        $idT = $data->id;
        $idO = $data->id_outlet;
        $pesanan = DetailTransaksi::where('id_transaksi', $idT)->get();

        // Total Harga
        $harga = DB::table('tb_detail_transaksi')
            ->join('tb_paket', 'tb_paket.id', '=', 'tb_detail_transaksi.id_paket')
            ->select('tb_detail_transaksi.id','tb_paket.id', DB::raw('SUM(tb_detail_transaksi.qty * tb_paket.harga) as TotalHarga'))
            ->where('id_transaksi', $idT)
            ->get();

        return view('transaksi.detail_transaksi', compact('data','pesanan','harga'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaksi = Transaksi::find($id);
        $pelanggan = Pelanggan::orderBy('nama', 'DESC')->get();
        $detailTransaksi = DetailTransaksi::where('id_transaksi', $id)->first();

        return view('transaksi.edit_transaksi',compact('pelanggan','detailTransaksi'), ['data' => $transaksi]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [
            'id_member' => $request->id_member,
            'batas_waktu' => $request->batas_waktu,
            'tgl_bayar' => $request->tgl_bayar,
            'biaya_tambahan' => $request->biaya_tambahan,
            'pajak' => $request->pajak,
            'diskon' => $request->diskon,
            'status' => $request->status,
            'dibayar' => $request->dibayar,
        ];

        $transaksi = Transaksi::where('id', $id)->update($data);

        return redirect()->route('transaksi.index')->with('updateTransaksi','');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transaksi::destroy($id);
    }

    public function destroyPaket($id)
    {
        DetailTransaksi::destroy($id);
    }

    public function coba()
    {
        $outlet = Outlet::latest()->get();

        return view('welcome', compact('outlet'));
    }

    // Dynamic Dropdown
    public function paket($id){
      $paket = DB::table('tb_paket')
                ->select('id','id_outlet','nama_paket')
                ->where('id_outlet', $id)
                ->groupBy('nama_paket')
                ->get();
      
      return $paket;
    }

    public function jenis($id, $nama_paket)
    {
        $jenis = Paket::where('id_outlet', $id)->where('nama_paket', $nama_paket)->select('id','id_outlet','jenis', 'harga')->get();

        return $jenis;
    }

    public function harga($id)
    {
        $harga = Paket::where('id', $id)->select('id','id_outlet','jenis','harga','nama_paket')->get();

        return $harga;
    }

    // JSON
    public function json()
    {
        if (auth()->user()->role == 'admin') {
            $transaksi = DB::table('tb_transaksi')
            ->join('tb_member', 'tb_member.id', '=', 'tb_transaksi.id_member')
            ->join('tb_outlet', 'tb_outlet.id', '=', 'tb_transaksi.id_outlet')
            ->join('tb_user', 'tb_user.id', '=', 'tb_transaksi.id_user')
            ->select('tb_transaksi.id','tb_transaksi.kode_invoice as Invoice','tb_member.nama as Pelanggan','tb_transaksi.tgl','tb_transaksi.batas_waktu','tb_outlet.nama as Outlet','tb_user.nama as Kasir','tb_transaksi.status')
            ->orderBy('tgl', 'DESC')
            ->get();
        } else {
            $transaksi = DB::table('tb_transaksi')
            ->join('tb_member', 'tb_member.id', '=', 'tb_transaksi.id_member')
            ->join('tb_outlet', 'tb_outlet.id', '=', 'tb_transaksi.id_outlet')
            ->join('tb_user', 'tb_user.id', '=', 'tb_transaksi.id_user')
            ->select('tb_transaksi.id','tb_transaksi.kode_invoice as Invoice','tb_member.nama as Pelanggan','tb_transaksi.tgl','tb_transaksi.batas_waktu','tb_outlet.nama as Outlet','tb_user.nama as Kasir','tb_transaksi.status')
            ->where('id_user', auth()->user()->id)
            ->orderBy('tgl', 'DESC')
            ->get();
        }
        

        return Datatables::of($transaksi)
            ->addColumn('Invoice', function($data)
            {
                return '<a href="/transaksi/'.$data->id.'" title="Invoice"; target="_blank" class="invoice-action-view mr-1">'.$data->Invoice.'</a>';
            })
            ->addColumn('tgl', function($data)
            {
                return date('d/m/Y',strtotime($data->tgl)).' - '.date('d/m/Y',strtotime($data->batas_waktu));
            })
            ->addColumn('status', function($data)
            {
                if ($data->status == 'baru') return '<span class="bullet bullet-info bullet-sm"></span> <a href="#" onclick="status('.$data->id.');">'.ucwords($data->status).'</a>';
                if ($data->status == 'proses') return '<span class="bullet bullet-warning bullet-sm"></span> <a href="#" onclick="status('.$data->id.');">'.ucwords($data->status).'</a>';
                if ($data->status == 'selesai') return '<span class="bullet bullet-success bullet-sm"></span> <a href="#" onclick="status('.$data->id.');">'.ucwords($data->status).'</a>';
                if ($data->status == 'diambil') return '<span class="bullet bullet-primary bullet-sm"></span> <a href="#" onclick="status('.$data->id.');">'.ucwords($data->status).'</a>';
                
            })
            ->addColumn('opsi', function($data)
            {
                return '<a href="/detail-transaksi/'.$data->Invoice.'/cucian" title="Detail Transaksi"; target="_blank" class="invoice-action-view mr-1"><i class="icon-eye"></i></a> &nbsp;'.
                        '<a href="/transaksi/'.$data->id.'/edit" title="Edit Transaksi"; class="invoice-action-view mr-1"><i class="icon-pencil"></i></a>&nbsp;&nbsp;'.
                        '<a href="#" onclick="destroy('. $data->id .');" title="Hapus Transaksi"; class="invoice-action-view mr-1"><i class="icon-trash"></i></a>&nbsp;';
            })
            ->rawColumns(['opsi','status','Invoice','tgl'])
            ->addIndexColumn() // Tambah no ++
            ->removeColumn('id','batas_waktu') // Hapus field
            ->toJson();
    }

    // JSON Invoice
    public function detailTransaksi($id)
    {
        $transaksi = DB::table('tb_detail_transaksi')
            ->join('tb_paket', 'tb_paket.id', '=', 'tb_detail_transaksi.id_paket')
            ->select('tb_detail_transaksi.id','tb_paket.nama_paket','tb_paket.jenis','tb_detail_transaksi.qty','tb_paket.harga','tb_detail_transaksi.keterangan')
            ->where('id_transaksi', $id)
            ->get();

        return Datatables::of($transaksi)
        ->addColumn('harga', function($data)
            {
                return 'Rp. '.$data->harga;
            })
            ->addColumn('opsi', function($data)
            {
                return '<a href="#" onclick="destroy('. $data->id .');" title="Hapus Paket"; class="invoice-action-view mr-1"><i class="icon-trash"></i></a>&nbsp;';
            })
            ->rawColumns(['opsi','harga'])
            ->addIndexColumn() // Tambah no ++
            ->removeColumn('id') // Hapus field
            ->toJson();
    }
}
