<?php $this->load->view('includes/header'); ?>
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
                            <h3>Forgot Password</h3>
                            <p>Enter your email and we will send you a mail to reset your password</p>
                        </div>
                    </div>
                    <form action="email-login.html">
                        <div class="form-group">
                            <label class="form-label">Email<span>*</span></label>
                            <input class="form-control form-control-lg group_formcontrol" id="email" name="email" type="email">
                        </div>                          
                        <a href="javascript:void(0);" class="btn btn-primary w-100 btn-size justify-content-center" onclick="resetpwd()">Reset Password</a>                           
                    </form>
                </div>
            </div>                
        </div>            
    </div>
</div>
<!-- /Main Wrapper -->
<?php $this->load->view('includes/footer'); ?>