<div class="container div-crear-phonesclient form" id="div-crear-phonesclient">

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
						<?php echo $this->Form->create('Phonesclient',array('action'=>'add_edit_phonesclient','method'=>'post', 'id'=>'add_edit_phonesclient', 'type' => 'file', 'class'=>'form-horizontal'));?>
							<div class="form-group">
								<label class="col-sm-2 control-label">Numero:</label>
								<div class="col-sm-4">
									<input type="text" name="data[Phonesclient][PhoneNumber]" id="PhoneNumber" class="form-control" value="<?php echo (isset($obj_phonesclient))?$obj_phonesclient->getAttr('PhoneNumber'):''?>">
								</div>
								<label class="col-sm-1 control-label">Cliente:</label>
								<div class="col-sm-4">
									<input type="text" name="data[Phonesclient][UserPhone]" id="PhoneNumber" class="form-control" value="<?php echo (isset($obj_phonesclient))?$obj_phonesclient->getAttr('UserPhone'):''?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Data1:</label>
								<div class="col-sm-4">
									<input type="text" name="data[Phonesclient][Data1]" id="PhoneNumber" class="form-control" value="<?php echo (isset($obj_phonesclient))?$obj_phonesclient->getAttr('Data1'):''?>">
								</div>
								<label class="col-sm-1 control-label">Data2:</label>
								<div class="col-sm-4">
									<input type="text" name="data[Phonesclient][Data2]" id="PhoneNumber" class="form-control" value="<?php echo (isset($obj_phonesclient))?$obj_phonesclient->getAttr('Data2'):''?>">
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
									<button type="button" class="btn btn-primary btn-crear-phonesclient-trigger" style="margin-right:17px;">Guardar</button>
									<button type="button" class="btn btn-white btn-cancelar-crear-phonesclient">Cancelar</button>
								</div>
							</div>
						<?php echo $this->Form->end(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>