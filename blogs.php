<?php

session_start();

require 'Admin/config.php';

$page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
$category = (isset($_GET["category"]) && !empty($_GET["category"])) ? intval($_GET["category"]) : null;
$search = (isset($_GET["search"]) && !empty($_GET["search"])) ? strval($_GET["search"]) : null;
$itemsPerPage = 10;
$limit = $itemsPerPage;
$offset = ($page - 1) * $itemsPerPage;
$pages = 0;
$blogs = [];

if (is_null($category) && is_null($search)) {

    // count
    $sqlForCount = $pdo->query("SELECT count(*) as count FROM blog WHERE status = 0");
    $count = $sqlForCount->fetchObject()->count;
    $pages = ceil($count / $itemsPerPage);

  
     // posts
      $sqlForPosts = "SELECT P.id, P.name, P.description, P.img, C.name AS category FROM blog P JOIN category C ON P.category_id = C.id WHERE status = 0 ORDER BY `id` DESC LIMIT :lop OFFSET :osf";
      $query = $pdo->prepare($sqlForPosts); 
      $query->bindValue(':lop', (int) trim($limit), PDO::PARAM_INT);
      $query->bindValue(':osf', (int) trim($offset), PDO::PARAM_INT);
      $query->execute(); 
      $blogs = $query->fetchAll(PDO::FETCH_OBJ);
}


?>

