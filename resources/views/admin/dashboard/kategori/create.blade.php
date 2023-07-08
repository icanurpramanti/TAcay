@extends('admin.dashboard.layout.template')

@section('content')

<div class="col-md-8">
  <div class="card card-user">
    <div class="card-header">
      <h5 class="card-title">Create Kategori</h5>
    </div>
    <div class="card-body">
      <form action="/kategori" method="post">
        
        @csrf
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Kode Kategori</label>
          <input type="text" class="form-control @error ('kode_kategori') is-invalid @enderror"  
          value="{{old('kode_kategori')}}" id="kode_kategori" name="kode_kategori">
        </div>
        @error('kode_kategori')
        {{ $message }}
        @enderror

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Nama Kategori</label>
          <input type="text" class="form-control @error ('nama_kategori') is-invalid @enderror" 
          value="{{old('nama_kategori')}}" id="nama_kategori" name="nama_kategori">
        </div>
        @error('nama_kategori')
        {{ $message }}
        @enderror

        
        <div class="row">
          <div class="update ml-auto mr-auto text-center">
            <button type="submit" class="btn btn-primary btn-round">Create Kategori</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection