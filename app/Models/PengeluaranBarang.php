<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengeluaranBarang extends Model
{
    protected $guarded = ['id'];

    public static function nomorPengeluaran()
    {
        $maxId = self::max('id');
        $prefix = 'TRX-';
        $nomor = $prefix . date('dmy') . str_pad($maxId + 1, 5, '0', STR_PAD_LEFT);
        return $nomor;
    }
}
