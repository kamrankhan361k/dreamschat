<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
		<div id="sidebar-menu" class="sidebar-menu">
			<ul>
				<li class="menu-title">Main Menu</li>
				<li class="<?php if($this->uri->segment(1) == "admin-dashboard") echo "active" ?>"> 
					<a href="<?php echo base_url(); ?>admin-dashboard"><i class="bx bx-category"></i> <span>Dashboard</span></a>
				</li>
				<li class="submenu <?php if($this->uri->segment(1) == "admin-users" || $this->uri->segment(1) == "admin-blocked-users" || $this->uri->segment(1) == "admin-report-users"  || $this->uri->segment(1) == "admin-invite-users") echo "active" ?>">
					<a href="#"><i class="bx bx-user"></i> <span> Users</span> <span class="menu-arrow"></span></a>
					<ul >
						<li><a class="<?=($this->uri->segment(1) == "admin-users") ? 'active':''?>" href="<?php echo base_url(); ?>admin-users"><i class="bx bxs-circle me-1"></i>Users List</a></li>

						<li><a href="<?php echo base_url(); ?>admin-blocked-users" class="<?=($this->uri->segment(1) == "admin-blocked-users") ? 'active':''?>"><i class="bx bxs-circle me-1"></i>Blocked Users</a></li>

						<li><a href="<?php echo base_url(); ?>admin-report-users" class="<?=($this->uri->segment(1) == "admin-report-users") ? 'active':''?>"><i class="bx bxs-circle me-1"></i>Reported Users</a></li>

						<!-- <li><a href="<?php echo base_url(); ?>admin-invite-users" class="<?=($this->uri->segment(1) == "admin-invite-users") ? 'active':''?>"><i class="bx bxs-circle me-1"></i>Invited Users</a></li> -->
					</ul>
				</li>
				<li class="<?php if($this->uri->segment(1) == "admin-chats") echo "active" ?>">
					<a href="<?php echo base_url(); ?>admin-chats"><i class="bx bx-message-square-detail"></i> <span> Chat </span></a>
				</li>
				<li class="<?php if($this->uri->segment(1) == "admin-calls") echo "active" ?>">
					<a href="<?php echo base_url(); ?>admin-calls"><i class="bx bx-phone"></i> <span> Calls </span></a>
				</li>
				<li class="<?php if($this->uri->segment(1) == "admin-stories") echo "active" ?>">
					<a href="<?php echo base_url(); ?>admin-stories"><i class="bx bx-stop-circle"></i> <span> Stories </span></a>
				</li>
				<li class="menu-title">Settings</li>
				<li class="submenu <?php if($this->uri->segment(1) == "profile-settings" || $this->uri->segment(1) == "admin-website" || $this->uri->segment(1) == "system-settings" || $this->uri->segment(1) == "notification-settings" || $this->uri->segment(1) == "localization-settings" || $this->uri->segment(1) == "appearance-settings" || $this->uri->segment(1) == "social-auth-settings" || $this->uri->segment(1) == "email-settings" || $this->uri->segment(1) == "sms-settings" || $this->uri->segment(1) == "otp-settings" || $this->uri->segment(1) == "authentication-settings" || $this->uri->segment(1) == "storage-settings" || $this->uri->segment(1) == "ban-address" || $this->uri->segment(1) == "gdpr-settings" || $this->uri->segment(1) == "language-settings") echo "active" ?>">
					<a href="#"><i class="bx bx-cog"></i> <span> Settings </span> <span class="menu-arrow"></span></a>
					<ul >
					<li><a class="<?php if($this->uri->segment(1) == "profile-settings") echo "active" ?>" href="<?php echo base_url(); ?>profile-settings"><i class="bx bxs-circle me-1"></i>Profile Setting </a></li>

						<li><a class="<?php if($this->uri->segment(1) == "admin-website") echo "active" ?>" href="<?php echo base_url(); ?>admin-website"><i class="bx bxs-circle me-1"></i>Website Setting </a></li>

						<li><a class="<?php if($this->uri->segment(1) == "system-settings") echo "active" ?>" href="<?php echo base_url(); ?>system-settings"><i class="bx bxs-circle me-1"></i>System Setting </a></li>

						<?php /* <li><a class="<?php if($this->uri->segment(1) == "notification-settings") echo "active" ?>" href="<?php echo base_url(); ?>notification-settings"><i class="bx bxs-circle me-1"></i>Notification </a></li>

						<li><a class="<?php if($this->uri->segment(1) == "localization-settings") echo "active" ?>" href="<?php echo base_url(); ?>localization-settings"><i class="bx bxs-circle me-1"></i>Localization </a></li> */ ?>

						<li><a class="<?php if($this->uri->segment(1) == "appearance-settings") echo "active" ?>" href="<?php echo base_url(); ?>appearance-settings"><i class="bx bxs-circle me-1"></i>Appearance </a></li>

						<?php /* <li><a class="<?php if($this->uri->segment(1) == "social-auth-settings") echo "active" ?>" href="<?php echo base_url(); ?>social-auth-settings"><i class="bx bxs-circle me-1"></i>Social Authentication </a></li>

						<li><a class="<?php if($this->uri->segment(1) == "email-settings") echo "active" ?>" href="<?php echo base_url(); ?>email-settings"><i class="bx bxs-circle me-1"></i>Email Setting </a></li>

						<li><a class="<?php if($this->uri->segment(1) == "sms-settings") echo "active" ?>" href="<?php echo base_url(); ?>sms-settings"><i class="bx bxs-circle me-1"></i>SMS Setting </a></li>

						<li><a class="<?php if($this->uri->segment(1) == "otp-settings") echo "active" ?>" href="<?php echo base_url(); ?>otp-settings"><i class="bx bxs-circle me-1"></i>OTP Setting </a></li> 

						<li><a class="<?php if($this->uri->segment(1) == "authentication-settings") echo "active" ?>" href="<?php echo base_url(); ?>authentication-settings"><i class="bx bxs-circle me-1"></i>Authentication </a></li>*/ ?>

						<?php /* <li><a class="<?php if($this->uri->segment(1) == "storage-settings") echo "active" ?>" href="<?php echo base_url(); ?>storage-settings"><i class="bx bxs-circle me-1"></i>Storage </a></li>

						<li><a class="<?php if($this->uri->segment(1) == "ban-address") echo "active" ?>" href="<?php echo base_url(); ?>ban-address"><i class="bx bxs-circle me-1"></i>Ban IP Address </a></li>

						<li><a class="<?php if($this->uri->segment(1) == "gdpr-settings") echo "active" ?>" href="<?php echo base_url(); ?>gdpr-settings"><i class="bx bxs-circle me-1"></i>GDPR (Cookies) </a></li> */ ?>

						<li><a class="<?php if($this->uri->segment(1) == "language-settings") echo "active" ?>" href="<?php echo base_url(); ?>language-settings"><i class="bx bxs-circle me-1"></i>Language </a></li>
						<li><a class="<?php if($this->uri->segment(1) == "language-keyword") echo "active" ?>" href="<?php echo base_url(); ?>language-keyword"><i class="bx bxs-circle me-1"></i>Language Keywords </a></li>
					</ul>
				</li>
			</ul>
			<div class="flags-group d-none">
				<div class="dropdown has-arrow flag-nav">
					<a class="nav-link dropdown-toggle " data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
						<img src="<?php echo base_url(); ?>assets/admin/img/flag/flag-01.png" class="me-2" alt="flag"><span>English</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right" >
						<a href="javascript:void(0);" class="dropdown-item">
							<img src="<?php echo base_url(); ?>assets/admin/img/flag/flag-01.png" alt="flag"><span>English</span>
						</a>
						<a href="javascript:void(0);" class="dropdown-item">
							<img src="<?php echo base_url(); ?>assets/admin/img/flag/flag-01.png" alt="flag"><span>French</span>
						</a>
						<a href="javascript:void(0);" class="dropdown-item">
							<img src="<?php echo base_url(); ?>assets/admin/img/flag/flag-01.png" alt="flag"><span>Spanish</span>
						</a>
						<a href="javascript:void(0);" class="dropdown-item">
							<img src="<?php echo base_url(); ?>assets/admin/img/flag/flag-01.png" alt="flag"><span>German</span>
						</a>
					</div>
				</div>
				<!-- <div class="unlimited-access">
					<h6>Unlimited Access</h6>
					<p>Upgrade your system to 
						business plan</p>
					<a class="btn btn-primary">Upgrade</a>
					<div class="plane-img">
						<img src="<?php echo base_url(); ?>assets/admin/img/plane.png" alt="image">
					</div>
				</div> -->
			</div>
		</div>
    </div>
</div>
<!-- /Sidebar -->