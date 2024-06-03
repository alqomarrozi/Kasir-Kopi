<style type="text/css">
	.swal2-popup {
		font-family: inherit;
		font-size: 1.2rem;
	}

	.btn-group,
	.btn-group-vertical {
		position: relative;
		display: initial;
		vertical-align: middle;
	}

</style>
<div class="app-content content ">
	<div class="content-overlay"></div>
	<div class="header-navbar-shadow"></div>
	<div class="content-wrapper container-xxl p-0">
		<div class="content-header row">
		</div>
		<div class="content-body">
			<section class="app-user-list">
				<div class="card">
					<div class="row">

						<div class="col-md-12">
							<div class="card card-info">
								<div class='card-header with-border'>
									<h3 class='card-title'>Data Laporan Penjualan Produk</h3>
								</div>
								<div class="card-body">

									<form method="get" action="">
										<div class="row">

											<div class="col-md-4">
												<div class="form-group">
													<label>Filter Berdasarkan</label>
													<select name="filter" id="filter" class="form-control">
														<option value="">Pilih</option>
														<option value="1">Per Tanggal</option>
														<option value="2">Per Bulan</option>
														<option value="3">Per Tahun</option>
													</select>
												</div>
											</div>

											<div class="col-md-8" id="form-tanggal">
												<div class="input-daterange">
													<div class="form-group" >
														<label for="start_date" class="control-label">Tanggal</label>
														<div class="input-group">
															<input type="text"
																class="form-control flatpickr-tanggal "
																name="tanggal" 
																data-error="Tanggal Awal harus diisi" required />
															<span class="input-group-text cursor-pointer">
																<i data-feather="calendar"></i>
															</span>
														</div>
														<div class="help-block with-errors"></div>
													</div>
												</div>
											</div>
											<div class="col-md-4" id="form-bulan">
												<div class="form-group">
													<label>Bulan</label>
													<select name="bulan" class="form-control">
														<option value="">Pilih</option>
														<option value="1">Januari</option>
														<option value="2">Februari</option>
														<option value="3">Maret</option>
														<option value="4">April</option>
														<option value="5">Mei</option>
														<option value="6">Juni</option>
														<option value="7">Juli</option>
														<option value="8">Agustus</option>
														<option value="9">September</option>
														<option value="10">Oktober</option>
														<option value="11">November</option>
														<option value="12">Desember</option>
													</select>
												</div>
											</div>

											<div class="col-md-4" id="form-tahun">
												<div class="form-group">
													<label>Tahun</label>
													<select name="tahun" class="form-control">
														<option value="">Pilih</option>
														<?php
														foreach($option_tahun as $data){ // Ambil data tahun dari model yang dikirim dari controller
														echo '<option value="'.$data->tahun.'">'.$data->tahun.'</option>';
														}
																?>
													</select>
												</div>
											</div>
											<br>
											<div class="col-md-12 mt-1">
												<button type="submit" class="btn btn-primary">Tampilkan</button>
												<a href="<?= base_url('manager/lapproduk');?>"
													class="btn btn-outline-primary">Reset Filter</a>
											</div>

										</div>
									</form>

									<hr />
									<b><?php echo $label; ?></b><br /><br />
									<a href="<?php echo $url_export; ?>" class="btn btn-success btn-sm">Export Ke Excel</a><br /><br />
								</div>
								<div class="box-body">
									<table id="myTable" class="table table-sm">
										<thead class="table-light">
											<tr>
												<th>Tanggal</th>
												<th>Kode Transaksi</th>
												<th>Nama Produk</th>
												<th>Qty</th>
												<th>Diskon</th>
												<th>Modal</th>
												<th>Pajak</th>
												<th>Grand Total</th>
												<th>Keuntungan</th>
											</tr>
										</thead>
										<tbody>
											<?php
        if( ! empty($transaksi)){
			$total_keuntungan = 0;
          	$no = 1;
          foreach($transaksi as $data){ 
                $tgl = $data->tgl_trf; 
                $grand_total = $data->grand_total;
                $sub_total = $data->sub_total;
                $modal = $data->modal_produk*$data->jumlah_stok;
                $pajak = $data->pajak_produk*$data->jumlah_stok;
                $laba = $sub_total-$modal-$pajak;
				$jumlah_produk[] = $data->jumlah_stok; $total_terjual = array_sum($jumlah_produk);
				$pajak_produk[] = $pajak; $total_pajak = array_sum($pajak_produk);
				$modal_produk[] = $modal; $total_modal = array_sum($modal_produk);
				$income[] = $sub_total; $total_pemasukan = array_sum($income); 
				$keuntungan[] = $laba; $total_keuntungan = array_sum($keuntungan);
				
				// $pajak_bongkar[] = $rows->pajak_bongkar; $total_pajak = array_sum($pajak_bongkar)
            echo "<tr>";
            echo "<td>".$tgl."</td>";
            echo "<td>".$data->no_trf."</td>";
            echo "<td>".$data->produk_name."</td>";
            echo "<td>".$data->jumlah_stok."</td>";
            echo "<td>".$data->diskon."%</td>";
            echo "<td>".$modal."</td>";
            echo "<td>".$pajak."</td>";
            echo "<td>".$grand_total."</td>";
            echo "<td><b>".$laba."</b></td>";
            echo "</tr>";
            $no++;
          }
        }
        ?>
											</td>
											</tr>
										</tbody>

										<tfoot class="table-light">
											<tr>
         <td>Total</td>
         <td></td>
         <td></td>
		 <?php 
		 	function rupiah($angka){
									
				$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
				return $hasil_rupiah;

			}
			function rp($angka){
				$hasil_rupiah = number_format($angka,0,',','.');
				return $hasil_rupiah;
			}
		 ;?>
         <td><?php if(! empty($total_terjual)){
			 echo $total_terjual;
		 }; ?></td>
         <td></td>
         <td><?php if(! empty($total_modal)){
			  echo rp($total_modal) ;
			  }?></td>
         <td><?php if(! empty($total_pajak)){
			  echo rp($total_pajak) ;
			  }?></td> 
         <td><?php if(! empty($total_modal)){
			  echo rp($total_pemasukan) ;
			  }?></td>
         <td><b><?php if(! empty($total_keuntungan)){
			  echo rp($total_keuntungan) ;
			  }?></b></td>
      </tr>      
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<script type="text/javascript">
	var table;

	$(document).ready(function () {

		//datatables
		table = $('#myTable').DataTable({

			"processing": true, //Feature control the processing indicator.
			"serverSide": false, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.
			//Set column definition initialisation properties.
			"columnDefs": [{
				"targets": [0, 2], //first column / numbering column
				"orderable": false, //set not orderable
			}, ],

			dom: '<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-75"<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" l><"col-sm-12 col-lg-8 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap"<"me-1"f>B>>>t<"d-flex justify-content-between mx-2 row mb-1"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',

			buttons: [{
				extend: "collection",
				className: "btn btn-outline-secondary dropdown-toggle me-2",
				text: feather.icons["external-link"].toSvg({
					class: "font-small-4 me-50"
				}) + "Export",
				buttons: [{
					extend: "print",
					text: feather.icons.printer.toSvg({
						class: "font-small-4 me-50"
					}) + "Print",
					className: "dropdown-item",
					exportOptions: {
						columns: [1, 2, 3, 4]
					}
				}, {
					extend: "csv",
					text: feather.icons["file-text"].toSvg({
						class: "font-small-4 me-50"
					}) + "Csv",
					className: "dropdown-item",
					exportOptions: {
						columns: [1, 2, 3, 4]
					}
				}, {
					extend: "excel",
					text: feather.icons.file.toSvg({
						class: "font-small-4 me-50"
					}) + "Excel",
					className: "dropdown-item",
					exportOptions: {
						columns: [1, 2, 3, 4]
					}
				}, {
					extend: "pdf",
					text: feather.icons.clipboard.toSvg({
						class: "font-small-4 me-50"
					}) + "Pdf",
					className: "dropdown-item",
					exportOptions: {
						columns: [1, 2, 3, 4]
					}
				}, {
					extend: "copy",
					text: feather.icons.copy.toSvg({
						class: "font-small-4 me-50"
					}) + "Copy",
					className: "dropdown-item",
					exportOptions: {
						columns: [1, 2, 3, 4]
					}
				}],
				init: function (e, t, a) {
					$(t).removeClass("btn-secondary"), $(t).parent().removeClass("btn-group"),
						setTimeout((function () {
							$(t).closest(".dt-buttons").removeClass("btn-group")
								.addClass("d-inline-flex mt-50")
						}), 50)
				}
			}, ],
			responsive: {
				details: {
					display: $.fn.dataTable.Responsive.display.modal({
						header: function (e) {
							return "Details Transaksi "
						}
					}),
					type: "column",
					renderer: function (e, t, a) {
						var s = $.map(a, (function (e, t) {
							return 6 !== e.columnIndex ? '<tr data-dt-row="' + e.rowIdx +
								'" data-dt-column="' + e.columnIndex + '"><td>' + e.title +
								":</td> <td>" + e.data + "</td></tr>" : ""
						})).join("");
						return !!s && $('<table class="table"/>').append("<tbody>" + s + "</tbody>")
					}
				}
			},
			language: {
				paginate: {
					previous: "&nbsp;",
					next: "&nbsp;"
				}
			},

		});

	});

