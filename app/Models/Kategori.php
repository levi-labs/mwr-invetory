<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $guarded = ['id'];
    // public function getPriceAttribute($value): int
    // {
    //     return $value / 100;
    // }
    // public function setPriceAttribute($value): void
    // {
    //     $this->attributes['price'] = $value * 100;
    // }

    public function nama(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtolower($value),
            set: fn ($value) => strtolower($value),
        );
    }
    public function getKodeKategori()
    {

        $kategori = $this->count();

        if ($kategori == 0) {
            $counter    = 0001;
            $number     = "KTG-" . sprintf("%04s", $counter);
        } else {
            $lastNumber = $this->all()->last();
            $replace    = (int) substr($lastNumber->kode, 4) + 1;
            $number     = "KTG-" . sprintf("%04s", $replace);
        }
        return $number;
    }
}
