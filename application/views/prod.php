<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="shop-main-wrapper section-padding pb-0">
    <div class="container">
        <?php if($data): ?>
        <div class="row">
            <div class="col-lg-12 order-1 order-lg-2">
                <div class="product-details-inner">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="xzoom-container">
                            <?php
                            $imge = explode(",", $data['p_image']); ?>
                            <img class="xzoom" id="xzoom-default" src="<?= base_url('admin/image/product/'.reset($imge)) ?>" xoriginal="<?= base_url('admin/image/product/'.reset($imge)) ?>" />
                            <div class="xzoom-thumbs mt-4">
                            <?php
                            foreach ($imge as $key => $value)
                            {
                            ?>
                                <a href="<?= base_url('admin/image/product/'.$value) ?>">
                                    <img class="xzoom-gallery" width="80" height="80" src="<?= base_url('admin/image/product/thumb_120_'.$value) ?>" xpreview="<?= base_url('admin/image/product/'.$value) ?>" title="<?= $data['p_name']; ?>">
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 offset-lg-1">
                        <div class="product-details-des">
                            <div class="manufacturer-name">
                                <a href="javascript:void(0)">Nandish Jewellers</a>
                            </div>
                            <h3 class="product-name"><?= $data['p_name']; ?></h3>
                            <span>
                            S.K.U. Code - <?= $data['p_code']; ?></span>
                            <div class="price-box">
                                <span class="price-regular"><i class="fa fa-inr" aria-hidden="true"></i><?= round(($data[$data['p_carat']] * $data['p_gram'] + $data['p_other'] + $data['p_l_char']) * 1.03) ?></span>
                            </div>
                            <?= $data['p_detail'] ?>
                            <div class="quantity-cart-box d-flex align-items-center">
                                <h6 class="option-title">qty:</h6>
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" readonly="" name="qty" value="1" id="add-qty-<?= e_id($data['p_id']) ?>" />
                                    </div>
                                </div>
                                <div class="action_link">
                                    <?php
                                    $bag = ($data['p_pre']) ? 'Pre Order' : 'Add to Bag';
                                    if(!$this->user): ?>
                                        <a href="<?= front_url('login-register') ?>" class="btn btn-cart2"><?= $bag ?></a>
                                    <?php else: ?>
                                        <button class="btn btn-cart" data-p_id="<?= e_id($data['p_id']) ?>" onclick="addToCart(this)"><?= $bag ?></button>
                                    <?php endif ?>
                                </div>
                            </div>
                            <?php if($data['p_size_type'] != 0): $da = $this->main->get('size', '*', ['s_id' => $data['p_size_type']]) ?>
                            <div class="pro-size" style="display:inline-block;">
                                <div class="row mb-2">
                                    <div class="col-md-4 col-4 align-self-center pr-0">
                                        <span ><b> Size : </b></span>
                                        <?php $size = explode(',', $data['p_size']) ?>
                                        <span><b>(<?= $da['s_name']; ?>) </b></span>
                                    </div>
                                    <div class="col-md-5 col-6">
                                        <input  class="text-center" style="width: 100%;
                                            height: 40px;
                                            border: 1px solid #ddd;
                                            padding: 0 15px;
                                            border-radius: 40px;" type="text"  name="ca_size" value="<?= reset($size) ?>" id="ca_size" />
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <?php array_shift($size); ?>
                                    <?php if ($size): ?>
                                        <div class="col-md-6 col-6 align-self-center pr-0">
                                            <p>OR Select size here :</p>
                                        </div>
                                        <div class="col-md-5 col-6 pl-0">
                                            <select class="nice-select" id="ca_size_id" style="width:100%!important;">
                                                <option value="">Select size</option>
                                                <?php
                                                foreach ($size as $si): ?>
                                                <option value="<?= $si ?>"><?= $si ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                            <?php endif ?>
                            <?= form_open('check-pincode', ['method' => 'GET', 'onsubmit' => "saveData(this); return false;"]); ?>
                            <div class="pro-size" >
                                <input type="text" name="pincode" id="pincode" maxlength="6" class="form-control col-5 mr-4" placeholder="Check pincode for availibility" />
                                <input class="btn btn-cart" type="submit" value="Check" />
                            </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
                </div>
                <div class="product-details-reviews section-padding pb-0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-review-info">
                            <ul class="nav review-tab">
                                <li>
                                    <a class="active" data-toggle="tab" href="#tab_one">Details</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab_two">Invoice</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab_three">Notes</a>
                                </li>
                            </ul>
                            <div class="tab-content reviews-tab">
                            <div class="tab-pane fade show active" id="tab_one">
                                <div class="tab-one table Bill-Details">
                                    <?= $data['p_sub_detail'] ?>
                                </div>
                            </div>
                            <div class="tab-pane fade table Bill-Details" id="tab_two">
                                <table class="table table-bordered Bill-Details">
                                    <tbody>
                                        <tr>
                                        <td>Gross Weight (Grams)</td>
                                        <td><?= $data['p_g_wei'] ?></td>
                                        </tr>
                                        <tr>
                                        <td>Loss Weight (Grams)</td>
                                        <td><?= $data['p_l_wei'] ?></td>
                                        </tr>
                                        <tr>
                                        <td>Net Weight (Grams)</td>
                                        <td><?= $data['p_gram'] ?></td>
                                        </tr>
                                        <tr>
                                        <td>Rate (Per Grams)</td>
                                        <td><?= ($data[$data['p_carat']]) ?></td>
                                        </tr>
                                        <tr>
                                        <td>Making Charge (Per Grams)</td>
                                        <td><?= ($data['p_make_gram']) ? round($data['p_make_gram']) : 'NA' ?></td>
                                        </tr>
                                        <tr>
                                        <td>Other Charge</td>
                                        <td><?= ($data['p_other']) ? round($data['p_other']) : 'NA' ?></td>
                                        </tr>
                                        <tr>
                                        <td><?= $data['c_name'] ?> Price</td>
                                        <td><?= round($data['p_gram'] * $data[$data['p_carat']]) ?></td>
                                        </tr>
                                        <tr>
                                        <td>Total Making Charge</td>
                                        <td><?= round($data['p_l_char']) ?></td>
                                        </tr>
                                        <tr>
                                        <td>Taxable Value</td>
                                        <td><?= round($data[$data['p_carat']] * $data['p_gram'] + $data['p_other'] + $data['p_l_char']) ?></td>
                                        </tr>
                                        <tr>
                                        <td>G.S.T  (C.S) & (I) 3%</td>
                                        <td><?= round(($data[$data['p_carat']] * $data['p_gram'] + $data['p_other'] + $data['p_l_char']) * 0.03) ?></td>
                                        </tr>
                                        <tr>
                                        <td>Total Amount</td>
                                        <td><?= round(($data[$data['p_carat']] * $data['p_gram'] + $data['p_other'] + $data['p_l_char']) * 1.03) ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="tab_three">
                                <?= $data['p_notes'] ?>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <?php else: ?>
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                    <h2 class="title">Jewellery not available</h2>
                    <p class="sub-title text-capitalize">Sorry for the inconvenience </p>
                    </div>
                </div>
            </div>
        <?php endif ?>
   </div>
</div>
<section class="related-products section-padding">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="section-title text-center">
               <h2 class="title">Related Jewellery</h2>
               <p class="sub-title text-capitalize">Here are some more Jewellery </p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="related-product-carousel slick-row-10 slick-arrow-style">
               <?php foreach($related as $relat): $relat = (array) $relat ?>
               <div class="product-item">
                  <figure class="related-thumb">
                     <?php $imge = explode(",", $relat['p_image']); ?>
                     <a href="<?= make_slug($relat['c_name']."/".$relat['sc_name']."/".$relat['i_name']."/".$relat['si_name']."/".$relat['p_name']."-".e_id($relat['p_id'])) ?>">
                     <img class="pri-img" src="<?= base_url() ?>admin/image/product/thumb_120_<?= reset($imge) ?>" alt="Jewellery">
                     </a>
                     <div class="button-group">
                        <a href="javascript:void(0)" onclick="addWishlist(this)" data-toggle="tooltip" data-placement="left" title="Add to wishlist" data-p_id="<?= e_id($relat['p_id']) ?>">
                           <i>
                              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 455 455"  xml:space="preserve">
                                 <path d="M326.632,10.346c-38.733,0-74.991,17.537-99.132,46.92c-24.141-29.383-60.399-46.92-99.132-46.92
                                    C57.586,10.346,0,67.931,0,138.714c0,55.426,33.049,119.535,98.23,190.546c50.162,54.649,104.729,96.96,120.257,108.626l9.01,6.769
                                    l9.009-6.768c15.53-11.667,70.099-53.979,120.26-108.625C421.95,258.251,455,194.141,455,138.714
                                    C455,67.931,397.414,10.346,326.632,10.346z"/>
                              </svg>
                           </i>
                        </a>
                        <a href="javascript:void(0)" onclick="showProd(<?= e_id($relat['p_id']) ?>)"><span data-toggle="tooltip" data-placement="left" title="Quick View"><i class="pe-7s-search"></i></span>
                        </a>
                     </div>
                     <div class="cart-hover">
                        <button class="btn btn-cart" data-p_id="<?= e_id($relat['p_id']) ?>" onclick="addToCart(this)">
                           <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" class="bag1">
                              <path d="M443.209,442.24l-27.296-299.68c-0.736-8.256-7.648-14.56-15.936-14.56h-48V96c0-25.728-9.984-49.856-28.064-67.936
                                 C306.121,10.24,281.353,0,255.977,0c-52.928,0-96,43.072-96,96v32h-48c-8.288,0-15.2,6.304-15.936,14.56L68.809,442.208
                                 c-1.632,17.888,4.384,35.712,16.48,48.96S114.601,512,132.553,512h246.88c17.92,0,35.136-7.584,47.232-20.8
                                 C438.793,477.952,444.777,460.096,443.209,442.24z M319.977,128h-128V96c0-35.296,28.704-64,64-64
                                 c16.96,0,33.472,6.784,45.312,18.656C313.353,62.72,319.977,78.816,319.977,96V128z"></path>
                           </svg>
                        </button>
                     </div>
                  </figure>
                  <div class="product-caption text-center">
                     <div class="product-identity">
                        <p class="manufacturer-name"><a href="<?= make_slug($relat['c_name']."/".$relat['sc_name']."/".$relat['i_name']."/".$relat['si_name']."/".$relat['p_name']."-".e_id($relat['p_id'])) ?>"><?= $relat['i_name'] ?></a></p>
                     </div>
                     <h6 class="product-name">
                        <a href="<?= make_slug($relat['c_name']."/".$relat['sc_name']."/".$relat['i_name']."/".$relat['si_name']."/".$relat['p_name']."-".e_id($relat['p_id'])) ?>"><?= $relat['p_name'] ?></a>
                     </h6>
                     <div class="price-box">
                        <span class="price-regular"><i class="fa fa-inr" aria-hidden="true"></i><?= round(($relat[$relat['p_carat']] * $relat['p_gram'] + $relat['p_other'] + $relat['p_l_char']) * 1.03) ?></span>
                     </div>
                  </div>
               </div>
               <?php endforeach ?>
            </div>
         </div>
      </div>
   </div>
</section>
<?php $this->load->view('why_choose') ?>