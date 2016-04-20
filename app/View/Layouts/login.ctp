<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>InterSMS</title>

    <link href="<?php echo ENV_WEBROOT_FULL_URL?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo ENV_WEBROOT_FULL_URL?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo ENV_WEBROOT_FULL_URL?>css/animate.css" rel="stylesheet">
    <link href="<?php echo ENV_WEBROOT_FULL_URL?>css/style.css" rel="stylesheet">

</head>
<body class="gray-bg skin-1" style="background-color: #f3f3f4;">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
        	<?php echo $this->fetch('content'); ?>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?php echo ENV_WEBROOT_FULL_URL?>js/jquery-2.1.1.js"></script>
    <script src="<?php echo ENV_WEBROOT_FULL_URL?>js/bootstrap.min.js"></script>

</body>

</html>