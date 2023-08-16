<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Penjualan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;



class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tanggalAwal = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $tanggalAkhir = date('Y-m-d');

        if ($request->has('tanggal_awal') && $request->tanggal_awal != "" && $request->has('tanggal_akhir') && $request->tanggal_akhir) {
            $tanggalAwal = $request->tanggal_awal;
            $tanggalAkhir = $request->tanggal_akhir;
        }

        return view('admin.dashboard.laporan.index', compact('tanggalAwal', 'tanggalAkhir'));
    }

    public function getData($awal, $akhir)
    {
        $awalDate = Carbon::parse($awal);
        $akhirDate = Carbon::parse($akhir);
        $tanggalRange = $awalDate->copy();

        $data = [];
        $total_penjualan = 0;
        $total_pembelian = 0;
        $total_pendapatan = 0;

        while ($tanggalRange->lte($akhirDate)) {
            $tanggal = $tanggalRange->format('Y-m-d');

            $total_penjualan_per_tanggal = Penjualan::whereDate('created_at', $tanggal)->sum('bayar');
            $total_pembelian_per_tanggal = Pembelian::whereDate('created_at', $tanggal)->sum('bayar');

            $pendapatan = $total_penjualan_per_tanggal - $total_pembelian_per_tanggal;
            $total_pendapatan += $pendapatan;

            $row = [
                'DT_RowIndex' => count($data) + 1,
                'tanggal' => tanggal_indonesia($tanggal, false),
                'penjualan' => 'Rp. ' . format_uang($total_penjualan_per_tanggal),
                'pembelian' => 'Rp. ' . format_uang($total_pembelian_per_tanggal),
                'pendapatan' => 'Rp. ' . format_uang($pendapatan),
            ];

            $data[] = $row;

            $total_penjualan += $total_penjualan_per_tanggal;
            $total_pembelian += $total_pembelian_per_tanggal;

            $tanggalRange->addDay(); // Tambah 1 hari ke tanggal range
        }

        $total_row = [
            'DT_RowIndex' => '',
            'tanggal' => 'Total Keseluruhan :',
            'penjualan' => 'Rp. ' . format_uang($total_penjualan),
            'pembelian' => 'Rp. ' . format_uang($total_pembelian),
            'pendapatan' => 'Rp. ' . format_uang($total_pendapatan),
        ];

        $data[] = $total_row;

        return $data;
    }


    public function data($awal, $akhir)
    {
        $data = $this->getData($awal, $akhir);

        return datatables()
            ->of($data)
            ->make(true);
    }

    // public function exportPDF($awal, $akhir)
    // {
    //     $data = $this->getData($awal, $akhir);
    //     $pdf  = PDF::loadView('admin.dashboard.laporan.pdf', compact('awal', 'akhir', 'data'));
    //     $pdf->setPaper('a4', 'potrait');

    //     return $pdf->stream('Laporan-pendapatan-' . date('Y-m-d-his') . '.pdf');
    // }

    public function exportPDF($awal, $akhir)
    {
        $data = $this->getData($awal, $akhir);
        return view('admin.dashboard.laporan.pdf', compact('awal', 'akhir', 'data'));
      
    }
}
