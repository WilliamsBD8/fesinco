<?= $this->extend('layouts/landing'); ?>
<?= $this->section('styles'); ?>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>

<?php
    $meets = [
        (object) ['name' => 'Constanza Socha Socha', 'rol' => 'Contadora', 'identification' => 'Ext. 80543', 'email' => 'fesinco.lsocha@sic.gov.co'],
        (object) ['name' => 'Dorayne Buitrago Valencia', 'rol' => 'Analista de Credito', 'identification' => 'Ext. 80542', 'email' => 'fesinco.dbuitrago@sic.govco'],
        (object) ['name' => 'Samantha Patricia Bernal', 'rol' => 'Asistente Contable y de Credito', 'identification' => 'Ext. 80541', 'email' => 'fesinco.sbernalb@sic.gov.co']
    ];
?>

<!-- Main Content-->
<div class="content-about margin-top60">
    <div class="container">
        <div class="row">
            <!-- Left Section -->
            <div class="posts-block col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <img src="<?= base_url(["page/img/about/0ae85-descarga.jpg"]) ?>" alt="about">
            </div>
            <!-- /Left Section -->
            <!-- welcome Section -->
            <div class="welcome col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h2><?= !isset($about->title) ? 'QUIENES SOMOS EN FESINCO' : $about->title ?></h2>
                <?= !isset($about->description) ? '' : $about->description ?>
            </div>
            <!-- /welcome Section -->
        </div>
    </div>
</div>
<!-- /Main Content-->

<!-- Star-->
<div class="star">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-6 col-md-offset-3">
                <div class="star-divider">
                    <div class="star-divider-icon">
                        <i class=" fa fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Star-->

<!-- Mision and Vision -->
<div class="content-about">
    <div class="container">
        <div class="row padding-top40">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <h2>MISIÓN</h2>
                <?= !isset($about->mision) ? '' : $about->mision ?>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <h2>VISIÓN</h2>
                <?= !isset($about->vision) ? '' : $about->vision ?>
            </div>
        </div>
    </div>
</div>
<!-- /Mision and vision -->

<!-- Personal -->
<div class="content-about">
    <div class="container">
        <div class="row padding-top40">
            <?php foreach($roles as $rol): ?>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <h2 class="text-center"><?= $rol->name ?></h2>
                    <p>
                        <ul>
                            <?php foreach ($rol->users as $key => $user): ?>
                                <li><?= $user->name ?></li>
                            <?php endforeach ?>
                        </ul>
                    </p>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
<!-- /Personal -->

<!-- Star-->
<div class="star">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-6 col-md-offset-3">
                <div class="star-divider">
                    <div class="star-divider-icon">
                        <i class=" fa fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Star--> 
<!-- Meet The Team-->
<div class="meet-team container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 meet">
            <h2 class="title-team">Equipo FESINCO</h2>
            <h4 class="text-center"></h4>
            <div class="row team margin-top40">
                <?php foreach ($teams as $user): ?>
                    <!-- item 1 -->
                    <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12 item animate_afc d1">
                        <div class="team-member">
                            <div class="team-member-holder">
                                <div class="team-member-image">
                                    <img alt="" src="<?= base_url(["page/img/team/team-member-1.jpg"]) ?>">
                                    <!-- <div class="team-member-links">
                                        <div class="team-member-links-list">
                                            <a target="_blank" class="facebook team-member-links-item" href="#"><i class="fa fa-facebook"></i></a>
                                            <a target="_blank" class="twitter team-member-links-item" href="#"><i class="fa fa-twitter"></i></a>
                                            <a target="_blank" class="linkedin team-member-links-item" href="#"><i class="fa fa-linkedin"></i></a>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="team-member-meta">
                                    <h4 class="team-member-name"><?= $user->name ?></h4>
                                    <div class="team-member-role"><?= $user->position ?></div>
                                    <div class="team-member-role"><?= $user->phone ?></div>
                                    <div class="team-member-role"><?= $user->email ?></div>
                                    <!-- <div class="team-member-description">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sagittis, sem quis lacinia faucibus, orci ipsum gravida tortor.</p>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /item 1 -->
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<!-- /Meet The Team -->

<?= $this->endSection(); ?>