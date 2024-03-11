<?php
$this->load->view('includes/header');
?>

<!-- Main Wrapper -->
	<div class="main-wrapper register-surv">
        <div class="container-fluid">
            <div class="login-wrapper">
                <header class="logo-header">
                    <a href="index.html" class="logo-brand">
                        <img src="./assets/img/login-logo.png" alt="Logo" class="img-fluid logo-dark">
                        <h5>DREAMSCHAT</h5>
                    </a>
                </header>
                <div class="login-inbox">
                    <div class="log-auth">
                        <div class="login-auth-wrap">
                            <div class="login-content-head">
                                <h3>Login</h3>
                                <p>Hi Welcome Back</p>
                            </div>
                            <div class="phone-login">
                                <span>
                                 Sign in with
                                    <a href="<?php echo base_url();?>phone-login">
                                       Phone Number
                                    </a>
                                </span>
                            </div>
                        </div>
                        <form action="" id="password-message" autocomplete="off" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="form-label">Email Address<span>*</span></label>
                                <input type="email" id="l_username"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password<span>*</span></label>
                                <div class="pass-group">
                                    <input type="password" id="l_password"  class="form-control pass-input">
                                    <span class="fas fa-eye toggle-password"></span>
                                    <span id="password-message"></span>
                                </div>
                            </div>
                            <div class="form-group form-remember d-flex align-items-center justify-content-between">
                                <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                    <label class="custom-check mt-0 mb-0">
                                        <span class="remember-me">Remember Me</span>
                                        <input type="checkbox" name="remeber">                                        
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                              
                                <span class="forget-pass">
                                    <a href="<?php echo base_url();?>forgot-password">
                                        Forgot Password
                                    </a>
                                </span>
                           
                            </div>
                            <div class="row mt-2">
                                            <div class="col-md-6 d-flex justify-content-start">
                                                <a href="<?=base_url()?>forgotpassword" class="btn btn-link">Forgot Password</a>
                                            </div>
                                            <div class="col-md-6 d-flex justify-content-end">
                                                <a href="#" class="btn btn-info btn-sm" id="copy_user_details">User login</a>
                                            </div>
                                        </div>
                            <button type="button" class="btn btn-primary w-100 btn-size justify-content-center" id="login-in-button">Login</button>
                           
                            <!-- <div class="login-or">
                                <span class="span-or-log">or Login With</span>
                            </div>
                            <div class="form-group mb-0">
                                <ul class="social-login d-flex align-items-center">
                                    <li class="text-center">
                                        <a href="javascript:void(0)" class="d-flex align-items-center justify-content-center">
                                            <img src="assets/img/icons/google.svg" class="img-fluid" alt="Google">
                                            <span>Google</span>
                                        </a>
                                    </li>
                                    <li class="text-center">
                                        <a href="javascript:void(0)" class="d-flex align-items-center justify-content-center">
                                            <img src="assets/img/icons/facebook.svg" class="img-fluid" alt="Facebook">
                                            <span>Facebook</span>
                                        </a>
                                    </li>
                                    <li class="text-center">
                                        <a href="javascript:void(0)" class="d-flex align-items-center justify-content-center">
                                            <img src="assets/img/icons/apple.svg" class="img-fluid" alt="Apple">
                                            <span>Apple</span>
                                        </a>
                                    </li>
                                </ul>
                            </div> -->
                            <div class="bottom-text text-center">
                                <p>Don’t have account? <a href="<?php echo base_url();?>register">Sign up!</a></p>
                            </div>
                        </form>
                    </div>
                </div>                
            </div>            
        </div>
	</div>
	<!-- /Main Wrapper -->
<?php $this->load->view('includes/footer'); ?>