@extends('admin.dashboard.layout.template')

@section('content')

<div class="col-md-8">
  <div class="card card-user">
    <div class="card-header">
      <h5 class="card-title">Update Supplier</h5>
    </div>
    <div class="card-body">
      <form action="/supplier/{{ $suppliers->id}}" method="post" >
        @method('put')
        @csrf


        <div class="mb-3">
          <label class="form-label">Kode Supplier</label>
          <input type="text" class="form-control" id="kode_supplier" 
          name="kode_supplier" value="{{old('kode_supplier',$suppliers->kode_supplier)}}">
        </div>
        @error('kode_supplier')
        {{ $message }}
        @enderror

        <div class="mb-3">
          <label class="form-label">Nama Supplier</label>
          <input type="text" class="form-control" id="nama_supplier" 
          name="nama_supplier" value="{{old('nama_supplier',$suppliers->nama_supplier)}}">
        </div>
        @error('nama_supplier')
        {{ $message }}
        @enderror
        
        <div class="mb-3">
          <label class="form-label">No HP</label>
          <input type="text" class="form-control" id="no_hp" 
          name="no_hp" value="{{old('no_hp',$suppliers->no_hp)}}">
        </div>
        @error('no_hp')
        {{ $message }}
        @enderror

        <div class="mb-3">
          <label class="form-label">Alamat Supplier</label>
          <input type="text" class="form-control" id="alamat_supplier" 
          name="alamat_supplier" value="{{old('alamat_supplier',$suppliers->alamat_supplier)}}">
        </div>
        @error('alamat_supplier')
        {{ $message }}
        @enderror
        
        <div class="row">
          <div class="update ml-auto mr-auto text-center">
            <button type="submit" class="btn btn-primary btn-round">Update Supplier</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection