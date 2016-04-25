<div class="container div-crear-groupcmd form" id="div-crear-groupcmd">

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
						<?php echo $this->Form->create('Groupcmd',array('action'=>'add_edit_groupcmd','method'=>'post', 'id'=>'add_edit_groupcmd', 'type' => 'file', 'class'=>'form-horizontal'));?>
							<div class="form-group">
								<label class="col-sm-2 control-label">Nombre:</label>
								<div class="col-sm-4">
									<input type="text" name="data[Groupcmd][DGroup]" id="GroupName" class="form-control" value="<?php echo (isset($obj_groupcmd))?$obj_groupcmd->getAttr('DGroup'):''?>">
								</div>
								
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-2">
									<button type="button" class="btn btn-primary btn-crear-groupcmd-trigger" style="margin-right:17px;">Guardar</button>
									<button type="button" class="btn btn-white btn-cancelar-crear-groupcmd">Cancelar</button>
								</div>
							</div>
						<?php echo $this->Form->end(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>