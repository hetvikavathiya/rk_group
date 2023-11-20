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
    <!-- SweetAlert2 -->
    <link defer rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.css" integrity="sha512-gAU9FxrcktP/m5fRrn5P4FmIutdMP/kpVKsPerqffFy9gKQkR4cxrcrK3PtgTAgFiiN7b5+fwRbpCcO1F5cPew==" crossorigin="anonymous" referrerpolicy="no-referrer" media />

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        .card-authentication1 {
            width: 29rem;
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
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Customer Registration Form</div>
                        <hr>

                        <form method="post" action="<?= base_url('login/register_now'); ?>" enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="input-1">First Name<span class="text-danger">*</span></label>
                                        <input type="hidden" value="<?php if (!empty($check)) {
                                                                        echo $check;
                                                                    } ?>" name="check">
                                        <input type="text" class="form-control" id="input-1" value="<?php if (!empty($row_data)) {
                                                                                                        echo $row_data['first_name'];
                                                                                                    } ?>" name="first_name" placeholder="Enter First Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="input-2">Middle Name</label>
                                        <input type="text" class="form-control" id="input-2" name="middle_name" value="<?php if (!empty($row_data)) {
                                                                                                                            echo $row_data['middle_name'];
                                                                                                                        } ?>" placeholder="Enter Your Middle Name">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="input-3">Last Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="input-3" name="last_name" value="<?php if (!empty($row_data)) {
                                                                                                                            echo $row_data['last_name'];
                                                                                                                        } ?>" placeholder="Enter Your Last Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="input-3311">AAdhar Card No<span class="text-danger">*</span></label>
                                        <input type="text" value="<?php if(!empty($row_data)) {
                                                                        echo $row_data['aadhar_card'];
                                                                    } ?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" pattern=".{10,}" minlength="12" maxlength="12" class="form-control" id="input-3311" name="aadhar_card" placeholder="Enter Aadhar Card No" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="input-33">Mobile No<span class="text-danger">*</span></label>
                                        <input type="text" value="<?php if (!empty($row_data)) {
                                                                        echo $row_data['mobile'];
                                                                    } ?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" pattern=".{10,}" minlength="10" maxlength="10" class="form-control" id="input-33" name="mobile" placeholder="Enter Your Mobile No" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="input-4">Password<span class="text-danger">*</span></label>
                                        <input type="password" name="password" class="form-control" id="input-4" placeholder="Enter Password" <?php if (empty($row_data)) {
                                                                                                                                                    echo 'required';
                                                                                                                                                } ?>>
                                        <div class="icheck-material-white">
                                            <input type="checkbox" onclick="myFunction()" id="user-checkbox1" />
                                            <label for="user-checkbox1">Show</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="input-533">Email</label>
                                        <input type="email" value="<?php if (!empty($row_data)) {
                                                                        echo $row_data['email'];
                                                                    } ?>" class="form-control" name="email" id="input-533" placeholder="Your Email Address">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="input-5">Address</label>
                                        <input type="text" value="<?php if (!empty($row_data)) {
                                                                        echo $row_data['address'];
                                                                    } ?>" class="form-control" name="address" id="input-5" placeholder="Your Address">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="input-5">City</label>
                                        <input type="text" value="<?php if (!empty($row_data)) {
                                                                        echo $row_data['city'];
                                                                    } ?>" name="city" class="form-control" id="input-5" placeholder="Your City">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="input-23">Alternate Mobile No</label>
                                        <input type="text" value="<?php if (!empty($row_data)) {
                                                                        echo $row_data['alternate_mobile_no'];
                                                                    } ?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" pattern=".{10,}" minlength="10" maxlength="10" name="a_mobile" class="form-control" id="input-23" placeholder="Your Alternate Mobile No">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label for="select121">Account type<span class="text-danger">*</span></label>
                                    <select class="form-select" name="acc_type_id" id="acc_type_id">
                                        <option>Select account type</option>
                                        <?php
                                        $account_type = $this->db->get('account_type')->result();
                                        foreach ($account_type as $value) {
                                        ?>
                                            <option value="<?= $value->id; ?>" <?php if (isset($update_data) && $value->id == $update_data['acc_type_id']) {
                                                                                    echo 'selected';
                                                                                } ?>><?= $value->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label for="select">Document Type<span class="text-danger">*</span></label>
                                    <select required class="form-select" id="select" name="document_type" aria-label="Default select example">
                                        <option selected value="">Select Document Type</option>
                                        <option value="Aadhaar Card">Aadhaar Card</option>
                                        <option value="Pan Card">Pan Card</option>
                                        <option value="Election card">Election card</option>
                                        <option value="Driving Licence">Driving Licence</option>
                                        <option value="Passport">Passport</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="input-document">Frontside Document<span class="text-danger">*</span></label>
                                        <input type="file" name="frontside_document" class="form-control" id="input-document" placeholder="Your document" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="input-document-2">Backside Document<span class="text-danger">*</span></label>
                                        <input type="file" name="backside_document" class="form-control" id="input-document-2" placeholder="Your document" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="input-photo">Photo<span class="text-danger">*</span></label>
                                        <input type="file" name="photo" class="form-control" id="input-photo" placeholder="Your photo" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="input-signature">Signature<span class="text-danger">*</span></label>
                                        <input type="file" name="signature" class="form-control" id="input-signature" placeholder="Your signature" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-light px-5">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function myFunction() {
                var x = document.getElementById("input-4");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
        </script>


    </div>
    <!--wrapper-->

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/popper.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?= base_url(); ?>assets/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- sidebar-menu js -->
    <script src="<?= base_url(); ?>assets/js/sidebar-menu.js"></script>

    <!-- Custom scripts -->
    <script src="<?= base_url(); ?>assets/js/app-script.js"></script>
    <script>
        <?php if ($this->session->flashdata('flash_message') != "") { ?>
            <?php $message = $this->session->flashdata('flash_message'); ?>
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                customClass: {
                    popup: 'colored-toast'
                }

            });
            Toast.fire({
                icon: "<?= $message['class']; ?>",
                title: "<?= $message['message']; ?>"
            });
        <?php   }  ?>
    </script>
</body>

</html>