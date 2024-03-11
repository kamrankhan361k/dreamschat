<?php $this->load->view('admin/includes/header'); ?>

<?php $this->load->view('admin/includes/adminheader'); ?>

<?php $this->load->view('admin/includes/rightsidebar'); ?>

<!-- Page Wrapper -->
<div class="page-wrapper profile-set-wrapper">
    <!-- Loader -->
    <div class="page-loader">
        <div class="page-loader-inner">
            <div class="loader-box">
                <?php
                    $filePath = base_url() . 'uploads/website/' . getenv('DB_COMPANY_ICON');
                    $alter_img = base_url() . 'assets/img/logo.png';

                    if (!file_exists($filePath)) {
                        // If the file exists, display the image
                        echo '<img src="' . $filePath . '" alt="Company Icon">';
                    } else {
                        // If the file doesn't exist, display an alternative image
                        echo '<img src="' . $alter_img . '" alt="Loader">';
                    }
                ?>
            </div>
        </div>
    </div>
    <!-- /Loader -->
    <div class="content container-fluid system-set-wrapper">
		<div class="page-header">
			<div class="page-title">
				<h4>System Setting</h4>
			</div>
		</div>
		<div class="row">
			<!-- <div class="col-md-4">
                <div class="system-set-wrrapper">
                    <div class="system-load-time">
                        <div class="system-set-logo d-flex align-items-center">
                            <span><img src="<?php echo base_url(); ?>assets/admin/img/icon/system-logo-01.svg" alt="Logo" class="img-fluid"></span>
                            <h6>
                                <a href="" data-bs-toggle="modal" data-bs-target="#goog-cap">
                                    Google Captcha
                                </a>
                            </h6>
                        </div>
                        <div class="active-switch">
                            <label class="switch">
                                <input type="checkbox"  id='gcaptcha' name='gcaptcha' checked="">
                                <span class="sliders round"></span>
                              </label>
                        </div>
                    </div>  
                    <p>Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt </p>  
                    <div class="set-view">
                        <span> <img src="<?php echo base_url(); ?>assets/admin/img/icon/repair.svg" alt="Icon" class="img-fluid"> Integration</span>
                    </div>                          
                </div>
            </div> -->

            <div class="col-md-4">
                <div class="system-set-wrrapper">
                    <div class="system-load-time">
                        <div class="system-set-logo d-flex align-items-center">
                            <span><img src="<?php echo base_url(); ?>assets/admin/img/icon/system-logo-02.svg" alt="Logo" class="img-fluid"></span>
                            <h6>
                                <!-- <a href="" data-bs-toggle="modal" data-bs-target="#agora-cap"> -->
                                    Agora Settings
                                </h6>
                        </div>
                        <div class="active-switch">
                            <label class="switch">
                                <input type="checkbox" id='agorasettings' name='agorasettings' checked="">
                                <span class="sliders round"></span>
                              </label>
                        </div>
                    </div>  
                    <p><a target="_blank" href="https://www.agora.io/en/">How to create Agora Application key?  </a></p>  
                    <div class="set-view">
                        <span><a href="" data-bs-toggle="modal" data-bs-target="#agora-cap"><img src="<?php echo base_url(); ?>assets/admin/img/icon/repair.svg" alt="Icon" class="img-fluid"> Integration</a></span>
                    </div>                          
                </div>
            </div>

            <div class="col-md-4">
                <div class="system-set-wrrapper">
                    <div class="system-load-time">
                        <div class="system-set-logo d-flex align-items-center">
                            <span class="system-three"><img src="<?php echo base_url(); ?>assets/admin/img/icon/system-logo-03.svg" alt="Logo" class="img-fluid"></span>
                            <h6>
                            Firebase Settings
                            </h6>
                        </div>
                        <div class="active-switch">
                            <label class="switch">
                                <input type="checkbox" id='fsetting' name='fsetting' checked="">
                                <span class="sliders round"></span>
                              </label>
                        </div>
                    </div>  
                    <p><a target="_blank" href="https://console.firebase.google.com">How to create firebase setup? </a></p>  
                    <div class="set-view">
                       <span><a href="" data-bs-toggle="modal" data-bs-target="#fire-cap"><img src="<?php echo base_url(); ?>assets/admin/img/icon/repair.svg" alt="Icon" class="img-fluid"> Integration</a></sapan>
                         </div>
                        </div>
                        </div>
			     <div class="acc-submit submit-set-system">
                <a href="#" class="btn btn-secondary">Cancel</a>
                <!-- <a href="#" class="btn btn-primary">Save Changes</a> -->
                <button type = 'button' class = 'btn btn-primary' onclick = ' addnewsystemsettings();'>Save Changes</button>

            </div>
		</div>
	</div>			
