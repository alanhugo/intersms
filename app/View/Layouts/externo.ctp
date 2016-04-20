<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SISTRADO</title>

	<link href="<?php echo ENV_WEBROOT_FULL_URL?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo ENV_WEBROOT_FULL_URL?>font-awesome/css/font-awesome.css" rel="stylesheet">
    
    <link href="<?php echo ENV_WEBROOT_FULL_URL?>css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="<?php echo ENV_WEBROOT_FULL_URL?>css/animate.css" rel="stylesheet">
    <link href="<?php echo ENV_WEBROOT_FULL_URL?>css/style.css" rel="stylesheet">

    <!-- Mainly scripts -->
    <script src="<?php echo ENV_WEBROOT_FULL_URL?>js/jquery-2.1.1.js"></script>
    <script src="<?php echo ENV_WEBROOT_FULL_URL?>js/bootstrap.min.js"></script>
    <script src="<?php echo ENV_WEBROOT_FULL_URL?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo ENV_WEBROOT_FULL_URL?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <link href="<?php echo ENV_WEBROOT_FULL_URL?>css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">

    <!-- Custom and plugin javascript -->
    <script src="<?php echo ENV_WEBROOT_FULL_URL?>js/inspinia.js"></script>
    <script src="<?php echo ENV_WEBROOT_FULL_URL?>js/plugins/pace/pace.min.js"></script>
    <script src="<?php echo ENV_WEBROOT_FULL_URL?>js/plugins/toastr/toastr.min.js"></script>
    
    <!-- Input Mask-->
    <script src="<?php echo ENV_WEBROOT_FULL_URL?>js/plugins/jasny/jasny-bootstrap.min.js"></script>

  	<script>var env_webroot_script = '<?php echo ENV_WEBROOT_FULL_URL; ?>';</script>
  	<script src="<?php echo ENV_WEBROOT_FULL_URL;?>js/ajax/tramite.js"></script>
</head>
<body class="gray-bg">
	<?php echo $this->fetch('content'); ?>
	
</body>

</html>