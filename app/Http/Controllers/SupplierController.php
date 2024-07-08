<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Halaman Supplier';
        $data  = Supplier::all();
        return view('pages.supplier.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Halaman Tambah Supplier';
        $supplier = new Supplier();
        $kode   = $supplier->getKodeSupplier();
        return view('pages.supplier.create', compact('title', 'kode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);
        try {
            Supplier::create([
                'kode' => $request->kode,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon
            ]);
            return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambahkan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        $title = 'Halaman Edit Supplier';
        return view('pages.supplier.edit', compact('title', 'supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $this->validate($request, [
            'kode' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);
        try {
            $supplier->update([
                'kode' => $request->kode,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon
            ]);
            return redirect()->route('supplier.index')->with('success', 'Supplier berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        try {
            $supplier->delete();
            return back()->with('success', 'Supplier Berhasil di hapus');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
