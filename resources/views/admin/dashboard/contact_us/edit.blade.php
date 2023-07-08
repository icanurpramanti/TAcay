@extends('admin.dashboard.layout.template')

@section('content')

<div class="col-md-8">
  <div class="card card-user">
    <div class="card-header">
      <h5 class="card-title">Update Bank</h5>
    </div>
    <div class="card-body">
      <form action="/bank/{{ $banks->id}}" method="post" >
        @method('put')
        @csrf


        <div class="mb-3">
          <label class="form-label">Nama Bank</label>
          <input type="text" class="form-control" id="nama_bank" 
          name="nama_bank" value="{{old('nama_bank',$banks->nama_bank)}}">
        </div>
        @error('nama_bank')
        {{ $message }}
        @enderror
        
        <div class="mb-3">
          <label class="form-label">No Rekening</label>
          <input type="text" class="form-control" id="no_rek" 
          name="no_rek" value="{{old('no_rek',$banks->no_rek)}}">
        </div>
        @error('no_rek')
        {{ $message }}
        @enderror

        <div class="mb-3">
          <label class="form-label">Pemilik Rekening</label>
          <input type="text" class="form-control" id="pemilik_rekening" 
          name="pemilik_rekening" value="{{old('pemilik_rekening',$banks->pemilik_rekening)}}">
        </div>
        @error('pemilik_rekening')
        {{ $message }}
        @enderror
        
        

        
        <div class="row">
          <div class="update ml-auto mr-auto">
            <button type="submit" class="btn btn-primary btn-round">Update Bank</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
@endsection