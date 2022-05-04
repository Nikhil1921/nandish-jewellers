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
                    <h2 class="title">Jewellery Collection</h2>
                    <p class="sub-title">4th Generation Leading Jewellery Brand</p>
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
                                <?php foreach($innerCats as $innerCat): if($innerCat->c_name != $cat->c_name) continue; ?>
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
                <div class="section-title">
                    <h2 class="fnt_size1">Online Jewellery Store</h2>
                    <hr>
                </div>
                <p class="text-justify">
                    <b>Nandish Jewellers</b> is one of the best jewellery brands in India in terms of item collection and variety of
                    ornaments. <b>Nandish.in</b> has an online store with a large selection of one-of-a-kind and premium-quality
                    jewellery of gold and silver jewellery in India!! Ideal the wedding for the special you with <b>Nandish
                    jewellers</b> unique and quality jewellery remarks incredible. Easy purchase on a selected real gold, silver,
                    and diamond online jewellery store. We have a maximum collection for men, women, and kids items
                    from lightweight to heavyweight range, latest and contemporary women to <a class="text-dark" href="<?= base_url('gold/women/long-necklace/antique.html') ?>"><b>Antique Gold Necklace</b></a> of
                    Kundan and Polki for the bride in weddings as well. <b>Nandish Jewellers</b> is one of India's most well-known
                    jewellery brands with a reputation for customer transparency and constantly updated gold and silver
                    collections. We offer all of our branded jewellery online and are a recognized hallmarked certified
                    brand, giving us the title of the trusted online jewellery store.
                </p>
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
                    <p class="sub-title">Crafted By Seasoned Best Craftmen & Craftmanship</p>
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
                                <a href="<?= make_slug($new->c_name."/".$new->sc_name."/".$new->i_name."/$new->si_name/$new->p_name-".e_id($new->p_id)) ?>">
                                    <?php if (file_exists("admin/image/product/thumb_".reset($img)) && !is_dir("admin/image/product/thumb_".reset($img))): ?>
                                    <?= img(['src' => "admin/image/product/thumb_".reset($img), 'alt' => $new->p_name]) ?>
                                    <?php else: ?>
                                    <?= img(['src' => "admin/image/noproduct.png", 'alt' => $new->p_name]) ?>
                                    <?php endif ?>
                                </a>
                            </div>
                            <div class="group-item-desc">
                                <h5 class="group-product-name">
                                    <a href="<?= make_slug($new->c_name."/".$new->sc_name."/".$new->i_name."/$new->si_name/$new->p_name-".e_id($new->p_id)) ?>"><?= $new->p_name; ?></a>
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
                <div class="section-title">
                    <h2 class="fnt_size2">Gold Jewellery</h2>
                    <hr>
                </div>
                <p class="text-justify">
                    In terms of item collection and diversity of ornaments, <b>Nandish.in</b> is one of India's best jewellery brands.
                    We have a customer-friendly website with a selection of gold jewellery collections and <a class="text-dark" href="<?= base_url('gold/women/necklace/antique.html') ?>"><b>Antique Long
                    Necklace</b></a> for online purchasing in India. We're here to help you find it on our website, you may consider
                    our assortment to be one of India's best gold shopping sites as well as the most diverse collection. We
                    believe in serving customers with purity and genuineness provide and we provide hallmarked 22Karat
                    (916) excellent grade jewellery. We provide the most recent collections for men, women & children.
                    Men's gold jewellery designs are complicated, and exquisite gents jewellery completes his faultless
                    ensemble. Men's gold items have the best deals and a diverse assortment. Our astonishing latest <a class="text-dark" href="<?= base_url('gold/women/bangles/copper-kadli.html') ?>"><b>Gold
                    Kadli Bengles</b></a> and ornaments are attractive to today's fashion-conscious women.
                </p>
                <p class="text-justify">
                    We guarantee that we will provide you with the most up-to-date real gold fashion jewellery designs for
                    ladies without sacrificing quality. You can consider our collection of female or women items for the top
                    gold jewellery brands in India and also the most versatile brand. Also available are exquisite pieces of
                    Antique gold necklace, bridal gold jewellery, and both kid boys and girls. <a class="text-dark" href="<?= base_url('gold/kids.html') ?>"><b>Baby Gold Jewellery</b></a> should be
                    lovely and unique, keeping that in mind we have special gold jewellery for kids that can also be used as a
                    gift for small children and newborn baby boy & girl.
                </p>
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
                        <h4><?= $c->c_name ?></h4>
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
                                        <a href="<?= make_slug($best->c_name."/".$best->sc_name."/".$best->i_name."/$best->si_name/$best->p_name-".e_id($best->p_id)) ?>">
                                            <?php if (file_exists("admin/image/product/thumb_".reset($imge)) && !is_dir("admin/image/product/thumb_".reset($imge))): ?>
                                            <?= img(['src' => "admin/image/product/thumb_".reset($imge), 'alt' => $best->p_name]) ?>
                                            <?php else: ?>
                                            <?= img(['src' => "admin/image/noproduct.png", 'alt' => $best->p_name]) ?>
                                            <?php endif ?>
                                        </a>
                                    </div>
                                    <div class="group-item-desc" >
                                        <h5 class="group-product-name"><a href="<?= make_slug($best->c_name."/".$best->sc_name."/".$best->i_name."/$best->si_name/$best->p_name-".e_id($best->p_id)) ?>"><?= $best->p_name ?></a></h5>
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
<section class="group-product-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h3 class="fnt_size3">Silver Jewellery</h3>
                    <hr>
                </div>
                <p class="text-justify">
                    <b>Nandish.in</b> is the wonderful assortment of top silver jewellery buying online is also known as Chandi ki
                    jewellery. You can discover the latest silver fashion jewellery such as <a class="text-dark" href="<?= base_url('silver/women/anklet.html') ?>"><b>Silver Anklet</b></a> and ornaments for
                    women, silver jewellery for men and kids. Not only that, but we also offer a huge selection of designer
                    silver fashion jewellery for bridal. This store offers a unique section for silver aficionados, and it makes
                    our customers feel a warm welcome.
                </p>
                <p class="text-justify">
                    Silver jewellery for men comprises items that are both flexible and stylish. Here you will find the greatest
                    selection of gents silver jewellery. Our online store offers a wide range of products. Women's or ladies
                    jewellery is available online in a variety of silver fancy and heavy pieces. Female ornaments are vital
                    since they elevate one's appearance, and we guarantee that you will get real silver jewellery for ladies at
                    our online silver store. Kid’s cartoon jewellery is frequently given to children as a gift on occasions such
                    as their birthdays or even when gifting silver jewellery and accessories to newborn baby boys and girls.
                    Buy baby silver online jewellery items as baby gift items in silver or as children's gifts for newborn
                    babies.
                </p>
            </div>
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
                                <br>
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
<?php if($blogs): ?>
<!-- latest blog area start -->
<section class="latest-blog-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- section title start -->
                <div class="section-title text-center">
                    <h2 class="title">latest blogs</h2>
                    <p class="sub-title">There are latest blog posts</p>
                </div>
                <!-- section title start -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="blog-carousel-active slick-row-10 slick-arrow-style">
                    <?php foreach($blogs as $blog): ?>
                    <!-- blog post item start -->
                    <div class="blog-post-item">
                        <figure class="blog-thumb">
                            <div class="blog-carousel-2 slick-row-15 slick-arrow-style slick-dot-style">
                                <div class="blog-single-slide">
                                    <a href="<?= make_slug("blog/".$blog->title."-".e_id($blog->id)) ?>">
                                        <?= img($blog->image) ?>
                                    </a>
                                </div>
                                <?php foreach($this->main->getall('blog_imgs', 'p_image', ['b_id' => $blog->id]) as $img): ?>
                                <div class="blog-single-slide">
                                    <a href="<?= make_slug("blog/".$blog->title."-".e_id($blog->id)) ?>">
                                        <?= img('admin/image/blog/thumb_'.$img->p_image) ?>
                                    </a>
                                </div>
                                <?php endforeach ?>
                            </div>
                        </figure>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <?= APP_NAME ?>
                            </div>
                            <h5 class="blog-title">
                                <a href="<?= make_slug("blog/".$blog->title."-".e_id($blog->id)) ?>"><?= $blog->title ?></a>
                            </h5>
                        </div>
                    </div>
                    <!-- blog post item end -->
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- latest blog area end -->
<?php endif ?>
<?php $this->load->view('why_choose') ?>