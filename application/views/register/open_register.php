<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<!-- BEGIN: Content-->
<div class="app-content content ">
	<div class="content-overlay"></div>
	<div class="header-navbar-shadow"></div>
<div class="content-wrapper">
    <div class="row">
        <div class="col-xs-12">
            <div class="card card-primary">
                <div class="card-body"> 
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="well well-sm col-sm-12">
                                <?php $attrib = array('data-toggle' => 'validator', 'role' => 'form', 'id' => 'open-register-form');
                                echo form_open_multipart("app/open_register", $attrib); ?>
                                <div class="col-md-7">
                                   <h2>Masuk Kasir / Open Kas</h2>
                                   <div class="alert alert-primary mt-1" role="alert">
                                            <div class="alert-body"><strong>Pemberitahuan!</strong> Mohon masuk open shift/masuk kasir.</div>
                                        </div>
                                    <?= form_input('cash_in_hand', '0', 'id="cash_in_hand" class="form-control form-control-lg"'); ?>
                                  
                                </div>
                                <input type="hidden" name="kode_register" class="form-control"
													value="<?php echo $kode_register;?>" required readonly
													placeholder="Extras Code">
                                <div class="mt-2">
                                <?php echo form_submit('open_register','Masuk Kasir', 'class="btn btn-primary"'); ?>
                               
                                </div>
                                <?php echo form_close(); ?>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>