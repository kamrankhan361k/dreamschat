<?php $this->load->view('admin/includes/header'); ?>

<?php $this->load->view('admin/includes/adminheader'); ?>

<?php $this->load->view('admin/includes/rightsidebar'); ?>

<!-- Page Wrapper -->
<div class="page-wrapper profile-set-wrapper">

    <div class="content container-fluid system-set-wrapper">
        <div class="page-header">
            <div class="page-title">
                <h4>Storage</h4>
            </div>
        </div>
        <div class="row location-set">
            <div class="col-md-6 col-12 d-flex">
                <div class="nav-menus nav-store">
                    <div class="system-set-logo store-logo d-flex align-items-center">
                        <span><img src="<?php echo base_url(); ?>assets/admin/img/icon/local.svg" alt="Logo" class="img-fluid"></span>
                        <h6>
                            <a href="" data-bs-toggle="modal" data-bs-target="#">
                                Local Storage
                            </a>
                        </h6>
                    </div>
                    <div class="settings-view">
                        <a href="javascript:;" class="me-3 d-flex store-set"><i class="bx bx-cog"></i></a>
                        <div class="active-switch">
                            <label class="switch">
                                <input type="checkbox" checked="">
                                <span class="sliders round"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12 d-flex">
                <div class="nav-menus nav-store mb-0">
                    <div class="system-set-logo store-logo d-flex align-items-center">
                        <span><img src="<?php echo base_url(); ?>assets/admin/img/icon/aws.svg" alt="Logo" class="img-fluid"></span>
                        <h6>
                            <a href="" data-bs-toggle="modal" data-bs-target="#aws-cap">
                                AWS
                            </a>
                        </h6>
                    </div>
                    <div class="settings-view">
                        <a href="javascript:;" class="me-3 d-flex store-set"><i class="bx bx-cog"></i></a>
                        <div class="active-switch">
                            <label class="switch">
                                <input type="checkbox" checked="">
                                <span class="sliders round"></span>
                            </label>
                        </div>
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
<!-- /Page Wrapper -->

 <!-- Google Captcha  -->
<div class="modal fade custom-modal verify-modal" id="aws-cap">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content Set-google-capt">
        <div class="captcha-header d-flex align-items-center justify-content-between">
            <h4>AWS Settings</h4>
            <div class="aws-setting">

                <div class="active-switch aws-act-set">
                    <label class="switch">
                        <input type="checkbox" checked>
                        <span class="sliders round"></span>
                      </label>
                </div>
                <span>
                    <a href="">
                        <i class="feather-x"></i>
                    </a>
                </span>

            </div>                       
        </div>
        <div class="modaled-body">
            <form action="#">
                <label>AWS Access Key <span> * </span></label>
                <input type="text" class="form-control">
                <label>Secret Key <span> * </span></label>
                <input type="text" class="form-control">
                <label>Bucket Name <span> * </span></label>
                <input type="text" class="form-control">
                <label>Region <span> * </span></label>
                <input type="text" class="form-control">
                <label>Base URL <span> * </span></label>
                <input type="text" class="form-control">
            </form>
        </div>
        <div class="acc-submited">
            <a href="" class="btn btn-primary">Submit</a>
            <a href="" class="btn btn-secondary">Cancel</a>                        
        </div>
    </div>
</div>
</div>
<!-- /Google Captcha  -->
               
<?php $this->load->view('admin/includes/footer'); ?>