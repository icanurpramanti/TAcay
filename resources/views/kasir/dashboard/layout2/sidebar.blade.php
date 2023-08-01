<ul class="nav">
  <li class="{{ Request::is('home') ? 'active' : ''}}">
    <a href="/home">
      <i class="nc-icon nc-shop"></i>
      <p>Dashboard</p>
    </a>
  </li>


  <li>
    <a href="{{ route('penjualan.index') }}">
      <i class="nc-icon nc-money-coins"></i>
      <span>Penjualan</span>
    </a>
  </li>

  <li>
    <a href="{{ route('transaksi.baru') }}">
      <i class="nc-icon nc-cart-simple"></i>
      <span>Transaksi Baru</span>
    </a>
  </li>

  <li>
    <a href="{{ route('transaksi.index') }}">
      <i class="fa fa-cart-arrow-down"></i>
      <span>Transaksi Aktif </span>
    </a>
  </li>


</ul>