<?php 

$user_id_login = $this->session->userdata('id');
$data_session = $this->db->query("SELECT * FROM users WHERE id = $user_id_login ");  
$sess = $data_session->row_array();
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">

	<title>
		<?php echo 'Putti Roofspace Coffee' .": ". ucfirst($this->uri->segment(1)) ?>
	</title>
	<link rel="apple-touch-icon" href="<?= base_url();?>themes/app-assets/images/ico/apple-icon-120.png">
	<link rel="shortcut icon" type="image/x-icon" href="<?= base_url();?>themes/app-assets/images/ico/favicon.ico">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
		rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- BEGIN: Vendor CSS-->
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/vendors/css/vendors.min.css">
	<link rel="stylesheet" type="text/css"
		href="<?= base_url();?>themes/app-assets/vendors/css/forms/select/select2.min.css">
	<link rel="stylesheet" type="text/css"
		href="<?= base_url();?>themes/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
	<link rel="stylesheet" type="text/css"
		href="<?= base_url();?>themes/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
	<link rel="stylesheet" type="text/css"
		href="<?= base_url();?>themes/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css">
	<link rel="stylesheet" type="text/css"
		href="<?= base_url();?>themes/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/vendors/css/charts/apexcharts.css">
	
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/css/pages/app-ecommerce.css">
	<link rel="stylesheet" type="text/css"
		href="<?= base_url();?>themes/app-assets/vendors/css/extensions/toastr.min.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
    
	<!-- END: Vendor CSS-->

	<!-- BEGIN: Theme CSS-->
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/css/bootstrap-extended.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/css/colors.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/css/components.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/css/themes/dark-layout.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/css/themes/semi-dark-layout.css">
	<!-- BEGIN: Page CSS-->
	<link rel="stylesheet" type="text/css"
		href="<?= base_url();?>themes/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/css/plugins/forms/form-validation.css">
	<!-- END: Page CSS-->
	<!-- BEGIN: Vendor JS-->
	<script src="<?= base_url();?>themes/app-assets/vendors/js/vendors.min.js"></script>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click"
	data-menu="vertical-menu-modern" data-col="">
  
