<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outlet;
use App\Models\User;
use App\Models\Outlet_User;
use Yajra\DataTables\DataTables;
use DB;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $owner = User::where('role', 'owner')->orderBy('nama', 'ASC')->get();
        $kasir = User::where('role', 'kasir')->orderBy('nama', 'ASC')->get();

        return view('admin.outlet.index', compact('owner','kasir'));
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
            'id_owner' => 'required',
            'id_kasir' => 'required'
        ]);

        // Store Table Outlet
        $data = [
						'nama' => $request->nama_outlet,
						'tlp' => $request->tlp,
            'alamat' => $request->alamat
        ];

        $outlet = Outlet::create($data);

        // Store table outlet_user
        $owner = new Outlet_User;
        $owner->id_outlet = $outlet->id;
        $owner->id_user = $request->id_owner;
        $owner->save();

        // Store table outlet_user
        $kasir = new Outlet_User;
        $kasir->id_outlet = $outlet->id;
        $kasir->id_user = $request->id_kasir;
        $kasir->save();

        return $outlet;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $outlet = Outlet::findOrFail($id);

        return $outlet;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $outlet = Outlet::findOrFail($id);

        return $outlet;
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
        $outlet = Outlet::find($id);
        $data = [
						'nama' => $request->nama,
						'tlp' => $request->tlp,
						'alamat' => $request->alamat
        ];

        $outlet->update($data);

        return $outlet;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Outlet::destroy($id);
    }

    // JSON
    public function json()
    {

        $outlet = Outlet::orderBy('nama','ASC')->get();

        return Datatables::of($outlet)
            ->addColumn('opsi', function($data)
            {
                return '<a href="#" onclick="tampilDetail('. $data->id .');" title="Detail Data"; class="invoice-action-view mr-1"><i class="icon-eye"></i></a> &nbsp;'.
                        '<a href="#" onclick="update('. $data->id .');" title="Edit Data"; class="invoice-action-view mr-1"><i class="icon-pencil"></i></a>&nbsp;&nbsp;'.
                        '<a href="#" onclick="destroy('. $data->id .');" title="Hapus Data"; class="invoice-action-view mr-1"><i class="icon-trash"></i></a>&nbsp;';
            })
            ->rawColumns(['opsi'])
            ->addIndexColumn() // Tambah no ++
            ->removeColumn('id') // Hapus id
            ->toJson();
    }


    // Owner
    // JSON
    public function jsonOwner()
    {
        $outlet = DB::table('outlet_user')
            ->join('tb_outlet', 'tb_outlet.id', '=', 'outlet_user.id_outlet')
            ->select('outlet_user.id_user','tb_outlet.nama','tb_outlet.alamat','tb_outlet.tlp')
            ->where('id_user', auth()->user()->id)
            ->get();

        return Datatables::of($outlet)
            ->addIndexColumn() // Tambah no ++
            ->removeColumn('id') // Hapus id
            ->toJson();
    }

		public function owner()
    {
				$owner = User::where('role', 'owner')->orderBy('nama', 'ASC')->get();
        $kasir = User::where('role', 'kasir')->orderBy('nama', 'ASC')->get();

				return view('owner.outlet', compact('owner','kasir'));
    }
}
