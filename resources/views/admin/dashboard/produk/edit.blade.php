    @extends('admin.dashboard.layout.template')

    @section('content')

    <div class="col-md-8">
      <div class="card card-user">
        <div class="card-header">
          <h5 class="card-title">Update Produk</h5>
        </div>
        <div class="card-body">
          <form action="/produk/{{ $produks->id}}" method="post" >
            @method('put')
            @csrf


            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Kode Produk</label>
              <input type="text" class="form-control @error ('kode_produk') is-invalid @enderror"  value="{{old('kode_produk',$produks->kode_produk)}}" id="kode_produk" name="kode_produk">
            </div>
            @error('kode_produk')
            {{ $message }}
            @enderror


            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
              <input type="text" class="form-control @error ('nama_produk') is-invalid @enderror"  value="{{old('nama_produk',$produks->nama_produk)}}" id="nama_produk" name="nama_produk">
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


           <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Satuan</label>
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
          <label class="form-label">Harga Beli</label>
          <input type="text" class="form-control" id="harga_beli" 
          name="harga_beli" value="{{old('harga_beli',$produks->harga_beli)}}">
        </div>
        @error('harga_beli')
        {{ $message }}
        @enderror

        <div class="mb-3">
          <label class="form-label">Diskon</label>
          <input type="text" class="form-control" id="diskon" 
          name="diskon" value="{{old('diskon',$produks->diskon)}}">
        </div>
        @error('diskon')
        {{ $message }}
        @enderror


        <div class="mb-3">
          <label class="form-label">Harga Jual</label>
          <input type="text" class="form-control" id="harga_jual" 
          name="harga_jual" value="{{old('harga_jual',$produks->harga_jual)}}">
        </div>
        @error('harga_jual')
        {{ $message }}
        @enderror

        <div class="mb-3">
          <label class="form-label">Stok</label>
          <input type="text" class="form-control" id="stok" 
          name="stok" value="{{old('stok',$produks->stok)}}">
        </div>
        @error('stok')
        {{ $message }}
        @enderror

        <div class="row">
          <div class="update ml-auto mr-auto text-center">
            <button type="submit" class="btn btn-primary btn-round">Update Produk</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

  @endsection