<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="cart-main-wrapper section-padding">
    <div class="container">
        <div class="section-bg-color">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="pro-thumbnail">Thumbnail</th>
                                    <th class="pro-title">Jewellery</th>
                                    <th class="pro-quantity">Quantity</th>
                                    <th class="pro-subtotal">Price</th>
                                    <th class="pro-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                if ($this->cart):
                                    foreach($this->cart as $cart):
                                    $imge = explode(",", $cart['p_image']);
                                    $total += round(($cart[$cart['p_carat']] * $cart['p_gram'] + $cart['p_other'] + $cart['p_l_char']) * $cart['ca_qty'] * 1.03);
                                ?>
                                <tr>
                                    <td class="pro-thumbnail">
                                        <a href="<?= make_slug($cart['c_name']."/".$cart['sc_name']."/".$cart['i_name']."/".$cart['si_name']."/".$cart['p_name']."-".e_id($cart['p_id'])) ?>">
                                        <img class="img-fluid" src="<?= base_url() ?>admin/image/product/thumb_120_<?= $imge[0] ?>" alt="Jewellery" />
                                        </a>
                                    </td>
                                    <td class="pro-title"><a href="<?= make_slug($cart['c_name']."/".$cart['sc_name']."/".$cart['i_name']."/".$cart['si_name']."/".$cart['p_name']."-".e_id($cart['p_id'])) ?>"><?= $cart['p_name'] ?></a></td>
                                    <td class="pro-quantity">
                                        <div class="pro-qty">
                                            <input type="text" readonly="" data-id="<?= e_id($cart['ca_id']) ?>" value="<?= $cart['ca_qty'] ?>" />
                                        </div>
                                    </td>
                                    <td class="pro-subtotal"><span><i class="fa fa-inr" aria-hidden="true"></i> <?= round(($cart[$cart['p_carat']] * $cart['p_gram'] + $cart['p_other'] + $cart['p_l_char']) * $cart['ca_qty'] * 1.03) ?></span></td>
                                    <td class="pro-remove">
                                        <a class="delete-cart btn btn-cart2" data-id="<?= e_id($cart['ca_id']) ?>"><i class="fa fa-trash-o"></i></a></td>
                                    </tr>
                                    <?php endforeach;
                                    else: ?>
                                    <tr>
                                        <td class="pro-title" colspan="5">
                                            Your Bag is Empty.
                                        </td>
                                    </tr>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php if ($this->cart): ?>
                <div class="row">
                    <div class="col-lg-5 ml-auto">
                        <div class="cart-calculator-wrapper">
                            <div class="cart-calculate-items">
                                <h6>Cart Totals</h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr class="total">
                                            <td>Total</td>
                                            <td class="total-amount"><i class="fa fa-inr" aria-hidden="true"></i><?= $total ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <a href="<?= front_url('checkout') ?>" class="btn btn-sqr d-block">Proceed Checkout</a>
                        </div>
                    </div>
                </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>