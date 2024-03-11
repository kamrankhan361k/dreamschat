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
									<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
									<li class="breadcrumb-item active">Agora Settings</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="row settings-tab">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Agora Settings</h4>
								</div>
								<div class="card-body">
									<form action="#">
										<div class="form-group">
											<label>Agora Application key</label>
											<input type="text" required name="agora_appkey" id="agora_appkey" class="form-control" value="<?php echo getenv('DB_AGORA_APIID');?>">
										</div>	
										<?php if($this->session->userdata('admin_id') == 'admin') {?>
										<div class="text-right">
											<button type="button" onclick="insertagora()" class="btn btn-primary">Submit</button>
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