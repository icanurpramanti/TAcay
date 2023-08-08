<div class="modal fade" id="modal-supplier" tabindex="-1" role="dialog" aria-labelledby="modal-supplier-label">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"  id="modal-supplier-label">PILIH SUPPLIER</h4>


      </div>
      <div class="modal-body">
        <table class="table table-striped table-bordered table-supplier">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th>Kode Supplier</th>
              <th>Nama Supplier</th>
              <th>No Hp</th>
              <th>Alamat Supplier</th>
              <th><i class="fa fa-cog"></i></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($suppliers as $key => $item)
            <tr>
              <td width="5%">{{ $key+1 }}</td>
              <td>{{ $item->kode_supplier }}</td>
              <td>{{ $item->nama_supplier }}</td>
              <td>{{ $item->no_hp }}</td>
              <td>{{ $item->alamat_supplier }}</td>
              <td>
                <a href="{{ route('pembelian.create', $item->kode_supplier) }}" class="btn btn-primary btn-xs btn-flat">
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