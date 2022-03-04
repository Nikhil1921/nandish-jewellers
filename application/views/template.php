<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
/* header('Cache-Control: max-age=31536000'); */
if (!isset($cats)):
    $cats = array_map(function($arr){
        return (object) [
                'c_id' => $arr->c_id,
                'c_name' => $arr->c_name,
                'sub_cats' => array_map(function($arr){
                    return (object) [
                        'sc_id' => $arr->sc_id,
                        'sc_name' => $arr->sc_name,
                        'inner_cats' => (object) $this->main->getall('innercategory', 'i_id, i_name, i_image', ['i_sub_id' => $arr->sc_id])
                    ];
                }, $this->main->getall('subcategory', 'sc_id, sc_name', ['sc_c_id' => $arr->c_id]))
            ];
    }, $this->main->getall('category', 'c_id, c_name', []));
endif;
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
   <head>
        <meta name="google-site-verification" content="NKAEUoTpiQ-hACw9MT63YljwnaID4x8ckD3GIwBabUk" />
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <?php if(is_array($title)): ?>
            <title><?= ucwords(end($title))." | ". APP_NAME ?></title>
        <?php else: ?>
            <title><?= ucwords($title)." | ". APP_NAME ?></title>
        <?php endif ?>
        <?php if (isset($seo)):
            $e = ['general' => true, 'og' => true, 'twitter'=> true, 'robot'=> true, 'keywords' => true];
			meta_tags($e, $seo['title'], $seo['desc'], $seo['image'], $seo['url'], $seo['keywords']);
		else:
		    meta_tags();
	    endif ?>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('admin/image/logo.png') ?>">
        <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,900" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url('assets/css/vendor/bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/vendor/pe-icon-7-stroke.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/vendor/font-awesome.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/plugins/slick.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/plugins/animate.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/plugins/nice-select.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/plugins/jqueryui.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/style.css?v=1.0.3') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/custom.css?v=1.0.3') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/responsive.css?v=1.0.3') ?>">
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/xzoom.css') ?>" media="all" />
        <link rel="canonical" href="<?= current_url() ?>" />
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-MMCPFHR');</script>
        <!-- End Google Tag Manager -->
   </head>
   <body class="loading">
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MMCPFHR"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        <header class="header-area">
            <div class="main-header d-none d-lg-block">
                <div class="header-main-area sticky">
                <div class="container-fluid">
                    <div class="row align-items-center ptb-30">
                        <div class="col-lg-4">
                            <div class="header-social-link">
                            <a target="_blank" href="https://api.whatsapp.com/send?phone=<?= $this->config->item('mobile') ?>&text=Hello" target="_blank"><i class="fa fa-whatsapp"></i></a>
                            <a target="_blank" href="https://www.instagram.com/nandish.in/"><i class="fa fa-instagram"></i></a>
                            <a target="_blank" href="https://www.facebook.com/nandishjewellers/"><i class="fa fa-facebook"></i></a>
                            <a target="_blank" href="https://twitter.com/NandishJewelers"><i class="fa fa-twitter"></i></a>
                            <a target="_blank" href="https://www.linkedin.com/company/nandishjewellers"><i class="fa fa-linkedin"></i></a>
                            <a target="_blank" href="https://www.pinterest.com/nandishjewellers/"><i class="fa fa-pinterest"></i></a>
                            <a target="_blank" href="https://nandishjewellers.tumblr.com/"><i class="fa fa-tumblr"></i></a>
                            <a target="_blank" href="https://www.youtube.com/channel/UCvfGeR0YCu38rJmv4ZF1kXg"><i class="fa fa-youtube-play"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class=" logo Absolute-Center">
                            <a href="<?= base_url() ?>">
                            <?= img(['src' => 'assets/img/logo/logo.png', 'alt' => APP_NAME."Logo"]) ?>
                            </a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="header-right d-flex align-items-center justify-content-end">
                            <div class="header-configure-area">
                                <ul class="nav justify-content-end">
                                    <li class="header-search-container mr-0">
                                        <button class="search-trigger d-block"><i class="pe-7s-search"></i></button>
                                        <form class="header-search-box d-none animated jackInTheBox" action="<?= base_url() ?>">
                                        <input type="text" placeholder="Search here" name="search" class="header-search-field">
                                        <button class="header-search-btn"><i class="pe-7s-search"></i></button>
                                        </form>
                                    </li>
                                    <li>
                                        <a href="tel:<?= $this->config->item('mobile') ?>">
                                        <div class="menu-svg">
                                            <svg  xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="40px" height="45px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                                viewBox="0 43 258 261"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <defs>
                                                    <style type="text/css">
                                                    <![CDATA[
                                                        .fil0 {fill:#5f5aa5}
                                                        ]]>
                                                    </style>
                                                </defs>
                                                <g id="Layer_x0020_1">
                                                    <metadata id="CorelCorpID_0Corel-Layer"/>
                                                    <g id="_549274504">
                                                    <path  class="bag" d="M164 48l-70 0c-6,0 -12,5 -12,12l0 141c0,6 6,12 12,12l70 0c6,0 12,-6 12,-12l0 -141c0,-7 -6,-12 -12,-12zm-52 7l34 0c1,0 2,1 2,3 0,1 -1,3 -2,3l-34 0c-1,0 -2,-2 -2,-3 0,-2 1,-3 2,-3zm17 146c-4,0 -8,-3 -8,-8 0,-4 4,-7 8,-7 4,0 8,3 8,7 0,5 -4,8 -8,8zm38 -26l-76 0 0 -107 76 0 0 107z"/>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        </a>
                                    </li>
                                    <li class="user-hover">
                                        <a href="#">
                                        <div class="menu-svg">
                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 350 350" class="bag" xml:space="preserve">
                                                <g>
                                                <path d="M175,171.173c38.914,0,70.463-38.318,70.463-85.586C245.463,38.318,235.105,0,175,0s-70.465,38.318-70.465,85.587
                                                    C104.535,132.855,136.084,171.173,175,171.173z"/>
                                                <path d="M41.909,301.853C41.897,298.971,41.885,301.041,41.909,301.853L41.909,301.853z"/>
                                                <path d="M308.085,304.104C308.123,303.315,308.098,298.63,308.085,304.104L308.085,304.104z"/>
                                                <path d="M307.935,298.397c-1.305-82.342-12.059-105.805-94.352-120.657c0,0-11.584,14.761-38.584,14.761
                                                    s-38.586-14.761-38.586-14.761c-81.395,14.69-92.803,37.805-94.303,117.982c-0.123,6.547-0.18,6.891-0.202,6.131
                                                    c0.005,1.424,0.011,4.058,0.011,8.651c0,0,19.592,39.496,133.08,39.496c113.486,0,133.08-39.496,133.08-39.496
                                                    c0-2.951,0.002-5.003,0.005-6.399C308.062,304.575,308.018,303.664,307.935,298.397z"/>
                                            </svg>
                                        </div>
                                        </a>
                                        <ul class="dropdown-list">
                                        <?php if(!$this->session->user_id): ?>
                                        <li><a href="<?= front_url('login-register') ?>">login</a></li>
                                        <li><a href="<?= front_url('login-register') ?>">register</a></li>
                                        <?php else: ?>
                                        <li><a href="<?= front_url('my-account') ?>">my account</a></li>
                                        <li><a href="<?= front_url('logout') ?>">Logout</a></li>
                                        <?php endif ?>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="<?= front_url('wishlist') ?>">
                                            <div class="menu-svg">
                                                <div class="notification-nic">
                                                    <?= count($this->wishlist) ?>
                                                </div>
                                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 455 455" class="bag" xml:space="preserve">
                                                    <path d="M326.632,10.346c-38.733,0-74.991,17.537-99.132,46.92c-24.141-29.383-60.399-46.92-99.132-46.92
                                                    C57.586,10.346,0,67.931,0,138.714c0,55.426,33.049,119.535,98.23,190.546c50.162,54.649,104.729,96.96,120.257,108.626l9.01,6.769
                                                    l9.009-6.768c15.53-11.667,70.099-53.979,120.26-108.625C421.95,258.251,455,194.141,455,138.714
                                                    C455,67.931,397.414,10.346,326.632,10.346z"/>
                                                </svg>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="minicart-btn">
                                        <div class="menu-svg">
                                            <div class="notification-nic">
                                                <?= count($this->cart) ?>
                                            </div>
                                            <svg version="1.1" id="Capa_1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" class="bag">
                                                <path d="M443.209,442.24l-27.296-299.68c-0.736-8.256-7.648-14.56-15.936-14.56h-48V96c0-25.728-9.984-49.856-28.064-67.936
                                                    C306.121,10.24,281.353,0,255.977,0c-52.928,0-96,43.072-96,96v32h-48c-8.288,0-15.2,6.304-15.936,14.56L68.809,442.208
                                                    c-1.632,17.888,4.384,35.712,16.48,48.96S114.601,512,132.553,512h246.88c17.92,0,35.136-7.584,47.232-20.8
                                                    C438.793,477.952,444.777,460.096,443.209,442.24z M319.977,128h-128V96c0-35.296,28.704-64,64-64
                                                    c16.96,0,33.472,6.784,45.312,18.656C313.353,62.72,319.977,78.816,319.977,96V128z"/>
                                            </svg>
                                        </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="main-menu-area ">
                            <div class="main-menu">
                                <nav class="row desktop-menu ptb-40">
                                    <div class="col-6">
                                    <ul class="justify-content-left header-style-4">
                                        <li class="<?= $name == 'home' ? 'active' : '' ?>"><a href="<?= base_url() ?>">Home</a></li>
                                        <?php foreach($cats as $cat_data): ?>
                                        <li class="position-static">
                                            <a href="<?= make_slug($cat_data->c_name) ?>"><?= $cat_data->c_name ?><i class="fa fa-angle-down"></i></a>
                                            <ul class="megamenu dropdown">
                                                <?php foreach($cat_data->sub_cats as $sub_data): ?>
                                                <li class="mega-title">
                                                    <span><?= $sub_data->sc_name ?></span>
                                                    <ul>
                                                    <?php foreach($sub_data->inner_cats as $inn_data): ?>
                                                        <li>
                                                            <a href="<?= make_slug($cat_data->c_name."/".$sub_data->sc_name."/".$inn_data->i_name) ?>" ><?= $inn_data->i_name ?></a></li>
                                                    <?php endforeach ?>
                                                    </ul>
                                                </li>
                                                <?php endforeach ?>
                                            </ul>
                                        </li>
                                        <?php endforeach ?>
                                    </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="justify-content-end header-style-4">
                                        <li>
                                            <?php
                                                $gold = $this->main->get('category', 'c_price, c_price_22, c_price_18', ['c_name' => 'Gold']);
                                                $silver = $this->main->get('category', 'c_price, c_price_22, c_price_18', ['c_name' => 'Silver']);
                                            ?>
                                            <a href="javascript:;">Metal Rate<i class="fa fa-angle-down"></i></a>
                                            <ul class="dropdown metal-table">
                                                <li>
                                                    <table class="table-bordered metal-rate-table">
                                                    <tr class="table-header">
                                                        <td>Purity</td>
                                                        <td>Metal</td>
                                                        <td>Rate</td>
                                                    </tr>
                                                    <tr>
                                                        <td>24 Carat (999)</td>
                                                        <td>Gold 1g</td>
                                                        <td><?= $gold['c_price']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>22 Caret (916)</td>
                                                        <td>Gold 1g</td>
                                                        <td><?= $gold['c_price_22']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>18 Carat (750)</td>
                                                        <td>Gold 1g</td>
                                                        <td><?= $gold['c_price_18']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>24 Carat (999)</td>
                                                        <td>Silver 1g</td>
                                                        <td><?= $silver['c_price']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>22 Carat (925)</td>
                                                        <td> Silver 1g</td>
                                                        <td><?= $silver['c_price_22']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>18 Carat (750)</td>
                                                        <td>Silver 1g</td>
                                                        <td><?= $silver['c_price_18']; ?></td>
                                                    </tr>
                                                    </table>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="<?= $name == 'about_us' ? 'active' : '' ?>"><a href="<?= front_url('about-us') ?>">About us </a></li>
                                        <li class="<?= $name == 'contact_us' ? 'active' : '' ?>"><a href="<?= front_url('contact-us') ?>">Contact us</a></li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="mobile-header d-lg-none d-md-block sticky">
                <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="mobile-main-header">
                            <div class="mobile-menu-icon ">
                                <div class="menu-svg">
                                    <a href="tel:<?= $this->config->item('mobile') ?>">
                                        <svg  xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="20px" height="25px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                            viewBox="45 0 180 230"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <defs>
                                            <style type="text/css">
                                                <![CDATA[
                                                    .fil0 {fill:#5f5aa5}
                                                    ]]>
                                            </style>
                                            </defs>
                                            <g id="Layer_x0020_1">
                                            <metadata id="CorelCorpID_0Corel-Layer"/>
                                            <g id="_549274504">
                                                <path  class="bag" d="M164 48l-70 0c-6,0 -12,5 -12,12l0 141c0,6 6,12 12,12l70 0c6,0 12,-6 12,-12l0 -141c0,-7 -6,-12 -12,-12zm-52 7l34 0c1,0 2,1 2,3 0,1 -1,3 -2,3l-34 0c-1,0 -2,-2 -2,-3 0,-2 1,-3 2,-3zm17 146c-4,0 -8,-3 -8,-8 0,-4 4,-7 8,-7 4,0 8,3 8,7 0,5 -4,8 -8,8zm38 -26l-76 0 0 -107 76 0 0 107z"/>
                                            </g>
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                                <div class="user-hover">
                                    <a href="javascript:;">
                                        <div class="menu-svg">
                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 350 350" class="bag" xml:space="preserve">
                                            <g>
                                            <path d="M175,171.173c38.914,0,70.463-38.318,70.463-85.586C245.463,38.318,235.105,0,175,0s-70.465,38.318-70.465,85.587
                                                C104.535,132.855,136.084,171.173,175,171.173z"/>
                                            <path d="M41.909,301.853C41.897,298.971,41.885,301.041,41.909,301.853L41.909,301.853z"/>
                                            <path d="M308.085,304.104C308.123,303.315,308.098,298.63,308.085,304.104L308.085,304.104z"/>
                                            <path d="M307.935,298.397c-1.305-82.342-12.059-105.805-94.352-120.657c0,0-11.584,14.761-38.584,14.761
                                                s-38.586-14.761-38.586-14.761c-81.395,14.69-92.803,37.805-94.303,117.982c-0.123,6.547-0.18,6.891-0.202,6.131
                                                c0.005,1.424,0.011,4.058,0.011,8.651c0,0,19.592,39.496,133.08,39.496c113.486,0,133.08-39.496,133.08-39.496
                                                c0-2.951,0.002-5.003,0.005-6.399C308.062,304.575,308.018,303.664,307.935,298.397z"/>
                                            </svg>
                                        </div>
                                    </a>
                                    <ul class="dropdown-list">
                                        <?php if(!$this->session->user_id): ?>
                                        <li><a href="<?= front_url('login-register') ?>">login</a></li>
                                        <li><a href="<?= front_url('login-register') ?>">register</a></li>
                                        <?php else: ?>
                                        <li><a href="<?= front_url('my-account') ?>">my account</a></li>
                                        <li><a href="<?= front_url('logout') ?>">Logout</a></li>
                                        <?php endif ?>
                                    </ul>
                                </div>
                                <div class="mini-cart-wrap">
                                    <a href="<?= front_url('cart') ?>">
                                        <div class="menu-svg">
                                            <div class="notification-nic1">
                                                <?= count($this->cart) ?>
                                            </div>
                                            <svg version="1.1" id="Capa_1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" class="bag">
                                            <path d="M443.209,442.24l-27.296-299.68c-0.736-8.256-7.648-14.56-15.936-14.56h-48V96c0-25.728-9.984-49.856-28.064-67.936
                                                C306.121,10.24,281.353,0,255.977,0c-52.928,0-96,43.072-96,96v32h-48c-8.288,0-15.2,6.304-15.936,14.56L68.809,442.208
                                                c-1.632,17.888,4.384,35.712,16.48,48.96S114.601,512,132.553,512h246.88c17.92,0,35.136-7.584,47.232-20.8
                                                C438.793,477.952,444.777,460.096,443.209,442.24z M319.977,128h-128V96c0-35.296,28.704-64,64-64
                                                c16.96,0,33.472,6.784,45.312,18.656C313.353,62.72,319.977,78.816,319.977,96V128z"/>
                                            </svg>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="mobile-logo">
                            <a href="<?= base_url() ?>">
                            <?= img(['src' => 'assets/img/logo/logo.png', 'alt' => APP_NAME."Logo"]) ?>
                            </a>
                            </div>
                            <div class="mobile-menu-toggler">
                            <button class="mobile-menu-btn">
                            <span></span>
                            <span></span>
                            <span></span>
                            </button>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <aside class="off-canvas-wrapper">
                <div class="off-canvas-overlay"></div>
                <div class="off-canvas-inner-content">
                <div class="btn-close-off-canvas">
                    <i class="pe-7s-close"></i>
                </div>
                <div class="off-canvas-inner">
                    <div class="search-box-offcanvas">
                        <form action="<?= base_url() ?>">
                            <input type="text" placeholder="Search here" name="search">
                            <button class="search-btn"><i class="pe-7s-search"></i></button>
                        </form>
                    </div>
                    <div class="mobile-navigation">
                        <nav>
                            <ul class="mobile-menu">
                            <li><a href="<?= base_url() ?>">Home</a></li>
                            <?php foreach($cats as $cat_data): ?>
                                <li class="menu-item-has-children">
                                    <a href="<?= make_slug($cat_data->c_name) ?>"><?= $cat_data->c_name ?></a>
                                    <ul class="megamenu dropdown">
                                        <?php foreach($cat_data->sub_cats as $sub_data): ?>
                                        <li class="mega-title menu-item-has-children">
                                            <span><?= $sub_data->sc_name ?></span>
                                            <ul class="dropdown">
                                            <?php foreach($sub_data->inner_cats as $inn_data): ?>
                                                <li>
                                                    <a href="<?= make_slug($cat_data->c_name."/".$sub_data->sc_name."/".$inn_data->i_name) ?>" ><?= $inn_data->i_name ?></a></li>
                                            <?php endforeach ?>
                                            </ul>
                                        </li>
                                        <?php endforeach ?>
                                    </ul>
                                </li>
                                <?php endforeach ?>
                                <li class="menu-item-has-children">
                                    <a href="javascript:;">Metal Rate</a>
                                    <ul class="megamenu dropdown">
                                        <li class="mega-title menu-item-has-children">
                                            <table class="table-bordered metal-rate-table">
                                            <tr>
                                                <td>Purity</td>
                                                <td>Metal</td>
                                                <td>Rate</td>
                                            </tr>
                                            <tr>
                                                <td>24 Carat (999)</td>
                                                <td>Gold 1g</td>
                                                <td><?= $gold['c_price']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>22 Caret (916)</td>
                                                <td>Gold 1g</td>
                                                <td><?= $gold['c_price_22']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>18 Carat (750)</td>
                                                <td>Gold 1g</td>
                                                <td><?= $gold['c_price_18']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>24 Carat (999)</td>
                                                <td>Silver 1g</td>
                                                <td><?= $silver['c_price']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>22 Carat (925)</td>
                                                <td> Silver 1g</td>
                                                <td><?= $silver['c_price_22']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>18 Carat (750)</td>
                                                <td>Silver 1g</td>
                                                <td><?= $silver['c_price_18']; ?></td>
                                            </tr>
                                            </table>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="offcanvas-widget-area">
                        <div class="off-canvas-contact-widget">
                            <div class="mobile-settings">
                                <ul class="nav">
                                    <li>
                                        <div class="dropdown mobile-top-dropdown">
                                            <a href="#" class="dropdown-toggle" id="myaccount" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                            My Account
                                            <i class="fa fa-angle-down"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="myaccount">
                                                <?php if(!$this->session->user_id): ?>
                                                <a class="dropdown-item" href="<?= front_url('login-register') ?>">login</a>
                                                <a class="dropdown-item" href="<?= front_url('login-register') ?>">register</a>
                                                <?php else: ?>
                                                <a class="dropdown-item" href="<?= front_url('my-account') ?>">my account</a>
                                                <a class="dropdown-item" href="<?= front_url('logout') ?>">Logout</a>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a href="<?= front_url('wishlist') ?>">Wishlist</a></li>
                                    <li><a href="<?= front_url('about-us') ?>">About us</a></li>
                                    <li><a href="<?= front_url('contact-us') ?>">Contact us</a></li>
                                    <li>
                                        <span class="menu-svg">
                                            <svg  xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="25px" height="25px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                                viewBox="45 0 150 240"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <defs>
                                                <style type="text/css">
                                                    <![CDATA[
                                                        .fil0 {fill:#5f5aa5}
                                                        ]]>
                                                </style>
                                                </defs>
                                                <g id="Layer_x0020_1">
                                                <metadata id="CorelCorpID_0Corel-Layer"/>
                                                <g id="_549274504">
                                                    <path  class="bag" d="M164 48l-70 0c-6,0 -12,5 -12,12l0 141c0,6 6,12 12,12l70 0c6,0 12,-6 12,-12l0 -141c0,-7 -6,-12 -12,-12zm-52 7l34 0c1,0 2,1 2,3 0,1 -1,3 -2,3l-34 0c-1,0 -2,-2 -2,-3 0,-2 1,-3 2,-3zm17 146c-4,0 -8,-3 -8,-8 0,-4 4,-7 8,-7 4,0 8,3 8,7 0,5 -4,8 -8,8zm38 -26l-76 0 0 -107 76 0 0 107z"/>
                                                </g>
                                                </g>
                                            </svg>
                                        </span>
                                        <a href="tel:<?= $this->config->item('mobile') ?>"><?= $this->config->item('mobile') ?></a>
                                    </li>
                                    <li>
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="25px" height="30px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                                viewBox="0 0 340 343"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <polygon fill="#5f5aa5" points="151,189 111,230 160,195 "/>
                                                <polygon  fill="#5f5aa5" points="243,96 243,103 170,155 98,103 98,96 67,96 67,248 98,248 98,148 81,133 98,146 98,145 112,156 131,170 131,170 170,198 209,170 209,170 228,156 243,145 243,146 259,133 243,148 243,246 273,246 273,96 "/>
                                                <polygon  fill="#5f5aa5" points="188,190 229,230 181,195 "/>
                                                <path fill="#5f5aa5" d="M273 247l-206 0 0 -152 206 0 0 152zm-8 -144l-191 0 0 137 191 0 0 -137 0 0z"/>
                                            </svg>
                                        </span>
                                        <a href="mailto:<?= $this->config->item('email') ?>"><?= $this->config->item('email') ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="off-canvas-social-widget social-links text-center">
                            <a target="_blank" href="https://api.whatsapp.com/send?phone=<?= $this->config->item('mobile') ?>&text=Hello">
                                <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="30px" height="30px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                    viewBox="0 0 194 195"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path  d="M97 195c-54,0 -97,-43 -97,-98 0,-54 44,-98 98,-97 53,1 96,44 96,99 -1,53 -44,96 -97,96zm0 -187c-49,-1 -89,39 -89,89 -1,50 40,90 88,91 49,0 90,-39 90,-90 0,-50 -40,-90 -89,-90z"/>
                                    <path  d="M36 161c2,-5 3,-10 5,-14 2,-6 4,-11 6,-17 0,-1 0,-2 -1,-3 -5,-9 -8,-19 -8,-30 1,-30 24,-55 53,-59 32,-3 60,18 66,49 6,32 -16,64 -48,69 -13,3 -26,1 -38,-5 -1,-1 -2,-1 -4,0 -9,3 -19,6 -28,9 -1,0 -2,0 -3,1zm16 -16c6,-2 11,-3 17,-5 1,-1 2,-1 3,0 11,7 23,9 36,6 30,-5 48,-38 36,-66 -11,-28 -41,-40 -68,-27 -17,9 -27,24 -27,44 -1,10 2,20 8,29 1,1 1,1 0,2 -1,4 -2,7 -3,11 -1,2 -1,4 -2,6z"/>
                                    <path  d="M79 69c1,0 1,0 2,0 2,0 3,0 3,2 2,4 3,8 5,12 0,2 0,3 -1,4 -1,1 -2,3 -3,4 -1,1 -2,2 -1,3 5,9 12,15 21,19 1,0 2,0 3,-1 1,-2 3,-3 4,-5 1,-2 2,-2 4,-1 4,2 8,4 12,6 1,1 1,2 1,3 0,7 -4,10 -11,12 -3,1 -6,0 -9,0 -15,-5 -26,-14 -34,-27 -3,-4 -6,-8 -6,-14 -1,-6 1,-12 5,-16 2,-1 3,-2 5,-1z"/>
                                </svg>
                            </a>
                            <a target="_blank" href="https://www.instagram.com/nandish.in/">
                                <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="30px" height="30px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                    viewBox="0 0 298 301"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path  d="M149 301c-82,-1 -149,-67 -149,-152 0,-83 68,-150 151,-149 81,1 147,67 147,152 -1,82 -67,148 -149,149zm0 -289c-74,0 -136,60 -137,137 -1,78 61,139 135,140 76,1 139,-61 139,-137 0,-78 -61,-140 -137,-140z"/>
                                    <g>
                                    <path  d="M234 152c0,12 0,24 1,36 0,22 -14,39 -33,46 -6,2 -12,4 -19,4 -23,0 -46,0 -69,0 -19,-1 -34,-9 -45,-25 -4,-7 -6,-14 -6,-22 0,-26 0,-52 0,-78 1,-17 9,-30 23,-39 9,-5 19,-8 30,-8 22,0 45,0 67,0 18,1 33,8 43,22 6,8 8,16 8,25 0,13 0,26 0,39zm-158 0c0,13 0,25 0,38 0,5 1,10 3,14 8,14 20,21 36,21 22,0 44,0 67,0 6,0 11,-1 17,-3 14,-6 23,-18 23,-33 0,-25 0,-50 0,-75 0,-7 -2,-13 -6,-19 -9,-11 -20,-16 -33,-16 -23,0 -45,0 -68,0 -5,0 -10,1 -15,3 -14,5 -25,18 -24,35 0,11 0,23 0,35z"/>
                                    <path  d="M149 109c22,0 40,18 40,40 0,22 -18,40 -40,40 -22,0 -40,-18 -40,-40 0,-22 18,-40 40,-40zm27 40c0,-15 -12,-27 -27,-27 -15,0 -28,12 -28,27 0,15 13,27 28,27 15,0 27,-12 27,-27z"/>
                                    <path  d="M186 106c-1,-5 3,-9 8,-9 5,0 9,4 8,9 0,5 -4,9 -8,9 -5,0 -8,-4 -8,-9z"/>
                                </svg>
                            </a>
                            <a target="_blank" href="https://www.facebook.com/nandishjewellers/">
                                <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="30px" height="30px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                    viewBox="0 0 234 234"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path  d="M200 34c-21,-21 -51,-34 -83,-34 -32,0 -62,13 -83,34 -21,21 -34,51 -34,83 0,32 13,62 34,83 21,21 51,34 83,34 32,0 62,-13 83,-34 21,-21 34,-51 34,-83 0,-32 -13,-62 -34,-83zm-7 159c-19,20 -46,32 -76,32 -30,0 -57,-12 -76,-32 -20,-19 -32,-46 -32,-76 0,-30 12,-57 32,-76 19,-20 46,-32 76,-32 30,0 57,12 76,32 20,19 32,46 32,76 0,30 -12,57 -32,76z"/>
                                    <g id="Facebook">
                                    <path id="Facebook_1_"  d="M154 70l0 -23c-1,0 -2,0 -3,0 -2,0 -4,0 -6,0 -2,0 -5,0 -7,0 -3,0 -5,0 -7,0 -3,0 -7,0 -10,1 -3,1 -6,3 -8,5 -2,1 -3,2 -4,4 -1,0 -1,1 -2,1 -1,2 -2,5 -3,7 0,0 0,1 0,1 -1,4 -1,8 -1,12 0,1 0,1 0,2 0,7 0,18 0,18l-23 0 0 25 22 0 0 0 0 65 26 0 0 -65 23 0 3 -25 -26 0 0 -20c0,0 0,-8 7,-8l19 0z"/>
                                </svg>
                            </a>
                            <a target="_blank" href="https://twitter.com/NandishJewelers">
                                <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="30px" height="30px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                    viewBox="0 0 1519 1534"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path  d="M759 0c419,1 763,341 760,772 -2,423 -343,766 -769,762 -412,-5 -753,-342 -750,-772 2,-424 341,-760 759,-762zm0 1474c381,1 697,-309 701,-699 4,-401 -317,-712 -694,-715 -385,-3 -704,309 -706,701 -2,396 310,713 699,713z"/>
                                    <path  d="M406 675c-20,-16 -37,-32 -50,-52 -40,-63 -45,-129 -13,-197 5,-11 8,-9 15,-1 58,68 129,119 212,153 48,20 99,34 151,38 10,1 23,8 30,0 4,-5 -2,-18 -3,-28 -2,-62 18,-116 65,-159 69,-63 170,-68 246,-14 6,4 13,7 17,13 9,11 19,12 32,8 32,-9 63,-20 92,-36 3,-2 6,-3 12,-5 -15,45 -42,77 -78,105 5,-1 10,-1 16,-2 5,-1 10,-2 16,-3 20,-5 39,-11 59,-18 3,-1 6,-6 9,-1 2,3 -2,5 -3,8 -23,30 -49,57 -79,80 -6,5 -9,10 -9,19 1,137 -40,260 -125,367 -69,88 -157,149 -264,181 -62,19 -126,27 -190,24 -95,-3 -184,-30 -266,-78 -3,-2 -7,-4 -13,-9 54,5 103,2 152,-12 48,-14 93,-36 135,-69 -22,-3 -41,-6 -60,-12 -56,-20 -94,-59 -117,-113 -4,-9 -5,-12 8,-11 23,4 46,3 72,-4 -16,-8 -31,-10 -45,-18 -66,-35 -102,-90 -108,-164 -1,-12 3,-12 11,-8 17,9 35,13 53,17 5,1 12,2 20,1z"/>
                                </svg>
                            </a>
                            <br>
                            <a target="_blank" href="https://www.linkedin.com/company/nandishjewellers">
                                <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="30px" height="30px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                    viewBox="0 0 405 409"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path  d="M0 201c2,-48 16,-89 45,-125 34,-42 78,-67 132,-74 62,-8 117,10 163,53 41,38 63,85 65,141 2,60 -18,112 -61,155 -33,32 -73,52 -119,56 -64,7 -120,-13 -166,-59 -34,-34 -53,-75 -58,-123 -1,-8 -1,-17 -1,-24zm202 192c102,0 186,-82 187,-186 1,-107 -83,-190 -184,-191 -103,-1 -188,82 -189,187 -1,105 83,190 186,190z"/>
                                    <path  d="M214 185c1,1 1,0 2,-1 12,-18 30,-24 51,-22 25,4 42,20 47,47 1,5 2,11 2,17 0,29 0,57 0,86 0,2 -1,3 -4,3 -12,0 -25,0 -38,0 -3,0 -4,-1 -4,-4 0,-26 0,-52 0,-78 0,-5 0,-10 -2,-15 -2,-7 -7,-12 -15,-15 -19,-7 -39,5 -39,26 0,27 0,53 0,79 0,7 0,7 -7,7 -12,0 -23,0 -35,0 -3,0 -4,0 -4,-4 0,-46 0,-93 0,-140 0,-3 1,-3 4,-3 13,0 26,0 39,0 2,0 3,0 3,3 0,5 0,10 0,14z"/>
                                    <path  d="M95 242c0,-23 0,-46 0,-69 0,-4 1,-5 4,-5 13,1 25,1 37,0 3,0 4,1 4,4 0,47 0,93 0,140 0,3 -1,3 -4,3 -12,0 -25,0 -38,0 -3,0 -3,-1 -3,-4 0,-23 0,-46 0,-69z"/>
                                    <path  d="M93 116c0,-13 10,-23 24,-23 14,1 23,10 23,24 0,13 -10,23 -24,23 -13,0 -23,-10 -23,-24z"/>
                                </svg>
                            </a>
                            <a target="_blank" href="https://www.pinterest.com/nandishjewellers/">
                                <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="30px" height="30px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                    viewBox="0 0 3968 4006"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path  d="M1981 4006c-1101,0 -1987,-899 -1981,-2021 5,-1095 891,-1996 2006,-1985 1094,11 1974,913 1962,2025 -11,1090 -886,1979 -1987,1981zm4 -3849c-992,-4 -1818,805 -1829,1824 -12,1038 817,1859 1808,1868 1006,11 1842,-805 1848,-1830 4,-1034 -812,-1862 -1827,-1862z"/>
                                    <path  d="M2080 593c327,2 595,126 788,394 144,202 190,431 163,677 -15,144 -41,285 -96,420 -82,199 -200,369 -398,468 -173,85 -351,110 -531,15 -49,-26 -90,-61 -123,-105 -6,-7 -10,-18 -21,-16 -12,2 -9,15 -11,23 -31,132 -61,264 -94,395 -42,163 -121,310 -213,449 -17,26 -34,51 -51,76 -7,10 -16,19 -30,15 -12,-4 -14,-15 -15,-26 -28,-221 -35,-442 19,-661 49,-198 87,-399 130,-599 15,-67 31,-134 47,-201 3,-12 4,-24 -1,-35 -52,-135 -61,-272 -21,-410 29,-99 77,-186 177,-232 134,-60 271,19 287,166 9,91 -8,179 -30,267 -32,126 -78,248 -100,377 -18,111 14,204 113,264 103,61 205,41 300,-22 98,-66 158,-162 202,-268 76,-186 107,-381 95,-582 -12,-213 -98,-386 -289,-496 -80,-45 -167,-66 -257,-74 -149,-13 -293,11 -426,84 -130,71 -227,173 -294,303 -83,161 -107,333 -80,511 10,64 34,123 75,172 37,44 42,89 27,141 -9,32 -16,64 -24,96 -12,46 -41,57 -85,36 -129,-60 -204,-166 -248,-295 -72,-214 -68,-429 7,-641 87,-245 245,-432 472,-557 166,-90 346,-132 536,-129z"/>
                                </svg>
                            </a>
                            <a target="_blank" href="https://nandishjewellers.tumblr.com/">
                                <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="30px" height="30px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                    viewBox="0 0 637 642"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path  d="M637 321c-6,129 -63,227 -178,287 -115,61 -262,38 -357,-52 -57,-53 -91,-119 -100,-197 -11,-98 17,-185 85,-258 51,-56 115,-89 190,-98 98,-12 184,15 256,82 58,53 90,120 101,197 0,5 1,10 1,15 0,8 0,16 0,24 1,0 1,0 2,0zm-320 295c160,1 292,-128 294,-292 1,-167 -132,-298 -290,-299 -161,-2 -295,129 -296,293 -1,166 130,298 292,298z"/>
                                    <path  d="M432 442c2,2 1,4 1,6 0,17 0,35 0,52 0,4 -1,7 -5,9 -27,14 -56,20 -87,19 -34,-2 -63,-14 -83,-44 -9,-13 -10,-27 -10,-42 0,-50 -1,-100 -1,-150 0,-6 -2,-8 -8,-8 -9,1 -18,0 -28,1 -4,0 -5,-1 -5,-5 1,-17 1,-35 0,-52 0,-2 1,-4 3,-5 33,-13 53,-37 64,-70 4,-11 6,-22 7,-34 1,-4 3,-5 6,-5 15,0 29,0 43,0 5,0 5,3 5,6 0,31 0,62 0,93 0,5 1,6 6,6 25,0 50,0 75,0 5,0 7,1 7,6 -1,18 -1,36 0,54 0,4 -2,6 -6,6 -26,-1 -51,0 -76,-1 -5,0 -6,2 -6,7 0,39 0,77 0,116 0,6 1,11 1,17 0,25 21,36 39,36 19,1 36,-4 53,-15 1,-1 3,-2 4,-3 1,0 1,0 1,0z"/>
                                </svg>
                            </a>
                            <a target="_blank" href="https://www.youtube.com/channel/UCvfGeR0YCu38rJmv4ZF1kXg">
                                <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="30px" height="30px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                    viewBox="0 0 875 883"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path  d="M438 0c242,0 438,198 437,445 -1,242 -197,441 -443,438 -240,-3 -434,-201 -432,-446 2,-241 196,-437 438,-437zm0 35c-219,-1 -401,177 -403,402 -3,229 180,410 399,412 221,2 405,-178 406,-403 2,-229 -178,-411 -402,-411z"/>
                                    <path  d="M422 267c71,0 129,1 188,4 14,1 29,1 43,6 29,9 42,32 49,59 6,28 7,56 7,83 2,50 2,99 -4,148 -2,16 -6,32 -14,46 -11,21 -30,31 -52,34 -24,4 -48,4 -72,5 -98,4 -197,3 -295,-1 -16,-1 -33,-2 -49,-5 -24,-6 -42,-19 -51,-43 -10,-28 -11,-56 -13,-84 -2,-55 -2,-109 4,-163 2,-16 6,-31 13,-45 12,-26 35,-36 62,-38 65,-5 131,-6 184,-6zm-46 273c54,-29 107,-58 161,-88 -14,-8 -26,-15 -39,-21 -38,-21 -76,-42 -114,-63 -3,-1 -8,-6 -8,3 0,56 0,112 0,169z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                </div>
            </aside>
        </header>
        <main>
            <?php if(isset($breadcrumb)): ?>
            <div class="breadcrumb-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="breadcrumb-wrap">
                                <nav aria-label="breadcrumb">
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="fa fa-home"></i></a></li>
                                        <?php if(is_array($breadcrumb)): ?>
                                            <?php foreach($breadcrumb as $k => $tile): ?>
                                                <li class="breadcrumb-item active" aria-current="page"><?= $k == array_key_last($breadcrumb) ? ucwords($tile) : $tile ?></li>
                                            <?php endforeach ?>
                                        <?php else: ?>
                                            <li class="breadcrumb-item active" aria-current="page"><?= ucwords($breadcrumb) ?></li>
                                        <?php endif ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif ?>
            <?= $contents ?>
        </main>
        <div class="scroll-top not-visible">
            <i class="fa fa-angle-up"></i>
        </div>
        <footer class="footer-widget-area">
            <div class="footer-top section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                        <div class="widget-item">
                            <div class="widget-title">
                                <div class="widget-logo">
                                    <a href="<?= base_url() ?>">
                                    <?= img(['src' => 'assets/img/logo/logo.png', 'alt' => APP_NAME."Logo"]) ?>
                                    </a>
                                </div>
                            </div>
                            <div class="widget-body">
                                <div class="widget-item mt-3">
                                    <h6>User link</h6>
                                    <ul class="contact-block12">
                                    <?php if(!$this->session->user_id): ?>
                                    <li><a href="<?= front_url('login-register') ?>">Login</a></li>
                                    <li><a href="<?= front_url('login-register') ?>">Register</a></li>
                                    <?php else: ?>
                                    <li><a href="<?= front_url('my-account') ?>">my account</a></li>
                                    <li><a href="<?= front_url('logout') ?>">Logout</a></li>
                                    <?php endif ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                        <div class="widget-item">
                            <h6 class="widget-title">Contact Us</h6>
                            <div class="widget-body">
                                <address class="contact-block">
                                    <ul>
                                    <li class="info-list1">
                                        <a href="https://www.google.com/maps/place/Nandish+Jewellers/@21.9625882,70.7684503,13z/data=!4m5!3m4!1s0x39583898fbfc9ce7:0x28dd0230dca5a3c1!8m2!3d21.962511!4d70.8034627" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="30px" height="30px" version="1.1" viewBox="0 0 200 202" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <path  d="M115 95c5,-5 7,-10 7,-16 0,-6 -2,-11 -7,-15 -4,-4 -9,-7 -15,-7 -6,0 -11,3 -15,7 -5,4 -7,9 -7,15 0,6 2,11 7,16 4,4 9,6 15,6 6,0 11,-2 15,-6zm29 -16c0,6 -1,11 -3,15l-31 66c-2,4 -6,6 -10,6 -2,0 -4,0 -6,-1 -2,-1 -3,-3 -4,-5l-31 -66c-2,-4 -3,-9 -3,-15 0,-12 5,-22 13,-31 9,-8 19,-12 31,-12 12,0 22,4 31,12 8,9 13,19 13,31z"/>
                                            <path  d="M100 202c-55,0 -100,-45 -100,-102 0,-55 45,-101 101,-100 55,1 99,45 99,102 0,55 -45,100 -100,100zm0 -194c-50,0 -92,40 -92,92 -1,52 41,94 91,94 51,0 93,-41 93,-92 0,-52 -41,-94 -92,-94z"/>
                                        </svg></a>
                                        <a href="https://www.google.com/maps/place/Nandish+Jewellers/@21.9625882,70.7684503,13z/data=!4m5!3m4!1s0x39583898fbfc9ce7:0x28dd0230dca5a3c1!8m2!3d21.962511!4d70.8034627" target="_blank">Moti Bazar, Golden Complex,<br>Gondal-360311</a>
                                    </li>
                                    <li class="info-list1">
                                        <a href="https://www.google.com/maps/place/Nandish+Jewellers/@21.9625882,70.7684503,13z/data=!4m5!3m4!1s0x39583898fbfc9ce7:0x28dd0230dca5a3c1!8m2!3d21.962511!4d70.8034627" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="30px" height="30px" version="1.1" viewBox="0 0 200 202" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <path  d="M115 95c5,-5 7,-10 7,-16 0,-6 -2,-11 -7,-15 -4,-4 -9,-7 -15,-7 -6,0 -11,3 -15,7 -5,4 -7,9 -7,15 0,6 2,11 7,16 4,4 9,6 15,6 6,0 11,-2 15,-6zm29 -16c0,6 -1,11 -3,15l-31 66c-2,4 -6,6 -10,6 -2,0 -4,0 -6,-1 -2,-1 -3,-3 -4,-5l-31 -66c-2,-4 -3,-9 -3,-15 0,-12 5,-22 13,-31 9,-8 19,-12 31,-12 12,0 22,4 31,12 8,9 13,19 13,31z"/>
                                            <path  d="M100 202c-55,0 -100,-45 -100,-102 0,-55 45,-101 101,-100 55,1 99,45 99,102 0,55 -45,100 -100,100zm0 -194c-50,0 -92,40 -92,92 -1,52 41,94 91,94 51,0 93,-41 93,-92 0,-52 -41,-94 -92,-94z"/>
                                        </svg></a>
                                        <a href="https://www.google.com/maps/place/Nandish+Jewellers/@21.9625882,70.7684503,13z/data=!4m5!3m4!1s0x39583898fbfc9ce7:0x28dd0230dca5a3c1!8m2!3d21.962511!4d70.8034627" target="_blank">Motibazar,  Gondal, 360311 </a>
                                    </li>
                                    <li class="info-list1">
                                        <a href="mailto:<?= $this->config->item('email') ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="30px" height="30px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                            viewBox="0 0 340 343"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <polygon  points="151,189 111,230 160,195 "/>
                                            <polygon  points="243,96 243,103 170,155 98,103 98,96 67,96 67,248 98,248 98,148 81,133 98,146 98,145 112,156 131,170 131,170 170,198 209,170 209,170 228,156 243,145 243,146 259,133 243,148 243,246 273,246 273,96 "/>
                                            <polygon  points="188,190 229,230 181,195 "/>
                                            <path  d="M273 247l-206 0 0 -152 206 0 0 152zm-8 -144l-191 0 0 137 191 0 0 -137 0 0z"/>
                                            <path  d="M170 343c-94,0 -170,-77 -170,-173 0,-94 77,-171 172,-170 93,1 169,77 168,173 -1,94 -77,170 -170,170zm0 -330c-85,0 -156,69 -157,157 -1,89 71,159 155,159 86,1 158,-68 158,-156 1,-89 -69,-160 -156,-160z"/>
                                        </svg></a>
                                        <a href="mailto:<?= $this->config->item('email') ?>"><?= $this->config->item('email') ?> </a>
                                    </li>
                                    <li class="info-list1">
                                        <a href="tel:<?= $this->config->item('mobile') ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="30px" height="30px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                            viewBox="0 0 258 261"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <path  d="M164 48l-70 0c-6,0 -12,5 -12,12l0 141c0,6 6,12 12,12l70 0c6,0 12,-6 12,-12l0 -141c0,-7 -6,-12 -12,-12zm-52 7l34 0c1,0 2,1 2,3 0,1 -1,3 -2,3l-34 0c-1,0 -2,-2 -2,-3 0,-2 1,-3 2,-3zm17 146c-4,0 -8,-3 -8,-8 0,-4 4,-7 8,-7 4,0 8,3 8,7 0,5 -4,8 -8,8zm38 -26l-76 0 0 -107 76 0 0 107z"/>
                                            <path  d="M129 261c-72,0 -129,-59 -129,-131 0,-73 58,-131 131,-130 70,1 128,59 127,131 0,72 -58,129 -129,130zm0 -251c-64,0 -118,52 -119,119 -1,68 54,121 118,121 65,1 120,-52 120,-119 0,-67 -53,-121 -119,-121z"/>
                                        </svg></a>
                                        <a href="tel:<?= $this->config->item('mobile') ?>"><?= $this->config->item('mobile') ?></a>
                                    </li>
                                    </ul>
                                </address>
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="widget-item">
                                <h6 class="widget-title">Information</h6>
                                <div class="widget-body">
                                    <ul class="info-list">
                                        <li><a href="<?= front_url('about-us') ?>">about us</a></li>
                                        <li><a href="<?= front_url('contact-us') ?>">contact us</a></li>
                                        <li><a href="<?= front_url('privacy-policy') ?>">Privacy Policy</a></li>
                                        <li><a href="<?= front_url('terms-condition') ?>">Terms & Condition</a></li>
                                        <li><a href="javascript:;">Shipping & Delivery</a></li>
                                        <li><a href="javascript:;">Customer Service</a></li>
                                        <li><a href="<?= front_url('returns-refunds') ?>">Returns & Refunds</a></li>
                                        <li><a target="_blank" href="https://g.page/nandishjewellers/review?av">Write Review</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                        <div class="widget-item">
                            <h6 class="widget-title">Get Updates on</h6>
                            <div class="widget-body social-link">
                                <a target="_blank" href="https://api.whatsapp.com/send?phone=<?= $this->config->item('mobile') ?>&text=Hello">
                                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="30px" height="30px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                    viewBox="0 0 194 195"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path  d="M97 195c-54,0 -97,-43 -97,-98 0,-54 44,-98 98,-97 53,1 96,44 96,99 -1,53 -44,96 -97,96zm0 -187c-49,-1 -89,39 -89,89 -1,50 40,90 88,91 49,0 90,-39 90,-90 0,-50 -40,-90 -89,-90z"/>
                                    <path  d="M36 161c2,-5 3,-10 5,-14 2,-6 4,-11 6,-17 0,-1 0,-2 -1,-3 -5,-9 -8,-19 -8,-30 1,-30 24,-55 53,-59 32,-3 60,18 66,49 6,32 -16,64 -48,69 -13,3 -26,1 -38,-5 -1,-1 -2,-1 -4,0 -9,3 -19,6 -28,9 -1,0 -2,0 -3,1zm16 -16c6,-2 11,-3 17,-5 1,-1 2,-1 3,0 11,7 23,9 36,6 30,-5 48,-38 36,-66 -11,-28 -41,-40 -68,-27 -17,9 -27,24 -27,44 -1,10 2,20 8,29 1,1 1,1 0,2 -1,4 -2,7 -3,11 -1,2 -1,4 -2,6z"/>
                                    <path  d="M79 69c1,0 1,0 2,0 2,0 3,0 3,2 2,4 3,8 5,12 0,2 0,3 -1,4 -1,1 -2,3 -3,4 -1,1 -2,2 -1,3 5,9 12,15 21,19 1,0 2,0 3,-1 1,-2 3,-3 4,-5 1,-2 2,-2 4,-1 4,2 8,4 12,6 1,1 1,2 1,3 0,7 -4,10 -11,12 -3,1 -6,0 -9,0 -15,-5 -26,-14 -34,-27 -3,-4 -6,-8 -6,-14 -1,-6 1,-12 5,-16 2,-1 3,-2 5,-1z"/>
                                    </svg>
                                </a>
                                <a target="_blank" href="https://www.instagram.com/nandish.in/">
                                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="30px" height="30px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                    viewBox="0 0 298 301"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path  d="M149 301c-82,-1 -149,-67 -149,-152 0,-83 68,-150 151,-149 81,1 147,67 147,152 -1,82 -67,148 -149,149zm0 -289c-74,0 -136,60 -137,137 -1,78 61,139 135,140 76,1 139,-61 139,-137 0,-78 -61,-140 -137,-140z"/>
                                    <g>
                                    <path  d="M234 152c0,12 0,24 1,36 0,22 -14,39 -33,46 -6,2 -12,4 -19,4 -23,0 -46,0 -69,0 -19,-1 -34,-9 -45,-25 -4,-7 -6,-14 -6,-22 0,-26 0,-52 0,-78 1,-17 9,-30 23,-39 9,-5 19,-8 30,-8 22,0 45,0 67,0 18,1 33,8 43,22 6,8 8,16 8,25 0,13 0,26 0,39zm-158 0c0,13 0,25 0,38 0,5 1,10 3,14 8,14 20,21 36,21 22,0 44,0 67,0 6,0 11,-1 17,-3 14,-6 23,-18 23,-33 0,-25 0,-50 0,-75 0,-7 -2,-13 -6,-19 -9,-11 -20,-16 -33,-16 -23,0 -45,0 -68,0 -5,0 -10,1 -15,3 -14,5 -25,18 -24,35 0,11 0,23 0,35z"/>
                                    <path  d="M149 109c22,0 40,18 40,40 0,22 -18,40 -40,40 -22,0 -40,-18 -40,-40 0,-22 18,-40 40,-40zm27 40c0,-15 -12,-27 -27,-27 -15,0 -28,12 -28,27 0,15 13,27 28,27 15,0 27,-12 27,-27z"/>
                                    <path  d="M186 106c-1,-5 3,-9 8,-9 5,0 9,4 8,9 0,5 -4,9 -8,9 -5,0 -8,-4 -8,-9z"/>
                                    </svg>
                                </a>
                                <a target="_blank" href="https://www.facebook.com/nandishjewellers/">
                                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="30px" height="30px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                    viewBox="0 0 234 234"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path  d="M200 34c-21,-21 -51,-34 -83,-34 -32,0 -62,13 -83,34 -21,21 -34,51 -34,83 0,32 13,62 34,83 21,21 51,34 83,34 32,0 62,-13 83,-34 21,-21 34,-51 34,-83 0,-32 -13,-62 -34,-83zm-7 159c-19,20 -46,32 -76,32 -30,0 -57,-12 -76,-32 -20,-19 -32,-46 -32,-76 0,-30 12,-57 32,-76 19,-20 46,-32 76,-32 30,0 57,12 76,32 20,19 32,46 32,76 0,30 -12,57 -32,76z"/>
                                    <g id="Facebook">
                                    <path id="Facebook_1_"  d="M154 70l0 -23c-1,0 -2,0 -3,0 -2,0 -4,0 -6,0 -2,0 -5,0 -7,0 -3,0 -5,0 -7,0 -3,0 -7,0 -10,1 -3,1 -6,3 -8,5 -2,1 -3,2 -4,4 -1,0 -1,1 -2,1 -1,2 -2,5 -3,7 0,0 0,1 0,1 -1,4 -1,8 -1,12 0,1 0,1 0,2 0,7 0,18 0,18l-23 0 0 25 22 0 0 0 0 65 26 0 0 -65 23 0 3 -25 -26 0 0 -20c0,0 0,-8 7,-8l19 0z"/>
                                    </svg>
                                </a>
                                <a target="_blank" href="https://twitter.com/NandishJewelers">
                                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="30px" height="30px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                    viewBox="0 0 1519 1534"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path  d="M759 0c419,1 763,341 760,772 -2,423 -343,766 -769,762 -412,-5 -753,-342 -750,-772 2,-424 341,-760 759,-762zm0 1474c381,1 697,-309 701,-699 4,-401 -317,-712 -694,-715 -385,-3 -704,309 -706,701 -2,396 310,713 699,713z"/>
                                    <path  d="M406 675c-20,-16 -37,-32 -50,-52 -40,-63 -45,-129 -13,-197 5,-11 8,-9 15,-1 58,68 129,119 212,153 48,20 99,34 151,38 10,1 23,8 30,0 4,-5 -2,-18 -3,-28 -2,-62 18,-116 65,-159 69,-63 170,-68 246,-14 6,4 13,7 17,13 9,11 19,12 32,8 32,-9 63,-20 92,-36 3,-2 6,-3 12,-5 -15,45 -42,77 -78,105 5,-1 10,-1 16,-2 5,-1 10,-2 16,-3 20,-5 39,-11 59,-18 3,-1 6,-6 9,-1 2,3 -2,5 -3,8 -23,30 -49,57 -79,80 -6,5 -9,10 -9,19 1,137 -40,260 -125,367 -69,88 -157,149 -264,181 -62,19 -126,27 -190,24 -95,-3 -184,-30 -266,-78 -3,-2 -7,-4 -13,-9 54,5 103,2 152,-12 48,-14 93,-36 135,-69 -22,-3 -41,-6 -60,-12 -56,-20 -94,-59 -117,-113 -4,-9 -5,-12 8,-11 23,4 46,3 72,-4 -16,-8 -31,-10 -45,-18 -66,-35 -102,-90 -108,-164 -1,-12 3,-12 11,-8 17,9 35,13 53,17 5,1 12,2 20,1z"/>
                                    </svg>
                                </a>
                                <br>
                                <a target="_blank" href="https://www.linkedin.com/company/nandishjewellers">
                                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="30px" height="30px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                    viewBox="0 0 405 409"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path  d="M0 201c2,-48 16,-89 45,-125 34,-42 78,-67 132,-74 62,-8 117,10 163,53 41,38 63,85 65,141 2,60 -18,112 -61,155 -33,32 -73,52 -119,56 -64,7 -120,-13 -166,-59 -34,-34 -53,-75 -58,-123 -1,-8 -1,-17 -1,-24zm202 192c102,0 186,-82 187,-186 1,-107 -83,-190 -184,-191 -103,-1 -188,82 -189,187 -1,105 83,190 186,190z"/>
                                    <path  d="M214 185c1,1 1,0 2,-1 12,-18 30,-24 51,-22 25,4 42,20 47,47 1,5 2,11 2,17 0,29 0,57 0,86 0,2 -1,3 -4,3 -12,0 -25,0 -38,0 -3,0 -4,-1 -4,-4 0,-26 0,-52 0,-78 0,-5 0,-10 -2,-15 -2,-7 -7,-12 -15,-15 -19,-7 -39,5 -39,26 0,27 0,53 0,79 0,7 0,7 -7,7 -12,0 -23,0 -35,0 -3,0 -4,0 -4,-4 0,-46 0,-93 0,-140 0,-3 1,-3 4,-3 13,0 26,0 39,0 2,0 3,0 3,3 0,5 0,10 0,14z"/>
                                    <path  d="M95 242c0,-23 0,-46 0,-69 0,-4 1,-5 4,-5 13,1 25,1 37,0 3,0 4,1 4,4 0,47 0,93 0,140 0,3 -1,3 -4,3 -12,0 -25,0 -38,0 -3,0 -3,-1 -3,-4 0,-23 0,-46 0,-69z"/>
                                    <path  d="M93 116c0,-13 10,-23 24,-23 14,1 23,10 23,24 0,13 -10,23 -24,23 -13,0 -23,-10 -23,-24z"/>
                                    </svg>
                                </a>
                                <a target="_blank" href="https://www.pinterest.com/nandishjewellers/">
                                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="30px" height="30px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                    viewBox="0 0 3968 4006"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path  d="M1981 4006c-1101,0 -1987,-899 -1981,-2021 5,-1095 891,-1996 2006,-1985 1094,11 1974,913 1962,2025 -11,1090 -886,1979 -1987,1981zm4 -3849c-992,-4 -1818,805 -1829,1824 -12,1038 817,1859 1808,1868 1006,11 1842,-805 1848,-1830 4,-1034 -812,-1862 -1827,-1862z"/>
                                    <path  d="M2080 593c327,2 595,126 788,394 144,202 190,431 163,677 -15,144 -41,285 -96,420 -82,199 -200,369 -398,468 -173,85 -351,110 -531,15 -49,-26 -90,-61 -123,-105 -6,-7 -10,-18 -21,-16 -12,2 -9,15 -11,23 -31,132 -61,264 -94,395 -42,163 -121,310 -213,449 -17,26 -34,51 -51,76 -7,10 -16,19 -30,15 -12,-4 -14,-15 -15,-26 -28,-221 -35,-442 19,-661 49,-198 87,-399 130,-599 15,-67 31,-134 47,-201 3,-12 4,-24 -1,-35 -52,-135 -61,-272 -21,-410 29,-99 77,-186 177,-232 134,-60 271,19 287,166 9,91 -8,179 -30,267 -32,126 -78,248 -100,377 -18,111 14,204 113,264 103,61 205,41 300,-22 98,-66 158,-162 202,-268 76,-186 107,-381 95,-582 -12,-213 -98,-386 -289,-496 -80,-45 -167,-66 -257,-74 -149,-13 -293,11 -426,84 -130,71 -227,173 -294,303 -83,161 -107,333 -80,511 10,64 34,123 75,172 37,44 42,89 27,141 -9,32 -16,64 -24,96 -12,46 -41,57 -85,36 -129,-60 -204,-166 -248,-295 -72,-214 -68,-429 7,-641 87,-245 245,-432 472,-557 166,-90 346,-132 536,-129z"/>
                                    </svg>
                                </a>
                                <a target="_blank" href="https://nandishjewellers.tumblr.com/">
                                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="30px" height="30px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                    viewBox="0 0 637 642"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path  d="M637 321c-6,129 -63,227 -178,287 -115,61 -262,38 -357,-52 -57,-53 -91,-119 -100,-197 -11,-98 17,-185 85,-258 51,-56 115,-89 190,-98 98,-12 184,15 256,82 58,53 90,120 101,197 0,5 1,10 1,15 0,8 0,16 0,24 1,0 1,0 2,0zm-320 295c160,1 292,-128 294,-292 1,-167 -132,-298 -290,-299 -161,-2 -295,129 -296,293 -1,166 130,298 292,298z"/>
                                    <path  d="M432 442c2,2 1,4 1,6 0,17 0,35 0,52 0,4 -1,7 -5,9 -27,14 -56,20 -87,19 -34,-2 -63,-14 -83,-44 -9,-13 -10,-27 -10,-42 0,-50 -1,-100 -1,-150 0,-6 -2,-8 -8,-8 -9,1 -18,0 -28,1 -4,0 -5,-1 -5,-5 1,-17 1,-35 0,-52 0,-2 1,-4 3,-5 33,-13 53,-37 64,-70 4,-11 6,-22 7,-34 1,-4 3,-5 6,-5 15,0 29,0 43,0 5,0 5,3 5,6 0,31 0,62 0,93 0,5 1,6 6,6 25,0 50,0 75,0 5,0 7,1 7,6 -1,18 -1,36 0,54 0,4 -2,6 -6,6 -26,-1 -51,0 -76,-1 -5,0 -6,2 -6,7 0,39 0,77 0,116 0,6 1,11 1,17 0,25 21,36 39,36 19,1 36,-4 53,-15 1,-1 3,-2 4,-3 1,0 1,0 1,0z"/>
                                    </svg>
                                </a>
                                <a target="_blank" href="https://www.youtube.com/channel/UCvfGeR0YCu38rJmv4ZF1kXg">
                                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="30px" height="30px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                    viewBox="0 0 875 883"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path  d="M438 0c242,0 438,198 437,445 -1,242 -197,441 -443,438 -240,-3 -434,-201 -432,-446 2,-241 196,-437 438,-437zm0 35c-219,-1 -401,177 -403,402 -3,229 180,410 399,412 221,2 405,-178 406,-403 2,-229 -178,-411 -402,-411z"/>
                                    <path  d="M422 267c71,0 129,1 188,4 14,1 29,1 43,6 29,9 42,32 49,59 6,28 7,56 7,83 2,50 2,99 -4,148 -2,16 -6,32 -14,46 -11,21 -30,31 -52,34 -24,4 -48,4 -72,5 -98,4 -197,3 -295,-1 -16,-1 -33,-2 -49,-5 -24,-6 -42,-19 -51,-43 -10,-28 -11,-56 -13,-84 -2,-55 -2,-109 4,-163 2,-16 6,-31 13,-45 12,-26 35,-36 62,-38 65,-5 131,-6 184,-6zm-46 273c54,-29 107,-58 161,-88 -14,-8 -26,-15 -39,-21 -38,-21 -76,-42 -114,-63 -3,-1 -8,-6 -8,3 0,56 0,112 0,169z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="widget-item mt-3">
                            <h6 class="">Payments</h6>
                            <div class="widget-body payment-link">
                                <a href="javascript:;">
                                    <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                                    <!-- Creator: CorelDRAW X7 -->
                                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve"  version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                    viewBox="0 0 1260 501"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path d="M596 245l0 146 -46 0 0 -362 123 0c30,-1 59,11 80,31 22,20 34,48 33,77 1,29 -11,57 -33,77 -22,20 -48,31 -80,31l-77 0 0 0zm0 -171l0 126 78 0c17,1 34,-6 46,-19 25,-23 25,-63 1,-87 0,0 0,-1 -1,-1 -12,-13 -28,-20 -46,-19l-78 0 0 0zm298 61c34,0 61,9 81,28 20,18 30,43 30,75l0 153 -45 0 0 -34 -2 0c-19,28 -45,42 -77,42 -27,0 -50,-8 -68,-24 -18,-15 -28,-37 -28,-61 0,-25 10,-46 29,-61 20,-15 46,-23 78,-23 28,0 51,5 68,16l0 -11c0,-16 -7,-31 -19,-41 -12,-11 -28,-17 -45,-17 -26,0 -46,11 -62,33l-40 -26c22,-33 55,-49 100,-49l0 0zm-61 180c0,12 6,24 16,31 10,8 23,12 36,12 20,0 38,-8 52,-22 16,-14 23,-31 23,-51 -14,-12 -34,-17 -60,-17 -19,0 -35,4 -48,13 -12,10 -19,21 -19,34l0 0zm427 -172l-155 358 -48 0 58 -125 -103 -233 51 0 74 178 1 0 72 -178 50 0z"/>
                                    <path d="M408 213c0,-14 -1,-28 -4,-42l-196 0 0 80 113 0c-5,26 -20,48 -42,63l0 52 67 0c39,-36 62,-90 62,-153l0 0z"/>
                                    <path d="M208 416c56,0 104,-18 138,-50l-67 -52c-19,13 -43,20 -71,20 -54,0 -100,-37 -117,-86l-69 0 0 54c35,70 107,114 186,114z"/>
                                    <path d="M91 248c-8,-26 -8,-54 0,-80l0 -53 -69 0c-29,59 -29,128 0,187l69 -54z"/>
                                    <path d="M208 82c30,0 58,11 80,32l59 -60c-37,-35 -87,-55 -139,-54 -79,0 -151,44 -186,115l69 53c17,-49 63,-86 117,-86z"/>
                                    </svg>
                                </a>
                                <a href="javascript:;">
                                    <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                                    <!-- Creator: CorelDRAW X7 -->
                                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                    viewBox="0 0 1334 419"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path  d="M1329 123c-12,-34 -45,-59 -84,-59l0 0c-26,0 -48,10 -64,27 -17,-17 -39,-27 -64,-27l-1 0c-22,0 -43,8 -58,21l0 -6c-1,-7 -6,-13 -13,-13l-60 0c-7,0 -13,6 -13,14l0 322c0,8 6,14 13,14l60 0c6,0 12,-5 13,-12l0 -232c1,-10 8,-18 20,-19l11 0c5,0 9,2 13,4 5,5 8,11 8,18l0 230c0,8 6,14 13,14l60 0c7,0 12,-6 13,-13l0 -232c0,-7 3,-14 9,-18 3,-2 7,-3 11,-4l11 0c13,1 21,11 21,22l0 231c0,7 6,13 13,13l60 0c7,0 13,-6 13,-13l0 -250c0,-17 -2,-24 -5,-32l0 0zm-402 -56l-34 0 0 -55c0,-7 -5,-12 -12,-12 -1,0 -2,0 -2,0 -38,11 -31,63 -99,67l-7 0c-1,0 -2,0 -3,1l0 0 0 0c-6,1 -10,6 -10,12l0 60c0,7 6,13 13,13l36 0 0 252c0,7 6,13 13,13l59 0c7,0 13,-6 13,-13l0 -252 33 0c7,0 13,-6 13,-13l0 -60c0,-7 -6,-13 -13,-13l0 0zm0 0l0 0 0 0z"/>
                                    <path  d="M713 67l-59 0c-8,0 -14,6 -14,13l0 123c0,8 -6,14 -13,14l-25 0c-8,0 -14,-6 -14,-14l-1 -123c0,-7 -5,-13 -13,-13l-59 0c-7,0 -13,6 -13,13l0 135c0,51 36,88 87,88 0,0 39,0 40,0 7,1 12,7 12,14 0,7 -5,13 -12,13 0,1 0,1 -1,1l-87 0c-7,0 -13,6 -13,13l0 60c0,7 6,13 13,13l97 0c52,0 88,-37 88,-88l0 -249c0,-7 -6,-13 -13,-13l0 0zm-575 109l0 37c0,8 -7,14 -14,14l-38 0 0 -74 38 0c7,0 14,7 14,14l0 9zm5 -109l-130 0c-7,0 -13,6 -13,13l0 58c0,0 0,1 0,1 0,0 0,0 0,1l0 263c0,7 5,13 12,13l61 0c7,0 13,-6 13,-13l0 -90 57 0c47,0 81,-33 81,-81l0 -84c0,-48 -34,-81 -81,-81l0 0zm241 249l0 9c0,1 0,2 0,2 -7,1 -13,7 -13,14 0,8 6,14 14,14 8,0 14,-6 14,-14 0,-7 -6,-13 -13,-14 -2,5 -7,9 -13,9l-25 0c-8,0 -14,-6 -14,-13l0 -11c0,0 0,0 0,-1l0 -29 0 -10 0 0c0,-7 6,-13 14,-13l25 0c7,0 14,6 14,13l-3 44zm-9 -248l-83 0c-7,0 -13,5 -13,12l0 23c0,0 0,0 0,0 0,1 0,1 0,1l0 32c0,7 6,13 14,13l79 0c6,1 11,5 11,12l0 8c0,7 -5,12 -11,12l-39 0c-52,0 -88,35 -88,83l0 69c0,48 31,82 83,82l107 0c20,0 35,-15 35,-33l0 -225c0,-55 -28,-89 -95,-89l0 0z"/>
                                    </svg>
                                </a>
                                <a href="javascript:;">
                                    <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                                    <!-- Creator: CorelDRAW X7 -->
                                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                    viewBox="0 0 1367 371"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path id="ellipse30"  d="M228 5c-99,-24 -199,38 -223,138 -24,100 38,200 138,223 100,24 200,-38 223,-138 24,-99 -38,-199 -138,-223zm42 132c0,-7 -6,-13 -14,-13l-24 0 -57 -66c-6,-6 -14,-8 -22,-6l-20 6c-3,1 -4,6 -2,8l62 59 -94 0c-3,0 -5,2 -5,5l0 10c0,8 6,14 13,14l15 0 0 50c0,37 19,59 53,59 10,0 18,-1 29,-5l0 33c0,9 7,16 16,16l15 0c3,0 6,-3 6,-6l0 -148 24 0c3,0 5,-2 5,-5l0 -11zm-66 89c-7,4 -15,5 -21,5 -17,0 -25,-9 -25,-27l0 -50 46 0 0 72z"/>
                                    <path id="path32"  d="M939 292l0 -68c0,-16 -6,-25 -22,-25 -6,0 -14,1 -18,3l0 98c0,3 -3,6 -6,6l-24 0c-3,0 -6,-3 -6,-6l0 -115c0,-4 3,-7 6,-8 16,-6 31,-9 48,-9 37,0 58,20 58,56l0 77c0,3 -3,6 -6,6l-15 0c-9,0 -15,-7 -15,-15zm93 -41l-1 10c0,12 8,19 22,19 10,0 20,-3 30,-8 1,0 2,-1 3,-1 2,0 3,1 4,2 1,1 3,4 3,4 2,3 4,7 4,11 0,5 -3,10 -7,12 -11,6 -25,9 -39,9 -17,0 -30,-4 -41,-12 -10,-9 -16,-22 -16,-37l0 -41c0,-32 20,-52 56,-52 34,0 54,19 54,52l0 25c0,3 -3,6 -7,6l-65 0 0 1zm-1 -23l39 0 0 -10c0,-12 -7,-21 -19,-21 -13,0 -20,8 -20,21l0 10zm264 23l-1 10c0,12 9,19 22,19 11,0 20,-3 30,-8 1,0 2,-1 3,-1 2,0 3,1 5,2 1,1 3,4 3,4 2,3 4,7 4,11 0,5 -3,10 -7,12 -12,6 -25,9 -40,9 -16,0 -30,-4 -40,-12 -11,-9 -17,-22 -17,-37l0 -41c0,-32 21,-52 56,-52 34,0 54,19 54,52l0 25c0,3 -3,6 -6,6l-66 0 0 1zm-1 -23l40 0 0 -10c0,-12 -7,-21 -20,-21 -12,0 -20,8 -20,21l0 10zm-609 79l14 0c3,0 6,-3 6,-6l0 -77c0,-35 -18,-56 -49,-56 -10,0 -20,2 -26,4l0 -38c0,-8 -8,-15 -16,-15l-14 0c-3,0 -7,3 -7,6l0 176c0,3 4,6 7,6l24 0c3,0 6,-3 6,-6l0 -97c5,-2 12,-4 17,-4 16,0 22,8 22,25l0 68c1,7 7,14 16,14l0 0zm156 -87l0 39c0,32 -22,51 -58,51 -35,0 -58,-19 -58,-51l0 -39c0,-32 22,-52 58,-52 36,0 58,20 58,52zm-36 0c0,-12 -7,-21 -21,-21 -13,0 -21,8 -21,21l0 39c0,12 8,19 21,19 14,0 21,-7 21,-19l0 -39zm-231 -17c0,33 -25,56 -58,56 -9,0 -16,-1 -23,-5l0 47c0,3 -3,6 -6,6l-24 0c-3,0 -6,-3 -6,-6l0 -165c0,-4 3,-7 6,-8 15,-5 31,-8 47,-8 38,0 64,22 64,58l0 25zm-38 -27c0,-17 -11,-25 -27,-25 -9,0 -15,3 -15,3l0 68c6,3 9,4 16,4 16,0 27,-9 27,-24l0 -26 -1 0zm708 27c0,33 -25,56 -58,56 -9,0 -16,-1 -23,-5l0 47c0,3 -3,6 -6,6l-24 0c-3,0 -7,-3 -7,-6l0 -165c0,-4 4,-7 7,-8 15,-5 31,-8 47,-8 38,0 64,22 64,58l0 25zm-38 -27c0,-17 -11,-25 -27,-25 -9,0 -15,3 -15,3l0 68c6,3 9,4 16,4 16,0 27,-9 27,-24l0 -26 -1 0z"/>
                                    </svg>
                                </a>
                                <a href="javascript:;">
                                    <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                                    <!-- Creator: CorelDRAW X7 -->
                                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve"  version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                    viewBox="0 0 1277 353"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <polygon  points="1094,341 1277,174 1191,2 "/>
                                    <polygon  points="1033,341 1216,174 1129,2 "/>
                                    <path  d="M158 3l-77 275 274 2 75 -277 69 0 -90 322c-3,12 -16,22 -29,22l-351 0c-21,0 -33,-17 -28,-37l86 -307 71 0zm846 -1l69 0 -96 345 -71 0 98 -345zm-497 143l347 -2 23 -72 -353 0 22 -68 375 -3c23,0 37,18 31,40l-35 130c-6,22 -30,41 -54,41l-310 0 -36 142 -68 0 58 -208z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="copyright-text text-center">
                                <p class="copyright-text">&copy; 2021 Powered by 
                                    <a href="<?= base_url() ?>">
                                    <?= img(['src' => 'assets/img/about/footer.png', 'alt' => APP_NAME."Logo"]) ?>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </footer>
            <div class="offcanvas-minicart-wrapper">
                <div class="minicart-inner">
                    <div class="offcanvas-overlay"></div>
                        <div class="minicart-inner-content">
                            <div class="minicart-close">
                                <i class="pe-7s-close"></i>
                            </div>
                            <?php if ($this->cart): ?>
                            <div class="minicart-content-box">
                                <div class="minicart-item-wrapper">
                                <ul>
                                    <?php foreach ($this->cart as $data_foot): $imge = explode(",", $data_foot['p_image']) ?>
                                    <li class="minicart-item">
                                        <div class="minicart-thumb">
                                            <?= img(['src' => 'admin/image/product/thumb_120_'.reset($imge), 'alt' => "Jewellery"]) ?>
                                        </div>
                                        <div class="minicart-content">
                                            <h3 class="product-name">
                                            <?= $data_foot['p_name'] ?>
                                            </h3>
                                            <p>
                                            <span class="cart-quantity"> <?= $data_foot['ca_qty'] ?> <strong>&times;</strong>
                                            </span>
                                            <span class="cart-price">
                                            <i class="fa fa-inr" aria-hidden="true"></i> <?= round(($data_foot[$data_foot['p_carat']] * $data_foot['p_gram'] + $data_foot['p_other'] + $data_foot['p_l_char']) * 1.03) ?>
                                            </span>
                                            </p>
                                        </div>
                                    </li>
                                    <?php endforeach ?>
                                </ul>
                                </div>
                                <div class="minicart-pricing-box">
                                </div>
                                <div class="minicart-button">
                                <a href="<?= front_url('cart') ?>"><i class="fa fa-shopping-cart"></i> View Bag</a>
                                <a href="<?= front_url('checkout') ?>"><i class="fa fa-share"></i> Checkout</a>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="minicart-content-box">
                                <div class="minicart-item-wrapper">
                                <ul>
                                    <li class="minicart-item">
                                        <?= img(['src' => 'assets/img/logo/logo.png', 'alt' => APP_NAME."Logo"]) ?>
                                    </li>
                                </ul>
                                </div>
                                <div class="minicart-pricing-box text-center">
                                Your Bag is Empty.
                                </div>
                            </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal" id="quick_view">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body" id="show-prod">
                        </div>
                    </div>
                </div>
            </div>
            <div class="loader"><!-- Place at bottom of page --></div>
            <input type="hidden" id="base_url" value="<?= base_url() ?>">
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-E1DLP9MBQS"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-E1DLP9MBQS');
        </script>
        <script src="<?= base_url('assets/js/vendor/modernizr-3.6.0.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/jquery-3.3.1.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/popper.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/bootstrap.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/plugins/slick.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/plugins/countdown.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/plugins/nice-select.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/plugins/jqueryui.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/plugins/imagesloaded.pkgd.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/plugins/instagramfeed.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/plugins/ajaxchimp.js') ?>"></script>
        <script src="<?= base_url('assets/js/plugins/ajax-mail.js') ?>"></script>
        <?php if($name == 'contact_us'): ?>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfmCVTjRI007pC1Yk2o2d_EhgkjTsFVN8"></script>
            <script src="<?= base_url('assets/js/plugins/google-map.js') ?>"></script>
        <?php endif ?>
        <?php if($name == 'checkout'): ?>
            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <?php endif ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="<?= base_url('assets/js/jquery.validate.js') ?>"></script>
        <script src="<?= base_url('assets/js/main.js?v=1.0.7') ?>"></script>
        <script src="<?= base_url('assets/js/custom.js?v=1.0.7') ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/xzoom.min.js') ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/jquery.hammer.min.js') ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/setup.js') ?>"></script>
    </body>
</html>