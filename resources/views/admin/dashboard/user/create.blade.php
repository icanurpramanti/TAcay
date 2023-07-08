@extends('admin.dashboard.layout.template')

@section('content')

<div class="col-md-8">
  <div class="card card-user">
    <div class="card-header">
      <h5 class="card-title">Create User</h5>
    </div>
    <div class="card-body">
      <form action="/user" method="post" enctype="multipart/form-data">

        @csrf

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Nama</label>
          <input type="text" class="form-control @error ('nama') is-invalid @enderror" 
          value="{{old('nama')}}" id="nama" name="nama">
        </div>
        @error('nama')
        {{ $message }}
        @enderror

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Level</label>
          <input type="text" class="form-control @error ('level') is-invalid @enderror" 
          value="{{old('level')}}" id="level" name="level">
        </div>
        @error('level')
        {{ $message }}
        @enderror

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Email</label>
          <input type="text" class="form-control @error ('email') is-invalid @enderror" 
          value="{{old('email')}}" id="email" name="email">
        </div>
        @error('email')
        {{ $message }}
        @enderror



        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Password</label>
          <input type="text" class="form-control @error ('password') is-invalid @enderror" 
          value="{{old('password')}}" id="password" name="password">
        </div>
        @error('password')
        {{ $message }}
        @enderror

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Alamat User</label>
          <input type="text" class="form-control @error ('alamat_user') is-invalid @enderror" 
          value="{{old('alamat_user')}}" id="alamat_user" name="alamat_user">
        </div>
        @error('alamat_user')
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

        <label for="">Pilih Foto</label>
        <input id="foto_user" type="file" class="form-control @error('foto_user') is-invalid @enderror" name="foto_user" autocomplete="new-foto_user">
          <!--
          <input type="file" class="form-control @error ('foto_user') is-invalid @enderror" 
           value="{{old('foto_user')}}" id="foto_user" name="foto_user"
           accept="image/*" onchange="document.getElementById('output').src =window.URL.createObjectURL(this.fle[0])"> -->


           @error('foto_user')
           <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>

          @enderror
        </div>



        <div class="row">
          <div class="update ml-auto mr-auto text-center">
            <button type="submit" class="btn btn-primary btn-round">Create User</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection