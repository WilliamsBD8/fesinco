<?= $this->extend('layouts/landing'); ?>

<?= $this->section('title'); ?> - Home <?= $this->endSection(); ?>

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

    <?php if(!empty($payments)): ?>
        <!-- Services Section -->
        <section id="services" class="services section light-background">
    
          <!-- Section Title -->
          <div class="container section-title" data-aos="fade-up">
          </div><!-- End Section Title -->
    
            <div class="container">
    
                <div class="row gy-4 justify-content-center">
                    <?php foreach($payments as $payment): ?>
                        <a href="<?= $payment->link ?>">
                            <div class="col-lg-4 col-md-6 container-payment" data-aos="fade-up" data-aos-delay="100">
                                    <div class="text-container">
                                        <h2><?= $payment->title ?></h2>
                                        <?= $payment->description ?>
                                    </div>
                                    <div class="image-container">
                                        <img src="<?= base_url(['page/img/payments', $payment->logo]) ?>" alt="Descripción de la imagen">
                                    </div>
                            </div><!-- End recent post item-->
                        </a>
                    <?php endforeach ?>
    
                </div><!-- End Service Item -->
    
                </div>
    
            </div>
    
        </section><!-- /Services Section -->
    <?php endif ?>


    

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
                                    <!-- <p><?= maxTruncate($section->description, 150) ?></p> -->
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
                <h2><?= $about->title ?></h2>
                <p><?= $about->sub_title ?><br></p>
            </div><!-- End Section Title -->
            <div class="row gy-4">

                
                <div class="col-lg-12 content" data-aos="fade-up" data-aos-delay="100">
                    <img src="<?= base_url(['page/img/about', $about->img]) ?>" class="img-float" alt="">
                    <?= addLiNew($about->description) ?>
                </div>

            </div>

            <?php if(!empty($about->mision) || !empty($about->vision)): ?>
                <!-- Services Section -->
                <section id="services" class="services section">

                    <div class="container">

                        <div class="row gy-4">
                            <?php if(!empty($about->mision)): ?>
                                <div class="col-md-<?= !empty($about->vision) ? 6 : 12 ?>" data-aos="fade-up" data-aos-delay="100">
                                    <div class="service-item position-relative h-100">
                                            <h3 class="title">Misión</h3>
                                            <p class="description"><?= $about->mision ?></p>
                                    </div>
                                </div><!-- End Service Item -->
                            <?php endif ?>
                            <?php if(!empty($about->vision)): ?>
                                <div class="col-md-<?= !empty($about->mision) ? 6 : 12 ?>" data-aos="fade-up" data-aos-delay="200">
                                    <div class="service-item position-relative h-100">
                                        <h3 class="title">Visión</h3>
                                        <p class="description"><?= $about->vision ?></p>
                                    </div>
                                </div><!-- End Service Item -->
                            <?php endif ?>

                        </div>

                    </div>

                </section><!-- /Services Section -->
            <?php endif ?>

        </div>

        <!-- Pricing Section -->
        <section id="pricing" class="pricing section">

            <div class="container">

                <div class="row justify-content-around">

                    <div class="col-xl-10">
                        <div class="row gy-4">
                            <?php foreach($about->details as $key => $detail): ?>
        
                                <div class="col-xl-<?= 12 / count($about->details) ?> col-lg-6" data-aos="fade-up" data-aos-delay="200">
                                    <div class="pricing-item featured position-relative h-100">
                                        <h3><?= $detail->title ?></h3>
                                        <h4><?= $detail->sub_title ?></h4>
                                        <?= $detail->description ?>
                                    </div>
                                </div><!-- End Pricing Item -->
        
                            <?php endforeach ?>
                        </div>
                    </div>


                </div>

            </div>

        </section><!-- /Pricing Section -->


        <!-- <div class=" about-list section">
            
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
                            </div>
                
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
                            </div>
                
                            <div class="col-xl-4 d-flex ">
                                <div class="icon-box" data-aos="zoom-out" data-aos-delay="500">
                                    <h4>Gerente</h4>
                                    <p>
                                        <ul>
                                            <li>Juan Carlos Bustamante Bello</li>
                                        </ul>
                                    </p>
                                </div>
                            </div>
                
                        </div>
                    </div>
                    
                </div>
        
            </div>
            
        </div> -->

        <!-- Testimonials Section -->
        <section id="team" class="convenios section">
            <!-- Section Title -->
            <div class="container section-title-2" data-aos="fade-up">
                <h2><?= $teams->title ?></h2>
                <p><?= $teams->sub_title ?></p>
            </div><!-- End Section Title -->
            <div class="container section-title">
                <?= $teams->description ?>
            </div>
            <section class="team testimonials clients section dark-background">
                <img src="<?= base_url(['page/img/team', $teams->img]) ?>" class="testimonials-bg" alt="">

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
                                    "slidesPerView": 1,
                                    "spaceBetween": 40
                                },
                                "480": {
                                    "slidesPerView": 1,
                                    "spaceBetween": 60
                                },
                                "640": {
                                    "slidesPerView": 2,
                                    "spaceBetween": 80
                                },
                                "992": {
                                    "slidesPerView": 3,
                                    "spaceBetween": 120
                                }
                            }
                        }
                    </script>
                    <div class="swiper-wrapper align-items-center">
                        <?php foreach($teams->teams as $team): ?>
                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <img src="<?= !empty($team->img) ? base_url(['page/img/team', $team->img]) : base_url(['page/img/team/team-member-1.jpg']) ?>" class="testimonial-img" alt="">
                                    <h3><?= $team->name ?></h3>
                                    <h4><?= $team->rol ?></h4>
                                    <h4><?= $team->phone ?></h4>
                                    <h4><?= $team->email ?></h4>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
            </section>

        </section><!-- /Testimonials Section -->

    </section>

    <!-- Clients Section -->
    <section id="clients" class="clients section">
        <!-- Section Title -->
        <div class="container section-title-2" data-aos="fade-up">
            <h2><?= $agreement->title ?></h2>
            <p><?= $agreement->sub_title ?></p>
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
                                "slidesPerView": 4,
                                "spaceBetween": 120
                            }
                        }
                    }
                </script>
                <div class="swiper-wrapper align-items-center">
                    <?php foreach($agreement->details as $detail): ?>
                        <div class="swiper-slide">
                            <a href="<?= base_url(['section/detail', $detail->id]) ?>">
                                <img src="<?= !empty($detail->img) ? base_url(['page/img/agreements', $detail->img]) : base_url(["page/img/clientslogo/01.png"]) ?>" class="img-fluid" alt="">
                            </a>
                        </div>
                    <?php endforeach ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>

    </section><!-- /Clients Section -->


    <!-- Team Section -->
    <section id="testimonials" class="testimonials-2 section light-background">

        <div class="container">
            <!-- Section Title -->
        <div class="container section-title-2" data-aos="fade-up">
            <h2><?= $publication->name ?></h2>
            <p><?= $publication->title ?></p>
        </div><!-- End Section Title -->

            <div class="row gy-4 justify-content-around">

                <?php foreach ($publication->details as $key => $detail): ?>
                
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                        <a href="<?= base_url(['section', $detail->id]) ?>">
                            <div class="testimonial-item">
                                <img src="<?= base_url(['page/img/publications', $detail->img]) ?>" class="testimonial-img" alt="">
                                <div class="container section-title-2" data-aos="fade-up">
                                    <h2></h2>
                                    <p><?= $detail->title ?></p>
                                </div><!-- End Section Title -->
                            </div>

                        </a>
                    </div>
                <?php endforeach ?>

            </div>

        </div>

    </section><!-- /Team Section -->

    <?php $general = config_page() ?>

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
                    <p>* Todos los campos son requeridos.</p>
                    <?= view('layouts/formContact') ?>
                </div><!-- End Contact Form -->

            </div>

        </div>

    </section><!-- /Contact Section -->

<?= $this->endSection(); ?>
<?= $this->section('scripts'); ?>
    <script src="<?= base_url(['assets/js/functions/functions.js']) ?>"></script>
    <script src="<?= base_url(['page/js/contact.js']) ?>"></script>
<?= $this->endSection(); ?>