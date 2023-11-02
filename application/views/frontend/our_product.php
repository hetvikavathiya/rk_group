<?php
$this->load->view('frontend/slider');
?>
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
                                    <div class="col-md-3 col-sm-6 col-xs-6 filtr-item " data-category="<?= $product[$x]['category']; ?>">
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