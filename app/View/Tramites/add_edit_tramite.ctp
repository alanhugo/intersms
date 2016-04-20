<div class="container div-crear-tramite form" id="div-crear-tramite">

	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<div class="ibox-tools">
							<a class="collapse-link"> <i class="fa fa-chevron-up"></i>
							</a> <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i
								class="fa fa-wrench"></i>
							</a>
							<ul class="dropdown-menu dropdown-user">
								<li><a href="#">Config option 1</a>
								</li>
								<li><a href="#">Config option 2</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="ibox-content">
						<form action="tramites/add_edit_tramite<?php echo (isset($obj_tramite))?'/'.$obj_tramite->getID():''?>" method="post" name="NuevoTramite" id="NuevoEditarTramite" accept-charset="utf-8" class="form-horizontal">
							<input type="hidden" name="data[Tramite][SeguimientoTramite]" value="<?php //echo (isset($obj_tramite))?$obj_tramite->SeguimientoTramite:''?>"></input>
							<?php 
							if(isset($obj_tramite)){
								//debug($obj_tramite->SeguimientoTramite[0]->data['SeguimientoTramite']['id']);
								//debug($obj_tramite->SeguimientoTramite);
							}?>
							<div class="form-group">
								<label class="col-sm-2 control-label">Externo</label>
								<div class="col-sm-1 div-check-externo" style="padding-top: 6px;">
									<input type="checkbox" class="i-checks marcarExterno" name="data[Tramite][tipo_tramite]" id="chbx-externo" value="<?php echo (isset($obj_tramite))? $obj_tramite->getAttr('tipo_tramite'): 'I'?>">
								</div>

								<label class="col-sm-5 control-label">Para archivar</label>
								<div class="col-sm-1 div-check-archivar" style="padding-top: 6px;">
									<input type="checkbox" class="i-checks marcarArchivar" name="data[Tramite][archivado]" id="chbx-archivar" value="<?php echo (isset($obj_tramite))? $obj_tramite->getAttr('archivado'): 0 ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Tipo Documento</label>
								<div class="col-sm-4">
									<select class="form-control m-b" name="data[Tramite][tipo_doc_id]">
										<option value="">Selecionar</option>
										<?php foreach ($arr_documentos as $key => $documento){?>
										<option value="<?php echo $documento->getID()?>" <?php echo (isset($obj_tramite) && $obj_tramite->getAttr('tipo_doc_id')==$documento->getID())?"selected = 'selected'":""?>><?php echo $documento->getAttr('descripcion')?></option>
	                                    <?php }?>
									</select>
								</div>
							
								<label class="col-sm-2 control-label">Area Actual</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" value="<?php echo $obj_logged_user->Area->getAttr('nombre')?>" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label lbl-estimacion">Estimaci&oacute;n de tramite (d&iacute;as)</label>
								<div class="col-sm-4 div-estimacion">
									<input type="number" name="data[Tramite][estimacion_dias]" id="TramiteEstimacion" class="form-control" value="<?php echo (isset($obj_tramite))?$obj_tramite->getAttr('estimacion_dias'):''?>">
								</div>
							
								<label class="col-sm-2 control-label">Asunto</label>
								<div class="col-sm-4">
									<input type="text" name="data[Tramite][asunto]" id="TramiteAsunto" class="form-control" value="<?php echo (isset($obj_tramite))?$obj_tramite->getAttr('asunto'):''?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Descripci&oacute;n</label>
								<div class="col-sm-10">
									<textarea name="data[Tramite][descripcion]" id="TramiteDescripcion" class="form-control"><?php echo (isset($obj_tramite))?$obj_tramite->getAttr('descripcion'):''?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Acci&oacute;n</label>
								<div class="col-sm-4">
									<select class="form-control m-b" name="data[Tramite][accion_id]">
										<option value="">Selecionar</option>
										<?php foreach ($arr_acciones as $key => $accion){?>
										<option value="<?php echo $accion->getID()?>" <?php echo (isset($obj_tramite) && $obj_tramite->getAttr('accion_id')==$accion->getID())?"selected = 'selected'":""?>><?php echo $accion->getAttr('descripcion')?></option>
	                                    <?php }?>
									</select>
								</div>
								
								<label class="col-sm-2 control-label lbl-area-destino">Area Destino</label>
								<div class="col-sm-4">
									<select class="form-control m-b cbx-area-destino" name="data[Tramite][area_id]" <?php if(isset($obj_tramite) && $obj_tramite->siDerivo($obj_logged_user)){echo "disabled='disabled'";}?>>
										<option value="">Selecionar</option>
										<?php foreach ($arr_areas as $key => $area){?>
										<option value="<?php echo $area->getID()?>" <?php echo (isset($obj_tramite) && $obj_tramite->getAttr('area_id')==$area->getID())?"selected = 'selected'":""?>><?php echo utf8_encode($area->getAttr('nombre')); ?></option>
	                                    <?php }?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div id="div-remitente" class="<?php //echo (isset($obj_tramite) && $obj_tramite->getAttr('remitente_id') != 0)?'':'hide';?>">
									<label class="col-sm-2 control-label">Remitente</label>
									<div class="col-sm-4">
										<span style="display: inline-flex;">
											<div class="input-group">
												<select data-placeholder="Elija remitente" name="data[Tramite][remitente_id]"
													class="chosen-select cbo-remitente-select2" tabindex="2" style="width:335px;">
													<option value="">Elija un remitente</option>
													<?php 
														if(isset($list_all_remitentes)){
															foreach ($list_all_remitentes as $id => $nom):
															if(isset($obj_tramite)){
																if($id == $obj_tramite->getAttr('remitente_id')){
																	$selected = " selected = 'selected'";
																}else{
																	$selected = "";
																}
															}else{
																$selected = "";
															}
															echo "<option value = ".$id.$selected.">".$nom."</option>";
															endforeach;
														}
													?>
												</select>
											</div>
											&nbsp;
											<a href="#myModalAddRemitente" class="btn btn-primary" role="button" data-toggle="modal" id="btn-open-create-remitente">...</a>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<?php if ($obj_logged_user->Area->getAttr('permiso_email')==1){?>
									<label class="col-sm-2 control-label">Email Notificaci&oacute;n</label>
									<div class="col-sm-1" style="padding-top: 6px;">
										<input type="checkbox" class="i-checks marcarEmail">
									</div>
									<div class="col-sm-3">
										<input type="text" name="data[Tramite][email]" id="TramiteEmail" class="form-control <?php echo (isset($obj_tramite) && $obj_tramite->getAttr('email') != '')?'':'hide';?>" value="<?php echo (isset($obj_tramite))?$obj_tramite->getAttr('email'):''?>">
									</div>
								<?php } ?>
								<label class="col-sm-2 control-label">Adjuntar Archivos</label>
								<div class="col-sm-1" style="padding-top: 6px;">
									<input type="checkbox" class="i-checks marcarArchivos">
								</div>
								<div class="col-sm-3">
									*max upload archivos: 14 <br>
									*solo admite ".jpeg, .jpg, .png, .doc, .xls, .docx,. xlsx, .rar, .zip, .tar"
								</div>
							</div>
							<div class="form-group">
								<div id="my-awesome-dropzone" class="dropzone hide" action="tramites/add_edit_tramite_file">
									<div class="dropzone-previews"></div>
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-2">
									<button type="button" class="btn btn-primary btn-crear-tramite-trigger" style="margin-right:17px;">Guardar</button>
									<button type="button" class="btn btn-white btn-cancelar-crear-tramite">Cancelar</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
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
						myDropzone.options.thumbnail.call(myDropzone, mockFile, "files/upload/"+value.name);
					}
	            });
				if(files.length > 0){
					$('#my-awesome-dropzone').removeClass('hide');
					$('.marcarArchivos').parent('.icheckbox_square-blue').addClass('checked');
				}
	        });
		}
	});
});
</script>