<div class="modal fade" id="modal-produk" tabindex="-1" role="dialog" aria-labelledby="modal-produk">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">PILIH PRODUK</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-produk">
                    <thead>
                        <th width="5%">No</th>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Harga Beli</th>
                        <th>Barcode</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>
                    <tbody>
                        @foreach ($produks as $key => $item)
                        <tr>
                            <td width="5%">{{ $key+1 }}</td>
                            <td><span class="label label-success">{{ $item->kode_produk }}</span></td>
                            <td>{{ $item->nama_produk}}</td>
                            <td>{{ $item->harga_beli}}</td>
                            <td>
                                    {!! DNS1D::getBarcodeHTML($item->barcode, 'UPCA', 2, 50) !!}
                                    P-{{ $item->barcode }}
                                </td>
                            <td>
                                <a href="#" class="btn btn-primary btn-xs btn-flat" onclick="pilihProduk('{{ $item->kode_produk }}')">
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