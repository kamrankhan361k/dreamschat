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
    <div class="content container-fluid profile-set-content">

    		<div class="page-header">
			<div class="page-title">
				<h4>Website Setting</h4>
			</div>
		</div>
		<div class="row">
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="col-md-12 d-flex profile-card">

                <!-- Company Information -->
              
                 <div class="card card-table flex-fill card-details person-info">
                        <div class="person-profile">
                            <h4>Company Information</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="inform-content">
                                    <label>Company Name</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo getenv('DB_COMPANY_NAME');?>">
                                </div>                                            
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="inform-content">
                                    <label>Company Email Address</label>
                                    <input type="email" class="form-control" id="company_email" name="company_email" value="<?php echo getenv('DB_COMPANY_EMAIL');?>">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="inform-content">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control" id="company_phonenumber" name="company_phonenumber" value="<?php echo getenv('DB_COMPANY_PHONENUMBER');?>">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="inform-content">
                                    <label>Fax</label>
                                    <input type="text" class="form-control" id="company_fax" name="company_fax" value="<?php echo getenv('DB_COMPANY_FAX');?>">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="inform-content">
                                    <label>Website</label>
                                    <input type="text" class="form-control" id="company_website" name="company_website" value="<?php echo getenv('DB_COMPANY_WEBSITE');?>">
                                </div>
                            </div>
                        </div>
                                     								
                    </div>
                <!-- /Company Information -->
            </div>

            <div class="col-md-12 d-flex profile-card">

                <!-- Company Image -->
                    <div class="card card-table flex-fill card-details person-info">
                        <div class="person-profile">
                            <h4>Company Image</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <div class="company-content">
                                    <h6>Favicon</h6>   
                                    <p>Upload Favicon of your Company
                                        to display in website</p>                                             
                                </div>                                            
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="company-content">
                                    <div class="profile-upload">                                        
                                        <span><img src="<?php echo base_url(); ?>assets/admin/img/icon/upload.svg" class="img-fluid" alt="Upload"></span>
                                        Upload Photo
                                        <input type="file"id="favicon" name="favicon">
                                    </div>
                                    <input type="hidden" id="hfavicon" name="hfavicon" value="<?php echo getenv('DB_WEBSITE_FAVICON');?>">

                                    <p>Recommended image size is 16px x 16px or 32px x 32px.</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-12 logo-cont">
                                <div class="company-content d-flex justify-content-end">
                                    <div class="logo-content upload-space">
                                        <img src="<?php echo base_url(); ?>uploads/website/<?=getenv('DB_WEBSITE_FAVICON')?>" class="img-fluid" alt="Logo">                                                      
                                    </div>                                         
                                </div>    
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="company-content">
                                    <h6>Logo</h6>   
                                    <p>Upload Logo of your Company
                                        to display in website</p>                                             
                                </div>                                            
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="company-content">
                                    <div class="profile-upload">                             
                                        <span><img src="<?php echo base_url(); ?>assets/admin/img/icon/upload.svg" class="img-fluid" alt="Upload"></span>
                                        Upload Photo
                                        <input type="file" id="company_logo" name="company_logo">
                                    </div>
                                    <input type="hidden" id="hcompany_logo" name="hcompany_logo" value="<?php echo getenv('DB_COMPANY_LOGO');?>">

                                    <p>Recommended image size is 280px x 50px.</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="company-content">
                                    <div class="logo-content logo-space bg-logo">
                                        <img src="<?php echo base_url(); ?>uploads/website/<?=getenv('DB_COMPANY_LOGO')?>" class="img-fluid" alt="Logo">
                                    </div>                                         
                                </div>    
                            </div> 


                            <div class="col-md-3 col-sm-6">
                                <div class="company-content">
                                    <h6>Icon</h6>   
                                    <p>Upload Icon of your Company
                                        to display in website</p>                                   
                                </div>                                            
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="company-content">
                                    <div class="profile-upload">                             
                                        <span><img src="<?php echo base_url(); ?>assets/admin/img/icon/upload.svg" class="img-fluid" alt="Upload"></span>
                                        Upload Photo
                                        <input type="file" id="company_icon" name="company_icon">
                                    </div>
                                    <input type="hidden" id="hcompany_icon" name="hcompany_icon" value="<?php echo getenv('DB_COMPANY_ICON');?>">

                                    <p>Recommended image size is 16px x 16px or 32px x 32px.</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="company-content d-flex justify-content-end">
                                    <div class="logo-content upload-space">
                                        <img src="<?php echo base_url(); ?>uploads/website/<?=getenv('DB_COMPANY_ICON')?>" class="img-fluid" alt="Logo">
                                    </div>                                         
                                </div>    
                            </div> 
                        </div>
                                     								
                    </div>
                <!-- /Company Image -->
            </div>

            <div class="col-md-12 d-flex profile-card">

                <!-- Address Details -->
                    <div class="card card-table flex-fill card-details person-info add-details">
                        <div class="person-profile">
                            <h4>Address Details</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="inform-content">
                                    <label>Address</label>
                                    <input type="text" class="form-control"id="company_address" name="company_address" value="<?php echo getenv('DB_COMPANY_ADDRESS');?>">
                                </div>                                            
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="inform-content">
                                    <label>Country</label>
                                    <input type="text" class="form-control"id="company_country" name="company_country" value="<?php echo getenv('DB_COMPANY_COUNTRY');?>">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="inform-content">
                                    <label>State /  Province</label>
                                    <input type="text" class="form-control" id="company_state" name="company_state" value="<?php echo getenv('DB_COMPANY_STATE');?>">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="inform-content">
                                    <label>City</label>
                                    <input type="text" class="form-control"id="company_city" name="company_city" value="<?php echo getenv('DB_COMPANY_CITY');?>">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="inform-content">
                                    <label>Postal Code</label>
                                    <input type="text" class="form-control" id="company_postalcode" name="company_postalcode" value="<?php echo getenv('DB_COMPANY_POSTALCODE');?>">
                                </div>
                            </div>
                        </div>
                                     								
                    </div>
                <!-- /Address Details -->
            </div>

            <div class="acc-submit">
				<!-- <a href="#" class="btn btn-secondary">Cancel</a> -->
                <button type="button"  class="btn btn-secondary">Cancel</button>
				<!-- <a href="#" class="btn btn-primary">Save Changes</a> -->
                <button type="button" onclick="insertwebsitesettings()" class="btn btn-primary">Save Changes</button>
                <!-- <button type="button" id="saveButton" class="btn btn-primary">Save Changes</button> -->

			</div>
        
            
		</div>
        </form>
	</div>			
</div>
<!-- /Page Wrapper -->

<?php $this->load->view('admin/includes/footer'); ?>