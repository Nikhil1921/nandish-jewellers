<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="fa fa-home"></i></a></li>
                            <?php if(is_array($breadcrumb_shop)): ?>
                                <?php foreach($breadcrumb_shop as $k => $tile): ?>
                                    <li class="breadcrumb-item active" aria-current="page"><?= $k == array_key_last($breadcrumb_shop) ? strip_tags($tile) : $tile ?></li>
                                <?php endforeach ?>
                            <?php else: ?>
                                <li class="breadcrumb-item active" aria-current="page"><?= ucwords($breadcrumb_shop) ?></li>
                            <?php endif ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="blog-main-wrapper section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 order-1 order-lg-1">
                <aside class="blog-sidebar-wrapper">
                    <div class="blog-sidebar">
                        <h5 class="title">categories</h5>
                        <div class="mobile-navigation1">
                            <nav>
                                <ul class="mobile-menu" style="margin-right:0px;">
                                    <?php foreach($blog_cats as $cat): ?>
                                    <li class="menu-item-has-children">
                                        <a href="<?= make_slug('blogs/'.$cat->c_name) ?>"><?= $cat->c_name ?></a>
                                        <ul class="megamenu dropdown">
                                            <?php foreach($cat->sub_cats as $subcat):
                                            ?>
                                            <li class="mega-title menu-item-has-children">
                                                <a href="<?= make_slug('blogs/'.$cat->c_name."/".$subcat->sc_name) ?>"><?= $subcat->sc_name ?></a>
                                                <ul class="dropdown">
                                                    <?php foreach($subcat->inner_cats as $inner): ?>
                                                    <li><a href="<?= make_slug('blogs/'.$cat->c_name."/".$subcat->sc_name."/".$inner->ic_name) ?>"><?= $inner->ic_name ?></a></li>
                                                    <?php endforeach ?>
                                                </ul>
                                            </li>
                                            <?php endforeach ?>
                                        </ul>
                                    </li>
                                    <?php endforeach ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </aside>
            </div>
            <div class="col-lg-9 order-2">
                <div class="top-bar-left">
                    <div class="product-view-mode">
                        <a class="active" href="javascript:void(0)" data-target="grid-view" data-toggle="tooltip"
                        title="Grid View"><i class="fa fa-th"></i></a>
                        <a href="javascript:void(0)" data-target="list-view" data-toggle="tooltip"
                        title="List View"><i class="fa fa-list"></i></a>
                    </div>
                    <div class="product-amount">
                        <?php if ($blogs): ?>
                        <p>Showing <?= $from ?>???<?= $to ?> of <?= $total ?> results</p>
                        <?php else: ?>
                            <p>No results found.</p>
                        <?php endif ?>
                    </div>
                </div>
                <?php if(isset($sub_inns)): ?>
                <div class="col-lg-12 col-md-12 col-12 pt-4 text-center">
                    <?php foreach($sub_inns as $sub_inn): ?>
                        <a class="btn btn-cart3 ml-3 mb-3" href="<?= make_slug($sub_inn->si_url) ?>" ><?= $sub_inn->si_name ?></a>
                    <?php endforeach ?>
                </div>
                <?php endif ?>
                <div class="shop-product-wrap grid-view row mbn-30">
                <?php foreach($blogs as $blog): ?>
                <div class="col-md-4 col-sm-4 col-12">
                    <div class="product-item">
                        <figure class="blog-thumb">
                                <div class="blog-carousel-2 slick-row-15 slick-arrow-style slick-dot-style">
                                    <div class="blog-single-slide">
                                        <a href="<?= make_slug("blog/".$blog['title']."-".e_id($blog['id'])) ?>">
                                            <?= img('admin/image/blog/thumb_'.$blog['image']) ?>
                                        </a>
                                    </div>
                                    <!-- <?php foreach($this->main->getall('blog_imgs', 'p_image', ['b_id' => $blog['id']]) as $img): ?>
                                    <div class="blog-single-slide">
                                        <a href="<?= make_slug("blog/".$blog['title']."-".e_id($blog['id'])) ?>">
                                            <?= img('admin/image/blog/thumb_'.$img->p_image) ?>
                                        </a>
                                    </div>
                                    <?php endforeach ?> -->
                                </div>
                            </figure>
                            <div class="product-caption text-center">
                                <h6 class="product-name">
                                <a href="<?= make_slug("blog/".$blog['title']."-".e_id($blog['id'])) ?>"></a>
                                </h6>
                                <div class="price-box">
                                    <a href="<?= make_slug("blog/".$blog['title']."-".e_id($blog['id'])) ?>"><?= $blog['title'] ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-list-item">
                            <figure class="product-thumb">
                                <a href="<?= make_slug("blog/".$blog['title']."-".e_id($blog['id'])) ?>">
                                    <?= img(['class' => "pri-img", 'src' => 'admin/image/blog/thumb_'.$blog['image'], 'alt' => "Blog"]) ?>
                                </a>
                                </figure>
                                <div class="product-content-list">
                                    <h5 class="product-name"><a href="<?= make_slug("blog/".$blog['title']."-".e_id($blog['id'])) ?>"></a></h5>
                                    <div class="price-box">
                                        <a href="<?= make_slug("blog/".$blog['title']."-".e_id($blog['id'])) ?>"><?= $blog['title'] ?></a>
                                    </div>
                                    <?= substr($blog['detail'], 0, 500); ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>
                    <?php if($this->pagination->create_links()): ?>
                    <div class="paginatoin-area text-center">
                        <?= $this->pagination->create_links() ?>
                    </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>