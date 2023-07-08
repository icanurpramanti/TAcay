@extends('admin.dashboard.layout.template')

@section('content')

<div class="col-md-8">
  <div class="card card-user">
    <div class="card-header">
      <h5 class="card-title">Update Kategori</h5>
    </div>
    <div class="card-body">
      <form action="/kategori/{{ $kategoris->id}}" method="post" >
        @method('put')
        @csrf

        <div class="mb-3">
          <label class="form-label">Kode Kategori</label>
          <input type="text" class="form-control" id="kode_kategori" name="kode_kategori"
          value="{{old('kode_kategori',$kategoris->kode_kategori)}}">
        </div>
        @error('kode_kategori')
        {{ $message }}
        @enderror

        
        <div class="mb-3">
          <label class="form-label">Nama Kategori</label>
          <input type="text" class="form-control" id="nama_kategori" 
          name="nama_kategori" value="{{old('nama_kategori',$kategoris->nama_kategori)}}">
        </div>
        @error('nama_kategori')
        {{ $message }}
        @enderror
        

        
        <div class="row">
          <div class="update ml-auto mr-auto text-center">
            <button type="submit" class="btn btn-primary btn-round">Update Kategori</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection