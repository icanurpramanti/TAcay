@extends('admin.dashboard.layout.template')

@section('content')

<div class="col-lg-12 grid-margin stretch-card">
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title text-center">Detail Data Kategori</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive-sm">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th class="text-right" style="width: 30%">Kode Kategori</th>
                    <td class="text-left">{{$kategori->kode_kategori}}</td>
                  </tr>
                  <tr>
                    <th class="text-right" style="width: 30%">Nama Kategori</th>
                    <td class="text-left">{{$kategori->nama_kategori}}</td>
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
