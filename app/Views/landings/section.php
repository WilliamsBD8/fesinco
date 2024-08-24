<?php $this->extend('layouts/landing') ?>
<?php $this->section('content') ?>

<!-- Page Title -->
<div class="page-title light-background">
    <div class="container">
        <div class="row gy-4 align-items-center">
            <div class="col-lg-8 col-md-6 col-sm-12">
                <div class="section-title-2" data-aos="fade-up">
                    <h2></h2>
                    <p><?= $section->title ?><br></p>
                </div><!-- End Section Title -->
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 d-lg-flex d-md-flex justify-content-end">
                <nav class="breadcrumbs">
                    <ol>
                    <li><a href="<?= base_url() ?>">Home</a></li>
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

            <!-- Blog Posts Section -->
            <section id="blog-details" class="blog-details section">

                <div class="container">

                    <div class="row gy-4">

                        <?php foreach ($section->details as $key => $sec_detail): ?>
                            <div class="col-lg-12">
                                <article>
                                    <?php if(!empty($sec_detail->img)): ?>
                                        <div class="post-img">
                                            <img src="<?= base_url(["page/img/sections", $sec_detail->img]) ?>" alt="" class="img-fluid">
                                        </div>
                                    <?php endif ?>

                                    <h2 class="title">
                                        <a href="<?= base_url(['section/detail', $sec_detail->id]) ?>"><?= $sec_detail->title ?></a>
                                    </h2>

                                    <!-- <div class="meta-top">
                                    <ul>
                                        <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-details.html">John Doe</a></li>
                                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time datetime="2022-01-01">Jan 1, 2022</time></a></li>
                                        <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-details.html">12 Comments</a></li>
                                    </ul>
                                    </div> -->

                                    <div class="content">
                                        <p>
                                            <?= maxTruncate($sec_detail->description, 500) ?>
                                        </p>

                                        <div class="read-more">
                                            <a href="<?= base_url(['section/detail', $sec_detail->id]) ?>">Leer mas</a>
                                        </div>
                                    </div>

                                </article>
                            </div><!-- End post list item -->
                        <?php endforeach ?>

                    </div><!-- End blog posts list -->

                </div>

            </section><!-- /Blog Posts Section -->

            <!-- Blog Pagination Section -->
            <section id="blog-pagination" class="blog-pagination section">

                <?= $section->pager->links('', 'nav_propio') ?>

                <!-- <div class="container">
                    <div class="d-flex justify-content-center">
                        <ul>
                            <li><a href="#"><i class="bi bi-chevron-left"></i></a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#" class="active">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li>...</li>
                            <li><a href="#">10</a></li>
                            <li><a href="#"><i class="bi bi-chevron-right"></i></a></li>
                        </ul>
                    </div>
                </div> -->

            </section><!-- /Blog Pagination Section -->

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

                </div>
                <!--/Categories Widget -->
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
                <?php endif ?>

            </div>

        </div>

      </div>
    </div>


<?php $this->endsection() ?>