<!doctype html>
<html class="no-js" lang="en">
    <head>
        <title>Blogs | Smart-Desarrollos</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="author" content="ThemeZaa">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
        <meta name="description" content="Litho is a clean and modern design, BootStrap 5 responsive, business and portfolio multipurpose HTML5 template with 37+ ready homepage demos.">
        <!-- favicon icon -->
        <link rel="shortcut icon" href="client/images/logos/favicon2.svg">
        <link rel="apple-touch-icon" href="client/images/logos/favicon2.svg">
        <link rel="apple-touch-icon" sizes="72x72" href="client/images/logos/favicon2.svg">
        <link rel="apple-touch-icon" sizes="114x114" href="client/images/logos/favicon2.svg">
        <!-- style sheets and font icons  -->
        <link rel="stylesheet" type="text/css" href="client/css/font-icons.min.css">
        <link rel="stylesheet" type="text/css" href="client/css/theme-vendors.min.css">
        <link rel="stylesheet" type="text/css" href="client/css/style.css" />
        <link rel="stylesheet" type="text/css" href="client/css/responsive.css" />
    </head>
    <body data-mobile-nav-style="classic">
        <!-- start header -->
        <header>
            <nav class="navbar navbar-expand-lg navbar-boxed navbar-dark bg-client header-light fixed-top header-reverse-scroll">
                <div class="container-fluid nav-header-container">
                    <div class="col-auto col-sm-6 col-lg-2 me-auto ps-lg-0">
                        <a class="navbar-brand" href="index.html">
                            <img src="client/images/logos/Logo.svg" data-at2x="client/images/logos/Logo.svg" class="default-logo" alt="">
                            <img src="client/images/logos/Logo.svg" data-at2x="client/images/logos/Logo.svg" class="alt-logo" alt="">
                            <img src="client/images/logos/Logo.svg" data-at2x="client/images/logos/Logo.svg" class="mobile-logo" alt="">
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
                            <ul class="navbar-nav alt-font">
                                <li class="nav-item dropdown megamenu">
                                    <a href="#" class="nav-link ">Inicio</a>
                                    <i class="fa fa-angle-down dropdown-toggle" data-bs-toggle="dropdown"></i>
                                   
                                </li>
                                <li class="nav-item dropdown simple-dropdown">
                                    <a href="proyectos.html" class="nav-link">Proyectos</a>
                                    <i class="fa fa-angle-down dropdown-toggle" data-bs-toggle="dropdown"></i>
                                    
                                </li>
                                <li class="nav-item dropdown simple-dropdown">
                                    <a href="index.html#nosotros" class="nav-link">Nosotros</a>
                                    <i class="fa fa-angle-down dropdown-toggle" data-bs-toggle="dropdown"></i>
                                    
                                </li>
                                <li class="nav-item dropdown megamenu">
                                    <a href="#" class="nav-link active">Blog</a>
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
        <!-- start page title -->
        <section class="half-section bg-light-gray parallax" data-parallax-background-ratio="0.5">
            <div class="container h-200px">
                <div class="row align-items-stretch justify-content-center extra-small-screen">
                    <div class="col-12 col-xl-6 col-lg-7 col-md-8 page-title-extra-small text-center d-flex justify-content-center flex-column">
                        <h2 class="text-extra-dark-gray alt-font font-weight-500 letter-spacing-minus-1px line-height-50 sm-line-height-45 xs-line-height-30 no-margin-bottom">Blogs</h2>
                    </div>
                </div>
            </div>
        </section>
        <!-- end page title -->
        <!-- start section --> 
        <section class="bg-light-gray pt-0 padding-eleven-lr xl-padding-two-lr xs-no-padding-lr">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 blog-content">
                        <ul class="blog-grid blog-wrapper grid grid-loading grid-3col xl-grid-3col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large">
                            <li class="grid-sizer"></li>
                            <!-- start blog item -->
                            <?php foreach($blogs as $blog): ?>
                            <li class="grid-item wow animate__fadeIn">
                                <div class="blog-post border-radius-5px bg-white box-shadow-medium">
                                    <div class="blog-post-image bg-medium-slate-blue">
                                        <a href="single_blog.php?id=<?php echo $blog->id ?>" title=""><img src="Admin/assets/images/blogs/<?php echo $blog->img ?>" alt=""></a>
                                        <a href="single_blog.html" class="blog-category alt-font"><?php echo $blog->category ?></a>
                                    </div>
                                    <div class="post-details padding-3-rem-lr padding-2-half-rem-tb">
                                        <a href="single_blog.html" class="alt-font font-weight-500 text-extra-medium text-dark margin-15px-bottom d-block"><?php echo $blog->name ?></a>
                                        <p class="text-dark"><?php echo $blog->description ?></p>
                                        <div class="d-flex align-items-center">
                                            <span class="alt-font text-small me-auto"><a href="single_blog.html" class="text-dark">Leer más</a></span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach ?>
                            <!-- end blog item -->
                            <!-- start blog item -->
                            <!-- <li class="grid-item wow animate__fadeIn">
                                <div class="blog-post border-radius-5px bg-white box-shadow-medium">
                                    <div class="blog-post-image bg-medium-slate-blue">
                                        <a href="single_blog.html" title=""><img src="https://via.placeholder.com/800x560" alt=""></a>
                                        <a href="single_blog.html" class="blog-category alt-font">Category</a>
                                    </div>
                                    <div class="post-details padding-3-rem-lr padding-2-half-rem-tb">
                                        <a href="single_blog.html" class="alt-font font-weight-500 text-extra-medium text-dark margin-15px-bottom d-block">TITULO DEL BLOG</a>
                                        <p class="text-dark">Lorem ipsum is simply dummy text printing typesetting industry lorem ipsum been dummy...</p>
                                        <div class="d-flex align-items-center">
                                            <span class="alt-font text-small me-auto"><a href="single_blog.html" class="text-dark">Leer más</a></span>
                                        </div>
                                    </div>
                                </div>
                            </li> -->
                            <!-- end blog item -->
                            <!-- start blog item -->
                            <!-- <li class="grid-item wow animate__fadeIn">
                                <div class="blog-post border-radius-5px bg-white box-shadow-medium">
                                    <div class="blog-post-image bg-medium-slate-blue">
                                        <a href="single_blog.html" title=""><img src="https://via.placeholder.com/800x560" alt=""></a>
                                        <a href="single_blog.html" class="blog-category alt-font">Category</a>
                                    </div>
                                    <div class="post-details padding-3-rem-lr padding-2-half-rem-tb">
                                        <a href="single_blog.html" class="alt-font font-weight-500 text-extra-medium text-dark margin-15px-bottom d-block">TITULO DEL BLOG</a>
                                        <p class="text-dark">Lorem ipsum is simply dummy text printing typesetting industry lorem ipsum been dummy...</p>
                                        <div class="d-flex align-items-center">
                                            <span class="alt-font text-small me-auto"><a href="single_blog.html" class="text-dark">Leer más</a></span>
                                        </div>
                                    </div>
                                </div>
                            </li> -->
                            <!-- end blog item -->
                            <!-- start blog item -->
                            <!-- <li class="grid-item wow animate__fadeIn">
                                <div class="blog-post border-radius-5px bg-white box-shadow-medium">
                                    <div class="blog-post-image bg-medium-slate-blue">
                                        <a href="single_blog.html" title=""><img src="https://via.placeholder.com/800x560" alt=""></a>
                                        <a href="single_blog.html" class="blog-category alt-font">Category</a>
                                    </div>
                                    <div class="post-details padding-3-rem-lr padding-2-half-rem-tb">
                                        <a href="single_blog.html" class="alt-font font-weight-500 text-extra-medium text-dark margin-15px-bottom d-block">TITULO DEL BLOG</a>
                                        <p class="text-dark">Lorem ipsum is simply dummy text printing typesetting industry lorem ipsum been dummy...</p>
                                        <div class="d-flex align-items-center">
                                            <span class="alt-font text-small me-auto"><a href="single_blog.html" class="text-dark">Leer más</a></span>
                                        </div>
                                    </div>
                                </div>
                            </li> -->
                            <!-- end blog item -->
                            <!-- start blog item -->
                            <!-- <li class="grid-item wow animate__fadeIn">
                                <div class="blog-post border-radius-5px bg-white box-shadow-medium">
                                    <div class="blog-post-image bg-medium-slate-blue">
                                        <a href="single_blog.html" title=""><img src="https://via.placeholder.com/800x560" alt=""></a>
                                        <a href="single_blog.html" class="blog-category alt-font">Category</a>
                                    </div>
                                    <div class="post-details padding-3-rem-lr padding-2-half-rem-tb">
                                        <a href="single_blog.html" class="alt-font font-weight-500 text-extra-medium text-dark margin-15px-bottom d-block">TITULO DEL BLOG</a>
                                        <p class="text-dark">Lorem ipsum is simply dummy text printing typesetting industry lorem ipsum been dummy...</p>
                                        <div class="d-flex align-items-center">
                                            <span class="alt-font text-small me-auto"><a href="single_blog.html" class="text-dark">Leer más</a></span>
                                        </div>
                                    </div>
                                </div>
                            </li> -->
                            <!-- end blog item -->
                            <!-- start blog item -->
                            <!-- <li class="grid-item wow animate__fadeIn">
                                <div class="blog-post border-radius-5px bg-white box-shadow-medium">
                                    <div class="blog-post-image bg-medium-slate-blue">
                                        <a href="single_blog.html" title=""><img src="https://via.placeholder.com/800x560" alt=""></a>
                                        <a href="single_blog.html" class="blog-category alt-font">Category</a>
                                    </div>
                                    <div class="post-details padding-3-rem-lr padding-2-half-rem-tb">
                                        <a href="single_blog.html" class="alt-font font-weight-500 text-extra-medium text-dark margin-15px-bottom d-block">TITULO DEL BLOG</a>
                                        <p class="text-dark">Lorem ipsum is simply dummy text printing typesetting industry lorem ipsum been dummy...</p>
                                        <div class="d-flex align-items-center">
                                            <span class="alt-font text-small me-auto"><a href="single_blog.html" class="text-dark">Leer más</a></span>
                                        </div>
                                    </div>
                                </div>
                            </li> -->
                            <!-- end blog item -->
                            
                        </ul>
                        <!-- start pagination -->
                        <?php if($pages > 1) { ?>
                        <!-- start pagination -->
                        <div class="col-12 d-flex justify-content-center margin-7-half-rem-top lg-margin-5-rem-top xs-margin-4-rem-top wow animate__fadeIn">
                            <?php $queryParams = '&category=' . $category . '&search=' . $search; ?>
                            <ul class="pagination pagination-style-01 text-small font-weight-500 align-items-center">
                                <li class="page-item">
                                    <a class="page-link"
                                    <?php if ($page > 1) { ?>
                                     href="blogs.php?page=<?php echo $page - 1 ?> <?php echo $queryParams ?>" <?php }?>>
                                     <i class="feather icon-feather-arrow-left icon-extra-small d-xs-none"></i>
                                    </a>
                                </li>
                                <?php for($i = 1; $i <= $pages; $i++) { ?>
                                <li class="page-item <?php if($i == $page) {echo 'active';} ?>"> 
                                    <a class="page-link" href="blogs.php?page=<?php echo $i ?><?php echo $queryParams ?>"><?php echo $i ?></a>
                                </li>
                                <?php } ?>
                                <li class="page-item">
                                    <a class="page-link"
                                    <?php if($page < $pages) {?> href="blogs.php?page=<?php echo $page + 1 ?><?php echo $queryParams ?>" <?php } ?>>
                                     <i class="feather icon-feather-arrow-right icon-extra-small  d-xs-none"></i>
                                    </a>
                                </li>
                             </ul>
                        </div>
                        <!-- end pagination -->
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- end section -->  
        
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
                            <h5 class="alt-font font-weight-500 text-dark title m-0">SMART DESARROLLOS</h5>
                            <ul class="nav margin-2-rem-bottom">
                                <li><i class="fas fa-map-marker-alt"></i> 
                                    <span>
                                    Calle 9 246, Campestre, 97120 Mérida, Yuc.
                                    </span>
                                </li>
                                <li style="width: 100%;"><i class="fa fa-phone"></i> <a href="tel:9999253576"> (999) 492 4428 </a></li>
                                <li><i class="far fa-envelope"></i> <a>contacto@smartdesarrollos.com</a></li>
                            </ul>
                            <h5 class="alt-font font-weight-500 text-dark title">SOCIAL</h5>
                            <ul>
                                <li><i class="fab fa-facebook-f" aria-hidden="true"></i> <a href="https://www.facebook.com/SmartDesarrollos/" target="_blank">Facebook</a></li>
                                <li><i class="fab fa-instagram" aria-hidden="true"></i> <a href="https://www.instagram.com/smartdesarrollos/" target="_blank">Instagram</a></li>
                            </ul>
                        </div>
                        <!-- end footer column -->
                        <!-- start footer column -->
                        <div id="contacto" class="col-12 col-lg-6 col-md-5 col-sm-6">
                            <h5 class="alt-font font-weight-500 text-dark title m-0">CONTACTA CON NOSOTROS</h5>
                            <span>Si desea más información, complete este formulario. Nos pondremos en contacto con usted en la brevedad posible</span>
                            <form action="client/email-templates/contact-form.php" method="POST">
                                <div class="form-group row mb-2">
                                    <label for="staticEmail" class="col-sm-6 col-form-label text-uppercase">Nombre</label>
                                    <div class="col-sm-6">
                                      <input type="text"  class=" style-input" id="name" name="name" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-2 ">
                                    <label for="staticEmail" class="col-sm-6 col-form-label text-uppercase">Correo electronico</label>
                                    <div class="col-sm-6">
                                      <input type="text"  class=" style-input" id="email" name="email" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="staticEmail" class="col-sm-6 col-form-label text-uppercase">Telefono</label>
                                    <div class="col-sm-6">
                                      <input type="text"  class=" style-input" id="phone" name="phone" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="staticEmail" class="col-sm-6 col-form-label text-uppercase">DESCRIBA SU SOLICITUD</label>
                                    <div class="col-sm-6">
                                      <textarea class="style-input" name="solicitud" id="solicitud" cols="30" rows="2" required></textarea>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center align-items-center">
                                    <button type="submit" class="btn btn-client d-flex justify-content-center">Enviar</button>
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
                        <p class="text-dark m-0">© 2019 - 2023 Smart Desarrollos - Desarrollado por <a class="text-dark" href="https://www.buho-solutions.com/">Buho Solutions</a></p>
                    </div>
                </div>
            </div>
        </footer>



        <!-- start scroll to top -->
        <a class="scroll-top-arrow" href="javascript:void(0);"><i class="feather icon-feather-arrow-up"></i></a>
        <!-- end scroll to top -->
        <!-- javascript -->
        <script type="text/javascript" src="client/js/jquery.min.js"></script>
        <script type="text/javascript" src="client/js/theme-vendors.min.js"></script>
        <script type="text/javascript" src="client/js/main.js"></script>
    </body>
</html>