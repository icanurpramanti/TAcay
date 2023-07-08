@extends('admin.dashboard.layout.template')

@section('content')

<div class="col-md-8">
  <div class="card card-user">
    <div class="card-header">
      <h5 class="card-title">Update Satuan</h5>
    </div>
    <div class="card-body">
      <form action="/satuan/{{ $satuans->id}}" method="post" >
        @method('put')
        @csrf


        <div class="mb-3">
          <label class="form-label">Kode Satuan</label>
          <input type="text" class="form-control" id="kode_satuan" 
          name="kode_satuan" value="{{old('kode_satuan',$satuans->kode_satuan)}}">
        </div>
        @error('kode_satuan')
        {{ $message }}
        @enderror
        
        <div class="mb-3">
          <label class="form-label">Nama Satuan</label>
          <input type="text" class="form-control" id="nama_satuan" 
          name="nama_satuan" value="{{old('nama_satuan',$satuans->nama_satuan)}}">
        </div>
        @error('nama_satuan')
        {{ $message }}
        @enderror
        
        
        <div class="row">
          <div class="update ml-auto mr-auto text-center">
            <button type="submit" class="btn btn-primary btn-round">Update Satuan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection