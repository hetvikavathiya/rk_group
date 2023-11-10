<div class="hero-slider">
    <?php for ($x = 0; $x < count($slider); $x++) { ?>
        <div class="slider-item th-fullpage hero-area" style="background-image: url(<?= base_url() ?>upload/slider/<?= $slider[$x]['image']; ?>);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">
                            <?= $slider[$x]['title']; ?></h1>

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
                    <p>Designer Furniture, All types Electronics, All types Electrical, All types plumbing, All types of Pop fall ceiling, All types paints creators, All types Fabrication and interior designs provider’s and many more </p>
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
                                                <h4><a href="<?= base_url('product'); ?>"><?= $product[$x]['name']; ?></a></h4>
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

<!-- Start Services Section
==================================== -->

<section class="services" id="services">
    <div class="container">
        <div class="row justify-content-center">
            <!-- section title -->
            <div class="col-xl-6 col-lg-8">
                <div class="title text-center">
                    <h2>Our Services</h2>
                    <p>Designer Furniture, All types Electronics, All types Electrical, All types plumbing, All types of Pop fall ceiling, All types paints creators, All types Fabrication and interior designs provider’s and many more</p>
                    <div class="border"></div>
                </div>
            </div>
            <!-- /section title -->
        </div>
        <div class="row no-gutters">

            <!-- Single Service Item -->
            <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                <div class="service-block p-4 color-bg text-center">
                    <div class="service-icon text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="furniture" height="5em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <style>
                                .furniture {
                                    fill: #fbfcfe
                                }
                            </style>
                            <path d="M64 160C64 89.3 121.3 32 192 32H448c70.7 0 128 57.3 128 128v33.6c-36.5 7.4-64 39.7-64 78.4v48H128V272c0-38.7-27.5-71-64-78.4V160zM544 272c0-20.9 13.4-38.7 32-45.3c5-1.8 10.4-2.7 16-2.7c26.5 0 48 21.5 48 48V448c0 17.7-14.3 32-32 32H576c-17.7 0-32-14.3-32-32H96c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V272c0-26.5 21.5-48 48-48c5.6 0 11 1 16 2.7c18.6 6.6 32 24.4 32 45.3v48 32h32H512h32V320 272z" />
                        </svg>

                    </div>
                    <h3>Furniture Designs</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur.. Sed id lorem eget orci dictum facilisis vel id tellus. Nullam iaculis arcu at mauris dapibus consectetur..</p>
                </div>
            </div>
            <!-- End Single Service Item -->

            <!-- Single Service Item -->
            <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                <div class="service-block p-4 text-center">
                    <div class="service-icon text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="Electronics" height="5em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <style>
                                .Electronics {
                                    fill: #28ABE3
                                }
                            </style>
                            <path d="M128 32C92.7 32 64 60.7 64 96V352h64V96H512V352h64V96c0-35.3-28.7-64-64-64H128zM19.2 384C8.6 384 0 392.6 0 403.2C0 445.6 34.4 480 76.8 480H563.2c42.4 0 76.8-34.4 76.8-76.8c0-10.6-8.6-19.2-19.2-19.2H19.2z" />
                        </svg>
                    </div>
                    <h3>Electronics</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur.. Sed id lorem eget orci dictum facilisis vel id tellus. Nullam
                        iaculis arcu at mauris dapibus consectetur.</p>
                </div>
            </div>
            <!-- End Single Service Item -->

            <!-- Single Service Item -->
            <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                <div class="service-block p-4 color-bg text-center">
                    <div class="service-icon text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="Plumbing" height="5em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <style>
                                .Plumbing {
                                    fill: #ffffff
                                }
                            </style>
                            <path d="M352 320c88.4 0 160-71.6 160-160c0-15.3-2.2-30.1-6.2-44.2c-3.1-10.8-16.4-13.2-24.3-5.3l-76.8 76.8c-3 3-7.1 4.7-11.3 4.7H336c-8.8 0-16-7.2-16-16V118.6c0-4.2 1.7-8.3 4.7-11.3l76.8-76.8c7.9-7.9 5.4-21.2-5.3-24.3C382.1 2.2 367.3 0 352 0C263.6 0 192 71.6 192 160c0 19.1 3.4 37.5 9.5 54.5L19.9 396.1C7.2 408.8 0 426.1 0 444.1C0 481.6 30.4 512 67.9 512c18 0 35.3-7.2 48-19.9L297.5 310.5c17 6.2 35.4 9.5 54.5 9.5zM80 408a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
                        </svg>

                    </div>
                    <h3>Plumbing</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur.. Sed id lorem eget orci dictum facilisis vel id tellus. Nullam
                        iaculis arcu at mauris dapibus consectetur.</p>
                </div>
            </div>
            <!-- End Single Service Item -->

            <!-- Single Service Item -->
            <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                <div class="service-block p-4  text-center">
                    <div class="service-icon text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="Fabrication" height="5em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <style>
                                .Fabrication {
                                    fill: #28ABE3
                                }
                            </style>
                            <path d="M78.6 5C69.1-2.4 55.6-1.5 47 7L7 47c-8.5 8.5-9.4 22-2.1 31.6l80 104c4.5 5.9 11.6 9.4 19 9.4h54.1l109 109c-14.7 29-10 65.4 14.3 89.6l112 112c12.5 12.5 32.8 12.5 45.3 0l64-64c12.5-12.5 12.5-32.8 0-45.3l-112-112c-24.2-24.2-60.6-29-89.6-14.3l-109-109V104c0-7.5-3.5-14.5-9.4-19L78.6 5zM19.9 396.1C7.2 408.8 0 426.1 0 444.1C0 481.6 30.4 512 67.9 512c18 0 35.3-7.2 48-19.9L233.7 374.3c-7.8-20.9-9-43.6-3.6-65.1l-61.7-61.7L19.9 396.1zM512 144c0-10.5-1.1-20.7-3.2-30.5c-2.4-11.2-16.1-14.1-24.2-6l-63.9 63.9c-3 3-7.1 4.7-11.3 4.7H352c-8.8 0-16-7.2-16-16V102.6c0-4.2 1.7-8.3 4.7-11.3l63.9-63.9c8.1-8.1 5.2-21.8-6-24.2C388.7 1.1 378.5 0 368 0C288.5 0 224 64.5 224 144l0 .8 85.3 85.3c36-9.1 75.8 .5 104 28.7L429 274.5c49-23 83-72.8 83-130.5zM56 432a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z" />
                        </svg>
                    </div>
                    <h3>Fabrication and Interior Designs</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur.. Sed id lorem eget orci dictum facilisis vel id tellus. Nullam
                        iaculis arcu at mauris dapibus consectetur.</p>
                </div>
            </div>
            <!-- End Single Service Item -->

            <!-- Single Service Item -->
            <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                <div class="service-block p-4 color-bg text-center">
                    <div class="service-icon text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" height="5em" class="Ceiling" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <style>
                                .Ceiling {
                                    fill: #ffffff
                                }
                            </style>
                            <path d="M128 32c0-17.7-14.3-32-32-32S64 14.3 64 32V64H32C14.3 64 0 78.3 0 96s14.3 32 32 32H64V384c0 35.3 28.7 64 64 64H352V384H128V32zM384 480c0 17.7 14.3 32 32 32s32-14.3 32-32V448h32c17.7 0 32-14.3 32-32s-14.3-32-32-32H448l0-256c0-35.3-28.7-64-64-64L160 64v64l224 0 0 352z" />
                        </svg>
                    </div>
                    <h3>Pop Fall Ceiling</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur.. Sed id lorem eget orci dictum facilisis vel id tellus. Nullam
                        iaculis arcu at mauris dapibus consectetur.</p>
                </div>
            </div>
            <!-- End Single Service Item -->

            <!-- Single Service Item -->
            <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                <div class="service-block p-4 text-center">
                    <div class="service-icon text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" height="5em" class="Creators" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <style>
                                .Creators {
                                    fill: #28ABE3
                                }
                            </style>
                            <path d="M543.8 287.6c17 0 32-14 32-32.1c1-9-3-17-11-24L512 185V64c0-17.7-14.3-32-32-32H448c-17.7 0-32 14.3-32 32v36.7L309.5 7c-6-5-14-7-21-7s-15 1-22 8L10 231.5c-7 7-10 15-10 24c0 18 14 32.1 32 32.1h32v69.7c-.1 .9-.1 1.8-.1 2.8V472c0 22.1 17.9 40 40 40h16c1.2 0 2.4-.1 3.6-.2c1.5 .1 3 .2 4.5 .2H160h24c22.1 0 40-17.9 40-40V448 384c0-17.7 14.3-32 32-32h64c17.7 0 32 14.3 32 32v64 24c0 22.1 17.9 40 40 40h24 32.5c1.4 0 2.8 0 4.2-.1c1.1 .1 2.2 .1 3.3 .1h16c22.1 0 40-17.9 40-40V455.8c.3-2.6 .5-5.3 .5-8.1l-.7-160.2h32z" />
                        </svg>
                    </div>
                    <h3>Paints Creators</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur.. Sed id lorem eget orci dictum facilisis vel id tellus. Nullam
                        iaculis arcu at mauris dapibus consectetur.</p>
                </div>
            </div>
            <!-- End Single Service Item -->

        </div> <!-- End row -->
    </div> <!-- End container -->
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
                        </div>

                        <!-- member name & designation -->
                        <div class="member-content">
                            <h3><?= $team[$x]['name']; ?></h3>
                            <span><?= $team[$x]['designation']; ?></span>
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
                        <span><?php echo $contact['address']; ?></span>
                    </li>
                    <li class="mb-3">
                        <i class="tf-ion-android-phone-portrait"></i>
                        <span>Phone:<?php echo $contact['number']; ?></span>
                    </li>

                    <li>
                        <i class="tf-ion-android-mail"></i>
                        <span>Email:<a href="mailto:<?php echo $contact['email']; ?>" class="text-dark"><?php echo $contact['email']; ?></a></span>
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

            <!-- feedback Form -->
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