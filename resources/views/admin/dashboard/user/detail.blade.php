@extends('admin.dashboard.layout.template')

@section('content')

<div class="col-lg-12 grid-margin stretch-card">
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title text-center">Detail Data User</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive-sm">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th class="text-right" style="width: 30%">Nama User</th>
                    <td class="text-left">{{$user->nama}}</td>
                  </tr>
                  <tr>
                    <th class="text-right" style="width: 30%">Level</th>
                    <td class="text-left">{{$user->level}}</td>
                  </tr>
                  <tr>
                    <th class="text-right" style="width: 30%">Email</th>
                    <td class="text-left">{{$user->email}}</td>
                  </tr>
                  <tr>
                    <th class="text-right" style="width: 30%">Alamat User</th>
                    <td class="text-left">{{$user->alamat_user}}</td>
                  </tr>
                  <tr>
                    <th class="text-right" style="width: 30%">No Hp</th>
                    <td class="text-left">{{$user->no_hp}}</td>
                  </tr>
                  <tr>
                    <th class="text-right" style="width: 30%">Foto User</th>
                    <td class="text-left">
                      <img src="{{asset('produk_image/'.$user->foto_user)}}" alt="No Image" width="100" height="100px">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection