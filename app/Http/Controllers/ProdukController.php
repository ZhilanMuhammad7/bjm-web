<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Produk::all();
        return view('Admin.Marketing.produkList', compact('data'));
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
        if ($request->hasFile('gambar1')) {
            $gambarPath = $request->file('gambar1')->store('', 'public');
            $gambar1 = $gambarPath;
        } else {
            $gambar1 = null;
        }

        if ($request->hasFile('gambar2')) {
            $gambar2Path = $request->file('gambar2')->store('', 'public');
            $gambar2 = $gambar2Path;
        } else {
            $gambar2 = null;
        }

        if ($request->hasFile('gambar3')) {
            $gambar3Path = $request->file('gambar3')->store('', 'public');
            $gambar3 = $gambar3Path;
        } else {
            $gambar3 = null;
        }

        if ($request->hasFile('gambar4')) {
            $gambar4Path = $request->file('gambar4')->store('', 'public');
            $gambar4 = $gambar4Path;
        } else {
            $gambar4 = null;
        }

        if ($request->hasFile('gambar5')) {
            $gambar5Path = $request->file('gambar5')->store('', 'public');
            $gambar5 = $gambar5Path;
        } else {
            $gambar5 = null;
        }


        $data = Produk::create([
            'judul' => $request->judul,
            'brand' => $request->brand,
            'merk' => $request->merk,
            'tahun' => $request->tahun,
            'kilometer' => $request->kilometer,
            'bahan_bakar' => $request->bahan_bakar,
            'warna' => $request->warna,
            'transmisi' => $request->transmisi,
            'kapasitas_mesin' => $request->kapasitas_mesin,
            'tipe' => $request->tipe,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'gambar1' => $gambar1,
            'gambar2' => $gambar2,
            'gambar3' => $gambar3,
            'gambar4' => $gambar4,
            'gambar5' => $gambar5,
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
        $data = Produk::findOrFail($id);
        return response()->json(['data' => $data], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $data = Produk::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data Produk tidak ditemukan',
            ]);
        }

        if ($request->hasFile('gambar1')) {
            $gambarPath = $request->file('gambar1')->store('', 'public');
            $gambar1 = $gambarPath;
        } else {
            $gambar1 = null;
        }

        if ($request->hasFile('gambar2')) {
            $gambar2Path = $request->file('gambar2')->store('', 'public');
            $gambar2 = $gambar2Path;
        } else {
            $gambar2 = null;
        }

        if ($request->hasFile('gambar3')) {
            $gambar3Path = $request->file('gambar3')->store('', 'public');
            $gambar3 = $gambar3Path;
        } else {
            $gambar3 = null;
        }

        if ($request->hasFile('gambar4')) {
            $gambar4Path = $request->file('gambar4')->store('', 'public');
            $gambar4 = $gambar4Path;
        } else {
            $gambar4 = null;
        }

        if ($request->hasFile('gambar5')) {
            $gambar5Path = $request->file('gambar5')->store('', 'public');
            $gambar5 = $gambar5Path;
        } else {
            $gambar5 = null;
        }

        $data->update([
            'judul' => $request->judul,
            'brand' => $request->brand,
            'merk' => $request->merk,
            'tahun' => $request->tahun,
            'kilometer' => $request->kilometer,
            'bahan_bakar' => $request->bahan_bakar,
            'warna' => $request->warna,
            'transmisi' => $request->transmisi,
            'kapasitas_mesin' => $request->kapasitas_mesin,
            'tipe' => $request->tipe,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'gambar1' => $gambar1,
            'gambar2' => $gambar2,
            'gambar3' => $gambar3,
            'gambar4' => $gambar4,
            'gambar5' => $gambar5,
        ]);

        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Sukses Mengubah Data',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal Mengubah data',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Produk::find($id);

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

    public function detail($id)
    {
        $data = Produk::paginate(4);
        $produk = Produk::where('id', $id)->first();
        $user = Auth::user();
        $pesanan = Pesanan::where('user_id', $user->id ?? null)->where('status', 'Keranjang')->get();
        return view('LandingPage.detailProduk', compact('data', 'produk', 'user', 'pesanan'));
    }
}
