<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="login-register-wrapper section-padding">
    <div class="container">
        <div class="member-area-from-wrap">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login-reg-form-wrap">
                        <h5>Sign In</h5>
                        <form method="post" action="<?= base_url('login') ?>" id="login-form">
                            <div class="single-input-item">
                                <input type="text" placeholder="Enter Mobile" name="mobile" maxlength="10" />
                            </div>
                            <div class="single-input-item">
                                <input type="password" placeholder="Enter your Password" name="password" />
                            </div>
                            <div class="single-input-item">
                                <button class="btn btn-sqr" type="submit">Login</button>
                            </div>
                        </form>
                        <div class="single-input-item">
                            <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                <?= anchor('forgot-password', 'Forget Password?', 'class="forget-pwd"') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(!$this->session->verified): ?>
                <div class="col-lg-6">
                    <div class="login-reg-form-wrap">
                        <h5>Singup</h5>
                        <form method="post" action="<?= base_url('otp') ?>" id="otp-form">
                            <?php if($this->session->mobile_check): ?>
                            <input type="hidden" name="action" value="check_otp" />
                            <div class="single-input-item">
                                <input type="text" placeholder="Enter OTP" name="otp" maxlength="6" />
                            </div>
                            <?php else: ?>
                            <div class="single-input-item">
                                <input type="text" placeholder="Enter Mobile" name="mobile" maxlength="10" />
                            </div>
                            <?php endif ?>
                            <div class="single-input-item">
                                <button class="btn btn-sqr" type="submit"><?= $this->session->mobile_check ? 'Check OTP' : 'Send OTP' ?></button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php else: ?>
                <div class="col-lg-6">
                    <div class="login-reg-form-wrap sign-up-form">
                        <h5>Singup Form</h5>
                        <form method="post" id="signup-form" action="<?= base_url('signup') ?>">
                            <div class="row ">
                                <div class="col-12 single-input-item">
                                    <input type="text" placeholder="First Name" name="fname" />
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-12 single-input-item">
                                    <input type="text" placeholder="Middle Name" name="mname" />
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-12 single-input-item">
                                    <input type="text" placeholder="Last Name" name="lname" />
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-12 single-input-item">
                                    <input type="text" placeholder="Mobile Number" name="mobile" maxlength="10" value="<?= $this->session->verified ?>" disabled />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 single-input-item">
                                    <input type="email" placeholder="Enter your Email" name="email" />
                                </div>
                            </div>
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
                                <button class="btn btn-sqr" type="submit">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>