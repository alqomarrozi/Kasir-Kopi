<div class="modal-content">
    <div class="modal-header">

        <h3><?php echo $detail->nama_produk; ?></h3>
        <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <img class="image detail-view img-fluid" src="<?php echo  base_url('images/produk/') . $detail->gambar_produk; ?>" alt="">

                </div>

                <div class="col-md-7">

                <?php
										$getSessionCustomerType = $this->session->userdata('customer_type');
										$getCustomerType = $this->db->query("SELECT * FROM
										type_harga_online WHERE harga_online_id=$getSessionCustomerType")->row_array();
										$harga_produk = $detail->harga_produk + $getCustomerType['harga_online'];
										?>
                    <!-- <p class="in-para"></p> -->
                    <h4 class="quick">Menu Quick Overview:</h4>
                    <div class="price_single">
                        <span class="reducedfrom ">Price : Rp <?php echo number_format($harga_produk); ?></span>
                        <div class="clearfix"></div>
                    </div>
                    <p class="quick_desc"> <?php echo $detail->detail_produk; ?></p>
                    <hr>

                    <h4>Extras / Addons:</h4>
                    <?php
                    $id_produk = $detail->id_produk;
                    $extras = $this->db->query("SELECT * FROM
                    extras 
                    WHERE id_produk='$id_produk'");; ?>

                    <ul class="list-group list-group-numbered">
                        <?php foreach ($extras->result() as $b) : ?>
                            <li class="list-group-item">
                                <span><?php echo $b->nama_extras; ?> Rp.<?= $b->harga_extras; ?></span>
                            </li>
                        <?php endforeach; ?>

                    </ul>
                    <br>
                    <?php foreach ($extras->result() as $b) : ?>

                        <a href="<?php echo base_url() . 'app/tambah_produk_extras/' . $detail->id_produk . '/' . $b->id_extras  ?>" type="button" class="btn btn-relief-dark btn-sm btn-block my-cart-btn my-cart-b"><?php echo $b->nama_extras; ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.add_cart_detail').click(function() {
            var id_produk = $(this).data("produkid");
            var nama_produk = $(this).data("produknama");
            var kode_produk = $(this).data("produkkode");
            var harga_produk = $(this).data("produkharga");
            var quantity = $('#' + id_produk).val();
            $.ajax({
                url: "<?php echo base_url(); ?>app/add_to_cartExtras/<?php echo $detail->kode_produk; ?>",
                method: "POST",
                data: {
                    id_produk: id_produk,
                    kode_produk: kode_produk,
                    nama_produk: nama_produk,
                    harga_produk: harga_produk,
                    quantity: quantity
                },
                success: function(data) {
                    $('#detail_cart').html(data);
                }
            });

            $('#myModal2').modal('hide');
        });

        // Load shopping cart
        $('#detail_cart').load("<?php echo base_url(); ?>app/load_cart");

        //Hapus Item Cart
        $(document).on('click', '.hapus_cart', function() {
            var row_id = $(this).attr("id"); //mengambil row_id dari artibut id
            $.ajax({
                url: "<?php echo base_url(); ?>app/hapus_cart",
                method: "POST",
                data: {
                    row_id: row_id
                },
                success: function(data) {
                    $('#detail_cart').html(data);
                }
            });
        });
    });
</script>