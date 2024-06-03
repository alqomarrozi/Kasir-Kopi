<?php

function rupiah($nominal)
{
    $rp = number_format($nominal, 0, ',', '.');
    return $rp;
}; ?>

<div class="app-content content ">
	<div class="content-overlay"></div>
	<div class="header-navbar-shadow"></div>
	<div class="content-wrapper container-xxl p-0">
		<div class="content-body">
			<section class="invoice-preview-wrapper">
				<div class="row invoice-preview">
					<!-- Invoice -->
					<div class="col-xl-12 col-md-12 col-12">
						<div class="card" style="max-width: 600px;margin:0px auto">
							<!-- Address and Contact starts -->
							<div class="card-body" id="print-area">
								<center><strong>
										<h5>Putti Roofspace</h5>
									</strong></center>
								<div class="row">
									<div class="col-xl-12">
										<table class="table table-sm ">
											<thead>
												<tr>
													<th colspan="2">Detail Payment</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														No #<?php echo $nota; ?>
													</td>
													<td>
														Name : <?php echo $pelanggan; ?>
													</td>
												</tr>
												<tr>
                                                     <td>
														Date : <?php echo $tanggal; ?>
													</td>
													<td> 
														Time : <?php echo $jam; ?> WIB
													</td>
												</tr>
                                                
                                                <tr>
                                                <td>Kasir : <?php echo $operator; ?></td>
                                                <td>Note : <?php echo $catatan; ?></td>
                                                </tr>
											</tbody>
										</table>
										<!-- Invoice Description starts -->

										<table class="table table-sm">
											<thead>
												<tr>
													<th style="width: 65%;">Order Items</th>
													<th style="width: 5%;">Qty</th>
													<th style="width: 15%;">Price</th>
													<th style="width: 15%;">Subtotal</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($result as $row) { ?>
												<tr>
													<td><?php echo $row->produk_name; ?></td>
													<td style="text-align:center;"><?php echo $row->jumlah_stok; ?></td>
													<td class="text-center"><?php echo rupiah($row->harga_produk); ?>
													</td>
													<td class="text-right"><?php echo rupiah($row->sub_total); ?></td>
												</tr>
												<?php } ?>
											</tbody>
											<tfoot>
												<tr>
													<td colspan="2"><b>Total</b> : <?php echo rupiah($total); ?></td>
													<td colspan="2"><b>Diskon</b> : <?php echo rupiah($diskon); ?>%</td>
												</tr>
												<tr>
												</tr>
												<tr>
													<td colspan="4"><b>Grand Total</b> :
														<?php echo rupiah($grand_total); ?></td>
												</tr>
												<tr>
													<td colspan="2"><b>Cash</b> : <?php echo rupiah($bayar); ?></td>
													<td colspan="2"><b>Kembali</b> : <?php echo rupiah($kembalian);; ?>
													</td>
												</tr>
												<tr>
													<td colspan="4">
														Thanks for order, Regards Putti Roofspace
													</td>
												</tr>
											</tfoot>
										</table> 


										<div class="card">

										</div>
									</div>
								</div>
								<!-- Address and Contact ends -->

								
							</div>
						</div>
                            <div class="card-footer">
                                        <a class="btn w-100 btn-primary"
										href="<?php echo base_url('transaksi/print/'.$this->uri->segment(3)) ?>">Cetak Nota</a>
									<a class="btn w-100 btn-outline-primary mt-1"
										href="<?php echo base_url() ?>app">Kembali Ke POS</a>
                                        <!-- <button onclick="printDiv('print-area')" class="btn btn-primary w-100 mt-1">Cetak
										</button> -->
							</div>
					</div>
					<!-- /Invoice -->
				</div>
			</section>


		</div>
	</div>
</div>

<?php if ($this->session->flashdata('message')) { ?>
<div class="col-lg-12 alerts">
	<div class="alert alert-dismissible alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4> <i class="icon fa fa-check"></i> Sukses</h4>
		<p><?php echo $this->session->flashdata('message'); ?></p>
	</div>
</div>
<?php } else {
} ?>


<script type="text/javascript">
	function printDiv(divName) {
		let printContents = document.getElementById(divName).innerHTML;
		let originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
		location.reload(true);
		setTimeout(function () {}, 1000);
	}

</script>


