<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
  <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
  <meta name="author" content="pixelstrap">
  <link rel="icon" href="<?= base_url(); ?>assets/images/fav.png" type="image/x-icon">
  <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/fav.png" type="image/x-icon">
  <title><?= $page_title; ?> | RK</title>

  <!-- Google font-->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <!-- Font Awesome-->
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/fontawesome.css">
  <!-- ico-font-->
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/icofont.css">
  <!-- Themify icon-->
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/themify.css">
  <!-- Flag icon-->
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/flag-icon.css">
  <!-- Feather icon-->
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/feather-icon.css">
  <!-- Plugins css start-->
  <!-- Plugins css Ends-->
  <!-- Bootstrap css-->
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/bootstrap.css">
  <!-- App css-->
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/style.css">
  <link id="color" rel="stylesheet" href="<?= base_url(); ?>assets/css/color-1.css" media="screen">
  <!-- Responsive css-->
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/responsive.css">
  <style>
    .alert-success {
      background-color: #2e3092;
    }
  </style>
</head>

<body>
  <!-- Loader starts-->
  <div class="loader-wrapper">
    <div class="theme-loader">
      <div class="loader-p"></div>
    </div>
  </div>
  <!-- Loader ends-->
  <!-- page-wrapper Start-->
  <section>
    <div class="container-fluid p-0">
      <div class="row">
        <div class="col-12">
          <div class="login-card">
            <form class="theme-form login-form" method="post" action="<?= base_url('admin/login/validateLogin'); ?>">
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
              <?php if ($this->session->flashdata('flash_message') != "") {
                $message = $this->session->flashdata('flash_message');  ?>
                <div class="alert alert-<?= $message['class']; ?> alert-dismissible" role="alert">
                  <div>
                    <h5 class="alert-title"><?= $message['message']; ?></h5>
                  </div>
                  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
              <?php $this->session->set_flashdata('flash_message', "");
              }  ?>
              <h4>Login</h4>
              <h6>Welcome back! Log in to your account.</h6>
              <div class="form-group">
                <label>Mobile No</label>
                <div class="input-group"><span class="input-group-text"><i class="icon-mobile"></i></span>
                  <input class="form-control" type="number" required="" name="mobile_no" placeholder="Mobile No">
                </div>
              </div>
              <div class="form-group">
                <label>Password</label>
                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                  <input class="form-control" type="password" name="password" required="" placeholder="*********">
                </div>
              </div>
              <div class="form-group">
                <!--<div class="checkbox">-->
                <!--  <input id="checkbox1" type="checkbox">-->
                <!--  <label for="checkbox1">Remember password</label>-->
                <!--</div><a class="link" href="forget-password.html">Forgot password?</a>-->
              </div>
              <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Sign in</button>
              </div>
              <!--<div class="login-social-title">                -->
              <!--  <h5>Sign in with</h5>-->
              <!--</div>-->
              <!--<div class="form-group">-->
              <!--  <ul class="login-social">-->
              <!--    <li><a href="https://www.linkedin.com/login" target="_blank"><i data-feather="linkedin"></i></a></li>-->
              <!--    <li><a href="https://www.linkedin.com/login" target="_blank"><i data-feather="twitter"></i></a></li>-->
              <!--    <li><a href="https://www.linkedin.com/login" target="_blank"><i data-feather="facebook"></i></a></li>-->
              <!--    <li><a href="https://www.instagram.com/login" target="_blank"><i data-feather="instagram">                  </i></a></li>-->
              <!--  </ul>-->
              <!--</div>-->
              <!--<p>Don't have account?<a class="ms-2" href="https://admin.pixelstrap.com/viho/theme/log-in.html">Create Account</a></p>-->
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- page-wrapper end-->
  <!-- latest jquery-->
  <script src="<?= base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>
  <!-- feather icon js-->
  <script src="<?= base_url(); ?>assets/js/icons/feather-icon/feather.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/icons/feather-icon/feather-icon.js"></script>
  <!-- Sidebar jquery-->
  <script src="<?= base_url(); ?>assets/js/sidebar-menu.js"></script>
  <script src="<?= base_url(); ?>assets/js/config.js"></script>
  <!-- Bootstrap js-->
  <script src="<?= base_url(); ?>assets/js/bootstrap/popper.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/bootstrap/bootstrap.min.js"></script>
  <!-- Plugins JS start-->
  <!-- Plugins JS Ends-->
  <!-- Theme js-->
  <script src="<?= base_url(); ?>assets/js/script.js"></script>
  <!-- login js-->
  <!-- Plugin used-->
</body>

</html>