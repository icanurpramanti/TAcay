<?php

namespace App\Http\Controllers;
use App\Models\Penjualan;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;

class LaporanPenjualanController extends Controller
{
    public function index(Request $request)
    {
        $tanggalAwal = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $tanggalAkhir = date('Y-m-d');

        if ($request->has('tanggal_awal') && $request->tanggal_awal != "" && $request->has('tanggal_akhir') && $request->tanggal_akhir) {
            $tanggalAwal = $request->tanggal_awal;
            $tanggalAkhir = $request->tanggal_akhir;
        }

        return view('admin.dashboard.laporanpenjualan.index', compact('tanggalAwal', 'tanggalAkhir'));
    }

    
    public function getData($awal, $akhir)
    {
        $awalDate = Carbon::parse($awal);
        $akhirDate = Carbon::parse($akhir);
        $tanggalRange = $awalDate->copy();
    
        $data = [];
        $total_item = 0;
        $total_harga = 0;
        $total_penjualan = 0;
    
        while ($tanggalRange->lte($akhirDate)) {
            $tanggal = $tanggalRange->format('Y-m-d');
    
            $penjualan = Penjualan::whereDate('created_at', $tanggal)->get();
            
            $total_item_per_tanggal = 0;
            $total_harga_per_tanggal = 0;
            $total_penjualan_per_tanggal = 0;
    
            foreach ($penjualan as $item) {
                $total_item_per_tanggal += $item->total_item;
                $total_harga_per_tanggal += $item->total_harga;
                $total_penjualan_per_tanggal += $item->bayar;
    
                $row = [
                    'DT_RowIndex' => count($data) + 1,
                    'tanggal' => tanggal_indonesia($tanggal, false), 
                    'total_item' => $item->total_item,
                    'total_harga' => 'Rp. ' . format_uang($item->total_harga),
                    'diskon' => $item->diskon . '%',
                    'bayar' => 'Rp. ' . format_uang($item->bayar),
                    'user' => $item->user->level, 
                ];
    
                $data[] = $row;
            }
    
            $total_item += $total_item_per_tanggal;
            $total_harga += $total_harga_per_tanggal;
            $total_penjualan += $total_penjualan_per_tanggal;
    
            $tanggalRange->addDay();
        }
    
        $total_row = [
            'DT_RowIndex' => '',
            'tanggal' => 'Total Keseluruhan :',
            'total_item' => $total_item,
            'total_harga' => 'Rp. ' . format_uang($total_harga),
            'diskon' => '',
            'bayar' => 'Rp. ' . format_uang($total_penjualan),
            'user' => '',
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
    //     $pdf  = PDF::loadView('admin.dashboard.laporanpenjualan.pdf', compact('awal', 'akhir', 'data'));
    //     $pdf->setPaper('a4', 'potrait');

    //     return $pdf->stream('Laporan-Penjualan-' . date('Y-m-d-his') . '.pdf');
    // }

    public function exportPDF($awal, $akhir)
    {
        $data = $this->getData($awal, $akhir);
        return view('admin.dashboard.laporanpenjualan.pdf', compact('awal', 'akhir', 'data'));
       
    }
}
