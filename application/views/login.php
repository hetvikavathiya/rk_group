<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Log In | RK GROUP</title>
  <!-- loader-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="<?= base_url(); ?>assets/css/pace.min.css" rel="stylesheet" />
  <script src="<?= base_url(); ?>assets/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="<?= base_url(); ?>assets/images/logo-icon.png" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
  <!-- animate CSS-->
  <link href="<?= base_url(); ?>assets/css/animate.css" rel="stylesheet" type="text/css" />
  <!-- Icons CSS-->
  <link href="<?= base_url(); ?>assets/css/icons.css" rel="stylesheet" type="text/css" />
  <!-- Custom Style-->
  <link href="<?= base_url(); ?>assets/css/app-style.css" rel="stylesheet" />
  <style>
    .card-authentication1 {
      width: 29rem;
    }

    .card-body {
      padding: 0rem 1rem;
    }
  </style>
</head>

<body class="bg-theme bg-theme1">

  <!-- start loader -->
  <div id="pageloader-overlay" class="visible incoming">
    <div class="loader-wrapper-outer">
      <div class="loader-wrapper-inner">
        <div class="loader"></div>
      </div>
    </div>
  </div>
  <!-- end loader -->

  <!-- Start wrapper-->
  <div id="wrapper">

    <div class="loader-wrapper">
      <div class="lds-ring">
      </div>
    </div>

    <div class="card card-authentication1 mx-auto my-1">
      <div class="card-body">
        <div class="card-content p-2">
          <div class="text-center">
            <img src="<?= base_url(); ?>assets/images/logo-icon.png" width="300px" alt="logo icon">
          </div>
          <div class="text-center font-weight-bold">
            RK GROUP FINANCE <br> Registration Number : GMLAHC2324000229
          </div>

          <div class="card-title text-uppercase text-center pb-3 m-0">LOG IN</div>
          <form method="post" action="<?= base_url('login/validateLogin'); ?>" autocomplete="off">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <?php if ($this->session->flashdata('flash_message') != "") {
              $message = $this->session->flashdata('flash_message');  ?>
              <div class="alert alert-<?= $message['class']; ?> alert-dismissible" role="alert">
                <div>
                  <h5 class="alert-title p-3"><?= $message['message']; ?></h5>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
              </div>
            <?php $this->session->set_flashdata('flash_message', "");
            }  ?>
            <div class="form-group">
              <label for="exampleInputUsername">Mobile No</label>
              <div class="position-relative has-icon-right">
                <input type="text" id="exampleInputUsername" required onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" pattern=".{10,}" minlength="10" maxlength="10" name="mobile_no" autocomplete="off" class="form-control input-shadow" placeholder="Enter mobile number">
                <div class="form-control-position">
                  <i class="icon-user"></i>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword">Password</label>
              <div class="position-relative has-icon-right">
                <input type="password" id="exampleInputPassword" name='password' required class="form-control input-shadow" placeholder="Enter Password">
                <div class="form-control-position">
                  <i class="icon-lock"></i>
                </div>
              </div>
            </div>
            <div class="col-md-5 col-sm-4 col-6 float-right mb-3">
              <button type="submit" class="btn btn-light btn-block">Log In</button>
            </div>

          </form>
        </div>
      </div>
      <div class=" col-md-5 float-right">
        <a href="<?= base_url('login/register'); ?>" class="btn btn-light btn-block">Register Now</a>
      </div>
      <br>
      <hr class="m-0">
      <div class="p-3">
        <h4 class="text-center m-0">Electronics and Furniture Available in Easy EMI</h4><br>
        <h5>Mobile No : 9924963026 / 8733959677</h5>
        <h5>Email : support@rkgroupfinance.in</h5>
        <h5>
          Instagram : <a target="_blank" href="https://www.instagram.com/r_k_group_rushanelectronic/">r_k_group_rushanelectronic</a>
        </h5>
      </div>


    </div>
    <div class="row">
      <div class="justify-content-center p-0 m-0" style="margin:0 auto;text-align: center;">
        <div class="row">
          <div class="col-md-2">
            <img src="<?= base_url('upload/login-img-2.jpg'); ?>" height="220px" width="100%">
          </div>
          <div class="col-md-2">
            <img src="<?= base_url('upload/login-img-3.jpg'); ?>" height="220px" width="100%">
          </div>
          <div class="col-md-4">
            <img src="<?= base_url('upload/login-img-1.jpeg'); ?>" height="220px" width="100%">
          </div>
          <div class="col-md-2">
            <img src="<?= base_url('upload/login-img-4.jpg'); ?>" height="220px" width="100%">
          </div>
          <div class="col-md-2">
            <img src="<?= base_url('upload/login-img-5.jpg'); ?>" height="220px" width="100%">
          </div>

        </div>

        <!--<img src="<?= base_url('upload/login-img-3.jpg'); ?>" height="180px" width="auto">-->
        <!--<img src="<?= base_url('upload/login-img-1.jpeg'); ?>" height="180px" width="auto">-->
        <!--   <img src="<?= base_url('upload/login-img-4.jpg'); ?>" height="180px" width="auto">-->
        <!--      <img src="<?= base_url('upload/login-img-5.jpg'); ?>" height="180px" width="auto">-->
      </div>
    </div>
    <!--</div>-->
    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->


  </div>
  <!--wrapper-->

  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/popper.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- sidebar-menu js -->
  <script src="<?= base_url(); ?>assets/js/sidebar-menu.js"></script>

  <!-- Custom scripts -->
  <script src="<?= base_url(); ?>assets/js/app-script.js"></script>

</body>

</html>