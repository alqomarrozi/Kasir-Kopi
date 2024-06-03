<div class="app-content content ">
	<div class="content-overlay"></div>
	<div class="header-navbar-shadow"></div>
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">
                    Add Stock In
                </h3>
                <div class="float-sm-right">
                    <a href="<?= site_url('manager/stock/in') ?>" class="btn btn-sm btn-relief-dark btn-sm"><i class="fa fa-undo"></i> Kembali</a>
                </div> 
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7 offset-md-2">
                        <form action="<?= site_url('manager/stock/process'); ?>" method="post">
                            <div class="form-group">
                                <label for="date" class="col-form-label">Date <font color="#f00">*</font></label>
                                <input type="date" name="date" class="form-control flatpickr-basic flatpickr-input active" value="<?= date('Y-m-d') ?>">
                            </div>
                            <div class="form-group">
                                <label for="kode_bahan" class="col-form-label">Kode Bahan <font color="#f00">*</font></label>
                                <div class="input-group">
                                    <input type="hidden" name="bahan_id" id="bahan_id">
                                    <input type="text" name="kode_bahan" id="kode_bahan" class="form-control" aria-describedby="basic" autofocus>
                                    <div class="input-group-append">
                                        <span> 
                                            <button type="button" class="input-group-text btn btn-relief-dark btn-flat form-control" data-bs-toggle="modal" data-bs-target="#modal-item"><i class="fa fa-search" id="basic"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                     <label for="nama_bahan" class="col-form-label">Item Name <font color="#f00">*</font></label>
                                    <input type="text" name="nama_bahan" id="nama_bahan" class="form-control" autofocus readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="stok_bahan" class="col-form-label">Initial Stock (gram)</label>
                                        <input type="text" name="stok_bahan" id="stok_bahan" class="form-control" value="-" readonly autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="detail" class="col-form-label">Detail <font color="#f00">*</font></label>
                                <input type="text" name="detail" id="detail" class="form-control" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="qty" class="col-form-label">Qty <font color="#f00">*</font></label>
                                <input type="number" name="qty" id="qty" class="form-control" autofocus>
                            </div>
                            <div class="form-group col-12 text-center mt-2 p-2">
                                <button class="btn btn-sm btn-relief-primary btn-flat" type="submit" name="in_add"><i class="fa fa-paper-plane"></i> Save</button>
                                <button type="reset" class="btn btn-sm btn-default btn-flat">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-item">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Select Item</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <div class="container-fluid">
                    <table class="table table-bordered table-striped" id="example1">
                        <thead>
                            <tr>
                                <th>kode_bahan</th>
                                <th>Name</th>
                                <!-- <th>Unit</th> -->
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($item as $i) { ?> 
                                <tr>
                                    <td><?= $i->kode_bahan; ?></td>
                                    <td><?= $i->nama_bahan; ?></td>
                                    <!-- <td style="text-align: center;"><?= $i->name_unit; ?></td> -->
                                    <td style="text-align: center;"><?= $i->harga_bahan; ?></td>
                                    <td><?= $i->stok_bahan; ?></td> 
                                    <td align="center">
                                        <button class="btn btn-sm btn-sm btn-relief-dark" id="select" data-bahan_id="<?= $i->id_bahan; ?>" data-kode_bahan="<?= $i->kode_bahan; ?>" data-nama_bahan="<?= $i->nama_bahan; ?>" data-stok_bahan="<?= $i->stok_bahan; ?>">
                                            <i class="fa fa-check"></i> Select
                                        </button> 
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div> 
            
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
 
<script>
    $(document).ready(function() {
        $(document).on('click', '#select', function() {
            var bahan_id = $(this).data('bahan_id');
            var kode_bahan = $(this).data('kode_bahan');
            var nama_bahan = $(this).data('nama_bahan');
            var stok_bahan = $(this).data('stok_bahan');
            $('#bahan_id').val(bahan_id);
            $('#kode_bahan').val(kode_bahan);
            $('#nama_bahan').val(nama_bahan);
            $('#stok_bahan').val(stok_bahan);
            $('#modal-item').modal('hide');
        })
    });
</script>