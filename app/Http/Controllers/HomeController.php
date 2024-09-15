<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Produk::all();
        $user = Auth::user();
        $data = Produk::orderBy('created_at', 'desc')->get();
        $type = 'terbaru';
        $pesanan = Pesanan::where('user_id', $user->id ?? null)->where('status', 'Keranjang')->get();
        return view('landingPage.index', compact('data', 'user', 'pesanan', 'type'));
    }

    public function filterHome(Request $request)
    {
        $data = Produk::all();
        $user = Auth::user();
        $pesanan = Pesanan::where('user_id', $user->id ?? null)->where('status', 'Keranjang')->get();
        $query = Produk::query();
        $filter = $request->input('filter');

        switch ($filter) {
            case 'tahun_baru_lama':
                $query->orderBy('tahun', 'desc');
                break;
            case 'tahun_lama_baru':
                $query->orderBy('tahun', 'asc');
                break;
            case 'km_terendah_tertinggi':
                $query->orderBy('kilometer', 'asc');
                break;
            case 'km_tertinggi_terendah':
                $query->orderBy('kilometer', 'desc');
                break;
            default:
                // Default order if needed
                break;
        }

        $data = $query->get();

        return view('LandingPage.carsList', compact('data', 'user', 'pesanan'));
    }

    public function filterTransmisiHome(Request $request)
    {
        $data = Produk::all();
        $user = Auth::user();
        $pesanan = Pesanan::where('user_id', $user->id ?? null)->where('status', 'Keranjang')->get();
        $filters = $request->input('filters', []);

        // Ambil data dari database dan filter berdasarkan checkbox yang dipilih
        $query = Produk::query();

        if (in_array('Automatic', $filters)) {
            $query->where('transmisi', 'Automatic');
        }

        if (in_array('Manual', $filters)) {
            $query->where('transmisi', 'Manual');
        }

        $data = $query->get();

        // Kembalikan data dalam format JSON
        return response()->json($data);
        return view('LandingPage.index', compact('data', 'user', 'pesanan'));
    }

    public function filterType($type)
    {
        $data = Produk::all();
        $user = Auth::user();
        $pesanan = Pesanan::where('user_id', $user->id ?? null)->where('status', 'Keranjang')->get();
        switch ($type) {
            case 'automatic':
                $data = Produk::where('transmisi', 'Automatic')->get();
                break;
            case 'manual':
                $data = Produk::where('transmisi', 'Manual')->get();
                break;
            default:
                $data = Produk::orderBy('created_at', 'desc')->get();
                break;
        }
        return view('LandingPage.index', compact('data', 'user', 'pesanan', 'type'));
    }

    public function filterTahunHome(Request $request)
    {
        $data = Produk::all();
        $user = Auth::user();
        $pesanan = Pesanan::where('user_id', $user->id ?? null)->where('status', 'Keranjang')->get();
        $filters = $request->input('filters', []);

        // Ambil data dari database dan filter berdasarkan checkbox yang dipilih
        $query = Produk::query();

        if (in_array('2024', $filters)) {
            $query->where('tahun', '2024');
        }

        if (in_array('2023', $filters)) {
            $query->where('tahun', '2023');
        }

        if (in_array('2022', $filters)) {
            $query->where('tahun', '2022');
        }

        if (in_array('2021', $filters)) {
            $query->where('tahun', '2021');
        }

        if (in_array('2020', $filters)) {
            $query->where('tahun', '2020');
        }

        if (in_array('2019', $filters)) {
            $query->where('tahun', '2019');
        }

        if (in_array('2018', $filters)) {
            $query->where('tahun', '2018');
        }

        if (in_array('2017', $filters)) {
            $query->where('tahun', '2017');
        }

        $data = $query->get();

        // Kembalikan data dalam format JSON
        return response()->json($data);
        return view('LandingPage.index', compact('data', 'user', 'pesanan'));
    }

    public function filterTypeTahun($type)
    {
        $data = Produk::all();
        $user = Auth::user();
        $pesanan = Pesanan::where('user_id', $user->id ?? null)->where('status', 'Keranjang')->get();
        switch ($type) {
            case '2024':
                $data = Produk::where('tahun', '2024')->get();
                break;
            case '2023':
                $data = Produk::where('tahun', '2023')->get();
                break;
            case '2022':
                $data = Produk::where('tahun', '2022')->get();
                break;
            case '2021':
                $data = Produk::where('tahun', '2021')->get();
                break;
            case '2020';
                $data = Produk::where('tahun', '2020')->get();
                break;
            case '2019';
                $data = Produk::where('tahun', '2019')->get();
                break;
            case '2018';
                $data = Produk::where('tahun', '2018')->get();
                break;
            case '2017';
                $data = Produk::where('tahun', '2017')->get();
                break;
            default:
                $data = Produk::orderBy('created_at', 'desc')->get();
                break;
        }
        return view('LandingPage.index', compact('data', 'user', 'pesanan', 'type'));
    }

    public function filterMerkHome(Request $request)
    {
        $data = Produk::all();
        $user = Auth::user();
        $pesanan = Pesanan::where('user_id', $user->id ?? null)->where('status', 'Keranjang')->get();
        $filters = $request->input('filters', []);

        // Ambil data dari database dan filter berdasarkan checkbox yang dipilih
        $query = Produk::query();

        if (in_array('Toyota', $filters)) {
            $query->where('brand', 'Toyota');
        }

        if (in_array('Daihatsu', $filters)) {
            $query->where('brand', 'Daihatsu');
        }

        if (in_array('Datsun', $filters)) {
            $query->where('brand', 'Datsun');
        }

        if (in_array('Ford', $filters)) {
            $query->where('brand', 'Ford');
        }

        if (in_array('Hino', $filters)) {
            $query->where('brand', 'Hino');
        }

        if (in_array('Honda', $filters)) {
            $query->where('brand', 'Honda');
        }

        if (in_array('Hyundai', $filters)) {
            $query->where('brand', 'Hyundai');
        }

        if (in_array('Isuzu', $filters)) {
            $query->where('brand', 'Isuzu');
        }

        if (in_array('Jeep', $filters)) {
            $query->where('brand', 'Jeep');
        }

        if (in_array('Kia', $filters)) {
            $query->where('brand', 'Kia');
        }

        if (in_array('Mercedes', $filters)) {
            $query->where('brand', 'Mercedes');
        }

        if (in_array('Mitsubishi', $filters)) {
            $query->where('brand', 'Mitsubishi');
        }

        if (in_array('Nissan', $filters)) {
            $query->where('brand', 'Nissan');
        }

        if (in_array('Suzuki', $filters)) {
            $query->where('brand', 'Suzuki');
        }

        if (in_array('Wuling', $filters)) {
            $query->where('brand', 'Wuling');
        }

        $data = $query->get();

        // Kembalikan data dalam format JSON
        return response()->json($data);
        return view('LandingPage.index', compact('data', 'user', 'pesanan'));
    }

    public function filterMerkType($type)
    {
        $data = Produk::all();
        $user = Auth::user();
        $pesanan = Pesanan::where('user_id', $user->id ?? null)->where('status', 'Keranjang')->get();
        switch ($type) {
            case 'Toyota':
                $data = Produk::where('brand', 'Toyota')->get();
                break;
            case 'Daihatsu':
                $data = Produk::where('brand', 'Daihatsu')->get();
                break;
            case 'Datsun':
                $data = Produk::where('brand', 'Datsun')->get();
                break;
            case 'Ford':
                $data = Produk::where('brand', 'Ford')->get();
                break;
            case 'Hino':
                $data = Produk::where('brand', 'Hino')->get();
                break;
            case 'Honda':
                $data = Produk::where('brand', 'Honda')->get();
                break;
            case 'Hyundai':
                $data = Produk::where('brand', 'Hyundai')->get();
                break;
            case 'Isuzu':
                $data = Produk::where('brand', 'Isuzu')->get();
                break;
            case 'Jeep':
                $data = Produk::where('brand', 'Jeep')->get();
                break;
            case 'Kia':
                $data = Produk::where('brand', 'Kia')->get();
                break;
            case 'Mercedes':
                $data = Produk::where('brand', 'Mercedes')->get();
                break;
            case 'Mitsubishi':
                $data = Produk::where('brand', 'Mitsubishi')->get();
                break;
            case 'Nissan':
                $data = Produk::where('brand', 'Nissan')->get();
                break;
            case 'Suzuki':
                $data = Produk::where('brand', 'Suzuki')->get();
                break;
            case 'Wuling':
                $data = Produk::where('brand', 'Wuling')->get();
                break;
            default:
                $data = Produk::orderBy('created_at', 'desc')->get();
                break;
        }
        return view('LandingPage.index', compact('data', 'user', 'pesanan', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
