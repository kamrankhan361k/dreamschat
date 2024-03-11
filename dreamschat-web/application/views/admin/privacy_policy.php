<?php $this->load->view('admin/includes/header'); ?>
    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			
			<!-- /Header -->
			<?php $this->load->view('admin/includes/adminheader'); ?>
			<?php $this->load->view('admin/includes/rightsidebar'); ?>
			
					<!-- Page Wrapper -->
            <div class="page-wrapper">
			
                <div class="content container-fluid">

                	<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Privacy Policy</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
									<li class="breadcrumb-item active">Privacy Policy</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="row settings-tab">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Privacy Policy</h4>
								</div>
								<div class="card-body">
									<form action="" method="post" enctype="multipart/form-data">
										
										<div class="form-group">
											<label>Privacy Policy(User to accept)</label>
											<textarea id="editor2" name="editor">
                                              <!-- <?php  
											  //$this->load->helper('file');
											  //$file_content = read_file('assets/privacy_policy.txt');
											  //echo $file_content;
											  ?> -->
                                            </textarea>
										</div>
										<!-- onclick="setabout()" -->
										<?php if($this->session->userdata('admin_id') == 'admin'){ ?>
										<div class="text-right">
											<button type="Button" onclick="setabout()" class="btn btn-primary">Submit</button>
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
		<script src="<?=base_url()?>assets/ckeditor/ckeditor.js"></script>
		<script type="text/javascript">
			getpages();
		    CKEDITOR.replace('editor2', {
		      // Define the toolbar groups as it is a more accessible solution.
		      toolbarGroups: [{
		          "name": "basicstyles",
		          "groups": ["basicstyles"]
		        },
		        {
		          "name": "links",
		          "groups": ["links"]
		        },
		        {
		          "name": "paragraph",
		          "groups": ["list", "blocks"]
		        },
		        {
		          "name": "document",
		          "groups": ["mode"]
		        },
		        {
		          "name": "insert",
		          "groups": ["insert"]
		        },
		        {
		          "name": "styles",
		          "groups": ["styles"]
		        },
		        {
		          "name": "about",
		          "groups": ["about"]
		        }
		      ],
		      // Remove the redundant buttons from toolbar groups defined above.
		      removeButtons: 'Save,Subscript,Superscript,Styles,Specialchar'
		    });

			function setabout() 
			{
				var privacy_policy = CKEDITOR.instances["editor2"].getData();
	        	//save 
				firebase.database().ref("data/websitepages").update({privacy_policy:privacy_policy});
				swal({
                        title: "Success!",
                        text: "Privacy Policy Added Successfully",
                        type: "success"
                    }).then(function() {
                        window.location.reload();
                    });
				getpages();
			}
			function getpages() {
				firebase.database().ref("data/websitepages").once('value', function(snapshot) {
		            if (snapshot.val() != null) {
		            	CKEDITOR.instances['editor2'].setData(snapshot.val().privacy_policy);
		            }
		        });
			}
		</script>
    </body>
</html>