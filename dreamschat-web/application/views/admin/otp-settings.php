<?php $this->load->view('admin/includes/header'); ?>

<?php $this->load->view('admin/includes/adminheader'); ?>

<?php $this->load->view('admin/includes/rightsidebar'); ?>

<!-- Page Wrapper -->
<div class="page-wrapper profile-set-wrapper">

    <div class="content container-fluid profile-set-content">
        <div class="page-header">
            <div class="page-title">
                <h4>OTP Setting</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12">

                <div class="noti-header">
                    <div class="noti-wrapper local-wrapper d-flex align-items-center justify-content-between">
                        <div class="local-set-head">
                            <h6>OTP Type</h6>
                            <p>Your can configure the type</p>
                        </div>                                    
                        <div class="drop-eng otp-custom customize-select">
                            <select name="sms" class="select">
                                <option value="sms">SMS</option>
                                <option value="sms">SMS</option>
                                <option value="sms">SMS</option>
                                <option value="sms">SMS</option>
                            </select>
                        </div>
                    </div>
                    <div class="noti-wrapper local-wrapper d-flex align-items-center justify-content-between">
                        <div class="local-set-head">
                            <h6>OTP Digit Limit</h6>
                            <p>Select size of the format</p>
                        </div> 
                        <div class="drop-eng otp-custom customize-select">
                            <select name="number" class="select">
                                <option value="number">4</option>
                                <option value="number">5</option>
                                <option value="number">6</option>
                                <option value="number">7</option>
                            </select>
                        </div>
                    </div>
                    <div class="noti-wrapper local-wrapper d-flex align-items-center justify-content-between">
                        <div class="local-set-head">
                            <h6>OTP Expire Time</h6>
                            <p>Select expire time of OTP </p>
                        </div>                                    
                        <div class="drop-eng otp-custom customize-select">
                            <select name="time" class="select">
                                <option value="time">5 Mins</option>
                                <option value="time">5 Mins</option>
                                <option value="time">5 Mins</option>
                            </select>
                        </div>
                    </div>                               
                </div>             
            
                <div class="acc-submit wrapp-set-system">
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    <a href="#" class="btn btn-primary">Save Changes</a>
                </div>
           </div>
        </div>
    </div>          
</div>
<!-- /Page Wrapper -->    
<?php $this->load->view('admin/includes/footer'); ?>