<ul class="nav">
  <li class="{{ Request::is('homee') ? 'active' : ''}}">
    <a href="/homee">
      <i class="nc-icon nc-shop"></i>
      <p>Dashboard</p>
    </a>
  </li>

  <li>
    <a href="/penjualankasir">
      <i class="nc-icon nc-money-coins"></i>
      <span>Penjualan</span>
    </a>
  </li>

  <li>
    <a href="{{ route('transaksikasir.baru') }}">
      <i class="nc-icon nc-cart-simple"></i>
      <span>Transaksi Baru</span>
    </a>
  </li>

</ul>