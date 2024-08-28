<?php $general = config_page() ?>
<?= $this->extend('layouts/landing'); ?>
<?= $this->section('content'); ?>
<!-- Main Content -->

<!-- Contact Section -->
<section id="contact" class="contact section">
    <!-- Section Title -->
    <div class="container section-title-2" data-aos="fade-up">
        <h2></h2>
        <p>Contactanos</p>
        <span>* Todos los campos son requeridos.</span>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 align-items-center">

            <div class="col-lg-4">
                <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="300">
                    <i class="icon bi bi-geo-alt flex-shrink-0 bg-primary-secondary"></i>
                    <div>
                        <h3>Dirección</h3>
                        <?= $general->addres ?>
                    </div>
                </div>

                <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="300">
                    <i class="icon bi bi-telephone flex-shrink-0 bg-secondary-primary"></i>
                    <div>
                        <h3>Llamanos</h3>
                        <?= indiPhone($general->phone) ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <?= view('layouts/formContact') ?>
            </div><!-- End Contact Form -->

        </div>

    </div>

</section><!-- /Contact Section -->
<!-- /Main Content -->
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
    <script src="<?= base_url(['assets/js/functions/functions.js']) ?>"></script>
    <script src="<?= base_url(['page/js/contact.js']) ?>"></script>
<?= $this->endSection(); ?>