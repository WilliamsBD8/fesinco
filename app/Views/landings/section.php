<?php $this->extend('layouts/landing') ?>
<?php $this->section('content') ?>
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
                            <li><?= $section->title ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Content start-->
<div class="content margin-top60 margin-bottom60">
    <div class="container">
        <div class="row">
            <!-- Blog Posts -->
            <div class="posts-block col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <!-- Blog Post 1 -->
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
                    <header class="post-header">
                        <h2><?= $section->title ?></h2>
                        <!-- <div class="blog-entry-meta">
                            <div class="blog-entry-meta-date">
                                <i class="fa fa-clock-o"></i>
                                <span class="blog-entry-meta-date-month">August</span>
                                <span class="blog-entry-meta-date-day">12,</span>
                                <span class="blog-entry-meta-date-year">2014</span>
                            </div>
                            <div class="blog-entry-meta-author">
                                <i class="fa fa-user"></i>
                                <a href="#" class="blog-entry-meta-author">John Doe</a>
                            </div>
                            <div class="blog-entry-meta-tags">
                                <i class="fa fa-tags"></i>
                                <a href="#">Web Design</a>,
                                <a href="#">Branding</a>
                            </div>
                            <div class="blog-entry-meta-comments">
                                <i class="fa fa-comments"></i>
                                <a href="#" class="blog-entry-meta-comments">4 comments</a>
                            </div>
                        </div> -->
                    </header>
                    <div class="post-content">
                        <?= $section->description ?>
                    </div>
                </article>
                <!-- /Blog Post 1 -->
                <!-- Star-->
                <div class="star">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="star-divider">
                                <div class="star-divider-icon">
                                    <i class=" fa fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Star -->
                <!-- Blog Post 2 -->                                        
                <?php foreach ($details as $key => $detail):?>
                    <article class="post hentry">
                        <?php if(!empty($detail->img)): ?>
                            <div class="post-image">
                                <a href="<?= base_url(["page/img/services", $section->img]) ?>" data-rel="prettyPhoto">
                                <span class="img-hover"></span>
                                <span class="fullscreen"><i class="fa fa-plus"></i></span>
                                <img src="<?= base_url(["page/img/services", $section->img]) ?>" alt="">
                                </a>
                            </div>
                        <?php endif ?>
                        <header class="post-header">
                            <h2><?= $detail->title ?></h2>
                        </header>
                        <div class="post-content">
                            <?= $detail->description_short ?>
                        </div>
                        <footer class="post-footer">
                            <a href="<?= base_url(['section/detail', $section->id]) ?>" class="btn btn-color">Leer mas</a>
                        </footer>
                    </article>
                    <div class="star">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="star-divider">
                                    <div class="star-divider-icon">
                                        <i class=" fa fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Star -->
                <?php endforeach ?>
            </div>
            <!-- /Blog Posts -->
            <!-- Sidebar Start --> 
            <div class="sidebar col-lg-4 col-md-4 col-sm-4 col-xs-12">                        
                <!-- Category Widget -->
                <div class="widget category">
                    <h3 class="title">Otras Secciones</h3>
                    <ul class="category-list slide">
                        <?php foreach($sections as $section): ?>
                            <li><a href="<?= base_url(['section', $section->id]) ?>"><?= $section->title ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <!-- /Category Widget -->
            </div>
            <!-- Sidebar End -->     
        </div>
    </div>
</div>
<!-- /Main Content end-->
<?php $this->endsection() ?>