<div id="seguimiento-tramite">
	<div class="wrapper wrapper-content">
		<div class="row animated fadeInRight">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="text-center float-e-margins p-md">
                    <span>Activar/desactivar Modos de vista: </span>
                    <a href="#" class="btn btn-xs btn-primary" id="leftVersion">Cambiar de Vista</a>
                    <a href="#" class="btn btn-xs btn-primary" id="lightVersion">Sin fondo</a>
                    <a href="#" class="btn btn-xs btn-primary" id="darkVersion">Con fondo</a>
                    
                    </div>
					<div class="ibox-content" id="ibox-content">
						<div class="m-b-md">
							<h2 class="no-margins"><?php echo $obj_tramite->getAttr('asunto');?></h2>
                        </div>
						<dl class="dl-horizontal">
                            <dt>Documento:</dt> <dd><span class="label label-primary"><?php echo $obj_tramite->TipoDocumento->getAttr('descripcion');?></span></dd>
                        </dl>
						<div class="row">
							<div class="col-lg-6">
								<dl class="dl-horizontal">
									<dt>Tramite</dt> <dd><?php echo ($obj_tramite->getAttr('tipo_tramite')=='I')?'Interno':'Externo';?></dd>
									<dt>Descripci&oacute;n:</dt> <dd><?php echo $obj_tramite->getAttr('descripcion');?></dd>
								</dl>
							</div>
							<div class="col-lg-6" id="cluster_info">
								<dl class="dl-horizontal">

									<dt>Fecha de Creaci&oacuten:</dt> <dd><?php echo $this->Time->format($obj_tramite->getAttr('created'), '%B %e, %Y %H:%M %p')?></dd>
									<dt>Archivos Adjuntos:</dt>
									<dd class="project-people">
									<div style="padding-bottom: 5px;">Editar: <input type="checkbox" class="i-checks marcarArchivos"></div>
									<?php foreach($obj_tramite->TramiteFile as $obj_tramite_file){?>
										<?php $extension = explode('.',$obj_tramite_file->getAttr('file_name'));$extensiones_permitidas = array("gif", "jpg", "jpeg", "png"); ?>
										<?php if(in_array( $extension[1], $extensiones_permitidas ) ) {?>
										<a href="<?php echo ENV_WEBROOT_FULL_URL;?>files/upload/<?php echo $obj_tramite_file->getAttr('file_name');?>" title="<?php echo $obj_tramite_file->getAttr('file_name');?>" download="<?php echo $obj_tramite_file->getAttr('file_name');?>"><img alt="image" class="img-circle" src="<?php echo ENV_WEBROOT_FULL_URL;?>files/upload/<?php echo $obj_tramite_file->getAttr('file_name');?>"></a>
										<?php }else{?>
										<a href="<?php echo ENV_WEBROOT_FULL_URL;?>files/upload/<?php echo $obj_tramite_file->getAttr('file_name');?>" title="<?php echo $obj_tramite_file->getAttr('file_name');?>" download="<?php echo $obj_tramite_file->getAttr('file_name');?>"><img alt="image" class="img-circle" src="<?php echo ENV_WEBROOT_FULL_URL;?>img/document265.png"></a>
										<?php }?>
									<?php }?>
									</dd>
								</dl>
							</div>
						</div>
						<div class="row">
							<form action="<?php echo ENV_WEBROOT_FULL_URL;?>tramites/add_edit_file_to_tramite<?php echo (isset($obj_tramite))?'/'.$obj_tramite->getID():''?>" method="post" accept-charset="utf-8" class="form-horizontal hide">
								<div class="col-lg-8">
									<div class="form-group">
										<div id="my-awesome-dropzone" class="dropzone" action="<?php echo ENV_WEBROOT_FULL_URL;?>tramites/add_edit_tramite_file">
											<div class="dropzone-previews"></div>
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<button type="button" class="btn btn-primary btn-imagen-tramite-trigger" style="margin-right:17px;">Guardar</button>
									<button type="button" class="btn btn-white btn-cancelar-crear-tramite">Cancelar</button>
								</div>
							</form>
						</div>
					</div><br>
					<div class="ibox-content" id="ibox-content">
						<h3><center>FIN</center></h3>
						<div id="vertical-timeline" class="vertical-container dark-timeline center-orientation">
							<?php
							$estado_ant ='';
							$area_nombre_ant = '';
							foreach ($arr_obj_seg_tramite as $obj_seg_tramite){
							$estado = $obj_seg_tramite->getAttr('estado_id');
							switch ($estado) {
								case 1:
									//Recibido
									$icon = "fa-thumbs-up";
									$color = "blue-bg";
									break;
								case 2:
									//Derivado
									$icon = "fa-paper-plane-o";
									$color = "navy-bg";
									break;
								case 4:
									//Aceptado
									$icon = "fa-check";
									$color = "yellow-bg";
									break;
								case 5:
									//Aceptado
									$icon = "fa-thumbs-up";
									$color = "blue-bg";
									break;
								case 6:
									//Derivado Copia
									$icon = "fa-paper-plane-o";
									$color = "navy-bg";
									break;
								case 8:
									//Recibido Rechazado
									$icon = "fa-thumbs-up";
									$color = "blue-bg";
									break;
								case 9:
									//Rechazado
									$icon = "fa-ban";
									$color = "red-bg";
									break;
								default:
									$icon = "";
									$color = "";
							}
							if($estado != 3 && $estado != 7 && $estado != 10){
	                        ?>
							<div class="vertical-timeline-block">
								<div class="vertical-timeline-icon <?php echo " ".$color;?>">
									<i class="fa <?php echo " ".$icon;?>"></i>
								</div>

								<div class="vertical-timeline-content">
									<h2><?php echo ($obj_seg_tramite->getAttr('estado_id')== 4)? "Terminado":$obj_seg_tramite->Estado->getAttr('nombre'); ?></h2>
									<label>Usuario:</label>
									<?php echo $obj_seg_tramite->Usuario->getAttr('username'); ?>
									<br> <label>&Aacute;rea:</label>
									<?php echo utf8_encode($obj_seg_tramite->Area->getAttr('nombre')); ?>
									<br>
									<?php if(($estado==2 && $estado_ant==3) || ($estado==9 && $estado_ant==10)){?>
									<label>&Aacute;rea de destino:</label>
									<?php echo $area_nombre_ant; ?>
									<br>
										<?php if(!is_null($obj_seg_tramite->getAttr('observacion')) && $obj_seg_tramite->getAttr('observacion')!=''){ ?>
											<label>Observaci&oacute;n:</label>
											<?php echo $obj_seg_tramite->getAttr('observacion'); ?>
											<br>
										<?php } ?>
									<?php }?>
									<?php if($estado==1){?>
									<label>Descripci&oacute;n:</label>
									<?php echo $obj_seg_tramite->Tramite->getAttr('descripcion'); ?>
									<br>
									<?php }?>
									<span class="vertical-date"> <!-- Today <br/> --> 
										<small><?php echo CakeTime::format($obj_seg_tramite->getAttr('created'), '%d-%m-%Y %H:%M');?></small>
									</span>
								</div>
							</div>
							<?php
							}
							$estado_ant = $estado;
							$area_nombre_ant = $obj_seg_tramite->Area->getAttr('nombre');
						}
						?>
						</div>
						<h3><center>INICIO</center></h3>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){

	// Local script for demo purpose only
	$('#lightVersion').click(function(event) {
		event.preventDefault()
		$('#ibox-content').removeClass('ibox-content');
		$('#vertical-timeline').removeClass('dark-timeline');
		$('#vertical-timeline').addClass('light-timeline');
	});

	$('#darkVersion').click(function(event) {
		event.preventDefault()
		$('#ibox-content').addClass('ibox-content');
		$('#vertical-timeline').removeClass('light-timeline');
		$('#vertical-timeline').addClass('dark-timeline');
	});

	$('#leftVersion').click(function(event) {
		event.preventDefault()
		$('#vertical-timeline').toggleClass('center-orientation');
	});

	//iCheck
	$('.marcarArchivos').iCheck({
		checkboxClass: 'icheckbox_square-blue',
	});
	
	$('.marcarArchivos').on('ifChecked', function(event){
		$('#my-awesome-dropzone').parents('form').removeClass('hide');
	});
	$('.marcarArchivos').on('ifUnchecked', function(event){
		$('#my-awesome-dropzone').parents('form').addClass('hide');
	});

	//Dropzone
	var files = [];
	$("#my-awesome-dropzone").dropzone({
		autoProcessQueue: true,
		uploadMultiple: true,
		parallelUploads: 14,
		maxFiles: 14,
		acceptedFiles: ".jpeg,.jpg,.png,.doc,.xls,.docx,.xlsx,.rar,.zip,.tar,.ppt,.pptx",
		addRemoveLinks: true,
		removedfile: function(file) {
			$.get('<?php echo ENV_WEBROOT_FULL_URL?>tramites/add_edit_tramite_file_delete/'+file.name);
			var _ref;
		    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
		  },
		// Dropzone settings
		init: function() {
			var myDropzone = this;
			$.get('<?php echo ENV_WEBROOT_FULL_URL?>tramites/add_edit_tramite_file_edit<?php echo (isset($obj_tramite))?'/'.$obj_tramite->getID():''?>', function(data) {
	            $.each(data, function(key,value){
	            	files.push(value.name);
					var filename = value.name;
	                var mockFile = { name: filename, size: value.size };
	                myDropzone.options.addedfile.call(myDropzone, mockFile);
					if(filename.indexOf(".jpg")>-1 || filename.indexOf(".png")>-1 || filename.indexOf(".jpeg")>-1){
						myDropzone.options.thumbnail.call(myDropzone, mockFile, "<?php echo ENV_WEBROOT_FULL_URL;?>files/upload/"+value.name);
					}else{
						myDropzone.options.thumbnail.call(myDropzone, mockFile, "<?php echo ENV_WEBROOT_FULL_URL;?>img/document265.png");
					}
	            });
				/*if(files.length > 0){
					$('#my-awesome-dropzone').removeClass('hide');
					$('.marcarArchivos').parent('.icheckbox_square-blue').addClass('checked');
				}*/
	        });
		}
	});
	
	$('body').off('click','.btn-imagen-tramite-trigger');
	$('body').on('click','.btn-imagen-tramite-trigger',function(){
		$form = $(this).parents('form').eq(0);
		$.ajax({
			url: $form.attr('action'),
			data: $form.serialize(),
			dataType: 'json',
			type: 'post'
		}).done(function(data){
			if(data.success==true){
				toastr.success(data.msg);
				$('form').addClass('hide');
				$('.marcarArchivos').iCheck('uncheck');
			}else{
			//error
			}
		});
	});
});
</script>