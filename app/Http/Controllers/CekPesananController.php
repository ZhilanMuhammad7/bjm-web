<?php

namespace App\Http\Controllers;

use App\Models\Kredit;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekPesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            $userId = $user->id;
            $data = Pesanan::select('status', 'harga_produk', 'nama_produk', 'invoice')
            ->where('user_id', $userId)
            ->whereNotIn('status', ['Keranjang'])
            ->get();
            $pesanan = Pesanan::where('user_id', $userId)
            ->whereIn('status', ['Keranjang'])
            ->get();
            $invoice = Pesanan::where('user_id', $userId)
            ->whereIn('status', ['Keranjang'])
            ->get();
            $kredit = Kredit::select('payment_method', 'thn_bayar', 'status', 'bayar_pertama', 'cicilan', 'nama_produk')
            ->where('user_id', $userId)
            ->whereIn('status', ['Menunggu Pembayaran', 'Diproses','Ditolak','Diterima'])
            ->get();
        return view('LandingPage.cekPesanan', compact('user', 'pesanan', 'data', 'invoice', 'kredit'));

    } else {
        // Handle the case where the user is not authenticated
        return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu');
    }
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
