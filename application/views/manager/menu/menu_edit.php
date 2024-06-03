<div class="app-content content ">
	<div class="content-overlay"></div>
	<div class="header-navbar-shadow"></div>
	<div class="content-wrapper container-xxl p-0">
		<div class="content-header row">
		</div>
		<div class="content-body">
			<section id="basic-input">
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h2 class="card-title">Edit Menu / Product</h2>
							</div>
							<div class="card-body">
								<?php echo form_open_multipart('manager/menu/edit', array('role' => "form", 'id' => "myForm", 'data-toggle' => "validator")); ?>

								<div class="row">

									<div class="col-xl-6 col-md-6 col-12">
										<div class="mb-1">
											<label for="formFile" class="form-label">Upload Images</label>
											<input class="form-control" type="file" name="foto" />
										</div>
									</div>

									<div class="col-xl-6 col-md-6 col-12">
										<div class="mb-1">
											<label class="form-label" for="disabledInput">Kode Produk</label>
											<input type="text" readonly name="kode_produk" value="<?= $record['kode_produk']; ?>" class="form-control" required placeholder="Product Name">
										</div>
									</div>
									<div class="col-xl-6 col-md-6 col-12">
										<div class="mb-1">
											<label class="form-label" for="disabledInput">Nama Produk</label>
											<input type="text" name="nama_produk" value="<?= $record['nama_produk']; ?>" class="form-control" required placeholder="Product Name">
										</div>
									</div>

									<div class="col-xl-6 col-md-6 col-12">
										<div class="mb-1">
											<label class="form-label">Produk Kategori</label>
											<select class="select2 form-select" id="selectkategori" name="kategori_id">

												<option value="<?= $record['kategori_id']; ?>"><?= $record['nama_kategori']; ?> (Tidak diubah)</option>
												<?php
												foreach ($kategori->result() as $row) :
												?>
													<option value="<?= $row->id_kategori; ?>"><?= $row->nama_kategori; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>

									<div class="col-xl-4 col-md-6 col-12">
										<div class="mb-1">
											<label class="form-label" for="disabledInput">Harga Produk</label>
											<input type="text" name="harga_produk" value="<?= $record['harga_produk']; ?>" class="form-control" placeholder="Harga Produk">
										</div>
									</div>

									<div class="col-xl-4 col-md-6 col-12">
										<div class="mb-1">
											<label class="form-label" for="disabledInput">Modal Produk</label>
											<input type="text" name="modal_produk" value="<?= $record['modal_produk']; ?>" class="form-control" placeholder="Modal Produk">
										</div>
									</div>

									<div class="col-xl-4 col-md-6 col-12">
										<div class="mb-1">
											<label class="form-label" for="disabledInput">Pajak Produk</label>
											<input type="text" name="pajak_produk" value="<?= $record['pajak_produk']; ?>" class="form-control" placeholder="Pajak Produk">
										</div>
									</div>

									<div class="col-12">
										<div class="form-floating mb-1 mt-1">
											<textarea data-length="500" class="form-control char-textarea" name="detail_produk" id="textarea-counter" rows="3" placeholder="Counter" style="height: 100px"><?= $record['detail_produk']; ?></textarea>
											<label for="textarea-counter">Detail Produk</label>
										</div>
										<small class="textarea-counter-value float-end"><span class="char-count">0</span> / 500 </small>
									</div>
								</div>

								<hr>
								<br>
								<h5> Pilih Bahan yang digunakan <small>( Bahan tidak boleh duplikat! )</small></h5>
							
								<div class="col-xl-6 col-md-6 col-12">

									<button type="button" class="btn btn-sm btn-relief-primary" data-bs-toggle="modal" data-bs-target="#addNewCard">
										Tambah Bahan
									</button>
								</div>
								<div class="row mt-2">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>Bahan</th>
												<th>Jumlah yang diperlukan (Gram)</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody id="produk_bahan">

											<?php
											foreach ($bahankode as $row) :
											?>
												<tr>
													<td><?php echo $row->nama_bahan; ?></td>
													<td><?php echo $row->jumlah; ?></td>
													<td>
													<a class="btn btn-danger btn-sm btn-delete" href="javascript:void(0);"
													data-id="<?php echo $row->id_produk_bahan;?>">
													<i data-feather="trash"></i>
													</a>
													</td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>

							<div class="col-12 text-center mt-2 p-2">
								<input type="hidden" name="id" value="<?php echo $record['kode_produk'] ?>">
								<button type="submit" name="submit" class="btn btn-sm btn-primary "><i data-feather="save" class="me-50"></i><span>Save</span></button>
								<a href="<?php echo base_url('manager/menu/'); ?>" class="btn btn-sm btn-success">Batal</a>
							</div>
							</form>
						</div>
					</div>
					<!-- Basic Tables end -->
					</span>
				</div>
		</div>
	</div>
