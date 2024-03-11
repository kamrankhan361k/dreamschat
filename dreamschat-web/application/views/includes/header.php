<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <meta name="description" content="DreamsChat">
    <meta name="keywords" content="Caht, Groups, Status, Calls">
    <meta name="author" content="Dreamguys - DreamsChat">

	<title><?=ucwords(getenv('DB_WEBSITE_NAME'))?></title>
	
    <!-- Favicon -->
    <link rel="icon" href="<?php echo base_url(); ?>uploads/website/<?=getenv('DB_WEBSITE_FAVICON')?>">
	
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">

    <!-- Feathericon CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/feather.css">
	
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome/css/all.min.css">

    <!-- Swiper CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/swiper/swiper.min.css">

    <!-- FancyBox CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fancybox/jquery.fancybox.min.css">

    <!-- Boxicons CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/boxicons/css/boxicons.min.css">

    <!-- Select CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/css/select2.min.css">

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css">

	 <!-- Dropzone -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/dropzone/dropzone.min.css">

    <!-- Toatr CSS -->		
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/plugins//toastr/toatr.css">
    
    <?php if($this->uri->segment(1) == 'register' || $this->uri->segment(1) == 'forgot-password' || $this->uri->segment(1) == 'phone-login' || $this->uri->segment(1) == 'group' || $this->uri->segment(1) == 'contacts' || $this->uri->segment(1) == 'settings') { ?>
	    <!-- Mobile CSS-->
	    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/intltelinput/css/intlTelInput.css">
	    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/intltelinput/css/demo.css">
	<?php } ?>
	
    <!-- App CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/app.css">
    <link href="<?php echo base_url(); ?>assets/css/emoji.css" rel="stylesheet">
</head>

<body <?php if($this->uri->segment(1) == "login" || $this->uri->segment(1) == "register" || $this->uri->segment(1) == "email-login" || $this->uri->segment(1) == "phone-login" || $this->uri->segment(1) == "forgot-password" || $this->uri->segment(1) == "reset-password" || $this->uri->segment(1) == "mobile-otp") { ?>class="login-form" <?php } ?>>