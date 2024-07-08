<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'barang_keluar';

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }

    public function getKodeBarangKeluar()
    {
        $keluar = $this->count();
        if ($keluar == 0) {
            $counter = '0001';
            $number =  'BRK-' . sprintf('%04s', $counter);
        } else {
            $last = $this->all()->last();
            $replace = (int) substr($last->kode, 4) + 1;
            $number = 'BRK-' . sprintf('%04s', $replace);
        }

        return $number;
    }
}
