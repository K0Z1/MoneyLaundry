<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
		protected $table = 'tb_member';
		
    protected $guarded = [];

    // Relasi
    public function transaksi()
    {
			return $this->hasMany(Transaksi::class);
    }
}
