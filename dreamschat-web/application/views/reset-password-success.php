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
                    <h5><?php echo ($ul['reset-passwordpage']['dreamschat'])?$ul['reset-passwordpage']['dreamschat']: "DREAMSCHAT"; ?></h5>
                </a>
            </header>
            <div class="login-inbox">
                <div class="log-auth">
                    <div class="success-pass">
                        <img src="./assets/img/avatar/avatar-16.png" alt="Success" class="img-fluid">
                    </div>
                    <div class="login-auth-wrap">
                        <div class="login-content-head">
                            <h3><?php echo ($ul['reset-passwordpage']['reset_password_success'])?$ul['reset-passwordpage']['reset_password_success']: "Reset Password Success"; ?></h3>
                            <p class="text-center"><?php echo ($ul['reset-passwordpage']['your_new_password'])?$ul['reset-passwordpage']['your_new_password']: "Your new password has been successfully saved."; ?><br>
                              <?php echo ($ul['reset-passwordpage']['now_you_can_login'])?$ul['reset-passwordpage']['now_you_can_login']: "Now you can login with your new password"; ?></p>
                        </div>
                    </div>
                                                
                        <a href="<?php echo base_url();?>login" class="btn btn-primary w-100 btn-size justify-content-center"><?php echo ($ul['reset-passwordpage']['login'])?$ul['reset-passwordpage']['login']: "Login"; ?></a>                           
            
                </div>
            </div>                
        </div>            
    </div>
</div>
<!-- /Main Wrapper -->

<?php $this->load->view('includes/footer'); ?>

