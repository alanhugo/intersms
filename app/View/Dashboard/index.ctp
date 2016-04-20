<div class="wrapper wrapper-content">
	<?php if($obj_logged_user->getAttr('tipo_usuario_id') == 1) { ?>
	<div class="row">
		<div class="col-sm-4">
			<div class="ibox">
				<div class="ibox-content">
					<div class="full-height-scroll">
						<div class="table-responsive">
							<table class="table table-striped table-hover">
								<tbody>
								<?php if(isset($arr_obj_usuarios)){
									App::import('Model', 'SeguimientoTramite');
									$this->SeguimientoTramite = new SeguimientoTramite();
									foreach ($arr_obj_usuarios as $key => $usuario) {?>
										<tr class="row-container-usuario" usuario_id="<?php echo $usuario->getID(); ?>" area_id="<?php echo $usuario->getAttr('area_id'); ?>" 
											tramite_mes_actual="<?php echo $this->SeguimientoTramite->contarTramiteMesActual($usuario->getAttr('area_id'), $usuario->getID()); ?>"
											tramite_mes_pasado="<?php echo $this->SeguimientoTramite->contarTramiteUltimoMes($usuario->getAttr('area_id'), $usuario->getID()); ?>"
											tramite_anio_actual="<?php echo $this->SeguimientoTramite->contarTramiteAnioActual($usuario->getAttr('area_id'), $usuario->getID()); ?>"
										>
											<td class="client-avatar"><img alt="image" src="<?php echo ENV_WEBROOT_FULL_URL.'files/fotos_usuario/'.$usuario->getAttr('foto'); ?>">
											</td>
											<td class="celda-nombre-usuario"><a data-toggle="tab" href="#contact-1" class="client-link"><?php echo $usuario->getAttr('username'); ?></a></td>
											<td><?php echo utf8_encode($usuario->Area->getAttr('nombre')); ?></td>
											<td class="client-status"><span class="label label-primary btn-trigger-view-chart" style="cursor:pointer">Ver</span>
											</td>
										</tr>
								<?php 
										}
									} 
								?>	
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-sm-8">
			<div class="ibox float-e-margins container-tabs-graphics" usuario_id="" area_id="">
				<div class="ibox-title">
					<h5 class="head-nombre-usuario">Seleccione un usuario</h5>
					<div class="pull-right">
						<div class="btn-group">
							<button type="button" class="btn btn-xs btn-white active"
								id="mes-actual">Mes actual</button>
							<button type="button" class="btn btn-xs btn-white" id="ult-mes">&Uacute;ltimo
								mes</button>
							<button type="button" class="btn btn-xs btn-white" id="periodo">Periodo</button>
						</div>
					</div>
				</div>
				<div class="ibox-content">
					<div class="row">
						<div class="col-lg-9">
							<div class="flot-chart">
								<div class="flot-chart-content" id="flot-dashboard-chart"
									logged_user_area_id="<?php echo (isset($area_logged_user))?$area_logged_user:''; ?>"></div>
							</div>
						</div>
						<div class="col-lg-3">
							<ul class="stat-list">
								<li>
									<h2 class="no-margins header-total-mes-actual">
										
									</h2> 
								<small>Total de tramites mes de <?php 
									setlocale(LC_TIME, 'spanish');
									$nombre=strftime("%B",mktime(0, 0, 0, (date('m')), 1, 2000));
									echo $nombre;
									?>
								</small>
									<hr> <!-- 
                                            <div class="stat-percent"><?php //echo (isset($porc_mes_actual))?$porc_mes_actual:''; ?> <i class="fa fa-level-up text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: <?php //echo (isset($porc_mes_actual))?$porc_mes_actual:''; ?>;" class="progress-bar"></div>
                                            </div>
                                             -->
								</li>
								<li>
									<h2 class="no-margins header-total-mes-pasado">
										
									</h2> <small>Total de tramites mes de <?php 
									setlocale(LC_TIME, 'spanish');
									$nombre=strftime("%B",mktime(0, 0, 0, (date('m')-1), 1, 2000));
									echo $nombre;
									?>
								</small>
									<hr> <!--
                                            <div class="stat-percent">60% <i class="fa fa-level-down text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: 60%;" class="progress-bar"></div>
                                            </div>
                                            -->
								</li>
								<li>
									<h2 class="no-margins header-total-anio-actual">
										
									</h2> <small>Total de tramites periodo <?php echo date('Y');?>
								</small>
									<hr> <!--
                                            <div class="stat-percent">22% <i class="fa fa-bolt text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: 22%;" class="progress-bar"></div>
                                            </div>
                                            -->
								</li>
							</ul>
						</div>
					</div>
				</div>

			</div>
		</div>
		<div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Video Tutorial 01 - Sistrado</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#">Config option 1</a>
                                    </li>
                                    <li><a href="#">Config option 2</a>
                                    </li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <figure>
                                <iframe width="525" height="349" src="http://www.youtube.com/embed/922vriXX-s8" frameborder="0" allowfullscreen></iframe>
                            </figure>
                        </div>
                    </div>
         </div>
	</div>
	<?php }else{?>
	<div class="row">
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-success pull-right">General</span>
					<h5>Tramites en general</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins">
						<?php echo (isset($contar_todos_tramites)?$contar_todos_tramites:''); ?>
					</h1>
					<!-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> -->
					<small>Total de tramites realizados</small>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-info pull-right">General</span>
					<h5>Derivados</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins">
						<?php echo (isset($contar_tramites_derivados)?$contar_tramites_derivados:''); ?>
					</h1>
					<!-- <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div> -->
					<small>Tramites Derivados</small>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-primary pull-right">Hasta hoy</span>
					<h5>Pendientes</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins">
						<?php echo (isset($contar_tramites_pendientes)?$contar_tramites_pendientes:''); ?>
					</h1>
					<!-- <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div> -->
					<small>Tramites Pendientes</small>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-danger pull-right">General</span>
					<h5>Aceptados</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins">
						<?php echo (isset($contar_tramites_aceptados)?$contar_tramites_aceptados:''); ?>
					</h1>
					<!-- <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div> -->
					<small>Tramites Aceptados</small>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Gr&aacute;fica</h5>
					<div class="pull-right">
						<div class="btn-group">
							<button type="button" class="btn btn-xs btn-white active"
								id="mes-actual">Mes actual</button>
							<button type="button" class="btn btn-xs btn-white" id="ult-mes">&Uacute;ltimo
								mes</button>
							<button type="button" class="btn btn-xs btn-white" id="periodo">Periodo</button>
						</div>
					</div>
				</div>
				<div class="ibox-content">
					<div class="row">
						<div class="col-lg-9">
							<div class="flot-chart">
								<div class="flot-chart-content" id="flot-dashboard-chart"
									logged_user_area_id="<?php echo (isset($area_logged_user))?$area_logged_user:''; ?>"></div>
							</div>
						</div>
						<div class="col-lg-3">
							<ul class="stat-list">
								<li>
									<h2 class="no-margins">
										<?php echo (isset($contar_tramites_mes_actual))?$contar_tramites_mes_actual:''; ?>
									</h2> <small>Total de tramites mes de <?php 
									setlocale(LC_TIME, 'spanish');
									$nombre=strftime("%B",mktime(0, 0, 0, (date('m')), 1, 2000));
									echo $nombre;
									?>
								</small>
									<hr> <!-- 
                                            <div class="stat-percent"><?php //echo (isset($porc_mes_actual))?$porc_mes_actual:''; ?> <i class="fa fa-level-up text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: <?php //echo (isset($porc_mes_actual))?$porc_mes_actual:''; ?>;" class="progress-bar"></div>
                                            </div>
                                             -->
								</li>
								<li>
									<h2 class="no-margins ">
										<?php echo (isset($contar_tramites_ultimo_mes))?$contar_tramites_ultimo_mes:''; ?>
									</h2> <small>Total de tramites mes de <?php 
									setlocale(LC_TIME, 'spanish');
									$nombre=strftime("%B",mktime(0, 0, 0, (date('m')-1), 1, 2000));
									echo $nombre;
									?>
								</small>
									<hr> <!--
                                            <div class="stat-percent">60% <i class="fa fa-level-down text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: 60%;" class="progress-bar"></div>
                                            </div>
                                            -->
								</li>
								<li>
									<h2 class="no-margins ">
										<?php echo (isset($contar_tramites_anio_actual))?$contar_tramites_anio_actual:''; ?>
									</h2> <small>Total de tramites periodo <?php echo date('Y');?>
								</small>
									<hr> <!--
                                            <div class="stat-percent">22% <i class="fa fa-bolt text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: 22%;" class="progress-bar"></div>
                                            </div>
                                            -->
								</li>
							</ul>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Video Tutorial 01 - Sistrado</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#">Config option 1</a>
                                    </li>
                                    <li><a href="#">Config option 2</a>
                                    </li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <figure>
                                <iframe width="425" height="349" src="http://www.youtube.com/embed/922vriXX-s8" frameborder="0" allowfullscreen></iframe>
                            </figure>
                        </div>
                    </div>
         </div>
	</div>
	<?php } ?>
	
</div>

    <script>
        $(document).ready(function() {
       	 
       	 function visitorData1 (valores) {
       		$("#mes-actual").addClass('active');
       		$("#periodo").removeClass('active');
       		$("#ult-mes").removeClass('active');
        		   $('#flot-dashboard-chart').highcharts({
        		    chart: {
        		        type: 'column'
        		    },
        		    credits: {
        	            enabled: false
        	        },
        		    title: {
        		        text: 'N\u00FAmero de tramites en el mes actual'
        		    },
        		    xAxis: {
        		        categories: valores.meses
        		    },
        		    yAxis: {
        		        title: {
        		            text: 'Total de tramites'
        		        }
        		    },
        	        plotOptions: {
        	            column: {
        	                pointPadding: 0.2,
        	                borderWidth: 0
        	            }
        	        },
        	        tooltip: {
        	            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        	            pointFormat: '<tr><td style="color:{series.color};padding:0">Total Tramites: {point.y:.f}</td></tr>',
        	            footerFormat: '</table>',
        	            shared: true,
        	            useHTML: true
        	        },        
        		    series: [{
        		    	name: valores.name,
        		    	colorByPoint: true,
        			    data: valores.data
        		       }]
        		  });
       	}
           
       	function ExecuteReport1(usuario_id, area_id){
       		//logged_user_area_id = $('#flot-dashboard-chart').attr('logged_user_area_id');
       		if(usuario_id == undefined || !usuario_id) {
       			usuario_id ='';
			}

       		if(area_id == undefined || !area_id) {
       			area_id ='';
			}
       		
        	$.ajax({
        		url: env_webroot_script + 'dashboard/load_graf_tramite_mes_actual/'+usuario_id+'/'+area_id,
        		type: 'GET',
        		async: true,
        		dataType: "json",
        		}).done(function(data){
        			if(data.success == true){
        				$('#flot-dashboard-chart').empty();
        				visitorData1(data);
        			}
        		});
       	}

       	ExecuteReport1();

        $("#mes-actual").click(function() {
           usuario_id = $('.container-tabs-graphics').attr('usuario_id');
     	   area_id = $('.container-tabs-graphics').attr('area_id');
            ExecuteReport1(usuario_id,area_id);
        })

       	$("#ult-mes").click(function() {
       		$("#ult-mes").addClass('active');
       		$("#periodo").removeClass('active');
       		$("#mes-actual").removeClass('active');

       		usuario_id = $('.container-tabs-graphics').attr('usuario_id');
      	   	area_id = $('.container-tabs-graphics').attr('area_id');

      	  	if(usuario_id == undefined || !usuario_id) {
     			usuario_id ='';
			}

     		if(area_id == undefined || !area_id) {
     			area_id ='';
			}
       	   
       		function visitorData2 (valores) {
        		   $('#flot-dashboard-chart').highcharts({
        		    chart: {
        		        type: 'column'
        		    },
        		    credits: {
        	            enabled: false
        	        },
        		    title: {
        		        text: 'N\u00FAmero de tramites en el \u00FAltimo mes'
        		    },
        		    xAxis: {
        		        categories: valores.meses
        		    },
        		    yAxis: {
        		        title: {
        		            text: 'Total de tramites'
        		        }
        		    },
        	        plotOptions: {
        	            column: {
        	                pointPadding: 0.2,
        	                borderWidth: 0
        	            }
        	        },
        	        tooltip: {
        	            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        	            pointFormat: '<tr><td style="color:{series.color};padding:0">Total Tramites: {point.y:.f}</td></tr>',
        	            footerFormat: '</table>',
        	            shared: true,
        	            useHTML: true
        	        },        
        		    series: [{
        		    	name: valores.name,
        		    	colorByPoint: true,
        			    data: valores.data
        		       }]
        		  });
        	}
            
        	//logged_user_area_id = $('#flot-dashboard-chart').attr('logged_user_area_id');
        	$.ajax({
        		url: env_webroot_script + 'dashboard/load_graf_tramite_ult_mes/'+usuario_id+'/'+area_id,
        		type: 'GET',
        		async: true,
        		dataType: "json",
        		}).done(function(data){
        			if(data.success == true){
        				$('#flot-dashboard-chart').empty();
        				visitorData2(data);
        			}
        		});

       	});

	$("#periodo").click(function() {
       	$("#periodo").addClass('active');
       	$("#ult-mes").removeClass('active');
       	$("#mes_actual").removeClass('active');
       	
       	usuario_id = $('.container-tabs-graphics').attr('usuario_id');
  	   	area_id = $('.container-tabs-graphics').attr('area_id');

  	  	if(usuario_id == undefined || !usuario_id) {
 			usuario_id ='';
		}

 		if(area_id == undefined || !area_id) {
 			area_id ='';
		}
       		
       	/*año actual*/
       	function visitorData3 (valores) {
	       	$('#flot-dashboard-chart').highcharts({
	   		    chart: {
	   		        type: 'column'
	   		    },
	   		    credits: {
	   	            enabled: false
	   	        },
	   		    title: {
	   		        text: 'N\u00FAmero de tramites en el periodo actual'
	   		    },
	   		    xAxis: {
	   		        categories: valores.meses
	   		    },
	   		    yAxis: {
	   		        title: {
	   		            text: 'Total de tramites'
	   		        }
	   		    },
	   	        plotOptions: {
	   	            column: {
	   	                pointPadding: 0.2,
	   	                borderWidth: 0
	   	            }
	   	        },
	   	        tooltip: {
	   	            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
	   	            pointFormat: '<tr><td style="color:{series.color};padding:0">Total Tramites: {point.y:.f}</td></tr>',
	   	            footerFormat: '</table>',
	   	            shared: true,
	   	            useHTML: true
	   	        },        
	   		    series: [{
	   		    	name: valores.name,
	   		    	colorByPoint: true,
	   			    data: valores.data
	   		       }]
	   		  });
 		}

       		//logged_user_area_id = $('#flot-dashboard-chart').attr('logged_user_area_id');
			 $.ajax({
			    url: env_webroot_script + 'dashboard/load_graf_tramite_periodo/'+usuario_id+'/'+area_id,
			    type: 'GET',
			    async: true,
			    dataType: "json",
			 }).done(function(data){
					if(data.success == true){
						visitorData3 (data);
					}
			});
   })


   /* Ver gráfica por usuario - Dashboard Admin */

   $(".btn-trigger-view-chart").click(function() {
	   var parent = $(this).parents('.row-container-usuario');

	   usuario_id = parent.attr('usuario_id');
	   area_id = parent.attr('area_id');

	   $('.head-nombre-usuario').text(parent.children('.celda-nombre-usuario').text());
	   $('.header-total-mes-actual').text(parent.attr('tramite_mes_actual'));
	   $('.header-total-mes-pasado').text(parent.attr('tramite_mes_pasado'));
	   $('.header-total-anio-actual').text(parent.attr('tramite_anio_actual'));
	   ExecuteReport1(usuario_id,area_id);

	   $('.container-tabs-graphics').attr('usuario_id',usuario_id);
	   $('.container-tabs-graphics').attr('area_id',area_id);
   })
	    
       	
});
</script>