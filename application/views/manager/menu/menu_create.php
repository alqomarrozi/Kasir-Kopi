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
								<form action="<?= base_url('manager/menu/create');?>" method="POST" enctype="multipart/form-data">
									<div class="row"> 
									 
                                    <div class="col-xl-6 col-md-6 col-12">
											<div class="mb-1">
                                            <label for="formFile" class="form-label">Upload Images</label>
                                            <input class="form-control" type="file" name="filefoto" required />
                                            </div>
                                    </div>

                                    <div class="col-xl-6 col-md-6 col-12">	
                                        <div class="mb-1">
												<label class="form-label" for="disabledInput">Kode Produk</label>
												<input type="text" name="kode_produk" class="form-control" required value="<?php echo $kodeproduk;?>" required readonly placeholder="Product Code">
											</div>
                                        </div>

                                        <div class="col-xl-6 col-md-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="disabledInput">Nama Produk</label>
												<input type="text" name="nama_produk" class="form-control" required placeholder="Product Name">
											</div>
										</div>
										<div class="col-xl-6 col-md-6 col-12">
											<div class="mb-1"> 
												<label class="form-label">Produk Kategori</label>
												<select class="select2 form-select" id="selectkategori" name="kategori_id">
                                                <?php 
														foreach ($kategori->result() as $row):
													?>
													<option value="<?= $row->id_kategori;?>"><?= $row->nama_kategori;?></option>
													<?php endforeach;?>
												</select>
											</div>
										</div>
										
                                        <div class="col-xl-4 col-md-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="disabledInput">Harga Produk</label>
												<input type="number" name="harga_produk" class="form-control" placeholder="Harga Produk">
											</div>
										</div>

                                        <div class="col-xl-4 col-md-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="disabledInput">Modal Produk</label>
												<input type="number" name="modal_produk" class="form-control" placeholder="Modal Produk">
											</div>
										</div>

                                        <div class="col-xl-4 col-md-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="disabledInput">Pajak Produk</label>
												<input type="number" name="pajak_produk" class="form-control" placeholder="Pajak Produk">
											</div>
										</div>

                                        <div class="col-12">
                                            <div class="form-floating mb-1 mt-1">
                                                <textarea data-length="500" class="form-control char-textarea" name="detail_produk" id="textarea-counter" rows="3" placeholder="Counter" style="height: 100px"></textarea>
                                                <label for="textarea-counter">Detail Produk</label>
                                            </div>
                                            <small class="textarea-counter-value float-end"><span class="char-count">0</span> / 500 </small>
                                        </div>
									</div>
									
								<hr>
                                <br>
									<h5> Pilih Bahan yang digunakan</h5>
								
									<div class="col-xl-6 col-md-6 col-12"> 
										
									<div class="mb-1">
											<label class="form-label" for="select2Demo">Pilih Bahan</label>
											<select class="form-select" id="select2-option">
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
													<th>Jumlah yang diperlukan (Gram)</th>
													<th>Action</th>
													</tr>
												</thead>
												<tbody id="table_input"></tbody>
											</table>
									</div>
							</div>
							
							<div class="col-12 text-center mt-2 p-2">
											<button type="submit" class="btn btn-primary me-1">Submit</button>
											<a href="<?php echo base_url('manager/menu/');?>"
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
                    url : "<?php echo site_url('manager/menu/get_bahan');?>",
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
							'<input class="form-control" type="number" name="jumlah[]"></input>'+
							'</td>' +

							'<td>'+
							'<button type="button" name="remove" id="'+a+'" class="btn btn-relief-danger btn_remove"><i class="fa fa-trash"></i></button>'+
							
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
