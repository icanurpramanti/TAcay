@extends('kasir.dashboard.layout2.template')

@section('content')
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title1">Selamat Datang di Halaman Kasir</h5>
        </div>
        <div class="card-body">
          <img src="../assets/img/c.jpg" alt="SRC Rani Cell" style="width: 100%; max-height: 300px; object-fit: cover;">
          <div class="feature-card row">
            <div class="col-md-6">
              <div class="feature-card-box bg-light">
              <i class="fa fa-shopping-cart"></i>
                <h4 class="text-primary">Belanja Mudah</h4>
                <p class="text-muted">Pilih produk favorit Anda dengan banyak pilihan yang beragam.</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="feature-card-box bg-light">
                <i class="fa fa-money"></i>
                <h4 class="text-success">Pembayaran Aman</h4>
                <p class="text-muted">Kami menyediakan pembayaran yang aman dan terpercaya.</p>
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
  .card-title1 {
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    color: teal;
    text-align: center;
    font-size: 30px;
  }


  .feature-card-box {
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    color: teal;
    text-align: center;
    font-size: 30px;
  }

  .welcome-message {
    text-align: center;
    margin-bottom: 20px;
  }

  .welcome-message h3 {
    font-size: 28px;
    margin-bottom: 10px;
    color: #007bff;
  }

  .feature-card-box {
    border: 1px solid #e0e0e0;
    padding: 20px;
    text-align: center;
    background-color: #fff;
    transition: transform 0.3s, box-shadow 0.3s;
  }

  .feature-card-box:hover {
    transform: translateY(-5px);
    box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.2);

  }

  .feature-card-box i {
    font-size: 48px;
    margin-bottom: 15px;
    color: #007bff;
  }

  .feature-card-box h4 {
    font-size: 20px;
    margin-bottom: 10px;
  }

  .feature-card-box p {
    font-size: 16px;
    margin-bottom: 15px;
    color: #555;
  }

  .btn {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
  }

  .btn:hover {
    background-color: #0056b3;
  }
</style>