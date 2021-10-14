<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
    $total = array_sum(array_map(function($c) {
        $makec = $c['p_l_char'];
        if ($this->session->coupen_id):
           $makec = $makec * (100 - $this->session->discount) / 100;
        endif;
        return round(($c[$c['p_carat']] * $c['p_gram'] + $c['p_other'] + $makec) * $c['ca_qty'] * 1.03);
    }, $this->cart));
    $shipping = 0;
?>
<div class="checkout-page-wrapper section-padding">
    <div class="container">
        <?php if ($total > 0 && !$this->session->coupen_id): ?>
        <div class="row">
            <div class="col-12">
                <div class="checkoutaccordion" id="checkOutAccordion">
                    <div class="card">
                        <h6>Have A Gift card?</h6>
                        <div id="couponaccordion" class="collapse show" data-parent="#checkOutAccordion">
                            <div class="card-body">
                                <div class="cart-update-option">
                                    <div class="apply-coupon-wrapper">
                                        <form method="post" class="d-block d-md-flex" id="code-form" action="<?= base_url('check-code') ?>">
                                            <input type="text" placeholder="Enter Your Gift card" name="coupen_code" />
                                            <button class="btn btn-sqr">Apply Gift card</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif ?>
        <form method="post" id="checkout-form">
            <div class="row">
                <!-- Checkout Billing Details -->
                <div class="col-lg-6">
                    <div class="checkout-billing-details-wrap">
                        <h5 class="checkout-title">Billing Details</h5>
                        <div class="billing-form-wrap">
                            <div class="single-input-item">
                                <label for="street-address" class="required mt-20">Street address</label>
                                <input type="text" id="street-address" name="address" placeholder="Street address" value="<?= $this->user['u_address'] ?>" />
                            </div>
                            <div class="single-input-item">
                                <label for="town" class="required">Town / City</label>
                                <input type="text" id="town" name="city" placeholder="Town / City" value="<?= $this->user['u_city'] ?>" />
                            </div>
                            <div class="single-input-item">
                                <label for="state">State / Divition</label>
                                <input type="text" id="state" name="state" placeholder="State / Divition" value="<?= $this->user['u_state'] ?>" />
                            </div>
                            <div class="single-input-item">
                                <label for="country" class="required">Country</label>
                                <select name="country" id="country">
                                    <option value="India">India</option>
                                </select>
                            </div>
                            <div class="single-input-item">
                                <label for="postcode" class="required">Postcode / ZIP</label>
                                <input type="text" id="postcode" name="pin" placeholder="Postcode / ZIP" value="<?= $this->user['u_postcode'] ?>" />
                            </div>
                            <?php if ($total > 200000): ?>
                            <div class="single-input-item">
                                <label for="pancard" class="required">Pan No.</label>
                                <input type="text" id="pancard" name="pancard" placeholder="Pan No." maxlength="10" value="<?= $this->user['u_pancard'] ?>" />
                            </div>
                            <?php endif ?>
                            <div class="single-input-item">
                                <label for="ordernote">Order Note</label>
                                <textarea name="note" id="ordernote" cols="30" rows="3"
                                placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Order Summary Details -->
                <div class="col-lg-6">
                    <div class="order-summary-details">
                        <h5 class="checkout-title">Your Order Summary</h5>
                        <div class="order-summary-content">
                            <!-- Order Summary Table -->
                            <div class="order-summary-table table-responsive text-center">
                                <table class="table table-bordered checkout">
                                    <thead>
                                        <tr>
                                            <th>Jewellery</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($this->cart as $c): ?>
                                        <tr>
                                            <td>
                                                <?= $c['p_name'] ?> <strong> × <?= $c['ca_qty'] ?> </strong>
                                            </td>
                                            <?php
                                            $makec = $c['p_l_char'];
                                            if (isset($this->session->coupen_id)):
                                                $makec = round($makec * (100 - $this->session->discount) / 100);
                                                $disc = round($makec * (100 - $this->session->discount) / 100);
                                            endif;
                                            $shipping += $c['p_shipping'] ?>
                                            <td class="pro-subtotal"><i class="fa fa-inr" aria-hidden="true"></i> <?= round(($c[$c['p_carat']] * $c['p_gram'] + $c['p_other'] + $makec) * $c['ca_qty'] * 1.03) ?></td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td>Shipping Charge (Including GST)</td>
                                        <td class="pro-subtotal"><strong><i class="fa fa-inr" aria-hidden="true"></i> <?= $shipping = round($shipping * 1.03) ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total Amount</td>
                                        <td class="pro-subtotal"><strong><i class="fa fa-inr" aria-hidden="true"></i> <?= $total + $shipping ?></strong>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="order-payment-method">
                                <div class="summary-footer-area">
                                    <button type="submit" class="btn btn-sqr">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>