<div class="container div-crear-rol-persona form" id="div-crear-rol-persona">

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
						<?php echo $this->Form->create('RolPersona',array('method'=>'post', 'id'=>'add_edit_rol_persona'));?>
							<div class="row">
								<div class="col-sm-2">
									<label>
										<?php 
											echo __('Persona').':'; 
										?>
									</label>
								</div>	
								<div class="col-sm-2">	
										<?php 
											if(isset($persona_nombre)){echo ' '.$persona_nombre;} 
										?>
							  	</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-2">
									<label>
										<?php echo "<label>".__('Rol persona').":</label>"; ?>
									</label>
								</div>
								<div class="col-sm-2">
									<select name="data[RolPersona][role_id]" class="cboRolPersona form-control">
											<?php 
											if(isset($list_all_roles_missing)){
												foreach ($list_all_roles_missing as $rol):
												echo "<option value = ".$rol->getAttr('id').">".$rol->getAttr('descripcion')."</option>";
												endforeach;
											}
										?>
										</select>
										<?php 
										if(isset($list_all_roles_missing)){
											if(count($list_all_roles_missing) > 0){
											}
						
										}
										?>
								</div>
							</div>
							<br>
							<div class="row" style="text-align:center;">
								<div class="span9">
									<button type="button" class="btn btn-primary btn_crear_rol_persona_trigger" style="margin-right:17px;"><?php echo __('Guardar'); ?></button>
									<button type="button" class="btn btn-white btn_cancelar_crear_rol_persona"><?php echo __('Cancelar');?></button>
								</div>
							</div>
						<?php echo $this->Form->end(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>