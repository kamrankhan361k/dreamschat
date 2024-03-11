<?php $this->load->view('admin/includes/header'); ?>
    <body>
		<div id="page-loader"><img src="<?php echo base_url(); ?>assets/img/loader.gif"></div>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<?php $this->load->view('admin/includes/adminheader'); ?>
			
			<?php $this->load->view('admin/includes/rightsidebar'); ?>
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
                <div class="content container-fluid">

                	<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Groups</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
									<li class="breadcrumb-item active">Report User</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 d-flex">
						
							<!-- Recent Orders -->
							<div class="card card-table flex-fill">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-hover table-center mb-0" id="groupchat">
											<thead>
												<tr>
													<th>Group Name</th>
													<th>Group Description</th>
													<th>Members</th>
													<th class="text-center">Chat Count</th>
													<th  class="text-center">Registered Date</th>	
													<th  class="text-right">Action</th>
												</tr>
											</thead>
											<tbody class="group-all-list">
												
												
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
		
        </div>
		<!-- /Main Wrapper -->
		<?php $this->load->view('admin/includes/footer'); ?>
		
    </body>
</html>