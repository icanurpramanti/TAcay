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
        <h4 class="card-title">Setting Toko</h4>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#settingModal">
          Setting Toko
        </button>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table class="table" id="tabel-data">
            <thead class="text-primary">
              <th>NO</th>
              <th>Nama Toko</th>
              <th>Alamat Toko</th>
              <th>No Hp</th>
              <th>Instagram</th>
              <th>Email</th>
              <th>Aksi</th>
            </thead>
            <tbody>

              @foreach ($setting_tokos as $setting_toko)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $setting_toko->nama_toko }}</td>
                <td>{{ $setting_toko->alamat_toko }}</td>
                <td>{{ $setting_toko->no_hp }}</td>
                <td>{{ $setting_toko->instagram }}</td>
                <td>{{ $setting_toko->email }}</td>
                <td>
                  <a href="{{ route('setting_toko-detail', $setting_toko->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                  <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#settingEdit{{ $setting_toko->id }}">
                    <i class="fa fa-edit"></i>
                  </button>
                  <form class="d-inline" action="/setting_toko/{{ $setting_toko->id }}" method="post">
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
</div>

<!-- CreateSetting-->
<div class="card-body">
  <div class="modal fade" id="settingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="card-header">
          <h5 class="title text-center">Create Setting Toko</h5>
        </div>
        <form action="/setting_toko" method="post" enctype="multipart/form-data">
          @csrf

          <div class="mb-3" style="margin-left:15px; margin-right:15px; margin-top:15px">
            <label for="exampleFormControlInput1" class="form-label">Nama Toko</label>
            <input type="text" class="form-control @error ('nama_toko') is-invalid @enderror" value="{{ old('nama_toko') }}" id="nama_toko" name="nama_toko">
            @error('nama_toko')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3" style="margin-left:15px; margin-right:15px;">
            <label for="exampleFormControlInput1" class="form-label">Alamat Toko</label>
            <input type="text" class="form-control @error ('alamat_toko') is-invalid @enderror" value="{{ old('alamat_toko') }}" id="alamat_toko" name="alamat_toko">
            @error('alamat_toko')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3" style="margin-left:15px; margin-right:15px;">
            <label for="exampleFormControlInput1" class="form-label">No HP</label>
            <input type="text" class="form-control @error ('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" id="no_hp" name="no_hp">
            @error('no_hp')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3" style="margin-left:15px; margin-right:15px;">
            <label for="exampleFormControlInput1" class="form-label">Instagram</label>
            <input type="text" class="form-control @error ('instagram') is-invalid @enderror" value="{{ old('instagram') }}" id="instagram" name="instagram">
            @error('instagram')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3" style="margin-left:15px; margin-right:15px;">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="text" class="form-control @error ('email') is-invalid @enderror" value="{{ old('email') }}" id="email" name="email">
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="row">
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Horizontal Form -->
</div>

<!-- EditSetting -->
@foreach ($setting_tokos as $setting_toko)
<div class="card-body">
  <div class="modal fade" id="settingEdit{{ $setting_toko->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="/setting_toko/{{ $setting_toko->id }}" method="post">
          @method('put')
          @csrf
          <div class="card-header">
            <h5 class="title text-center">Edit Setting Toko</h5>
          </div>
          <div class="mb-3" style="margin-left:15px; margin-right:15px; margin-top:15px">
            <label class="form-label">Nama Toko</label>
            <input type="text" class="form-control" id="nama_toko" name="nama_toko" value="{{ old('nama_toko', $setting_toko->nama_toko) }}">
            @error('nama_toko')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3" style="margin-left:15px; margin-right:15px; margin-top:15px">
            <label class="form-label">Alamat Toko</label>
            <input type="text" class="form-control" id="alamat_toko" name="alamat_toko" value="{{ old('alamat_toko', $setting_toko->alamat_toko) }}">
            @error('alamat_toko')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3" style="margin-left:15px; margin-right:15px; margin-top:15px">
            <label class="form-label">No Hp</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', $setting_toko->no_hp) }}">
            @error('no_hp')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3" style="margin-left:15px; margin-right:15px; margin-top:15px">
            <label class="form-label">Instagram</label>
            <input type="text" class="form-control" id="instagram" name="instagram" value="{{ old('instagram', $setting_toko->instagram) }}">
            @error('instagram')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3" style="margin-left:15px; margin-right:15px; margin-top:15px">
            <label class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $setting_toko->email) }}">
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="row">
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Horizontal Form -->
</div>
@endforeach

@endsection