<?php $this->load->view('admin/includes/header'); ?>

<?php $this->load->view('admin/includes/adminheader'); ?>

<?php $this->load->view('admin/includes/rightsidebar'); ?>

<!-- Page Wrapper -->
<div class="page-wrapper profile-set-wrapper">

    <div class="content container-fluid system-set-wrapper">
        <div class="page-header">
            <div class="page-title">
                <h4>Email Setting</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 d-flex">
                <div class="system-set-wrrapper">
                    <div class="system-load-time">
                        <div class="system-set-logo d-flex align-items-center">
                            <h6>
                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#php-mail">
                                    PHP Mail
                                </a>
                            </h6>
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

            <div class="col-md-4 d-flex">
                <div class="system-set-wrrapper">
                    <div class="system-load-time">
                        <div class="system-set-logo d-flex align-items-center">
                            <h6>
                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#smtp">
                                    SMTP
                                </a>
                            </h6>
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

            <div class="col-md-4 d-flex">
                <div class="system-set-wrrapper">
                    <div class="system-load-time">
                        <div class="system-set-logo d-flex align-items-center">
                            <h6>
                                <a href="javasript:;">
                                    SendGrid
                                </a>
                            </h6>
                        </div>
                        <div class="social-connect">
                            <p>Connected</p>
                        </div>
                       
                    </div>  
                    <p>Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt </p>  
                    <div class="set-view d-flex align-items-center justify-content-between">
                        <span> <img src="<?php echo base_url(); ?>assets/admin/img/icon/repair.svg" alt="Icon" class="img-fluid"> View Integration</span>
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
<div class="modal fade custom-modal verify-modal" id="php-mail">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content Set-google-capt">
            <div class="captcha-header d-flex align-items-center justify-content-between">
                <div class="email-group">
                    <h4>PHP EMail</h4>
                    <div class="active-switch me-2">
                        <label class="switch">
                            <input type="checkbox" checked="">
                            <span class="sliders round"></span>
                        </label>
                    </div>
                </div>
                <span>
                    <a href="javascript:;" data-bs-dismiss="modal" aria-label="Close">
                        <i class="feather-x"></i>
                    </a>
                </span>
            </div>
            <div class="modaled-body">
                <form action="#">
                    <label>From Email Address <span> * </span></label>
                    <input type="text" class="form-control">
                    <label>Email Password <span> * </span></label>
                    <input type="text" class="form-control">
                    <label>From Name <span> * </span></label>
                    <input type="text" class="form-control">
                </form>
            </div>
            <div class="acc-submited">
                <a href="javascript:;" class="btn btn-primary">Submit</a>
                <a href="javascript:;" class="btn btn-secondary">Cancel</a>                        
            </div>
        </div>
    </div>
</div>
<!-- /Google Captcha  -->

<!-- Agora Captcha  -->
<div class="modal fade custom-modal verify-modal" id="smtp">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content Set-google-capt">
            <div class="captcha-header d-flex align-items-center justify-content-between">
                <div class="email-group">
                    <h4>SMTP</h4>
                    <div class="active-switch me-2">
                        <label class="switch">
                            <input type="checkbox" checked="">
                            <span class="sliders round"></span>
                        </label>
                    </div>
                </div>
                <span>
                    <a href="javascript:;" data-bs-dismiss="modal" aria-label="Close">
                        <i class="feather-x"></i>
                    </a>
                </span>
            </div>
            <div class="modaled-body">
                <form action="#">
                    <label>From Email Address <span> * </span></label>
                    <input type="text" class="form-control">
                    <label>Email Password <span> * </span></label>
                    <input type="text" class="form-control">
                    <label>Host <span> * </span></label>
                    <input type="text" class="form-control">
                    <label>Port  <span> * </span></label>
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
                    <input type="text" class="form-control">
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