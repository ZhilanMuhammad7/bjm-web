<?php

namespace App\Exports;

use App\Models\Pesanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PenjualanExport implements FromCollection, WithHeadings
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Pesanan::where('status', 'Diterima')->orWhere('status', 'Diproses')->orWhere('status', 'Ditolak')->select('id', 'order_id', 'nama_produk', 'jumlah_produk', 'created_at', 'status')->get();
    }

    public function headings(): array
    {
        return [
            "No",
            "order_id",
            "nama_produk",
            "jumlah_produk",
            "created_at",
            "status"
        ];
    }
}
