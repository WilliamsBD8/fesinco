<?= $this->extend('layouts/landing'); ?>

<?= $this->section('title'); ?> Home <?= $this->endSection(); ?>

<?php
    // $imgs = [
    //     (object) ['img' => '7ea2c-banner-modificacion-reglamento-credito.jpeg'],
    //     (object) ['img' => '1fa54-Banner-Cambio-Categoria.jpg'],
    //     (object) ['img' => '7e219-Tip-1.jpg'],
    //     (object) ['img' => 'b7752-fesinco-estatutos-1-fesinco.jpg'],
    //     (object) ['img' => '0f41e-Banner-Whatsapp.jpg'],
    // ];

    // $services = [
    //     (object) ['img' => '992d1-cerdu.jpg', 'title' => "Linea de ahorro", 'description' => ''],
    //     (object) ['img' => 'bcc02-creditu.jpg', 'title' => "Linea de credito", 'description' => ''],
    //     (object) ['img' => 'b2b88-auxiliosssss.jpg', 'title' => "Auxilios y beneficios", 'description' => ''],
    // ];
?>

<?= $this->section('content'); ?>

    <!-- Slider -->
    <div class="fullwidthbanner-container tp-banner-container">
        <div class="fullwidthbanner rslider tp-banner">
            <ul>
                <?php foreach ($imgs as $key => $img): ?>
                    <!-- THE FIRST SLIDE -->
                    <li data-transition="fade">
                        <!-- MAIN IMAGE -->
                        <img src="<?= base_url(["page/img/sliders", $img->img]) ?> "  data-lazyload="<?= base_url(["page/img/sliders", $img->img]) ?>" data-bgposition="top center" data-bgpositionend="center">
                        <!-- LAYERS -->
                    </li>
                    <!-- /THE FIRST SLIDE -->
                <?php endforeach ?>
            </ul>
        </div>
    </div>
    <!-- Slider -->

    <!-- Content PSE -->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 wow fadeIn text-center">
                    <a href="https://www.psepagos.co/PSEHostingUI/ShowTicketOffice.aspx?ID=4806" target="_blank"><img src="<?= base_url(["page/img/BotonPSE.jpg"]) ?>" alt="" /></a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Content PSE -->

    <!-- Services -->
    <div id="services" class="margin-top80">
        <div class="pattern-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="padding-top40 text-center">
                            <h2 class="light wow fadeIn">Nuestras Lineas de Servicio</h2>
                            <h4 class="light wow fadeInRight"> </h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php foreach ($sections as $key => $section): ?>
                        <div class="col-lg-4 col-md-4 col-sm-4 text-center wow fadeInLeft">
                            <div class="service-box padding-top30 padding-bottom40">
                                <div class="service-box-icon">
                                    <a href="<?= base_url(['section', $section->id]) ?>"><img alt="Web Design" src="<?= base_url(["page/img/services", $section->img])?>"></a>
                                </div>
                                <div class="service-box-info">
                                    <a href="<?= base_url(['section', $section->id]) ?>">
                                        <h3 class="padding-top25"><?= $section->title ?></h3>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /Services -->

    <!-- Our Clients -->
    <div class="our-clients">
        <div class="container">
            <div class="row">
                <div class="client">
                    <div class="client-logo">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="text-center">
                                <h2 class="wow fadeIn"><?= isset($agreement->title) ? $agreement->title : 'Convenios' ?></h2>
                                <h4 class="wow fadeInRight">
                                    <?= isset($agreement->description) ? $agreement->description : '' ?>
                                </h4>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="clearfix"></div>
                            <div class="row text-center padding-top40">
                                <div id="client-carousel" class="client-carousel carousel slide">
                                    <div class="carousel-inner">
                                        <?php foreach($agreement_details as $key => $details): ?>
                                            <div class="item <?= $key == 0 ? 'active' : '' ?>">
                                                <?php foreach($details as $detail): ?>
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 item <?= $key == 0 ? 'wow fadeIn' : '' ?>">
                                                        <div class="item-inner"><a href="#"><img alt="Upportdash" src="<?= !empty($detail->img) ? base_url(['page/img/agreements', $detail->img]) : base_url(["page/img/clientslogo/01.png"]) ?>"></a></div>
                                                    </div>
                                                <?php endforeach ?>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 wow fadeInUp">
                            <div class="clients-title">
                                <h3 class="title">&nbsp;</h3>
                                <div class="carousel-controls pull-right">
                                    <a class="prev" href="#client-carousel" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                    <a class="next" href="#client-carousel" data-slide="next"><i class="fa fa-angle-right"></i></a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Our Clients -->

<?= $this->endSection(); ?>