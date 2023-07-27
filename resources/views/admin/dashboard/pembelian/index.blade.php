@extends('admin.dashboard.layout.template')

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
        <button onclick="addForm()" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus-circle"></i> Transaksi Baru</button>
       
        <a href="/pembelian_detail" class="btn btn-info btn-xs btn-flat"><i class="fa fa-pencil"></i> Transaksi Aktif</a>
       
      </div>

      <div class="box-body table-responsive">
        <table class="table table-stiped table-bordered table-pembelian">
          <thead>
            <th width="5%">No</th>
            <th>Tanggal</th>
            <th>Supplier</th>
            <th>Total Item</th>
            <th>Total Harga</th>
            <th>Diskon</th>
            <th>Total Bayar</th>
            <th width="15%"><i class="fa fa-cog"></i></th>
          </thead>
          <tbody>
            @foreach ($pembelians as $key => $item)
            <tr>
              <td width="5%">{{ $key+1 }}</td>
              <td>{{ $item->created_at }}</td>
              <td>{{ $item->kode_supplier }}</td>
              <td>{{ $item->total_item }}</td>
              <td>{{ $item->total_harga }}</td>
              <td>{{ $item->diskon }}</td>
              <td>{{ $item->bayar }}</td>
              <td>
                <a href="#" class="btn btn-primary btn-xs btn-flat">
                  <i class="fa fa-check-circle"></i>
                  Pilih
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


@include('admin.dashboard.pembelian.supplier')
@includeIf('admin.dashboard.pembelian.detail')
@endsection

@push('scripts')
<script>
  let table, table1;

  // $(function() {
  //   table = $('.table-pembelian').DataTable({
  //     responsive: true,
  //     processing: true,
  //     serverSide: true,
  //     autoWidth: false,
  //     ajax: {
  //       url: '/pembelian/data',
  //     },
  //     columns: [{
  //         data: 'DT_RowIndex',
  //         searchable: false,
  //         sortable: false
  //       },
  //       {
  //         data: 'tanggal'
  //       },
  //       {
  //         data: 'supplier'
  //       },
  //       {
  //         data: 'total_item'
  //       },
  //       {
  //         data: 'total_harga'
  //       },
  //       {
  //         data: 'diskon'
  //       },
  //       {
  //         data: 'bayar'
  //       },
  //       {
  //         data: 'aksi',
  //         searchable: false,
  //         sortable: false
  //       },
  //     ]
  //   });

    $('.table-supplier').DataTable();
    table1 = $('.table-detail').DataTable({
      processing: true,
      bSort: false,
      dom: 'Brt',
      columns: [{
          data: 'DT_RowIndex',
          searchable: false,
          sortable: false
        },
        {
          data: 'kode_produk'
        },
        {
          data: 'nama_produk'
        },
        {
          data: 'harga_beli'
        },
        {
          data: 'jumlah'
        },
        {
          data: 'subtotal'
        },
      ]
    })
  


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