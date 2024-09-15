<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
        $data = User::where('id', $id)->first();
        $total_produk = Produk::count();
        $total_pesanan = Pesanan::where('status', 'Diproses')->count();
        $total_user = User::count();
        $total_penjualan = Pesanan::where('status', 'Diterima')->count();
        if ($data) {
            return view('Admin.dashboard.dashboard', compact('data', 'total_produk', 'total_pesanan', 'total_user', 'total_penjualan'));
        } else {
            return redirect()->route('home.index')->with('error', 'Data tidak ditemukan');
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
