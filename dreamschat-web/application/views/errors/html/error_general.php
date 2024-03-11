<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Error</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/error.css">
</head>
<body>
	<div id="container">
		<h1><?php echo html_escape($heading); ?></h1>
		<?php echo html_escape($message); ?>
	</div>
</body>
</html>