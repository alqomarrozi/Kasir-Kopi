<style type="text/css">
    table,
    th,
    tr,
    td {
        text-align: center;
    }

    .swal2-popup {
        font-family: inherit;
        font-size: 1.2rem;
    }
 
    .btn-group,
    .btn-group-vertical {
        position: relative;
        display: initial;
        vertical-align: middle; 
    }
</style>
<div class="app-content content ">
	<div class="content-overlay"></div>
	<div class="header-navbar-shadow"></div>
	<div class="content-wrapper container-xxl p-0">
		<div class="content-header row">
		</div>
		<div class="content-body">
<section class="app-user-list">
    <div class="card">
        <div class="row">

        <div class="col-md-12">
            <div class="card card-info">
                <div class='card-header with-border'>
                    <h3 class='card-title'>Data Laporan Username : <?= $this->session->userdata('username');?></h3>
                </div>
                <div class="card-body"> <?php echo form_open('cashier/laporan', array('role' => "form", 'id' => "myForm", 'data-toggle' => "validator")); ?>
                       
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-daterange">
                                <div class="form-group">
                                    <label for="start_date" class="control-label">Tanggal Awal</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control flatpickr-basic flatpickr-input" name="start_date" id="start_date" data-error="Tanggal Awal harus diisi" required />
                                        <span class="input-group-text cursor-pointer">
                                           <i data-feather="calendar"></i>
                                        </span>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-daterange">
                                <div class="form-group">
                                    <label for="end_date" class="control-label">Tanggal Akhir</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control flatpickr-basic flatpickr-input" name="end_date" id="end_date" data-error="Tanggal Akhir harus diisi" required />
                                        <span class="input-group-text">
                                           <i data-feather="calendar"></i>
                                        </span>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="metode" class="control-label">Metode</label>
                                <div class="input-group">
                                    <select class="form-control" name="metode">
                                        <option value="">Pilih Semua</option>
                                        <?php
                                        foreach ($metode as $m) {
                                            echo "<option value=' $m->id_byr'>$m->metode</option>";
                                        }
                                        ?>
                                    </select>
                                    <span class="input-group-text">
                                           <i data-feather="list"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-1">

                            <button type="submit" name="search" id="search" value="Search" class="btn btn-relief-dark btn-sm">Search</button>
                            <a href="<?= base_url('cashier/laporan');?>" class="btn btn-sm btn-relief-primary">Reset Filter</a>
                        </div>
                        
                    </div>
                        </form>
                </div>
            <div class="box-body">
                <table id="myTable" class="table table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>No Transaksi</th>
                            <th>Nama Pelanggan</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php $no = 0;
                        foreach ($laporan as $row) { ?>
                        <tr>
                            <td><?php echo ++$no; ?></td>
                            <td><?php echo $row->no_trf; ?></td>
                            <td><?php echo $row->nama_pelanggan; ?></td>
                            <td><?php echo $row->tgl_trf; ?></td>
                            <td><?php echo $row->jam_trf; ?></td>
                            <td><span class="badge rounded-pill badge-light-success">
                            <?php echo $row->metode; ?>
                            </span></td>
                            <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                            <?php
                                    echo anchor(site_url('transaksi/struk/' . $row->id), '<i data-feather="printer"></i>', array('title' => 'Print', 'class' => 'btn btn-sm btn-relief-default'));
                                    // echo anchor(site_url('laporan/hapus/' . $row->id), '<i data-feather="trash"></i>', 'title="delete" class="btn btn-sm btn-relief-default "');
                                    ?>
                            </div>
                           
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
    </div>
</section> 
        </div>
    </div>
</div>
<script type="text/javascript"> 
	var table;

	$(document).ready(function () {

		//datatables
		table = $('#myTable').DataTable({

			"processing": true, //Feature control the processing indicator.
			"serverSide": false, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.
			//Set column definition initialisation properties.
			"columnDefs": [{
				"targets": [0, 2], //first column / numbering column
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
						columns: [1, 2, 3, 4]
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
						columns: [1, 2, 3, 4]
					}
				}, {
					extend: "copy",
					text: feather.icons.copy.toSvg({
						class: "font-small-4 me-50"
					}) + "Copy",
					className: "dropdown-item",
					exportOptions: {
						columns: [1, 2, 3, 4]
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

	});

</script>
