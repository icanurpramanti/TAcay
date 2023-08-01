@extends ('admin.dashboard.layout.template')
@section('content')

<!-- End Navbar -->
<div class="content">
  <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="nc-icon nc-bullet-list-67 text-warning"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Data Kategori</p>
                <p class="card-title">{{$kategoris}}
                <p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer text-center">
          <hr>
          <div class="stats">
            <a href="/kategori" class="btn btn-warning btn-sm btn-more-info">
              <i class="fa fa-list-alt"></i> More Info
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="nc-icon nc-box-2 text-success"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Data Produk</p>
                <p class="card-title">{{$produks}}
                <p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer text-center">
          <hr>
          <div class="stats">
            <a href="/produk" class="btn btn-success btn-sm btn-more-info">
              <i class="fa fa-shopping-cart"></i> More Info
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="nc-icon nc-delivery-fast text-danger"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Data Supplier</p>
                <p class="card-title">{{$suppliers}}
                <p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer text-center">
          <hr>
          <div class="stats">
            <a href="/supplier" class="btn btn-danger btn-sm btn-more-info">
              <i class="fa fa-users"></i> More Info
            </a>
          </div>

        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="nc-icon nc-single-02 text-info"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Data User</p>
                <p class="card-title">{{$users}}
                <p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer text-center">
          <hr>
          <div class="stats">
            <a href="/user" class="btn btn-primary btn-sm btn-more-info">
              <i class="fa fa-user"></i> More Info
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header ">
          <h5 class="card-title">Users Behavior</h5>
          <p class="card-category">24 Hours performance</p>
        </div>
        <div class="card-body ">
          <canvas id=chartHours width="400" height="100"></canvas>
        </div>
        <div class="card-footer ">
          <hr>
          <div class="stats">
            <i class="fa fa-history"></i> Updated 3 minutes ago
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</p>
</p>
</div>
</div>
</div>
@endsection