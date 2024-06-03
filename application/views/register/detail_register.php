<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>

<div class="app-content content ">
	<div class="content-overlay"></div>
	<div class="header-navbar-shadow"></div>
	<div class="content-wrapper">
<div class="card">
	<div class="card-header">
		<div class="card-title">
			<h4>Status Register Saya</h4>
			<p> Kode Register / Kode Shift : #<?= $this->session->userdata('kode_register');?></p>
		</div>
	</div>
    <div class="card-body">
         
		<?php $kas_awal = $this->session->userdata('cash_in_hand'); ?>
		<table width="100%" class="table table-sm"> 
			<tr>
				<td >
					<h4>Kas Awal</h4>
				</td>
				<td>
					<h4><span><?= $this->session->userdata('cash_in_hand'); ?></span></h4>
				</td>
			</tr>
			
			<tr>
				<td >
					<h4>Total Pendapatan Penjualan Shift Sekarang </h4>
				</td>
				<td>
					<h4>
						<span><?= $totalsales->total; ?></span>
					</h4>
				</td>
			</tr>

			<tr>
				<td>
					<h4>Pengeluaran Hari ini</h4>
				</td>
				<td>
					<h4>
						<span><?= $expenses->total ; ?></span>
					</h4>
				</td>
			</tr>

			<tr>
				<td>
					<h4><strong>Total Cash</strong>:</h4>
				</td>
				<td>
					<h4>
						<span><strong><?= $kas_awal + $totalsales->total - $expenses->total; ?></strong></span>
					</h4>
				</td>
			</tr> 
			<tr>
				<td><h4>Tanggal Masuk Kasir</h4></td>
				<td><h4><?php echo $this->session->userdata('register_open_time');?></h4></td>
			</tr>
		</table>
    </div>
	
    <div class="card-footer">
		<form action="<?= base_url('app/close_register');?>" method="POST">
		
		<div class="col-12 col-md-12">
											<label class="form-label" for="note">Catatan </label>
											<textarea type="text" id="note" name="note" class="form-control"
												placeholder="Catatan Penutupan Shift" required></textarea>
										</div>
			<input type="hidden" name="pendapatan" value="<?= $totalsales->total; ?>">
			<input type="hidden" name="pengeluaran" value="<?= $expenses->total; ?>">
			<input type="hidden" name="total_cash" value="<?= $kas_awal + $totalsales->total - $expenses->total; ?>">

			<button type="submit" class="btn btn-primary mt-2"> Keluar Kasir </a>
		</form>
    </div>
</div>

	</div>
</div>
