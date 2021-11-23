<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="about-us section-padding">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="about-thumb">
                    <img src="<?= base_url('assets/img/about/about.png') ?>" alt="about thumb">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="about-content">
                    <div class="section-title text-center">
                        <h2 class="title"><?= $title ?></h2>
                    </div>
                </div>
                <?php if (!$data->status): ?>
                    <h5 class="about-sub-title"><?= $data->error_code ?></h5>
                    <p><?= $data->error_description ?></p>
                <?php else: ?>
                    <h5 class="about-sub-title">Payment <?= $data->status ?></h5>
                    <p>Save the payment id : <?= $data->id ?> for future use.</p>
                <?php endif ?>
            </div>
        </div>
    </div>
</section>