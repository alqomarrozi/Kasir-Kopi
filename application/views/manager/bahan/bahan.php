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
					<div class="card-title">
						<a href="<?php echo base_url('manager/bahan');?>" class="btn btn-primary btn-sm waves-effect waves-float waves-light">Kembali</a>
						<!-- <button type="button" class="btn btn-primary btn-sm waves-effect waves-float waves-light"
						data-bs-toggle="modal" data-bs-target="#modalCreateBahan">
						Tambahkan Bahan
					</button> -->
					</div>
					</div>
					<div class="card-datatable">
						<table id="tablebahan" class="user-list-table table dataTable no-footer dtr-column">
							<thead class="table-light">
								<tr>
									<th>SN</th>
									<th>Nama Bahan</th>
									<th>Kode Bahan</th>
									<th>Kategori</th>
									<th>Minimum Stock</th>
									<th>Harga</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php 
                                $no=0;
								function rupiah($angka){
									
									$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
									return $hasil_rupiah;

								}
                                foreach ($data->result() as $row):
                                $no++;
							
                                ?>
								<tr>
									<td><?php echo $row->id_bahan;?></td>
									<td><?php echo $row->nama_bahan;?></td>
									<td><?php echo $row->kode_bahan;?></td>
									<td><?php echo $row->nama_kategori;?></td>
									<td><?php echo number_format($row->minimum_stock);?>g</td> 
									<td><?php echo rupiah($row->harga_bahan);?></td>
									<td>
										<div class="dropdown">
											<button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0"
												data-bs-toggle="dropdown">
												<i data-feather="more-vertical"></i>
											</button>
											<div class="dropdown-menu dropdown-menu-end">
												
												<a class="dropdown-item btn-tambah_stock" href="javascript:void(0);"
													data-id="<?php echo $row->id_bahan;?>">
													<i data-feather="plus" class="me-50"></i>
													<span>Tambah Stock</span>
												</a>
												<a class="dropdown-item btn-tambah_stock" href="javascript:void(0);"
													data-id="<?php echo $row->id_bahan;?>">
													<i data-feather="minus" class="me-50"></i>
													<span>Pengurangan Stock</span>
												</a>
												<a class="dropdown-item btn-edit" href="javascript:void(0);"
													data-id="<?php echo $row->id_bahan;?>"
													data-nama="<?php echo $row->nama_bahan;?>">
													<i data-feather="edit-2" class="me-50"></i>
													<span>Edit</span>
												</a>
												<a class="dropdown-item btn-delete" href="javascript:void(0);"
													data-id="<?php echo $row->id_bahan;?>">
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
					<div class="modal fade" id="modalCreateBahan" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
							<div class="modal-content">
								<div class="modal-header bg-transparent">
									<button type="button" class="btn-close" data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
								<div class="modal-body pb-5 px-sm-5 pt-50">
									<div class="text-center mb-2">
										<h1 class="mb-1">Create New Ingredient</h1>
										<p>Form Pembuatan Bahan Baru.</p>
									</div>
									<form id="editUserForm" class="row gy-1 pt-75" action="<?= base_url('manager/bahan/buat_bahan');?>" method="POST">
										<div class="col-12 col-md-12"> 
											<label class="form-label" for="kode_bahan">Kode Bahan</label> 
											<input type="hidden" id="bahan_kat_id" name="bahan_kat_id" value="<?php echo $cat['id_kategori'];?>"/>
											<input type="text" id="kode_bahan" name="kode_bahan" value="<?= $kode_bahan;?>" readonly class="form-control"
												placeholder="Kode Bahan" />
										</div> 
										<div class="col-12 col-md-12">
											<label class="form-label" for="nama">Nama Bahan</label>
											<input type="text" id="nama" name="nama_bahan" class="form-control"
												placeholder="Nama" />
										</div>
										<div class="col-12 col-md-12">
											<label class="form-label" for="minimum_stock">Minimum Stock (Unit Gram)</label>
											<input type="number" id="minimum_stock" name="minimum_stock" class="form-control"
												placeholder="minimum_stock" />
										</div>
										
										<div class="col-12 col-md-12">
											<label class="form-label" for="harga_bahan">Harga</label>
											<input type="number" id="harga_bahan" name="harga_bahan" class="form-control"
												placeholder="Contoh 25000" />
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
						columns: [1, 2, 3, 4, 5, 6]
					}
				}, {
					extend: "csv",
					text: feather.icons["file-text"].toSvg({
						class: "font-small-4 me-50"
					}) + "Csv",
					className: "dropdown-item",
					exportOptions: {
						columns: [1, 2, 3, 4, 5, 6]
					}
				}, {
					extend: "excel",
					text: feather.icons.file.toSvg({
						class: "font-small-4 me-50"
					}) + "Excel",
					className: "dropdown-item",
					exportOptions: {
						columns: [1, 2, 3, 4, 5, 6]
					}
				}, {
					extend: "pdf",
					text: feather.icons.clipboard.toSvg({
						class: "font-small-4 me-50"
					}) + "Pdf",
					className: "dropdown-item",
					exportOptions: {
						columns: [1, 2, 3, 4, 5, 6]
					}
				}, {
					extend: "copy",
					text: feather.icons.copy.toSvg({
						class: "font-small-4 me-50"
					}) + "Copy",
					className: "dropdown-item",
					exportOptions: {
						columns: [1, 2, 3, 4, 5, 6]
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

	//Edit Record
	$('.btn-delete').on('click', function () {
		var id = $(this).data('id');
		$('[name="kode"]').val(id);
		$('#DeleteModal').modal('show');
	});
    
	});

</script>

<script>
    $('#selectkategori').select2({
        dropdownParent: $('#AddModal')
    });
    $('#selectkategoriEdit').select2({
        dropdownParent: $('#EditModal')
    });
</script>