<!-- BEGIN: Content-->
<div class="app-content content ">
	<div class="content-overlay"></div>
	<div class="header-navbar-shadow"></div>
	<div class="content-wrapper p-0">
		<div class="content-body">
			<div class="row">
				<div class="col-lg-7 col-md-7 col-12">

					<div class="card-header with-border">
						<h3 class="box-title" id="ReciverName_txt">List Menu</h3>
						<div class="col-md-12">
							<a href="#" onclick="sort()" class="btn btn-relief-dark btn-sm toggle_form pull-right">
								<i class="fa fa-coffee"></i>
								Filter</a>

								
								<?php
										$getSessionCustomerType = $this->session->userdata('customer_type');
										$customer_type_name = $this->db->query("SELECT * FROM
										type_harga_online WHERE harga_online_id=$getSessionCustomerType")->row_array(); ?>
							<a href="#" onclick="customertype()" class="btn btn-relief-success btn-sm toggle_form pull-right">
								<i class="fa fa-user"></i> Customer Type : <?= $customer_type_name['harga_online_nama'];?></a>

						</div>
						<div class="col-12 mt-1">
							<div id="sort" class="row" style="display: none;">
								<?php echo form_open('app'); ?>
								<div class="col-md-12 mb-1">
									<div class="form-group">
										<label for="kategori" class="control-label">Kategori</label>
										<div class="input-group">
											<select class="form-control form-control-sm" name="kategori">
												<option value="">Pilih Semua</option>
												<?php
												foreach ($kategori as $k) {
													echo "<option value=' $k->id_kategori'>$k->nama_kategori</option>";
												}
												?>
											</select>

											<button type="submit" name="filter" class="btn btn-block btn-relief-dark btn-sm">Search Filter</button>

											<span class="input-group-addon">

											</span>
										</div>

										<div class="input-group">
										</div>
									</div>
								</div>
								<?= form_close() ?>
							</div>
						</div>
						
						<div class="col-12 mt-1">
							<div id="customertype" class="row" style="display: none;">
								<?php echo form_open('app/change_customer_type'); ?>
								<div class="col-md-12 mb-1">
									<div class="form-group">
										<label for="customer-type" class="control-label">Customer Type</label>
										<div class="input-group">
											
										<?php
										$customer_type = $this->db->query("SELECT * FROM
										type_harga_online"); ?>
											<select class="form-control form-control-sm" name="harga_online_id">
												<?php
												foreach ($customer_type->result() as $ctype) {
													echo "<option value='$ctype->harga_online_id'>$ctype->harga_online_nama + $ctype->harga_online</option>";
												}
												?>
											</select>

											<button type="submit" class="btn btn-block btn-relief-dark btn-sm">Change</button>

											<span class="input-group-addon">

											</span>
										</div>

										<div class="input-group">
										</div>
									</div>
								</div>
								<?= form_close() ?>
							</div>
						</div>


					</div>

					<div class="contents" id="left-col">
						<div class="card-body" style="height:700px;overflow-y: scroll;">
							<div class="listitem with-border">

								<div id="list-view">
									<div class="row">
										<?php foreach ($result as $row) {  ?>
										<?php
										$getSessionCustomerType = $this->session->userdata('customer_type');
										$getCustomerType = $this->db->query("SELECT * FROM
										type_harga_online WHERE harga_online_id=$getSessionCustomerType")->row_array();
										$harga_produk = $row->harga_produk + $getCustomerType['harga_online'];
										?>
											<div class="col-lg-4 col-md-6 b-1">
												<div class="card ecommerce-card">
													<a href="#" onclick="detailCart('<?php echo $row->id_produk ?>')">
														<div>
															<img src="<?php echo base_url('images/produk/') . $row->gambar_produk; ?>" class="card-img-top" alt="<?php echo $row->nama_produk; ?>">
														</div>

													</a>
													<div class="card-body">
														<div class="add">
															<h6><?php echo $row->nama_produk; ?>
															</h6>
															<label>Rp.<?= $this->fungsi->rupiah($harga_produk); ?></label>

															<div class="input-group w-100">
																<input type="number" name="quantity" id="<?php echo $row->id_produk; ?>" value="1" class="quantity touchspin-cart form-control form-control-sm ">

															</div>

															<button class="add_cart btn btn-relief-dark btn-sm w-100 " data-produkkode="<?php echo $row->kode_produk; ?>" data-produkid="<?php echo $row->id_produk; ?>" data-produknama="<?php echo $row->nama_produk; ?>" data-produkharga="<?php echo $harga_produk; ?>">Order</button>

									
														</div>
													</div>
												</div>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div id="page" style="padding-top:10px">
						<?php if (!isset($_POST['filter'])) {
							echo $halaman;
						} ?>
					</div>
				</div>

				<div class="col-lg-5 col-md-5 col-12">

					<div class="card card-warning ">
						<div class="card-header with-border">
							<h3 class="box-title">Keranjang</h3>
							<div class="box-tools pull-right">
								<span><i class="fa fa-shopping-cart"></i></span>
							</div>
						</div>
						<div class="card-body">
							<div class="cart">
								<div id="pos">
									<div class="well well-sm" id="leftdiv">
										<div id="lefttop" style="margin-bottom:5px;">
											<div class="form-group" style="margin-bottom:5px;">
												<p><a href="#" title="Cari produk"><i class="fa fa-search"></i></a> Cari produk</p>
												<form>
													<div class="form-group">
														<input class="form-control search-input" name="id_produk" type="text" onkeyup="showResult(this.value)" placeholder="Ketik Nama produk">
														<div id="hasilcari"></div>
													</div>
												</form>
											</div>
										</div>
										<div id="list-table-div">
											<div class="fixed-table-header table-responsive">
												<table id="example1" class="table table-sm">
													<thead class="table-light">
														<tr class="info">
															<th>Items</th>
															<th style="width: 15%;text-align:center;">Price</th>
															<th style="width: 10%;text-align:center;">Qty</th>
															<th style="width: 20%;text-align:center;">Subtotal
															</th>
															<th style="width: 20px;text-align:right" class="satu absorbing-column">Cancel</th>
														</tr>
													</thead>
													<tbody id="detail_cart">

													</tbody>

												</table>
											</div>
										</div>
									</div>
									<div id="botbuttons" class="col-xs-12 text-center">
										<div class="row">
											<a href="<?php echo base_url() ?>app/cancel" class="btn btn-light w-100 mb-1 waves-effect waves-float waves-light" id="reset">Cancel Pesanan</a>
											<!-- <a href="#" onclick="payment()"
															class="btn btn-dark w-100 btn-next place-order waves-effect waves-float waves-light"
															id="pembayaran">Pembayaran</a> -->
											<a href="<?php echo base_url('transaksi'); ?>" class="btn mb-1 btn-dark w-100 btn-next place-order waves-effect waves-float waves-light" id="pembayaran">Proses Pesanan</a>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<!-- END: Content-->
<div class="modal fade" id="modalpayment" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div id="datapayment">
				<div class="modal-header">
					<h4 class="modal-title" id="payModalLabel">
						Payment </h4>
					<button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
				</div>
				<div class="modal-body">
					<form onSubmit="if(!confirm('Pastikan sudah terjadi pembayaran!')){return false;}" action="<?= base_url('app/transaksi'); ?>" method="POST" name="frm_byr">
						<div class="row">
							<div class="col-xs-12">
								<div>
									<table id="modaltab" class="table table-bordered table-condensed" style="margin-bottom: 0;">
										<tr class="table-secondary">
											<td id="mdl" width="25%" style="border-right-color: #FFF !important;">
												Total produk</td>
											<td id="mdl" width="25%" class="text-center">
												<span id="item_count"><?= $this->cart->total_items(); ?></span>
											</td>
											<td id="mdl" width="25%" style="border-right-color: #FFF !important;">
												Grand Total</td>
											<td id="mdl" class="text-right">
												<input type="hidden" name="totalpure" id="totalpure" value="<?php echo  $this->cart->total(); ?>" class="form-control kb-text">
												<span>Rp.<input readonly type="number" class="form-control form-control-sm" id="total" name="grandtotal" onfocus="startCalculate()" onblur="stopCalc()" value="<?= $this->cart->total(); ?>" required="">
												</span>
											</td>
										</tr class="table-secondary">
										<tr>
											<td id="mdl" style="border-right-color: #FFF !important;">Diskon</td>
											<td id="mdl" class="text-center"><span>
													<input type="number" name="diskon" id="diskon" max="100" min="0" onfocus="startCalculate()" onblur="stopCalc()" value="0" required=""><span>%</span>
												</span></td>
											<td id="mdl" style="border-right-color: #FFF !important;">Kembalian</td>
											<td id="mdl" class="text-right">
												<span>Rp.
													<input readonly type="number" id="kembalian" name="kembalian" onfocus="startCalculate()" onblur="stopCalc()" required="">
												</span>
											</td>
										</tr>
									</table>
									<div class="clearfix"></div>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<div class="form-group">
											<label for="note"><strong>BAYAR (Rp)</strong>
											</label>
											<input type="number" placeholder="Pembayaran" name="bayar" class="form-control" id="bayar" onfocus="startCalculate()" onblur="stopCalc()" required="">
										</div>
										<div class="form-group">
											<label for="pelanggan">Nama Pelanggan</label>
											<input type="text" name="pelanggan" placeholder="Nama Pelanggan" class="form-control">
										</div>
										<div class="form-group">
											<label for="note">Catatan</label>
											<textarea name="note" placeholder="Catatan untuk transaksi" id="note" class="pa form-control kb-text"></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<div class="form-group">
											<label for="payment">Metode Pembayaran</label>
											<select id="payment" name="metode" class="form-control">
												<option value="1">Cash</option>
												<option value="2">Transfer</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row" id="rek">
									<div class="col-xs-7">
										<div class="form-group">
											<label for="note">No. Rek</label>
											<input type="text" name="norek" class="form-control kb-text">
										</div>
									</div>
									<div class="col-xs-5">
										<div class="form-group">
											<label for="note">Bank</label>
											<div id="byjson"></div>
										</div>
									</div>
									<div class="col-xs-12">
										<div class="form-group">
											<label for="note">Atas Nama(A/N)</label>
											<input type="text" name="atas_nama" class="form-control kb-text">
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<?php
									if (!empty($this->cart->contents())) {
										foreach ($this->cart->contents() as $items) { ?>
											<input type="hidden" name="id_produk" value="<?= $items['id']; ?>">
											<input type="hidden" name="kode_produk" value="<?= $items['kode_produk']; ?>">
											<input type="hidden" name="id_bahan" value="<?= $items['id_bahan']; ?>">
											<input type="hidden" name="rowid" value="<?= $items['rowid']; ?>">
											<input type="hidden" value="<?= $items['qty']; ?>" name="qty" size="5">
									<?php }
									} else {
									} ?>

									<button type="button" class="btn btn-default pull-left" data-bs-dismiss="modal">
										Close </button>
									<button class="btn btn-dark" id="submit-sale">Submit</button>
								</div>
							</div>
						</div><!-- /.modal-dialog -->
					</form>
				</div><!-- /.modal -->
			</div>
		</div>
	</div>
</div><!-- /.modal-dialog -->

<div class="modal fade" id="myModal2" role="dialog">
	<div class="modal-dialog modal-lg">
		<div id="produk"> </div>
	</div><!-- /.modal-dialog -->
</div>


<script type="text/javascript">
	$(document).ready(function() {
		$('.add_cart').click(function() {
			var id_produk = $(this).data("produkid");
			var nama_produk = $(this).data("produknama");
			var harga_produk = $(this).data("produkharga");
			var kode_produk = $(this).data("produkkode");
			var quantity = $('#' + id_produk).val();
			$.ajax({
				url: "<?php echo base_url(); ?>app/add_to_cart",
				method: "POST",
				data: {
					id_produk: id_produk,
					kode_produk,
					nama_produk: nama_produk,
					harga_produk: harga_produk,
					quantity: quantity
				},
				success: function(data) {
					$('#detail_cart').html(data);
					swal.fire({
						title: "Success!",
						text: "Berhasil Dimasukan Ke Keranjang!",
						timer: 1500,
						showConfirmButton: false,
						type: 'success',
						icon: 'success'
					});
				}
			});
		});

		// Load shopping cart
		$('#detail_cart').load("<?php echo base_url(); ?>app/load_cart");

		//Hapus Item Cart
		$(document).on('click', '.hapus_cart', function() {
			var row_id = $(this).attr("id"); //mengambil row_id dari artibut id
			$.ajax({
				url: "<?php echo base_url(); ?>app/hapus_cart",
				method: "POST",
				data: {
					row_id: row_id
				},
				success: function(data) {
					$('#detail_cart').html(data);
					swal.fire({
						title: "Berhasil Dihapus!",
						text: "Item Berhasil Dihapus dari Keranjang",
						timer: 1000,
						showConfirmButton: false,
						type: 'success',
						icon: 'success'
					});
				}
			});
		});
	});
</script>

<script type="text/javascript">
	function startCalculate() {
		interval = setInterval("Calculate()", 1);
	}

	function Calculate() {
		let a = <?= $this->cart->total(); ?>;
		let b = document.frm_byr.total.value;
		let c = document.frm_byr.diskon.value;
		let d = document.frm_byr.bayar.value;
		let e = 100;
		let f = (a / e * c);
		let g = (a - f);
		let h = (d - g);
		document.frm_byr.total.value = (g);
		document.frm_byr.kembalian.value = (h);
		let hasil;
		hasil = (g);
		let bilangan = (g);
		let number_string = bilangan.toString(),
			sisa = number_string.length % 3,
			rupiah = number_string.substr(0, sisa),
			ribuan = number_string.substr(sisa).match(/\d{3}/g);
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

	}

	function stopCalc() {
		clearInterval(interval);
	}

	function payment() {
		let idBrg = $('#idbrg').val();
		if (idBrg == undefined) {
			alert('Cart tidak boleh kosong!');
		} else {
			$('#modalpayment').modal("show");
		}
	}

	function tutup() {
		$("#modalpayment").modal("hide");
		$(".modal-backdrop").remove();
	}

	function detailCart(id) {
		let page = '<?= base_url() ?>'
		var url = page + "app/detail_modal/" + id;
		$.ajax({
			url: url,
			type: "GET",
			data: {
				id: id
			},
			success: function(data) {
				$(document.getElementById('produk')).html(data);
				$('#myModal2').modal("show");
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error adding / update data');
			}
		});
	}

	function showResult(str) {
		if (str.length == 0) {
			document.getElementById("hasilcari").innerHTML = "";
			document.getElementById("hasilcari").style.border = "1px solid #A5ACB2";
			return;
		}
		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		} else {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("hasilcari").innerHTML = this.responseText;
				document.getElementById("hasilcari").style.border = "1px solid #A5ACB2";
			}
		}
		xmlhttp.open("GET", "<?= base_url(); ?>app/cariproduk?q=" + str, true);
		xmlhttp.send();
	}

	function createByJson() {
		let jsonData = [{
				description: 'Pilih Metode Transfer Pembayaran',
				value: '',
				text: 'Bank Transfer'
			},
			{
				image: '../assets/dist//img/bank/mandiri.png',
				description: '',
				value: '1',
				text: 'Mandiri'
			},
			{
				image: '../assets/dist/img/bank/bni.png',
				description: '',
				value: '2',
				text: 'BNI'
			},
			{
				image: '../assets/dist/img/bank/bca.png',
				description: '',
				value: '3',
				text: 'BCA'
			},
			{
				image: '../assets/dist/img/bank/bri.png',
				description: '',
				value: '4',
				text: 'BRI',
			},
			{
				image: '../assets/dist/img/bank/niaga.png',
				description: '',
				value: '4',
				text: 'CIMB Niaga'
			},
		];
		let jsn = $("#byjson").msDropDown({
			byJson: {
				data: jsonData,
				name: 'payments'
			}
		}).data("dd");
	}
	$(function() {
		$('#rek').hide();
		$('#payment').change(function() {
			if ($('#payment').val() == '2') {
				$('#rek').show();
				createByJson();
			} else {
				$('#rek').hide();
			}
		});
	});
	$(document).on('keyup', 'input[name=qty]', function() {
		let _this = $(this);
		let min = parseInt(_this.attr('min')) || 1;
		let max = parseInt(_this.attr('max')) || 100; // if max attribute is not defined, 100 is default
		let val = parseInt(_this.val()) || (min - 1); // if input char is not a number the value will be (min - 1) so first condition will be true
		if (val < min)
			_this.val(min);
		if (val > max)
			_this.val(max);
	});
	$(document).on('keyup', 'input[name=diskon]', function() {
		let _this = $(this);
		let zero = parseInt(_this.attr('zero')) || 0;
		let min = parseInt(_this.attr('min')) || 1; // if min attribute is not defined, 1 is default
		let max = parseInt(_this.attr('max')) || 100; // if max attribute is not defined, 100 is default
		let val = parseInt(_this.val()) || (min -
			1); // if input char is not a number the value will be (min - 1) so first condition will be true
		if (val < min || val == '')
			_this.val(min);
		if (val > max)
			_this.val(max);
		if (val == 0)
			_this.val(zero);
	});

	function sort() {
		$("#sort").toggle();
	}

	function customertype() {
		$("#customertype").toggle();
	}
</script>