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
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
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
        <div class="laporan-title">Laporan Penjualan SRC Rani Cell</div>
        <div class="laporan-date">
            Tanggal {{ tanggal_indonesia($awal, false) }} s/d Tanggal {{ tanggal_indonesia($akhir, false) }}
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th>Total Item</th>
                        <th>Total Harga</th>
                        <th> Diskon</th>
                        <th> Bayar</th>
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
    </div>
</body>

</html>