<?php

namespace App\Http\Controllers;
use App\Models\Pembelian;
use Carbon\Carbon;
use PDF;

use Illuminate\Http\Request;

class LaporanPembelianController extends Controller
{
    public function index(Request $request)
    {
        $tanggalAwal = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $tanggalAkhir = date('Y-m-d');

        if ($request->has('tanggal_awal') && $request->tanggal_awal != "" && $request->has('tanggal_akhir') && $request->tanggal_akhir) {
            $tanggalAwal = $request->tanggal_awal;
            $tanggalAkhir = $request->tanggal_akhir;
        }

        return view('admin.dashboard.laporanpembelian.index', compact('tanggalAwal', 'tanggalAkhir'));
    }

    public function getData($awal, $akhir)
    {
        $awalDate = Carbon::parse($awal);
        $akhirDate = Carbon::parse($akhir);
        $tanggalRange = $awalDate->copy();
    
        $data = [];
        $total_item = 0;
        $total_harga = 0;
        $total_pembelian = 0;
    
        while ($tanggalRange->lte($akhirDate)) {
            $tanggal = $tanggalRange->format('Y-m-d');
    
            $pembelian = Pembelian::whereDate('created_at', $tanggal)->get();
            
            $total_item_per_tanggal = 0;
            $total_harga_per_tanggal = 0;
            $total_pembelian_per_tanggal = 0;
    
            foreach ($pembelian as $item) {
                $total_item_per_tanggal += $item->total_item;
                $total_harga_per_tanggal += $item->total_harga;
                $total_pembelian_per_tanggal += $item->bayar;
    
                $row = [
                    'DT_RowIndex' => count($data) + 1,
                    'tanggal' => tanggal_indonesia($tanggal, false),
                    'supplier' => $item->supplier->nama_supplier, 
                    'total_item' => $item->total_item,
                    'total_harga' => 'Rp. ' . format_uang($item->total_harga),
                    'diskon' => $item->diskon . '%',
                    'total_bayar' => 'Rp. ' . format_uang($item->bayar),
                ];
    
                $data[] = $row;
            }
    
            $total_item += $total_item_per_tanggal;
            $total_harga += $total_harga_per_tanggal;
            $total_pembelian += $total_pembelian_per_tanggal;
    
            $tanggalRange->addDay();
        }
    
        $total_row = [
            'DT_RowIndex' => '',
            'tanggal' => 'Total Keseluruhan :',
            'supplier' => '',
            'total_item' => $total_item,
            'total_harga' => 'Rp. ' . format_uang($total_harga),
            'diskon' => '',
            'total_bayar' => 'Rp. ' . format_uang($total_pembelian),
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

    public function exportPDF($awal, $akhir)
    {
        $data = $this->getData($awal, $akhir);
        $pdf  = PDF::loadView('admin.dashboard.laporanpembelian.pdf', compact('awal', 'akhir', 'data'));
        $pdf->setPaper('a4', 'potrait');

        return $pdf->stream('Laporan-Pembelian-' . date('Y-m-d-his') . '.pdf');
    }

}
