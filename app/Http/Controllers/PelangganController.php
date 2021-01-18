<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Yajra\DataTables\DataTables;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pelanggan.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jk,
            'tlp' => $request->tlp,
        ];

        return Pelanggan::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelanggan = Pelanggan::find($id);

        return $pelanggan;
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
        $pelanggan = Pelanggan::findOrFail($id);
        $data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jk,
            'tlp' => $request->tlp,
        ];

        $pelanggan->update($data);

        return $pelanggan;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pelanggan::destroy($id);
    }

    // JSON
    public function json()
    {
        $pelanggan = Pelanggan::latest()->get();

        return Datatables::of($pelanggan)
            ->addColumn('opsi', function($data)
            {
                return '<a href="#" onclick="update('. $data->id .');" title="Edit Data"; class="invoice-action-view mr-1"><i class="icon-pencil"></i></a>&nbsp;&nbsp;'.
                    '<a href="#" onclick="destroy('. $data->id .');" title="Hapus Data"; class="invoice-action-view mr-1"><i class="icon-trash"></i></a>&nbsp;';
            })
            ->rawColumns(['opsi'])
            ->addIndexColumn() // Tambah no ++
            ->removeColumn('id') // Hapus id
            ->toJson();
    }
}
