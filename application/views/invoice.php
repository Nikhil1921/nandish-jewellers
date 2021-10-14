<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= APP_NAME ?></title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
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
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/responsive.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/invoice.css') ?>">
  </head><body>
  <div class="container-fluid invoice-container">
    <header>
      <div class="row align-items-center">
        <div class="col-sm-7 text-center text-sm-left mb-3 mb-sm-0">
          <?= img(['id' => "logo", 'src' => 'assets/img/logo/logo.png', 'alt' => APP_NAME."Logo", 'onclick' => "window.location = 'my-account.php'"]) ?>
        </div>
        <div class="col-sm-5 text-center text-sm-right">
          <h4 class="text-7 mb-0">Invoice</h4>
        </div>
      </div>
      <hr>
    <main>
      <div class="row">
        <div class="col-sm-6"><strong>Date / Time : </strong> <?= $data['o_date'].' / '.$data['o_time']; ?></div>
        <div class="col-sm-6 text-sm-right"> <strong>Invoice No : </strong><?= $data['o_invoice']; ?></div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-6 text-sm-right order-sm-1"> <strong>Pay To:</strong>
          <address>
            <?= APP_NAME ?><br />
            Moti Bazar, Golden Complex,<br />
            Gondal-360311<br/>
            nandish.jewellers@gmail.com
          </address>
        </div>
        <div class="col-sm-6 order-sm-0"> <strong>Invoiced To:</strong>
          <address>
            <?= $this->user['u_f_name'].' '.$this->user['u_m_name'].' '.$this->user['u_l_name'] ?><br>
            <?= $this->user['u_mobile'] ?><br>
            <?= $data['o_address'].' ,'.$data['o_city'].' ,'.$data['o_state'].' ,'.$data['o_country']; ?>
          </address>
          PAN No. : <span><?= strtoupper($data['o_pancard']) ?></span>
        </div>
      </div>
      <div class="card">
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table mb-0">
              <thead class="card-header">
                <tr>
                  <td class="border-0"><strong>Jewellery</strong></td>
                  <td class="border-0"><strong>S.K.U code</strong></td>
                  <td class="border-0"><strong>Image</strong></td>
                  <td class="text-center border-0"><strong>Size</strong></td>
                  <td class="text-center border-0"><strong>Gross Weight</strong></td>
                  <td class="text-center border-0"><strong>Loss Weight</strong></td>
                  <td class="text-center border-0"><strong>Net Weight</strong></td>
                  <td class="text-center border-0"><strong>Rate</strong></td>
                  <td class="text-center border-0"><strong>Making charge</strong></td>
                  <td class="text-center border-0"><strong>Other Charge</strong></td>
                  <td class="text-center border-0"><strong>QTY</strong></td>
                  <td class="text-right border-0"><strong>GST 3%</strong></td>
                  <td class="text-right border-0"><strong>Amount</strong></td>
                </tr>
              </thead>
              <tbody>
                <?php
                $pro = json_decode($data['o_details']);
                $shipping = 0;
                foreach ($pro as $v): $shipping += $v->shipping;
                  $data_pr = $this->main->get('product', 'p_image, p_name, p_code, p_g_wei, p_l_wei, p_gram', ['p_id' => $v->prod_id]);
                  $img = explode(',', $data_pr['p_image']);
                ?>
                <tr>
                  <td class="border-0"><?= $data_pr['p_name']; ?><?= ($v->price) ? '' : ' (Pre order)' ?></td>
                  <td class="text-center border-0"><span><?= $data_pr['p_code'] ?></span></td>
                  <td class="text-center border-0"><img src="<?= base_url() ?>admin/image/product/<?= reset($img) ?>" height="100px" width="100px"></td>
                  <td class="text-center border-0"><?= $v->size; ?></td>
                  <td class="text-center border-0"><?= $data_pr['p_g_wei'] ?></td>
                  <td class="text-center border-0"><?= $data_pr['p_l_wei'] ?></td>
                  <td class="text-center border-0"><?= $data_pr['p_gram'] ?></td>
                  <td class="text-right border-0"><span><i class="fa fa-inr" aria-hidden="true"></i><?= $v->price; ?></span></td>
                  <td class="text-right border-0"><span><i class="fa fa-inr" aria-hidden="true"></i><?= $v->making; ?></span></td>
                  <td class="text-right border-0"><span><i class="fa fa-inr" aria-hidden="true"></i><?= $v->other; ?></span></td>
                  <td class="text-center border-0"><?= $v->qty; ?></td>
                  <td class="text-center border-0"><?= $v->total - $v->price - $v->making - $v->other ?></td>
                  <td class="text-center border-0"><?= $v->total; ?></td>
                </tr>
                <?php endforeach ?>
              </tbody>
              <tfoot class="card-footer">
              <tr>
                <td colspan="12" class="text-right"><strong>Sub Total : </strong></td>
                <td class="text-right"><span><i class="fa fa-inr" aria-hidden="true"></i> 
                  <?= round($data['o_total'] - $shipping) ?></span></td>
              </tr>
              <tr>
                <td colspan="12" class="text-right"><strong>Shipping Charge (Including GST) : </strong></td>
                <td class="text-right"><span><i class="fa fa-inr" aria-hidden="true"></i> 
                  <?= $shipping; ?></span></td>
              </tr>
              <tr>
                <td colspan="12" class="text-right"><strong>Total : </strong></td>
                <td class="text-right"><span><i class="fa fa-inr" aria-hidden="true"></i> <?= round($data['o_total']) ?></span></td>
              </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </main>
    <footer class="text-center mt-4">
      <p class="text-1"><strong>NOTE :</strong> This is computer generated receipt and does not require physical signature.</p>
      <div class="btn-group btn-group-sm d-print-none"> <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-print"></i> Print</a> </div>
    </footer>
  </div>
</body>
</html>