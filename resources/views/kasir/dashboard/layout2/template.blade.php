<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>SRC Rani Cell</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
  <script src="https://cdn.jsdelivr.net/npm/perfect-scrollbar@1.5.2/dist/perfect-scrollbar.min.js"></script>
  @stack('css')
</head>
<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="#" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="../assets/img/logoca.jpg">
          </div>
        </a>
        <a href="#" class="simple-text logo-normal">
          SRC Rani CELL
        </a>
      </div>
      <div class="sidebar-wrapper">
        <!---MENU SIDEBAR-->
        @include('kasir.dashboard.layout2.sidebar')
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand mx-4" href="javascript:;">MANAJEMEN KASIR</a>
          </div>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="nc-icon nc-single-02"></i> {{ Auth()->user()->level }}
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('actionlogout') }}">
                  Log Out
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <!-- CONTENT -->
      <div class="content">
        @yield('content')
      </div>
      <!-- END CONTENT -->
      <footer class="footer footer-white  footer-teal" style="background-color: white; text-align: center; padding: 20px;">
        <div class="container-fluid">
          <div class="row">
            <div class="credits mx-auto" style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
              <span class="copyright" style="font-size: 12px; color: teal;">
                © <script>
                  document.write(new Date().getFullYear())
                </script>, dibuat dengan <i class="fa fa-heart heart"></i> oleh SRC Rani Cell 2023
              </span>
            </div>
          </div>
        </div>
        @yield('footer') <!-- Tambahkan baris ini di sini -->
      </footer>
    </div>
  </div>
  <!-- Load jQuery before Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="/bootstrap/js/bootstrap.min.js"></script>
  <script src="/../assets/js/core/popper.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#tabel-data').DataTable();
    });
  </script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="/../assets/demo/demo.js"></script>
  @stack('scripts')
</body>

</html>