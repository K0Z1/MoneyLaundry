<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
		protected $table = 'tb_transaksi';
		
		protected $fillable = [
												'id_outlet',
												'kode_invoice',
												'id_member',
												'tgl',
												'batas_waktu',
												'tgl_bayar',
												'biaya_tambahan',
												'diskon',
												'pajak',
												'status',
												'dibayar',
												'id_user',
											];

    // Disable Timestamp
    public $timestamps = false;

    // Relasi
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_member');
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'id_outlet');
    }

    public function paket()
    {
        return $this->belongsToMany(Paket::class, 'id_paket');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Sambung
    public function tanggal()
    {
        $tgl = date('d/m/Y',strtotime($this->tgl));
        $batas_waktu = date('d/m/Y',strtotime($this->batas_waktu));
        return $tgl.' - '.$batas_waktu;
    }
}
