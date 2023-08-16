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
                <h4 class="card-title p-2">DATA KATEGORI</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kategoriModal">
                    CREATE KATEGORI
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table table-striped table-hover" id="tabel-data">
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
                    <div class="modal-header">
                        <h5 class="modal-title text-center">CREATE KATEGORI</h5>
                    </div>
                    <form action="/kategori" method="post" class="p-3" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3 mt-3">
                                <label for="kode_kategori" class="form-label">Kode kategori</label>
                                <input type="text" class="form-control @error('kode_kategori') is-invalid @enderror" value="{{ \App\Models\Kategori::generateKode() }}" id="kode_kategori" name="kode_kategori" readonly>
                                @error('kode_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nama_kategori" class="form-label">Nama kategori</label>
                                <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" value="{{ old('nama_kategori') }}" id="nama_kategori" name="nama_kategori">
                                @error('nama_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
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


<!-- Editkategori -->
@foreach ($kategoris as $kategori)
<div class="card-body">
    <div class="modal fade" id="kategoriEdit{{ $kategori->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title">EDIT KATEGORI</h5>
                </div>
                <form action="/kategori/{{ $kategori->id }}" class="p-3" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="id" name="id" value="{{ $kategori->id }}">
                        <div class="mb-3 mt-3">
                            <label for="kode_kategori" class="form-label">Kode kategori</label>
                            <input type="text" class="form-control" id="kode_kategori" name="kode_kategori" value="{{ old('kode_kategori', $kategori->kode_kategori) }}">
                            @error('kode_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">Nama kategori</label>
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}">
                            @error('nama_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
</div>
@endforeach
@endsection

@section('footer')
@endsection