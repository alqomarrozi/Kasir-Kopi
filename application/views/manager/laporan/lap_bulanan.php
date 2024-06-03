<style type="text/css">

    td {
        width: 50px;
        text-align: center;
    }

    th {
        text-align: center;
    }

    .prev_sign a,
    .next_sign a {
        color: white;
        text-decoration: none;
    }

    tr.week_name {
        background-color: #efe8e8;
    }

    .highlight { 
        background-color: #25BAE4;
        color: white;
        height: 27px;
    }

    .calender .days td {
        height: 50px;
    }

    .calender .hightlight {
        font-weight: 600px;
    }

    .calender .days td:hover {
        background-color: #DEF;
    }

    .content {
        min-height: 0px;
    }
</style>
<div class="app-content content "> 
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
                 
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class='card-header  with-border'>
                    <h3 class='card-title'>Laporan Penjualan Bulanan</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php foreach ($cards as $info_cards) : ?> 
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="card card-<?= $info_cards->box ?>">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h4 class="card-title mb-1"><i class="fa fa-<?= $info_cards->icon ?>"></i> <?= $info_cards->title; ?></h4>
                                                    <div class="font-small-2"><?= $info_cards->description; ?></div>
                                                    <h5><?= $info_cards->total; ?></h5>
                                                </div>
                                              </div>
                                        </div>
                                    </div>

                                    </div>
                        <?php endforeach; ?>
                        <div class="col-md-12">
                            <table class="table table-bordered table-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <?php
                                        $next = intval($tahun) + 1;
                                        $prev = intval($tahun) - 1;
                                        ?>
                                        <th>
                                            <a class="text-white" href="<?php echo base_url('manager/lapbulanan/index/' . $prev) ?>"><i data-feather='chevrons-left'></i></a>
                                        </th>
                                        <th><?php if ($tahun) {
                                                                echo $tahun;
                                                            } ?></th>
                                        <th>
                                            <a class="text-white" href="<?php echo base_url('manager/lapbulanan/index/' . $next) ?>"><i data-feather='chevrons-right'></i></a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php foreach ($bulanan as $row) :  ?>
                                            <th>
                                                <?php
                                                $bulan = $this->fungsi->bulan($row->tgl_trf);
                                                echo $bulan ?>
                                            </th>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <?php foreach ($bulanan as $row) :  ?>
                                            <td>
                                                <?php
                                                $bulan = $row->tgl_trf;
                                                $mnow = date('m');
                                                $bulanskrng = substr($bulan,6,1);
                                                if ($bulanskrng == $mnow){
                                                    echo '<span class="badge badge-light-success text-center">Rp'.number_format($row->gtotal).'</span>';
                                                }
                                                else{
                                                    echo 'Rp'.number_format($row->gtotal);
                                                }
                                                    ?>
                                                
                                            </td>
                                        <?php endforeach; ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
 
    </div>
</div>