<div class="hero-slider">
    <?php for ($x = 0; $x < count($slider); $x++) { ?>
        <div class="slider-item th-fullpage hero-area" style="background-image: url(<?= base_url() ?>upload/slider/<?= $slider[$x]['image']; ?>);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">
                            <?= $slider[$x]['title']; ?></h1>
                        <p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">Lorem ipsum dolor sit amet,
                            consectetur adipisicing elit. Quod, <br> veritatis tempore nostrum id
                            officia quaerat eum corrupti, <br> ipsa aliquam velit.</p>
                        <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn btn-main" href="service.html">Explore Us</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>


<section class="portfolio section-sm" id="portfolio">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
                <!-- section title -->
                <div class="title text-center">
                    <h2>Our Product</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro, veritatis. Lorem ipsum dolor sit amet,
                        consectetur adipisicing elit. Minima, vitae? </p>
                    <div class="border"></div>
                </div>
                <!-- /section title -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <div class="portfolio-filter">
                    <button type="button" data-filter="all">All</button>
                    <?php for ($x = 0; $x < count($category); $x++) { ?>
                        <button type="button" data-filter="<?= $category[$x]['name']; ?>"> <?= $category[$x]['name']; ?></button>
                    <?php }  ?>

                </div>


                <div class="row">
                    <div class="col-12">
                        <div class="filtr-container">
                            <div class="row">
                                <?php for ($x = 0; $x < count($product); $x++) { ?>
                                    <div class="col-md-3 col-sm-6 col-xs-6 filtr-item" data-category="<?= $product[$x]['category']; ?>">
                                        <div class="portfolio-block">
                                            <img class="img-fluid" src="<?= base_url() ?>upload/product/<?= $product[$x]['image']; ?>" alt="product" style="height:300px; width:350px;">
                                            <div class="caption">
                                                <a class="search-icon" href="<?= base_url() ?>upload/product/<?= $product[$x]['image']; ?>" data-lightbox="image-1">
                                                    <i class="tf-ion-ios-search-strong"></i>
                                                </a>
                                                <h4><a href="<?php base_url('product'); ?>"><?= $product[$x]['name']; ?></a></h4>
                                            </div>
                                        </div>

                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- /end col-lg-12 -->
        </div> <!-- end row -->
    </div> <!-- end container -->
</section> <!-- End section -->

<!-- Start Our Team
		=========================================== -->
<section class="team" id="team">
    <div class="container">
        <div class="row justify-content-center">
            <!-- section title -->
            <div class="col-xl-6 col-lg-8">
                <div class="title text-center ">
                    <h2>Our Team</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque quasi tempora obcaecati, quis
                        similique quos.</p>
                    <div class="border"></div>
                </div>
            </div>
            <!-- /section title -->
        </div>
        <div class="row">
            <?php
            for ($x = 0; $x < count($team); $x++) { ?>

                <!-- team member -->
                <div class="col-lg-4 col-md-6">
                    <div class="team-member text-center">
                        <div class="member-photo">
                            <!-- member photo -->
                            <img loading="lazy" class="img-fluid" src="<?= base_url() ?>upload/team/<?= $team[$x]['image']; ?>" alt="Meghna" style="height:300px; width:350px;">
                            <!-- /member photo -->

                            <!-- member social profile -->
                            <div class="mask">
                                <ul class="clearfix">
                                    <li><a href="https://facebook.com/"><i class="tf-ion-social-facebook"></i></a></li>
                                    <li><a href="https://twitter.com/"><i class="tf-ion-social-twitter"></i></a></li>
                                    <li><a href="https://google.com/"><i class="tf-ion-social-google-outline"></i></a></li>
                                    <li><a href="https://dribbble.com/"><i class="tf-ion-social-dribbble"></i></a></li>
                                </ul>
                            </div>
                            <!-- /member social profile -->
                        </div>

                        <!-- member name & designation -->
                        <div class="member-content">
                            <h3><?= $team[$x]['name']; ?></h3>
                            <span><?= $team[$x]['destination']; ?></span>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur necessitatibus ullam, culpa odio.</p>
                        </div>
                        <!-- /member name & designation -->

                    </div>
                </div>
                <!-- end team member -->
            <?php }
            ?>

        </div> <!-- End row -->
    </div> <!-- End container -->
</section> <!-- End section -->


<!--Start Contact Us
	=========================================== -->
<section class="contact-us" id="contact">
    <div class="container">
        <div class="row justify-content-center">
            <!-- section title -->
            <div class="col-xl-6 col-lg-8">
                <div class="title text-center">
                    <h2>Contact Us</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate facilis eveniet maiores ab maxime nam
                        ut numquam molestiae quaerat incidunt?</p>
                    <div class="border"></div>
                </div>
            </div>
            <!-- /section title -->
        </div>
        <div class="row">
            <!-- Contact Details -->
            <div class="contact-details col-md-6 ">
                <h3 class="mb-3">Contact Details</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam, vero, provident, eum eligendi blanditiis ex
                    explicabo vitae nostrum facilis asperiores dolorem illo officiis ratione vel fugiat dicta laboriosam labore
                    adipisci.</p>

                <ul class="contact-short-info mt-4">
                    <li class="mb-3">
                        <i class="tf-ion-ios-home"></i>
                        <span><?php echo $contact['address']; ?></span>
                    </li>
                    <li class="mb-3">
                        <i class="tf-ion-android-phone-portrait"></i>
                        <span>Phone:<?php echo $contact['number']; ?></span>
                    </li>
                    <li class="mb-3">
                        <i class="tf-ion-android-globe"></i>
                        <span>Fax: +880-31-000-000</span>
                    </li>
                    <li>
                        <i class="tf-ion-android-mail"></i>
                        <span>Email:<?php echo $contact['email']; ?></span>
                    </li>
                </ul>
                <!-- Footer Social Links -->
                <div class="social-icon">
                    <ul>
                        <li><a href="https://themefisher.com/"><i class="tf-ion-social-facebook"></i></a></li>
                        <li><a href="https://themefisher.com/"><i class="tf-ion-social-twitter"></i></a></li>
                        <li><a href="https://themefisher.com/"><i class="tf-ion-social-dribbble-outline"></i></a></li>
                        <li><a href="https://themefisher.com/"><i class="tf-ion-social-linkedin-outline"></i></a></li>
                    </ul>
                </div>
                <!--/. End Footer Social Links -->
            </div>
            <!-- / End Contact Details -->

            <!-- feedback Form -->
            <div class="contact-form col-md-6 ">
                <form method="post" role="form" action="<?= base_url('contact/add') ?>">
                    <div class="form-group mb-4">
                        <input type="text" placeholder="Your Name" class="form-control" name="name" id="name" required>
                    </div>

                    <div class="form-group mb-4">
                        <input type="text" placeholder="Your Email" class="form-control" name="email" id="email" required>
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