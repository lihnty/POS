<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ItemPenerimaanBarang;

class PenerimaanBarang extends Model
{
    protected $guarded = ['id'];

    public static function nomorPenerimaan()
    {
        // PBR -001
        $max = self::max('id');
        $prefix = 'PBR-';
        $date = date('dmy');
        $nomor = $prefix . $date . str_pad($max + 1, 4, '0', STR_PAD_LEFT);
        return $nomor;
    }
    
    public function items()
    {
        return $this->hasMany(ItemPenerimaanBarang::class, 'nama_penerimaan', 'nomor_penerimaan');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_penerima');
    }

}