</script>

<script>
	$(document).ready(function () { // Ketika halaman selesai di load
		setDatePicker() // Panggil fungsi setDatePicker
		$('#form-tanggal, #form-bulan, #form-tahun')
		.hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya
		$('#filter').change(function () { // Ketika user memilih filter
			if ($(this).val() == '1') { // Jika filter nya 1 (per tanggal)
				$('#form-bulan, #form-tahun').hide(); // Sembunyikan form bulan dan tahun
				$('#form-tanggal').show(); // Tampilkan form tanggal
			} else if ($(this).val() == '2') { // Jika filter nya 2 (per bulan)
				$('#form-tanggal').hide(); // Sembunyikan form tanggal
				$('#form-bulan, #form-tahun').show(); // Tampilkan form bulan dan tahun
			} else { // Jika filternya 3 (per tahun)
				$('#form-tanggal, #form-bulan').hide(); // Sembunyikan form tanggal dan bulan
				$('#form-tahun').show(); // Tampilkan form tahun
			}
			$('#form-tanggal input, #form-bulan select, #form-tahun select').val(
			''); // Clear data pada textbox tanggal, combobox bulan & tahun
		})
	})

	function setDatePicker() {
		$('.flatpickr-tanggal').flatpickr({
    dateFormat: "Y-m-d",
});
	}

</script>