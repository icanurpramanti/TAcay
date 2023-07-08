@extends('admin.dashboard.layout.template')

@section('content')

<div class="col-md-8">
  <div class="card card-user">
    <div class="card-header">
      <h5 class="card-title">Create Satuan</h5>
    </div>
    <div class="card-body">
      <form action="/satuan" method="post">
        
        @csrf

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Kode Satuan</label>
          <input type="text" class="form-control @error ('kode_satuan') is-invalid @enderror" 
          value="{{old('kode_satuan')}}" id="kode_satuan" name="kode_satuan">
        </div>
        @error('kode_satuan')
        {{ $message }}
        @enderror
        
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Nama Satuan</label>
          <input type="text" class="form-control @error ('nama_satuan') is-invalid @enderror" 
          value="{{old('nama_satuan')}}" id="nama_satuan" name="nama_satuan">
        </div>
        @error('nama_satuan')
        {{ $message }}
        @enderror

        
        <div class="row">
          <div class="update ml-auto mr-auto text-center">
            <button type="submit" class="btn btn-primary btn-round">Create Satuan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection