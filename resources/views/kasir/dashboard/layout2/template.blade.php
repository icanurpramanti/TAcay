<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    SRC Rani Cell
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--Fonts and icons--> 
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <!-- datatable -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

  <!-- Import jQuery library -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <!-- Import DataTables library -->
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

  <script>
    $(document).ready(function() {
      // DataTables initialization
      $('#tabel-data').DataTable();
    });
  </script>

  @stack('css')
</head>




<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="https://www.creative-tim.com" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="../assets/img/logo-small.png">
          </div>
          <!-- <p>CT</p> -->
        </a>
        <a href="https://www.creative-tim.com" class="simple-text logo-normal">
          SRC Rani CELL
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
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
            <i class="nc-icon nc-single-02"></i> {{Auth()->user()->level}}
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('actionlogout')}}">
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

      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <nav class="footer-nav">
              <ul>
                <li><a href="https://www.creative-tim.com" target="_blank">Creative Tim</a></li>
                <li><a href="https://www.creative-tim.com/blog" target="_blank">Blog</a></li>
                <li><a href="https://www.creative-tim.com/license" target="_blank">Licenses</a></li>
              </ul>
            </nav>
            <div class="credits ml-auto">
              <span class="copyright">
                © <script>
                  document.write(new Date().getFullYear())
                </script>, made with <i class="fa fa-heart heart"></i> by Creative Tim
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>

<!-- Load jQuery before Bootstrap -->
<script src="/../assets/js/core/jquery.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="/../assets/js/core/popper.min.js"></script>
<!-- ... (other scripts) ... -->

<!-- Load Chart.js -->
<script src="/../assets/js/plugins/chartjs.min.js"></script>
<!-- ... (other scripts) ... -->

<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function(){
    $('#tabel-data').DataTable();
  });
</script>

<!-- ... (other scripts) ... -->

<script src="/../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>
<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="/../assets/demo/demo.js"></script>
<script>
  $(document).ready(function() {
    // Ensure Chart.js is loaded before calling initChartsPages()
    demo.initChartsPages();
  });
</script>

@stack('scripts')


</body>
</html>
