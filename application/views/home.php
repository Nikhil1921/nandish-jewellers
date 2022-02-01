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
                <div class="section-title text-center">
                    <h1 class="title">Online Jewellery Store</h1>
                </div>
                <p class="text-justify">
                    Nandish Jewellers is one of the best jewellery brands in India in terms of item collection and variety of
                    ornaments. Nandish.in has an online store with a large selection one-of-a-kind and premium-quality
                    jewellery of gold and silver jewellery in India!! Ideal the wedding for the special you with Nandish
                    jewellers unique and quality jewellery remarks incredible. Easy purchase on selected real gold, silver and
                    diamond online jewellery store. We have a maximum collection for men, women, and kids items from
                    lightweight to heavyweight range for latest and contemporary women to antique gold necklace of
                    Kundan and Polki for the bride in weddings as well. . Nandish Jewellers is one of India's most well-known
                    jewellery brands, with a reputation for customer transparency and constantly updated gold and silver
                    collections. We offer all of our branded jewellery online and are a recognized hallmarked
                    certified brand, giving us the title of the trusted online jewellery store.
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
                                    <?php if (file_exists("admin/image/product/thumb_120_".reset($img)) && !is_dir("admin/image/product/thumb_120_".reset($img))): ?>
                                    <?= img(['src' => "admin/image/product/thumb_120_".reset($img), 'alt' => $new->p_name]) ?>
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
                <div class="section-title text-center">
                    <h2 class="title">Gold Jewellery</h2>
                </div>
                <p class="text-justify">
                    In terms of item collection and diversity of ornaments, <b>Nandish.in</b> is one of India's best jewellery
                    brands.We have a customer-friendly website with a selection of gold jewellery collections for online
                    purchasing in India. So, if you're looking for something special, we're here to help you find it on our
                    website, which holds all of the renowned gold jewellery collections. You may consider our assortment to
                    be one of India's best gold shopping brands, as well as the most diverse. We believe in providing pure
                    and authentic service to our consumers, hence we provide hallmarked 22Karat (916) excellent grade
                    jewellery. From antique to contemporary jewellery, all ornaments and products are hallmarked.
                    We provide the most recent collections for men, women, and children. Men's gold jewellery designs are
                    complicated, and exquisite gents jewellery completes his faultless ensemble. We bring to you the
                    greatest selection of items. Men's gold items have the best deals and a diverse assortment of discounts.
                    Our exquisite and astonishing latest gold ornaments are attractive to today's fashion-conscious women.
                    We guarantee that we will provide you with the most up-to-date gold fashion jewellery designs for
                    ladies without sacrificing quality. The best thing is that you may take advantage of appealing discounts
                    on select female or women gold items as well as economical bridal gold jewellery. Also available are
                    exquisite pieces of jewellery for both kid boys and girls. Baby gold jewellery should be lovely and unique,
                    keeping that in mind we have special gold designs for kids that can also be used as a gift for small
                    children and newborn babies. You can buy baby jewellery online and explore our vast collection of gifts
                    for kids here. Gift real gold to your newborn baby boy and girl and make them wear flawless.
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
                                            <?php if (file_exists("admin/image/product/thumb_120_".reset($imge)) && !is_dir("admin/image/product/thumb_120_".reset($imge))): ?>
                                            <?= img(['src' => "admin/image/product/thumb_120_".reset($imge), 'alt' => $best->p_name]) ?>
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
                <div class="section-title text-center">
                    <h3 class="title">Silver Jewellery</h3>
                </div>
                <p class="text-justify">
                    <b>Nandish.in</b> is the wonderful assortment of top silver jewellery buying online is also known as Chandi ki
                    jewellery. You can discover the latest silver fashion jewellery, such as silver ornaments for women, silver
                    jewellery for men and kids. Not only that, but we also offer a huge selection of designer silver fashion
                    jewellery for bridal. This store offers a unique section for silver aficionados, and it makes our customers
                    feel a warm welcome.
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
                            <a href="<?= make_slug("blog/".$blog->title."-".e_id($blog->id)) ?>">
                                <?= img($blog->image) ?>
                            </a>
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