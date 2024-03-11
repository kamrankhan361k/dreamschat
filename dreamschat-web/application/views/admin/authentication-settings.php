<?php $this->load->view('admin/includes/header'); ?>

<?php $this->load->view('admin/includes/adminheader'); ?>

<?php $this->load->view('admin/includes/rightsidebar'); ?>

<!-- Page Wrapper -->
<div class="page-wrapper profile-set-wrapper">

    <div class="content container-fluid profile-set-content">
        <div class="page-header">
            <div class="page-title">
                <h4>Authentication Setting</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12">

                
                <div class="noti-header">
                    <div class="auth-set-content local-wrapper d-flex align-items-center justify-content-between">
                        <div class="local-set-head">
                            <h6>Allow Registration</h6>
                        </div>                                    
                        <div class="active-switch">
                            <label class="switch">
                              <input type="checkbox"  id='registration' name='registration' checked>
                                <span class="sliders round"></span>
                              </label>
                        </div>
                    </div>
                    <div class="auth-set-content local-wrapper d-flex align-items-center justify-content-between">
                        <div class="local-set-head">
                            <h6>Verification Required</h6>
                        </div> 
                        <div class="active-switch">
                            <label class="switch">
                                <input type="checkbox" id='verification' name='verification' checked>
                                <span class="sliders round"></span>
                              </label>
                        </div>
                    </div>
                    <div class="auth-set-content local-wrapper d-flex align-items-center justify-content-between">
                        <div class="local-set-head">
                            <h6>Verification Expired</h6>
                        </div>                                    
                        <div class="drop-eng otp-custom customize-select">
                            <select name="time" class="form-control" id='verification_expired' name='verification_expired'>
                                <option value="1.00">1.00</option>
                                <option value="2.00">2.00</option>
                                <option value="3.00">3.00</option>
                            </select>
                        </div>
                    </div> 
                    <div class="auth-set-content local-wrapper d-flex align-items-center justify-content-between">
                        <div class="local-set-head">
                            <h6>Referral System</h6>
                        </div>                                    
                        <div class="active-switch">
                            <label class="switch">
                                <input type="checkbox" id='referral_system' name='referral_system' checked>
                                <span class="sliders round"></span>
                            </label>
                        </div>
                    </div>  
                    <div class="auth-set-content local-wrapper d-flex align-items-center justify-content-between">
                        <div class="local-set-head">
                            <h6>Login Type</h6>
                        </div>                                    
                        <div class="drop-eng otp-custom customize-select">
                            <!-- <select name="time" class="select" id='login_type' name='login_type'> -->
                            <select name="time" class="form-control" id='login_type' name='login_type'>
                                <option value="Mobile">Mobile</option>
                                <option value="labtop">labtop</option>
                                <option value="computer">computer</option>
                            </select>
                        </div>
                    </div>                               
                    <div class="auth-set-content local-wrapper d-flex align-items-center justify-content-between">
                        <div class="local-set-head">
                            <h6>Password</h6>
                        </div>                                    
                        <div class="active-switch">
                            <label class="switch">
                          
                           <input type="checkbox" id='password' name='password' checked>
                             <span class="sliders round"></span>
                              </label>
                        </div>
                    </div>  
                    <div class="auth-set-content local-wrapper d-flex align-items-center justify-content-between">
                        <div class="local-set-head">
                            <h6>OTP System</h6>
                        </div>                                    
                        <div class="active-switch">
                            <label class="switch">
                                <input type="checkbox" id='otp_system' name='otp_system' checked>
                                <span class="sliders round"></span>
                              </label>
                             </div>
                    </div>  
                    <div class="auth-set-content local-wrapper d-flex align-items-center justify-content-between mb-0">
                        <div class="local-set-head">
                            <h6>OTP Type</h6>
                        </div>                                    
                        <div class="drop-eng otp-custom customize-select">
                            <select name="time" id='otp_type' name='otp_type' class="form-control">
                                <option value="SMSOTP">SMS OTP</option>
                                <option value="EmailOTP">Email OTP</option>
                                <option value="WhatsupOTP">Whatsup OTP</option>
                            </select>
                        </div>
                    </div>  
                </div>             
               <div class="acc-submit wrapp-set-system">
                    <a href="#" class="btn btn-secondary">Cancel</a>
                <button type = 'button' class = 'btn btn-primary' onclick ='addnewauthentication();'>Save Changes</button>
     
                </div>
           </div>
        </div>
    </div>          
</div>
<!-- /Page Wrapper -->

          
       
<!-- /Edit Page -->
               
<?php $this->load->view('admin/includes/footer'); ?>