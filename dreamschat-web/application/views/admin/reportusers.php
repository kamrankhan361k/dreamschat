<?php $this->load->view('admin/includes/header'); ?>

<?php $this->load->view('admin/includes/adminheader'); ?>

<?php $this->load->view('admin/includes/rightsidebar'); ?>

<!-- Page Wrapper -->
<div class="page-wrapper">
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
    <div class="content container-fluid">
		<div class="page-header">
			<div class="page-title">
				<h4>Report Users <span class="count-details" id="report_total_count">0</span></h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 d-flex">
			
				<!-- Recent Orders -->
				<div class="card card-table flex-fill">
					<div class="card-body">
                        <div class='table-top'>
                            <div class='wordset'>
                            </div>
                            <ul>
                                <li>
                                    <div class="col-auto">
		                                <input type="text" id="search-userlistadmin-content" class="user-filter" placeholder="Search">
		                            </div>  
                                </li>
                            </ul>
                        </div>
						<div class="table-responsive">
							<table class="table datanews table-hover table-center mb-0" id="reporteruser-list-table">
								<thead>
									<tr>
										<th>S.No</th>
										<th>Name</th>
										<th>Phone Number</th>
										<th>Email Address</th>
										<th>Report Date</th>
										<th>Report Time</th>
										<th>Reported By </th>
										
										<th class="text-end">Action</th>
									</tr>
								</thead>
								<tbody>
				
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- /Recent Orders -->
				
			</div>
		</div>
	</div>			
</div>
<!-- /Page Wrapper -->

<!-- New Group -->
<div class="modal fade " id="add-users">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
					Add Users 
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span class="material-icons">close</span>
                </button>
            </div>
            <div class="modal-body">
				<div class="user-profiles-group mb-4">
                    <div class="profile-cover text-center">
                        <label class="profile-cover-avatar" for="avatar_upload">
                            <img class="avatar-img" src="<?php echo base_url(); ?>assets/admin/img/profiles/avatar-02.jpg" alt="Profile Image">
                            <input type="file" id="avatar_upload">
                            <span class="avatar-edit">
								<i class="bx bx-camera"></i>
                            </span>
                        </label>
                    </div>
                    <form >
						<div class="row">
							<div class="col-md-6">
								<div class="pass-login">
									<label class="form-label">First Name <span class="dark-red">*</span></label>
									<input type="password" class="form-control pass-input">
								</div>
							</div>
							<div class="col-md-6">
								<div class="pass-login">
									<label class="form-label">Last Name <span class="dark-red">*</span></label>
									<input type="password" class="form-control pass-input">
								</div>
							</div>
							<div class="col-md-12">
								<div class="pass-login">
									<label class="form-label">Email Addess <span class="dark-red">*</span></label>
									<input type="email" class="form-control pass-input">
								</div>
							</div>
							<div class="col-md-12">
								<div class="pass-login">
									<label class="form-label">Phone Number <span class="dark-red">*</span></label>
									<input class="form-control form-control-lg group_formcontrol" id="phone" name="phone" type="text">
								</div>
							</div>
							<div class="col-md-12">
								<div class="pass-login">
									<label class="form-label">Country</label>
									<select class="select">
										<option>Select Country</option>
										<option >America</option>
									</select>
								</div>
							</div>
						</div>
                    </form>
				</div>
                <div class="mute-chat-btn">
                    <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                        <i class="feather-check me-1"></i>Add User
                    </a>
                    <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                        <i class="feather-x me-1"></i>Cancel
                    </a>
                </div>
            </div>       
        </div>
    </div>
</div>
<!-- /New Group -->

<!-- Report -->
<div class="modal fade" id="report-reason">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
					Report Reason
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span class="material-icons">close</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="block-user-blk ">
                    <p>Directing hate against a protected category (e.g., race, religion, 
						gender, orientation, disability)</p>
                </div>
                <div class="mute-chat-btn ">
                    <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                        ok
                    </a>
                    <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                        Cancel
                    </a>
                </div>
            </div>       
        </div>
    </div>
</div>
<!-- /Report -->

<?php $this->load->view('admin/includes/footer'); ?>