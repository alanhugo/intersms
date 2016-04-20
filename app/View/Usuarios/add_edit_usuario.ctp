<div class="container div-crear-usuario form" id="div-crear-usuario">

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
						<?php echo $this->Form->create('Usuario',array('action'=>'add_edit_usuario','method'=>'post', 'id'=>'add_edit_usuario', 'type' => 'file', 'class'=>'form-horizontal'));?>
							<div class="form-group">
								<label class="col-sm-2 control-label">Apellidos y Nombres</label>
								<div class="col-sm-4">
									<input type="text" name="data[Usuario][nombre]" id="UsuarioName" class="form-control" value="<?php echo (isset($obj_usuario))?$obj_usuario->getAttr('nombre'):''?>">
								</div>
								
								<label class="col-sm-2 control-label">Sexo</label>
								<div class="col-sm-4">
									<select class="form-control m-b" name="data[Usuario][sexo]"
										id="cboSexo">
										<?php
										if (isset($obj_usuario)){
											echo "<option value = ".$obj_usuario->getAttr('sexo')." selected='selected'>";
											if($obj_usuario->getAttr('sexo') == '1'){
												echo __('Masculino')."</option>";
												echo "<option value = '0'>".__('Femenino')."</option>";
											}else{
												echo __('Femenino')."</option>";
												echo "<option value = '1'>".__('Masculino')."</option>";
											}
										}else{
										?>
										<option value="1">
											<?php echo __('Masculino'); ?>
										</option>
										<option value="0">
											<?php echo __('Femenino'); ?>
										</option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Nombre de Usuario</label>
								<div class="col-sm-4">
									<input type="hidden" id="UsuarioUserID" class="form-control" value="<?php echo (isset($obj_usuario))?$obj_usuario->getID():''?>">
									<input type="text" name="data[Usuario][username]" id="UsuarioUserName" class="form-control" value="<?php echo (isset($obj_usuario))?$obj_usuario->getAttr('username'):''?>">
								</div>

								<label class="col-sm-2 control-label">Contrase&ntilde;a</label>
								<div class="col-sm-4">
									<input type="password" name="data[Usuario][password]" id="UsuarioPassword" <?php echo (isset($obj_usuario))?'disabled="disabled"':''?> class="form-control">
									<?php if(isset($obj_usuario)){?><a href="#myModalChangePass" class='link_cambiar_clave' data-toggle="modal">Cambiar Contrase&ntilde;a</a><?php }?>
								</div>
								
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="Usuariofoto">Foto</label>
								<div class="col-sm-4">
									<div class='fileupload fileupload-new' data-provides='fileupload'>
										<div class='uneditable-input span2'><i class='icon-file fileupload-exists'></i>
											<span class="btn btn-default btn-file" style="width:123px;height: 37px;margin-bottom: 4px;">
												<input type="file" name="data[Usuario][foto]" style="opacity:0; position:absolute;height: 35px;left: 0px;top: 0px;" id="Usuariofoto">
												<span class="fileinput-new">Seleccione foto</span>
											</span>
										</div>
										<div class='fileupload-preview thumbnail' style='width:40%;height:40%;'>
										<?php if(isset($obj_usuario) && $obj_usuario->getAttr('foto')!=''){?>
											<img src="<?php echo ENV_WEBROOT_FULL_URL.'files/fotos_usuario/'.$obj_usuario->getAttr('foto'); ?>">
										<?php }else{?>
											<img src="">
										<?php }?>
										</div>
									</div>
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-2">
									<button type="button" class="btn btn-primary btn-crear-usuario-trigger" style="margin-right:17px;">Guardar</button>
									<button type="button" class="btn btn-white btn-cancelar-crear-usuario">Cancelar</button>
								</div>
							</div>
						<?php echo $this->Form->end(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>