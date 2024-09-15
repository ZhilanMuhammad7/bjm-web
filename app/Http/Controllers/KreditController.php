<?php

namespace App\Http\Controllers;

use App\Models\Kredit;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KreditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $pesanan = Pesanan::where('user_id', $userId)
            ->whereIn('status', ['Keranjang'])
            ->get();
        $kredit = Kredit::where('user_id', $userId)
            ->whereIn('status', ['Menunggu Pembayaran'])
            ->get();
        return view('LandingPage.formKredit', compact('pesanan', 'kredit'));
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
        if ($request->hasFile('kk')) {
            $kkPath = $request->file('kk')->store('', 'public');
            $kk = $kkPath;
        } else {
            $kk = null;
        }
        if ($request->hasFile('slip_gaji')) {
            $slip_gajiPath = $request->file('slip_gaji')->store('', 'public');
            $slip_gaji = $slip_gajiPath;
        } else {
            $slip_gaji = null;
        }
        if ($request->hasFile('ktp_sim')) {
            $ktp_simPath = $request->file('ktp_sim')->store('', 'public');
            $ktp_sim = $ktp_simPath;
        } else {
            $ktp_sim = null;
        }
        $user = Auth::user();
        $userId = $user->id;

        $data = Kredit::create([
            'user_id' => $userId,
            'nama_produk' => $request->nama_produk,
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'ktp_sim' => $ktp_sim,
            'kk' => $kk,
            'slip_gaji' => $slip_gaji,
            'alamat' => $request->alamat,
            'thn_bayar' => $request->thn_bayar,
            'bayar_pertama' => $request->bayar_pertama,
            'cicilan' => $request->cicilan,
            'payment_method' => 'Kredit',
            'status' => 'Menunggu Pembayaran',
        ]);

        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Sukses Memasukkan Data',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menyimpan data',
            ]);
        }
    }

    public function buktitf(Request $request, $id)
    {
        $kredit = Kredit::find($id);
        if ($request->hasFile('bukti_tf')) {
            $bukti_tfPath = $request->file('bukti_tf')->store('', 'public');
            $bukti_tf = $bukti_tfPath;
        } else {
            $bukti_tf = null;
        }
        $kredit->update([
            'bukti_tf' => $bukti_tf,
            'kredit_id' => $request->kredit_id,
            'status' => 'Diproses',
        ]);

        if ($kredit) {
            return response()->json([
                'status' => true,
                'message' => 'Sukses Memasukkan Data',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menyimpan data',
            ]);
        }
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
