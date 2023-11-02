<?php
$this->load->view('frontend/slider');
?>
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
                            <img loading="lazy" class="img-fluid" src="<?= base_url() ?>upload/team/<?= $team[$x]['image']; ?>" alt="Meghna">
                            <!-- /member photo -->

                            <!-- member social profile -->
                            <div class="mask">
                                <ul class="clearfix">
                                    <li><a href="https://themefisher.com/"><i class="tf-ion-social-facebook"></i></a></li>
                                    <li><a href="https://themefisher.com/"><i class="tf-ion-social-twitter"></i></a></li>
                                    <li><a href="https://themefisher.com/"><i class="tf-ion-social-google-outline"></i></a></li>
                                    <li><a href="https://themefisher.com/"><i class="tf-ion-social-dribbble"></i></a></li>
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