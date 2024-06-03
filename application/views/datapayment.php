<!-- BEGIN: Content-->
<div class="app-content content ">
	<div class="content-overlay"></div>
	<div class="header-navbar-shadow"></div>
	<div class="content-wrapper p-0">
		<div class="content-body">
			<div class="card">
				<div class="card-body">

					<form action="<?= base_url('transaksi/proses'); ?>" method="POST" name="frm_byr">
						<div class="row">
							<div class="col-md-12">

								<table class="table table-sm table-responsive">
									<thead class="table-dark">
										<tr>
											<td colspan="6">Detail Pembelian</td>
										</tr>
										<tr class="info">
											<th style="width: 5%;text-align:left;">No</th>
											<th style="width: 15%;">Kode</th>
											<th style="width: 30%;">Items</th>
											<th style="width: 15%;">Price</th>
											<th style="width: 10%;">Qty</th>
											<th style="width: 10%;">Subtotal
											</th>
										</tr>
									</thead>
									<tbody id="detail_cart">

									</tbody>

								</table>
								<table id="modaltab" class="table table-light" style="margin-bottom: 0;">
									<tr class="table-dark">
										<td width="25%">
											Total produk</td>
										<td width="25%" class="text-center">
											<span id="item_count"><strong><?= $this->cart->total_items(); ?></strong></span>
										</td>
									</tr>
									<tr>
										<td>Diskon %</td>
										<td class="text-center"><span>
												<input type="number" name="diskon" id="diskon" max="100" min="0" onfocus="startCalculate()" class="form-control form-control-sm" onblur="stopCalc()" value="0" required="">
											</span></td>
									</tr>
									
									<tr>
										<td>Order Type</td>
										<td class="text-center"><span>
										<select id="order_type" name="order_type" class="form-control form-control-sm" onfocus="startCalculate()" onblur="stopCalc()" style="width:100%;">
										<option value="0">Offline Transaction</option>
										<option value="2000">Gofood</option>
										<option value="3000">Grabfood</option>
									</select>
											</span></td>
									</tr>
									<tr>
										<td width="25%">
											Grand Total</td>
										<td>
											<input type="hidden" name="totalpure" id="totalpure" value="<?php echo $this->cart->total(); ?>" class="form-control kb-text">
											<span><input readonly type="number" class="form-control form-control-sm numeral-mask" style="font-weight:bold" id="total" name="grandtotal" onfocus="startCalculate()" onblur="stopCalc()" value="<?= $this->cart->total(); ?>" required="">
											</span>
										</td>
									</tr>
									<tr>
										<td>Kembalian</td>
										<td>
											<span>
												<input readonly type="number" id="kembalian" name="kembalian" class="form-control numeral-mask2 form-control-sm" onfocus="startCalculate()" onblur="stopCalc()" required="">
											</span>
										</td>
									</tr>
								</table>
								<div class="clearfix"></div>

							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="note"><strong>Cash Diterima</strong>
									</label>
									<input type="number" placeholder="Pembayaran" name="bayar" class="form-control form-control-lg numeral-mask" id="bayar" onfocus="startCalculate()" onblur="stopCalc()" required="">
								</div>
								<div class="form-group">
									<label for="pelanggan">Atas Nama</label>
									<input type="text" name="pelanggan" placeholder="Atas Nama Pelanggan" class="form-control form-control-lg">
								</div>
								<div class="form-group">
									<label for="note">Catatan</label>
									<textarea name="note" placeholder="Catatan untuk transaksi" id="note" class="pa form-control form-control-lg kb-text"></textarea>
								</div>
								<div class="form-group">
									<label for="payment">Metode Pembayaran</label>
									<select id="payment" name="metode" class="form-control form-control-lg" style="width:100%;">
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
									<input type="text" name="norek" class="form-control form-control-lg kb-text">
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
									<input type="text" name="atas_nama" class="form-control form-control-lg kb-text">
								</div>
							</div>
						</div>
						<div class="modal-footer mt-2">
							<?php
							if (!empty($this->cart->contents())) {
								foreach ($this->cart->contents() as $items) { ?>
									<input type="hidden" name="id_produk" value="<?= $items['id']; ?>">
									<input type="hidden" name="kode_produk" value="<?= $items['kode_produk']; ?>">
									<input type="hidden" name="rowid" value="<?= $items['rowid']; ?>">
									<input type="hidden" value="<?= $items['qty']; ?>" name="qty" size="5">

									<?php
									$kode_produk = $items['kode_produk'];
									$itemsid = $items['id_produk'];
									$bahan = $this->db->query("SELECT * FROM produk_bahan LEFT JOIN bahan ON bahan_id=id_bahan WHERE kode_produk='$kode_produk'");
									$extras = $this->db->query("SELECT * FROM extras LEFT JOIN extras_bahan ON extras.kode_extras=extras_bahan.extras_kode LEFT JOIN bahan ON extras_bahan.bahan_id = bahan.id_bahan
		WHERE extras.id_produk='$itemsid'");; ?>

									<?php foreach ($extras->result() as $z) : ?>
										<input type="hidden" name="id_extras[]" value="<?= $z->id_extras; ?>">
									<?php endforeach; ?>
									<?php foreach ($bahan->result() as $b) : ?>

										<input type="hidden" name="id_bahan[]" value="<?= $b->bahan_id; ?>">
										<?php $stokupdate =  intval($b->stok_bahan) - intval($b->jumlah); ?>
										<input type="hidden" name="stokupdate[]" value="<?= $stokupdate; ?>">
										<input type="hidden" name="stok[]" value="<?= $b->stok_bahan; ?>">
										<input type="hidden" name="kurangi[]" value="<?= $b->jumlah; ?>">

									<?php endforeach; ?>
							<?php }
							} else {
							} ?>

							<a href="<?php echo base_url('app'); ?>" class="btn btn-relief-dark btn-sm">
								Kembali </a>
							<button class="btn btn-relief-dark btn-sm" id="submit-sale">Place Order</button>
						</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
</div>


<script type="text/javascript">
	function startCalculate() {
		interval = setInterval("Calculate()", 1);
	}
	

		
	var price_online = {};

	$('#order_type').on('change', function () {
		 price_online = this.value;
	});

	function Calculate() {
		let a = <?= $this->cart->total(); ?>;
		let b = document.frm_byr.total.value;
		let c = document.frm_byr.diskon.value;
		let d = document.frm_byr.bayar.value;
		let e = 100;
		let f = (a / e * c);
		let g = (a - f);
		let h = (d - g);
		// let select_oder_type = price_online;
		// console.log(select_oder_type);
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
				image: '<?php echo base_url(); ?>/assets/dist/img/bank/mandiri.png',
				description: '',
				value: '1',
				text: 'Mandiri'
			},
			{
				image: '<?php echo base_url(); ?>/assets/dist/img/bank/bni.png',
				description: '',
				value: '2',
				text: 'BNI'
			},
			{
				image: '<?php echo base_url(); ?>/assets/dist/img/bank/bca.png',
				description: '',
				value: '3',
				text: 'BCA'
			},
			{
				image: '<?php echo base_url(); ?>/assets/dist/img/bank/bri.png',
				description: '',
				value: '4',
				text: 'BRI',
			},
			{
				image: '<?php echo base_url(); ?>/assets/dist/img/bank/niaga.png',
				description: '',
				value: '4',
				text: 'CIMB Niaga'
			},

			{
				image: '<?php echo base_url(); ?>/assets/dist/img/credit/visa.png',
				description: '',
				value: '5',
				text: 'Bank Lainnya'
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
		let val = parseInt(_this.val()) || (min -
			1); // if input char is not a number the value will be (min - 1) so first condition will be true
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

	$('#detail_cart').load("<?php echo base_url(); ?>transaksi/load_cart");

	function konfirmasi() {
		if (!alert('Pastikan sudah terjadi pembayaran!')) {
			return false;
		}
	}
</script>