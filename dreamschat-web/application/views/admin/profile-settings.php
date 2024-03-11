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
				<h4>Profile Setting</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 d-flex profile-card">
			
				<!-- Profile Pic -->
				<div class="card card-table flex-fill card-details">
                    <div class="profile-photo-wrapper d-flex align-items-center">
                        <div class="profile-cover text-center">
                            <div class="profile-photo">
                                <label class="profile-cover-avatar mb-0" for="avatar_upload">
                                   <img class="avatar-img admin_img_pre" id="previewImage" src="" alt="Profile Image">
                               </label>
                            </div>
                        </div>
                        <div class="profile-content">
                        <div class="profile-upload">                                        
                            <span><img src="<?php echo base_url(); ?>assets/admin/img/icon/upload.svg" class="img-fluid" alt="Upload"></span>
                                Upload Photo
                            <input type='file'  id='profile_photo'  accept='image/x-png,image/gif,image/jpeg' name='profilefiles[]' class='form-control' placeholder="upload a photo" >
                            
                        </div>
                            
                    </div>
                    </div>                                								
				</div>
				<!-- /Profile Pic -->                           
				
			</div>

            <div class="col-md-12 d-flex profile-card">

                <!-- Personal Information -->
                    <div class="card card-table flex-fill card-details person-info">
                        <div class="person-profile">
                            <h4>Personal Information</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="inform-content">
                                    <label>First Name</label>
                                    <input type="text" class="form-control"  id = "first_name" name = "first_name">
                                </div>                                            
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="inform-content">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" id= "last_name" name = "last_name">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="inform-content">
                                    <label>User Name</label>
                                    <input type="text" class="form-control" id="user_name" name="user_name">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="inform-content">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control" id = "email_id" name = "email_id">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="inform-content">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number" pattern = '\+[0-9\s\-\(\)]+'>
                                </div>
                            </div>
                        </div>
                                     								
                    </div>
                <!-- /Personal Information -->
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
                                    <input type="text" class="form-control" id="address" name="address">
                                </div>                                            
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="inform-content">
                                    <label>Country</label>
                                    <input type="text" class="form-control" id="country" name="country">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="inform-content">
                                    <label>State /  Province</label>
                                    <input type="text" class="form-control" id="state" name="state">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="inform-content">
                                    <label>City</label>
                                    <input type="text" class="form-control" id="city" name="city">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="inform-content">
                                    <label>Postal Code</label>
                                    <input type="text" class="form-control" id="postal_code" name="postal_code">
                                </div>
                            </div>
                        </div>
                                     								
                    </div>
                <!-- /Address Details -->
            </div>

            <div class="acc-submit">
				<a href="#" class="btn btn-secondary">Cancel</a>
				<a href="#" class="btn btn-primary" onclick = 'addprofiles()'>Save Changes</a>
                <!-- <a href="#" class="btn btn-primary" onclick = 'profilesettings()'>Save Changes</a> -->
			</div>

		</div>
	</div>			
</div>
<!-- /Page Wrapper -->

<?php $this->load->view('admin/includes/footer'); ?>