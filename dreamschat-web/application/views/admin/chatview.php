<?php $this->load->view('admin/includes/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/adminchat.css">
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
								<h3 class="page-title">Chat View</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
									<li class="breadcrumb-item active">Chat View</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 d-flex">
						
							<!-- Recent Orders -->
							<div class="card card-table flex-fill">
								<div class="card-body">
									<div class="table-responsive chat">
											 <div class="chat-body">
											 	<b id="empty_msg">No Data Found</b>
												<div class="messages chatview-all-list" >
											</div>	
												
											</div>
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
		<script type="text/javascript">
			var baseUrl = <?php echo '"'.base_url().'"' ?>;
			
		</script>		
    </body>
</html>