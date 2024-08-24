<?php $this->extend('layouts/landing') ?>
<?= $this->section('content'); ?>

<!-- Page Title -->
<div class="page-title light-background">
    <div class="container">
        <div class="row gy-4 align-items-center">
            <div class="col-lg-6 col-sm-12">
                <div class="section-title-2" data-aos="fade-up">
                    <h2><?= $section->section ?></h2>
                    <p><?= $section->title ?></p>
                </div><!-- End Section Title -->
            </div>
            <div class="col-lg-6 col-sm-12 d-lg-flex d-md-flex justify-content-end">
                <nav class="breadcrumbs">
                    <ol>
                    <li><a href="<?= base_url() ?>">Home</a></li>
                    <li><a href="<?= base_url(['section', $section->section_id]) ?>"><?= $section->section ?></a></li>
                    <li class="current"><?= $section->title ?></li>
                    </ol>
                </nav>
            
            </div>
        </div>
        <!-- <h1 class="mb-2 mb-lg-0"><?= $section->title ?></h1> -->
    </div>
</div><!-- End Page Title -->

<div class="container">
    <div class="row">

        <div class="col-lg-8">

            <!-- Blog Details Section -->
            <section id="blog-details" class="blog-details section">
                <div class="container">

                    <article class="article">
                        <?php if(!empty($section->img)): ?>
                            <div class="post-img">
                                <img src="<?= base_url(["page/img/sections", $section->img]) ?>" alt="" class="img-fluid">
                            </div>
                        <?php endif ?>

                        <h2 class="title"><?= $section->title ?></h2>

                        <!-- <div class="meta-top">
                        <ul>
                            <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-details.html">John Doe</a></li>
                            <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time datetime="2020-01-01">Jan 1, 2022</time></a></li>
                            <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-details.html">12 Comments</a></li>
                        </ul>
                        </div> -->
                        <!-- End meta top -->
                        
                        <div class="content">
                            <div class="features" data-aos="fade-up" data-aos-delay="100">
                            
                                <div class="row">
                                    <div class="col-lg-3">
                                        <ul class="nav nav-tabs flex-column">
                                            <?php if(!empty($section->description)): ?>
                                                <li class="nav-item">
                                                    <a class="nav-link active show" data-bs-toggle="tab" href="#features-tab-1">Descripción</a>
                                                </li>
                                            <?php endif ?>
                                            <?php if(!empty($section->specification)): ?>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#features-tab-2">Especificaciones</a>
                                                </li>
                                            <?php endif ?>
                                        </ul>
                                    </div>
                                    <div class="col-lg-9 mt-4 mt-lg-0">
                                        <div class="tab-content">
                                            
                                            <?php if(!empty($section->description)): ?>
                                                <div class="tab-pane active show" id="features-tab-1">
                                                    <div class="row">
                                                        <div class="col-lg-12 details order-2 order-lg-1">
                                                            <?= $section->description ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif ?>
                                            <?php if(!empty($section->specification)): ?>
                                                <div class="tab-pane" id="features-tab-2">
                                                    <div class="row">
                                                        <div class="col-lg-12 details order-2 order-lg-1">
                                                            <?= $section->specification ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>

                        </div><!-- End post content -->

                    </article>

                </div>
            </section><!-- /Blog Details Section -->

        </div>

        <div class="col-lg-4 sidebar">

            <div class="widgets-container">

                <!-- Categories Widget -->
                <div class="categories-widget widget-item">

                    <h3 class="widget-title">Categories</h3>
                    <ul class="mt-3">
                        <?php foreach ($sections as $key => $sec_detail): ?>
                            <li><a href="<?= base_url(['section', $sec_detail->id]) ?>"><?= $sec_detail->title ?> <span>(<?= $sec_detail->total ?>)</span></a></li>
                        <?php endforeach ?>
                    </ul>

                </div><!--/Categories Widget -->

                <!-- Recent Posts Widget -->
                <?php if(count($recents)): ?>
                    <!-- Recent Posts Widget -->
                    <div class="recent-posts-widget widget-item">

                        <h3 class="widget-title">Recent Posts</h3>
                        <?php foreach ($recents as $key => $recent): ?>
                            <div class="post-item">
                                <img src="<?= base_url(["page/img/sections", $recent->img]) ?>" alt="" class="flex-shrink-0">
                                <div class="align-content-center">
                                    <h4><a href="<?= base_url(['section/detail', $recent->id]) ?>"><?= $recent->title ?></a></h4>
                                </div>
                            </div><!-- End recent post item-->
                        <?php endforeach ?>

                    </div><!--/Recent Posts Widget -->
                <?php endif ?><!--/Recent Posts Widget -->

            </div>

        </div>

    </div>
</div>


<?= $this->endsection() ?>