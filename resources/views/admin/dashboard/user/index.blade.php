@extends('admin.dashboard.layout.template')

@section('content')

@if (session()->has('pesan'))
<div class="alert alert-success" role="alert">
  {{session('pesan')}}
</div>
@endif
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Data User</h4>
        <a href="/user/create" class="btn btn-primary my-2 ">Create User</a>
      </div>

      <!-- Start kode untuk form pencarian -->
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <form class="form" method="get" action="{{ route('search') }}">
                <div class="form-group w-100 mb-3">
                  <label for="search" class="d-block mr-2">Pencarian</label>
                  <input type="text" name="search" class="form-control w-75 d-inline" id="search" placeholder="Masukkan keyword">
                  <button type="submit" class="btn btn-primary mb-1">Cari</button>
                </div>
              </form>

              <!-- Start kode untuk form pencarian -->
              @if ($message = Session::get('success'))
              <div class="alert alert-success">
                <p>{{ $message }}</p>
              </div>
              @endif

              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="tabel-data">
                    <thead class=" text-primary">
                      <th> NO </th>
                      <th> Nama </th>
                      <th> Level</th>
                      <th> Email </th>
                      <th> Alamat User</th>
                      <th> No HP</th>
                      <th> Foto User </th>
                      <th> Aksi </th>
                    </thead>
                    <tbody>

                      @foreach ($users as $user)

                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$user->nama}}</td>
                        <td>{{$user->level}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->alamat_user}}</td>
                        <td>{{$user->no_hp}}</td>
                        <td><img src="{{asset('produk_image/'.$user->foto_user)}}" alt="No Image" width="100" height="100px"></td>
                        <td>
                          <a href="{{route('user-detail',$user->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-eye "></i></a>
                          <a href="/user/{{$user->id}}/edit" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                          <form class="d-inline" action="/user/{{ $user->id }}" method="post">
                            @csrf
                            @method('delete')

                            <button class="btn btn-sm btn-danger"><i class="fa fa-trash" onclick="return confirm('Yakin ingin menghapus data ?')"></i></a></button>
                          </form>
                        </td>
                      </tr>
                    </tbody>
                    @endforeach
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection