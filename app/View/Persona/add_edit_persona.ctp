<script>
$(document).ready(function(){
	/* Propiedades de algunos componentes */
	/*$('#txtFechaNacimiento').datepicker(
		{
			changeYear: true, 
			dateFormat: 'dd-mm-yy',
			minDate: new Date(1924, 1 - 1, 1),
			maxDate: new Date()
		});*/

	/* Permitiendo el ingreso de solo números - Nro Doc */
	$("#PersonaNroDocumento").keydown(function(event) {
		if(event.shiftKey){
		   event.preventDefault();
		}
		 
		if (event.keyCode == 46 || event.keyCode == 8)    {
		}else{
			if (event.keyCode < 95) {
				if (event.keyCode < 48 || event.keyCode > 57) {
		        	event.preventDefault();
		        }
		    }else{
		       if (event.keyCode < 96 || event.keyCode > 105) {
		       	event.preventDefault();
		       }
		    }
		}
	});

})
</script>
<div class="container div-crear-persona form" id="div-crear-persona">

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
						<?php echo $this->Form->create('Persona',array('method'=>'post', 'id'=>'add_edit_persona'));?>
							<section>
								<div class="row">
									<div class="span3 col-md-4 col-sm-6 col-xs-6">
										<label><?php echo __('Tipo Persona'); ?> </label> <select
											name="data[Persona][tipo_persona_id]"
											class="cboTipoPersonas form-control">
											<?php 
											if (isset($list_all_tipo_personas)){
							foreach ($list_all_tipo_personas as $list_all_tipo_persona => $d):
							if(isset($obj_persona) || isset($persona_id)){
								if($list_all_tipo_persona == $obj_persona->getAttr('tipo_persona_id')){
									$selected = " selected = 'selected'";
								}else{
									$selected = "";
								}
							}else{
								$selected = "";
							}
							echo "<option value = ".$list_all_tipo_persona.$selected.">".$d."</option>";
							endforeach;
						}
						?>
								</select>
								</div>
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<label><?php echo utf8_encode(__('Tipo Documento')); ?> </label>
									<select class="cboNroDocumento form-control"
										id="cboNroDocumento" name="data[Persona][tipo_documento_id]">
									</select>
								</div>
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<label><?php echo utf8_encode(__('Nro Documento')); ?> </label>
									<!-- <input type="text" id="PersonaNroDocumento" name="data[Persona][nro_documento]"> -->
									<?php echo $this->Form->input('nro_documento', array('id' =>'PersonaNroDocumento', 'div' => false, 'label' => false, 'class'=>'form-control')); ?>
								</div>
							</div>
							<p>
							
							
							<div class="row">
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<?php echo "<label id='lblNombre'>".__('Nombres')."</label>"; ?>
									<?php echo "<label id='lblRznSocial' style= 'display: none'>".utf8_encode(__('Razón Social'))."</label>"; ?>
									<?php echo $this->Form->input('nombre', array('div' => false, 'label' => false, 'class'=> 'txtNombre form-control','id' =>'txtNombre')); ?>
								</div>
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<?php echo "<label  id='lblApellido'>".__('Apellidos')."</label>"; ?>
									<?php echo $this->Form->input('apellido', array('div' => false, 'label' => false, 'class'=> 'txtApellido form-control','id' =>'txtApellido')); ?>
								</div>
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<?php echo "<label  id='lblSexo'>".__('Sexo')."</label>"; ?>
									<select name="data[Persona][sexo]" class="cboSexo form-control"
										id="cboSexo">
										<?php
										if (isset($obj_persona)){
							echo "<option value = ".$obj_persona->getAttr('sexo')." selected='selected'>";
							if($obj_persona->getAttr('sexo') == 'M'){
								echo __('Masculino')."</option>";
								echo "<option value = 'F'>".__('Femenino')."</option>";
							}else{
								echo __('Femenino')."</option>";
								echo "<option value = 'M'>".__('Masculino')."</option>";
							}
						}else{
						?>
										<option value="M">
											<?php echo __('Masculino'); ?>
										</option>
										<option value="F">
											<?php echo __('Femenino'); ?>
										</option>
										<?php } ?>
									</select>
								</div>
							</div>
							<p>
							
							
							<div class="row">
								<?php
								if(isset($obj_persona) || isset($persona_id)){
				foreach($get_ids as $departamento_user => $v):
				foreach ($v as $distrito_user =>$provincia_user):
				//echo $departamento."--".$distrito ."--".$provincia;
				?>
								<input type="hidden" id="get_id_distrito"
									value="<?php echo $distrito_user; ?>"> <input type="hidden"
									id="get_id_provincia" value="<?php echo $provincia_user; ?>"> <input
									type="hidden" id="get_id_departamento"
									value="<?php echo $departamento_user; ?>">
								<?php
								endforeach;
								endforeach;
			}
			?>
								<div class="span3 col-md-4 col-sm-6 col-xs-6"
									style="margin-left: auto;">
									<?php echo "<label id='lblDepartamentos'>".utf8_encode(__('Departamento'))."</label>"; ?>
									<select class="cboDepartamentos form-control">
										<option selected="selected">
											--
											<?php echo utf8_encode(__('Seleccione Departamento')); ?>
											--
										</option>
										<?php 
										if (isset($list_all_departamentos)){
						foreach ($list_all_departamentos as $list_all_departamento):
						if(isset($obj_persona) || isset($persona_id)){
								if($list_all_departamento->getAttr('id') == $departamento_user){
									debug("mierda".$departamento_user);
									$selected = " selected = 'selected'";
								}else{
									$selected = "";
								}
							}
							echo "<option value = ".$list_all_departamento->getAttr('id').$selected.">".$list_all_departamento->getAttr('nomdepartamento')."</option>";
							endforeach;
					}
					?>
									</select>
								</div>
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<?php echo "<label id='lblProvincia'>".utf8_encode(__('Provincia'))."</label>"; ?>
									<select disabled class="cboProvincia form-control">
										<option selected="selected">
											--
											<?php echo utf8_encode(__('Seleccione Provincia')); ?>
											--
										</option>
										<?php
										if(isset($obj_persona) || isset($persona_id)){
						if (isset($list_all_provincias)){
							foreach ($list_all_provincias as $provincia_item => $v):

							if($provincia_item == $provincia_user){
										$selected = " selected = 'selected'";
									}else{
										$selected = "";
									}
									echo "<option value = ".$provincia_item.$selected.">".$v."</option>";
									endforeach;
						}
					}
					?>
									</select>
								</div>
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<?php echo "<label id='lblDistrito'>".utf8_encode(__('Distrito'))."</label>"; ?>
									<select disabled name="data[Persona][distrito_id]"
										class="cboDistrito form-control">
										<option selected="selected" value="">
											--
											<?php echo  __('Seleccione Distrito'); ?>
											--
										</option>
										<?php
										if(isset($obj_persona) || isset($persona_id)){
						if (isset($list_all_distritos)){
							foreach ($list_all_distritos as $distrito_item):

							if($distrito_item->getAttr('id') == $distrito_user){
										$selected = " selected = 'selected'";
									}else{
										$selected = "";
									}
									echo "<option value = ".$distrito_item->getAttr('id').$selected.">".$distrito_item->getAttr('nomdistrito')."</option>";
									endforeach;
						}
					}
					?>
									</select>
								</div>
							</div>
							<p>
							
							
							<div class="row">
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<?php echo "<label id='lblEstCivil'>".__('Estado Civil')."</label>"; ?>
									<select name="data[Persona][estado_civil_id]"
										class="cboEstadoCivil form-control" id="cboEstadoCivil">
										<?php 
										if(isset($list_all_estados_civiles)){
							foreach ($list_all_estados_civiles as $list_all_estados_civil):
							if(isset($obj_persona) || isset($persona_id)){
								if($list_all_estados_civil->getAttr('id') == $obj_persona->getAttr('estado_civil_id')){
									$selected = " selected = 'selected'";
								}else{
									$selected = "";
								}
							}else{
								$selected = "";
							}
							echo "<option value = ".$list_all_estados_civil->getAttr('id').$selected.">".$list_all_estados_civil->getAttr('descripcion')."</option>";
							endforeach;
						}
						?>
									</select>
								</div>
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<?php echo "<label id='lblFecNacimiento'>".__('Fecha de nacimiento')."</label>"; ?>
									<?php 
									if(isset($obj_persona)){
					$fec_nac = $obj_persona->getAttr('fec_nac');//1990-12-12

					if($fec_nac == '' || $fec_nac == NULL){
						$fec_nac = '';
					}else{
						$dd = substr($fec_nac,-2);
						$mm = substr($fec_nac, 5, 2);
						$yy = substr($fec_nac, 0, 4);
						$fec_nac = $dd.'-'.$mm.'-'.$yy;//12-12-1990
					}
				}
				?>
									<input name="data[Persona][fec_nac]"
										class="txtFechaNacimiento form-control"
										id="txtFechaNacimiento" placeholder="dd-mm-aaaa" type="text"
										value="<?php if(isset($obj_persona)){ echo $fec_nac;}?>">
									<?php //echo $this->Form->input('fec_nac', array('type'=>'text', 'class'=> 'txtFechaNacimiento','id' =>'txtFechaNacimiento','div' => false, 'label' => false,'placeholder'=>'dd-mm-aaaa')); ?>
								</div>
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<?php echo "<label>".utf8_encode(__('Correo electrónico'))."</label>"; ?>
									<?php echo $this->Form->input('email', array('id' =>'txtCorreo','class' =>'txtCorreo form-control','div' => false, 'label' => false,'placeholder' =>'email')); ?>
								</div>
							</div>
							<p>
							
							
							<div class="row">
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<?php echo "<label>".utf8_encode(__('Dirección'))."</label>"; ?>
									<?php echo $this->Form->input('direccion', array('id' =>'txtDireccion','class' =>'txtDireccion form-control','div' => false, 'label' => false,'placeholder' => utf8_encode(__("dirección")))); ?>
								</div>
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<?php echo "<label>".utf8_encode(__('Teléfono/Celular'))."</label>"; ?>
									<?php echo $this->Form->input('telefono', array('id' =>'txtTelefono','class' =>'txtTelefono form-control','div' => false, 'label' => false,'placeholder' => utf8_encode(__("teléfono")))); ?>
									<?php echo $this->Form->input('celular', array('id' =>'txtMovil','class' =>'txtMovil form-control','div' => false, 'label' => false,'placeholder' => utf8_encode(__("móvil")))); ?>
								</div>
								<div class="span3 col-md-4 col-sm-6 col-xs-6">
									<?php if(!isset($persona_id) || ($persona_id == 0)){ ?>
									<?php echo "<label>".__('Rol persona')."</label>"; ?>
									<select name="data[Persona][role_id]"
										class="cboRol form-control">
										<?php 
										if(isset($list_all_roles)){

					foreach ($list_all_roles as $list_all_rol):
					if(isset($obj_persona) || isset($persona_id)){
						if($list_all_rol->getAttr('id') == $obj_persona->getAttr('role_id')){
							$selected = " selected = 'selected'";
						}else{
							$selected = "";
						}
					}else{
						$selected = "";
					}
					echo "<option value = ".$list_all_rol->getAttr('id').$selected.">".$list_all_rol->getAttr('descripcion')."</option>";
					endforeach;
				}
				?>
									</select>
									<?php }?>
								</div>
							</div>
							<br>
							<div class="row" style="text-align: center;">
								<div class="span9">
									<button type="button" class="btn btn-primary btn_crear_persona_trigger" style="margin-right:17px;"><?php echo __('Guardar'); ?></button>
									<button type="button" class="btn btn-white btn-cancelar-crear-persona"><?php echo __('Cancelar');?></button>
								</div>
							</div>
						</section>
						<?php echo $this->Form->end(); ?>
	</div>
				</div>
			</div>
		</div>
	</div>

</div>
<hr>