@extends('admin.dashboard.layout.template')

@section('content')

<style>
  .blue-bg {
    background-color: blue;
    color: black;
  }
</style>

<div class="col-lg-12 grid-margin stretch-card">
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title text-center">Detail Data Supplier</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive-sm">
              <table class="table table-striped table-hover">
                <tbody>
                  <tr>
                    <th class="text-right" style="width: 30%">Kode Supplier</th>
                    <td class="text-left"> {{$supplier->kode_supplier}}</td>
                  </tr>
                  <tr>
                    <th class="text-right" style="width: 30%">Nama Supplier</th>
                    <td class="text-left"> {{$supplier->nama_supplier}}</td>
                  </tr>
                  <tr>
                    <th class="text-right" style="width: 30%">No Hp</th>
                    <td class="text-left"> {{$supplier->no_hp}}</td>
                  </tr>
                  <tr>
                    <th class="text-right" style="width: 30%">Alamat Supplier</th>
                    <td class="text-left"> {{$supplier->alamat_supplier}}</td>
                  </tr>
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