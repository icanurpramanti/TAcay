@extends('admin.dashboard.layout.template')

@section('content')

<div class="col-md-8">
  <div class="card card-user">
    <div class="card-header">
      <h5 class="card-title">Create Produk</h5>
    </div>
    <div class="card-body">
      <form action="/produk" method="post" enctype="multipart/form-data>
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Kode Produk</label>
          <input type="text" class="form-control @error ('kode_produk') is-invalid @enderror" 
          value="{{old('kode_produk')}}" id="kode_produk" name="kode_produk">
        </div>
        @error('kode_produk')
        {{ $message }}
        @enderror

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
          <input type="text" class="form-control @error ('nama_produk') is-invalid @enderror" 
          value="{{old('nama_produk')}}" id="nama_produk" name="nama_produk">
        </div>
        @error('nama_produk')
        {{ $message }}
        @enderror

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Kategori</label>
          <select class="form-select" id="kode_kategori" name="kode_kategori">
            @foreach($kategoris as $kategori)
            <option value="{{ $kategori->id }} ">{{ $kategori->nama_kategori }}</option>
            @endforeach
          </select>
        </div>
        @error('nama_kategori')
        {{ $message }}
        @enderror  

        <div class="mb-3 mt-3">
          <label for="exampleFormControlInput1" class="form-label">Satuan</label></label>
          <select class="form-select" id="kode_satuan" name="kode_satuan">
            @foreach($satuans as $satuan)
            <option value="{{ $satuan->id }} ">{{ $satuan->nama_satuan }}</option>
            @endforeach
          </select>
        </div>
        @error('nama_satuan')
        {{ $message }}
        @enderror  

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Harga Beli</label>
          <input type="text" class="form-control @error ('harga_beli') is-invalid @enderror" 
          value="{{old('harga_beli')}}" id="harga_beli" name="harga_beli">
        </div>
        @error('harga_beli')
        {{ $message }}
        @enderror

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Diskon</label>
          <input type="text" class="form-control @error ('diskon') is-invalid @enderror" 
          value="{{old('diskon')}}" id="diskon" name="diskon">
        </div>
        @error('diskon')
        {{ $message }}
        @enderror


        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Harga Jual</label>
          <input type="text" class="form-control @error ('harga_jual') is-invalid @enderror" 
          value="{{old('harga_jual')}}" id="harga_jual" name="harga_jual">
        </div>
        @error('harga_jual')
        {{ $message }}
        @enderror


        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Stok</label>
          <input type="text" class="form-control @error ('stok') is-invalid @enderror" 
          value="{{old('stok')}}" id="stok" name="stok">
        </div>
        @error('stok')
        {{ $message }}
        @enderror


        <div class="row">
          <div class="update ml-auto mr-auto text-center">
            <button type="submit" class="btn btn-primary btn-round">Create Produk</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection