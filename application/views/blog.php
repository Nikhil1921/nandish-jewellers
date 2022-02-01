<!-- blog main wrapper start -->
<div class="blog-main-wrapper section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-item-wrapper">
                    <!-- blog post item start -->
                    <div class="blog-post-item blog-details-post">
                        <figure class="blog-thumb">
                            <div class="blog-carousel-2 slick-row-15 slick-arrow-style slick-dot-style">
                                <div class="blog-single-slide">
                                    <?= img(['src' => $data['image'], 'style' => 'height: 60vh;']) ?>
                                </div>
                            </div>
                        </figure>
                        <div class="blog-content">
                            <h3 class="blog-title">
                                <?= $data['title'] ?>
                            </h3>
                            <div class="blog-meta">
                                <?= APP_NAME ?>
                            </div>
                            <div class="entry-summary">
                                <?= $data['detail'] ?>
                                <div class="tag-line">
                                    <div class="blog-share-link">
                                        <h6>Share :</h6>
                                        <div class="blog-social-icon">
                                            <a href="https://www.facebook.com/sharer.php?u=<?= current_url() ?>" class="facebook" target="_blank"><i class="fa fa-facebook"></i></a>
                                            <a href="https://twitter.com/share?url=<?= current_url() ?>&text=<?= APP_NAME ?>&hashtags=<?= APP_NAME ?>" class="twitter" target="_blank"><i class="fa fa-twitter"></i></a>
                                            <a href="https://api.whatsapp.com/send?text=<?= APP_NAME ?> <?= current_url() ?>" class="whatsapp" target="_blank"><i class="fa fa-whatsapp"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- blog post item end -->
                </div>
            </div>
        </div>
    </div>
</div>