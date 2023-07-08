    @extends('admin.dashboard.layout.template')

    @section('content')
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="content">
        <div class="row">
          <div class="col-md-12">
           <div class="card">
            <div class="card-header">
              <h5 class="title text-center">Detail Data Setting Toko</h5>
            </div>
            <div class="card-body">
             <div class="row mt-2" style="padding-left: 100px;">
              <div class="col-md-4">
                Nama Toko
              </div>
              <div class="col-md-1">
                :
              </div>
              <div class="col">
                {{$setting_toko->nama_toko}}
              </div>
            </div>
            <div class="row mt-2" style="padding-left: 100px;">
              <div class="col-md-4">
                Alamat Toko
              </div>
              <div class="col-md-1">
                :
              </div>
              <div class="col">
                {{$setting_toko->alamat_toko}}
              </div>
            </div>
            <div class="row mt-2" style="padding-left: 100px;">
              <div class="col-md-4">
                Nama Toko
              </div>
              <div class="col-md-1">
                :
              </div>
              <div class="col">
                {{$setting_toko->nama_toko}}
              </div>
            </div>
            <div class="row mt-2" style="padding-left: 100px;">
              <div class="col-md-4">
                No Hp
              </div>
              <div class="col-md-1">
                :
              </div>
              <div class="col">
                {{$setting_toko->no_hp}}
              </div>
            </div>
            <div class="row mt-2" style="padding-left: 100px;">
              <div class="col-md-4">
                Instagram
              </div>
              <div class="col-md-1">
                :
              </div>
              <div class="col">
                {{$setting_toko->instagram}}
              </div>
            </div>
            <div class="row mt-2" style="padding-left: 100px;">
              <div class="col-md-4">
                Email
              </div>
              <div class="col-md-1">
                :
              </div>
              <div class="col" >
                {{$setting_toko->email}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection