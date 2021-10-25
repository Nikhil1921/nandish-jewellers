<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if(isset($banners)): ?>
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
<?php endif ?>
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
<div class="shop-main-wrapper section-padding">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <aside class="sidebar-wrapper">
                    <div class="sidebar-single">
                        <h5 class="sidebar-title">categories</h5>
                        <div class="mobile-navigation1">
                            <nav>
                                <ul class="mobile-menu" style="margin-right:0px;">
                                    <?php foreach($cats as $cat): ?>
                                    <li class="menu-item-has-children">
                                        <a href="<?= make_slug($cat->c_name) ?>"><?= $cat->c_name ?></a>
                                        <ul class="megamenu dropdown">
                                            <?php foreach($cat->sub_cats as $subcat):
                                            ?>
                                            <li class="mega-title menu-item-has-children">
                                                <a href="<?= make_slug($cat->c_name."/".$subcat->sc_name) ?>"><?= $subcat->sc_name ?></a>
                                                <ul class="dropdown">
                                                    <?php foreach($subcat->inner_cats as $inner): ?>
                                                    <li><a href="<?= make_slug($cat->c_name."/".$subcat->sc_name."/".$inner->i_name) ?>"><?= $inner->i_name ?></a></li>
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
            <div class="col-sm-9">
                <div class="shop-product-wrapper">
                    <div class="shop-top-bar">
                        <div class="row align-items-center">
                            <div class="col-lg-7 col-md-6 col-7">
                                <div class="top-bar-left">
                                    <div class="product-view-mode">
                                        <a class="active" href="javascript:void(0)" data-target="grid-view" data-toggle="tooltip"
                                        title="Grid View"><i class="fa fa-th"></i></a>
                                        <a href="javascript:void(0)" data-target="list-view" data-toggle="tooltip"
                                        title="List View"><i class="fa fa-list"></i></a>
                                    </div>
                                    <div class="product-amount">
                                        <?php if ($prods): ?>
                                        <p>Showing <?= $from ?>–<?= $to ?> of <?= $total ?> results</p>
                                        <?php else: ?>
                                            <p>No results found.</p>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-6 col-5">
                                <div class="top-bar-right">
                                    <div class="product-short">
                                        <p>Sort By : </p>
                                        <form id="sort-form">
                                            <?php if ($this->input->get('search') != ''): ?>
                                            <input type="hidden" name="search" value="<?= $this->input->get('search') ?>">
                                            <?php endif ?>
                                            <select class="nice-select" name="sortby" onchange="document.getElementById('sort-form').submit()">
                                                <option <?= $this->input->get('sortby') == 'latest' ? 'selected' : '' ?> value="latest">Latest</option>
                                                <option <?= $this->input->get('sortby') == 'carat_asc' ? 'selected' : '' ?> value="carat_asc">Carat Low - High</option>
                                                <option <?= $this->input->get('sortby') == 'carat_desc' ? 'selected' : '' ?> value="carat_desc">Carat High - Low</option>
                                                <option <?= $this->input->get('sortby') == 'weight_asc' ? 'selected' : '' ?> value="weight_asc">Weight Low - High</option>
                                                <option <?= $this->input->get('sortby') == 'weight_desc' ? 'selected' : '' ?> value="weight_desc">Weight High - Low</option>
                                                <option <?= $this->input->get('sortby') == 'name_asc' ? 'selected' : '' ?> value="name_asc">Name A - Z</option>
                                                <option <?= $this->input->get('sortby') == 'name_desc' ? 'selected' : '' ?> value="name_desc">Name Z - A</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shop-product-wrap grid-view row mbn-30">
                        <?php foreach($prods as $prod):
                        $imge = explode(",", $prod['p_image']);
                        ?>
                        <div class="col-md-4 col-sm-4 col-12">
                            <div class="product-item">
                                <figure class="product-thumb">
                                    <a href="<?= make_slug($prod['c_name']."/".$prod['sc_name']."/".$prod['i_name']."/".$prod['p_name']."-".e_id($prod['p_id'])) ?>">
                                        <?= img(['class' => "pri-img", 'src' => "admin/image/product/".reset($imge), 'alt' => "Jewellery"]) ?>
                                    </a>
                                    <div class="button-group">
                                        <a href="javascript:void(0)" onclick="addWishlist(this)" data-toggle="tooltip" data-placement="left" title="Add to wishlist" data-p_id="<?= e_id($prod['p_id']) ?>"><i><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 455 455"  xml:space="preserve">
                                            <path d="M326.632,10.346c-38.733,0-74.991,17.537-99.132,46.92c-24.141-29.383-60.399-46.92-99.132-46.92
                                                C57.586,10.346,0,67.931,0,138.714c0,55.426,33.049,119.535,98.23,190.546c50.162,54.649,104.729,96.96,120.257,108.626l9.01,6.769
                                                l9.009-6.768c15.53-11.667,70.099-53.979,120.26-108.625C421.95,258.251,455,194.141,455,138.714
                                                C455,67.931,397.414,10.346,326.632,10.346z"/>
                                            </svg></i></a>
                                            <a href="javascript:void(0)" onclick="showProd(<?= e_id($prod['p_id']) ?>)"><span data-toggle="tooltip" data-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                        </div>
                                        <div class="cart-hover">
                                            <button class="btn btn-cart" data-p_id="<?= e_id($prod['p_id']) ?>" onclick="addToCart(this)" data-toggle="tooltip" data-placement="left" title="Add to Bag"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" class="bag1">
                                             <path d="M443.209,442.24l-27.296-299.68c-0.736-8.256-7.648-14.56-15.936-14.56h-48V96c0-25.728-9.984-49.856-28.064-67.936
                                                C306.121,10.24,281.353,0,255.977,0c-52.928,0-96,43.072-96,96v32h-48c-8.288,0-15.2,6.304-15.936,14.56L68.809,442.208
                                                c-1.632,17.888,4.384,35.712,16.48,48.96S114.601,512,132.553,512h246.88c17.92,0,35.136-7.584,47.232-20.8
                                                C438.793,477.952,444.777,460.096,443.209,442.24z M319.977,128h-128V96c0-35.296,28.704-64,64-64
                                                c16.96,0,33.472,6.784,45.312,18.656C313.353,62.72,319.977,78.816,319.977,96V128z"></path>
                                          </svg></button>
                                        </div>
                                    </figure>
                                    <div class="product-caption text-center">
                                        <h6 class="product-name">
                                        <a href="<?= make_slug($prod['c_name']."/".$prod['sc_name']."/".$prod['i_name']."/".$prod['p_name']."-".e_id($prod['p_id'])) ?>"><?= $prod['p_name']; ?></a>
                                        </h6>
                                        <div class="price-box">
                                            <span class="price-regular"><i class="fa fa-inr" aria-hidden="true"></i><?= round(($prod[$prod['p_carat']] * $prod['p_gram'] + $prod['p_other'] + $prod['p_l_char']) * 1.03) ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-list-item">
                                    <figure class="product-thumb">
                                        <a href="<?= make_slug($prod['c_name']."/".$prod['sc_name']."/".$prod['i_name']."/".$prod['p_name']."-".e_id($prod['p_id'])) ?>">
                                            <?= img(['class' => "pri-img", 'src' => "admin/image/product/".reset($imge), 'alt' => "Jewellery"]) ?>
                                        </a>
                                        <div class="button-group">
                                            <a href="javascript:void(0)" onclick="addWishlist(this)" data-toggle="tooltip" data-placement="left" title="Add to wishlist" data-p_id="<?= e_id($prod['p_id']) ?>"><i><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                viewBox="0 0 455 455"  xml:space="preserve">
                                                <path d="M326.632,10.346c-38.733,0-74.991,17.537-99.132,46.92c-24.141-29.383-60.399-46.92-99.132-46.92
                                                    C57.586,10.346,0,67.931,0,138.714c0,55.426,33.049,119.535,98.23,190.546c50.162,54.649,104.729,96.96,120.257,108.626l9.01,6.769
                                                    l9.009-6.768c15.53-11.667,70.099-53.979,120.26-108.625C421.95,258.251,455,194.141,455,138.714
                                                    C455,67.931,397.414,10.346,326.632,10.346z"/>
                                                </svg></i></a>
                                                <a href="javascript:void(0)" onclick="showProd(<?= e_id($prod['p_id']) ?>)"><span data-toggle="tooltip" data-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                            </div>
                                            <div class="cart-hover">
                                                <button class="btn btn-cart" data-p_id="<?= e_id($prod['p_id']) ?>" onclick="addToCart(this)" data-toggle="tooltip" data-placement="left" title="Add to Bag"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" class="bag1">
                                             <path d="M443.209,442.24l-27.296-299.68c-0.736-8.256-7.648-14.56-15.936-14.56h-48V96c0-25.728-9.984-49.856-28.064-67.936
                                                C306.121,10.24,281.353,0,255.977,0c-52.928,0-96,43.072-96,96v32h-48c-8.288,0-15.2,6.304-15.936,14.56L68.809,442.208
                                                c-1.632,17.888,4.384,35.712,16.48,48.96S114.601,512,132.553,512h246.88c17.92,0,35.136-7.584,47.232-20.8
                                                C438.793,477.952,444.777,460.096,443.209,442.24z M319.977,128h-128V96c0-35.296,28.704-64,64-64
                                                c16.96,0,33.472,6.784,45.312,18.656C313.353,62.72,319.977,78.816,319.977,96V128z"></path>
                                          </svg></button>
                                            </div>
                                        </figure>
                                        <div class="product-content-list">
                                            <h5 class="product-name"><a href="<?= make_slug($prod['c_name']."/".$prod['sc_name']."/".$prod['i_name']."/".$prod['p_name']."-".e_id($prod['p_id'])) ?>"><?= $prod['p_name']; ?></a></h5>
                                            <div class="price-box">
                                                <span class="price-regular"><i class="fa fa-inr" aria-hidden="true"></i><?= round(($prod[$prod['p_carat']] * $prod['p_gram'] + $prod['p_other'] + $prod['p_l_char']) * 1.03) ?></span>
                                            </div>
                                            <p></p>
                                            <?= $prod['p_detail']; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach ?>
                            </div>
                            <div class="paginatoin-area text-center">
                                <?= $this->pagination->create_links() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>