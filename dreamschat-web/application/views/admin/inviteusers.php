<?php $this->load->view('admin/includes/header'); ?>

<?php $this->load->view('admin/includes/adminheader'); ?>

<?php $this->load->view('admin/includes/rightsidebar'); ?>

<!-- Page Wrapper -->
<div class="page-wrapper">

    <div class="content container-fluid">
		<div class="page-header">
			<div class="page-title">
				<h4>Invite Users <span class="count-details">150</span></h4>
			</div>
			<div class="page-btn">
				<ul>
					<li>
						<a href="javascript:;" class="btn btn-white comman-file file-pdf ">
						<i class="bx bxs-file-pdf "></i></a>
					</li>
					<li>
						<a href="javascript:;" class="btn btn-white comman-file file-text">
						<i class="bx bxs-file "></i></a>
					</li>
					<li>
						<a href="javascript:;" class="btn btn-white center-flex ">
						<i class="bx bx-import me-1"></i>Import</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 d-flex">
			
				<!-- Recent Orders -->
				<div class="card card-table flex-fill">
					<div class="card-body">
						<div class="table-top">
							<div class="wordset">
								<ul>
									<li>
										<div class="pass-login">
											<span class="select-users-blk"><i class="bx bx-user"></i></span>
											<select class="select">
												<option>Select User</option>
												<option >Alexander Manuel</option>
												<option >Elizabeth Sosa</option>
											</select>
										</div>
									</li>
									<li>
										<div class="pass-login">
											<div class="cal-icon">
												<span><i class="bx bx-calendar"></i></span>
												<input type="text" class="form-control date-range datetimepicker" placeholder="Date Range">
											</div>
										</div>
									</li>
									<li>
										<a href="javascript:;" class="refine-filter"><span><i class="bx bx-sort-down me-1"></i></span>Refine filter</a>
									</li>
								</ul>
							</div>
							<div class="search-set">
								<div class="search-input">
									<a class="btn btn-searchset"><i class="bx bx-search"></i></a>
								</div>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table datanew table-hover table-center mb-0">
								<thead>
									<tr>
										<th>
											<label class="checkboxs">
												<input type="checkbox" id="select-all">
												<span class="checkmarks"></span>
											</label>
										</th>
										<th>Name</th>
										<th>Phone Number</th>
										<th>Email Address</th>
										<th>Invite Date</th>
										<th>Invite Time</th>
										<th>Country </th>
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