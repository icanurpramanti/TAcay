@extends('admin.dashboard.layout.template')

@section('content')

<div class="col-md-8">
  <div class="card card-user">
    <div class="card-header">
      <h5 class="card-title">Create Bank</h5>
    </div>
    <div class="card-body">
      <form action="/bank" method="post">
        
        @csrf

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Nama Bank</label>
          <input type="text" class="form-control @error ('nama_bank') is-invalid @enderror" 
          value="{{old('nama_bank')}}" id="nama_bank" name="nama_bank">
        </div>
        @error('nama_bank')
        {{ $message }}
        @enderror
        
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">No Rekening</label>
          <input type="text" class="form-control @error ('no_rek') is-invalid @enderror" 
          value="{{old('no_rek')}}" id="no_rek" name="no_rek">
        </div>
        @error('no_rek')
        {{ $message }}
        @enderror

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Pemilik Rekening</label>
          <input type="text" class="form-control @error ('pemilik_rekening') is-invalid @enderror" 
          value="{{old('pemilik_rekening')}}" id="pemilik_rekening" name="pemilik_rekening">
        </div>
        @error('pemilik_rekening')
        {{ $message }}
        @enderror


        
        <div class="row">
          <div class="update ml-auto mr-auto">
            <button type="submit" class="btn btn-primary btn-round">Create Bank</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
@endsection