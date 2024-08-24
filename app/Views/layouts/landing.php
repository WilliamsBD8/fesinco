<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= isset(config_page()->name_app) && !empty(config_page()->name_app) ? config_page()->name_app : 'Name' ?><?= $this->renderSection('title') ?></title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #<?= isset(configInfo()['primary_color']) && !empty(configInfo()['primary_color']) ? configInfo()['primary_color'] : '8e24aa' ?>;
            --secondary-color: #<?= isset(configInfo()['secundary_color']) && !empty(configInfo()['secundary_color']) ? configInfo()['secundary_color'] : 'ff6e40' ?>;
            --primary-rgb: <?= isset(configInfo()['primary_color']) && !empty(configInfo()['primary_color']) ? hexToRgb(configInfo()['primary_color']) : hexToRgb('8e24aa') ?>;
            --secondary-rgb: <?= isset(configInfo()['secundary_color']) && !empty(configInfo()['secundary_color']) ? hexToRgb(configInfo()['secundary_color']) : hexToRgb('ff6e40') ?>;
        }   
    </style>

    <!-- Vendor CSS Files -->
    <link href="<?= base_url(['page/vendor/bootstrap/css/bootstrap.min.css']) ?>" rel="stylesheet">
    <link href="<?= base_url(['page/vendor/bootstrap-icons/bootstrap-icons.css']) ?>" rel="stylesheet">
    <link href="<?= base_url(['page/vendor/aos/aos.css']) ?>" rel="stylesheet">
    <link href="<?= base_url(['page/vendor/glightbox/css/glightbox.min.css']) ?>" rel="stylesheet">
    <link href="<?= base_url(['page/vendor/swiper/swiper-bundle.min.css']) ?>" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url(['assets/css/custom.min.css']) ?>">

    <!-- Main CSS File -->
    <link href="<?= base_url(['page/css/main.css']) ?>" rel="stylesheet">
</head>

<body class="index-page">

  <header id="header" class="header">

    <div class="topbar d-flex align-items-center bg-primary-secondary">
        <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
            <?php if(isset(configInfo()['email']) && !empty(configInfo()['email'])): ?>
                <i class="bi bi-envelope d-flex align-items-center">
                    <a href="<?= configInfo()['email'] ?>"><?= configInfo()['email'] ?></a>
                </i>
            <?php endif ?>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
            <?php foreach(social_networks() as $net_social): ?>
                <a target="<?= $net_social->_blank == 'Si' ? '_blank' : '' ?>" href="<?= $net_social->link ? $net_social->link : 'javascript:void(0)' ?>"><i class="<?= $net_social->icon ?>"></i></a>
            <?php endforeach ?>
        </div>
        </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-cente">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="<?= base_url() ?>" class="logo d-flex align-items-center">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <!-- <img src="assets/img/logo.png" alt=""> -->
          <h1 class="sitename text-primary"><?= isset(configInfo()['name_app']) && !empty(configInfo()['name_app']) ? configInfo()['name_app'] : 'Name' ?></h1>
          <img src="<?= base_url(['page/img/logos/logo.png']) ?>" alt="">
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="<?= base_url() ?>" class="active">Home<br></a></li>
            <li><a href="<?= base_url() ?>#about">Quienes Somos</a></li>
            <li class="dropdown"><a href="#"><span>Afiliados</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <li class="dropdown"><a href="#"><span>Como te ayudamos!</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                  <ul>
                    <li><a href="#">Quiero afiliarme</a></li>
                    <li><a href="#">Simulador de créditos</a></li>
                    <li><a href="#">Solicitud de créditos</a></li>
                    <li><a href="#">Consultar extractos</a></li>
                  </ul>
                </li>
                <li class="dropdown"><a href="#"><span>Publicaciones</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                  <ul>
                    <li><a href="#">Boletines</a></li>
                    <li><a href="#">Normatividad</a></li>
                    <li><a href="#">Convocatoria</a></li>
                    <li><a href="#">Reglamentos</a></li>
                    <li><a href="#">Informes</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="dropdown"><a href="#"><span>Portafolio</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <?php foreach(getSections([1,2]) as $section): ?>
                  <li class="dropdown"><a href="<?= base_url(['section', $section->id]) ?>"><span><?= $section->title ?></span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                      <?php foreach($section->details as $detail): ?>
                        <li><a href="<?= base_url(['section/detail', $detail->id]) ?>"><?= maxTruncate($detail->title) ?></a></li>
                      <?php endforeach ?>
                    </ul>
                  </li>
                <?php endforeach ?>
              </ul>
            </li>
            <li><a href="#team">Noticias y eventos</a></li>
            <li class="dropdown"><a href="<?= base_url(['contact']) ?>"><span>Contáctenos</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                    <?php foreach(contact_topics() as $topic): ?>
                        <li><a href="<?= base_url(['contact', $topic->id]) ?>"><?= $topic->title ?></a></li>
                    <?php endforeach ?>
                </ul>
            </li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted bg-primary-secondary" href="<?= base_url(['login']) ?>">Zona Afiliados</a>

      </div>

    </div>

  </header>

  <main class="main">

  <?= $this->renderSection('content') ?>

  </main>
  

  <footer id="footer" class="footer bg-secondary-primary">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 col-sm-12 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename"><?= isset(configInfo()['name_app']) && !empty(configInfo()['name_app']) ? configInfo()['name_app'] : 'Name' ?></span>
          </a>
          <div class="footer-contact pt-3">
            <p>Bogotá</p>
            <p class="mt-3"><strong>Teléfono:</strong> <span>+57 300 451 1625</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <?php foreach(social_networks() as $net_social): ?>
                <a target="<?= $net_social->_blank == 'Si' ? '_blank' : '' ?>" href="<?= $net_social->link ? $net_social->link : 'javascript:void(0)' ?>"><i class="<?= $net_social->icon ?>"></i></a>
            <?php endforeach ?>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 footer-links">
            <?php $category_1 = sections(1) ?>
          <h4><?= $category_1->title ?></h4>
          <ul>
            <?php foreach ($category_1->details as $key => $value): ?>
                <li><a href="#"><?= $value->title ?></a></li>
            <?php endforeach ?>
          </ul>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 footer-links">
            <?php $category_1 = sections(4) ?>
          <h4><?= $category_1->title ?></h4>
          <ul>
            <?php foreach ($category_1->details as $key => $value): ?>
                <li><a href="#"><?= $value->title ?></a></li>
            <?php endforeach ?>
          </ul>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename"><?= isset(configInfo()['name_app']) && !empty(configInfo()['name_app']) ? configInfo()['name_app'] : 'Name' ?></strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://www.iplanetcolombia.com/">IplanetColombia</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center bg-secondary-primary"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="<?= base_url(['page/vendor/bootstrap/js/bootstrap.bundle.min.js']) ?>"></script>
  <script src="<?= base_url(['page/vendor/php-email-form/validate.js']) ?>"></script>
  <script src="<?= base_url(['page/vendor/aos/aos.js']) ?>"></script>
  <script src="<?= base_url(['page/vendor/glightbox/js/glightbox.min.js']) ?>"></script>
  <script src="<?= base_url(['page/vendor/swiper/swiper-bundle.min.js']) ?>"></script>
  <script src="<?= base_url(['page/vendor/imagesloaded/imagesloaded.pkgd.min.js']) ?>"></script>
  <script src="<?= base_url(['page/vendor/isotope-layout/isotope.pkgd.min.js']) ?>"></script>

  <!-- Main JS File -->
  <script src="<?= base_url(['page/js/main.js']) ?>"></script>

  <script>
  </script>

</body>

</html>