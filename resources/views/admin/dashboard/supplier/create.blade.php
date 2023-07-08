@extends('admin.dashboard.layout.template')

@section('content')

<div class="col-md-8">
  <div class="card card-user">
    <div class="card-header">
      <h5 class="card-title">Create Supplier</h5>
    </div>
    <div class="card-body">
      <form action="/supplier" method="post">

        @csrf

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Kode Supplier</label>
          <input type="text" class="form-control @error ('kode_supplier') is-invalid @enderror" 
          value="{{old('kode_supplier')}}" id="kode_supplier" name="kode_supplier">
        </div>
        @error('kode_supplier')
        {{ $message }}
        @enderror

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Nama Supplier</label>
          <input type="text" class="form-control @error ('nama_supplier') is-invalid @enderror" 
          value="{{old('nama_supplier')}}" id="nama_supplier" name="nama_supplier">
        </div>
        @error('nama_supplier')
        {{ $message }}
        @enderror

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">No HP</label>
          <input type="text" class="form-control @error ('no_hp') is-invalid @enderror" 
          value="{{old('no_hp')}}" id="no_hp" name="no_hp">
        </div>
        @error('no_hp')
        {{ $message }}
        @enderror

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Alamat Suplier</label>
          <input type="text" class="form-control @error ('alamat_supplier') is-invalid @enderror" 
          value="{{old('alamat_supplier')}}" id="alamat_supplier" name="alamat_supplier">
        </div>
        @error('alamat_supplier')
        {{ $message }}
        @enderror



        <div class="row">
          <div class="update ml-auto mr-auto text-center">
            <button type="submit" class="btn btn-primary btn-round">Create Supplier</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection