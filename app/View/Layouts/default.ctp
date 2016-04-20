<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>InterSMS</title>
    
    <!-- <link rel="icon" type="image/png" href="<?php echo ENV_WEBROOT_FULL_URL?>favicon.ico" /> -->

    <link href="<?php echo ENV_WEBROOT_FULL_URL?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo ENV_WEBROOT_FULL_URL?>font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo ENV_WEBROOT_FULL_URL?>css/plugins/iCheck/custom.css" rel="stylesheet">
	
    <!-- Data Tables -->
    <link href="<?php echo ENV_WEBROOT_FULL_URL?>css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo ENV_WEBROOT_FULL_URL?>css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="<?php echo ENV_WEBROOT_FULL_URL?>css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
    
    <!-- Dropzone -->
    <link href="<?php echo ENV_WEBROOT_FULL_URL?>css/plugins/dropzone/basic.css" rel="stylesheet">
    <link href="<?php echo ENV_WEBROOT_FULL_URL?>css/plugins/dropzone/dropzone.css" rel="stylesheet">
    
    <link href="<?php echo ENV_WEBROOT_FULL_URL?>css/plugins/toastr/toastr.min.css" rel="stylesheet">
	<link href="<?php echo ENV_WEBROOT_FULL_URL?>css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    
    <link href="<?php echo ENV_WEBROOT_FULL_URL?>css/plugins/chosen/chosen.css" rel="stylesheet">
	<link href="<?php echo ENV_WEBROOT_FULL_URL?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    
    <link href="<?php echo ENV_WEBROOT_FULL_URL?>css/animate.css" rel="stylesheet">
    <link href="<?php echo ENV_WEBROOT_FULL_URL?>css/style.css" rel="stylesheet">

    <!-- Mainly scripts -->
    <script src="<?php echo ENV_WEBROOT_FULL_URL?>js/jquery-2.1.1.js"></script>
    <script src="<?php echo ENV_WEBROOT_FULL_URL?>js/bootstrap.min.js"></script>
    <script src="<?php echo ENV_WEBROOT_FULL_URL?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo ENV_WEBROOT_FULL_URL?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo ENV_WEBROOT_FULL_URL?>js/plugins/iCheck/icheck.min.js"></script>

    <!-- Data Tables -->
    <script src="<?php echo ENV_WEBROOT_FULL_URL?>js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo ENV_WEBROOT_FULL_URL?>js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="<?php echo ENV_WEBROOT_FULL_URL?>js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="<?php echo ENV_WEBROOT_FULL_URL?>js/plugins/dataTables/dataTables.tableTools.min.js"></script>
    
    <!-- Chosen -->
	<script src="<?php echo ENV_WEBROOT_FULL_URL?>js/plugins/chosen/chosen.jquery.js"></script>
	
	<!-- Data picker -->
	<script src="<?php echo ENV_WEBROOT_FULL_URL?>js/plugins/datapicker/bootstrap-datepicker.js"></script>
	
	<!-- Highchart -->
	<script src="<?php echo ENV_WEBROOT_FULL_URL?>js/plugins/highcharts-4.1.5/highcharts.js"></script>
	
	<!-- Input Mask-->
    <script src="<?php echo ENV_WEBROOT_FULL_URL?>js/plugins/jasny/jasny-bootstrap.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo ENV_WEBROOT_FULL_URL?>js/inspinia.js"></script>
    <script src="<?php echo ENV_WEBROOT_FULL_URL?>js/plugins/pace/pace.min.js"></script>
    <script src="<?php echo ENV_WEBROOT_FULL_URL?>js/plugins/peity/jquery.peity.min.js"></script>
    <script src="<?php echo ENV_WEBROOT_FULL_URL?>js/demo/peity-demo.js"></script>
    <script src="<?php echo ENV_WEBROOT_FULL_URL?>js/plugins/toastr/toastr.min.js"></script>
	<script src="<?php echo ENV_WEBROOT_FULL_URL?>js/plugins/dropzone/dropzone.js"></script>
	<script src="<?php echo ENV_WEBROOT_FULL_URL?>js/plugins/video/responsible-video.js"></script>
	
	<!-- Upload image (Foto de usuario) -->
	<script src="<?php echo ENV_WEBROOT_FULL_URL?>js/bootstrap-fileupload.js"></script>
    
    <script>
	$(document).ready(function () {
		var myProccess;
	    myProccess = myProccess || (function () {

			var pleaseWaitDiv = $('<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"><div class="modal-dialog modal-sm"><div class="modal-content" style="padding:10px;">Procesando.. <div class="sk-spinner sk-spinner-three-bounce"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div></div></div></div></div>');
		    
			return {
				showPleaseWait: function () {
					pleaseWaitDiv.modal({backdrop: 'static',keyboard: false});
				},
				hidePleaseWait: function () {
					pleaseWaitDiv.modal('hide');
				},
			};
		})();
		
		$('.i-checks').iCheck({
			checkboxClass: 'icheckbox_square-green',
			radioClass: 'iradio_square-green',
		});

		$('[data-toggle="tooltip"]').tooltip();
	});
	</script>
</head>

<body class="pace-done mini-navbar">

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <!-- Elemento Menu -->
			<?php echo $this->Element('menu'); ?>
        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Buscar..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Bienvenido <strong><?php echo ucwords($this->Session->read('Auth.User.nombre'))?></strong>.</span>|
                </li>
                <!-- 
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="<?php echo ENV_WEBROOT_FULL_URL?>img/a7.jpg">
                                </a>
                                <div class="media-body">
                                    <small class="pull-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="mailbox.html">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li> 
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="profile.html">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
				-->
                <li>
                    <a href="<?php echo ENV_WEBROOT_FULL_URL?>usuarios/logout">
                        <i class="fa fa-sign-out"></i> Salir
                    </a>
                </li>
            </ul>

        </nav>
        </div>
        
        <!-- Contenido -->   
        <?php echo $this->fetch('content'); ?>
        
        <div class="footer">
            <div class="pull-right">
                Universidad de Chiclayo.
            </div>
            <div>
                <strong>Copyright</strong> InterSMS &copy; 2015
            </div>
        </div>

        </div>
        </div>
    
    <!-- Scripts de Mantenimientos -->
    <script src="<?= ENV_WEBROOT_FULL_URL;?>js/ajax/groupcmd.js" type="text/javascript"></script>
    <script src="<?= ENV_WEBROOT_FULL_URL;?>js/ajax/usuario.js" type="text/javascript"></script>
    <script>var env_webroot_script = '<?php echo ENV_WEBROOT_FULL_URL; ?>';</script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
            $('.dataTables-example').dataTable({
                responsive: true,
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                }
            });
            /* Init DataTables */
            var oTable = $('#editable').dataTable();
        });
    </script>
	<style>
	    body.DTTT_Print {
	        background: #fff;
	
	    }
	    .DTTT_Print #page-wrapper {
	        margin: 0;
	        background:#fff;
	    }
	
	    button.DTTT_button, div.DTTT_button, a.DTTT_button {
	        border: 1px solid #e7eaec;
	        background: #fff;
	        color: #676a6c;
	        box-shadow: none;
	        padding: 6px 8px;
	    }
	    button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {
	        border: 1px solid #d2d2d2;
	        background: #fff;
	        color: #676a6c;
	        box-shadow: none;
	        padding: 6px 8px;
	    }
	
	    .dataTables_filter label {
	        margin-right: 5px;
	
	    }
	</style>
</body>
</html>