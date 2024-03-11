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
								<h3 class="page-title">Firebase Settings</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
									<li class="breadcrumb-item active">Firebase Settings</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="row settings-tab">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Firebase Settings</h4>
								</div>
								<div class="card-body">
									<form action="#">
										<div class="form-group">
											<label>Application Key</label>
											<input type="text" required class="form-control" id="appkey" name="appkey" value="<?php echo getenv('DB_FIREBASE_APIKEY');?>">
										</div>
										<div class="form-group">
											<label>Authenticated Domain</label>
											<input type="text" required class="form-control" id="authdomain" name="authdomain" value="<?php echo getenv('DB_FIREBASE_AUTHDOMAIN');?>">
										</div>
										<div class="form-group">
											<label>Database Url</label>
											<input type="text" required class="form-control" id="dburl" name="dburl" value="<?php echo getenv('DB_FIREBASE_DBURL');?>">
										</div>
										<div class="form-group">
											<label>Project Id</label>
											<input type="text" required class="form-control" id="projectid" name="projectid" value="<?php echo getenv('DB_FIREBASE_PROJECTID');?>">
										</div>
										<div class="form-group">
											<label>Storage Bucket</label>
											<input type="text" required class="form-control" id="storagebugket" name="storagebugket" value="<?php echo getenv('DB_FIREBASE_STORAGEBUGKET');?>">
										</div>
										<div class="form-group">
											<label>Message Id</label>
											<input type="text" required class="form-control" id="messageid" name="messageid" value="<?php echo getenv('DB_FIREBASE_MESSAGEID');?>">
										</div>
										<div class="form-group">
											<label>Application Id</label>
											<input type="text" required class="form-control" id="appid" name="appid" value="<?php echo getenv('DB_FIREBASE_APPID');?>">
										</div>
										<?php if($this->session->userdata('admin_id') == 'admin'){ ?>
										<div class="text-right">
											<button type="button"  onclick="insertfirbasevalue()" class="btn btn-primary">Submit</button>
										</div>
										<?php } ?>
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