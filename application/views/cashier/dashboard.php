<!-- BEGIN: Content-->
<div class="app-content content ">
	<div class="content-overlay"></div>
	<div class="header-navbar-shadow"></div>
	<div class="content-wrapper container-xxl p-0">
		<div class="content-header row">
			<div class="content-header-left col-md-9 col-12 mb-2">
				<div class="row breadcrumbs-top">
					<div class="col-12">
						<h2 class="float-start mb-0">Dashboard</h2>
					</div>
				</div>
			</div>
		</div>
		<div class="content-body">
			<div class="col-xl-12 col-md-12 col-12">
				<div class="card card-statistics">
					<div class="card-header">
						<h4 class="card-title">Stock</h4>
						<div class="d-flex align-items-center">
						</div>
					</div>
					<div class="card-body statistics-body">
						<div class="row">

							<?php foreach ($box as $info_box) : ?>
								<div class="col-xl-4 col-sm-4 col-12 mb-2 mb-sm-2">
									<div class="d-flex flex-row">
										<div class="avatar bg-light-danger me-2">
											<div class="avatar-content">
												<?php echo $info_box->svg; ?>
											</div>
										</div>
										<div class="my-auto">
											<h4 class="fw-bolder mb-0"><?= $info_box->total; ?></h4>
											<p class="card-text font-small-3 mb-0"><?= $info_box->title; ?></p>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
					
				</div>
			</div>

			<div class="row">
				
			<div class="col-xl-6 col-12">
				<div class="card">
					<div class="card-header flex-column align-items-start">
						<h4 class="card-title mb-75">Stok Bahan Tersedia</h4>
					</div>
					<div class="card-body">
						<canvas id="produkbahanChart"></canvas>
					</div>
				</div>
			</div>
			
			<div class="col-xl-6 col-12">
				<div class="card">
					<div class="card-header flex-column align-items-start">
						<h4 class="card-title mb-75">Stok Bahan dibawah Minimum</h4>
					</div>
					<div class="card-body">
						
					<div class="card-datatable">
						<table id="tablebahan" class="user-list-table table dataTable table-sm no-footer dtr-column">
							<thead class="table-light">
								<tr>
									<th>Nama Bahan</th>
									<th>Kode</th>
									<th>Kategori</th>
									<th>Minimum Stock</th>
									<th>Stok Tersedia</th>
								</tr>
							</thead> 
							<tbody>
								<?php 
                                $no=0;
								function rupiah($angka){
									
									$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
									return $hasil_rupiah;

								}
                                foreach ($bahan_habis->result() as $row):
                                $no++;
							
                                ?>
								<tr>
									<td><b><?php echo $row->nama_bahan;?></b></td>
									<td><?php echo $row->kode_bahan;?></td>
									<td><?php echo $row->nama_kategori;?></td>
									<td><?php echo $row->minimum_stock;?>g</td>

									<?php if($row->minimum_stock > $row->stok_bahan){
										echo "<td style='color:red'>".$row->stok_bahan."g</td>";
									}else{
										echo "<td>".$row->stok_bahan."g</td>";
									};
									?>
								</tr>
								<?php endforeach; ?>
							</tbody>

						</table>
					</div>
					</div>
				</div>
			</div>
			
			<div class="col-xl-12 col-12">
				<div class="card">
					<div class="card-header flex-column align-items-start">
						<h4 class="card-title mb-75">Grafik Penjualan</h4>
					</div>
					<div class="card-body">
						<canvas id="saleChart"></canvas>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>

</div>
<!-- END: Content-->
</div>
<?php 
    //Inisialisasi nilai variabel awal
    $nama_produk= "";
    $jumlah=null;
    foreach ($bahan as $item)
    {
        $pb=$item->nama_bahan;
        $nama_produk .= "'$pb'". ", ";
        $jum=$item->total;
        $jumlah .= "$jum". ", ";
    }
	
    ?>


<?php 
        foreach($laris as $data){
            $produk_name[] = $data->produk_name;
            $created_penjualan[] = $data->created_penjualan;
            $stok[] = (float) $data->stok;
        }
    ?>
<script src="<?= base_url();?>themes/app-assets/vendors/js/charts/chart.min.js"></script>
<script>
    var ctx = document.getElementById('produkbahanChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
        // The data for our dataset
        data: {
            labels: [<?php echo $nama_produk; ?>],
            datasets: [{
                label:'Stok Bahan',
                backgroundColor: ['rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)', 'rgb(60, 179, 113)','rgb(175, 238, 239)'],
                borderColor: ['rgb(255, 99, 132)'],
                data: [<?php echo $jumlah; ?>]
            }]
        },
        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });


	var ctx2 = document.getElementById('saleChart').getContext('2d');
    var chart = new Chart(ctx2, {
        // The type of chart we want to create
        type:"line",plugins:[{beforeInit:function(o){o.legend.afterFit=function(){this.height+=20}}}],
        // The data for our dataset
        data: {
			labels : <?php echo json_encode($created_penjualan);?>,
                datasets : [
                     
                    {
						label: "Penjualan",
						borderColor: ['rgb(255, 99, 132)'],
                        data : <?php echo json_encode($stok);?>
                    }
 
                ]
        },
        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
			
        }
    });
</script>


<script type="text/javascript">
	var table;

	$(document).ready(function () {

		//datatables
		table = $('#tablebahan').DataTable({

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
					extend: "csv",
					text: feather.icons["file-text"].toSvg({
						class: "font-small-4 me-50"
					}) + "Csv",
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
						columns: [1, 2, 3, 4]
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

		$('#btn-filter').click(function () { //button filter event click
			table.ajax.reload(); //just reload table
		});
		$('#btn-reset').click(function () { //button reset event click
			$('#form-filter')[0].reset();
			table.ajax.reload(); //just reload table
		});

		//Edit Record

		//Edit Record
		$('.btn-edit').on('click', function () {
			var id = $(this).data('id');
			var kode_bahan = $(this).data('kode');
			var nama_bahan = $(this).data('nama');
			var minimum_stock = $(this).data('minstock');
			var bahan_kat_id = $(this).data('bahankatid');
			var harga_bahan = $(this).data('harga');
			$('[name="kode"]').val(id);
			$('[name="kode_bahan"]').val(kode_bahan);
			$('[name="bahan_kat_id"]').val(bahan_kat_id);
			$('[name="nama_bahan"]').val(nama_bahan);
			$('[name="minimum_stock"]').val(minimum_stock);
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
