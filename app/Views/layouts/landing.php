<!DOCTYPE html>
<!--[if IE 8]>          <html class="ie ie8"> <![endif]-->
<!--[if IE 9]>          <html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->  
<html> 
	<!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title> <?= !empty(config_page()->name) ? config_page()->name : 'Fesinco' ?> |  <?= $this->renderSection('title'); ?></title>
        <meta name="description" content="Gallaxy Responsive HTML5/CSS3 Template from FIFOTHEMES.COM">
        <meta name="author" content="FIFOTHEMES.COM">
        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Google Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:100,200,300,700,800,900' rel='stylesheet' type='text/css'>
        <!-- Library CSS -->
        <link rel="stylesheet" href="<?= base_url(["page/css/bootstrap.css"]) ?>">
        <link rel="stylesheet" href="<?= base_url(["page/css/bootstrap-theme.css"]) ?>">
        <link rel="stylesheet" href="<?= base_url(["page/css/fonts/font-awesome/css/font-awesome.css"]) ?>">
        <link rel="stylesheet" href="<?= base_url(["page/css/animations.cs"]) ?>s" media="screen">
        <link rel="stylesheet" href="<?= base_url(["page/css/superfish.css"]) ?>" media="screen">
        <link rel="stylesheet" href="<?= base_url(["page/css/revolution-slider/css/settings.css"]) ?>" media="screen">
        <link rel="stylesheet" href="<?= base_url(["page/css/revolution-slider/css/extralayers.css"]) ?>" media="screen">
        <link rel="stylesheet" href="<?= base_url(["page/css/prettyPhoto.css"]) ?>" media="screen">
        <!-- Theme CSS -->
        <link rel="stylesheet" href="<?= base_url(["page/css/style.css"]) ?>">
        <!-- Skin -->
        <link rel="stylesheet" href="<?= base_url(["page/css/colors/green.css"]) ?>" class="colors">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="<?= base_url(["page/css/theme-responsive.css"]) ?>">
        <!-- Favicons -->
        <link rel="shortcut icon" href="img/ico/favicon.ico">
        <link rel="apple-touch-icon" href="img/ico/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="img/ico/apple-touch-icon-72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="img/ico/apple-touch-icon-114.png">
        <link rel="apple-touch-icon" sizes="144x144" href="img/ico/apple-touch-icon-144.png">

        <?= $this->renderSection('styles'); ?>

        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
        
        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
        <!--[if IE]>
        <link rel="stylesheet" href="css/ie.css">
        <![endif]-->
    </head>
    <body class="home">

        <div class="page-mask">
            <div class="page-loader">
                <div class="spinner"></div>
                Loading...
            </div>
        </div>
        <!-- Wrap -->
        <div class="wrap">
            <!-- Header -->
            <header id="header">
                <!-- Header Top Bar -->
                <div class="top-bar">
                    <div class="slidedown collapse">
                        <div class="container">
                            <div class="pull-left">
                                <ul class="social pull-left">
                                    <?php foreach (social_networks() as $key => $network): ?>
                                        <li class="<?= strtolower($network->name) ?>"><a href="<?= $network->link ? $network->link : "#" ?>" target="<?= $network->_blank == 'Si' ? '_blank' : '' ?>"><i class="<?= $network->icon ?>"></i></a></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                            <div class="phone-login pull-right">
                                <a><i class="fa fa-phone"></i> Call Us : +880 111-111-111</a>
                                <a href="<?= base_url(["login"]) ?>"><i class="fa fa-sign-in"></i> Iniciar sesion</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Header Top Bar -->
                <!-- Main Header -->
                <div class="main-header">
                    <div class="container">
                        <!-- TopNav -->
                        <div class="topnav navbar-header">
                            <a class="navbar-toggle down-button" data-toggle="collapse" data-target=".slidedown">
                            <i class="fa fa-angle-down icon-current"></i>
                            </a> 
                        </div>
                        <!-- /TopNav-->
                        <!-- Logo -->
                        <div class="logo pull-left">
                            <h1>
                                <a href="<?= base_url() ?>">
                                <img class="logo-color" src="<?= !empty(config_page()->logo) ?  base_url(["page/img/general", config_page()->logo]) : base_url(["page/img/logo.png"]) ?>" alt="Fesinco" width="160" height="60">
                                </a>
                            </h1>
                        </div>
                        <!-- /Logo -->
                        <!-- Mobile Menu -->
                        <div class="mobile navbar-header">
                            <a class="navbar-toggle" data-toggle="collapse" href=".navbar-collapse">
                            <i class="fa fa-bars fa-2x"></i>
                            </a> 
                        </div>
                        <!-- /Mobile Menu -->
                        <!-- Menu Start -->
                        <nav class="collapse navbar-collapse menu">
                            <ul class="nav navbar-nav sf-menu">
                                <li>
                                    <a href="<?= base_url() ?>">
                                      Home
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url("about_us") ?>">
                                      Quienes somos
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="sf-with-ul">
                                    Afiliados 
                                    <span class="sf-sub-indicator">
                                    <i class="fa fa-angle-down "></i>
                                    </span>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="#" class="sf-with-ul"> 
                                            Como te ayudamos
                                            <span class="sf-sub-indicator pull-right">
                                            <i class="fa fa-angle-right "></i>
                                            </span>
                                            </a>
                                            <ul>
                                                <li><a href="shop.html" class="sf-with-ul">Quiero afiliarme</a></li>
                                                <li><a href="shop-left-sidebar.html" class="sf-with-ul">Simulador de creditos</a></li>
                                                <li><a href="shop-right-sidebar.html" class="sf-with-ul">Solicitud de creditos</a></li>
                                                <li><a href="shop-right-sidebar.html" class="sf-with-ul">Consultar extractos</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#" class="sf-with-ul"> 
                                            Publicaciones
                                            <span class="sf-sub-indicator pull-right">
                                            <i class="fa fa-angle-right "></i>
                                            </span>
                                            </a>
                                            <ul>
                                                <li><a href="my-account.html" class="sf-with-ul">Boletines</a></li>
                                                <li><a href="my-account-information.html" class="sf-with-ul">Normatividad</a></li>
                                                <li><a href="my-address.html" class="sf-with-ul">Convocatoria</a></li>
                                                <li><a href="my-orders.html" class="sf-with-ul">Reglamentos</a></li>
                                                <li><a href="my-orders.html" class="sf-with-ul">Informes</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" class="sf-with-ul">
                                        Portafolio 
                                    <span class="sf-sub-indicator">
                                    <i class="fa fa-angle-down "></i>
                                    </span>
                                    </a>
                                    <ul>
                                        <?php foreach (sections() as $key => $section): ?>
                                            <li>
                                                <a href="<?= base_url(['section', $section->id]) ?>" class="sf-with-ul"> 
                                                    <?= $section->title ?>
                                                    <span class="sf-sub-indicator pull-right">
                                                    <i class="fa fa-angle-right "></i>
                                                    </span>
                                                </a>
                                                <ul>
                                                    <?php foreach($section->details as $detail): ?>
                                                        <li><a href="<?= base_url(['section/detail', $section->id]) ?>" class="sf-with-ul"><?= $detail->title ?></a></li>
                                                    <?php endforeach ?>
                                                </ul>
                                            </li>
                                        <?php endforeach ?>
                                        <!-- <li>
                                            <a href="#" class="sf-with-ul"> 
                                            Publicaciones
                                            <span class="sf-sub-indicator pull-right">
                                            <i class="fa fa-angle-right "></i>
                                            </span>
                                            </a>
                                            <ul>
                                                <li><a href="my-account.html" class="sf-with-ul">Boletines</a></li>
                                                <li><a href="my-account-information.html" class="sf-with-ul">Normatividad</a></li>
                                                <li><a href="my-address.html" class="sf-with-ul">Convocatoria</a></li>
                                                <li><a href="my-orders.html" class="sf-with-ul">Reglamentos</a></li>
                                                <li><a href="my-orders.html" class="sf-with-ul">Informes</a></li>
                                            </ul>
                                        </li> -->
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" class="sf-with-ul">
                                    Noticias Y Eventos
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url(["contact"]) ?>" class="sf-with-ul">
                                    Contactenos
                                    <span class="sf-sub-indicator">
                                    <i class="fa fa-angle-down "></i>
                                    </span>
                                    </a>
                                    <ul>
                                        <?php foreach(contact_topics() as $contact): ?>
                                        <li><a href="<?= base_url(["contact", $contact->id]) ?>" class="sf-with-ul"><?= $contact->title ?></a></li>
                                        <?php endforeach ?>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <!-- /Menu --> 
                    </div>
                </div>
                <!-- /Main Header -->
            </header>
            <!-- /Header --> 
            <!-- Main Section -->
            <section id="main">

                <?= $this->renderSection('content'); ?>
 
            </section>
            <!-- /Main Section -->
            <!-- Footer -->
            <footer id="footer">
                <div class="pattern-overlay">
                    <!-- Footer Top -->
                    <div class="footer-top">
                        <div class="container">
                            <div class="row">
                                <section class="col-lg-6 col-md-6 col-xs-12 col-sm-3 footer-one wow fadeIn">
                                    <h3 class="light">Sobre nosotros</h3>
                                    <p> El Fondo de Empleados de la Superintendencia de Industria y Comercio es una empresa asociativa, de derecho privado, sin ánimo de lucro y constituida por trabajadores dependientes, es decir, por trabajadores vinculados con la Superintendencia de Industria y Comercio, del Instituto Nacional de Metrología y los pensionados de las dos entidades.</p>
                                </section>
                                <section class="col-lg-6 col-md-6 col-xs-12 col-sm-3 footer-three wow fadeIn">
                                    <h3 class="light">Contactenos</h3>
                                    <ul class="contact-us">
                                        <li>
                                            <i class="fa fa-map-marker"></i>
                                            <p> 
                                                <strong class="contact-pad">Address:</strong> 221 Baker Street<br> London <br>
                                                United Kingdom
                                            </p>
                                        </li>
                                        <li>
                                            <i class="fa fa-phone"></i>
                                            <p><strong>Phone:</strong> +880 111-111-111</p>
                                        </li>
                                        <li>
                                            <i class="fa fa-envelope"></i>
                                            <p><strong>Email:</strong><a href="mailto:email@demo.com">email@demo.com</a></p>
                                        </li>
                                    </ul>
                                </section>
                            </div>
                        </div>
                    </div>
                    <!-- /Footer Top --> 
                    <!-- Footer Bottom -->
                    <div class="footer-bottom">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 ">
                                    <p class="credits">&copy; Copyright 2024 by <a href="#">Iplanet Colombia</a>. All Rights Reserved. </p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 ">
                                    <ul class="social social-icons-footer-bottom">
                                        <?php foreach (social_networks() as $key => $network): ?>
                                            <li class="<?= strtolower($network->name) ?>"><a href="<?= $network->link ? $network->link : "#" ?>" target="<?= $network->_blank == 'Si' ? '_blank' : '' ?>"><i class="<?= $network->icon ?>"></i></a></li>
                                        <?php endforeach ?>
                                        <!-- <li class="facebook"><a href="#" data-toggle="tooltip" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li class="twitter"><a href="#" data-toggle="tooltip" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                        <li class="dribbble"><a href="#" data-toggle="tooltip" title="Dribble"><i class="fa fa-dribbble"></i></a></li>
                                        <li class="linkedin"><a href="#" data-toggle="tooltip" title="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
                                        <li class="rss"><a href="#" data-toggle="tooltip" title="Rss"><i class="fa fa-rss"></i></a></li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Footer Bottom --> 
                    <!-- /Footer Bottom --> 
                </div>
            </footer>
            <!-- Modal -->
            <section id="modals">
                <!-- Login Modal -->
                <div class="modal login fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="form-signin-heading modal-title" id="myModalLabel">Login</h2>
                            </div>
                            <form method="post" id="login">
                                <div class="modal-body">
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input class="form-control" id="username" name="username" type="text" placeholder="Username" value="" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input class="form-control" type="email" id="email" name="email" placeholder="Email" value="" required>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="modal-footer">
                                    <a href="password-recovery.html" class="pull-left">(Lost Password?)</a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-color">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Logan Modal -->
                <!-- Registration Modal -->
                <div class="modal register fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="registrationModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h2 class="form-signin-heading modal-title" id="registrationModalLabel">Create a new account</h2>
                        </div>
                        <form method="post" id="registration">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <input type="text" value="" class="form-control" placeholder="First Name">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" value="" class="form-control" placeholder="Last Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="text" value="" class="form-control" placeholder="E-mail Address">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <input type="password" value="" class="form-control" placeholder="Password">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="password" value="" class="form-control" placeholder="Re-enter Password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-color">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Registration Modal -->
            </section>
            <!-- Scroll To Top --> 
            <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a>
        </div>
        <!-- /Wrap -->
        <!-- The Scripts -->
        <script src="<?= base_url(["page/js/jquery.min.js"]) ?> "></script>
        <script src="<?= base_url(["page/js/jquery-migrate-1.0.0.js"]) ?> "></script>
        <script src="<?= base_url(["page/js/jquery-ui.js"]) ?> "></script>
        <script src="<?= base_url(["page/js/bootstrap.js"]) ?> "></script>
        <script src="<?= base_url(["page/js/revolution-slider/js/jquery.themepunch.plugins.min.js"]) ?> "></script> 
        <script src="<?= base_url(["page/js/revolution-slider/js/jquery.themepunch.revolution.min.js"]) ?> "></script>
        <script src="<?= base_url(["page/js/jquery.parallax.js"]) ?> "></script>
        <script src="<?= base_url(["page/js/jquery.wait.js"]) ?> "></script>
        <script src="<?= base_url(["page/js/fappear.js"]) ?> "></script> 
        <script src="<?= base_url(["page/js/modernizr-2.6.2.min.js"]) ?> "></script>
        <script src="<?= base_url(["page/js/jquery.bxslider.min.js"]) ?> "></script>
        <script src="<?= base_url(["page/js/jquery.prettyPhoto.js"]) ?> "></script>
        <script src="<?= base_url(["page/js/superfish.js"]) ?> "></script>
        <script src="<?= base_url(["page/js/tweetMachine.js"]) ?> "></script>
        <script src="<?= base_url(["page/js/tytabs.js"]) ?> "></script>
        <script src="<?= base_url(["page/js/jquery.gmap.min.js"]) ?> "></script>
        <script src="<?= base_url(["page/js/jquery.sticky.js"]) ?> "></script>
        <script src="<?= base_url(["page/js/jquery.countTo.js"]) ?> "></script>
        <script src="<?= base_url(["page/js/jflickrfeed.js"]) ?> "></script>
        <script src="<?= base_url(["page/js/imagesloaded.pkgd.min.js"]) ?> "></script>
        <script src="<?= base_url(["page/js/waypoints.min.js"]) ?> "></script>
        <script src="<?= base_url(["page/js/wow.js"]) ?> "></script>
        <script src="<?= base_url(["page/js/jquery.fitvids.js"]) ?> "></script>
        <script src="<?= base_url(["page/js/custom.js"]) ?> "></script>

    </body>
</html>

