<div class="navbar-collapse-header d-md-none">
    <div class="row">
      <div class="col-6 collapse-brand">
        <a href="./index.html">
          {{-- <img src="./assets/img/brand/blue.png"> --}}
        </a>
      </div>
      <div class="col-6 collapse-close">
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
          <span></span>
          <span></span>
        </button>
      </div>
    </div>
  </div>
  <!-- Form -->
  <form class="mt-4 mb-3 d-md-none">
    <div class="input-group input-group-rounded input-group-merge">
      <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <span class="fa fa-search"></span>
        </div>
      </div>
    </div>
  </form>
  <!-- Navigation -->
  <hr class="my-3">
  <!-- Heading -->
  <h6 class="navbar-heading text-muted">Transaksi</h6>
  <ul class="navbar-nav">
    {{-- <li class="header">MENU</li> --}}
    

    <li class="nav-item  active ">
      <a class="nav-link  active " href="{{ url('/home') }}">
        <i class="ni ni-tv-2 text-primary"></i> Dashboard
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="{{ route('pesanan.buat') }}">
        {{-- <i class="ni ni-planet text-blue"></i> --}}
        {{-- <i class="fas fa file-edit text-blue"> --}}
          <i class="fas fa-file-invoice text-blue"></i></i> Input Pesanan
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="{{ route('pesanan.viewindex') }}">
        <i class="fas fa-list-alt text-orange"></i> Lihat Pesanan
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="{{ route('lampiranorder.index') }}">
        <i class="ni ni-single-02 text-yellow"></i> Lihat Master Lampiran Order
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="{{ route('lampirankerja.viewindex') }}">
        <i class="ni ni-bullet-list-67 text-red"></i> Daftar LPK
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('lampirankerja.laporlpk') }}">
        <i class="ni ni-key-25 text-info"></i> Lapor Hasil Perintah Kerja
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('revisi.viewindex') }}">
       
        <i class="fas fa-clipboard-list text-red"></i>Daftar Revisi Order
      </a>
    </li>
    {{-- <li class="nav-item">
      <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="ni ni-circle-08 text-pink"></i> Logout
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    </li> --}}
  </ul>
  <!-- Divider -->
  <hr class="my-3">
  <!-- Heading -->
  <h6 class="navbar-heading text-muted">Master Data</h6>
  <!-- Navigation -->
  <ul class="navbar-nav mb-md-3">
    <li class="nav-item">
      <a class="nav-link"  href="{{ route('user.viewindex') }}">
        <i class="ni ni-spaceship"></i> Master Data User
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="{{ route('pecahan.buat') }}">
        <i class="ni ni-palette"></i> Master Data Pecahan
      </a>
    </li>
    {{-- <li class="nav-item">
      <a class="nav-link"  href="{{ route('revisi.viewindex') }}">
        <i class="ni ni-ui-04"></i> Master Petugas
      </a>
    </li> --}}
  </ul>
 