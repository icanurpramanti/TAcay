@extends('admin.dashboard.layout.template')

@section('content')

<div class="col-md-8">
  <div class="card card-user">
    <div class="card-header">
      <h5 class="card-title">Update User</h5>
    </div>
    <div class="card-body">
      <form action="/user/{{ $users->id}}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf

        <input type="hidden" class="form-control" id="id" name="id" value="{{$users->id}}">

        <div class="mb-3">
          <label class="form-label">Nama</label>
          <input type="text" class="form-control" id="nama" name="nama" value="{{old('nama',$users->nama)}}">
        </div>
        @error('nama')
        {{ $message }}
        @enderror

        <div class="mb-3">
          <label class="form-label">Level</label>
          <input type="text" class="form-control" id="level" name="level" value="{{old('level',$users->level)}}">
        </div>
        @error('level')
        {{ $message }}
        @enderror

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="text" class="form-control" id="email" name="email" value="{{old('email',$users->email)}}">
        </div>
        @error('email')
        {{ $message }}
        @enderror

        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="text" class="form-control" id="password" name="password" value="{{old('password',$users->password)}}">
        </div>
        @error('password')
        {{ $message }}
        @enderror

        <div class="mb-3">
          <label class="form-label">Alamat User</label>
          <input type="text" class="form-control" id="alamat_user" name="alamat_user" value="{{old('alamat_user',$users->alamat_user)}}">
        </div>
        @error('alamat_user')
        {{ $message }}
        @enderror

        <div class="mb-3">
          <label class="form-label">No HP</label>
          <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{old('no_hp',$users->no_hp)}}">
        </div>
        @error('no_hp')
        {{ $message }}
        @enderror

         <div class="mb-3">
          <img src="{{asset('produk_image/'.$users->foto_user)}}" alt="No Image" width="100">
          <div class="row">
            <input type="hidden" class="form-control" name="foto_user_lama" value="{{$users->foto_user}}" readonly>
            <input type="file" class="form-control" name="foto_user" id="foto_user" placeholder="Enter foto" value="{{old('foto_user')}}">
            <div class="text-danger">
              @error('foto_user')
              {{ $message }}
              @enderror
            </div>
          </div>
        </div>


        <div class="row">
          <div class="update ml-auto mr-auto text-center">
            <button type="submit" class="btn btn-primary btn-round">Update User</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection