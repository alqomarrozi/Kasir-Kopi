<?php 

$b = $data->row_array();
?>
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
								<h2 class="card-title">Edit <?= $b['no_referensi'];?></h2>
							</div>
							<div class="card-body">
								<form action="<?= base_url('manager/penyesuaian_stock/edit_action');?>" method="POST">
									<div class="row">

										<input type="hidden" name="id_penyesuaian" value="<?= $b['id_penyesuaian'];?>">
										<input type="hidden" name="get_noref" value="<?= $b['no_referensi'];?>">
										<div class="col-xl-4 col-md-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="basicInput">Nomor Referensi</label>
												<input type="text" class="form-control" name="no_referensi"
													value="<?= $b['no_referensi'];?>" id="basicInput"
													readonly="readonly">
											</div>
										</div>

										<div class="col-xl-4 col-md-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="fp-default">Tanggal Penyesuaian</label>
												<input type="text" id="fp-default"
													value="<?= $b['tanggal_penyesuaian'];?>" name="tanggal_penyesuaian"
													class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" />
											</div>
										</div>
										<div class="col-xl-4 col-md-6 col-12">
											<div class="mb-1">
												<label class="form-label">Penanggung Jawab</label>

												<select class="select2 form-select" id="selectkategori"
													name="karyawan_id">

													<option value="<?= $b['karyawan_id'];?>">- Tidak diubah -</option>
													<?php 
														foreach ($users->result() as $row):
													?>
													<option value="<?= $row->id;?>"><?= $row->nama;?>
														(<?= $row->level;?>)</option>
													<?php endforeach;?>
												</select>
											</div>
										</div>

										<div class="col-xl-12 col-md-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="disabledInput">Catatan
													Penyesuaian</label>
												<textarea name="catatan_penyesuaian" class="form-control"
													placeholder="Note"><?= $b['catatan_penyesuaian'];?></textarea>
											</div>
										</div>
									</div>

									<hr>
									<h5> Pilih Bahan untuk Menambahkan Data</h5>

									<button type="button"
										class="btn btn-relief-primary waves-effect waves-float waves-light btn-sm"
										data-bs-toggle="modal" data-bs-target="#ModalAdd">
										<i data-feather='plus'></i> Tambah Data
									</button>

									<div class="row">
										<table id="tabledata" class="table dataTable no-footer dtr-column">
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
                                foreach ($databynoref->result() as $row):
                                $no++;
                                ?>
												<tr>
													<td><?php echo $row->nama_bahan;?></td>
													<td><?php echo $row->qty_penyesuaian;?></td>
													<td><?php echo $row->status_penyesuaian;?></td>
													<td>
														<div class="dropdown">
															<button type="button"
																class="btn btn-sm dropdown-toggle hide-arrow py-0"
																data-bs-toggle="dropdown">
																<i data-feather="more-vertical"></i>
															</button>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item btn-edit"
																	href="javascript:void(0);"
																	data-id_penyesuaian_stok_bahan="<?php echo $row->id_penyesuaian_stok_bahan;?>"
																	data-id_bahan="<?php echo $row->id_bahan;?>"
																	data-qty_penyesuaian="<?php echo $row->qty_penyesuaian;?>"
																	data-status_penyesuaian="<?php echo $row->status_penyesuaian;?>">
																	<i data-feather="edit-2" class="me-50"></i>
																	<span>Edit</span>
																</a>
																<a class="dropdown-item btn-delete"
																	href="javascript:void(0);"
																	data-id_penyesuaian_stok_bahan="<?php echo $row->id_penyesuaian_stok_bahan;?>">
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
							</div>

							<div class="col-12 text-center mt-2 p-2">
								<button type="submit" class="btn btn-primary me-1">Submit</button>
								<a href="<?php echo base_url('manager/penyesuaian_stock/');?>"
									class="btn btn-warning">Batal</a>
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

