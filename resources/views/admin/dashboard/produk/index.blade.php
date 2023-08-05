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
                <h4 class="card-title p-2">DATA PRODUK</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#produkModal">
                    CREATE PRODUK
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="tabel-data">
                        <thead class=" text-primary">
                            <th>NO</th>
                            <th>Kode Produk </th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Satuan</th>
                            <th>Harga Beli</th>
                            <th>Diskon</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th> Aksi</th>
                        </thead>
                        <tbody>

                            @foreach ($produks as $produk)

                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$produk->kode_produk}}</td>
                                <td>{{$produk->nama_produk}}</td>
                                <td>{{$produk->kategori->nama_kategori}}</td>
                                <td>{{$produk->satuan->nama_satuan}}</td>
                                <td>{{$produk->harga_beli}}</td>
                                <td>{{$produk->diskon}}</td>
                                <td>{{$produk->harga_jual}}</td>
                                <td>{{$produk->stok}}</td>
                                <td>
                                    <a href="{{route('produk-detail',$produk->id)}}" class="btn  btn-primary"><i class="fa fa-eye "></i></a>

                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#produkEdit<?php echo $produk['id'] ?>">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <form class="d-inline" action="/produk/{{ $produk->id }}" method="post">
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

    <!-- Createproduk-->
    <div class="card-body">
        <div class="modal fade" id="produkModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content p-3">
                    <div class="modal-header">
                        <h5 class="title text-center">CREATE PRODUK</h5>
                    </div>
                    <form action="/produk" method="post" enctype="multipart/form-data">

                        @csrf
                        <div class="modal-body">
                            <div class="mb-3 mt-3">
                                <label for="exampleFormControlInput1" class="form-label">Kode Produk </label>
                                <input type="text" class="form-control @error ('kode_produk') is-invalid @enderror" value="{{ \App\Models\Produk::generateKode() }}" id="kode_produk" name="kode_produk" readonly>
                            </div>
                            @error('kode_produk')
                            {{ $message }}
                            @enderror

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control @error ('nama_produk') is-invalid @enderror" value="{{old('nama_produk')}}" id="nama_produk" name="nama_produk">
                            </div>
                            @error('nama_produk')
                            {{ $message }}
                            @enderror

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Kategori</label>
                                <select class="form-control @error ('kode_kategori') is-invalid @enderror" id="kode_kategori" name="kode_kategori">
                                    @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('kode_kategori')
                            {{ $message }}
                            @enderror

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Satuan</label>
                                <select class="form-control @error ('kode_satuan') is-invalid @enderror" id="kode_satuan" name="kode_satuan">
                                    @foreach($satuans as $satuan)
                                    <option value="{{ $satuan->id }}">{{ $satuan->nama_satuan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('kode_satuan')
                            {{ $message }}
                            @enderror

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Harga Beli</label>
                                <input type="text" class="form-control @error ('harga_beli') is-invalid @enderror" value="{{old('harga_beli')}}" id="harga_beli" name="harga_beli">
                            </div>
                            @error('harga_beli')
                            {{ $message }}
                            @enderror

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Diskon</label>
                                <input type="text" class="form-control @error ('diskon') is-invalid @enderror" value="{{old('diskon')}}" id="diskon" name="diskon">
                            </div>
                            @error('diskon')
                            {{ $message }}
                            @enderror

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Harga Jual</label>
                                <input type="text" class="form-control @error ('harga_jual') is-invalid @enderror" value="{{old('harga_jual')}}" id="harga_jual" name="harga_jual">
                            </div>
                            @error('harga_jual')
                            {{ $message }}
                            @enderror

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Stok</label>
                                <input type="text" class="form-control @error ('stok') is-invalid @enderror" value="{{old('stok')}}" id="stok" name="stok">
                            </div>
                            @error('stok')
                            {{ $message }}
                            @enderror


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


<!-- Editproduk -->
@foreach ($produks as $produk)
<div class="card-body">
    <div class="modal fade" id="produkEdit{{$produk->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-3">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">EDIT PRODUK</h5>
                </div>
                <form action="/produk/{{ $produk->id}}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="id" name="id" value="{{$produk->id}}">

                        <div class="mb-3 mt-3">
                            <label class="form-label">Kode Produk</label>
                            <input type="text" class="form-control @error('kode_produk') is-invalid @enderror" id="kode_produk" name="kode_produk" value="{{ old('kode_produk', $produk->kode_produk) }}">
                            @error('kode_produk')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" id="nama_produk" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}">
                            @error('nama_produk')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Kategori</label>
                            <select class="form-control @error('kode_kategori') is-invalid @enderror" id="kode_kategori" name="kode_kategori">
                                @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ $produk->kategori_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('kode_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Satuan</label>
                            <select class="form-control @error('kode_satuan') is-invalid @enderror" id="kode_satuan" name="kode_satuan">
                                @foreach($satuans as $satuan)
                                <option value="{{ $satuan->id }}" {{ $produk->satuan_id == $satuan->id ? 'selected' : '' }}>{{ $satuan->nama_satuan }}</option>
                                @endforeach
                            </select>
                            @error('kode_satuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Harga Beli</label>
                            <input type="text" class="form-control @error('harga_beli') is-invalid @enderror" id="harga_beli" name="harga_beli" value="{{ old('harga_beli', $produk->harga_beli) }}">
                            @error('harga_beli')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Diskon</label>
                            <input type="text" class="form-control @error('diskon') is-invalid @enderror" id="diskon" name="diskon" value="{{ old('diskon', $produk->diskon) }}">
                            @error('diskon')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Harga Jual</label>
                            <input type="text" class="form-control @error('harga_jual') is-invalid @enderror" id="harga_jual" name="harga_jual" value="{{ old('harga_jual', $produk->harga_jual) }}">
                            @error('harga_jual')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Stok</label>
                            <input type="text" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" value="{{ old('stok', $produk->stok) }}">
                            @error('stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
</div>
@endforeach

</div>
@endsection