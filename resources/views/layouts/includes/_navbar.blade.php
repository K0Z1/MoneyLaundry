<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top navbar-semi-dark navbar-shadow">
  <div class="navbar-wrapper">
    <div class="navbar-header">
      <ul class="nav navbar-nav flex-row">
        <li class="nav-item mobile-menu d-lg-none mr-auto">
					<a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
						<i class="fa fa-list font-large-1"></i>
					</a>
				</li>
        <li class="nav-item mr-auto">
					<a class="navbar-brand" href="">
						<h4 class="brand-text">Money Laundry</h4>
					</a>
				</li>
        <li class="nav-item d-none d-lg-block nav-toggle">
					<a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
						<i class="fa fa-toggle-on icon-toggle-right font-medium-3 white" data-ticon="icon-toggle-right"></i>
					</a>
				</li>
        <li class="nav-item d-lg-none">
					<a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile">
						<i class="fa fa-ellipsis-v"></i>
					</a>
				</li>
      </ul>
    </div>
    <div class="navbar-container content">
      <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="nav navbar-nav mr-auto float-left">
          <li class="nav-item d-none d-md-block">
						<a class="nav-link nav-link-expand" href="#">
							<i class="icon-frame"></i>
						</a>
					</li>
        </ul>
        <ul class="nav navbar-nav float-right">
          <li class="dropdown dropdown-user nav-item">
            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
							<span class="user-name" style="margin-top: 10px;">{{ auth()->user()->nama }}</span>
						</a>
            <div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="{{ route('ganti.ks', auth()->user()->id) }}">
								<i class="icon-lock"></i> Ganti Kata Sandi
							</a>
							<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="{{ route('logout') }}">
									<i class="icon-power"></i> Keluar
								</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>