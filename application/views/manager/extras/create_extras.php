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
								<h2 class="card-title">Create New Menu / Product</h2>
							</div>
							<div class="card-body">
								<form action="<?= base_url('manager/extras/create');?>" method="POST">
									<div class="row">


										<div class="col-xl-4 col-md-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="disabledInput">Kode Extras</label>
												<input type="text" name="kode_extras" class="form-control"
													value="<?php echo $kode_extras;?>" required readonly
													placeholder="Extras Code">
											</div>
										</div>

										<div class="col-xl-4 col-md-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="disabledInput">Nama Extras</label>
												<input type="text" name="nama_extras" class="form-control"
													placeholder="Extras Name">
											</div>
										</div>

										<div class="col-xl-4 col-md-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="disabledInput">Harga extras</label>
												<input type="number" name="harga_extras" class="form-control"
													placeholder="Harga Extras">
											</div>
										</div>

									</div>

									<hr>
									<br>

                                    <div class="row"> 
									<div class="col-xl-6 col-md-6 col-12">

									<h5> Pilih Bahan yang digunakan (Tidak Akan Mengurangi Stok Bahan)</h5>
										<div class="mb-1">
											<label class="form-label" for="select2Demo">Pilih Bahan</label>
											<select class="form-select" required id="select2-option">
												<option selected disabled value>Pilih Komposisi</option>
												<?php 
												foreach ($bahan->result() as $row):
												?>
												<option class="selectbahan" data-id="<?= $row->id_bahan;?>"
													data-bahan="<?= $row->nama_bahan;?>" value="<?= $row->id_bahan;?>">
													<?= $row->nama_bahan;?>
													(<?= $row->kode_bahan;?>)</option>

												<?php endforeach;?>
											</select>
										</div>
									</div>
                                    <div class="col-xl-6 col-md-6 col-12">
 
								<h5> Tersedia dalam Menu</h5>
									<div class="mb-1">
										<label>Pilih Menu (1 Menu Saja)</label>
										<select class="select2 form-select" id="selectkategori" name="product_id"
											data-width="100%" data-live-search="true" required>
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
											<tbody id="table_input"></tbody>
										</table>
									</div>

							<hr>
							<br>
							</div>

							<div class="col-12 text-center mt-2 p-2">
								<button type="submit" class="btn btn-primary me-1">Submit</button>
								<a href="<?php echo base_url('manager/extras/');?>" class="btn btn-warning">Batal</a>
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
