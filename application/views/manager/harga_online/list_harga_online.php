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
					<h2>Setting Harga Online</h2>
					<div class="card-title">
					<a class="btn btn-relief-primary btn-sm"  href="#<?= base_url('manager/harga_online/add');?>">Create</a>
					</div>
					</div>
					<div class="card-datatable">
						<table id="tablebahan" class="user-list-table table dataTable no-footer dtr-column">
							<thead class="table-light">
								<tr>
									<th>ID</th>
									<th>Nama Harga</th>
									<th>Harga</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php 
                                $no=0;
								function rupiah($angka){
									
									$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
									return $hasil_rupiah;

								}
                                foreach ($data->result() as $row):
                                $no++; 
							
                                ?>
								<tr>
									<td><?php echo $row->harga_online_id;?></td>
									<td><?php echo $row->harga_online_nama;?></td>
									<td><?php echo rupiah($row->harga_online);?></td>
									
									<td>
										<div class="dropdown">
											<button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0"
												data-bs-toggle="dropdown"><i class="fa-solid fa-list-check"></i>
											</button>
											<div class="dropdown-menu dropdown-menu-end">
												
												<a class="dropdown-item btn-edit" href="#" id="edit-btn"
													data-harga_online_id="<?php echo $row->harga_online_id;?>"
													data-harga_online_nama="<?php echo $row->harga_online_nama;?>"
													data-harga_online="<?= $row->harga_online;?>"
													><i class="fa-solid fa-pencil me-50"></i>
													<span>Edit</span>
												</a>
												
											</div>
										</div>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>

						</table>
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

									<form action="<?php echo site_url('manager/harga_online/edit');?>"
										class="row gy-1 pt-75" method="post">
										<div class="col-12 col-md-12"> 
											<label class="form-label" for="harga_online_nama">Nama</label> 
											<!-- <input type="hidden" id="bahan_kat_id" name="bahan_kat_id"/> -->
											<input type="text" id="harga_online_nama" name="harga_online_nama" readonly class="form-control"
												placeholder="Nama" />
										</div> 
										
										<div class="col-12 col-md-12">
											<label class="form-label" for="harga_online">Harga</label>
											<input type="number" id="harga_online" name="harga_online" class="form-control"
												placeholder="" />
										</div>
								</div>
								<div class="modal-footer">
									<input type="hidden" name="harga_online_id" required>

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
					<div class="modal fade" id="DeleteModal" aria-hidden="true" tabindex="-1" role="dialog"
						aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
							<div class="modal-content">
								<div class="modal-header bg-transparent">
									<button type="button" class="btn-close" data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
								
								<form action="<?php echo site_url('manager/extras/delete_extras');?>"
										class="row gy-1 pt-75" method="post">
								<div class="modal-body">

								<div class="text-center">
									<h2>Yakin Hapus Extras ini?</h2>
								</div>
								</div>
								<div class="modal-footer">
									<input type="hidden" name="kode" required>
									<input type="hidden" name="kodeextras" required>
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

		$('.btn-edit').on('click', function () {
		var harga_online_id = $(this).data('harga_online_id');
		$('[name="harga_online_id"]').val(harga_online_id);
		var harga_online_nama = $(this).data('harga_online_nama');
		$('[name="harga_online_nama"]').val(harga_online_nama);
		var harga_online = $(this).data('harga_online');
		$('[name="harga_online"]').val(harga_online);
		$('#EditModal').modal('show');
	});
     
	
		$('#btn-filter').click(function () { //button filter event click
			table.ajax.reload(); //just reload table
		});
		$('#btn-reset').click(function () { //button reset event click
			$('#form-filter')[0].reset();
			table.ajax.reload(); //just reload table
		});

	//Edit Record
	
	});

</script>

