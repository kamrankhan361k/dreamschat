<?php
$session = $this->session->userdata('username');
$lang = ($session['language'] != '')?$session['language']:'En';
$ul = custom_language($session['user'], $lang);
?>
<?php $this->load->view('includes/header'); ?>
<!-- Main Wrapper -->
<div class="main-wrapper register-surv">
    <div class="container-fluid">
        <div class="login-wrapper">
            <header class="logo-header">
                <a href="index.html" class="logo-brand">
                    <img src="./assets/img/login-logo.png" alt="Logo" class="img-fluid logo-dark">
                    <h5><?php echo ($ul['reset-password-successpage']['dreamschat'])?$ul['reset-password-successpage']['dreamschat']: "DREAMSCHAT"; ?></h5>
                </a>
            </header>
            <div class="login-inbox">
                <div class="log-auth">
                    <div class="login-auth-wrap">
                        <div class="login-content-head">
                            <h3><?php echo ($ul['reset-password-successpage']['reset_password'])?$ul['reset-password-successpage']['reset_password']: "Reset Password"; ?></h3>
                            <p><?php echo ($ul['reset-password-successpage']['your_new_password'])?$ul['reset-password-successpage']['your_new_password']: "Your new password must be different from previous used passwords."; ?></p>
                        </div>
                    </div>
                    <form action="email-login.html">
                        <div class="form-group">
                            <label class="form-label"><?php echo ($ul['reset-password-successpage']['new_password'])?$ul['reset-password-successpage']['new_password']: "New Password"; ?> <span>*</span></label>
                            <div class="pass-group" id="passwordInput">
                                <input type="password" class="form-control pass-input">
                                <span class="toggle-password fa-solid fa-eye"></span>
                            </div>
                            <div class="password-strength" id="passwordStrength">
                                <span id="poor"></span>
                                <span id="weak"></span>
                                <span id="strong"></span>
                                <span id="heavy"></span>
                            </div>
                            <div id="passwordInfo"></div>
                        </div>
                        <div class="form-group reset-group">
                            <label class="form-label"><?php echo ($ul['reset-password-successpage']['confirm_password'])?$ul['reset-password-successpage']['confirm_password']: "Confirm Password"; ?>  <span>*</span></label>
                            <div class="pass-group">
                                <input type="password" class="form-control pass-inputs">
                                <span class="toggle-passwords fa-solid fa-eye"></span>
                            </div>
                        </div>                            
                        <a href="<?php echo base_url();?>reset-password-success" class="btn btn-primary w-100 btn-size justify-content-center"><?php echo ($ul['reset-password-successpage']['save_changes'])?$ul['reset-password-successpage']['save_changes']: "Save Changes"; ?> </a>                           
                    </form>
                </div>
            </div>                
        </div>            
    </div>
</div>
<!-- /Main Wrapper -->
<?php $this->load->view('includes/footer'); ?>