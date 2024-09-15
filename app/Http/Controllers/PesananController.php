<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();

        // Ambil data pesanan berdasarkan user_id yang sesuai dengan id pengguna yang sedang login dan statusnya selain 'Keranjang' dan 'Dibatalkan'
        $pesanans = Pesanan::where('user_id', $userId)
            ->whereNotIn('status', ['Keranjang', 'Dibatalkan'])
            ->get();

        return view('LandingPage.cekPesanan', compact('pesanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $pesanan = new Pesanan();
        $pesanan->user_id = $user_id;
        $pesanan->order_id = (string) \Illuminate\Support\Str::random(10);
        $pesanan->invoice = (string) \Illuminate\Support\Str::random(10);
        $pesanan->nama_produk = $request->nama_produk;
        $pesanan->harga_produk = $request->harga_produk;
        $pesanan->image_produk = $request->image_produk;
        $pesanan->tipe_produk = $request->tipe_produk;
        $pesanan->warna_produk = $request->warna_produk;
        $pesanan->jumlah_produk = 1;
        $pesanan->subtotal_produk = $pesanan->harga_produk * $pesanan->jumlah_produk;
        $pesanan->pajak = $pesanan->subtotal_produk * 0.05;
        $pesanan->ongkir = $pesanan->subtotal_produk * 0.02;
        $pesanan->total_keseluruhan = $pesanan->subtotal_produk + $pesanan->pajak + $pesanan->ongkir;
        $pesanan->status = 'Keranjang';

        $pesanan->save();

        return redirect()->route('keranjang');
    }

    public function keranjang(Request $request)
    {
        $user = Auth::user();
        $pesanan = Pesanan::where('user_id', $user->id)->where('status', 'Keranjang')->get();

        return view('LandingPage.cart', compact('user', 'pesanan'));
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
    public function update(Request $request)
    {
        $user = Auth::user(); // Mendapatkan user yang sedang login
    
        // Ambil semua pesanan dengan status 'Keranjang' berdasarkan user_id
        $pesanans = Pesanan::where('user_id', $user->id)
            ->where('status', 'Keranjang')
            ->get();
    
        if ($pesanans->isNotEmpty()) {
            foreach ($pesanans as $pesanan) {
                // Update detail checkout
                $pesanan->order_id = (string) \Illuminate\Support\Str::random(10);
                $pesanan->invoice = (string) \Illuminate\Support\Str::random(10);
                $pesanan->tipe_produk = $pesanan->tipe_produk; // Gunakan data yang sudah ada, atau update sesuai kebutuhan
                $pesanan->warna_produk = $pesanan->warna_produk;
                $pesanan->nama_produk = $pesanan->nama_produk;
                $pesanan->harga_produk = $pesanan->harga_produk;
                $pesanan->jumlah_produk = $pesanan->jumlah_produk;
                $pesanan->subtotal_produk = $pesanan->harga_produk * $pesanan->jumlah_produk;
                $pesanan->pajak = $pesanan->subtotal_produk * 0.03;
                $pesanan->ongkir = $pesanan->subtotal_produk * 0.015;
                $pesanan->total_keseluruhan = $pesanan->subtotal_produk + $pesanan->pajak + $pesanan->ongkir;
                $pesanan->image_produk = $pesanan->image_produk;
    
                \Midtrans\Config::$serverKey = config('midtrans.serverKey');
                \Midtrans\Config::$isProduction = false;
                \Midtrans\Config::$isSanitized = true;
                \Midtrans\Config::$is3ds = true;
    
                // Siapkan parameter untuk Midtrans
                $params = [
                    'transaction_details' => [
                        'order_id' => $pesanan->order_id,
                        'gross_amount' => max($pesanan->total_keseluruhan, 100) // Gunakan total_keseluruhan jika > 0, jika tidak gunakan default 100
                    ],
                    'customer_details' => [
                        'first_name' => $user->username,
                        'email' => $user->email,
                        'phone' => $user->no_hp,
                    ],
                ];
    
                // Ambil snap token dari Midtrans
                $snapToken = \Midtrans\Snap::getSnapToken($params);
                $pesanan->snap_token = $snapToken;
    
                // Simpan perubahan pada pesanan
                $pesanan->save();
    
                // Ubah status pesanan menjadi 'Diproses'
                $pesanan->status = 'Diproses';
                $pesanan->save();
            }
    
            // Redirect ke halaman invoice dengan ID pesanan yang pertama kali diupdate
            return redirect()->route('produk.invoice', ['checkout' => $pesanans->first()->id]);
        } else {
            return redirect()->route('keranjang')->with('error', 'Tidak ada data pesanan dalam keranjang.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Pesanan::find($id);

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'message' => 'Data gagal ditemukan'
            ], 404);
        }

        $data->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses Melakukan delete Data',
        ]);
    }
}
