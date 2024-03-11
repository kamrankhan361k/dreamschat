<?php $this->load->view('admin/includes/header'); ?>

<?php $this->load->view('admin/includes/adminheader'); ?>

<?php $this->load->view('admin/includes/rightsidebar'); ?>

<!-- Page Wrapper -->
<div class="page-wrapper profile-set-wrapper">

    <div class="content container-fluid system-set-wrapper">
        <div class="page-header">
            <div class="page-title">
                <h4>SMS Setting</h4>
            </div>
        </div>
        <div class="row location-set">
            <div class="col-lg-4 col-sm-6 col-12 d-flex">
                <div class="nav-menus">
                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#nexmo"><img src="<?php echo base_url(); ?>assets/admin/img/nexmo.png" alt="img"></a>
                    <div class="settings-view">
                        <a href="javascript:;" class="me-3 d-flex"><i class="bx bx-cog"></i></a>
                        <div class="active-switch">
                            <label class="switch">
                                <input type="checkbox" checked="">
                                <span class="sliders round"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12 d-flex">
                <div class="nav-menus">
                    <img src="<?php echo base_url(); ?>assets/admin/img/2-factor.png" alt="img">
                    <div class="settings-view">
                        <a href="javascript:;" class="me-3 d-flex"><i class="bx bx-cog"></i></a>
                        <div class="active-switch">
                            <label class="switch">
                                <input type="checkbox" checked="">
                                <span class="sliders round"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12 d-flex">
                <div class="nav-menus">
                    <img src="<?php echo base_url(); ?>assets/admin/img/twilio.png" alt="img">
                    <div class="settings-view">
                        <a href="javascript:;" class="me-3 d-flex"><i class="bx bx-cog"></i></a>
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
<div class="modal fade custom-modal verify-modal" id="nexmo">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content Set-google-capt">
            <div class="captcha-header d-flex align-items-center justify-content-between">
                <div class="email-group">
                    <h4>Nexmo</h4>
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
                    <label>API Key <span> * </span></label>
                    <input type="text" class="form-control">
                    <label>API Secret Key  <span> * </span></label>
                    <input type="text" class="form-control">
                    <label>Sender ID  <span> * </span></label>
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
<?php $this->load->view('admin/includes/footer'); ?>