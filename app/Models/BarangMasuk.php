<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'barang_masuk';


    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
    public function barang()
    {

        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }

    public function getKodeBarangMasuk()
    {

        $masuk  = $this->count();

        if ($masuk == 0) {
            $counter  = '0001';
            $number   = 'BRM-' . sprintf("%04s", $counter);
        } else {
            $lastNumber = $this->all()->last();
            $replace    = (int) substr($lastNumber->kode, 4) + 1;
            $number     = 'BRM-' . sprintf("%04s", $replace);
        }

        return $number;
    }
}
