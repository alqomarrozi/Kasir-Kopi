<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>

<div class="app-content content ">
	<div class="content-overlay"></div>
	<div class="header-navbar-shadow"></div>
	<div class="content-wrapper">
<div class="card">
    <div class="card-body">
        
		<table width="100%" class="table table-sm">
			<thead class="table-light">
				<th>Name</th>
				<th>Total</th>
			</thead>
            
			<tr> 
				<td >
					<h4>Nama Kasir Sebelumnya</h4>
				</td>
				<td>
					<h4><span><?= $this->session->userdata('shift_name'); ?></span></h4>
				</td>
			</tr>
	
			<tr> 
				<td >
					<h4>Kas Awal Kasir Sebelumnya</h4>
				</td>
				<td>
					<h4><span><?= $this->session->userdata('cash_in_hand'); ?></span></h4>
				</td>
			</tr>
	
			<tr>
				<td><h4>Register Time Kasir Sebelumnya</h4></td>
				<td><h4><?php echo $this->session->userdata('register_open_time');?></h4></td>
			</tr>

            <tr>
				<td >
					<h4>Penjualan </h4>
				</td>
				<td>
					<h4>
						<span><?= $cashsales->paid; ?></span>
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
						<span><strong><?= $cashsales->paid ? $cashsales->paid + ($this->session->userdata('cash_in_hand') - ($expenses->total ? $expenses->total : 0.00)) : $this->session->userdata('cash_in_hand') - ($expenses->total ? $expenses->total : 0.00); ?></strong></span>
					</h4>
				</td>
			</tr>
			<tr>
            
		</table>
    </div>
    <div class="card-footer">
		<form action="<?= base_url('app/close_register');?>" method="POST">
			<input type="hidden" name="pendapatan" value="<?= $cashsales->paid; ?>">
			<input type="hidden" name="pengeluaran" value="<?= $expenses->total; ?>">
			<input type="hidden" name="total_cash" value="<?= $cashsales->paid ? $cashsales->paid + ($this->session->userdata('cash_in_hand') - ($expenses->total ? $expenses->total : 0.00)) : $this->session->userdata('cash_in_hand') - ($expenses->total ? $expenses->total : 0.00); ?>">

			<button type="submit" class="btn btn-primary"> Keluar Kasir </a>
		</form>
    </div>
</div>

	</div>
</div>
