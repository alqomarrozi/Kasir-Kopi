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
								<h2 class="card-title">Edit Extras</h2>
							</div>
							<div class="card-body">
								<form action="<?= base_url('manager/extras/edit');?>" method="POST">
									<div class="row">
									<input type="hidden" name="kode" class="form-control"
													value="<?php echo $record['id_extras'];?>" required readonly
													placeholder="Extras Code">
										<div class="col-xl-4 col-md-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="disabledInput">Kode Extras</label>
												<input type="text" name="kode_extras" class="form-control"
													value="<?php echo $record['kode_extras'];?>" required readonly
													placeholder="Extras Code">
													
											</div>
										</div>

										<div class="col-xl-4 col-md-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="disabledInput">Nama Extras</label>
												<input type="text" name="nama_extras" value="<?= $record['nama_extras'];?>" class="form-control"
													placeholder="Extras Name">
											</div>
										</div>

										<div class="col-xl-4 col-md-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="disabledInput">Harga Tambahan</label>
												<input type="text" value="<?= $record['harga_extras'];?>" name="harga_extras" class="form-control"
													placeholder="Harga Extras">
											</div>
										</div>

									</div>

									<hr>
									<br>

                                    <div class="row"> 
									<div class="col-xl-6 col-md-6 col-12">

									<h5> Bahan Extras </h5>
									<a href="#" class="btn btn-primary btn-sm">Tambah Bahan</a>
									</div>
                                    <div class="col-xl-6 col-md-6 col-12">
  
								<h5> Tersedia dalam Menu</h5>
									<div class="mb-1">
										<label>Pilih Menu (1 Menu Saja)</label>
										<select class="select2 form-select" id="selectkategori" name="id_produk"
											data-width="100%" data-live-search="true" required>
											
											<option value="<?php echo $record['id_produk'];?>">
												<?php echo $record['nama_produk'];?> - Tidak diubah
											</option> 
											<?php foreach ($menu->result() as $row) :?>
											<option value="<?php echo $row->id_produk;?>">
												<?php echo $row->nama_produk;?>
											</option>
											<?php endforeach;?>
										</select>
									</div>
								</div>
                                            </div>
									<div class="row">
										<table class="table table-striped">
											<thead>
												<tr>
													<th>Bahan</th>
													<th>Jumlah yang diperlukan (Gram)</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody id="tablebahan">
											<?php
											foreach ($bahankode as $row) :
											?>
												<tr>
													<td><?php echo $row->nama_bahan; ?></td>
													<td><?php echo $row->jumlah_xb; ?></td>
													<td>
													<a class="btn btn-danger btn-sm btn-delete" href="javascript:void(0);"
													data-id="<?php echo $row->id_bahan;?>">
													<i data-feather="trash"></i>
													</a>
													</td>
												</tr>
											<?php endforeach; ?>
											</tbody>
										</table>
									</div>

							<hr>
							<br>
							</div>

							<div class="col-12 text-center mt-2 p-2">
								<button type="submit" class="btn btn-primary btn-sm me-1">Submit</button>
								<a href="<?php echo base_url('manager/extras/');?>" class="btn btn-sm btn-warning">Batal</a>
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

<script>
	$(document).ready(function () {
		var a = 1;

		$('#select2-option').change(function () {

			var id = $(this).val();
			a++;
			$.ajax({
				url: "<?php echo site_url('manager/menu/get_bahan');?>",
				method: "POST",
				data: {
					id: id 
				},
				async: true,
				dataType: 'json',
				success: function (data) {

					var html = '';
					var i;
					for (i = 0; i < data.length; i++) {
						html += '<tr id="row' + a + '">' +
							'<td>' +
							'<input type="hidden" name="bahan_id[]" value=' + data[i]
							.id_bahan + '></input>' +
							'<input type="text" class="form-control"  value="' + data[i]
							.nama_bahan + '" readonly ></input>' +
							'</td>' +

							'<td>' +
							'<input class="form-control" type="number" name="jumlah_xb[]"></input>' +
							'</td>' +

							'<td>' +
							'<button type="button" name="remove" id="' + a +
							'" class="btn btn-relief-danger btn_remove"><i class="fa fa-trash"></i></button>' +

							'</td>' +
							'</tr>';
					}
					$('#table_input').append(html);

				}

			});
			return false;
		});



		$(document).on('click', '.btn_remove', function () {
			var button_id = $(this).attr("id");
			$('#row' + button_id + '').remove();
			$('#table_input').remove(html);
		});

	});

</script>
