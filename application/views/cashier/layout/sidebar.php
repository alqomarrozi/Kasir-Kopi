
 
    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item me-auto"><a class="navbar-brand" href="../../../html/ltr/vertical-menu-template/index.html"><span class="brand-logo">
        <img src="<?= base_url();?>images/app/logo-black.png">      
        </span>
              <h2 class="brand-text">Putti Roofspace</h2></a></li>
          <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
      </div>
      <div class="shadow-bottom"></div> 
      <div class="main-menu-content">
			<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
				<li class="<?php echo $this->uri->segment(2) == 'dashboard' ? 'active': '' ?> nav-item"><a class="d-flex align-items-center" href="<?php echo base_url('cashier/dashboard');?>"><i
							data-feather="home"></i><span class="menu-title text-truncate"
							data-i18n="Home">Dashboard</span></a>
				</li>
                <li class="<?php echo $this->uri->segment(2) == 'pos' ? 'active': '' ?> nav-item"><a class="d-flex align-items-center" href="<?php echo base_url('cashier/dashboard');?>"><i
							data-feather="monitor"></i><span class="menu-title text-truncate"
							data-i18n="Point Of Sale">Point Of Sale</span></a>
				</li>
                <li class="<?php echo $this->uri->segment(2) == 'bahan' ? 'active': '' ?> nav-item"><a class="d-flex align-items-center" href="<?php echo base_url('cashier/dashboard');?>"><i
							data-feather="codesandbox"></i><span class="menu-title text-truncate"
							data-i18n="Stock Bahan">Stock Bahan</span></a>
				</li>
                <li class="<?php echo $this->uri->segment(2) == 'absensi' ? 'active': '' ?> nav-item"><a class="d-flex align-items-center" href="<?php echo base_url('cashier/dashboard');?>"><i
							data-feather="bell"></i><span class="menu-title text-truncate"
							data-i18n="Absensi">Absensi Kehadiran</span></a>
				</li>
			</ul>
		</div>
    </div>
    <!-- END: Main Menu-->