<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pendapatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tambahkan gaya khusus untuk tabel */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .kopsurat {
            display: flex;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #000;
        }

        .image {
            flex-basis: 25%;
            padding-right: 20px;
        }

        .image img {
            max-width: 100%;
            height: auto;
        }

        .title {
            flex-basis: 60%;
            text-align: center;
        }


        /* Gaya untuk judul laporan */
        .laporan-title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }

        /* Gaya untuk tanggal laporan */
        .laporan-date {
            font-size: 18px;
            text-align: center;
            margin-bottom: 20px;
        }

        .pemilik-toko {
            text-align: right;
            margin-top: 20px;
            margin-right: 70px;
            /* Tambahkan margin ke kanan */

        }

        .tanda-tangan {
            margin-top: 40px;
            margin-right: 20px;
            /* Tambahkan margin ke kanan */
            text-align: right;
        }

        .tanda-tangan-label {
            margin-bottom: 10px;
            margin-right: 20px;
        }


        /* Gaya untuk menampilkan tabel responsif pada perangkat kecil */
        @media (max-width: 768px) {
            table {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="kopsurat">
            <!-- <div class="image" width="25%">
                    <img src="{{asset('assets/img/logoca.jpg')}}" alt="Logo">
                </div> -->
            <div class="title">
                <h1>SRC RANI CELL</h1>
                <p class="nohp">No Hp: 081363437701</p>
                <p class="address">Jalan Gurun Laweh NAN XX Kecamatan Lubuk Begalung</p>
            </div>
        </header>
        <div class="laporan-title">Laporan Pendapatan</div>
        <div class="laporan-date">
            Tanggal {{ tanggal_indonesia($awal, false) }} s/d Tanggal {{ tanggal_indonesia($akhir, false) }}
        </div>

        <div class="table-responsive">
            <table class="table table-success table-striped">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th>Penjualan</th>
                        <th>Pembelian</th>
                        <th>Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $row)
                    <tr>
                        @foreach ($row as $col)
                        <td>{{ $col }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pemilik-toko">
            Pak Eka
        </div>
        <div class="tanda-tangan">
            <div class="tanda-tangan-label"></div>
            <h1 style="font-weight: normal !important;">(................)</h1>
            <div class="tanda-tangan-space"></div>
        </div>
    </div>
</body>

</html>