<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      <li class=" navigation-header">
				<span>Menu</span>
				<i class="icon-minus" data-toggle="tooltip" data-placement="right" data-original-title="Menu"></i>
			</li>
			
      <!-- Admin -->
      @if(auth()->user()->role == 'admin')
      <li class="nav-item {{ request()->routeIs('admin.*') ? 'active' : '' }}">
				<a href="{{ route('admin.dashboard') }}">
					<i class="icon-home"></i>
					<span class="menu-title" data-i18n="Dashboard">Dashboard</span>
				</a>
      </li>
      <li class="nav-item {{ request()->routeIs('outlet.*') ? 'active' : '' }}">
				<a href="{{ route('outlet.index') }}">
					<i class="icon-layers"></i>
					<span class="menu-title" data-i18n="Data Outlet">Data Outlet</span>
				</a>
      </li>
      <li class="nav-item {{ request()->routeIs('paket.*') ? 'active' : '' }}">
				<a href="{{ route('paket.index') }}">
					<i class="icon-drawer"></i>
					<span class="menu-title" data-i18n="Data Paket Cucian">Data Paket Cucian</span>
				</a>
      </li>
      <li class="nav-item {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">
				<a href="{{ route('pelanggan.index') }}">
					<i class="icon-user-following"></i>
					<span class="menu-title" data-i18n="Data Pelanggan">Data Pelanggan</span>
				</a>
      </li>
      <li class="nav-item {{ request()->routeIs('transaksi.*') ? 'active' : '' }}">
				<a href="{{ route('transaksi.index') }}">
					<i class="icon-credit-card"></i>
					<span class="menu-title" data-i18n="Transaksi">Transaksi</span>
				</a>
      </li>
      <li class="nav-item {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
				<a href="{{ route('laporan.index') }}">
					<i class="icon-notebook"></i>
					<span class="menu-title" data-i18n="Laporan">Laporan</span>
				</a>
      </li>
      <li class="nav-item {{ request()->routeIs('pengguna.*') ? 'active' : '' }}">
				<a href="{{ route('pengguna.index') }}">
					<i class="icon-users"></i>
					<span class="menu-title" data-i18n="Data Pengguna">Data Pengguna</span>
				</a>
      </li>
      @endif

      <!-- Kasir -->
      @if(auth()->user()->role == 'kasir')
      <li class="nav-item {{ request()->routeIs('kasir.*') ? 'active' : '' }}">
				<a href="{{ route('kasir.dashboard') }}">
					<i class="icon-home"></i>
					<span class="menu-title" data-i18n="Dashboard">Dashboard</span>
				</a>
      </li>
      <li class="nav-item {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">
				<a href="{{ route('pelanggan.index') }}">
					<i class="icon-user-following"></i>
					<span class="menu-title" data-i18n="Data Pelanggan">Data Pelanggan</span>
				</a>
      </li>
      <li class="nav-item {{ request()->routeIs('transaksi.*') ? 'active' : '' }}">
				<a href="{{ route('transaksi.index') }}">
					<i class="icon-credit-card"></i>
					<span class="menu-title" data-i18n="Transaksi">Transaksi</span>
				</a>
      </li>
      <li class="nav-item {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
				<a href="{{ route('laporan.index') }}">
					<i class="icon-notebook"></i>
					<span class="menu-title" data-i18n="Laporan">Laporan</span>
				</a>
      </li>
      @endif

      <!-- Owner -->
      @if(auth()->user()->role == 'owner')
      <li class="nav-item {{ request()->routeIs('owner.*') ? 'active' : '' }}">
				<a href="{{ route('owner.dashboard') }}">
					<i class="icon-home"></i>
					<span class="menu-title" data-i18n="Dashboard">Dashboard</span>
				</a>
      </li>
      <li class="nav-item {{ request()->routeIs('outlet.*') ? 'active' : '' }}">
            <a href="{{ route('owner.outlet') }}">
                  <i class="icon-layers"></i>
                  <span class="menu-title" data-i18n="Data Outlet">Data Outlet</span>
            </a>
      </li>
      <li class="nav-item {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
            <a href="{{ route('laporan.owner') }}">
                  <i class="icon-notebook"></i>
                  <span class="menu-title" data-i18n="Laporan">Laporan</span>
            </a>
      </li>
      @endif
    </ul>
  </div>
</div>