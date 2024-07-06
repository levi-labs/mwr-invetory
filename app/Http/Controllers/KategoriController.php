<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Halaman Kategori';
        $data  = Kategori::all();
        return view('pages.kategori.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Halaman Tambah Kategori';
        $kategori = new Kategori();
        $kode = $kategori->getKodeKategori();
        return view('pages.kategori.create', compact('title', 'kode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode' => 'required',
            'nama' => 'required',
        ]);

        try {
            Kategori::create([
                'kode' => $request->kode,
                'nama' => $request->nama
            ]);
            return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
        } catch (\Exception $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        $title = 'Halaman Edit Kategori';


        return view('pages.kategori.edit', compact('title', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $this->validate($request, [
            'kode' => 'required',
            'nama' => 'required',
        ]);

        try {
            $kategori->update([
                'kode' => $request->kode,
                'nama' => $request->nama
            ]);
            return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        try {
            $kategori->delete();
            return back()->with('success', 'Kategori berhasil dihapus');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
