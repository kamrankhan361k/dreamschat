<?php $this->load->view('admin/includes/header'); ?>
    <body>
		<style>
			table { 
				  table-layout: fixed;
				  width: 100%
				}
	  		td {

			    /* css-3 */
			    white-space: -o-pre-wrap; 
			    word-wrap: break-word;
			    white-space: pre-wrap; 
			    white-space: -moz-pre-wrap; 
			    white-space: -pre-wrap; 

			}
	    </style>
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
							<div class="col-md-8">
								<h3 class="page-title">Abuse Messages</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
									<li class="breadcrumb-item active">Abuse Messages</li>
								</ul>
							</div>

						</div>
					</div>

					<div class="row">
						<div class="col-md-12 d-flex">
						
							<!-- Recent Orders -->
							<div class="card flex-fill">
								<div class="card-header">
		                            <h5>Listing Last 100 data</h5>
			                    </div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-hover table-center mb-0" width="100%">
											<thead>
												<tr>
													<th>Reported By</th>
													<th>Report User</th>
													<th>Date</th>
													<th>Message</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody class="report-list"></tbody>
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
		<!-- Message -->
		<div class="modal fade" id="modal-vmsg">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Message Content</h4>
		        		<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="message_content"></div>
					</div>
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        </div>
				</div>
			</div>
		</div>

		<!-- Block -->
		<div class="modal fade" id="modal-confirm">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Confirmation Block</h4>
		        		<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<b id="msg"></b>
						<input type="hidden" id="block_user_id" value="">
					</div>
					<div class="modal-footer">
						<button type="button" id="blk_btn" class="btn btn-danger" data-dismiss="modal" onclick="blockuser();">Block</button>
				        <button type="button" id="cls_btn" class="btn btn-secondary" data-dismiss="modal">Close</button>

			        </div>
				</div>
			</div>
		</div>
		<?php $this->load->view('admin/includes/footer'); ?>
		<script src="<?php echo base_url(); ?>assets/js/abusemessage.js"></script>
    </body>
</html>
