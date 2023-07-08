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
        <h4 class="card-title">Data Bank</h4>
        <a href="/bank/create" class="btn btn-primary my-2 ">Create Bank</a>
      </div>

      <!-- Start kode untuk form pencarian -->
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <form class="form" method="get" action="{{ route('searchbank') }}">
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
                      <th> NO</th>
                      <th>  Nama Bank </th>
                      <th>  No Rek  </th>
                      <th>Pemilik Rekening</th>
                      <th> Aksi  </th>
                    </thead>
                    <tbody>

                      @foreach ($banks as $bank)

                      <tr>
                       <td>{{$loop->iteration}}</td>
                       <td>{{$bank->nama_bank}}</td>
                       <td>{{$bank->no_rek}}</td>
                       <td>{{$bank->pemilik_rekening}}</td>
                       <td> 

                        <a href="/bank/{{$bank->id}}/edit" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                        <form  class="d-inline" action="/bank/{{ $bank->id }}" method="post">
                          @method('delete')
                          @csrf
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

@endsection          