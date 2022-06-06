<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if ($data): ?>
<div class="product-details-inner">
   <div class="row">
      <?php $imge = explode(",", $data['p_image']); ?>
      <div class="col-lg-5">
         <div class="product-large-slider-new">
            <?php foreach ($imge as $img): ?>
            <div class="pro-large-img img-zoom">
               <img src="<?= base_url() ?>admin/image/product/<?= $img ?>" alt="Jewellery details" />
            </div>
            <?php endforeach ?>
         </div>
         <div class="pro-nav-new slick-row-10 slick-arrow-style">
            <?php foreach ($imge as $img): ?>
            <div class="pro-nav-thumb">
               <img src="<?= base_url() ?>admin/image/product/thumb_120_<?= $img ?>" alt="Jewellery details" />
            </div>
            <?php endforeach ?>
         </div>
      </div>
      <div class="col-lg-7">
         <div class="product-details-des">
            <div class="manufacturer-name">
               <a href="javascript:void(0)">Nandish Jewellers</a>
            </div>
            <h3 class="product-name"><?= $data['p_name']; ?></h3>
            <div class="ratings d-flex">
               <?php for($i = 0; $i < ceil($rate['rating']); $i++): ?>
                  <span><i class="fa fa-star-o"></i></span>
               <?php endfor ?>
               <div class="pro-review">
                  <span><?= $rate['reviews'] ?> Reviews</span>
               </div>
            </div>
            <span>S.K.U. Code - <?= $data['p_code']; ?></span>
            <div class="price-box">
               <span class="price-regular">
                  <?php 
                  $original = round(($data[$data['p_carat']] * $data['p_gram'] + $data['p_other'] + $data['p_l_char']) * 1.03);
                  if(isset($code)):
                  $discount = round($data['p_l_char'] * $code['co_par'] / 100); ?>
                  <i class="fa fa-inr" aria-hidden="true"></i> 
                  <span class="text-dark"><b><?= $original - $discount ?></b></span>
                  <br><br>
                  <del><i class="fa fa-inr" aria-hidden="true"></i>
                  <span class="text-dark"><b><?= $original ?></span>
                  </del>
                  &nbsp; <strong class="text-dark">You save</strong>&nbsp; <i class="fa fa-inr" aria-hidden="true"></i> <span class="text-dark"><b><?= $discount ?></span>
                  <br>
                  <br>
                  <span class="text-dark">(<?= $code['co_par'] ?> % Discount on making charge Apply code <?= $code['co_code'] ?>)</span>
                  <?php else: ?>
                        <i class="fa fa-inr" aria-hidden="true"></i><?= $original ?>
                  <?php endif ?>
               </span>
            </div>
            <p class="pro-desc"><?= $data['p_detail'] ?></p>
            <div class="quantity-cart-box d-flex align-items-center">
                <h6 class="option-title">qty:</h6>
                <div class="quantity">
                    <div class="pro-qty pro-new"><input type="text" value="1" id="add-qty-<?= $data['p_id'] ?>" /></div>
                </div>
                <div class="action_link">
                    <?php
                    $bag = ($data['p_pre']) ? 'Pre Order' : 'Add to Bag';
                    if(!$this->user): ?>
                        <a href="<?= front_url('login-register') ?>" class="btn btn-cart2"><?= $bag ?></a>
                    <?php else: ?>
                        <button class="btn cart_btnn cart-btn btn-cart" data-p_id="<?= e_id($data['p_id']) ?>" onclick="addToCart(this)"><?= $bag ?></button>
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
                     <input  class="text-center" style="width: 100%; height: 40px; border: 1px solid #ddd; padding: 0 15px; border-radius: 40px;" type="text"  name="ca_size" value="<?= reset($size) ?>" id="ca_size" />
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
               <input type="text" name="pincode" id="pincode" maxlength="6" class="form-control col-md-3 col-sm-4 col-5 mr-4" placeholder="Check pincode" />
               <input class="btn quick_view btn-cart" type="submit" value="Check" />
            </div>
            <?= form_close(); ?>
            <!-- <div class="useful-links">
               <a href="javascript:void(0)" onclick="addWishlist(this)" data-toggle="tooltip" data-placement="left" title="Add to wishlist" data-p_id="<?= $data['p_id'] ?>">
                  <i>
                     <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 455 455"  xml:space="preserve">
                        <path d="M326.632,10.346c-38.733,0-74.991,17.537-99.132,46.92c-24.141-29.383-60.399-46.92-99.132-46.92
                           C57.586,10.346,0,67.931,0,138.714c0,55.426,33.049,119.535,98.23,190.546c50.162,54.649,104.729,96.96,120.257,108.626l9.01,6.769
                           l9.009-6.768c15.53-11.667,70.099-53.979,120.26-108.625C421.95,258.251,455,194.141,455,138.714
                           C455,67.931,397.414,10.346,326.632,10.346z"/>
                     </svg>
                  </i>
                  wishlist
               </a>
            </div> -->
         </div>
      </div>
   </div>
</div>
<?php else: ?>
<div class="text-center">
   Jewellery not available.
</div>
<?php endif; ?>