<form id="add-row-form" action="<?php echo base_url().'manager/penyesuaian_stock/add_on_edit'?>" method="post">
	<div class="modal fade" id="ModalAdd"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-transparent">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-xl-12 col-md-6 col-12">
							<div class="mb-1">
                                    <input type="hidden" name="no_ref" value="<?= $b['no_referensi'] ;?>">
								<div class="form-group mb-1">
									<select class="select2InModal form-select" name="bahan_id" id="select2id" required>
                                        <option value disabled readonly selected>- Pilih Bahan -</option>
										<?php 
												foreach ($bahan->result() as $row):
												?>
										<option value="<?= $row->id_bahan;?>">
											<?= $row->nama_bahan;?>
											(<?= $row->kode_bahan;?>)</option>

										<?php endforeach;?>
									</select></div>
								<div class="form-group mb-1">
									<input type="number" name="qty_penyesuaian" class="form-control" placeholder="Qty"
										required>
								</div>

								<div class="form-group mb-1">
									<select name="status_penyesuaian" class="form-control"
										required>

										<option value="Plus">Plus/Masuk</option>
										<option value="Minus">Minus/Keluar</option>

									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
						Discard
					</button>
					<button type="submit" id="add-row" class="btn btn-success">Update</button>
				</div>
			</div>
		</div>
	</div>
</form>
 
<form id="add-row-form" action="<?php echo base_url().'manager/penyesuaian_stock/edit_on_edit'?>" method="post">
	<div class="modal fade" id="ModalUpdate"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-transparent">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-xl-12 col-md-6 col-12">
							<div class="mb-1">
                                    <input type="hidden" name="id_penyesuaian_stok_bahan">
								<div class="form-group mb-1">
									<select class="select2InModal form-select" name="bahan_id" id="select2id" required>
                                        <option value disabled readonly selected>- Pilih Bahan -</option>
										<?php 
												foreach ($bahan->result() as $row):
												?>
										<option value="<?= $row->id_bahan;?>">
											<?= $row->nama_bahan;?>
											(<?= $row->kode_bahan;?>)</option>

										<?php endforeach;?>
									</select></div>
								<div class="form-group mb-1">
									<input type="number" name="qty_penyesuaian" class="form-control" placeholder="Qty"
										required>
								</div>

								<div class="form-group mb-1">
									<select name="status_penyesuaian" class="form-control"
										required>

										<option value="Plus">Plus/Masuk</option>
										<option value="Minus">Minus/Keluar</option>

									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
						Discard
					</button>
					<button type="submit" id="add-row" class="btn btn-success">Update</button>
				</div>
			</div>
		</div>
	</div>
</form>

<form id="add-row-form" action="<?php echo base_url().'manager/penyesuaian_stock/delete_on_edit'?>" method="post">
         <div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
               <div class="modal-header bg-transparent">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
                   <div class="modal-body">
                           <input type="hidden" name="id_penyesuaian_stok_bahan" class="form-control" placeholder="Kode Barang" required>
                                               <center>
                                               <h5>Anda yakin mau menghapus record ini?</h5>
                                               </center> 
                   </div>
                   <div class="modal-footer">
					<button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
						Tidak
					</button>
                        <button type="submit" id="add-row" class="btn btn-success">Ya</button>
                   </div>
                    </div>
            </div>
         </div>
     </form>
<script>
	// get Edit Records
	$('#tabledata').on('click', '.btn-edit', function () {
		var id_penyesuaian_stok_bahan = $(this).data('id_penyesuaian_stok_bahan');
		var id_bahan = $(this).data('id_bahan');
		var qty_penyesuaian = $(this).data('qty_penyesuaian');
		var status_penyesuaian = $(this).data('status_penyesuaian');
		$('#ModalUpdate').modal('show');
		$('[name="id_penyesuaian_stok_bahan"]').val(id_penyesuaian_stok_bahan);
		$('[name="id_bahan"]').val(id_bahan);
		$('[name="qty_penyesuaian"]').val(qty_penyesuaian);
		$('[name="status_penyesuaian"]').val(status_penyesuaian);
	});
	// End Edit Records
	// get Hapus Records
	$('#tabledata').on('click', '.btn-delete', function () {
		var id_penyesuaian_stok_bahan = $(this).data('id_penyesuaian_stok_bahan');
		$('#ModalHapus').modal('show');
		$('[name="id_penyesuaian_stok_bahan"]').val(id_penyesuaian_stok_bahan);
	});
	// End Hapus Records

</script>
