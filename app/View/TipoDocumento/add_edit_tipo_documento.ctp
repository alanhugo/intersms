<div class="container div-crear-tipo-documento form" id="div-crear-tipo-documento">

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
						<?php echo $this->Form->create('TipoDocumento',array('method'=>'post', 'id'=>'add_edit_tipo_documento', 'accept-charset' => 'utf-8', 'class' => 'form-horizontal'));?>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo utf8_encode('Tipo Documento'); ?></label>
								<div class="col-sm-6">
									<?php echo $this->Form->input('descripcion', array('div' => false, 'label' => false, 'class'=> 'txtTipoDocumento form-control','id' =>'txtTipoDocumento','style'=>'text-transform:uppercase;', 'onkeyup'=>'javascript:this.value=this.value.toUpperCase();','maxlength'=>'100')); ?>
								</div>
							</div>
							
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-2">
									<button type="button" class="btn btn-primary btn-crear-tipo-documento-trigger" style="margin-right:17px;"><?php echo __('Guardar'); ?></button>
									<button type="button" class="btn btn-white btn-cancelar-crear-tipo-documento"><?php echo __('Cancelar');?></button>
								</div>
							</div>
						<?php echo $this->Form->end(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>