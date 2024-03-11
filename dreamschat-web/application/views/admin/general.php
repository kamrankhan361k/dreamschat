<?php $this->load->view('admin/includes/header'); ?>
    <body>
	
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
								<h3 class="page-title">General Settings</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>home">Dashboard</a></li>
									<li class="breadcrumb-item active">General Settings</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="row settings-tab">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">General Settings</h4>
								</div>
								<div class="card-body">
									<form action="#">
										<div class="form-group">
											<label>Name</label>
											<input type="text" class="form-control" value="Seemasisty">
										</div>
										<div class="form-group">
											<label>Email Address</label>
											<input type="email" class="form-control" value="sisty@gmail.com">
										</div>
										<div class="form-group">
											<label>Username</label>
											<input type="text" class="form-control" value="Seema">
										</div>
										<div class="form-group">
											<label>Password</label>
											<input type="password" class="form-control" value="seemas12345">
										</div>
										<div class="text-right">
											<button type="submit" class="btn btn-primary">Submit</button>
										</div>
									</form>
								</div>
							</div>
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