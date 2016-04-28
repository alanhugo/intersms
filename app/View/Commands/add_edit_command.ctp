<div class="container div-crear-command form" id="div-crear-command">

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
						<?php echo $this->Form->create('Command',array('action'=>'add_edit_command','method'=>'post', 'id'=>'add_edit_command', 'type' => 'file', 'class'=>'form-horizontal'));?>
							<div class="form-group">
								<label class="col-sm-2 control-label">Nombre:</label>
								<div class="col-sm-4">
									<input type="text" name="data[Command][Command]" id="Command" class="form-control" value="<?php echo (isset($obj_command))?$obj_command->getAttr('Command'):''?>">
								</div>
								<label class="col-sm-1 control-label">Celular:</label>
								<div class="col-sm-4">
									<input type="text" name="data[Command][PhoneID]" id="PhoneID" class="form-control" value="<?php echo (isset($obj_command))?$obj_command->getAttr('PhoneID'):''?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">FlagCMD:</label>
								<div class="col-sm-4">
									<input type="text" name="data[Command][FlagCMD]" id="FlagCMD" class="form-control" value="<?php echo (isset($obj_command))?$obj_command->getAttr('FlagCMD'):''?>">
								</div>
								<label class="col-sm-1 control-label">Terminador:</label>
								<div class="col-sm-4">
									<select name="data[Command][Terminator]" data-placeholder="Seleccionar un terminador" class="chosen-select" style="width:100%;" tabindex="4">
										<option <?php echo (isset($obj_command))?(($obj_command->getAttr('Terminator')=='#registrar')?'selected':''):''?> value="#registrar">#Registrar</option>
										<option <?php echo (isset($obj_command))?(($obj_command->getAttr('Terminator')=='salto_linea')?'selected':''):''?> value="salto_linea">Salto de Linea</option>
										<option <?php echo (isset($obj_command))?(($obj_command->getAttr('Terminator')=='emergencia')?'selected':''):''?> value="emergencia">Emergencia</option>
										<option <?php echo (isset($obj_command))?(($obj_command->getAttr('Terminator')=='urgencia')?'selected':''):''?> value="urgencia">Urgencia</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Help Mess:</label>
								<div class="col-sm-4">
									<textarea name="data[Command][HelpMess]" class="form-control"><?php echo (isset($obj_command))?$obj_command->getAttr('HelpMess'):''?></textarea>
								</div>
								<label class="col-sm-1 control-label">Info Mess:</label>
								<div class="col-sm-4">
									<textarea name="data[Command][InfoMess]" class="form-control"><?php echo (isset($obj_command))?$obj_command->getAttr('InfoMess'):''?></textarea>
								</div>
							</div>
							<div class="form-group">
				            	<label class="col-sm-2 control-label">Grupo:</label>
					            <div class="col-sm-9">
						            <select name="data[Groupcmd][IDGroup][]" data-placeholder="Seleccionar un grupo" class="chosen-select" multiple style="width:100%;" tabindex="4">
						            	<?php foreach ($arr_obj_groupcmds as $key => $obj_groupcmds) {?>
										<option <?php echo (in_array($obj_groupcmds->getAttr('IDGroup'),$arr_commandgroup_idgroup))?"selected":""?> value="<?php echo $obj_groupcmds->getAttr('IDGroup');?>"><?php echo $obj_groupcmds->getAttr('DGroup');?></option>
										<?php } ?>
						            </select>
								</div>
				            </div>

							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-2">
									<button type="button" class="btn btn-primary btn-crear-command-trigger" style="margin-right:17px;">Guardar</button>
									<button type="button" class="btn btn-white btn-cancelar-crear-command">Cancelar</button>
								</div>
							</div>
						<?php echo $this->Form->end(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>