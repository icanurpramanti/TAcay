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
                <h4 class="card-title p-2">DATA SATUAN</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#satuanModal">
                    CREATE SATUAN
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="tabel-data">
                        <thead class="text-primary">
                            <th>NO</th>
                            <th>Kode Satuan</th>
                            <th>Nama Satuan</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>

                            @foreach ($satuans as $satuan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $satuan->kode_satuan }}</td>
                                <td>{{ $satuan->nama_satuan }}</td>
                                <td>
                                    <a href="{{ route('satuan-detail', $satuan->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>

                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#satuanEdit{{ $satuan->id }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <form class="d-inline" action="/satuan/{{ $satuan->id }}" method="post">
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

    <!-- Createsatuan-->
    <div class="card-body">
        <div class="modal fade" id="satuanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center">CREATE SATUAN</h5>
                    </div>
                    <form action="/satuan" class="p-3" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3 mt-3">
                                <label for="kode_satuan" class="form-label">Kode Satuan</label>
                                <input type="text" class="form-control @error('kode_satuan') is-invalid @enderror" value="{{ \App\Models\Satuan::generateKode() }}" id="kode_satuan" name="kode_satuan" readonly">
                                @error('kode_satuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nama_satuan" class="form-label">Nama Satuan</label>
                                <input type="text" class="form-control @error('nama_satuan') is-invalid @enderror" value="{{ old('nama_satuan') }}" id="nama_satuan" name="nama_satuan">
                                @error('nama_satuan')
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


<!-- Editsatuan -->
@foreach ($satuans as $satuan)
<div class="card-body">
    <div class="modal fade" id="satuanEdit{{ $satuan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">EDIT SATUAN</h5>
                </div>
                <form action="/satuan/{{ $satuan->id }}" class="p-3" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="id" name="id" value="{{ $satuan->id }}">
                        <div class="mb-3 mt-3">
                            <label for="kode_satuan" class="form-label">Kode Satuan</label>
                            <input type="text" class="form-control" id="kode_satuan" name="kode_satuan" value="{{ old('kode_satuan', $satuan->kode_satuan) }}">
                            @error('kode_satuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nama_satuan" class="form-label">Nama Satuan</label>
                            <input type="text" class="form-control" id="nama_satuan" name="nama_satuan" value="{{ old('nama_satuan', $satuan->nama_satuan) }}">
                            @error('nama_satuan')
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