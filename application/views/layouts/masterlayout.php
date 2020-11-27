<!DOCTYPE html>
<html lang="en">
<head>
	__METATAGS__
	__CSSLINKS__
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
	<?php echo (isset($script_files)?$script_files:''); ?>
</body>
</html>