<?php

namespace App\Http\Controllers;

use ArielMejiaDev\LarapexCharts\LineChart;
use App\Charts\MovingWeightAverage;
use App\Models\Barang;
use App\Models\BarangKeluar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Halaman Barang Keluar';
        $search = $request->search;
        try {
            if (isset($search) || $search != null) {
                $data = DB::table('barang_keluar')->join('barang', 'barang.id', '=', 'barang_keluar.barang_id')
                    ->select('barang_keluar.*',  'barang.nama')
                    ->where('barang_keluar.kode', 'like', '%' . $search . '%')
                    ->orWhere('barang.nama', 'like', '%' . $search . '%')
                    ->get();
                session()->flash('success', 'Data Ditemukan');
                return view('pages.barang-keluar.index', compact('title', 'data'));
            } else {
                $data  = DB::table('barang_keluar')
                    ->join('barang', 'barang.id', '=', 'barang_keluar.barang_id')
                    ->select('barang_keluar.*',  'barang.nama')
                    ->get();

                return view('pages.barang-keluar.index', compact('title', 'data'));
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
        $title = 'Halaman Tambah Barang Keluar';
        $barang = Barang::select('id', 'nama')->get();
        $barangKeluar = new BarangKeluar();
        $kode        = $barangKeluar->getKodeBarangKeluar();

        return view('pages.barang-keluar.create', compact('title', 'barang', 'kode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode' => 'required',
            'barang' => 'required',
            'qty' => 'required',
            'tanggal' => 'required',
        ]);
        DB::beginTransaction();
        try {

            $brangKeluar = new BarangKeluar();
            $brangKeluar->kode = $request->kode;
            $brangKeluar->barang_id = $request->barang;
            $brangKeluar->qty = $request->qty;
            $brangKeluar->tanggal = $request->tanggal;
            $brangKeluar->save();
            $barang = Barang::find($request->barang);
            if ($barang->stok < $request->qty) {
                return back()->with('error', 'Stok Tidak Cukup');
            }
            $total = $barang->stok - $request->qty;
            $barang->stok = $total;
            $barang->save();
            DB::commit();
            return redirect()->route('barang-keluar.index')->with('success', 'Data Barang keluar berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangKeluar $barangKeluar)
    {
        $title = 'Halaman Edit Barang Keluar';
        $barang = Barang::select('id', 'nama')->get();
        return view('pages.barang-keluar.edit', compact('title', 'barangKeluar', 'barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangKeluar $barangKeluar)
    {
        $this->validate($request, [
            'kode' => 'required',
            'barang' => 'required',
            'qty' => 'required',
            'tanggal' => 'required',
        ]);
        DB::beginTransaction();
        try {

            $brangKeluar = BarangKeluar::find($barangKeluar->id);
            $brangKeluar->kode = $request->kode;
            $brangKeluar->barang_id = $request->barang;
            $temp_qty = $brangKeluar->qty;
            $brangKeluar->qty = $request->qty;
            $brangKeluar->tanggal = $request->tanggal;
            $brangKeluar->save();
            $barang = Barang::find($request->barang);
            $total = $barang->stok + $temp_qty;
            if ($total < $request->qty) {
                return back()->with('error', 'Stok Tidak Cukup');
            }
            $barang->stok = $total - $request->qty;
            $barang->save();
            DB::commit();
            return redirect()->route('barang-keluar.index')->with('success', 'Data Barang keluar berhasil diupdate');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangKeluar $barangKeluar)
    {
        DB::beginTransaction();
        try {
            $barang = Barang::find($barangKeluar->barang_id);
            $total = $barang->stok + $barangKeluar->qty;
            $barang->stok = $total;
            $barang->save();
            $barangKeluar->delete();
            DB::commit();
            return redirect()->route('barang-keluar.index')->with('success', 'Data Barang keluar berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }


    public function createAnalysis(Request $request)
    {
        $title = 'Halaman Analysis';
        try {
            // if ($request->periode === null) {
            //     return back()->with('error', 'Periode Tidak Boleh Kosong');
            // }
            return view('pages.barang-keluar.analisis', compact('title'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function storeAnalysis(Request $request)
    {
        $this->validate($request, [
            'periode' => 'required',
        ]);

        $title    = 'Halaman Analysis';
        $interval = $request->periode;
        try {

            if ($request->periode === null) {
                return back()->with('error', 'Periode Tidak Boleh Kosong');
            }

            $data = DB::table('barang_keluar')
                ->join('barang', 'barang_keluar.barang_id', '=', 'barang.id')
                ->selectRaw('YEAR(barang_keluar.tanggal) as year, MONTH(barang_keluar.tanggal) as month, barang.nama as nama_barang, SUM(barang_keluar.qty) as total_qty')
                ->groupByRaw('YEAR(barang_keluar.tanggal), MONTH(barang_keluar.tanggal), barang.nama')
                ->get();

            $result         = [];

            foreach ($data as $key => $item) {
                $month      = $item->month;
                $totalQty   = $item->total_qty;

                $startMonth = $month - ($interval - 1);
                $endMonth   = $month;

                $sum        = 0;
                $count      = 0;

                foreach ($data as $row) {
                    if ($row->month >= $startMonth && $row->month <= $endMonth) {
                        $sum += $row->total_qty;
                        $count++;
                    }
                }
                $carbonDate = Carbon::createFromDate(null, $item->month, 1)->startOfMonth();

                if ($count >= $interval) {

                    $result[$key]['nama_barang'] = $item->nama_barang;
                    $result[$key]['date'] = $carbonDate->format('F');
                    $result[$key]['total_qty'] = $totalQty;
                    $result[$key]['score'] = $sum / $interval;
                    $actual[] = $totalQty;
                    $forecast[] = $sum / $interval;
                    $month_chart[] = $carbonDate->format('F');
                } else {
                    $result[$key]['nama_barang'] = $item->nama_barang;
                    $result[$key]['date'] = $carbonDate->format('F');
                    $result[$key]['total_qty'] = $totalQty;
                    $result[$key]['score'] = 'N/A';
                    $actual[] = $totalQty;
                    $forecast[] = 0;
                    $month_chart[] = $carbonDate->format('F');
                }
            }
            // dd($actual, $forecast, $month_chart);

            $chart = new MovingWeightAverage(new LineChart());
            $line  = $chart->build($actual, $forecast, $month_chart);


            return view('pages.barang-keluar.analisis', compact(
                'title',
                'data',
                'result',
                'line'
            ));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
        // return view('pages.barang-keluar.analysis', compact('data'));
    }
}
