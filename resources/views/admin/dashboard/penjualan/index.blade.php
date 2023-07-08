@extends('admin.dashboard.layout.template')
@section('content')

@if (session()->has('pesan'))
<div class="alert alert-success" role="alert">
  {{session('pesan')}}
</div>
@endif
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Data Pembelian</h4>
        <div class="box-header with-border">
                <button onclick="addForm()" class="btn btn-success btn-xs btn-flat">
                  <i class="fa fa-plus-circle"></i> Transaksi Baru</button>
        </div>
      </div>

      <!-- Start kode untuk form pencarian -->
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="tabel-data">
                    <thead class=" text-primary">
                       <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th>Supplier</th>
                        <th>Total Item</th>
                        <th>Total Harga</th>
                        <th>Diskon</th>
                        <th>Total Bayar</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                  </thead>
              </table>
            </div>
          </div>
        </div>
      </div>

@includeIf('pembelian.supplier')
@includeIf('pembelian.detail')
@endsection

@push('scripts')
<script>
    let table, table1;
   
    function addForm() {
       $('#modal-supplier').modal('show');
      
    }
    
    function showDetail(url) {
        $('#modal-detail').modal('show');
        table1.ajax.url(url);
        table1.ajax.reload();
    }
    function deleteData(url) {
        if (confirm('Yakin ingin menghapus data terpilih?')) {
            $.post(url, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'delete'
                })
                .done((response) => {
                    table.ajax.reload();
                })
                .fail((errors) => {
                    alert('Tidak dapat menghapus data');
                    return;
                });
        }
    }
</script>
@endpush