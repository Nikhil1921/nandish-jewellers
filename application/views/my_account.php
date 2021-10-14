<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="my-account-wrapper section-padding">
   <div class="container">
      <div class="section-bg-color">
         <div class="row">
            <div class="col-lg-12">
               <div class="myaccount-page-wrapper">
                  <div class="row">
                     <div class="col-lg-3 col-md-4">
                        <div class="myaccount-tab-menu nav" role="tablist">
                           <a href="#dashboad" class="active" data-toggle="tab"><i
                              class="fa fa-dashboard"></i>
                           Dashboard</a>
                           <a href="#orders" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i>Complete
                           Orders</a>
                           <a href="#account-info" data-toggle="tab"><i class="fa fa-user"></i> Account
                           Details</a>
                           <a href="<?= front_url('logout') ?>"><i class="fa fa-sign-out"></i> Logout</a>
                        </div>
                     </div>
                     <div class="col-lg-9 col-md-8">
                        <div class="tab-content" id="myaccountContent">
                           <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                              <div class="myaccount-content">
                                 <h5>Dashboard</h5>
                                 <div class="myaccount-table table-responsive text-center">
                                    <table class="table table-bordered">
                                       <thead class="thead-light">
                                          <tr>
                                             <th>Order</th>
                                             <th>Date / Time</th>
                                             <th>Status</th>
                                             <th>Total</th>
                                             <th>Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php $i = 1;
                                             if ($orders): foreach ($orders as $data): $data = (array) $data; if(!in_array($data['o_status'], [0, 1])) continue; ?>
                                          <tr>
                                             <td><?= $i++ ?></td>
                                             <td><?= $data['o_date'].' / '.$data['o_time']; ?></td>
                                             <td><?= $data['o_status'] == 0 ? "Pending" : "Confirm" ?></td>
                                             <td><i class="fa fa-inr" aria-hidden="true"></i><?= $data['o_total'] ?></td>
                                             <td>
                                                <a href="<?= base_url('invoice/'.e_id($data['o_id'])) ?>" class="btn btn-sqr">View</a>
                                                <?php if($data['o_status'] == 0): ?>
                                                <a href="javascript:;" id="<?= e_id($data['o_id']) ?>" onclick="cancelOrder(this)" class="btn btn-sqr">Cancel</a>
                                                <?php endif ?>
                                             </td>
                                          </tr>
                                          <?php endforeach ?>
                                          <?php if ($i == 1): ?>
                                          <tr>
                                             <td colspan="5">No orders available.</td>
                                          </tr>
                                          <?php endif ?>
                                          <?php else: ?>
                                          <tr>
                                             <td colspan="5">No orders available.</td>
                                          </tr>
                                          <?php endif ?>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                           <div class="tab-pane fade" id="orders" role="tabpanel">
                              <div class="myaccount-content">
                                 <h5>Orders</h5>
                                 <div class="myaccount-table table-responsive text-center">
                                    <table class="table table-bordered">
                                       <thead class="thead-light">
                                          <tr>
                                             <th>Order</th>
                                             <th>Date / Time</th>
                                             <th>Status</th>
                                             <th>Total</th>
                                             <th>Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php $i = 1; if ($orders): foreach ($orders as $data): $data = (array) $data; if($data['o_status'] == 2): ?>
                                          <tr>
                                             <td><?= $i++; ?></td>
                                             <td><?= $data['o_date'].' / '.$data['o_time']; ?></td>
                                             <td>Completed</td>
                                             <td><i class="fa fa-inr" aria-hidden="true"></i><?= $data['o_total'] ?></td>
                                             <td>
                                                <a href="<?= base_url('invoice/'.e_id($data['o_id'])) ?>" class="btn btn-sqr">View</a>
                                                <?php if($data['o_return'] == 0): ?>
                                                <a href="javascript:;" id="<?= e_id($data['o_id']) ?>" onclick="returnOrder(this)" class="btn btn-sqr">Return</a>
                                                <?php endif ?>
                                             </td>
                                          </tr>
                                          <?php else: continue ?>
                                          <?php endif ?>
                                          <?php endforeach ?>
                                          <?php if ($i == 1): ?>
                                          <tr>
                                             <td colspan="5">No orders available.</td>
                                          </tr>
                                          <?php endif ?>
                                          <?php else: ?>
                                          <tr>
                                             <td colspan="5">No orders available.</td>
                                          </tr>
                                          <?php endif ?>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                           <div class="tab-pane fade" id="account-info" role="tabpanel">
                              <div class="myaccount-content">
                                 <h5>Account Details</h5>
                                 <div class="account-details-form">
                                    <form method="post" id="signup-form" action="<?= base_url('update-profile') ?>">
                                       <div class="row ">
                                          <div class="col-12 single-input-item">
                                             <input type="text" placeholder="First Name" required name="fname" value="<?= $this->user['u_f_name'] ?>" />
                                          </div>
                                       </div>
                                       <div class="row ">
                                          <div class="col-12 single-input-item">
                                             <input type="text" placeholder="Middle Name" required name="mname" value="<?= $this->user['u_m_name'] ?>" />
                                          </div>
                                       </div>
                                       <div class="row ">
                                          <div class="col-12 single-input-item">
                                             <input type="text" placeholder="Last Name" required name="lname" value="<?= $this->user['u_l_name'] ?>" />
                                          </div>
                                       </div>
                                       <div class="row ">
                                          <div class="col-12 single-input-item">
                                             <input type="text" placeholder="Mobile Number" required name="mobile" value="<?= $this->user['u_mobile'] ?>" maxlength="10" />
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-12 single-input-item">
                                             <input type="email" placeholder="Enter your Email" required name="email" value="<?= $this->user['u_email'] ?>" />
                                          </div>
                                       </div>
                                       <div class="row ">
                                          <div class="col-12 single-input-item">
                                              <input type="text" placeholder="Address" required name="address" value="<?= $this->user['u_address'] ?>" />
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-lg-12">
                                             <div class="single-input-item">
                                                <input type="password" class="ignore" placeholder="Enter your Password" name="password" />
                                             </div>
                                          </div>
                                       </div>
                                       <div class="single-input-item">
                                          <div class="login-reg-form-meta">
                                             <div class="remember-meta">
                                                <div class="custom-control custom-checkbox">
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="single-input-item">
                                          <button class="btn btn-sqr" type="submit">Save The Changes</button>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>