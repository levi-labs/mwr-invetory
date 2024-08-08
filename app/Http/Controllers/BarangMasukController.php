<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Halaman Barang Masuk';
        $search = $request->search;
        try {
            if (isset($search) || $search != null) {
                $data = DB::table('barang_masuk')
                    ->join('barang', 'barang.id', '=', 'barang_masuk.barang_id')
                    ->join('supplier', 'supplier.id', '=', 'barang_masuk.supplier_id')
                    ->select('barang_masuk.*', 'supplier.nama as supplier', 'barang.nama', 'barang.kode as barang_kode')
                    ->where('barang_masuk.kode', 'like', '%' . $search . '%')
                    ->orWhere('barang.nama', 'like', '%' . $search . '%')
                    ->orWhere('barang.kode', 'like', '%' . $search . '%')

                    ->get();
                session()->flash('success', 'Data Ditemukan');
                return view('pages.barang-masuk.index', compact('title', 'data'));
            } else {
                $data  = DB::table('barang_masuk')
                    ->join('barang', 'barang.id', '=', 'barang_masuk.barang_id')
                    ->join('supplier', 'supplier.id', '=', 'barang_masuk.supplier_id')
                    ->select('barang_masuk.*', 'supplier.nama as supplier', 'barang.nama', 'barang.kode as barang_kode')

                    ->get();
                return view('pages.barang-masuk.index', compact('title', 'data'));
            }
        } catch (\Exception $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Halaman Tambah Barang Masuk';
        $barang = Barang::select('id', 'nama')->get();
        $supplier = Supplier::select('id', 'nama')->get();
        $barangMasuk = new BarangMasuk();
        $kode        = $barangMasuk->getKodeBarangMasuk();
        return view('pages.barang-masuk.create', compact(
            'title',
            'kode',
            'barang',
            'supplier'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode' => 'required',
            'supplier' => 'required',
            'barang' => 'required',
            'qty' => 'required',
        ]);
        DB::beginTransaction();
        try {

            $brangMasuk = new BarangMasuk();
            $brangMasuk->kode = $request->kode;
            $brangMasuk->supplier_id = $request->supplier;
            $brangMasuk->barang_id = $request->barang;
            $brangMasuk->qty = $request->qty;

            $brangMasuk->save();
            $barang = Barang::find($request->barang);
            $barang->stok += $request->qty;
            $barang->save();
            DB::commit();

            return redirect()->route('barang-masuk.index')->with('success', 'Barang masuk berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangMasuk $barangMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangMasuk $barangMasuk)
    {
        $title = 'Halaman Edit Barang Masuk';
        $barang = Barang::select('id', 'nama')->get();
        $supplier = Supplier::select('id', 'nama')->get();
        return view('pages.barang-masuk.edit', compact(
            'title',
            'barangMasuk',
            'barang',
            'supplier'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangMasuk $barangMasuk)
    {
        $this->validate($request, [
            'kode' => 'required',
            'supplier' => 'required',
            'barang' => 'required',
            'qty' => 'required',
        ]);
        DB::beginTransaction();
        try {

            $brangMasuk = BarangMasuk::find($barangMasuk->id);
            $brangMasuk->kode = $request->kode;
            $brangMasuk->supplier_id = $request->supplier;
            $brangMasuk->barang_id = $request->barang;
            $temp_qty = $brangMasuk->qty;
            $brangMasuk->qty = $request->qty;
            $brangMasuk->save();
            $barang = Barang::find($request->barang);
            $total = ($barang->stok - $temp_qty) + $request->qty;
            $barang->stok = $total;
            $barang->save();
            DB::commit();

            return redirect()->route('barang-masuk.index')->with('success', 'Barang masuk berhasil diupdate');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangMasuk $barangMasuk)
    {
        DB::beginTransaction();
        try {
            $barang = Barang::find($barangMasuk->barang_id);
            $total = $barang->stok - $barangMasuk->qty;
            $barang->stok = $total;
            $barang->save();
            $barangMasuk->delete();
            DB::commit();
            return redirect()->route('barang-masuk.index')->with('success', 'Barang masuk berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
