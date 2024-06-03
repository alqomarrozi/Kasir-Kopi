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
					<div class="card-body border-bottom">
						<h4 class="card-title">Search & Filter</h4>
						<form id="form-filter">
							<div class="row">
								<div class="col-md-4">
									<label for="country" class=control-label">Berdasarkan Level</label>
									<?php echo $form_level; ?>
								</div>
								<div class="col-md-4">
									<label for="username" class=control-label">Username</label>
									<input type="text" class="form-control" id="username">
								</div>
								<div class="col-md-4">
									<label for="nama" class=control-label">Nama</label>
									<input type="text" class="form-control" id="nama">
								</div>
							</div>
							<br>
							<button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
							<button type="button" id="btn-reset" class="btn btn-default">Reset</button>
						</form>
					</div>
					<div class="card-datatable table-responsive pt-0">
						<table id="table" class="user-list-table table dataTable no-footer dtr-column">
							<thead class="table-light">
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Username</th>
									<th>Level</th>
									<th>Status</th>
									<th>Created_at</th>
									<th>Updated_at</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							</tbody>

						</table>
					</div>
					<!-- Modal to add new user starts-->
					<div class="modal fade" id="modalAddUser" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
							<div class="modal-content">
								<div class="modal-header bg-transparent">
									<button type="button" class="btn-close" data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
								<div class="modal-body pb-5 px-sm-5 pt-50">
									<div class="text-center mb-2">
										<h1 class="mb-1">Create New User</h1>
										<p>Form Pembuatan User Baru.</p>
									</div>
									<form id="editUserForm" class="row gy-1 pt-75" method="POST" action="<?= base_url('manager/users/create');?>">
										<div class="col-12 col-md-6">
											<label class="form-label" for="username">Username</label>
											<input type="text" id="usernames" name="username" class="form-control"
												placeholder="Username" />
										</div>
										<div class="col-12 col-md-6">
											<label class="form-label" for="nama">Nama</label>
											<input type="text" id="namass" name="nama" class="form-control"
												placeholder="Nama" />
										</div>
										<div class="col-12 col-md-6">
											<label class="form-label" for="modalEditUserStatus">Status</label>
											<select id="modalEditUserStatus" name="status"
												class="form-select" aria-label="Default select example">
												<option selected>Status</option>
												<option value="Aktif">Aktif</option>
												<option value="Tidak Aktif">Tidak Aktif</option>
												<option value="Terblokir">Suspended</option>
											</select>
										</div>
										<div class="col-12 col-md-6">
											<label class="form-label" for="level">Level</label>
											<select id="levelss" name="level" class="select2 form-select">
												<option value="Admin">Admin</option>
												<option value="Kasir">Kasir</option>
											</select>
										</div>
										
										<label class="form-label" for="basic-default-password">Password</label>
										<div class="input-group form-password-toggle mb-2">
											<input type="password" class="form-control" id="basic-default-password"
												placeholder="Your Password" name="password" aria-describedby="basic-default-password">
											<span class="input-group-text cursor-pointer"><svg
													xmlns="http://www.w3.org/2000/svg" width="14" height="14"
													viewBox="0 0 24 24" fill="none" stroke="currentColor"
													stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
													class="feather feather-eye">
													<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
													<circle cx="12" cy="12" r="3"></circle>
												</svg></span>
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
 <!--MODAL HAPUS-->
 <div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                        <h4 class="modal-title" id="myModalLabel">Hapus Barang</h4>
                    </div>
                    <form class="form-horizontal">
                    <div class="modal-body">
                                           
                            <input type="hidden" name="kode" id="textkode" value="">
                            <div class="alert alert-warning"><p>Apakah Anda yakin mau memhapus barang ini?</p></div>
                                         
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button class="btn_hapus btn btn-danger" id="btn_hapus">Hapus</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!--END MODAL HAPUS-->
					<!-- Modal to add new user Ends-->
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
		table = $('#table').DataTable({

			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo site_url('manager/users/get_data')?>",
				"type": "POST",
				"data": function (data) {
					data.id = $('#id').val();
					data.level = $('#level').val();
					data.nama = $('#nama').val();
					data.username = $('#username').val();
					data.level = $('#level').val();
					data.status = $('#status').val();
					data.created_at = $('#created_at').val();
					data.updated_at = $('#updated_at').val();
				}
			},
  
			//Set column definition initialisation properties.
			"columnDefs": [{
				"targets": [0], //first column / numbering column
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
						columns: [1, 2, 3, 4, 5]
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
			}, {
				text: "Add New User",
				className: "add-new btn btn-primary",
				attr: {
					"data-bs-toggle": "modal",
					"data-bs-target": "#modalAddUser"
				},
				init: function (e, t, a) {
					$(t).removeClass("btn-secondary")
				}
			}],
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

</script>
<script>
	
function delete_user(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('manager/users/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            { 
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
				swal.fire({
				title: "Deleted!",
				text: "Berhasil Menghapus Users",
				timer: 3000,
				showConfirmButton: false,
				type: 'success',
				icon: 'success'
					});
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}


function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function edit_user(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string


    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('manager/users/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id);
            $('[name="nama"]').val(data.nama);
            $('[name="username"]').val(data.username);
            $('[name="level"]').val(data.level);
            $('[name="status"]').val(data.status);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Users'); // Set title to Bootstrap modal title
			
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}


function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('backend/users/ajax_update')?>";
    } else {
        url = "<?php echo site_url('manager/users/ajax_update')?>";
    }

    // ajax adding data to database

    var formData = new FormData($('#form')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
				swal.fire({
				title: "Berhasil Edit!",
				text: "Berhasil Mengedit User",
				timer: 3000,
				showConfirmButton: false,
				type: 'success',
				icon: 'success'
					});
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

</script>


 
<!-- Bootstrap modal -->
<div class="modal fade bs-example-modal-lg" id="modal_form" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header"> 
            <h3 class="modal-title">Users Form</h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                    <div class="row">
                      <div class="col-12 col-md-6">
											<label class="form-label" for="username">Username</label>
											<input type="text" id="usernames" name="username" class="form-control"
												placeholder="Username" />
										</div>
										<div class="col-12 col-md-6">
											<label class="form-label" for="nama">Nama</label>
											<input type="text" id="namass" name="nama" class="form-control"
												placeholder="Nama" />
										</div>
										<div class="col-12 col-md-6">
											<label class="form-label" for="modalEditUserStatus">Status</label>
											<select id="modalEditUserStatus" name="status"
												class="form-select" aria-label="Default select example">
												<option selected>Status</option>
												<option value="Aktif">Aktif</option>
												<option value="Tidak Aktif">Tidak Aktif</option>
												<option value="Terblokir">Suspended</option>
											</select>
										</div>
										<div class="col-12 col-md-6">
											<label class="form-label" for="level">Level</label>
											<select id="levelss" name="level" class="select2 form-select">
												<option value="Admin">Admin</option>
												<option value="Kasir">Kasir</option>
											</select>
										</div>
										
										<label class="form-label" for="basic-default-password">Password</label>
										<div class="input-group form-password-toggle mb-2">
											<input type="password" class="form-control" id="basic-default-password"
												placeholder="Your Password" name="password" aria-describedby="basic-default-password">
											<span class="input-group-text cursor-pointer"><svg
													xmlns="http://www.w3.org/2000/svg" width="14" height="14"
													viewBox="0 0 24 24" fill="none" stroke="currentColor"
													stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
													class="feather feather-eye">
													<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
													<circle cx="12" cy="12" r="3"></circle>
												</svg></span>
										</div>
                    </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 