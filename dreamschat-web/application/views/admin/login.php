<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo getenv('DB_WEBSITE_NAME'); ?> Admin Panel</title>
	
	<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>uploads/website/<?=getenv('DB_WEBSITE_FAVICON')?>">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
    	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome/css/fontawesome.min.css">
    	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome/css/all.min.css">
		
		<!-- App styles -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/style.css">
		
</head>

	<body class="login-form">

		<!-- Main Wrapper -->
	<div class="main-wrapper register-surv">
        <div class="container-fluid">
            <div class="login-wrapper">
                <header class="logo-header">
                    <a href="index.html" class="logo-brand">
                        <img src="./assets/admin/img/admin-logo.png" alt="Logo" class="img-fluid logo-dark">
                    </a>
                </header>
                <div class="login-inbox admin-login">
                    <div class="log-auth">
                        <div class="login-auth-wrap">
                            <div class="login-content-head">
                                <h3>Login</h3>
                            </div>
                        </div>
                        <form id="admin-login-form" action="<?php echo base_url();?>admin/login" method="post">
                        	<p class="text-danger text-center"><?php echo isset($error) ? $error : ''; ?></p> 
							<p class="text-danger text-center" id="invalid">Invalid Credential</p>
							<p class="text-danger text-center" id="invalid_pass"></p>
                            <div class="form-group">
                                <label class="form-label">Email Address <span>*</span></label>
                                <input class="form-control form-control-lg group_formcontrol" type="text" id="username" name="username" placeholder="Enter Email" value="demo@gmail.com">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password <span>*</span></label>
                                <div class="pass-group">
                                    <input class="form-control form-control-lg group_formcontrol pass-input" type="password" id="password" name="password" placeholder="Enter password" value="123456">
                                    <span class="fas fa-eye toggle-password"></span>
                                </div>
                            </div>
                            <!-- <div class="form-group form-remember d-flex align-items-center justify-content-between">
                                <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                    <label class="custom-check mt-0 mb-0">
                                        <span class="remember-me">Remember Me</span>
                                        <input type="checkbox" name="remeber">                                        
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <span class="forget-pass">
                                    <a href="forgot-password.html">
                                        Forgot Password
                                    </a>
                                </span>
                            </div> -->
                            <button type="submit" class="btn btn-primary w-100 btn-size justify-content-center">Login</button>
                        </form>
                    </div>
                </div>                
            </div>            
        </div>
	</div>
	<!-- /Main Wrapper -->
</body>

<div>
<input type="hidden" id="apiKey" value="<?php echo getenv('DB_FIREBASE_APIKEY')?>" />
<input type="hidden" id="authDomain" value="<?php echo getenv('DB_FIREBASE_AUTHDOMAIN')?>" />
<input type="hidden" id="databaseURL" value="<?php echo getenv('DB_FIREBASE_DBURL')?>" />
<input type="hidden" id="projectId" value="<?php echo getenv('DB_FIREBASE_PROJECTID')?>" />
<input type="hidden" id="storageBucket" value="<?php echo getenv('DB_FIREBASE_STORAGEBUGKET')?>" />
<input type="hidden" id="messagingSenderId" value="<?php echo getenv('DB_FIREBASE_MESSAGEID')?>" />
<input type="hidden" id="appId" value="<?php echo getenv('DB_FIREBASE_APPID')?>" />
<input type="hidden" id="baseUrl" value="<?php echo base_url()?>" />
</div>
<!-- jQuery -->

<script src="<?php echo base_url(); ?>assets/js/jquery-3.7.0.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/mainconfig.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.9.1/firebase.js"></script>
<script src="<?php echo base_url(); ?>assets/js/fireconfig.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>
<script type="text/javascript">
	$('#invalid').hide();
	$("#admin-login-form").on("submit", function() {
	    var email = $("#username").val();
	    var password = $("#password").val();
	    $.ajax({
	        url: 'admin/admin_crdentials',
	        type: 'POST',
	        data: {
	            email: email, 
        	},
        success: function(data) {
		    if (data != 'Failed') {
			    firebase.auth().signInWithEmailAndPassword(email, password)
				  .then((userCredential) => {
				    // Signed in 
				    var user = userCredential.user;
				    if (email == "admin@gmail.com") {
				    	var admin_id = 'admin';
				    } else {
				    	var admin_id = 'demo';
				    }
				    $.ajax({
		                url: 'admin/login_view',
		                type: 'POST',
		                data: {
		                    admin_id: admin_id,
		                    admin: data,
		                },
		                success: function(data) {
		                	window.location.href = 'admin-dashboard';
		                }
		            });
				  })
				  .catch((error) => {
				  	//alert(error.message);return false;
				  	$('#invalid').hide();
				  	$('#invalid_pass').html(error.message);
				    var errorCode = error.code;
				    var errorMessage = error.message;
				  });
			} else {
				$('#invalid').show();
			}
		}
		});
	    return false;
  	});
</script>