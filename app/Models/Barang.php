<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $guarded = ['id'];

    public function getKodeBarang()
    {

        $barang  = $this->count();

        if ($barang == 0) {
            $counter  = '0001';
            $number   = 'BRG-' . sprintf("%04s", $counter);
        } else {
            $lastNumber = $this->all()->last();
            $replace    = (int) substr($lastNumber->kode, 4) + 1;
            $number     = 'BRG-' . sprintf("%04s", $replace);
        }

        return $number;
    }

    public function getImage()
    {
        return '/storage/' . $this->gambar;
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
}
