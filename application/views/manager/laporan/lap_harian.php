<style type="text/css">
    td {
        text-align: center;
    }

    th {
        font-size: 16px;
        text-align: center;
    }

    .prev_sign a,
    .next_sign a {
        color: white;
        text-decoration: none;
    }


    .highlight {
        background-color: #25BAE4;
        color: white;
        text-align: center;
    }

    .calender .days td {
        text-align: center;
    }

    .calender .hightlight {
        font-weight: 600px;
    }

    .calender .days td:hover {
        background-color: #DEF;
    }

    .contentz {
        font-weight: bold;;
        min-height: 0px;
        /* padding: 15px; */
        /* margin-right: auto; */
        /* margin-left: auto; */
        /* padding-left: 15px; */
        /* padding-right: 15px; */
    }
</style>

<link rel="stylesheet" type="text/css" href="<?= base_url();?>themes/app-assets/vendors/css/calendars/fullcalendar.min.css">
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
                 
        <section>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class='card-header  with-border'>
                            <h3 class='card-title'>Laporan Penjualan Hari Ini</h3>
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
                                    <?php echo $calender; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>

