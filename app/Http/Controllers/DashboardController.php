<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Welcome to Dashboard';
        $barang = \App\Models\Barang::count();
        $supplier = \App\Models\Supplier::count();
        $masuk = \App\Models\BarangMasuk::count();
        $keluar = \App\Models\BarangKeluar::count();

        $sales = DB::table('barang_keluar')
            ->join('barang', 'barang_keluar.barang_id', '=', 'barang.id')
            ->select(
                'barang.nama as nama_barang',
                DB::raw('SUM(barang_keluar.qty) as total_qty'),
                'barang.harga as harga',
                DB::raw('SUM(barang_keluar.qty * barang.harga) as total_price'),
                DB::raw('MONTHNAME(barang_keluar.tanggal) as month, YEAR(barang_keluar.tanggal) as year')
            )
            ->groupBy('nama_barang', 'month', 'year', 'harga')
            ->get();


        return view('pages.dashboard.index', compact(
            'title',
            'barang',
            'supplier',
            'masuk',
            'keluar',
            'sales'
        ));
    }
}
