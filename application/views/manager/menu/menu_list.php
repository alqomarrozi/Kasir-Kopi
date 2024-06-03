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
						<h2>Data Produk</h2>
						<div class="card-title">
							<a href="<?= base_url('manager/menu/add');?>" class="btn btn-relief-primary btn-sm"><i data-feather='plus'></i>Tambah Menu</a>							
						</div>
					</div>
					<div class="card-datatable table-responsive pt-0">
						<table id="mytable" class="table-sm user-list-table table dataTable no-footer dtr-column">
							<thead class="table-light">
								<tr>
									<th>SN</th>
									<th>IMG</th>
									<th>Kode Produk</th>
									<th>Nama Produk</th>
									<th>Kategori</th>
									<th>Harga</th>
									<th>Modal</th>
									<th>Pajak</th>
									<!-- <th>Bahan</th> -->
									<th>Action</th>
								</tr>
							</thead>
						 
						</table>
					</div> 

					<div class="modal fade" id="DeleteModal" aria-hidden="true" tabindex="-1" role="dialog"
						aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
							<div class="modal-content">
								<div class="modal-header bg-transparent">
									<button type="button" class="btn-close" data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
								
								<form action="<?php echo site_url('manager/menu/delete_produk');?>"
										class="row gy-1 pt-75" method="post">
								<div class="modal-body">

								<div class="text-center"> 
									<h2>Yakin Hapus Menu?</h2>
								</div>
								</div>
								<div class="modal-footer">
									<input type="hidden" name="id_produk" required>
									<input type="hidden" name="kode_produk" required>
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


<script>
    $(document).ready(function(){
        // Setup datatables
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
      {
          return {
              "iStart": oSettings._iDisplayStart,
              "iEnd": oSettings.fnDisplayEnd(),
              "iLength": oSettings._iDisplayLength,
              "iTotal": oSettings.fnRecordsTotal(),
              "iFilteredTotal": oSettings.fnRecordsDisplay(),
              "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
              "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
          };
      };
 
      var table = $("#mytable").dataTable({
          initComplete: function() {
              var api = this.api();
              $('#mytable_filter input')
                  .off('.DT')
                  .on('input.DT', function() {
                      api.search(this.value).draw();
              });
          },
              oLanguage: {
              sProcessing: "loading..."
          },
              processing: true,
              serverSide: true,
              responsive:true,
              ajax: {"url": "<?php echo base_url().'manager/menu/get_menu_json'?>", "type": "POST"},
                    columns: [
                                                {"data": "id_produk"},
                                                {"data": "gambar_produk"},
                                                {"data": "kode_produk"},
                                                {"data": "nama_produk"}, 
                                                {"data": "nama_kategori"},
                                                //render harga dengan format angka
                                                {"data": "harga_produk", render: $.fn.dataTable.render.number(',', '.', '')},
                                                {"data": "modal_produk", render: $.fn.dataTable.render.number(',', '.', '')},
                                                {"data": "pajak_produk", render: $.fn.dataTable.render.number(',', '.', '')},
                                                {"data": "view"}
                  ],
                order: [[0, 'DESC']],

			"columnDefs": [{
				"targets": [1], //first column / numbering column
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
				}, {
					extend: "csv",
					text: feather.icons["file-text"].toSvg({
						class: "font-small-4 me-50"
					}) + "Csv",
					className: "dropdown-item",
				}, {
					extend: "excel",
					text: feather.icons.file.toSvg({
						class: "font-small-4 me-50"
					}) + "Excel",
					className: "dropdown-item",
				}, {
					extend: "pdf",
					text: feather.icons.clipboard.toSvg({
						class: "font-small-4 me-50"
					}) + "Pdf",
					className: "dropdown-item",
				}, {
					extend: "copy",
					text: feather.icons.copy.toSvg({
						class: "font-small-4 me-50"
					}) + "Copy",
					className: "dropdown-item",
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
							return "Menu Details of " + e.data().nama_produk
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
          rowCallback: function(row, data, iDisplayIndex) {
              var info = this.fnPagingInfo();
              var page = info.iPage;
              var length = info.iLength;
              $('td:eq(0)', row).html();
          }
          
 
      });
            // end setup datatables
            // get Edit Records 
            $('#mytable').on('click','.edit_record',function(){
                        var id_produk=$(this).data('id_produk');
                        var nama_produk=$(this).data('nama_produk');
                        var harga_produk=$(this).data('harga_produk');
                        var modal_produk=$(this).data('modal_produk');
                        var gambar_produk=$(this).data('gambar_produk');
                        var kategori_id=$(this).data('kategori_id');
                        var pajak_produk=$(this).data('pajak_produk');
                        var detail_produk=$(this).data('detail_produk');
            $('#EditModal').modal('show');
            $('[name="id_produk"]').val(id_produk);
                        $('[name="nama_produk"]').val(nama_produk);
                        $('[name="harga_produk"]').val(harga_produk);
                        $('[name="modal_produk"]').val(modal_produk);
                        $('[name="gambar_produk"]').val(gambar_produk);
                        $('[name="kategori_id"]').val(kategori_id);
                        $('[name="pajak_produk"]').val(pajak_produk);
                        $('[name="detail_produk"]').val(detail_produk);
      });
            // End Edit Records
            // get Hapus Records
            $('#mytable').on('click','.hapus_record',function(){
            var id_produk=$(this).data('id_produk');
            var kode_produk=$(this).data('kode_produk');
            $('#DeleteModal').modal('show');
            $('[name="id_produk"]').val(id_produk);
            $('[name="kode_produk"]').val(kode_produk);
      });
            // End Hapus Records
 
    });
</script>
<!-- <script type="text/javascript">
	var table;

	$(document).ready(function () {

		//datatables
		table = $('#tablebahan').DataTable({

			"processing": true, //Feature control the processing indicator.
			"serverSide": false, //Feature control DataTables' server-side processing mode.
			"order": [0, 'desc'], //Initial no order.
			//Set column definition initialisation properties.
			"columnDefs": [{
				"targets": [2], //first column / numbering column
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

</script> -->
