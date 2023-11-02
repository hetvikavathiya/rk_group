<!DOCTYPE html>

<title>
  <?= $page_title; ?>
</title>

<html lang="en">

<head>

  <!-- Basic Page Needs
  ================================================== -->
  <meta charset="utf-8">
  <title>Bingo | Responsive Multipurpose Parallax HTML5 Template</title>

  <!-- Mobile Specific Metas
  ================================================== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="One page parallax responsive HTML Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="author" content="Themefisher">
  <meta name="generator" content="Themefisher Bingo HTML Template v1.0">

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />

  <!-- CSS
  ================================================== -->
  <!-- Themefisher Icon font -->
  <link rel="stylesheet" href="<?= base_url('assets/frontend/'); ?>plugins/themefisher-font/style.css">
  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="<?= base_url('assets/frontend/'); ?>plugins/bootstrap/bootstrap.min.css">
  <!-- Lightbox.min css -->
  <link rel="stylesheet" href="<?= base_url('assets/frontend/'); ?>plugins/lightbox2/css/lightbox.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/frontend/'); ?>plugins/lightbox2/css/lightbox.css">
  <!-- animation css -->
  <link rel="stylesheet" href="<?= base_url('assets/frontend/'); ?>plugins/animate/animate.css">
  <!-- Slick Carousel -->
  <link rel="stylesheet" href="<?= base_url('assets/frontend/'); ?>plugins/slick/slick.css">
  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="<?= base_url('assets/frontend/'); ?>css/style.css">
</head>
<div id="preloader">
  <div class='preloader'>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
  </div>
</div>



<body id="body">
  <header class="navigation fixed-top">
    <div class="container">
      <!-- main nav -->
      <nav class="navbar navbar-expand-lg navbar-light px-0">
        <!-- logo -->
        <a class="navbar-brand logo" href="index.html">
          <img loading="lazy" class="logo-default" src="assets/frontend/images/logo.png" alt="logo" />
          <img loading="lazy" class="logo-white" src="assets/frontend/images/logo-white.png" alt="logo" />
        </a>
        <!-- /logo -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navigation">
          <ul class="navbar-nav ml-auto text-center">
            <li class="nav-item ">
              <a class="nav-link" href="<?= base_url('home');  ?>">Home</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="<?= base_url('about');  ?>">About Us</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="<?= base_url('product'); ?>">Product</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="portfolio.html">Portfolio</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="<?= base_url('team'); ?>">Team</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="pricing.html">Pricing</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="<?= base_url('contact'); ?>">Contact</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#!" id="navbarDropdown02" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Pages <i class="tf-ion-chevron-down"></i>
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown02">
                <li><a class="dropdown-item" href="404.html">404 Page</a></li>
                <li><a class="dropdown-item" href="blog.html">Blog Page</a></li>
                <li><a class="dropdown-item" href="single-post.html">Blog Single Page</a></li>

                <li class="dropdown dropdown-submenu dropleft">
                  <a class="dropdown-item dropdown-toggle" href="#!" id="dropdown0201" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sub Menu <i class="tf-ion-chevron-down"></i></a>

                  <ul class="dropdown-menu" aria-labelledby="dropdown0201">
                    <li><a class="dropdown-item" href="index.html">Submenu 01</a></li>
                    <li><a class="dropdown-item" href="index.html">Submenu 02</a></li>
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
      <!-- /main nav -->
    </div>
  </header>

  <!-- <section class="single-page-header">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2><?= $page_title ?></h2>
          <ol class="breadcrumb header-bradcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>" class="text-white">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $page_title ?></li>
          </ol>
        </div>
      </div>
    </div>
  </section> -->


  <?php
  $this->load->view($page_name);

  ?>

  <!-- 
    Essential Scripts
    =====================================-->
  <!-- Main jQuery -->
  <script src="<?= base_url('assets/frontend/'); ?>plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap4 -->
  <script src="<?= base_url('assets/frontend/'); ?>plugins/bootstrap/bootstrap.min.js"></script>
  <!-- Parallax -->
  <script src="<?= base_url('assets/frontend/'); ?>plugins/parallax/jquery.parallax-1.1.3.js"></script>
  <!-- lightbox -->
  <script src="<?= base_url('assets/frontend/'); ?>plugins/lightbox2/js/lightbox.min.js"></script>
  <!-- Owl Carousel -->
  <script src="<?= base_url('assets/frontend/'); ?>plugins/slick/slick.min.js"></script>
  <!-- filter -->
  <script src="<?= base_url('assets/frontend/'); ?>plugins/filterizr/jquery.filterizr.min.js"></script>
  <!-- Smooth Scroll js -->
  <script src="<?= base_url('assets/frontend/'); ?>plugins/smooth-scroll/smooth-scroll.min.js"></script>

  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU"></script>
  <script src="<?= base_url('assets/frontend'); ?>plugins/google-map/gmap.js"></script>

  <!-- Custom js -->
  <script src="<?= base_url('assets/frontend/'); ?>js/script.js"></script>

</body>
<footer id="footer" class="bg-one">
  <div class="top-footer">
    <div class="container">
      <div class="row justify-content-around">
        <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
          <h3>about</h3>
          <p>Integer posuere erat a ante venenati dapibus posuere velit aliquet. Fusce dapibus, tellus cursus commodo, tortor mauris sed posuere.</p>
        </div>
        <!-- End of .col-sm-3 -->

        <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
          <ul>
            <li>
              <h3>Our Services</h3>
            </li>
            <li><a href="service.html">Ui/Ux Design</a></li>
            <li><a href="service.html">Graphic Design</a></li>
            <li><a href="service.html">Web Design</a></li>
            <li><a href="service.html">Web Development</a></li>
          </ul>
        </div>
        <!-- End of .col-sm-3 -->

        <div class="col-lg-2 col-md-6 mb-5 mb-md-0">
          <ul>
            <li>
              <h3>Quick Links</h3>
            </li>
            <li><a href="about.html">About</a></li>
            <li><a href="service.html">Services</a></li>
            <li><a href="blog.html">Blogs</a></li>
            <li><a href="404.html">404</a></li>
          </ul>
        </div>
        <!-- End of .col-sm-3 -->

        <div class="col-lg-3 col-md-6">
          <ul>
            <li>
              <h3>Connect with us Socially</h3>
            </li>
            <li><a href="https://www.facebook.com/themefisher/">Facebook</a></li>
            <li><a href="https://www.twitter.com/themefisher/">Twitter</a></li>
            <li><a href="https://www.youtube.com/channel/UCx9qVW8VF0LmTi4OF2F8YdA">Youtube</a></li>
            <li><a href="https://www.github.com/themefisher/">Github</a></li>
          </ul>
        </div>
        <!-- End of .col-sm-3 -->

      </div>
    </div> <!-- end container -->
  </div>
  <div class="footer-bottom">
    <h5>&copy; Copyright 2020. All rights reserved.</h5>
    <h6>Design and Developed by <a href="https://themefisher.com/">Themefisher</a></h6>
  </div>
</footer> <!-- end footer -->

</html>