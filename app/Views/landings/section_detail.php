<?php $this->extend('layouts/landing') ?>
<?= $this->section('content'); ?>
<div class="breadcrumb-wrapper">
    <div class="pattern-overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                    <h2 class="title"><?= $section->title ?></h2>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                    <div class="breadcrumbs pull-right">
                        <ul>
                            <li></li>
                            <li><a href="<?= base_url() ?>">Home</a></li>
                            <li><a href="<?= base_url(['section', $section->section_id]) ?>"><?= $section->section ?></a></li>
                            <li><?= $section->title ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="content margin-top60 margin-bottom60">
    <div class="container">
        <div class="row">
            <!-- Left Section -->
            <div class="posts-block col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <article class="post hentry">
                    <?php if(!empty($section->img)): ?>
                        <div class="post-image">
                            <a href="<?= base_url(["page/img/services", $section->img]) ?>" data-rel="prettyPhoto">
                                <span class="img-hover"></span>
                                <span class="fullscreen"><i class="fa fa-plus"></i></span>
                                <img src="<?= base_url(["page/img/services", $section->img]) ?>" alt="">
                            </a>
                        </div>
                    <?php endif ?>
                    <div class="post-content">
                        <h2><?= $section->title ?></h2>
                        <!-- Tab -->
                        <div class="widget tabs">
                            <div id="horizontal-tabs">
                                <ul class="tabs">
                                    <li id="tab1" class="current">Descripción</li>
                                    <li id="tab2">Especificaciones</li>
                                </ul>
                                <div class="contents">
                                    <div class="tabscontent" id="content1" style="display: block;">
                                        <?= $section->description ?>
                                    </div>
                                    <div class="tabscontent" id="content2">
                                        <?= $section->specification ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Tab -->
                    </div>
                </article>
            </div>
            <!-- /Left Section -->
            <!-- Sidebar -->
            <div class="sidebar col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <!-- Category Widget -->
                <div class="widget category">
                    <h3 class="title">Otros "<?= $section->section ?>"</h3>
                    <ul class="category-list slide">
                        <?php foreach($sections as $sec): ?>
                            <li><a href="<?= base_url(['section/detail', $sec->id]) ?>"><?= $sec->title ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <!-- /Category Widget -->
            </div>
            <!-- /Sidebar -->
        </div>
    </div>
</div>
<!-- /Main Content -->

<?= $this->endsection() ?>