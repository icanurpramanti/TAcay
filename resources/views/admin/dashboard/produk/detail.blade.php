@extends('admin.dashboard.layout.template')

@section('content')

<div class="col-lg-12 grid-margin stretch-card">
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title text-center">Detail Data Produk</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive-sm">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th class="text-right" style="width: 30%">kode Produk</th>
                    <td class="text-left">{{$produk->kode_produk}}</td>
                  </tr>
                  <tr>
                    <th class="text-right" style="width: 30%">Nama Produk</th>
                    <td class="text-left"> {{$produk->nama_produk}}</td>
                  </tr>
                  <tr>
                    <th class="text-right" style="width: 30%">Kategori</th>
                    <td class="text-left"> {{$produk->kategori->nama_kategori}}</td>
                  </tr>
                  <tr>
                    <th class="text-right" style="width: 30%">Satuan</th>
                    <td class="text-left">{{$produk->satuan->nama_satuan}}</td>
                  </tr>
                  <tr>
                    <th class="text-right" style="width: 30%">Harga Beli</th>
                    <td class="text-left"> {{$produk->harga_beli}}</td>
                  </tr>
                  <tr>
                    <th class="text-right" style="width: 30%">Diskon</th>
                    <td class="text-left"> {{$produk->diskon}}</td>
                  </tr>
                  <tr>
                    <th class="text-right" style="width: 30%">Harga Jual</th>
                    <td class="text-left"> {{$produk->harga_jual}}</td>
                  </tr>
                  <tr>
                    <th class="text-right" style="width: 30%">Stok</th>
                    <td class="text-left"> {{$produk->stok}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection