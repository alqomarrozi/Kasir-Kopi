<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
	<div class="navbar-header">
		<ul class="nav navbar-nav flex-row">
			<li class="nav-item me-auto"><a class="navbar-brand"
					href="../../../html/ltr/vertical-menu-template/index.html"><span class="brand-logo">
						<img src="<?= base_url();?>images/app/logo-black.png">
					</span>
					<h2 class="brand-text">Putti Roofspace</h2>
				</a></li>
			<li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
						class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
						class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
						data-ticon="disc"></i></a></li>
		</ul>
	</div>
	<div class="shadow-bottom"></div>
	<div class="main-menu-content">
		<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
			<li class="<?php echo $this->uri->segment(2) == 'dashboard' ? 'active': '' ?> nav-item"><a
					class="d-flex align-items-center" href="<?php echo base_url('manager/dashboard');?>"><i
						data-feather="home"></i><span class="menu-title text-truncate"
						data-i18n="Home">Dashboard</span></a>
			</li>

			<li class="<?php echo $this->uri->segment(2) == 'bahan' ? 'active': '' ?> nav-item"><a
					class="d-flex align-items-center" href="<?php echo base_url('manager/bahan');?>"><i
						data-feather="codesandbox"></i><span class="menu-title text-truncate"
						data-i18n="Stock Bahan">Master Bahan</span></a>
			</li>
			
			<li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="menu"></i><span class="menu-title text-truncate" data-i18n="Master Produk">Master Produk</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Second Level">Second Level 2.1</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Second Level">Second Level 2.2</span></a>
                            <ul class="menu-content">
                                <li><a class="d-flex align-items-center" href="#"><span class="menu-item text-truncate" data-i18n="Third Level">Third Level 3.1</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="#"><span class="menu-item text-truncate" data-i18n="Third Level">Third Level 3.2</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
			
			<li class="<?php echo $this->uri->segment(2) == 'penyesuaian_stock' ? 'active': '' ?> nav-item"><a
					class="d-flex align-items-center" href="<?php echo base_url('manager/penyesuaian_stock');?>"><i
						data-feather="truck"></i><span class="menu-title text-truncate"
						data-i18n="penyesuaian_stock">Keluar/Masuk Bahan</span></a>
			</li>
			
			<li class="<?php echo $this->uri->segment(2) == 'menu' ? 'active': '' ?> nav-item"><a
					class="d-flex align-items-center" href="<?php echo base_url('manager/menu');?>"><i
						data-feather="shopping-bag"></i><span class="menu-title text-truncate"
						data-i18n="Menu">Menu Produks</span></a>
			</li>

			<li class="<?php echo $this->uri->segment(2) == 'category' ? 'active': '' ?> nav-item"><a
					class="d-flex align-items-center" href="<?php echo base_url('manager/bahan/kategori');?>"><i
						data-feather="codesandbox"></i><span class="menu-title text-truncate"
						data-i18n="Stock Bahan">Variant</span></a>
			</li>

			<li class="<?php echo $this->uri->segment(2) == 'absensi' ? 'active': '' ?> nav-item"><a
					class="d-flex align-items-center" href="<?php echo base_url('manager/dashboard');?>"><i
						data-feather="bell"></i><span class="menu-title text-truncate" data-i18n="Absensi">Absensi
						Kehadiran</span></a>
			</li>

			</li> 
			<li class="<?php echo $this->uri->segment(2) == 'users' ? 'active': '' ?> nav-item"><a
					class="d-flex align-items-center" href="<?php echo base_url('manager/users');?>"><i
						data-feather="user"></i><span class="menu-title text-truncate"
						data-i18n="users">Users</span></a>
			</li>

			
		</ul>
	</div>
</div>
<!-- END: Main Menu-->
