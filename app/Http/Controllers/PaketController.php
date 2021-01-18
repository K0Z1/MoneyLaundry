<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outlet;
use App\Models\Paket;
use Yajra\DataTables\DataTables;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlet = Outlet::orderBy('nama','DESC')->get();

        return view('admin.paket.index', compact('outlet'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Paket::where('id_outlet',$request->id_outlet)->where('jenis', $request->jenis)->exists()) {
            return redirect()->back()->with('sudahada','');
        } else {
						$data = [
							'id_outlet' => $request->id_outlet,
							'nama_paket' => $request->nama_paket,
							'jenis' => $request->jenis,
							'harga' => $request->harga,
					];

						Paket::create($data);

						return redirect()->back()->with('sukses','');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Outlet::where('id', $id)->first();

        return view('admin.paket.detail_paket', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paket = Paket::findOrFail($id);

        return $paket;
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
        $paket = Paket::find($id);
        $data = [
            'nama_paket' => $request->nama_paket,
            'jenis' => $request->jenis,
            'harga' => $request->harga,
        ];

        $paket->update($data);

        return $paket;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Paket::destroy($id);
    }

    // JSON
    public function json()
    {
        $outlet = Outlet::latest()->get();

        return Datatables::of($outlet)
            ->addColumn('jml_paket', function ($data)
            {
                $jmlPaket = Paket::where('id_outlet', $data->id)->count();
                return $jmlPaket.' Paket';
            })
            ->addColumn('opsi', function($data)
            {
                return '<a href="/paket/'.$data->id.'" class="btn btn-sm btn-info">Detail</a> &nbsp;';
            })
            ->rawColumns(['opsi','jml_paket'])
            ->addIndexColumn() // Tambah no ++
            ->removeColumn('id','alamat') // Hapus field
            ->toJson();
    }

    public function jsonFilter($idOutlet)
    {
        $paket = Paket::where('id_outlet', $idOutlet)->get();

        return Datatables::of($paket)
            ->addColumn('opsi', function($data)
            {
                return '<a href="#" onclick="update('. $data->id .');" title="Edit Data"; class="invoice-action-view mr-1"><i class="icon-pencil"></i></a>&nbsp;&nbsp;'.
                    '<a href="#" onclick="destroy('. $data->id .');" title="Hapus Data"; class="invoice-action-view mr-1"><i class="icon-trash"></i></a>&nbsp;';
            })
            ->rawColumns(['opsi'])
            ->addIndexColumn() // Tambah no ++
            ->removeColumn('id') // Hapus field
            ->toJson();
    }
}
