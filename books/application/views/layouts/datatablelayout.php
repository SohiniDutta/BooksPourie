<!DOCTYPE html>
<html lang="en">
<head>
	__METATAGS__
	__CSSLINKS__
	<link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/dataTables.bootstrap4.min.css'; ?>">
	<link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/responsive.bootstrap4.min.css'; ?>">
	<title><?php echo isset($page_title) ? $page_title : 'Admin'; ?></title>
</head>
<body class="hold-transition sidebar-mini text-sm">
 <div class="wrapper">
	__HEADER__
	__SIDEBAR__
	<?php echo (isset($layout_content)?$layout_content:''); ?>
	__FOOTER__
 </div>
 	__FOOTERLINKS__
	<script src="<?php echo base_url().'assets/dist/js/dataTables.min.js'; ?>"></script>
	<script src="<?php echo base_url().'assets/dist/js/dataTables.bootstrap4.min.js'; ?>"></script>
	<?php echo (isset($script_files)?$script_files:''); ?>
</body>
</html>