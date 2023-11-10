<?php
$this->load->view('frontend/slider');
?>
<!--Start Contact Us
	=========================================== -->
<section class="contact-us" id="contact">
    <div class="container">
        <div class="row justify-content-center">
            <!-- section title -->
            <div class="col-xl-6 col-lg-8">
                <div class="title text-center">
                    <h2>Contact Us</h2>
                    <p>Contact us for Furniture, Electronics Accessories, Pop Fall Ceiling, Fabrication and Interior Designs,Plumbing and Paint creator.</p>
                    <div class="border"></div>
                </div>
            </div>
            <!-- /section title -->
        </div>


        <div class="row">
            <!-- Contact Details -->
            <div class="contact-details col-md-6 ">
                <h3 class="mb-3">Contact Details</h3>
                <ul class="contact-short-info mt-4">
                    <li class="mb-3">
                        <i class="tf-ion-ios-home"></i>
                        <span><?php echo $data['address']; ?></span>
                    </li>
                    <li class="mb-3">
                        <i class="tf-ion-android-phone-portrait"></i>
                        <span>Phone:<?php echo $data['number']; ?></span>
                    </li>
                    <li>
                        <i class="tf-ion-android-mail"></i>
                        <span>Email:<a href="mailto:<?php echo $data['email']; ?>" class="text-dark"><?php echo $data['email']; ?></a></span>
                    </li>
                </ul>
                <!-- Footer Social Links -->
                <div class="social-icon">
                    <ul>
                        <li><a href="https://www.instagram.com/Rehankhanwin1" target="_blank"><i class="tf-ion-social-instagram"></i></a></li>
                        <li><a href="https://www.instagram.com/r_k_group_rushanelectronic" target="_blank"><i class="tf-ion-social-instagram"></i></a></li>
                    </ul>
                </div>
                <!--/. End Footer Social Links -->
            </div>
            <!-- / End Contact Details -->

            <!-- Contact Form -->
            <div class="contact-form col-md-6 ">
                <form method="post" role="form" action="<?= base_url('contact/add') ?>">
                    <div class="form-group mb-4">
                        <input type="text" placeholder="Your Name" class="form-control" name="name" id="name" required>
                    </div>

                    <div class="form-group mb-4">
                        <input type="text" placeholder="Your mobile no" class="form-control" name="mobile_no" id="mobile_no" required>
                    </div>

                    <div class="form-group mb-4">
                        <textarea rows="6" placeholder="Message" class="form-control" name="feedback" id="message" required></textarea>
                    </div>
                    <div id="cf-submit">
                        <input type="submit" id="contact-submit" class="btn btn-transparent" value="Submit">
                    </div>

                </form>
            </div>
            <!-- ./End Contact Form -->

        </div> <!-- end row -->
    </div> <!-- end container -->
</section> <!-- end section -->