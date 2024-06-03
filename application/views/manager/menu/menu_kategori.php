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
						<h2>Kategori Produk</h2>
						<div class="card-title">
							<button type="button" class="btn btn-primary waves-effect waves-float waves-light btn-sm"
								data-bs-toggle="modal" data-bs-target="#modalAddCategory">
								<i data-feather='plus'></i> Kategori Baru
							</button>

							<a href="<?php echo base_url('manager/menu');?>"
								class="btn btn-dark waves-effect waves-float waves-light btn-sm"><i
									data-feather='list'></i> Semua Produk Menu</a>
						</div>
					</div>
					<div class="card-datatable table-responsive pt-0">
						<table id="tablebahan" class="user-list-table table dataTable no-footer dtr-column">
							<thead class="table-light">
								<tr>
									<th>SN</th>
									<th>Nama Kategori</th>
									<th>Jumlah Produk</th>
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
									<td><?php echo $row->id_kategori;?></td>
									<td><b><?php echo $row->nama_kategori;?></b></td>
									<?php 
                    $query=$this->db->query("SELECT * FROM produk WHERE kategori_id=".$row->id_kategori."");
                    $jumlah_produk=$query->num_rows();
              ?>
									<td><?= $jumlah_produk;?> Produk</td>
									<td>

										<div class="dropdown">
											<button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0"
												data-bs-toggle="dropdown">
												<i data-feather="more-vertical"></i>
											</button> 
											<div class="dropdown-menu dropdown-menu-end">
												<a class="dropdown-item btn-edit" href="javascript:void(0);"
													data-id="<?php echo $row->id_kategori;?>"
													data-nama_kategori="<?php echo $row->nama_kategori;?>">
													<i data-feather="edit-2" class="me-50"></i>
													<span>Edit</span>
												</a>
												<a class="dropdown-item btn-delete" href="javascript:void(0);" data-id="<?php echo $row->id_kategori;?>">
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
					<div class="modal fade" id="modalAddCategory" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
							<div class="modal-content">
								<div class="modal-header bg-transparent">
									<button type="button" class="btn-close" data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
								<div class="modal-body pb-5 px-sm-5 pt-50">
									<div class="text-center mb-2">
										<h1 class="mb-1">Create New Category</h1>
										<p>Form Pembuatan Kategori Bahan Baru.</p>
									</div>
									<form id="editUserForm" class="row gy-1 pt-75"
										action="<?php echo base_url('manager/kategori/add_kategori');?>" method="POST">
										<input type="hidden" id="added_by" name="added_by" />
										<div class="col-12 col-md-12">
											<label class="form-label" for="nama_kategori">Nama Kategori</label>
											<input type="text" id="nama_kategori" name="nama_kategori"
												class="form-control" placeholder="Nama Kategori" required />
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
					<!--EDIT RECORD MODAL-->
					<div class="modal fade" id="EditModal" aria-hidden="true" tabindex="-1" role="dialog"
						aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
							<div class="modal-content">
								<div class="modal-header bg-transparent">
									<button type="button" class="btn-close" data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
								<div class="modal-body pb-5 px-sm-5 pt-50">

									<form action="<?php echo site_url('manager/kategori/edit_kategori');?>"
										class="row gy-1 pt-75" method="post">
										<div class="col-12 col-md-12">
                                            <label >Nama Kategori</label>
											<input type="text" name="nama_kategori" class="form-control"
												placeholder="Category Name" required>
										</div>
								</div>
								<div class="modal-footer">
									<input type="hidden" name="kode" required>

									<div class="col-12 text-center mt-2 pt-50">
										<button type="submit" class="btn btn-primary me-1">Submit</button>
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
					<!-- Delete Modal  -->

					<div class="modal fade" id="DeleteModal" aria-hidden="true" tabindex="-1" role="dialog"
						aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
							<div class="modal-content">
								<div class="modal-header bg-transparent">
									<button type="button" class="btn-close" data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
								
								<form action="<?php echo site_url('manager/kategori/delete_kategori');?>"
										class="row gy-1 pt-75" method="post">
								<div class="modal-body">

								<div class="text-center">
									<h2>Yakin Hapus Kategori Bahan ini?</h2>
								</div>
								</div>
								<div class="modal-footer">
									<input type="hidden" name="kode" required>
									<div class="col-12 text-center mt-2 pt-50">
										<button type="submit" class="btn btn-primary me-1">Submit</button>
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
			"order": [0, 'desc'], //Initial no order.
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
						columns: [1, 2, 3, 4, 5]
					}
				}, {
					extend: "excel",
					text: feather.icons.file.toSvg({
						class: "font-small-4 me-50"
					}) + "Excel",
					className: "dropdown-item",
					exportOptions: {
						columns: [1, 2, 3, 4, 5]
					}
				}, {
					extend: "pdf",
					text: feather.icons.clipboard.toSvg({
						class: "font-small-4 me-50"
					}) + "Pdf",
					className: "dropdown-item",
					exportOptions: {
						columns: [1, 2, 3, 4, 5]
					}
				}, {
					extend: "copy",
					text: feather.icons.copy.toSvg({
						class: "font-small-4 me-50"
					}) + "Copy",
					className: "dropdown-item",
					exportOptions: {
						columns: [1, 2, 3, 4, 5]
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
	//Edit Record
	$('.btn-edit').on('click', function () {
		var id = $(this).data('id');
		var nama_kategori = $(this).data('nama_kategori');
		var deskripsi = $(this).data('deskripsi');
		$('[name="kode"]').val(id); 
		$('[name="nama_kategori"]').val(nama_kategori);
		$('[name="deskripsi"]').val(deskripsi);
		$('#EditModal').modal('show');
	});

	//Edit Record
	$('.btn-delete').on('click', function () {
		var id = $(this).data('id');
		$('[name="kode"]').val(id);
		$('#DeleteModal').modal('show');
	});

</script>
