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
								<h2 class="card-title">Tambah data stok/keluar masuk bahan</h2>
							</div>
							<div class="card-body">
								<form action="<?= base_url('manager/penyesuaian_stock/add_action');?>" method="POST">
									<div class="row"> 
<!-- 								 
										<input type="hidden" name="no_ref"
											value="<?= $data['id_penyesuaian'];?>"> -->
										<input type="hidden" name="get_noref" value="<?= $noref;?>">
										<div class="col-xl-6 col-md-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="basicInput">Nomor Referensi</label>
												<input type="text" class="form-control" name="no_referensi" value="<?php echo $kode ?>" id="basicInput" readonly="readonly">
											</div>
										</div> 
										
										<div class="col-xl-6 col-md-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="fp-default">Tanggal Penyesuaian</label>
												<input type="text" id="fp-default" name="tanggal_penyesuaian" class="form-control flatpickr-basic"
													placeholder="YYYY-MM-DD" />
											</div>
										</div>
										<div class="col-xl-6 col-md-6 col-12">
											<div class="mb-1"> 
												<label class="form-label">Penanggung Jawab</label>

												<select class="select2 form-select" name="karyawan_id">
													<?php 
														foreach ($users->result() as $row):
													?>
													<option value="<?= $row->id;?>"><?= $row->nama;?>
														(<?= $row->level;?>)</option>
													<?php endforeach;?>
												</select>
											</div>
										</div>
										
										<div class="col-xl-6 col-md-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="disabledInput">Catatan
													Penyesuaian</label>
												<input type="text" name="catatan_penyesuaian" class="form-control" placeholder="Note">
											</div>
										</div>
									</div>
									
								<hr>
									<h5> Pilih Bahan untuk Menambahkan Data</h5>
								
									<div class="col-xl-6 col-md-6 col-12"> 
										
									<div class="mb-1">
											<label class="form-label" for="select2Demo">Pilih Bahan</label>
											<select class="form-select" name="" id="select2-option">
												<option selected>Pilih Komposisi</option>
												<?php 
												foreach ($bahan->result() as $row):
												?>
												<option class="selectbahan" data-id="<?= $row->id_bahan;?>" data-bahan="<?= $row->nama_bahan;?>" value="<?= $row->id_bahan;?>"><?= $row->nama_bahan;?>
													(<?= $row->kode_bahan;?>)</option>

												<?php endforeach;?>
											</select>
										</div>
												</div>
									<div class="row">
											<table class="table table-striped">
												<thead>
													<tr>
													<th>Bahan</th>
													<th>Quantity</th>
													<th>Status</th>
													<th>Action</th>
													</tr>
												</thead>
												<tbody id="table_input"></tbody>
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
  
<script>
	$(document).ready(function () {
		var a = 1; 

		$('#select2-option').change(function() {
			
			var id=$(this).val();
			a++;
			$.ajax({
                    url : "<?php echo site_url('manager/penyesuaian_stock/get_bahan');?>",
                    method : "POST",
                    data : {id: id}, 
                    async : true,
                    dataType : 'json',
                    success: function(data){
                         
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<tr id="row'+a+'">' +
							'<td>'+
							'<input type="hidden" name="bahan_id[]" value='+data[i].id_bahan+'></input>'+
							'<input type="text" class="form-control"  value="'+data[i].nama_bahan+'" readonly ></input>'+
							'</td>' +
							
							'<td>'+
							'<input class="form-control numeral-mask" type="number" name="qty_penyesuaian[]"></input>'+
							'</td>' +

							'<td>'+
							'<select class="form-select" name="status_penyesuaian[]" id="select2-option">'+
							'<option value="Plus">Barang Masuk/Plus</option>'+
							'<option value="Minus">Barang Keluar/Minus</option>'+
							'</select>'+
							'</td>' +

							'<td>'+
							'<button type="button" name="remove" id="'+a+'" class="btn btn-block btn-sm btn-danger btn_remove">Hapus</button>'+
							
							'</td>' +
							'</tr>';
                        } 
                        $('#table_input').append(html);
  
                    }
					
                });
                return false;
		});
   
 
				
		$(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
            $('#table_input').remove(html);
      });  
  
	});
	

</script>