<!-- BEGIN: Header-->
<nav class="header-navbar navbar navbar-expand-lg align-items-center navbar-light navbar-shadow bg-primary navbar-dark fixed-top">
		<div class="navbar-container d-flex content">
			<div class="bookmark-wrapper d-flex align-items-center">
				<ul class="nav navbar-nav d-xl-none">
					<li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon"
								data-feather="menu"></i></a></li>
				</ul>
				<ul class="nav navbar-nav">
                <li class="nav-item d-none d-lg-block"><a class="nav-link"><i data-feather='monitor'></i> Point of Sale</a></li>
                <li class="nav-item d-none d-lg-block"><a class="nav-link"><i data-feather='truck'></i> Pengeluaran Kas</a></li>
                <li class="nav-item d-none d-lg-block"><a class="nav-link"><i data-feather='info'></i> Ringkasan Harian</a></li>
                <li class="nav-item d-none d-lg-block"><a class="nav-link"><i data-feather='refresh-cw'></i> Detail Shift</a></li>
				    </ul>
			</div>
			<ul class="nav navbar-nav align-items-center ms-auto">
				<li class="nav-item dropdown dropdown-user">
					<a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#"
						data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
						<div class="user-nav d-sm-flex d-none"><span class="user-name fw-bolder"><?= $sess['nama'];?></span><span
								class="user-status">
								<?php if($sess['level'] == 'Admin'){
									echo 'Manager';
								}elseif($sess['level'] == 'Kasir'){
									echo 'Cashier';
								}
								;?>
								</span></div><span class="avatar"><img class="round"
								src="<?= base_url();?>themes/app-assets/images/portrait/small/avatar-s-11.jpg"
								alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
					</a>
					<div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user"><a
							class="dropdown-item" href="#"><i class="me-50" data-feather="user"></i> Profile</a><a
							class="dropdown-item" href="#"><i class="me-50" data-feather="mail"></i> Inbox</a><a
							class="dropdown-item" href="#"><i class="me-50" data-feather="check-square"></i> Task</a>
						<a class="dropdown-item" href="#"><i class="me-50" data-feather="message-square"></i> Chats</a>
						<div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="me-50"
								data-feather="settings"></i> Settings</a><a class="dropdown-item" href="#"><i
								class="me-50" data-feather="credit-card"></i> Pricing</a>
						<a class="dropdown-item" href="#"><i class="me-50" data-feather="help-circle"></i> FAQ</a><a
							class="dropdown-item" href="<?= base_url('auth/logout');?>"><i class="me-50" data-feather="power"></i> Logout</a>
					</div>
				</li>
			</ul>
		</div>
	</nav>
	<!-- END: Header-->
	
	<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
	<div class="navbar-header">
		<ul class="nav navbar-nav flex-row">
			<li class="nav-item me-auto"><a class="navbar-brand"
					href="<?php echo base_url('manager/dashboard');?>"><span class="brand-logo">
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
			
			<li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='codesandbox'></i><span class="menu-title text-truncate" data-i18n="Menu Levels">Bahan</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="<?php echo base_url('manager/bahan_kategori');?>"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Second Level">Kategori Bahan</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="<?php echo base_url('manager/bahan');?>"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Second Level">Data Bahan</span></a>
                        </li>
                    </ul>
            </li>
			<li class="<?php echo $this->uri->segment(2) == 'stock' ? 'has open': '' ?> nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='truck'></i><span class="menu-title text-truncate" data-i18n="Menu Levels">Stock in/out</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="<?php echo base_url('manager/stock/in');?>"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Second Level">Stock Masuk</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="<?php echo base_url('manager/stock/out');?>"><i data-feather="circle"></i><span class="menu-item text-truncate" >Stock Keluar</span></a>
                        </li>
                    </ul>
            </li>
			
			<li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='coffee'></i><span class="menu-title text-truncate" data-i18n="Menu Levels">Menu</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="<?php echo base_url('manager/kategori');?>"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Second Level">Kategori Produk</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="<?php echo base_url('manager/menu');?>"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Second Level">Data Produk</span></a>
                        </li>
                    </ul>
            </li>
			

			<li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='plus'></i><span class="menu-title text-truncate" data-i18n="Menu Levels">Extras Menu</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="<?php echo base_url('manager/extras');?>"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Second Level">Data Extras</span></a>
                        </li>
                    </ul>
            </li>


			<li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='book'></i><span class="menu-title text-truncate" data-i18n="Menu Levels">Laporan</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="<?php echo base_url('manager/kategori');?>"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Second Level">Laporan Harian</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="<?php echo base_url('manager/kategori');?>"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Second Level">Laporan Mingguan</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="<?php echo base_url('manager/kategori');?>"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Second Level">Laporan Bulanan</span></a>
                        </li>
                    </ul>
            </li>

			<li class="<?php echo $this->uri->segment(2) == 'absensi' ? 'active': '' ?> nav-item"><a
					class="d-flex align-items-center" href="<?php echo base_url('manager/dashboard');?>"><i
						data-feather="bell"></i><span class="menu-title text-truncate" data-i18n="Absensi">Laporan Absensi</span></a>
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

<div class="app-content content ">
	<div class="content-overlay"></div>
	<div class="header-navbar-shadow"></div>
    <div class="card">
        <div class="row">
            
        <div class="p-2 col-md-7">
            <h4>Produk</h4>
            <div class="row">
            <?php foreach ($data as $row) : ?>
                <div class="col-md-4">
                    <div class="thumbnail">
                        <img width="200" src="<?php echo base_url().'/'.$row->gambar_produk;?>">
                        <div class="caption">
                            <h4><?php echo $row->nama_produk;?></h4>
                            <div class="row">
                                <div class="col-md-7">
                                    <h4><?php echo 'Rp '.number_format($row->harga_produk);?></h4>
                                </div>
                                <div class="col-md-5">
                                    <input type="number" name="quantity" id="<?php echo $row->id_produk;?>" value="1" class="quantity form-control">
                                </div>
                            </div>
                            <button class="add_cart btn btn-success btn-block" data-produkid="<?php echo $row->id_produk;?>" data-produknama="<?php echo $row->nama_produk;?>" data-produkharga="<?php echo $row->harga_produk;?>">Add To Cart</button>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
                 
            </div>
 
        </div> 
        <div class="p-2 col-md-5">
            <h4>Shopping Cart</h4>
            <table class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="detail_cart">
 
                </tbody>
                 
            </table>
        </div>
        </div>
    </div> 
