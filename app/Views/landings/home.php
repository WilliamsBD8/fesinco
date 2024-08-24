<?= $this->extend('layouts/landing'); ?>

<?= $this->section('title'); ?> - Home <?= $this->endSection(); ?>

<?php
?>

<?= $this->section('content'); ?>

<!-- Hero Section -->
<section id="slider" class="hero section dark-background">

    <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

        <?php foreach ($imgs as $key => $slider): ?>
            <div class="carousel-item  <?= $key == 0 ? 'active' : '' ?>">
                <img src="<?= base_url(["page/img/sliders", $slider->img]) ?>" alt="">
                <div class="carousel-container">
                    <h2><?= $slider->title ?><br></h2>
                    <?= $slider->description ?>
                </div>
            </div><!-- End Carousel Item -->
        <?php endforeach ?>

        <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

        <ol class="carousel-indicators"></ol>

    </div>

</section>
<!-- /Hero Section -->

    <!-- Content PSE -->
    <!-- <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 wow fadeIn text-center">
                    <a href="https://www.psepagos.co/PSEHostingUI/ShowTicketOffice.aspx?ID=4806" target="_blank"><img src="<?= base_url(["page/img/BotonPSE.jpg"]) ?>" alt="" /></a>
                </div>
            </div>
        </div>
    </div> -->
    <!-- /Content PSE -->

    

    <!-- Alt Services Section -->
    <section id="alt-services" class="alt-services section">

        <!-- Section Title -->
        <div class="container section-title-2" data-aos="fade-up">
            <h2><?= $category_1->name ?></h2>
            <p><?= $category_1->title ?><br></p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4 justify-content-center">

                <?php foreach ($category_1->details as $key => $section): ?>

                    <div class="col-lg-4 col-md-6 col-sm-12" data-aos="zoom-in" data-aos-delay="200">
                        <a href="<?= base_url(['section', $section->id]) ?>">
                            <div class="service-item position-relative">
                                <div class="img">
                                    <img src="<?= !empty($section->img) ? base_url(["page/img/sections", $section->img]) : base_url(["assets/img/fondo-default.jpg"]) ?>" class="img-fluid" alt="">
                                </div>
                                <div class="details">
                                    <h3 class="stretched-link"><?= $section->title ?></h3>
                                    <p><?= maxTruncate($section->description, 150) ?></p>
                                </div>
                            </div>
                        </a>
                    </div><!-- End Service Item -->
                <?php endforeach ?>


            </div>

        </div>

    </section><!-- /Alt Services Section -->

    <!-- About Section -->
    <section id="about" class="about section light-background">

        <div class="container">

            <!-- Section Title -->
            <div class="container section-title-2" data-aos="fade-up">
                <h2>Quienes somos</h2>
                <p><?= $about->title ?><br></p>
            </div><!-- End Section Title -->
            <div class="row gy-4">

                
                <div class="col-lg-12 content" data-aos="fade-up" data-aos-delay="100">
                <img src="<?= base_url(['page/img/about', $about->img]) ?>" class="img-float" alt="">
                <?= addLi($about->description) ?>
                <ul>
                <li>
                    <i class="bi bi-diagram-3"></i>
                    <div>
                    <h5>Ullamco laboris nisi ut aliquip consequat</h5>
                    <p>Magni facilis facilis repellendus cum excepturi quaerat praesentium libre trade</p>
                    </div>
                </li>
                <li>
                    <i class="bi bi-fullscreen-exit"></i>
                    <div>
                    <h5>Magnam soluta odio exercitationem reprehenderi</h5>
                    <p>Quo totam dolorum at pariatur aut distinctio dolorum laudantium illo direna pasata redi</p>
                    </div>
                </li>
                <li>
                    <i class="bi bi-broadcast"></i>
                    <div>
                    <h5>Voluptatem et qui exercitationem</h5>
                    <p>Et velit et eos maiores est tempora et quos dolorem autem tempora incidunt maxime veniam</p>
                    </div>
                </li>
                <li>
                    <i class="bi bi-buildings"></i>
                    <div>
                    <h5><del></del>istinctio dolorum </h5>
                    <p>Et velit et eos maiores est tempora et quos dolorem autem tempora incidunt maxime veniam</p>
                    </div>
                </li>
                </ul>
            </div>

            </div>

        </div>

        <div class=" about-list section">
            <!-- <img src="<?= base_url(["assets/img/fondo-default.jpg"]) ?>" alt="" data-aos="fade-in"> -->
            
            <div class="container position-relative">
                
                <div class="content row gy-4">
                    <div class="col-lg-12">
                        <div class="row gy-4">
                
                            <div class="col-xl-4 d-flex ">
                                <div class="icon-box" data-aos="zoom-out" data-aos-delay="300">
                                    <h4 class="text-center">Junta directiva</h4>
                                    <ul>
                                        <li>Aura María Prieto Echeverry</li>
                
                                        <li>Wilson Armando Rigueros Beltrán</li>
                
                                        <li>Pablo Enrique Peña González</li>
                
                                        <li>Gladys Adriana Espitia Rojas</li>
                
                                        <li>Fabian Emiliani Velandia Chitiva</li>
                
                                        <li>Jenny Rodríguez González</li>
                
                                        <li>Amanda Estella Pedraza Rodríguez</li>
                
                                        <li>Alejandro Prieto Agudelo</li>
                
                                        <li>Liliana Matiz Bernal</li>
                
                                        <li>Javier Oswaldo Rodriguez Pérez</li>
                                    </ul>
                                </div>
                            </div><!-- End Icon Box -->
                
                            <div class="col-xl-4 d-flex ">
                                <div class="icon-box" data-aos="zoom-out" data-aos-delay="400">
                                    <h4 class="text-center">Junta directiva</h4>
                                    <ul>
                                        <li>Aura María Prieto Echeverry</li>
                
                                        <li>Wilson Armando Rigueros Beltrán</li>
                
                                        <li>Pablo Enrique Peña González</li>
                
                                        <li>Gladys Adriana Espitia Rojas</li>
                
                                        <li>Fabian Emiliani Velandia Chitiva</li>
                
                                        <li>Jenny Rodríguez González</li>
                
                                        <li>Amanda Estella Pedraza Rodríguez</li>
                
                                        <li>Alejandro Prieto Agudelo</li>
                
                                        <li>Liliana Matiz Bernal</li>
                
                                        <li>Javier Oswaldo Rodriguez Pérez</li>
                                    </ul>
                                </div>
                            </div><!-- End Icon Box -->
                
                            <div class="col-xl-4 d-flex ">
                                <div class="icon-box" data-aos="zoom-out" data-aos-delay="500">
                                    <h4>Gerente</h4>
                                    <p>
                                        <ul>
                                            <li>Juan Carlos Bustamante Bello</li>
                                        </ul>
                                    </p>
                                </div>
                            </div><!-- End Icon Box -->
                
                        </div>
                    </div>
                    
                </div><!-- End  Content-->
        
            </div>
            
        </div>
            <!-- Team Section -->
        <section id="team" class="team section light-background">

            <!-- Section Title -->
            <div class="container section-title-2" data-aos="fade-up">
            <h2></h2>
            <p>Equipo Fesinco</p>
            </div><!-- End Section Title -->

            <div class="container">

            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
                <div class="team-member">
                    <div class="member-img">
                    <img src="<?= base_url(['page/img/team/team-1.jpg']) ?>" class="img-fluid" alt="">
                    <div class="social">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                    </div>
                    <div class="member-info">
                    <h4>Juan Carlo Bustamante</h4>
                    <span>
                        Gerente<br>
                        601 4327786<br>
                        fesinco.sbernalb@sic.gov.co
                        </span>
                    </div>
                </div>
                </div><!-- End Team Member -->

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                <div class="team-member">
                    <div class="member-img">
                    <img src="<?= base_url(['page/img/team/b2871-Cony.png']) ?>" class="img-fluid" alt="">
                    <div class="social">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                    </div>
                    <div class="member-info">
                    <h4>Constanza Socha Socha</h4>
                    <span>
                        Contadora<br>
                        601 4327786<br>
                        fesinco.lsocha@sic.gov.co
                    </span>
                    </div>
                </div>
                </div><!-- End Team Member -->

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                <div class="team-member">
                    <div class="member-img">
                    <img src="<?= base_url(['page/img/team/bb77a-Dorayne.png']) ?>" class="img-fluid" alt="">
                    <div class="social">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                    </div>
                    <div class="member-info">
                    <h4>Dorayne Buitrago Valencia</h4>
                    <span>
                        Analista de Credito<br>
                        601 4327786<br>
                        fesinco.dbuitrago@sic.govco
                    </span>
                    </div>
                </div>
                </div><!-- End Team Member -->

                

                

            </div>

            </div>

        </section><!-- /Team Section -->
    </section><!-- /About Section -->

    <!-- <section id="about" class="about section">

    </section> -->

    <!-- Clients Section -->
    <section id="clients" class="clients section">
        <!-- Section Title -->
        <div class="container section-title-2" data-aos="fade-up">
            <h2>Convenios</h2>
            <p><?= $agreement->title ?></p>
        </div><!-- End Section Title -->
        <div class="container section-title">
            <?= $agreement->description ?>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="swiper init-swiper">
                <script type="application/json" class="swiper-config">
                    {
                        "loop": true,
                        "speed": 600,
                        "autoplay": {
                            "delay": 5000
                        },
                        "slidesPerView": "auto",
                        "pagination": {
                            "el": ".swiper-pagination",
                            "type": "bullets",
                            "clickable": true
                        },
                        "breakpoints": {
                            "320": {
                                "slidesPerView": 2,
                                "spaceBetween": 40
                            },
                            "480": {
                                "slidesPerView": 3,
                                "spaceBetween": 60
                            },
                            "640": {
                                "slidesPerView": 4,
                                "spaceBetween": 80
                            },
                            "992": {
                                "slidesPerView": 6,
                                "spaceBetween": 120
                            }
                        }
                    }
                </script>
                <div class="swiper-wrapper align-items-center">
                    <?php foreach($agreement->details as $detail): ?>
                        <a href="<?= base_url(['section/detail', $detail->id]) ?>"><div class="swiper-slide"><img src="<?= !empty($detail->img) ? base_url(['page/img/agreements', $detail->img]) : base_url(["page/img/clientslogo/01.png"]) ?>" class="img-fluid" alt=""></div></a>
                    <?php endforeach ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>

    </section><!-- /Clients Section -->

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

        <!-- Section Title -->
        <div class="container section-title-2" data-aos="fade-up">
            <h2><?= $publication->name ?></h2>
            <p><?= $publication->title ?></p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                <div class="row gy-4 isotope-container justify-content-center" data-aos="fade-up" data-aos-delay="200">

                    <?php foreach ($publication->details as $key => $detail): ?>
                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                            <a href="">
                                <div class="d-flex justify-content-center">
                                    <img src="<?= base_url(['page/img/publications', $detail->img]) ?>" class="img-fluid" alt="">
                                </div>
                            <div class="portfolio-info text-center">
                                <h4><?= $detail->title ?></h4>
                                <!-- <?= $detail->description ?> -->
                                <!-- <a href="<?= base_url(['page/img/publications', $detail->img]) ?>" title="App 1" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a> -->
                            </div>
                            </a>
                        </div><!-- End Portfolio Item -->
                    <?php endforeach ?>

                </div><!-- End Portfolio Container -->

            </div>

        </div>

    </section><!-- /Portfolio Section -->



    <!-- Contact Section -->
    <section id="contact" class="contact section">
        <!-- Section Title -->
        <div class="container section-title-2" data-aos="fade-up">
            <h2></h2>
            <p>Contactanos</p>
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
                    <p>* Todos los campos son requeridos.</p>
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
                                        <option value="<?= $contact->id ?>"><?= $contact->title ?></option>
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

<?= $this->endSection(); ?>