<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;
use Midtrans\Config;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $checkout = new Pesanan();
        $checkout->user_id = $user_id;
        $checkout->order_id = (string) \Illuminate\Support\Str::random(10);
        $checkout->invoice = (string) \Illuminate\Support\Str::random(10);
        $checkout->tipe_produk = $request->tipe_produk;
        $checkout->warna_produk = $request->warna_produk;
        $checkout->nama_produk = $request->nama_produk;
        $checkout->harga_produk = $request->harga_produk;
        $checkout->jumlah_produk = 1;
        $checkout->subtotal_produk = $checkout->harga_produk * $checkout->jumlah_produk;
        $checkout->pajak = $checkout->subtotal_produk * 0.03;
        $checkout->ongkir = $checkout->subtotal_produk * 0.015;
        $checkout->total_keseluruhan = $checkout->subtotal_produk + $checkout->pajak + $checkout->ongkir;
        $checkout->image_produk = $request->image_produk;
        $checkout->status = 'Diproses';

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;


        $params = array(
            'transaction_details' => array(
                'order_id' => $checkout->order_id,
                'gross_amount' => $checkout->total_keseluruhan
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->username,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->no_hp,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $checkout->snap_token = $snapToken;
        $checkout->save();


        return redirect()->route('produk.invoice', ['checkout' => $checkout->id]);
    }

    public function invoice($checkoutId)
    {
        $user = Auth::user();

        // Ambil data pesanan berdasarkan user dan status
        $pesanan = Pesanan::where('user_id', $user->id ?? null)
            ->where('status', 'keranjang')
            ->get();

        $transaksi = Pesanan::where('user_id', $user->id ?? null)
            ->where('status', 'Diproses')
            ->get();

        // Ambil detail pesanan berdasarkan ID
        $checkout2 = Pesanan::where('status', 'Diproses')->where('id', $checkoutId)->first();

        $price = Pesanan::where('id', $checkoutId)->first();

        // Kirim data ke view
        return view('LandingPage.invoiceUser', compact('user', 'pesanan', 'transaksi', 'checkout2', 'price'));
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

    public function showPayment()
    {
        // Set konfigurasi Midtrans
        Config::$serverKey = config('midtrans.serverKey');
        Config::$clientKey = config('midtrans.clientKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');

        // Persiapkan parameter untuk Midtrans Snap (dummy data)
        $params = [
            'transaction_details' => [
                'order_id' => 'order-' . rand(),
                'gross_amount' => 10000,
            ],
            'customer_details' => [
                'first_name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'phone' => '081234567890',
            ],
        ];

        try {
            // Ambil Snap token
            $snapToken = Snap::getSnapToken($params);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return view('Admin.Supervisor.tes', compact('snapToken'));
    }

    public function checkout()
    {
        $user = Auth::user();
        $pesanan = Pesanan::where('user_id', $user->id ?? null)->where('status', 'keranjang')->get();
        return view('LandingPage.checkout', compact('user', 'pesanan'));
    }

    public function invoiceCheckout()
    {
        $user = Auth::user();
        $pesanan = Pesanan::where('user_id', $user->id ?? null)->where('status', 'Diproses')->get();
        $transaksi = Pesanan::where('user_id', $user->id ?? null)->where('status', 'Diproses')->get();
        $checkout = Pesanan::where('user_id', $user->id ?? null)->where('status', 'Diproses')->get();
        $checkout2 = Pesanan::where('user_id', $user->id ?? null)->where('status', 'Diproses')->get();
        $snapToken = Pesanan::where('user_id', $user->id ?? null)->where('status', 'Diproses')->get();
        return view('LandingPage.invoiceUser', compact('user', 'pesanan', 'transaksi', 'checkout', 'checkout2', 'snapToken'));
    }
}
