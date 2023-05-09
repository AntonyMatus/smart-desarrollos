<?php
session_start();


require '../Admin/config.php';

$id = intval($_GET['id']);



$sqProject = "SELECT * FROM projects where id = :id"; 
$queryProject = $pdo->prepare($sqProject);
$queryProject->bindParam(':id', $id, PDO::PARAM_INT);
$queryProject->execute();
$project = $queryProject->fetch(PDO::FETCH_OBJ);

if(!$project){
    header('location: ../proyectos.php');
    } else {
    
    }
$sqlImages = "SELECT * FROM project_images where project_id = :project_id";
$queryImages = $pdo->prepare($sqlImages);
$queryImages->bindParam(':project_id', $id, PDO::PARAM_INT);
$queryImages->execute();
$images = $queryImages->fetchAll(PDO::FETCH_OBJ);

?>



<!doctype html>
<html class="no-js" lang="en">
    <head>
        <title><?php echo $project->full_name ?> | Smart-Desarrollos</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="author" content="ThemeZaa">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
        <meta name="description" content="">
        <!-- favicon icon -->
        <link rel="shortcut icon" href="../client/images/logos/favicon2.svg">
        <link rel="apple-touch-icon" href="../client/images/logos/favicon2.svg">
        <link rel="apple-touch-icon" sizes="72x72" href="../client/images/logos/favicon2.svg">
        <link rel="apple-touch-icon" sizes="114x114" href="../client/images/logos/favicon2.svg">
        <!-- style sheets and font icons  -->
        <link rel="stylesheet" type="text/css" href="../client/css/font-icons.min.css">
        <link rel="stylesheet" type="text/css" href="../client/css/theme-vendors.min.css">
        <link rel="stylesheet" type="text/css" href="../client/css/style.css" />
        <link rel="stylesheet" type="text/css" href="../client/css/responsive.css" />
    </head>
    <body data-mobile-nav-style="classic">
        <!-- start header -->
        <header>
            <nav class="navbar navbar-expand-lg navbar-boxed navbar-dark bg-transparent header-light fixed-top header-reverse-scroll">
                <div class="container-fluid nav-header-container">
                    <div class="col-auto col-sm-6 col-lg-2 me-auto ps-lg-0">
                        <a class="navbar-brand" href="../index.html">
                            <img src="../client/images/logos/Logo.svg" data-at2x="../client/images/logos/Logo.svg" class="default-logo" alt="">
                            <img src="../client/images/logos/Logo.svg" data-at2x="../client/images/logos/Logo.svg" class="alt-logo" alt="">
                            <img src="../client/images/logos/Logo.svg" data-at2x="../client/images/logos/Logo.svg" class="mobile-logo" alt="">
                        </a>
                    </div>
                    <div class="col-auto menu-order px-lg-0">
                        <button class="navbar-toggler float-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
                            <span class="navbar-toggler-line"></span>
                            <span class="navbar-toggler-line"></span>
                            <span class="navbar-toggler-line"></span>
                            <span class="navbar-toggler-line"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav alt-font3">
                                <li class="nav-item dropdown megamenu">
                                    <a href="../index.html" class="nav-link ">Inicio</a>
                                    <i class="fa fa-angle-down dropdown-toggle" data-bs-toggle="dropdown"></i>
                                   
                                </li>
                                <li class="nav-item dropdown simple-dropdown">
                                    <a href="../proyectos.php" class="nav-link active">Proyectos</a>
                                    <i class="fa fa-angle-down dropdown-toggle" data-bs-toggle="dropdown"></i>
                                    
                                </li>
                                <li class="nav-item dropdown simple-dropdown">
                                    <a href="../index.html#nosotros" class="nav-link">Nosotros</a>
                                    <i class="fa fa-angle-down dropdown-toggle" data-bs-toggle="dropdown"></i>
                                    
                                </li>
                                <li class="nav-item dropdown megamenu">
                                    <a href="../blogs.php" class="nav-link">Blog</a>
                                    <i class="fa fa-angle-down dropdown-toggle" data-bs-toggle="dropdown"></i>
                                    
                                </li>
                                <li class="nav-item dropdown simple-dropdown">
                                    <a href="#contacto" class="nav-link">Contacto</a>
                                    <i class="fa fa-angle-down dropdown-toggle" data-bs-toggle="dropdown"></i>
                                    
                                </li>
                                
                                
                            </ul>
                        </div>
                    </div>
                   
                </div>
            </nav>
           
        </header>
        <!-- end header -->
        
        <section id="classes" class="bg-client overlap-height padding-5-rem-top">
            <div class="container ">
                <div class="row align-items-end margin-2-rem-bottom">
                    <div class="col-12 col-xl-8 col-lg-8 text-center text-lg-start wow animate__fadeIn" style="visibility: visible; animation-name: fadeIn;">
                        <span class="alt-font3 font-weight-700 text-dark  d-block margin-20px-bottom md-margin-10px-bottom fz-20px title-proyec"><?php echo $project->nombre ?></span>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="swiper-container p-0 white-move one-fifth-screen sm-h-500px lg-h-720px" data-slider-options='{ "slidesPerView": 1, "loop": true, "pagination": { "el": ".swiper-pagination", "clickable": true }, "navigation": { "nextEl": ".swiper-button-next-nav", "prevEl": ".swiper-button-previous-nav" }, "autoplay": { "delay": 4000, "disableOnInteraction": false },  "keyboard": { "enabled": true, "onlyInViewport": true }, "effect": "slide" }'>
                        <div class="swiper-wrapper">
                            <!-- start slider item -->
                            <?php foreach($images as $image): ?>
                            <div class="swiper-slide cover-background" style="background-image:url('../Admin/assets/images/projects/<?php echo $image->filename ?>');">
                                <div class="opacity-light opacity-4 bg-extra-dark-gray"></div>
                                <div class="container h-100">
                                    <div class="row h-100">
                                        <div class="col-12 col-lgxl-7 col-lg-8 position-relative d-flex flex-column justify-content-center h-100 text-left">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach ?>
                        </div>
                        <!-- start slider arrow -->
                        <!--<div class="swiper-button-next-nav swiper-button-next rounded-circle slider-navigation-style-07 dark"><i class="ti-arrow-right text-extra-small"></i></div>
                        <div class="swiper-button-previous-nav swiper-button-prev rounded-circle slider-navigation-style-07 dark"><i class="ti-arrow-left text-extra-small"></i></div>-->
                        <!-- end slider arrow -->
                        <!-- start slider pagination -->
                        <div class="swiper-pagination swiper-light-pagination"></div>
                        <!-- end slider pagination -->
                    </div>
                </div>
                <div class="row margin-100px-top">
                    <div class="container">
                        <p class="alt-font3 font-weight-600 text-dark"><?php echo $project->full_name ?></p>
                        <p class="alt-font3 font-weight-600 text-dark"><?php echo $project->categoria ?></p>
                        <p class="alt-font3 font-weight-600 text-dark">AÑO: <?php echo $project->year ?></p>
                        <p class="alt-font3 font-weight-600 text-dark">M<sup>2</sup>: <?php echo $project->metros_cuadrados ?>.</p>
                        <p class="alt-font3 font-weight-600 text-dark">COSTO DE OBRA: $<?php echo $project->price ?></p>
                        <p class="alt-font3 font-weight-600 text-dark"> UBICACIÓN: <?php echo $project->ubicacion ?></p>
                    </div>
                </div>
            </div>
        </section>



        <footer class="footer-white bg-white">
            <div class="footer-top padding-seven-tb lg-padding-eight-tb sm-padding-50px-tb">
                <div class="container">
                    <div class="row ">
                        <!-- start footer column -->
                        <div class="col-12 col-lg-3 col-md-3 col-sm-6 d-flex justify-content-center margin-4-half-rem-bottom">
                            <img src="client/images/logos/logo5.svg" data-at2x="client/images/logos/logo5.svg" alt="" width="300px">
                        </div>
                        <!-- end footer column -->
                        <!-- start footer column -->
                        <div class="col-12 col-lg-3 col-md-4 col-sm-4 margin-4-half-rem-bottom">
                            <h5 class="alt-font3 font-weight-500 text-dark title m-0">SMART DESARROLLOS</h5>
                            <ul class="alt-font3 nav margin-2-rem-bottom">
                                <li><i class="fas fa-map-marker-alt"></i> 
                                    <span> 
                                        <a href="https://www.google.com.mx/maps/place/Calle+9+246,+Campestre,+97120+M%C3%A9rida,+Yuc./@21.0081496,-89.6192235,17z/data=!3m1!4b1!4m6!3m5!1s0x8f5676afc3d50de7:0xd814a36a3e5b9bdd!8m2!3d21.0081446!4d-89.6166486!16s%2Fg%2F11c4shqx44">
                                        Calle 9 246, Campestre, 97120 Mérida, Yuc.
                                    </a>
                                    </span>
                                </li>
                                <li style="width: 100%;"><i class="fa fa-phone"></i> <a href="tel:9999253576"> (999) 492 4428 </a></li>
                                <li><i class="far fa-envelope"></i> <a href="mailto:contacto@smartdesarrollos.com">contacto@smartdesarrollos.com</a></li>
                            </ul>
                            <h5 class="alt-font3 font-weight-500 text-dark title">SOCIAL</h5>
                            <ul>
                                <li><i class="fab fa-facebook-f" aria-hidden="true"></i> <a href="https://www.facebook.com/SmartDesarrollos/" target="_blank">Facebook</a></li>
                                <li><i class="fab fa-instagram" aria-hidden="true"></i> <a href="https://www.instagram.com/smartdesarrollos/" target="_blank">Instagram</a></li>
                            </ul>
                        </div>
                        <!-- end footer column -->
                        <!-- start footer column -->
                        <div id="contacto" class="col-12 col-lg-6 col-md-5 col-sm-6">
                            <h5 class="alt-font3 font-weight-500 text-dark title m-0">CONTACTA CON NOSOTROS</h5>
                            <span class="alt-font3">Si desea más información, complete este formulario. Nos pondremos en contacto con usted en la brevedad posible</span>
                            <form action="client/email-templates/contact-form.php" method="POST">
                                <div class="form-group row mb-2">
                                    <label for="staticEmail" class="alt-font3 col-sm-6 col-form-label text-uppercase">Nombre</label>
                                    <div class="col-sm-6">
                                      <input type="text"  class=" style-input" id="name" name="name" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-2 ">
                                    <label for="staticEmail" class="alt-font3 col-sm-6 col-form-label text-uppercase">Correo electronico</label>
                                    <div class="col-sm-6">
                                      <input type="text"  class=" style-input" id="email" name="email" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="staticEmail" class="alt-font3 col-sm-6 col-form-label text-uppercase">Telefono</label>
                                    <div class="col-sm-6">
                                      <input type="text"  class=" style-input" id="phone" name="phone" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="staticEmail" class="alt-font3 col-sm-6 col-form-label text-uppercase">DESCRIBA SU SOLICITUD</label>
                                    <div class="col-sm-6">
                                      <textarea class="style-input" name="solicitud" id="solicitud" cols="30" rows="2" required></textarea>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center align-items-center">
                                    <button type="submit" class=" alt-font3 btn btn-client d-flex justify-content-center">Enviar</button>
                                </div>
                            </form>
                        </div>
                        <!-- end footer column -->                        
                    </div>
                </div>
            </div>
            <div class="bg-client3 sub-footer">
                <div class="row sub-footer">
                    <div class="col-12 col-md-4">
                        <a href="aviso_privacidad.html" class="text-dark" target="_blank">Aviso de privacidad</a>
                    </div>
                    <div class="col-12 col-md-8">
                        <p class="text-dark m-0"><a href="Admin/index.php" class="mx-2 "><i class="fas fa-user text-dark"></i></a> © 2019 - 2023 Smart Desarrollos - Desarrollado por <a class="text-dark" href="https://www.buho-solutions.com/">Buho Solutions</a></p>
                    </div>
                </div>
            </div>
        </footer>



        <!-- start scroll to top -->
        <a class="scroll-top-arrow" href="javascript:void(0);"><i class="feather icon-feather-arrow-up"></i></a>
        <!-- end scroll to top -->
        <!-- javascript -->
        <script type="text/javascript" src="../client/js/jquery.min.js"></script>
        <script type="text/javascript" src="../client/js/theme-vendors.min.js"></script>
        <script type="text/javascript" src="../client/js/main.js"></script>
    </body>
</html>