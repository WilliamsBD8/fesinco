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
                        <p>Bogotá</p>
                    </div>
                </div>

                <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="300">
                    <i class="icon bi bi-telephone flex-shrink-0 bg-secondary-primary"></i>
                    <div>
                        <h3>Llamanos</h3>
                        <p>+57 300 451 1625</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                    <div class="row gy-4">

                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" placeholder="Nombre*" required="">
                        </div>

                        <div class="col-md-6 ">
                            <input type="email" class="form-control" name="email" placeholder="Correo*" required="">
                        </div>

                        <div class="col-md-12">
                            <select class="form-control" name="subject">
                                <option selected disabled>Tema *</option>
                                <?php foreach(contact_topics() as $contact): ?>
                                    <option <?= $tema != null ? ($tema == $contact->id ? 'selected' :  'disabled') : ''?> value="<?= $contact->id ?>"><?= $contact->title ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <textarea class="form-control" name="message" rows="6" placeholder="Mensaje" required=""></textarea>
                        </div>

                        <div class="col-md-12 text-center">
                            <div class="loading">Cargando</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Su mensaje a sido enviado</div>

                            <button class="bg-secondary-primary" type="submit">Enviar</button>
                        </div>

                    </div>
                </form>
            </div><!-- End Contact Form -->

        </div>

    </div>

</section><!-- /Contact Section -->
<!-- /Main Content -->
<?= $this->endSection(); ?>