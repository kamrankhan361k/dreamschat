<?php $this->load->view('admin/includes/header'); ?>

<?php $this->load->view('admin/includes/adminheader'); ?>

<?php $this->load->view('admin/includes/rightsidebar'); ?>

<!-- Page Wrapper -->
<div class="page-wrapper profile-set-wrapper">

    <div class="content container-fluid system-set-wrapper">
        <div class="page-header">
            <div class="page-title">
                <h4>Social Authentication</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="system-set-wrrapper">
                    <div class="system-load-time">
                        <div class="system-set-logo d-flex align-items-center">
                            <span><img src="<?php echo base_url(); ?>assets/admin/img/icon/facebook.svg" alt="Logo" class="img-fluid"></span>
                            <h6>
                                <a href="" data-bs-toggle="modal" data-bs-target="#fac-cap">
                                    Facebook
                                </a>
                            </h6>
                        </div>
                        <div class="social-connect">
                            <p>Connected</p>
                        </div>
                       
                    </div>  
                    <p>Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt </p>  
                    <div class="set-view d-flex align-items-center justify-content-between">
                        <span> <img src="<?php echo base_url(); ?>assets/admin/img/icon/repair.svg" alt="Icon" class="img-fluid"> Connect Now</span>
                        <div class="active-switch">
                            <label class="switch">
                                <input type="checkbox" checked="">
                                <span class="sliders round"></span>
                              </label>
                        </div>
                    </div>                          
                </div>
            </div>

            <div class="col-md-4">
                <div class="system-set-wrrapper">
                    <div class="system-load-time">
                        <div class="system-set-logo d-flex align-items-center">
                            <span><img src="<?php echo base_url(); ?>assets/admin/img/icon/google.svg" alt="Logo" class="img-fluid"></span>
                            <h6>
                                <a href="" data-bs-toggle="modal" data-bs-target="#goo-cap">
                                    Google
                                </a>
                            </h6>
                        </div>
                        <div class="social-connect">
                            <p>Connected</p>
                        </div>
                       
                    </div>  
                    <p>Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt </p>  
                    <div class="set-view d-flex align-items-center justify-content-between">
                        <span> <img src="<?php echo base_url(); ?>assets/admin/img/icon/repair.svg" alt="Icon" class="img-fluid"> Connect Now</span>
                        <div class="active-switch">
                            <label class="switch">
                                <input type="checkbox" checked="">
                                <span class="sliders round"></span>
                              </label>
                        </div>
                    </div>                          
                </div>
            </div>

            <div class="col-md-4">
                <div class="system-set-wrrapper">
                    <div class="system-load-time">
                        <div class="system-set-logo d-flex align-items-center">
                            <span><img src="<?php echo base_url(); ?>assets/admin/img/icon/apple.svg" alt="Logo" class="img-fluid"></span>
                            <h6>
                                <a href="" data-bs-toggle="modal" data-bs-target="#goo-cap">
                                    Apple
                                </a>
                            </h6>
                        </div>
                        <div class="social-connect">
                            <p>Connected</p>
                        </div>
                       
                    </div>  
                    <p>Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt </p>  
                    <div class="set-view d-flex align-items-center justify-content-between">
                        <span> <img src="<?php echo base_url(); ?>assets/admin/img/icon/repair.svg" alt="Icon" class="img-fluid"> Connect Now</span>
                        <div class="active-switch">
                            <label class="switch">
                                <input type="checkbox" checked="">
                                <span class="sliders round"></span>
                              </label>
                        </div>
                    </div>                          
                </div>
            </div>


            
            
                
                

            <div class="acc-submit submit-set-system">
                <a href="#" class="btn btn-secondary">Cancel</a>
                <a href="#" class="btn btn-primary">Save Changes</a>
            </div>
        </div>
    </div>          
</div>
<!-- /Page Wrapper -->

<!-- Google Captcha  -->
<div class="modal fade custom-modal verify-modal" id="fac-cap">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content Set-google-capt">
        <div class="captcha-header d-flex align-items-center justify-content-between">
            <h4>Facebook Login Settings</h4>
            <span>
                <a href="">
                    <i class="feather-x"></i>
                </a>
            </span>
        </div>
        <div class="modaled-body">
            <form action="#">
                <label>Consumer Key (API Key) <span> * </span></label>
                <input type="text" class="form-control fac-key">
                <p class="fac-goo">If you are not sure what is your APP ID, Please head over to <span> Getting Started. </span> </p>
                <label>Consumer Secret (Secret Key) <span> * </span></label>
                <input type="text" class="form-control">
            </form>
        </div>
        <div class="acc-submited">
            <a href="" class="btn btn-primary">Save Changes</a>
            <a href="" class="btn btn-secondary">Cancel</a>                        
        </div>
    </div>
</div>
</div>
<!-- /Google Captcha  -->

<!-- Agora Captcha  -->
<div class="modal fade custom-modal verify-modal" id="goo-cap">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content Set-google-capt">
        <div class="captcha-header d-flex align-items-center justify-content-between">
            <h4>Google Login Settings</h4>
            <span>
                <a href="">
                    <i class="feather-x"></i>
                </a>
            </span>
        </div>
        <div class="modaled-body">
            <form action="#">
                <label>Client ID <span> * </span></label>
                <input type="text" class="form-control fac-key">
                <p class="fac-goo">If you are not sure what is your APP ID, Please head over to <span>Getting Started.</span> </p>
                <label>Consumer Secret (Secret Key) <span> * </span></label>
                <input type="text" class="form-control">
                <label>Login Redirect URL <span> * </span></label>
                <input type="text" class="form-control">
            </form>
        </div>
        <div class="acc-submited">
            <a href="" class="btn btn-primary">Save Changes</a>
            <a href="" class="btn btn-secondary">Cancel</a>                        
        </div>
    </div>
</div>
</div>
<!-- /Agora Captcha  -->

<!-- Agora Captcha  -->
<div class="modal fade custom-modal verify-modal" id="app-cap">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content Set-google-capt">
        <div class="captcha-header d-flex align-items-center justify-content-between">
            <h4>Apple Login Settings</h4>
            <span>
                <a href="">
                    <i class="feather-x"></i>
                </a>
            </span>
        </div>
        <div class="modaled-body">
            <form action="#">
                <label>Client ID <span> * </span></label>
                <input type="text" class="form-control fac-key">
                <p class="fac-goo">If you are not sure what is your APP ID, Please head over to <span> Getting Started. </span> </p>
                <label>Consumer Secret (Secret Key) <span> * </span></label>
                <input type="text" class="form-control">
                <label>Login Redirect URL <span> * </span></label>
                <input type="text" class="form-control">
            </form>
        </div>
        <div class="acc-submited">
            <a href="" class="btn btn-primary">Save Changes</a>
            <a href="" class="btn btn-secondary">Cancel</a>                        
        </div>
    </div>
</div>
</div>
<!-- /Agora Captcha  -->

<?php $this->load->view('admin/includes/footer'); ?>