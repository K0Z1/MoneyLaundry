<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
		protected $table = 'tb_paket';
		
    protected $fillable = [
												'id_outlet',
												'jenis',
												'nama_paket',
												'harga'
											];

    public function transaksi()
    {
        return $this->belongsToMany(Transaksi::class, 'id_transaksi');
    }
}
