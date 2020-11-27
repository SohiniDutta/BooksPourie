<!DOCTYPE html>
<html lang="en">
<head>
	__METATAGS__
	<title><?php echo isset($page_title)?$page_title : 'Login | Admin';  ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">
	<link rel="preload" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" as="font" crossorigin>
</head>
<body class="hold-transition login-page">
	<main>
		<?php  echo (isset($layout_content)?$layout_content:''); ?>
	</main>
</body>
</html>
