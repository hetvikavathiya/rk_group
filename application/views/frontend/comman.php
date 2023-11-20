<!DOCTYPE html>

<title>
  <?= $page_title; ?> | RK-GROUP FINANCE

</title>
<link rel="icon" href="<?= base_url('assets/images/logo-icon.jpeg')  ?>" type="image/icon type">

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

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
        <a class="navbar-brand logo" href="<?= base_url('home');  ?>">
          <img src="<?= base_url(); ?>assets/images/logo-icon.jpeg" width="200px" alt="logo icon">
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
              <a class="nav-link" href="<?= base_url('services'); ?>">Services</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="<?= base_url('team'); ?>">Team</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="<?= base_url('contact'); ?>">Contact</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link " href="<?= base_url('login/register'); ?>"><button class="btn btn-sm btn-primary">Registration</button></a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="<?= base_url('login'); ?>"><button class="btn btn-sm btn-primary">Login</button></a>
            </li>
          </ul>
        </div>
      </nav>
      <!-- /main nav -->
    </div>
  </header>

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
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
<footer id="footer" class="bg-one">
  <div class="top-footer">
    <div class="container">
      <div class="row justify-content-around">
        <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
          <h3>about</h3>
          <p>Designer Furniture, All types Electronics, All types Electrical, All types plumbing, All types of Pop fall ceiling, All types paints creators, All types Fabrication and interior designs provider’s and many more.</p>
        </div>
        <!-- End of .col-sm-3 -->

        <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
          <ul>
            <li>
              <h3>Our Services</h3>
            </li>
            <li><a href="<?= base_url('services'); ?>">Furniture Designer</a></li>
            <li><a href="<?= base_url('services'); ?>">Electronics</a></li>
            <li><a href="<?= base_url('services'); ?>">Plumbing</a></li>
            <li><a href="<?= base_url('services'); ?>">Fabrication and Interior Designs</a></li>
            <li><a href="<?= base_url('services'); ?>">Pop Fall Ceiling</a></li>
            <li><a href="<?= base_url('services'); ?>">Paints Creators</a></li>
          </ul>
        </div>
        <!-- End of .col-sm-3 -->

        <div class="col-lg-2 col-md-6 mb-5 mb-md-0">
          <ul>
            <li>
              <h3>Quick Links</h3>
            </li>
            <li><a href="<?= base_url('home'); ?>">Home</a></li>
            <li><a href="<?= base_url('about'); ?>">About</a></li>
            <li><a href="<?= base_url('product'); ?>">Product</a></li>
            <li><a href="<?= base_url('services'); ?>">Services</a></li>
            <li><a href="<?= base_url('team'); ?>">Team</a></li>
            <li><a href="<?= base_url('contact'); ?>">Contact</a></li>
          </ul>
        </div>
        <!-- End of .col-sm-3 -->

        <div class="col-lg-3 col-md-6">
          <ul>
            <li>
              <h3>Connect with us Socially</h3>
            </li>
            <li><a href="https://www.instagram.com/r_k_group_rushanelectronic">Instagram-r_k_group_rushanelectronic</a></li>
            <li><a href="https://www.instagram.com/Rehankhanwin1">Instagram - Rehankhanwin1</a></li>
          </ul>
        </div>
        <!-- End of .col-sm-3 -->

      </div>
    </div> <!-- end container -->
  </div>
  <div class="footer-bottom">
    <h5>&copy; Copyright 2023. All rights reserved.</h5>
    <h6>Design and Developed by <a href="https://ragingdevelopers.com" target="_blank">Raging Devlopers</a></h6>
  </div>
</footer> <!-- end footer -->

</html>