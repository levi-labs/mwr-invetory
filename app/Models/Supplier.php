<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'supplier';

    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'supplier_id', 'id');
    }

    public function nama(): Attribute
    {

        return Attribute::make(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function getKodeSupplier()
    {

        $supplier  = $this->count();

        if ($supplier == 0) {
            $counter  = '0001';
            $number   = 'SPR-' . sprintf("%04s", $counter);
        } else {
            $lastNumber = $this->all()->last();
            $replace    = (int) substr($lastNumber->kode, 4) + 1;
            $number     = 'SPR-' . sprintf("%04s", $replace);
        }

        return $number;
    }
}
