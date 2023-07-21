<ul class="nav">

  <li class="{{ Request::is('home') ? 'active' : ''}}">
    <a href="/home">
      <i class="nc-icon nc-shop"></i>
      <p>Dashboard</p>
    </a>
  </li>

  <li>
  <li class="{{ Request::is('kategori') ? 'active' : ''}}">
    <a href="/kategori">
      <i class="nc-icon nc-paper"></i>
      <p>Data Kategori</p>
    </a>
  </li>

  <li>
  <li class="{{ Request::is('satuan') ? 'active' : ''}}">
    <a href="/satuan">
      <i class="nc-icon nc-badge"></i>
      <p>Data Satuan </p>
    </a>
  </li>

  <li>
  <li class="{{ Request::is('produk') ? 'active' : ''}}">
    <a href="/produk">
      <i class="nc-icon nc-tag-content"></i>
      <p>Data Produk</p>
    </a>
  </li>

  <li>
  <li class="{{ Request::is('supplier') ? 'active' : ''}}">
    <a href="/supplier">
      <i class="nc-icon nc-user-run"></i>
      <p>Data Supplier</p>
    </a>
  </li>

  <!-- <li>
   <li class="{{ Request::is('bank') ? 'active' : ''}}">
    <a href="/bank">
      <i class="nc-icon nc-tile-56"></i>
      <p>Data Rekening</p>
    </a>
  </li> -->

  <li>
  <li class="{{ Request::is('pembelian') ? 'active' : ''}}">
    <a href="/pembelian">
      <i class="nc-icon nc-bank"></i>
      <p>Pembelian</p>
    </a>
  </li>

  <li>
    <a href="{{ route('penjualan.index') }}">
      <i class="fa fa-upload"></i> <span>Penjualan</span>
    </a>
  </li>
  <li>
    <a href="{{ route('transaksi.index') }}">
      <i class="fa fa-cart-arrow-down"></i> <span>Transaksi Lama</span>
    </a>
  </li>
  <li>
    <a href="{{ route('transaksi.baru') }}">
      <i class="fa fa-cart-arrow-down"></i> <span>Transaksi Baru</span>
    </a>
  </li>

  <li class="{{ Request::is('user') ? 'active' : ''}}">
    <a href="/user">
      <i class="nc-icon nc-single-02"></i>
      <p>Kelola User</p>
    </a>
  </li>


  <li>
  <li class="{{ Request::is('setting') ? 'active' : ''}}">
    <a href="/setting">
      <i class="nc-icon nc-badge"></i>
      <p>Setting</p>
    </a>
  </li>

  <li>
  <li class="{{ Request::is('setting_toko') ? 'active' : ''}}">
    <a href="/setting_toko">
      <i class="nc-icon nc-bank"></i>
      <p>Setting Toko</p>
    </a>
  </li>

  <!-- <li>
   <li class="{{ Request::is('laporanstokproduk') ? 'active' : ''}}">
    <a href="/laporanstok">
      <i class="nc-icon nc-caps-small"></i>
      <p>LaporanStokProduk </p>
    </a>
  </li>
</ul> -->