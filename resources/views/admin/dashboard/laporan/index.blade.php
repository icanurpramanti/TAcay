@extends('admin.dashboard.layout.template')


@section('title')
    Laporan Pendapatan {{ tanggal_indonesia($tanggalAwal, false) }} s/d {{ tanggal_indonesia($tanggalAkhir, false) }}
@endsection

@push('css')
<link href="../assets/css/bootstrap-datepicker.min.css" rel="stylesheet" />
@endpush

@section('content')
@if (session()->has('pesan'))
<div class="alert alert-success" role="alert">
    {{ session('pesan') }}
</div>
@endif


<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <button onclick="ubahPeriode()" class="btn btn-info btn-xs btn-flat"><i class="fa fa-plus-circle"></i> Ubah Periode</button>
                <a href="{{ route('laporan.export_pdf', [$tanggalAwal, $tanggalAkhir]) }}" target="_blank" class="btn btn-success btn-xs btn-flat"><i class="fa fa-file-excel-o"></i> Export PDF</a>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-stiped table-bordered">
                    <thead>
                        <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th>Penjualan</th>
                        <th>Pembelian</th>
                        <th>Pendapatan</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@includeIf('admin.dashboard.laporan.form')
@endsection

@push('scripts')
<script src="../assets/js/plugins/bootstrap-datepicker.min.js"></script>
<script>
    let table;

    $(function () {
        table = $('.table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("laporan.data", [$tanggalAwal, $tanggalAkhir]) }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'tanggal'},
                {data: 'penjualan'},
                {data: 'pembelian'},
                {data: 'pendapatan'}
            ],
            dom: 'Brt',
            bSort: false,
            bPaginate: false,
        });

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });

    function ubahPeriode() {
        $('#modal-form').modal('show');
    }
</script>
@endpush