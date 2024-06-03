<?php

function rupiah($nominal)
{
    $rp = number_format($nominal, 0, ',', '.');
    return $rp;
}; ?>
<style>
    @media print {
    .hidden-print,
    .hidden-print * {
        display: none !important;
    }
}
</style>
							<div class="card-body" id="print-area" style="font-family:Monaco;margin-top:5px">
								<center>
                                <strong>
                            <img src="<?= base_url('images/app/logo-black.png');?>" alt="" style="max-height:70px">
                        </center>
										<table class="table table-sm" style="font-size:9px" >
											<thead>
                                                
												<tr>
													<td colspan="4">
														Atas Nama : <?php echo $pelanggan; ?>
                                                        <br>
                                                        Waktu : <?php echo $tanggal; ?> <?php echo $jam; ?>
                                                        <br>
                                                        Kasir : <?php echo $operator; ?>
                                                        <br>
                                                        Note : <?php echo $catatan; ?>
													</td>
												</tr>
												<tr>
													<th style="width: 65%;">Items</th>
													<th style="width: 5%;">Qty</th>
													<th style="width: 15%;">Price</th>
													<th style="width: 15%;">Subtotal</th>
												</tr>
											</thead>
                                            
                                            <tr><td colspan="4">
                                            ---------------------------
                                            </td></tr>
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
                                                
                                            <tr><td colspan="4">
                                            ---------------------------
                                            </td></tr>
												<tr>
													<td colspan="2"></td>
													<td colspan="2"></td>
												</tr>
												<tr>
												</tr>
												<tr>
													<td colspan="4">
                                                    <b>Total</b> : <?php echo rupiah($total); ?><br>
                                                        <b>Diskon</b> : <?php echo rupiah($diskon); ?>% <br>
                                                        <b>Grand Total</b> :
														<?php echo rupiah($grand_total); ?><br>
                                                        <b>Cash</b> : <?php echo rupiah($bayar); ?><br>
                                                        <b>Kembali</b> : <?php echo rupiah($kembalian); ?><br>
                                                    </td>
												</tr>
												<tr>
													<td colspan="2"><b></td>
													<td colspan="2">
													</td>
												</tr>
												<tr>
													<td colspan="4" style="margin-bottom:20px">
														<center>Thanks for order
                                                            <br> Putti Roofspace</center>
                                                       <br>     
													</td>
												</tr>
												
                                            <tr><td style="color:#ffd" colspan="4">
                                            ---------------------------
                                            </td></tr>
											</tfoot>
										</table>  
							</div>

                            
        <button id="btnPrint" class="hidden-print">Print</button>
        <button class="btn hidden-print"><a  href="<?php echo base_url('transaksi/struk/'.$this->uri->segment(3)) ?>">Kembali<a></button>
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
const $btnPrint = document.querySelector("#btnPrint");
$btnPrint.addEventListener("click", () => {
    window.print();
});
</script>
