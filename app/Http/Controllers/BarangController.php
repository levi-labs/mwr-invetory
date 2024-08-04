<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Halaman Daftar Barang';
        $search = $request->search;
        try {
            if (isset($search) || $search != null) {
                $data = Barang::where('kode', 'like', '%' . $search . '%')
                    ->orWhere('nama', 'like', '%' . $search . '%')
                    ->orWhere('kode', 'like', '%' . $search . '%')
                    ->get();
                session()->flash('success', 'Data Ditemukan');
                return view('pages.barang.index', compact('title', 'data'));
            } else {
                $data = Barang::all();

                return view('pages.barang.index', compact('title', 'data'));
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
        $title  = 'Halaman Tambah Barang';
        $barang = new Barang();
        $kategori = Kategori::all();
        $kode   = $barang->getKodeBarang();
        return view('pages.barang.create', compact('title', 'kode', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode' => 'required',
            'nama' => 'required',
            'stok' => 'required',
            'satuan' => 'required',
            'harga' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required',
        ]);

        try {
            $barang = new Barang();
            $barang->kode           = $request->kode;
            $barang->nama           = $request->nama;
            $barang->stok           = $request->stok;
            $barang->satuan         = $request->satuan;
            $barang->harga          = $request->harga;
            $barang->ukuran         = $request->ukuran;
            $barang->warna          = $request->warna;
            $barang->kategori_id    = $request->kategori;
            $barang->deskripsi      = $request->deskripsi;
            $image  = $request->file('gambar');
            if ($request->hasFile('gambar')) {
                $fileNama = time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('images', $fileNama);
                $barang->gambar = $path;
            }
            $barang->save();

            return redirect()->route('barang.index')->with('success', 'Data Barang berhasil di tambahkan');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        $title = 'Halaman Detail Barang';

        return view('pages.barang.show', compact('title', 'barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        $title = 'Halaman Edit Barang';
        $kategori = Kategori::all();
        return view('pages.barang.edit', compact('title', 'barang', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $this->validate($request, [
            'kode' => 'required',
            'nama' => 'required',
            'stok' => 'required',
            'satuan' => 'required',
            'harga' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required',
        ]);

        try {

            $barang  = Barang::find($barang->id);
            $barang->kode           = $request->kode;
            $barang->nama           = $request->nama;
            $barang->stok           = $request->stok;
            $barang->satuan         = $request->satuan;
            $barang->harga          = $request->harga;
            $barang->ukuran         = $request->ukuran;
            $barang->warna          = $request->warna;
            $barang->kategori_id    = $request->kategori;
            $barang->deskripsi      = $request->deskripsi;

            if ($request->file('gambar')) {
                $image = $request->file('gambar');
                $file = time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('images', $file);
                if ($barang->gambar != null) {
                    Storage::delete($barang->gambar);
                }
                $barang->gambar = $path;
                $barang->save();
            } else {
                $barang->gambar = $barang->gambar;
                $barang->save();
            }
            return redirect()->route('barang.index')->with('success', 'Data Barang berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        try {
            if ($barang->gambar != null) {
                Storage::delete($barang->gambar);
            }
            $barang->delete();
            return back()->with('success', 'Data Barang Berhasil di hapus');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
