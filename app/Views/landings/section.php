<?php $this->extend('layouts/landing') ?>
<?php $this->section('content') ?>

<!-- Page Title -->
<div class="page-title light-background">
    <div class="container">
        <div class="row gy-4 align-items-center">
            <div class="col-lg-8 col-md-6 col-sm-12">
                <div class="section-title-2" data-aos="fade-up">
                    <h2><?= $section->sub_title ?></h2>
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

<!-- Blog Posts Section -->
<section id="blog-posts" class="blog-posts section">
    <div class="container">
        <div class="row gy-4">
            <?php foreach ($section->details as $key => $sec_detail): ?>
                <div class="col-lg-4">
                    <article>
                        <a href="<?= base_url(['section/detail', $sec_detail->id]) ?>">
                            <div class="post-img">
                                <img src="<?= base_url(["page/img/sections", $sec_detail->img]) ?>" alt="" class="img-fluid">
                            </div>

                            <h2 class="title">
                                <?= $sec_detail->title ?>
                            </h2>

                            <div class="d-flex align-items-center">
                                <div class="post-meta">
                                    <p class="post-author"><?= maxTruncate($sec_detail->description, 150) ?></p>
                                </div>
                            </div>
                        </a>
                        
                    </article>
                </div><!-- End post list item -->
            <?php endforeach ?>
        </div>
    </div>

</section><!-- /Blog Posts Section -->

<!-- Blog Pagination Section -->
<section id="blog-pagination" class="blog-pagination section">

<?= $section->pager->links('', 'nav_propio') ?>

</section><!-- /Blog Pagination Section -->


<?php $this->endsection() ?>