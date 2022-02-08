<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="login-register-wrapper section-padding">
    <div class="container">
        <div class="member-area-from-wrap">
            <div class="row">
                <?php if(!$this->session->changePassword): ?>
                <div class="col-lg-6">
                    <div class="login-reg-form-wrap">
                        <h5>Forgot Password</h5>
                        <form method="post" action="<?= front_url('forgot-password') ?>" id="otp-form">
                            <?php if($this->session->mobile_forgot): ?>
                            <input type="hidden" name="action" value="check_otp" />
                            <div class="single-input-item">
                                <input type="text" placeholder="Enter OTP" name="otp" maxlength="6" />
                            </div>
                            <?php else: ?>
                            <div class="single-input-item">
                                <input type="text" placeholder="Enter Mobile No." name="mobile" maxlength="10" />
                            </div>
                            <?php endif ?>
                            <div class="single-input-item">
                                <button class="btn btn-sqr" type="submit"><?= $this->session->mobile_forgot ? 'Check OTP' : 'Send OTP' ?></button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php else: ?>
                <div class="col-lg-12">
                    <div class="login-reg-form-wrap sign-up-form">
                        <h5>Change Password</h5>
                        <form method="post" id="signup-form" action="<?= front_url('change-password') ?>">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="single-input-item">
                                        <input type="password" id="password" placeholder="Enter your Password" name="password" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="single-input-item">
                                        <input type="password" placeholder="Repeat your Password" name="re_password" />
                                    </div>
                                </div>
                            </div>
                            <div class="single-input-item">
                                <button class="btn btn-sqr" type="submit">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>