<?php

namespace App\Http\Controllers;

use App\Models\Kredit;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PDF;

class MarketingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
        $data = User::where('id', $id)->first();
        return view('Admin.Marketing.index', compact('data'));
    }

    public function pesanan()
    {
        $id = Auth::user()->id;
        $data = Pesanan::with('user:id,name')->where('status', '!=', 'keranjang')->get();
        $kredit = Kredit::all();
        return view('Admin.Marketing.pesananList', compact('data', 'kredit'));
    }

    public function approval(Request $request)
    {
        $id = $request->id;
        $data = Pesanan::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data Pesanan tidak ditemukan',
            ]);
        }
        $data->update([
            'status' => $request->status
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

    public function approvalKredit(Request $request)
    {
        $id = $request->id;
        $data = Kredit::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data Kredit tidak ditemukan',
            ]);
        }
        $data->update([
            'status' => $request->status
        ]);

        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Sukses Mengubah Data',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal Mengubah Data',
            ]);
        }
    }

    public function transaksi()
    {
        $data = Pesanan::with('user:id,name')->where('status', '!=', 'keranjang')->paginate(10);
        return view('Admin.Marketing.invoiceList', compact('data'));
    }

    public function printInvoice($id)
    {
        $data = Pesanan::find($id);
        $user = User::where('id', $data->user_id)->first();
        return view('Admin.Marketing.invoice', compact('data', 'user'));
    }

    public function exportPDF($id)
    {
        $data = Pesanan::findOrFail($id);
        $user = User::where('id', $data->user_id)->first();
        $pdf = PDF::loadView('Admin.Marketing.invoice', compact('data', 'user'));
        return $pdf->stream();
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
