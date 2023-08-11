@extends('kasir.dashboard.layout2.template')

@section('content')
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title">Selamat Datang di Halaman Kasir</h5>
        </div>
        <div class="card-body">
          <div class="welcome-message">
            <h3>Transaksikan dengan Gaya!</h3>
            <p>Di halaman ini, Anda dapat dengan gaya yang unik melakukan transaksi penjualan dan mengelola pesanan dari pelanggan.</p>
            <p>Gunakan fitur-fitur canggih kami untuk memberikan pengalaman berbelanja yang tak terlupakan.</p>
          </div>
          <div class="row feature-card">
            <div class="col-md-4">
              <div class="card card-primary">
                <div class="card-body">
                  <i class="fa fa-money"></i>
                  <h4>Transaksi Kilat</h4>
                  <p>Lakukan transaksi dengan kilatan mata menggunakan antarmuka yang elegan dan efisien.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-primary">
                <div class="card-body">
                  <i class="fa fa-list"></i>
                  <h4>Kelola Pesanan Lebih Baik</h4>
                  <p>Manajemen pesanan yang canggih memungkinkan Anda mengendalikan pesanan dengan mudah.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-primary">
                <div class="card-body">
                  <i class="fa fa-chart-bar"></i>
                  <h4>Laporan Lengkap</h4>
                  <p>Dapatkan wawasan bisnis yang memukau dengan laporan penjualan dan analisis data yang komprehensif.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

<style>
  .welcome-message {
    text-align: center;
    margin-bottom: 20px;
  }

  .welcome-message h3 {
    font-size: 28px;
    margin-bottom: 10px;
    color: #007bff;
  }

  .feature-card {
    margin-top: 20px;
  }

  .card {
    border: none;
    box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
  }

  .card-primary {
    background-color: #007bff;
    color: white;
  }

  .card-body {
    text-align: center;
    padding: 20px;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.2);
  }

  .card i {
    font-size: 48px;
    margin-bottom: 15px;
  }

  .card h4 {
    font-size: 20px;
    margin-bottom: 10px;
    color: white;
  }

  .card p {
    font-size: 16px;
  }
</style>
