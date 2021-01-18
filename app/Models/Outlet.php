<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
		protected $table = "tb_outlet";
		
    protected $guarded = [];

    // Relasi
    public function user()
    {
			return $this->belongsToMany(User::class, 'outlet_user', 'id_outlet', 'id_user');
    }

    public function transaksi()
    {
			return $this->hasMany(Transaksi::class);
    }
}
