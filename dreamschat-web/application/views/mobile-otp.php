<?php
$session = $this->session->userdata('username');
$lang = ($session['language'] != '')?$session['language']:'En';
$ul = custom_language($session['user'], $lang);
?>
<?php $this->load->view('includes/header'); ?>
<!-- Main Wrapper -->
<div class="main-wrapper register-surv">
    <!-- Page Content -->
		<div class="login-content-info">
			<div class="container-fluid">
				<!-- Login Phone Otp -->
				<div class="row">
                    <div class="account-content login-wrapper">
                        <div class="account-info">
                            <header class="logo-header">
                                <a href="index.html" class="logo-brand">
                                    <img src="./assets/img/login-logo.png" alt="Logo" class="img-fluid logo-dark">
                                    <h5><?php echo ($ul['mobile-otppage']['dreamschat'])?$ul['mobile-otppage']['dreamschat']: "DREAMSCHAT"; ?></h5>
                                </a>
                            </header>
                            <div class="login-inbox">
                                <div class="log-auth">
                                    <div class="login-verify-img">
                                        <img src="assets/img/icons/phone-otp.svg" alt="mobile-icon" class="img-fluid">
                                    </div>
                                    <div class="login-title">
                                    <h3><?php echo ($ul['mobile-otppage']['phone_otp_verification'])?$ul['mobile-otppage']['phone_otp_verification']: "Phone OTP Verification"; ?> </h3>
                                    <p class="mb-0"><?php echo ($ul['mobile-otppage']['otp_sent_to_your'])?$ul['mobile-otppage']['otp_sent_to_your']: "OTP sent to your mobile number ending"; ?> <span>******9575</span></p>
                                    </div>
                                    <form method="get" class="digit-group login-form-control" data-group-name="digits" data-autosubmit="false" autocomplete="off" action="phone-login.html">
                                        <div class="otp-box">
                                            <div class="forms-block">
                                                <input type="text" id="digit-1" name="digit-1" data-next="digit-2" maxlength="1" placeholder="9">
                                                <input type="text" id="digit-2" name="digit-2" data-next="digit-3" data-previous="digit-1" maxlength="1" placeholder="4">
                                                <input type="text" id="digit-3" name="digit-3" data-next="digit-4" data-previous="digit-2" maxlength="1">
                                                <input type="text" id="digit-4" name="digit-4" data-next="digit-5" data-previous="digit-3" maxlength="1">
                                            </div>
                                        </div>
                                        <div class="forms-block">
                                            <div class="otp-info d-flex align-items-center justify-content-between">
                                                <div class="otp-code d-flex align-items-center mb-0">
                                                    <p class="mb-0"><?php echo ($ul['mobile-otppage']['did_receive_otp'])?$ul['mobile-otppage']['did_receive_otp']: "Didn't receive OTP code?"; ?></p>
                                                    <a href="javascript:void(0);"><?php echo ($ul['mobile-otppage']['resend_code'])?$ul['mobile-otppage']['resend_code']: "Resend Code"; ?></a>
                                                </div>
                                                <div class="otp-sec">
                                                    <p class=" badge align-items-center"><i class="feather-clock"></i><?php echo ($ul['mobile-otppage']['00:25_secs'])?$ul['mobile-otppage']['00:25_secs']: "00:25 secs"; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reset-btn">
                                        <button class="btn btn-primary w-100 justify-content-center" type="submit"><?php echo ($ul['mobile-otppage']['verify_any_proceed'])?$ul['mobile-otppage']['verify_any_proceed']: "Verify And Proceed"; ?></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
				<!-- /Login Phone Otp -->

			</div>
		</div>		
		<!-- /Page Content -->
</div>
<!-- /Main Wrapper -->
<?php $this->load->view('includes/footer'); ?>