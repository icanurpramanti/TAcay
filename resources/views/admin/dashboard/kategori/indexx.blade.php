@extends('admin.dashboard.layout.template')

@section('content')

@if (session()->has('pesan'))
<div class="alert alert-success" role="alert">
    {{ session('pesan') }}
</div>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Kategori</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kategoriModal">
                    Data Kategori
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="tabel-data">
                        <thead class="text-primary">
                            <th>NO</th>
                            <th>Kode Kategori</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>

                            @foreach ($kategoris as $kategori)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kategori->kode_kategori }}</td>
                                <td>{{ $kategori->nama_kategori }}</td>
                                <td>
                                    <a href="{{ route('kategori-detail', $kategori->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>

                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#kategoriEdit{{ $kategori->id }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <form class="d-inline" action="/kategori/{{ $kategori->id }}" method="post">
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

    <!-- Createkategori-->
    <div class="card-body">
        <div class="modal fade" id="kategoriModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="card-header">
                        <h5 class="title text-center">Create Kategori</h5>
                    </div>
                    <form action="/kategori" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3" style="margin-left: 15px; margin-right: 15px; margin-top: 15px">
                            <label for="exampleFormControlInput1" class="form-label">Kode Kategori</label>
                            <input type="text" class="form-control @error('kode_kategori') is-invalid @enderror" value="{{ old('kode_kategori') }}" id="kode_kategori" name="kode_kategori">
                            @error('kode_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3" style="margin-left: 15px; margin-right: 15px; margin-top: 15px">
                            <label for="exampleFormControlInput1" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" value="{{ old('nama_kategori') }}" id="nama_kategori" name="nama_kategori">
                            @error('nama_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Editkategori -->
    @foreach ($kategoris as $kategori)
    <div class="modal fade" id="kategoriEdit{{ $kategori->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit kategori</h5>
                </div>
                <form action="/kategori/{{ $kategori->id }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kode_kategori" class="form-label">Kode Kategori</label>
                            <input type="text" class="form-control @error('kode_kategori') is-invalid @enderror" id="kode_kategori" name="kode_kategori" value="{{ old('kode_kategori', $kategori->kode_kategori) }}">
                            @error('kode_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}">
                            @error('nama_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
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
