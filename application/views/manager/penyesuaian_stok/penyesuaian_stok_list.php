<div class="app-content content ">
	<div class="content-overlay"></div>
	<div class="header-navbar-shadow"></div>
	<div class="content-wrapper container-xxl p-0">
		<div class="content-header row">
		</div>
		<div class="content-body">
			<!-- users list start -->
			<section class="app-user-list">
				<!-- list and filter start -->
				<div class="card">
					<div class="card-header">

						<h3>Data (No Ref . <?= $get_id['no_referensi'];?>)</h3>
						<div class="card-title">

						<a href="<?php echo base_url('manager/penyesuaian_stock/');?>"
								class="btn btn-sm btn-primary waves-effect waves-float waves-light">Kembali</a>
						</div>
					</div>
					<div class="card-datatable">
						<table id="tablebahan" class="table dataTable no-footer dtr-column">
							<thead class="table-light">
								<tr>
									<th>Nama Bahan</th>
									<th>Qty</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php 
                                $no=0;
                                foreach ($data->result() as $row):
                                $no++;
                                ?>
								<tr>
									<td><?php echo $row->nama_bahan;?></td>
									<td><?php echo $row->qty_penyesuaian;?></td>
									<td><?php echo $row->status_penyesuaian;?></td>
									<td>
										<div class="dropdown">
											<button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0"
												data-bs-toggle="dropdown">
												<i data-feather="more-vertical"></i>
											</button>
											<div class="dropdown-menu dropdown-menu-end">
												<a class="dropdown-item btn-edit" href="javascript:void(0);"
													data-id="<?php echo $row->id_penyesuaian_stok_bahan;?>"
													data-referensi="<?php echo $row->no_referensi;?>">
													<i data-feather="edit-2" class="me-50"></i>
													<span>Edit</span>
												</a>
												<a class="dropdown-item btn-delete" href="javascript:void(0);"
													data-id="<?php echo $row->id_penyesuaian_stok_bahan;?>">
													<i data-feather="trash" class="me-50"></i>
													<span>Delete</span>
												</a>
											</div>
										</div>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>

						</table>
					</div>
					<!-- Modal to add new user starts-->
					<div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
							<div class="modal-content">
								<div class="modal-header bg-transparent">
									<button type="button" class="btn-close" data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
								<div class="modal-body pb-5 px-sm-5 pt-50">
									<div class="text-center mb-2">
										<h1 class="mb-1">Tambah Data Bahan Masuk/Keluar</h1>
									</div>
									<form id="editUserForm" class="row gy-1 pt-75"
										action="<?= base_url('manager/bahan/store_penyesuaian_stock');?>" method="POST">

										<input type="hidden" name="penyesuaian_id"
											value="<?= $get_id['id_penyesuaian'];?>">
										<div class="col-xl-6 col-md-6 col-12">
											<label class="form-label" for="">Bahan</label>
											<select class="select2 form-select" name="bahan_id" id="select2-basic">
												<?php 
										foreach ($bahan->result() as $row):
										?>
												<option value="<?= $row->id_bahan;?>"><?= $row->nama_bahan;?>
													(<?= $row->kode_bahan;?>)</option>
												<?php endforeach;?>
											</select>
										</div>
										<div class="col-xl-6 col-md-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="disabledInput">Quantity
													Penyesuaian</label>
												<input type="number" name="qty_penyesuaian" class="form-control"
													placeholder="0">
											</div>
										</div>

										<div class="col-xl-6 col-md-6 col-12">
											<label class="form-label" for="select2Demo">Status Penyesuaian</label>
											<select class="form-select" name="status_penyesuaian" id="select2-option">
												<option value="Plus">Barang Masuk/Plus</option>
												<option value="Minus">Barang Keluar/Minus</option>
											</select>
										</div> 


										<div class="col-xl-6 col-md-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="disabledInput">Catatan
													Penyesuaian</label>
												<input type="text" name="catatan_penyesuaian" class="form-control"
													placeholder="Note">
											</div>
										</div>
										<div class="col-12 text-center mt-2 pt-50">
											<button type="submit" class="btn btn-primary me-1">Submit</button>
											<button type="reset" class="btn btn-outline-secondary"
												data-bs-dismiss="modal" aria-label="Close">
												Discard
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- Modal to add new user Ends-->
				</div>
				<!-- list and filter end -->
			</section>
			<!-- users list ends -->

		</div>
	</div>
</div>


<script type="text/javascript">
	var table;

	$(document).ready(function () {

		//datatables
		table = $('#tablebahan').DataTable({

			"processing": true, //Feature control the processing indicator.
			"serverSide": false, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.
			//Set column definition initialisation properties.
			"columnDefs": [{
				"targets": [3], //first column / numbering column
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
						columns: [0,1, 2, 3, ]
					}
				}, {
					extend: "csv",
					text: feather.icons["file-text"].toSvg({
						class: "font-small-4 me-50"
					}) + "Csv",
					className: "dropdown-item",
					exportOptions: {
						columns: [0,1, 2, 3, 4, 5]
					}
				}, {
					extend: "excel",
					text: feather.icons.file.toSvg({
						class: "font-small-4 me-50"
					}) + "Excel",
					className: "dropdown-item",
					exportOptions: {
						columns: [0,1, 2, 3, 4, 5]
					}
				}, {
					extend: "pdf",
					text: feather.icons.clipboard.toSvg({
						class: "font-small-4 me-50"
					}) + "Pdf",
					className: "dropdown-item",
					exportOptions: {
						columns: [0,1, 2, 3, 4, 5]
					}
				}, {
					extend: "copy",
					text: feather.icons.copy.toSvg({
						class: "font-small-4 me-50"
					}) + "Copy",
					className: "dropdown-item",
					exportOptions: {
						columns: [0,1, 2, 3, 4, 5]
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
							return "Details of " + e.data().full_name
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

		$('#btn-filter').click(function () { //button filter event click
			table.ajax.reload(); //just reload table
		});
		$('#btn-reset').click(function () { //button reset event click
			$('#form-filter')[0].reset();
			table.ajax.reload(); //just reload table
		});

	});
	$(document).ready(function () {
		$('.select2').select2();
	});

</script>
