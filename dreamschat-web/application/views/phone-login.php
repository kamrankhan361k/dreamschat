<?php
$session = $this->session->userdata('username');
$lang = ($session['language'] != '')?$session['language']:'En';
$ul = custom_language($session['user'], $lang);
?>
<?php 
$this->load->view('includes/header'); ?>

<!-- Main Wrapper -->
	<div class="main-wrapper register-surv">
        <div class="container-fluid">
            <div class="login-wrapper">
                <header class="logo-header">
                    <a href="index.html" class="logo-brand">
                        <img src="./assets/img/login-logo.png" alt="Logo" class="img-fluid logo-dark">
                        <h5><?php echo ($ul['phone-loginpage']['dreamschat'])?$ul['phone-loginpage']['dreamschat']: "DREAMSCHAT"; ?></h5>
                    </a>
                </header>
                <div class="login-inbox">
                    <div class="log-auth">
                        <div class="login-auth-wrap">
                            <div class="login-content-head">
                                <h3><?php echo ($ul['phone-loginpage']['login'])?$ul['phone-loginpage']['login']: "Login"; ?></h3>
                                <p><?php echo ($ul['phone-loginpage']['hi_welcome'])?$ul['phone-loginpage']['hi_welcome']: "Hi Welcome Back"; ?></p>
                            </div>
                            <div class="phone-login">
                                <span>
                                   <?php echo ($ul['phone-loginpage']['sign_in_with'])?$ul['phone-loginpage']['sign_in_with']: "Sign in with"; ?>
                                    <a href="<?php echo base_url();?>email-login">
                                      <?php echo ($ul['phone-loginpage']['email_address'])?$ul['phone-loginpage']['email_address']: "Email Address"; ?>

                                    </a>
                                </span>
                            </div>
                        </div>
                        <form action="index.html">
                            <div class="form-group">
                                <label class="form-label"><?php echo ($ul['phone-loginpage']['phone_number'])?$ul['phone-loginpage']['phone_number']: "Phone Number"; ?><span>*</span></label>
                                <input class="form-control form-control-lg group_formcontrol numbers" id="phone" name="phone" type="text">
                            </div>
                            <div class="form-group">
                                <label class="form-label"><?php echo ($ul['phone-loginpage']['password'])?$ul['phone-loginpage']['password']: "Password"; ?><span>*</span></label>
                                <div class="pass-group">
                                    <input type="password" class="form-control pass-input" id="l_password" placeholder="Password">
                                    <span class="toggle-password fa-solid fa-eye"></span>
                                </div>
                            </div>
                            <div class="form-group form-remember d-flex align-items-center justify-content-between">
                                <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                    <label class="custom-check mt-0 mb-0">
                                        <span class="remember-me"><?php echo ($ul['phone-loginpage']['remember_me'])?$ul['phone-loginpage']['remember_me']: "Remember Me"; ?></span>
                                        <input type="checkbox" name="remeber">                                        
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <span class="forget-pass">
                                    <a href="<?php echo base_url();?>forgot-password">
                                        <?php echo ($ul['phone-loginpage']['forgot_password'])?$ul['phone-loginpage']['forgot_password']: "Forgot Password"; ?>
                                    </a>
                                </span>
                            </div>
                            <a href="javascript:void(0);" class="btn btn-primary w-100 btn-size justify-content-center" id="login-in-button">Login</a>
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
                                <p><?php echo ($ul['phone-loginpage']['dont_have_account'])?$ul['phone-loginpage']['dont_have_account']: "Don’t have account?"; ?><a href="<?php echo base_url();?>register">Sign up!</a></p>
                            </div>
                        </form>
                    </div>
                </div>                
            </div>            
        </div>
	</div>
	<!-- /Main Wrapper -->
<?php $this->load->view('includes/footer'); ?>