</div> 
 
<script type="text/javascript">
    $(document).ready(function(){
        $('.add_cart').click(function(){
            var id_produk    = $(this).data("produkid");
            var nama_produk  = $(this).data("produknama");
            var harga_produk = $(this).data("produkharga");
            var quantity     = $('#' + id_produk).val();
            $.ajax({
                url : "<?php echo base_url();?>cart/add_to_cart",
                method : "POST",
                data : {id_produk: id_produk, nama_produk: nama_produk, harga_produk: harga_produk, quantity: quantity},
                success: function(data){
                    $('#detail_cart').html(data);
                }
            });
        });
 
        // Load shopping cart
        $('#detail_cart').load("<?php echo base_url();?>index.php/cart/load_cart");
 
        //Hapus Item Cart
        $(document).on('click','.hapus_cart',function(){
            var row_id=$(this).attr("id"); //mengambil row_id dari artibut id
            $.ajax({
                url : "<?php echo base_url();?>cart/hapus_cart",
                method : "POST",
                data : {row_id : row_id},
                success :function(data){
                    $('#detail_cart').html(data);
                }
            });
        });
    });
</script> 


<div class="sidenav-overlay"></div>
	<div class="drag-target"></div>

	<!-- BEGIN: Footer-->
	<footer class="footer footer-static footer-light">
		<p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">Copyright &copy; 2022
				Putti Roofspace Coffee<span class="d-none d-sm-inline-block">, All rights Reserved</span></span>
		</p>
	</footer>

	<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
	<!-- END: Footer-->


	<!-- BEGIN Vendor JS-->
	<!-- BEGIN: Page Vendor JS-->
	<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
	<script src="<?= base_url();?>themes/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
	<script src="<?= base_url();?>themes/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
	<script src="<?= base_url();?>themes/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
	<script src="<?= base_url();?>themes/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
	<script src="<?= base_url();?>themes/app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js"></script>
	<script src="<?= base_url();?>themes/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
	<script src="<?= base_url();?>themes/app-assets/vendors/js/tables/datatable/jszip.min.js"></script>
	<script src="<?= base_url();?>themes/app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
	<script src="<?= base_url();?>themes/app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
	<script src="<?= base_url();?>themes/app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
	<script src="<?= base_url();?>themes/app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
	<script src="<?= base_url();?>themes/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
	<script src="<?= base_url();?>themes/app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
	<script src="<?= base_url();?>themes/app-assets/vendors/js/forms/cleave/cleave.min.js"></script>
	<script src="<?= base_url();?>themes/app-assets/vendors/js/forms/cleave/addons/cleave-phone.us.js"></script>
	<script src="<?= base_url();?>themes/app-assets/vendors/js/charts/apexcharts.min.js"></script>
	<script src="<?= base_url();?>themes/app-assets/vendors/js/extensions/toastr.min.js"></script>
	<!-- END: Page Vendor JS-->

    <script src="<?= base_url();?>themes/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="<?= base_url();?>themes/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="<?= base_url();?>themes/app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
    <script src="<?= base_url();?>themes/app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
    <script src="<?= base_url();?>themes/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
   
   <script src="<?= base_url();?>themes/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js"></script>
	<!-- BEGIN: Theme JS-->
	<script src="<?= base_url();?>themes/app-assets/js/core/app-menu.min.js"></script>
	<script src="<?= base_url();?>themes/app-assets/js/core/app.min.js"></script>
	<script src="<?= base_url();?>themes/app-assets/js/scripts/customizer.min.js"></script>

    <script src="<?= base_url();?>themes/app-assets/js/scripts/forms/pickers/form-pickers.js"></script>
    <!-- <script src="<?= base_url();?>themes/app-assets/js/scripts/forms/form-select2.js"></script> -->

	<script>
		$(window).on('load', function () {
			if (feather) { 
				feather.replace({
					width: 10,
					height: 10
				});
			}
		})
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
       $('#select2-option').select2();
    });
	</script>
	
<script> 
    $('#selectkategori').select2({
        dropdownParent: $('#modalCreateBahan')
    });
    $('#select2id').select2({
        dropdownParent: $('#ModalUpdate'),
        dropdownParent: $('#ModalAdd')
    });
	
    $('#selectkategori').select2();
</script>
	<script> 
    </script>
</body>
<!-- END: Body-->

</html>