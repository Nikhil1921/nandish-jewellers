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
                                <input type="text" placeholder="Enter Mobile No." name="mobile" maxlength="10" />
                            </div>
                            <div class="single-input-item">
                                <input type="password" placeholder="Password" name="password" id="password" />
                            </div>

                            <div class="single-input-item">
                                        <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                            <div class="remember-meta">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="rememberMe" onclick="if(this.checked === true) document.getElementById('password').type = ('text'); else document.getElementById('password').type = ('password')">
                                                    <label class="custom-control-label" for="rememberMe">Show Password</label>
                                                </div>
                                            </div>
                                            <?= anchor('forgot-password', 'Forgot Password?', 'class="forget-pwd"') ?>
                                        </div>
                                    </div>

                            <!-- <div class="single-input-item">
                                <div class="form-group">
                                    <input type="checkbox" id="view-password" onclick="if(this.checked === true) document.getElementById('password').type = ('text'); else document.getElementById('password').type = ('password')" /> 
                                    <label for="view-password">View password</label>
                                </div>
                            </div> -->
                            
                            <div class="single-input-item">
                                <div class="row">
                                    <div class="col-4">
                                        <button class="btn btn-sqr" type="submit">Login</button>
                                    </div>
                                    <div class="col-6">
                                        <div class="single-input-item">
                                            <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php if(!$this->session->verified): ?>
                <div class="col-lg-6">
                    <div class="login-reg-form-wrap">
                        <h5>Sign up</h5>
                        <form method="post" action="<?= base_url('otp') ?>" id="otp-form">
                            <?php if($this->session->mobile_check): ?>
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
                                        <input type="password" id="password" placeholder="Enter Password" name="password" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="single-input-item">
                                        <input type="password" placeholder="Confirm Password" name="re_password" />
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