</div>
</section>
</div>
</div>
</div>


<div class="modal fade" id="addNewCard" aria-labelledby="addNewCardTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-transparent">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body px-sm-5 mx-50 pb-5">
				<h1 class="text-center mb-1" id="addNewCardTitle">Tambah Bahan</h1>
				<p class="text-center">Bahan Pada Menu : <?php echo $record['nama_produk']; ?></p>

				<!-- form -->
				<form id="addNewCardValidation" class="row gy-1 gx-2 mt-75" method="POST" action="<?= base_url('manager/menu/add_bahan_edit_menu'); ?>">
					<input type="hidden" name="kode_produk" value="<?= $record['kode_produk']; ?>">
					<div class="col-12">
						<label class="form-label" for="modalAddCardNumber">Pilih Bahan</label>
						<select class="form-control" name="bahan_id_pb" id="select2-bahan">
							<?php
							foreach ($bahan->result() as $row) :
							?>
								<option value="<?= $row->id_bahan; ?>"><?= $row->nama_bahan; ?>
									(<?= $row->kode_bahan; ?>)</option>

							<?php endforeach; ?>
						</select>
					</div>

					<div class="col-12">
						<label class="form-label" for="jumlah">Jumlah Bahan (gram)</label>
						<input type="number" id="jumlah" name="jumlah_pb" class="form-control" placeholder="0" />
					</div>
					<div class="col-12 text-center">
						<button type="submit" class="btn btn-primary me-1 mt-1">Submit</button>
						<button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
							Cancel
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

			<div class="modal fade" id="DeleteModal" aria-hidden="true" tabindex="-1" role="dialog"
						aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
							<div class="modal-content">
								<div class="modal-header bg-transparent">
									<button type="button" class="btn-close" data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
								
								<form action="<?php echo site_url('manager/menu/delete_bahan_edit_menu');?>"
										class="row gy-1 pt-75" method="post">
								<div class="modal-body">

								<div class="text-center">
									<h2>Yakin Hapus bahan pada menu ini?</h2>
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
<script>
	$(document).ready(function() {
		var a = 1;

		$('#select2-option').change(function() {

			var id = $(this).val();
			a++;
			$.ajax({
				url: "<?php echo site_url('manager/menu/get_bahan'); ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function(data) {

					var html = '';
					var i;
					for (i = 0; i < data.length; i++) {
						html += '<tr id="row' + a + '">' +
							'<td>' +
							'<input type="hidden" name="bahan_id[]" value=' + data[i].id_bahan + '></input>' +
							'<input type="text" class="form-control"  value="' + data[i].nama_bahan + '" readonly ></input>' +
							'</td>' +

							'<td>' +
							'<input class="form-control" type="number" name="jumlah[]"></input>' +
							'</td>' +

							'<td>' +
							'<button type="button" name="remove" id="' + a + '" class="btn btn-relief-danger btn_remove"><i class="fa fa-trash"></i></button>' +

							'</td>' +
							'</tr>';
					}
					$('#table_input').append(html);

				}

			});
			return false;
		}); 

		$(document).on('click', '.btn_remove', function() {
			var button_id = $(this).attr("id");
			$('#row' + button_id + '').remove();
			$('#table_input').remove(html);
		});
 
		//Edit Record
		$('.btn-edit').on('click', function () {
			var id = $(this).data('id');
			var kode_bahan = $(this).data('kode_bahan');
			var nama_bahan = $(this).data('nama');
			var jumlah = $(this).data('quantity');
			var bahan_kat_id = $(this).data('bahankatid');
			var harga_bahan = $(this).data('harga');
			$('[name="kode"]').val(id);
			$('[name="kode_bahan"]').val(kode_bahan);
			$('[name="bahan_kat_id"]').val(bahan_kat_id);
			$('[name="nama_bahan"]').val(nama_bahan);
			$('[name="jumlah_pb"]').val(jumlah);
			$('[name="harga_bahan"]').val(harga_bahan);
			$('#EditModal').modal('show');
		});

		$('.btn-delete').on('click', function () {
			var id = $(this).data('id');
			$('[name="kode"]').val(id);
			$('#DeleteModal').modal('show');
		});
	});
</script>
<script>
	$('#mySelect2').select2({
		dropdownParent: $('#addNewCard')
	});
</script>