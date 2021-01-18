<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table = 'tb_detail_transaksi';
    protected $fillable = [
												'id_transaksi',
												'id_paket',
												'qty',
												'keterangan'
											];

    // Relasi
    public function transaksi()
    {
			return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }

    public function paket()
    {
			return $this->belongsTo(Paket::class, 'id_paket');
    }
}
