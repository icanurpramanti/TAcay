<?php

function format_uang($angka)
{
    return number_format($angka, 0, ',', '.');
}

function terbilang($angka)
{
    $angka = abs($angka);
    $baca = array(
        '', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam',
        'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas'
    );
    $terbilang = '';

    if ($angka < 12) {
        $terbilang = ' ' . $baca[$angka];
    } else if ($angka < 20) {
        $terbilang = terbilang($angka - 10) . ' belas';
    } else if ($angka < 100) {
        $terbilang = terbilang($angka / 10) . ' puluh ' . terbilang($angka % 10);
    } else if ($angka < 200) {
        $terbilang = 'seratus' . terbilang($angka - 100);
    } else if ($angka < 1000) {
        $terbilang = terbilang($angka / 100) . ' ratus ' . terbilang($angka % 100);
    } else if ($angka < 2000) {
        $terbilang = 'seribu' . terbilang($angka - 1000);
    } else if ($angka < 1000000) {
        $terbilang = terbilang($angka / 1000) . ' ribu ' . terbilang($angka % 1000);
    } else if ($angka < 100000000) {
        $terbilang = terbilang($angka / 1000000) . ' juta ' . terbilang($angka % 1000000);
    }

    return $terbilang;
}

function tanggal_indonesia($tgl, $tampil_hari = true)
{
    $nama_hari = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu');
    $nama_bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mai', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

    // 2002-02-05
    $tahun = substr($tgl, 0, 4);
    $bulan = $nama_bulan[(int) substr($tgl, 5, 2)];
    $tanggal = substr($tgl, 8, 2);
    $text = '';

    if ($tampil_hari) {
        $urutan_hari = date('w', mktime(0, 0, 0, substr($tgl, 5, 2), $tanggal, $tahun));
        $hari        = $nama_hari[$urutan_hari];
        $text       .= "$hari, $tanggal $bulan $tahun";
    } else {
        $text       .= "$tanggal $bulan $tahun";
    }

    return $text;

    function tambah_nol_di_depan($value, $threshold = null)
    {
        return sprintf("%0" . $threshold . "s", $value);
    }
}