</div>
<!-- /Page Wrapper -->


<!-- Agora Captcha  -->
<div class="row">
    <div class="col-lg-4">
<div class="modal fade custom-modal verify-modal" id="agora-cap">
<div class="modal-dialog modal-dialog-centered">
	<div class="modal-content Set-google-capt">
		<div class="captcha-header d-flex align-items-center justify-content-between">
			<h4>Agora Settings</h4>
            <span>
                <a href="">
                    <i class="feather-x"></i>
                </a>
            </span>
		</div>
		<div class="modaled-body">
			<form action="#"> 
				<label>Agora Application key <span> * </span></label>
                <input type="text" required class="form-control" id="agora_appkey" name="agora_appkey" value="<?php echo getenv('DB_AGORA_APIID');?>">
         </form>
          
		</div>
        <!-- <div class="acc-submited">
            <a href="" class="btn btn-primary">Save Changes</a>
            <a href="" class="btn btn-secondary">Cancel</a>                        
        </div> -->

        <?php if($this->session->userdata('admin_id') == 'admin'){ ?>
		<div class="acc-submited">
        <a href="" class="btn btn-secondary">Cancel</a>
		<button type="button"  onclick="insertagora()" class="btn btn-primary">Save Changes</button>
		</div>
		<?php } ?>


	</div>
</div>
</div>
        </div>
<!-- /Agora Captcha  -->


<!-- Agora Captcha  -->
<div class="col-lg-4">
<div class="modal fade custom-modal verify-modal" id="fire-cap">
<div class="modal-dialog modal-dialog-centered">
	<div class="modal-content Set-google-capt">
		<div class="captcha-header d-flex align-items-center justify-content-between">
			<h4>Firebase Settings</h4>
            <span>
                <a href="">
                    <i class="feather-x"></i>
                </a>
            </span>
		</div>
		<div class="modaled-body">
			<form action="#">

            <label>Application Key<span> * </span></label>
				<input type="text" required class="form-control" id="appkey" name="appkey" value="<?php echo getenv('DB_FIREBASE_APIKEY');?>">
				
             <label>Authenticated Domain<span> * </span></label>
			 <input type="text" required class="form-control" id="authdomain" name="authdomain" value="<?php echo getenv('DB_FIREBASE_AUTHDOMAIN');?>">
				
             <label>Database Url<span> * </span></label>
			 <input type="text" required class="form-control" id="dburl" name="dburl" value="<?php echo getenv('DB_FIREBASE_DBURL');?>">

             <label>Project Id<span> * </span></label>
			 <input type="text" required class="form-control" id="projectid" name="projectid" value="<?php echo getenv('DB_FIREBASE_PROJECTID');?>"> 

             <label>Storage Bucket<span> * </span></label>
			<input type="text" required class="form-control" id="storagebugket" name="storagebugket" value="<?php echo getenv('DB_FIREBASE_STORAGEBUGKET');?>">

            <label>Message Id<span> * </span></label>
			<input type="text" required class="form-control" id="messageid" name="messageid" value="<?php echo getenv('DB_FIREBASE_MESSAGEID');?>">

            <label>Application Id<span> * </span></label>
			<input type="text" required class="form-control" id="appid" name="appid" value="<?php echo getenv('DB_FIREBASE_APPID');?>">
           	</form>
		</div>
       
        <?php if($this->session->userdata('admin_id') == 'admin'){ ?>
										<div class="text-right">
                                        <a href="" class="btn btn-secondary">Cancel</a>
											<button type="button"  onclick="insertfirbasevalue()" class="btn btn-primary">Save Changes</button>
										</div>
										<?php } ?>
	</div>
</div>
</div>
        </div>
        </div>
<!-- /Agora Captcha  -->

</div>
<!-- /Page Wrapper -->

<?php $this->load->view('admin/includes/footer'); ?>