<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="slider-area">
    <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
        <?php foreach($banners as $banner): ?>
        <div class="hero-single-slide">
            <div class="hero-slider-item bg-img">
                <?= img(['src' => "admin/image/banner/$banner->b_image", 'alt' => 'Banner Image']) ?>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</section>
<section class="product-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center">
                    <h2 class="title">Jewellery Colletion</h2>
                    <p class="sub-title">Leading Jewellery Brand For Over 100 Years</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product-container">
                    <div class="product-tab-menu">
                        <ul class="nav justify-content-center">
                            <li><a href="#all" class="active" data-toggle="tab">All</a></li>
                            <?php foreach($cats as $cat): ?>
                            <li><a href="#<?= $cat->c_name; ?>" data-toggle="tab"><?= $cat->c_name; ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="all">
                            <div class="product-carousel-4_2 slick-row-10 slick-arrow-style">
                                <?php foreach($innerCats as $innerCat): ?>
                                    <div class="product-item">
                                        <figure class="category-thumb">
                                            <a href="<?= make_slug($innerCat->c_name."/".$innerCat->sc_name."/".$innerCat->i_name) ?>">
                                                <?php if (file_exists("admin/image/category/$innerCat->i_image") && !is_dir("admin/image/category/$innerCat->i_image")): ?>
                                                <?= img(['src' => "admin/image/category/$innerCat->i_image", 'alt' => $innerCat->i_name, 'class' => "pri-img"]) ?>
                                                <?php else: ?>
                                                <?= img(['src' => "admin/image/noproduct.png", 'alt' => $innerCat->i_name, 'class' => "pri-img"]) ?>
                                                <?php endif ?>
                                            </a>
                                        </figure>
                                        <div class="product-caption text-center">
                                            <h6 class="product-name">
                                            <a href="<?= make_slug($innerCat->c_name."/".$innerCat->sc_name."/".$innerCat->i_name) ?>"><?= $innerCat->i_name ?></a>
                                            </h6>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <?php foreach($cats as $cat): ?>
                        <div class="tab-pane fade" id="<?= $cat->c_name ?>">
                            <div class="product-carousel-4_2 slick-row-10 slick-arrow-style">
                                <?php foreach($cat->sub_cats as $subcat): ?>
                                    <?php foreach($subcat->inner_cats as $inner): ?>
                                    <div class="product-item">
                                        <figure class="category-thumb">
                                            <a href="<?= make_slug($cat->c_name."/".$subcat->sc_name."/".$inner->i_name) ?>">
                                                <?php if (file_exists("admin/image/category/$inner->i_image") && !is_dir("admin/image/category/$inner->i_image")): ?>
                                                <?= img(['src' => "admin/image/category/$inner->i_image", 'alt' => $inner->i_name, 'class' => "pri-img"]) ?>
                                                <?php else: ?>
                                                <?= img(['src' => "admin/image/noproduct.png", 'alt' => $inner->i_name, 'class' => "pri-img"]) ?>
                                                <?php endif ?>
                                            </a>
                                        </figure>
                                        <div class="product-caption text-center">
                                            <h6 class="product-name">
                                            <a href="<?= make_slug($cat->c_name."/".$subcat->sc_name."/".$inner->i_name) ?>"><?= $inner->i_name ?></a>
                                            </h6>
                                        </div>
                                    </div>
                                    <?php endforeach ?>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="group-product-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center">
                    <h2 class="title">New Arrivals</h2>
                    <p class="sub-title">Crafted By Seasoned Craftsman</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="group-list-carousel--3 slick-row-10 slick-arrow-style">
                    <?php foreach($new_prods as $new):
                        $carat = $new->p_carat;
                        $img = explode(',', $new->p_image);
                    ?>
                    <div class="group-slide-item">
                        <div class="group-item">
                            <div class="group-item-thumb">
                                <a href="<?= make_slug($new->c_name."/".$new->sc_name."/".$new->i_name."/$new->p_name-".e_id($new->p_id)) ?>">
                                    <?php if (file_exists("admin/image/product/".reset($img)) && !is_dir("admin/image/product/".reset($img))): ?>
                                    <?= img(['src' => "admin/image/product/".reset($img), 'alt' => $new->p_name]) ?>
                                    <?php else: ?>
                                    <?= img(['src' => "admin/image/noproduct.png", 'alt' => $new->p_name]) ?>
                                    <?php endif ?>
                                </a>
                            </div>
                            <div class="group-item-desc">
                                <h5 class="group-product-name">
                                    <a href="<?= make_slug($new->c_name."/".$new->sc_name."/".$new->i_name."/$new->p_name-".e_id($new->p_id)) ?>"><?= $new->p_name; ?></a>
                                </h5>
                                <div class="price-box">
                                    <span class="price-regular"><i class="fa fa-inr" aria-hidden="true"></i><?= round(($new->$carat * $new->p_gram + $new->p_other + $new->p_l_char) * 1.03) ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product-banner-statistics section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center">
                    <h2 class="title">Best Category</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="product-banner-carousel slick-row-10">
                    <?php foreach($cats as $cat): ?>
                        <?php foreach($cat->sub_cats as $subcat): ?>
                            <?php foreach($subcat->inner_cats as $inner): ?>
                            <?php if($inner->i_show == 'Best'): ?>
                            <div class="banner-slide-item">
                                <figure class="banner-statistics">
                                    <a href="<?= make_slug($cat->c_name."/".$subcat->sc_name."/".$inner->i_name) ?>">
                                        <?php if (file_exists("admin/image/category/$inner->i_image") && !is_dir("admin/image/category/$inner->i_image")): ?>
                                        <?= img(['src' => "admin/image/category/$inner->i_image", 'alt' => $inner->i_name]) ?>
                                        <?php else: ?>
                                        <?= img(['src' => "admin/image/noproduct.png", 'alt' => $inner->i_name]) ?>
                                        <?php endif ?>
                                    </a>
                                    <div class="banner-content banner-content_style2">
                                        <h5 class="banner-text3"><a href="<?= make_slug($cat->c_name."/".$subcat->sc_name."/".$inner->i_name) ?>"><?= $inner->i_name ?></a></h5>
                                    </div>
                                </figure>
                            </div>
                            <?php else: continue ?>
                            <?php endif ?>
                            <?php endforeach ?>
                        <?php endforeach ?>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="group-product-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center">
                    <h2 class="title">Best Jewellery</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach($cats as $c): ?>
            <div class="col-lg-6 section-padding">
                <div class="categories-group-wrapper">
                    <div class="section-title-append">
                        <h4>best Jewellery in <?= $c->c_name ?></h4>
                        <div class="slick-append"></div>
                    </div>
                    <div class="group-list-item-wrapper" >
                        <div class="group-list-carousel" >
                            <?php foreach ($c->best as $best):
                            $imge = explode(",", $best->p_image);
                            $carat = $best->p_carat;
                            ?>
                            <div class="group-slide-item" >
                                <div class="group-item">
                                    <div class="group-item-thumb">
                                        <a href="<?= make_slug($best->c_name."/".$best->sc_name."/".$best->i_name."/$best->p_name-".e_id($best->p_id)) ?>">
                                            <?php if (file_exists("admin/image/product/".reset($imge)) && !is_dir("admin/image/product/".reset($imge))): ?>
                                            <?= img(['src' => "admin/image/product/".reset($imge), 'alt' => $best->p_name]) ?>
                                            <?php else: ?>
                                            <?= img(['src' => "admin/image/noproduct.png", 'alt' => $best->p_name]) ?>
                                            <?php endif ?>
                                        </a>
                                    </div>
                                    <div class="group-item-desc" >
                                        <h5 class="group-product-name"><a href="<?= make_slug($best->c_name."/".$best->sc_name."/".$best->i_name."/$best->p_name-".e_id($best->p_id)) ?>"><?= $best->p_name ?></a></h5>
                                        <div class="price-box">
                                            <span class="price-regular"><i class="fa fa-inr" aria-hidden="true"></i><?= round(($best->$carat * $best->p_gram + $best->p_other + $best->p_l_char) * 1.03) ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</section>
<section class="testimonial-section" >
    <div class="section-title text-center">
        <h2 class="title">Owners Message</h2>
        <p class="sub-title text-capitalize">What they say</p>
    </div>
    <div class=" bg-color">
        <div class="testimonial">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="testimonial-thumb-wrapper">
                        <div class="testimonial-thumb-carousel">
                            <?php foreach($testimonials as $testimonial): ?>
                            <div class="testimonial-thumb">
                                <?= img(['src' => "admin/image/testimonial/$testimonial->t_image", 'alt' => $testimonial->t_name]) ?>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="testimonial-content-wrapper">
                        <div class="testimonial-content-carousel">
                            <?php foreach($testimonials as $testimonial): ?>
                            <div class="testimonial-content">
                                <h5 class="testimonial-author"><?= $testimonial->t_name ?></h5>
                                <p>
                                    <?= $testimonial->t_detail ?>
                                </p>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>
<?php $this->load->view('why_choose') ?>