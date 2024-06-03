<div class="app-content content ">
	<div class="content-wrapper container-xxl p-0">
		<div class="card">
			<div class="card-header">
				<div class="card-title">
					<h2>Pengeluaran</h2>
				</div>
			</div>
			<div class="card-body">
           
				<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModalAdd">Add New</button>
				<table class="table table-light table-sm" id="mytable">
					<thead>
						<tr> 
							<th>Tanggal</th>
							<th>Total</th>
							<th>Catatan</th>
							<th>Dibuat oleh</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Produk-->
<form id="add-row-form" action="<?php echo base_url().'pengeluaran/update'?>" method="post">
	<div class="modal fade" id="ModalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
		aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-transparent">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">Catatan</label>
						<input type="hidden" name="id_pengeluaran" class="form-control" placeholder="ID">
						<input type="text" name="catatan" class="form-control" placeholder="Catatan">
						<div class="form-group">
							<label for="">Total Pengeluaran</label>
							<input type="number" name="total" class="form-control" placeholder="Total Pengeluaran"
								required>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
						<button type="submit" id="add-row" class="btn btn-success">Update</button>
					</div>
				</div>
			</div>
		</div>
    </div>
</form>

<!-- Modal Hapus Produk-->
<form id="add-row-form" action="<?php echo base_url().'pengeluaran/delete'?>" method="post">
	<div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-transparent">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<center>Anda yakin mau menghapus record ini?</center><input type="hidden" name="id_pengeluaran"
						class="form-control" placeholder="ID_PENGELUARAN" required>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
					<button type="submit" id="add-row" class="btn btn-success">Hapus</button>
				</div>
			</div>
		</div>
	</div>
</form>

<!-- Modal Add Produk-->
<form id="add-row-form" action="<?php echo base_url().'pengeluaran/simpan'?>" method="post">
	<div class="modal fade" id="myModalAdd" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-transparent">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<label for="">Catatan</label>
						<input type="text" name="catatan" class="form-control" placeholder="Catatan">
						<div class="form-group mt-1">
							<label for="">Total Pengeluaran</label>
							<input type="number" name="total" class="form-control" placeholder="Total Pengeluaran"
								required>
						</div>

					</div>
				</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
						<button type="submit" id="add-row" class="btn btn-success">Save</button>
					</div>
			</div>
        </div>
</div>
</form>
<script>
	$(document).ready(function () {
		// Setup datatables
		$.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
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
			initComplete: function () {
				var api = this.api();
				$('#mytable_filter input')
					.off('.DT')
					.on('input.DT', function () {
						api.search(this.value).draw();
					});
			},
			oLanguage: {
				sProcessing: "loading..."
			},
			processing: true,
			serverSide: true,
			ajax: {
				"url": "<?php echo base_url().'pengeluaran/get_pengeluaran_kasir_json'?>",
				"type": "POST"
			},
			columns: [
				// {"data": "id_pengeluaran"},
				{
					"data": "tanggal"
				},
				//render harga dengan format angka
				{
					"data": "total",
					render: $.fn.dataTable.render.number(',', '.', '')
				},
				{
					"data": "catatan"
				},
				{
					"data": "created_by_name"
				},
				{
					"data": "view"
				}
			],
			order: [
				[1, 'asc']
			],
			rowCallback: function (row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				$('td:eq(0)', row).html();
			}

		});
		// end setup datatables
		// get Edit Records
		$('#mytable').on('click', '.edit_record', function () {
			var id_pengeluaran = $(this).data('id_pengeluaran');
			var total = $(this).data('total');
			var catatan = $(this).data('catatan');
			// var kategori=$(this).data('kategori');
			$('#ModalUpdate').modal('show');
			$('[name="id_pengeluaran"]').val(id_pengeluaran);
			$('[name="total"]').val(total);
			$('[name="catatan"]').val(catatan);
			// $('[name="kategori"]').val(kategori);
		});
		// End Edit Records
		// get Hapus Records
		$('#mytable').on('click', '.hapus_record', function () {
			var id_pengeluaran = $(this).data('id_pengeluaran');
			$('#ModalHapus').modal('show');
			$('[name="id_pengeluaran"]').val(id_pengeluaran);
		});
		// End Hapus Records

	});

</script>
