<?= $this->extend('layouts/landing'); ?>

<?= $this->section('title'); ?> - Publicaciones <?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<!-- Page Title -->
<div class="page-title light-background">
    <div class="container">
        <div class="row gy-4 align-items-center">
            <div class="col-lg-6 col-sm-12">
                <div class="section-title-2" data-aos="fade-up">
                    <h2><?= $section->sub_title ?></h2>
                    <p><?= $section->title ?></p>
                </div><!-- End Section Title -->
            </div>
            <div class="col-lg-6 col-sm-12 d-lg-flex d-md-flex justify-content-end">
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="<?= base_url() ?>">Home</a></li>
                        <li class="current"><?= $section->title ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div><!-- End Page Title -->

<!-- Faq Section -->
<section id="faq" class="faq section light-background">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-8">

                <div class="faq-container">
                    <?php foreach($section->details as $key => $sec_detail): ?>
                        <div class="faq-item" data-aos="fade-up" data-aos-delay="200">
                            <i class="faq-icon bi bi bi-check2-circle"></i>
                            <h3><?= $sec_detail->title ?></h3>
                            <div class="faq-content">
                                <div class="content">
                                    <?= $sec_detail->description ?>
                                    <?php if(!empty($sec_detail->file)): ?>
                                        <div class="read-more">
                                            <a class="bg-secondary" href="<?= base_url(['upload/sections', $sec_detail->file]) ?>">Descargar</a>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->
                    <?php endforeach ?>
                </div>  

            </div>

        </div>

    </div>

</section><!-- /Faq Section -->

<?= $this->endSection(); ?>