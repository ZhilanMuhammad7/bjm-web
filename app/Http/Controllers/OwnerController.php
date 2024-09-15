<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Worksheet\ColumnDimension;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.Owner.penjualan');
    }

    public function filter(Request $request)
    {
        $transaksi = $request->input('status');
        $tanggal_mulai = $request->input('created_at');
        $tanggal_sampai = $request->input('tanggal_sampai');

        $pesanan = Pesanan::where('status', $transaksi)->whereDate('created_at', $tanggal_mulai)->get();
        // $query->where('status', $transaksi);

        // if ($transaksi != 'Diproses' || $transaksi != 'Diterima' || $transaksi != 'Ditolak') {
        // }

        // if ($tanggal_mulai && $tanggal_sampai) {
        //     $query->whereBetween('created_at', [$tanggal_mulai, $tanggal_sampai]);
        // }

        // $pesanan = $query->get();

        return view('Admin.Owner.penjualan', compact('pesanan'));
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
    public function exportlaporan($tanggal, $status)
    {


        $data = Pesanan::where('status', $status)->whereDate('created_at', $tanggal)->get();

        if ($data->isNotEmpty()) {

            $penjualan_details = [];


            foreach ($data as $pesanan) {
                $penjualan_details[] = [
                    'order_id' => $pesanan->order_id,
                    'nama_produk' => $pesanan->nama_produk,
                    'jumlah_produk' => $pesanan->jumlah_produk,
                    'created_at' => $pesanan->created_at,
                    'status' => $pesanan->status,
                ];
            }


            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValue('A1', 'No');
            $sheet->setCellValue('B1', 'Order ID');
            $sheet->setCellValue('C1', 'Nama Produk');
            $sheet->setCellValue('D1', 'Jumlah Produk');
            $sheet->setCellValue('E1', 'Tanggal');
            $sheet->setCellValue('F1', 'Status');

            $row = 2;
            foreach ($penjualan_details as $index => $detail) {
                $sheet->setCellValue('A' . $row, $index + 1);
                $sheet->setCellValue('B' . $row, $detail['order_id']);
                $sheet->setCellValue('C' . $row, $detail['nama_produk']);
                $sheet->setCellValue('D' . $row, $detail['jumlah_produk']);
                $sheet->setCellValue('E' . $row, $detail['created_at']);
                $sheet->setCellValue('F' . $row, $detail['status']);
                $row++;
            }
            $sheet->getColumnDimension('A')->setWidth(5);
            $sheet->getColumnDimension('B')->setWidth(15);
            $sheet->getColumnDimension('C')->setWidth(25);
            $sheet->getColumnDimension('D')->setWidth(25);
            $sheet->getColumnDimension('E')->setWidth(10);
            $sheet->getColumnDimension('F')->setWidth(15);
            $sheet->getStyle('A1:F1')->applyFromArray([
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'color' => [
                        'rgb' => '4CAF50', // Warna hijau
                    ],
                ],
                'font' => [
                    'color' => [
                        'rgb' => 'FFFFFF', // Warna teks putih
                    ],
                ],
            ]);

            $filename = 'Laporan_penjualan_' . date('d-m-y') . '.xlsx';
            $writer = new Xlsx($spreadsheet);
            $filePath = storage_path('app/public/' . $filename);
            $writer->save($filePath);

            return Response::download($filePath, $filename, [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ])->deleteFileAfterSend(true);
        } else {
            return redirect('/penjualan')->with('error', 'Data Penjualan Belum ada');
        }
    }
}
