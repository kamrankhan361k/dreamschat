<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

		<meta name="description" content="Template Content">
		<meta name="keywords" content="Template Keywords">
		<meta name="author" content="Dreamguys - DreamsChat">
		
        <title><?php echo getenv('DB_WEBSITE_NAME'); ?> Admin Panel</title>
		
		<!-- Favicon -->
		<?php
		$favicon=base_url().'assets/admin/img/favicon.png';
		if(!empty(getenv('DB_WEBSITE_FAVICON'))) {
			$fav = base_url().'uploads/website/'.getenv('DB_WEBSITE_FAVICON');
	    } else {
	    	$fav = $favicon; 
	    }
		?>
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo $fav;?>">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css">
		
		<!-- Feathericon CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/feather.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/fontawesome/css/all.min.css">

		<!-- Boxicons CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/boxicons/css/boxicons.min.css">

		<!-- Datepicker CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-datetimepicker.min.css">

		<!-- Datatables CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/datatables/datatables.min.css">

		<!-- Mobile CSS-->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/intltelinput/css/intlTelInput.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/intltelinput/css/demo.css">
		
		<!-- Morris CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/morris/morris.css">

		<!-- Select CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/select2/css/select2.min.css">

		<!-- Summernote JS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/summernote/summernote-lite.min.css">

		<!-- Toatr CSS -->		
		<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/admin/plugins//toastr/toatr.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/style.css">
        
    </head>
    <body>
