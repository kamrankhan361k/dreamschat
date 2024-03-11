<?php
$session = $this->session->userdata('username'); ?>
<?php 
$this->load->view('includes/header');?>

<!-- Main Wrapper -->
<div class="main-wrapper register-surv">
    <div class="content-field d-flex align-items-center w-100 p-0">
        <div class="login-group-left">
            <div class="login-wrapper register-wrapper">
                <header class="logo-header">
                    <a href="index.html" class="logo-brand">
                        <img src="./assets/img/login-logo.png" alt="Logo" class="img-fluid logo-dark">
                        <h5>DREAMSCHAT</h5>
                    </a>
                </header>
                <div class="login-inbox">
                    <div class="log-auth register-auth">
                        <div class="login-auth-wrap">
                            <div class="login-content-head">
                                <h3>Sign Up</h3>
                            </div>                           
                        </div>
                        <form action=""  id="registerform" autocomplete="off" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label"> First Name<span>*</span></label>
                                        <input type="text" class="form-control" id="firstname" name="firstname">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label">Last Name<span>*</span></label>
                                        <input type="text" class="form-control" id="lastname"  name="lastname">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email Address<span>*</span></label>
                                <input type="email" class="form-control" id="e-mail" name="e_mail">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Phone Number<span>*</span></label>
                                <input class="form-control form-control-lg group_formcontrol numbers" type="text" pattern="\+[0-9\s\-\(\)]+" id="phone-number" name="phone_number" maxlength="13">
                            </div>
                            <!-- <div class="form-group">
                                <label class="form-label">User Name <span>*</span></label>
                                <input type="text" class="form-control" id="l_username" placeholder="Username">
                            </div> -->
                            <div class="form-group">
                                <label class="form-label">Password<span>*</span></label>
                                <div class="pass-group" id="passwordInput">
                                    <input type="password" class="form-control pass-input" id="password" name="password">
                                    <span class="toggle-password fa-solid fa-eye"></span>
                                </div>
                                <span id="password-message"></span>
                                <div class="password-strength" id="passwordStrength" name="passwordStrength">
                                    <span id="poor"></span>
                                    <span id="weak"></span>
                                    <span id="strong"></span>
                                    <span id="heavy"></span>
                                </div>
                                <div id="passwordInfo"></div>
                            </div>
                            <div class="form-group form-remember d-flex align-items-center justify-content-between">
                                <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                    <label class="custom-check mt-0 mb-0">
                                        <span class="remember-me">I Agree to Terms of Use and Privacy Policy</span>
                                        <input type="checkbox" name="remeber" id="remeber" name="remeber" required>                                        
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary w-100 btn-size justify-content-center" id="sign-in-button">Sign Up</button>

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
                            <br>
                            <div class="bottom-text text-center">
                                <p>Already Have An Account?<a href="<?php echo base_url();?>login">Login</a></p>
                            </div>
                        </form>
                    </div>
                </div>                
            </div> 
        </div>           
    </div>
</div>
<!-- /Main Wrapper -->
<?php $this->load->view('includes/footer'); ?>
<div>
<input type="hidden" id="apiKey" value="<?php echo getenv('DB_FIREBASE_APIKEY')?>" />
<input type="hidden" id="authDomain" value="<?php echo getenv('DB_FIREBASE_AUTHDOMAIN')?>" />
<input type="hidden" id="databaseURL" value="<?php echo getenv('DB_FIREBASE_DBURL')?>" />
<input type="hidden" id="projectId" value="<?php echo getenv('DB_FIREBASE_PROJECTID')?>" />
<input type="hidden" id="storageBucket" value="<?php echo getenv('DB_FIREBASE_STORAGEBUGKET')?>" />
<input type="hidden" id="messagingSenderId" value="<?php echo getenv('DB_FIREBASE_MESSAGEID')?>" />
<input type="hidden" id="appId" value="<?php echo getenv('DB_FIREBASE_APPID')?>" />
<input type="hidden" id="baseUrl" value="<?php echo base_url()?>" />
<input type="hidden" id="appid" value="<?php echo getenv('DB_AGORA_APIID')?>">

</div>
<script type="text/javascript">
$(document).ready(function() {
    $(".numbers").intlTelInput({
        nationalMode: false
    });
});
</script>
<script src="<?php echo base_url(); ?>assets/js/mainconfig.js"></script>
<!-- Bootstrap Core JS -->
<script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/sweetalert.min.js"></script>

<script src="https://www.gstatic.com/firebasejs/4.9.1/firebase.js"></script>
<script src="<?php echo base_url(); ?>assets/js/fireconfig.js"></script>
<script src="<?php echo base_url(); ?>assets/js/usersignup.js"></script>

