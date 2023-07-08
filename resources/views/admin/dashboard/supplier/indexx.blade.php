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
                <h4 class="card-title">Data Supplier</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#supplierModal">
                    Data Supplier
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="tabel-data">
                        <thead class=" text-primary">
                            <th> NO</th>
                            <th> Kode Supplier </th>
                            <th> Nama Supplier </th>
                            <th> No HP </th>
                            <th> Alamat Supplier </th>
                            <th> Aksi </th>
                        </thead>
                        <tbody>

                            @foreach ($suppliers as $supplier)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$supplier->kode_supplier}}</td>
                                <td>{{$supplier->nama_supplier}}</td>
                                <td>{{$supplier->no_hp}}</td>
                                <td>{{$supplier->alamat_supplier}}</td>
                                <td>

                                    <a href="{{route('supplier-detail',$supplier->id)}}" class="btn  btn-primary"><i class="fa fa-eye "></i></a>

                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#supplierEdit{{$supplier->id}}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <form class="d-inline" action="/supplier/{{ $supplier->id }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ?')">
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

    <!-- create supplier -->
    <div class="card-body">
        <div class="modal fade" id="supplierModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="card-header">
                        <h5 class="title text-center">Create Supplier</h5>
                    </div>
                    <form action="/supplier" method="post" enctype="multipart/form-data">

                        @csrf
                        <div class="mb-3" style="margin-left:15px; margin-right:15px; margin-top:15px">
                            <label for="exampleFormControlInput1" class="form-label">Kode Supplier </label>
                            <input type="text" class="form-control @error ('kode_supplier') is-invalid @enderror" value="{{old('kode_supplier')}}" id="kode_supplier" name="kode_supplier">
                        </div>
                        @error('kode_supplier')
                        {{ $message }}
                        @enderror

                        <div class="mb-3" style="margin-left:15px; margin-right:15px; margin-top:15px">
                            <label for="exampleFormControlInput1" class="form-label">Nama Supplier</label>
                            <input type="text" class="form-control @error ('nama_supplier') is-invalid @enderror" value="{{old('nama_supplier')}}" id="nama_supplier" name="nama_supplier">
                        </div>
                        @error('nama_supplier')
                        {{ $message }}
                        @enderror

                        <div class="mb-3" style="margin-left:15px; margin-right:15px; margin-top:15px">
                            <label for="exampleFormControlInput1" class="form-label">No Hp</label>
                            <input type="text" class="form-control @error ('no_hp') is-invalid @enderror" value="{{old('no_hp')}}" id="no_hp" name="no_hp">
                        </div>
                        @error('no_hp')
                        {{ $message }}
                        @enderror

                        <div class="mb-3" style="margin-left:15px; margin-right:15px; margin-top:15px">
                            <label for="exampleFormControlInput1" class="form-label">Alamat Supplier</label>
                            <input type="text" class="form-control @error ('alamat_supplier') is-invalid @enderror" value="{{old('alamat_supplier')}}" id="alamat_supplier" name="alamat_supplier">
                        </div>
                        @error('alamat_supplier')
                        {{ $message }}
                        @enderror

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Editsupplier -->
    @foreach ($suppliers as $supplier)
    <div class="modal fade" id="supplierEdit{{$supplier->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card-header">
                    <h5 class="title text-center">Update Supplier</h5>
                </div>
                <form action="/supplier/{{ $supplier->id}}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf

                    <input type="hidden" class="form-control" id="id" name="id" value="{{$supplier->id}}">


                    <div class="mb-3" style="margin-left:15px; margin-right:15px; margin-top:15px">
                        <label class="form-label">Kode Supplier</label>
                        <input type="text" class="form-control" id="kode_supplier" name="kode_supplier" value="{{old('kode_supplier',$supplier->kode_supplier)}}">
                    </div>
                    @error('kode_supplier')
                    {{ $message }}
                    @enderror

                    <div class="mb-3" style="margin-left:15px; margin-right:15px; margin-top:15px">
                        <label class="form-label">Nama Supplier</label>
                        <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" value="{{old('nama_supplier',$supplier->nama_supplier)}}">
                    </div>
                    @error('nama_supplier')
                    {{ $message }}
                    @enderror

                    <div class="mb-3" style="margin-left:15px; margin-right:15px; margin-top:15px">
                        <label class="form-label">No Hp</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{old('no_hp',$supplier->no_hp)}}">
                    </div>
                    @error('no_hp')
                    {{ $message }}
                    @enderror

                    <div class="mb-3" style="margin-left:15px; margin-right:15px; margin-top:15px">
                        <label class="form-label">Alamat Supplier</label>
                        <input type="text" class="form-control" id="alamat_supplier" name="alamat_supplier" value="{{old('alamat_supplier',$supplier->alamat_supplier)}}">
                    </div>
                    @error('alamat_supplier')
                    {{ $message }}
                    @enderror

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection