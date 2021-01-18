<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Transaksi::orderBy('tgl','DESC')->where('status','diambil')->get();
    }

    public function map($laporan): array
    {
        return [
        $laporan->kode_invoice,
            $laporan->pelanggan->nama,
            $laporan->pelanggan->tlp,
            $laporan->outlet->nama,
            ucwords($laporan->status),
            $laporan->tanggal(),
        ];
    }

    public function headings(): array
    {
        return [
            'Kode Invoice',
            'Pelanggan',
            'Telpon Pelanggan',
            'Outlet',
            'Status',
            'Tanggal',
        ];
    }
}
