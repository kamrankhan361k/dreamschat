<!-- Header -->
<div class="header">
	<!-- Logo -->
    <div class="header-left">
    	<?php
		$weblogo=base_url().'assets/admin/img/logo.png';
		if(!empty(getenv('DB_COMPANY_LOGO'))) {
			$logo = base_url().'uploads/website/'.getenv('DB_COMPANY_LOGO');
	    } else {
	    	$logo = $weblogo;
	    }

	    $small_weblogo=base_url().'assets/admin/img/logo-small.png';
		if(!empty(getenv('DB_WEBSITE_FAVICON'))) {
			$logo_small = base_url().'uploads/website/'.getenv('DB_WEBSITE_FAVICON');   
	    } else {
	    	$logo_small = $small_weblogo;
	    }
		?>
        <a href="<?php echo base_url(); ?>admin-dashboard" class="logo">
			<img src="<?php echo $logo;?>" alt="Logo">
		</a>
		<a href="<?php echo base_url(); ?>admin-dashboard" class="logo logo-small">
			<img src="<?php echo $logo_small;?>" alt="Logo" width="30" height="30">
		</a>
    </div>
	<!-- /Logo -->
	<div class="toggle-group">
		<a href="javascript:void(0);" id="toggle_btn">
			<i class="bx bx-arrow-from-right"></i>
		</a>
	</div>
	
	<!-- Mobile Menu Toggle -->
	<a class="mobile_btn" id="mobile_btn">
		<i class="fa fa-bars"></i>
	</a>
	<!-- /Mobile Menu Toggle -->
	
	<!-- Header Right Menu -->
	<ul class="nav user-menu">
		
		<li class="nav-item dark-group">
			<div class="dark-option">
				<a href="#" id="light-mode-togglse" class="<?=(getenv('DB_INTERFACE_THEME') == "light") ? 'active':''?>" onclick="lightappearancesettings()">
					<i class="bx bx-brightness"></i>
				</a>
				<a href="#" id="dark-mode-toggles" class="<?=(getenv('DB_INTERFACE_THEME') == "dark") ? 'active':''?>" onclick="darkappearancesettings()">
					<i class="bx bx-moon"></i>
				</a>
			</div>
		</li>
		
		<!-- User Menu -->
		<li class="nav-item dropdown has-arrow drop-user-profile">
			<a href="#" class="dropdown-toggle nav-link name-profile" data-bs-toggle="dropdown">
				<span class="user-profile-grp">
					<span class="user-img"><img class="rounded-circle admin_img" src=""  alt="profile img"></span>
					<span class="user-detail">
						<span class="drop-user-name admin_name" id="admin_name"></span>
						<?php if ($this->session->userdata('admin_id') == 'admin') { ?>
							<span class="drop-user-role">Administrator</span>
						<?php } else { ?>
							<span class="drop-user-role">Demo</span>
						<?php } ?>
					</span>
				</span>
			</a>
			<div class="dropdown-menu">
				<div class="user-header">
					<div class="avatar avatar-sm">
						<img src="" alt="User Image" class="avatar-img rounded-circle admin_img">
					</div>
					<div class="user-text">
						<h6 class="admin_name">Seema Sisty</h6>
						<?php if ($this->session->userdata('admin_id') == 'admin') { ?>
							<p class="text-muted mb-0">Administrator</p>
						<?php } else { ?>
							<p class="text-muted mb-0">Demo</p>
						<?php } ?>
					</div>
				</div>
				<a class="dropdown-item" href="<?php echo base_url(); ?>profile-settings">My Profile</a>
				<a class="dropdown-item" href="<?php echo base_url(); ?>admin/logout">Logout</a>
			</div>
		</li>
		<!-- /User Menu -->
		
	</ul>
	<!-- /Header Right Menu -->
	
</div>
<!-- /Header -->