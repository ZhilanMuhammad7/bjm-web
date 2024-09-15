<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Produk::all();
        $user = Auth::user();
        $pesanan = Pesanan::where('user_id', $user->id ?? null)->where('status', 'Keranjang')->get();

        return view('landingPage.carsList', compact('data', 'user', 'pesanan'));
    }

    public function filter(Request $request)
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

    public function filterTransmisi(Request $request)
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
        return view('LandingPage.carsList', compact('data', 'user', 'pesanan'));
    }

    public function filterTahun(Request $request)
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
        return view('LandingPage.carsList', compact('data', 'user', 'pesanan'));
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
