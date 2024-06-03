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
									<h3 class='card-title'>Data Laporan Shift</h3>
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
												<button type="submit" class="btn btn-sm btn-primary">Tampilkan</button>
												<a href="<?= base_url('shift');?>"
													class="btn btn-outline-primary btn-sm">Reset Filter</a>
											</div>

										</div>
									</form>

									<hr />
									<b><?php echo $label; ?></b><br /><br />
									<a href="<?php echo $url_export; ?>" class="btn btn-success btn-sm">Export Ke Excel</a><br /><br />
								</div>
								<div class="box-body">
									<table id="myTable" class="table table-light table-sm">
										<thead class="table-light">
											<tr>  
                                            <th>Tanggal</th>
                                            <th>User</th>
                                            <th>Close Time</th>
                                            <th>Close By</th>
                                            <!--<th>Status</th>-->
                                            <th>Kas Awal</th>
                                            <th>Penjualan</th>
                                            <th>Pengeluaran</th>
                                            <th>Kas Akhir</th>
                                            <th>Aksi</th>
											</tr>
										</thead>
										<tbody>

                                        
											<?php
        if( ! empty($shift)){ 
			$total_keuntungan = 0;
          	$no = 1;
              
          foreach($shift as $data){ 
            $closedby = $this->db->query("SELECT * FROM users
            WHERE id='$data->closed_by'")->row_array();
				// $pajak_bongkar[] = $rows->pajak_bongkar; $total_pajak = array_sum($pajak_bongkar)
            echo "<tr>";
            echo "<td>".$data->date."</td>";
            echo "<td>".$data->username."</td>"; 
            echo "<td>".$data->closed_at."</td>"; 
            echo "<td>".$closedby['username']."</td>";
            // echo "<td>".$data->status_shift."</td>";
            echo "<td>".$data->cash_in_hand."</td>";
            echo "<td>".$data->pendapatan."</td>";
            echo "<td>".$data->pengeluaran."</td>";
            echo "<td>".$data->total_cash."</td>";
			if($data->status_shift == 'open'){

				echo "<td><a class='btn btn-sm btn-dark btn-edit' href='javascript:void(0);'
				data-kode_register='$data->kode_register'
				data-user='$data->username' 
				data-date='$data->date' 
				data-kas_awal='$data->cash_in_hand' 
				data-pengeluaran='$data->pengeluaran' 
				>
				<span>Close</span></a></td>";  
			}else{
				echo "<td><a class='btn btn-sm btn-primary btn-view' href='javascript:void(0);'
				data-kode_register='$data->kode_register'
				data-user='$data->username' 
				data-date='$data->date' 
				data-kas_awal='$data->cash_in_hand' 
				data-pengeluaran='$data->pengeluaran' 
				data-note='$data->note' 
				>
				<span>View</span></a></td>";  
			}
            echo "</tr>";
            $no++;
          }
        }
        ?>
											</td>
											</tr>
										</tbody>

										<tfoot class="table-light">
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


<div class="modal fade" id="EditModal" aria-hidden="true" tabindex="-1" role="dialog"
						aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
							<div class="modal-content">
								<div class="modal-header bg-transparent">
									<button type="button" class="btn-close" data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
								<div class="modal-body pb-5 px-sm-5 pt-50">

									<form action="<?php echo site_url('shift/close_register');?>"
										class="row gy-1 pt-75" method="post">
										<div class="col-12 col-md-12">
											<label class="form-label" for="kode_register">Kode Register</label>
											<input type="text" id="kode_register" name="kode_register" readonly
												class="form-control" placeholder="Kode Bahan" />
										</div>

										<div class="col-12 col-md-12">
											<label class="form-label" for="user">Petugas/Kasir</label>
											<input type="text" id="user" readonly name="user" class="form-control"
												placeholder="user" />
										</div>
										<div class="col-12 col-md-12">
											<label class="form-label" for="date">Jam Masuk</label>
											<input type="text" id="date" readonly name="date" class="form-control"
												placeholder="date" />
										</div>
										<div class="col-12 col-md-12">
											<label class="form-label" for="kas_awal">Kas awal</label>
											<input type="text" id="kas_awal" readonly name="kas_awal" class="form-control"
												placeholder="kas_awal" />
										</div>

										
										<div class="col-12 col-md-12">
											<label class="form-label" for="note">Catatan </label>
											<textarea type="text" id="note" name="note" class="form-control"
												placeholder="Catatan Penutupan Shift" required></textarea>
										</div>
										 
								</div>
								<div class="modal-footer">
									<input type="hidden" name="kode" required>

									<div class="col-12 text-center mt-2 pt-50">
										<button type="submit" class="btn btn-primary me-1">Close Shift</button>
										<button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
											aria-label="Close">
											Discard
										</button>
									</div>
								</div>

								</form>
							</div>
						</div>
					</div>

					
					<div class="modal fade" id="ModalView" aria-hidden="true" tabindex="-1" role="dialog"
						aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
							<div class="modal-content">
								<div class="modal-header bg-transparent">
									<button type="button" class="btn-close" data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
								<div class="modal-body pb-5 px-sm-5 pt-50">

									<form action="<?php echo site_url('shift/close_register');?>"
										class="row gy-1 pt-75" method="post">
										<div class="col-12 col-md-12">
											<label class="form-label" for="kode_register">Kode Register</label>
											<input type="text" id="kode_register" name="kode_register" readonly
												class="form-control" placeholder="Kode Bahan" />
										</div>

										<div class="col-12 col-md-12">
											<label class="form-label" for="user">Petugas/Kasir</label>
											<input type="text" id="user" readonly name="user" class="form-control"
												placeholder="user" />
										</div>
										<div class="col-12 col-md-12">
											<label class="form-label" for="date">Jam Masuk</label>
											<input type="text" id="date" readonly name="date" class="form-control"
												placeholder="date" />
										</div>
										<div class="col-12 col-md-12">
											<label class="form-label" for="kas_awal">Kas awal</label>
											<input type="text" id="kas_awal" readonly name="kas_awal" class="form-control"
												placeholder="kas_awal" />
										</div>

										
										<div class="col-12 col-md-12">
											<label class="form-label" for="note">Catatan </label>
											<textarea type="text" id="note" name="note" class="form-control"
												placeholder="Catatan Penutupan Shift" readonly required></textarea>
										</div>
										 
								</div>
								<div class="modal-footer">
									<input type="hidden" name="kode" required>

									<div class="col-12 text-center mt-2 pt-50">
										<button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
											aria-label="Close">
											Discard
										</button>
									</div>
								</div>

								</form>
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


	$('.btn-edit').on('click', function () {
			var kode_register = $(this).data('kode_register');
			var user = $(this).data('user');
			var date = $(this).data('date');
			var kas_awal = $(this).data('kas_awal');
			$('[name="kode_register"]').val(kode_register);
			$('[name="user"]').val(user);
			$('[name="date"]').val(date);
			$('[name="kas_awal"]').val(kas_awal);
			$('#EditModal').modal('show');
		});

		$('.btn-view').on('click', function () {
			var kode_register = $(this).data('kode_register');
			var user = $(this).data('user');
			var date = $(this).data('date');
			var kas_awal = $(this).data('kas_awal');
			var note = $(this).data('note');
			$('[name="kode_register"]').val(kode_register);
			$('[name="user"]').val(user);
			$('[name="date"]').val(date);
			$('[name="kas_awal"]').val(kas_awal);
			$('[name="note"]').val(note);
			$('#ModalView').modal('show');
		});
</script>