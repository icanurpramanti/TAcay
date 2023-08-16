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
                <h4 class="card-title p-2">DATA USER</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">
                    CREATE USER
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table table-striped table-hover" id="tabel-data">
                        <thead class="text-primary">
                            <th>NO</th>
                            <th>Nama</th>
                            <th>Level</th>
                            <th>Email</th>
                            <th>Alamat User</th>
                            <th>No HP</th>
                            <th>Foto User</th>
                            <th>Aksi</th>
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
                                    <a href="{{route('user-detail',$user->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#userEdit{{$user->id}}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <form class="d-inline" action="/user/{{ $user->id }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Createuser-->
    <div class="card-body">
        <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center">CREATE USER</h5>
                    </div>
                    <form action="/user" method="post" class="p-3" enctype="multipart/form-data">

                        @csrf
                        <div class="modal-body">
                            <div class="mb-3 mt-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama </label>
                                <input type="text" class="form-control @error ('nama') is-invalid @enderror" value="{{old('nama')}}" id="nama" name="nama">
                            </div>
                            @error('nama')
                            {{ $message }}
                            @enderror

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Level</label>
                                <input type="text" class="form-control @error ('level') is-invalid @enderror" value="{{old('level')}}" id="level" name="level">
                            </div>
                            @error('level')
                            {{ $message }}
                            @enderror

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Email</label>
                                <input type="text" class="form-control @error ('email') is-invalid @enderror" value="{{old('email')}}" id="email" name="email">
                            </div>
                            @error('email')
                            {{ $message }}
                            @enderror

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Password</label>
                                <input type="text" class="form-control @error ('password') is-invalid @enderror" value="{{old('password')}}" id="password" name="password">
                            </div>
                            @error('password')
                            {{ $message }}
                            @enderror

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Alamat User</label>
                                <textarea class="form-control @error('alamat_user') is-invalid @enderror" value="{{old('alamat_user')}}" id="alamat_user" name="alamat_user"></textarea>
                            </div>
                            @error('alamat_user')
                            {{ $message }}
                            @enderror

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">No HP</label>
                                <input type="text" class="form-control @error ('no_hp') is-invalid @enderror" value="{{old('no_hp')}}" id="no_hp" name="no_hp">
                            </div>
                            @error('no_hp')
                            {{ $message }}
                            @enderror

                            <div class="mb-3" ">
                                <label for=" foto_user" class="form-label">Foto User</label>
                                <input type="file" class="form-control @error('foto_user') is-invalid @enderror" id="foto_user" name="foto_user">
                                @error('foto_user')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit User -->
@foreach ($users as $user)
<div class="modal fade" id="userEdit{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT USER</h5>
            </div>
            <form action="/user/{{$user->id}}" method="post" class="p-3" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="mb-3 mt-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $user->nama) }}">
                        @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Level</label>
                        <input type="text" class="form-control @error('level') is-invalid @enderror" id="level" name="level" value="{{ old('level', $user->level) }}">
                        @error('level')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password', $user->password) }}">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat_user" class="form-label">Alamat User</label>
                        <textarea class="form-control @error('alamat_user') is-invalid @enderror" id="alamat_user" name="alamat_user" rows="3">{{ old('alamat_user', $user->alamat_user) }}</textarea>
                        @error('alamat_user')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No HP</label>
                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}">
                        @error('no_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="foto_user" class="form-label">Foto User</label>
                        <div class="mb-3">
                            <img src="{{asset('produk_image/'.$user->foto_user)}}" alt="No Image" width="100">
                            <div class="row">
                                <input type="hidden" class="form-control" name="foto_user_lama" value="{{$user->foto_user}}" readonly>
                                <input type="file" class="form-control" name="foto_user" id="foto_user" placeholder="Enter foto">
                                <div class="text-danger">
                                    @error('foto_user')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection