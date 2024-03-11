<?php $this->load->view('admin/includes/header'); ?>

<?php $this->load->view('admin/includes/adminheader'); ?>

<?php $this->load->view('admin/includes/rightsidebar'); ?>

<!-- Page Wrapper -->
<div class="page-wrapper profile-set-wrapper">

    <div class="content container-fluid profile-set-content">
        <div class="page-header">
            <div class="page-title">
                <h4>GDPR (Cookies)</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12">

                
                <div class="noti-header">
                    <div class="auth-set-content local-wrapper d-flex align-items-center justify-content-between">
                        <div class="local-set-head">
                            <h6>Cookies Position</h6>
                        </div>                                    
                        <div class="drop-eng otp-custom customize-select">
                            <select name="time" class="select">
                                <option value="time">Right</option>
                                <option value="time">Left</option>
                            </select>
                        </div>
                    </div>
                    <div class="auth-set-content local-wrapper d-flex align-items-center justify-content-between">
                        <div class="local-set-head">
                            <h6>Agree Button Text</h6>
                        </div> 
                        <div class="drop-eng otp-custom customize-select">
                            <select name="time" class="select">
                                <option value="time">Manage</option>
                            </select>
                        </div>
                    </div>
                    <div class="auth-set-content local-wrapper d-flex align-items-center justify-content-between">
                        <div class="local-set-head">
                            <h6>Decline Button Text</h6>
                        </div>                                    
                        <div class="drop-eng otp-custom customize-select">
                            <select name="time" class="select">
                                <option value="time">Manage</option>
                            </select>
                        </div>
                    </div> 
                    <div class="auth-set-content local-wrapper d-flex align-items-center justify-content-between">
                        <div class="local-set-head">
                            <h6>Show Deline Button</h6>
                        </div>                                    
                        <div class="active-switch">
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="sliders round"></span>
                              </label>
                        </div>
                    </div>  
                    <div class="auth-set-content local-wrapper d-flex align-items-center justify-content-between">
                        <div class="local-set-head">
                            <h6>Link for Cookies Page</h6>
                        </div>                                    
                        <div class="pass-login">
                            <input type="text" class="form-control">
                        </div>
                    </div>                               
                    <div class="auth-set-content local-wrapper d-flex justify-content-between">
                        <div class="local-set-head">
                            <h6>Link for Cookies Page</h6>
                        </div>                                    
                        <div class="summer-group">
                            <div class="summernote"></div>
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