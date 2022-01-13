<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="wishlist-main-wrapper section-padding">
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
                                    <th class="pro-price">Price</th>
                                    <th class="pro-quantity">Quantity</th>
                                    <th class="pro-subtotal">Add to Cart</th>
                                    <th class="pro-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($this->wishlist):
                                foreach ($this->wishlist as $data):
                                $imge = explode(",", $data['p_image']);
                                ?>
                                <tr>
                                    <td class="pro-thumbnail">
                                        <a href="<?= make_slug($data['c_name']."/".$data['sc_name']."/".$data['i_name']."/".$data['si_name']."/".$data['p_name']."-".e_id($data['p_id'])) ?>">
                                            <img class="img-fluid" src="<?= base_url() ?>admin/image/product/<?= reset($imge) ?>" alt="Jewellery" />
                                        </a>
                                    </td>
                                    <td class="pro-title">
                                        <a href="<?= make_slug($data['c_name']."/".$data['sc_name']."/".$data['i_name']."/".$data['si_name']."/".$data['p_name']."-".e_id($data['p_id'])) ?>"><?= $data['p_name'] ?></a>
                                    </td>
                                    <td class="pro-price">
                                        <span>
                                            <i class="fa fa-inr" aria-hidden="true"></i><?= round(($data[$data['p_carat']] * $data['p_gram'] + $data['p_other'] + $data['p_l_char']) * 1.03) ?>
                                        </span>
                                    </td>
                                    <td class="pro-quantity">
                                        <div class="pro-qty">
                                            <input type="text" name="qty" id="add-qty-<?= e_id($data['p_id']) ?>" value="1">
                                        </div>
                                    </td>
                                    <td class="pro-subtotal">
                                        <button type="button" data-p_id="<?= e_id($data['p_id']) ?>" onclick="addToCart(this)" class="btn btn-cart2">Add to Bag</button>
                                    </td>
                                    <td class="pro-remove">
                                        <a class="delete-wish btn btn-cart2" data-id="<?= e_id($data['w_id']) ?>"><i class="fa fa-trash-o"></i></a></td>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="6">
                                        Your wishlist is empty.
                                    </td>
                                </tr>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>