<style>
div#spinner
{
    display: none;
    width:180px;
    height: 100px;
    position: fixed;
    top: 50%;
    left: 50%;
    text-align:center;
    margin-left: -50px;
    margin-top: -100px;
    z-index:2;
    overflow: auto;
}    
</style>
<div id="spinner">
    <img src="<?= ENV_WEBROOT_FULL_URL; ?>img/ajax-loader.gif" alt="Loading..."/><br>
    <label>Espere un momento...</label>
</div>
<div id="div-backup-db">
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Enviar Copia de Seguridad de la Base de Datos</h2>
		</div>
 	</div>
 
	<div class="wrapper wrapper-content animated fadeInRight" id="div-container-form-send-bk">
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
						<?php echo $this->Form->create('SendBackup',array('method'=>'post', 'id'=>'form_send_backup','action'=> false, 'accept-charset' => 'utf-8', 'class' => 'form-horizontal'));?>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo utf8_encode('Correo de destino'); ?></label>
								<div class="col-sm-6">
									<?php echo $this->Form->input('backup_e_destino', array('div' => false, 'label' => false, 'class'=>'form-control','id'=>'backup-e-destino')); ?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo utf8_encode('Asunto'); ?></label>
								<div class="col-sm-6">
									<?php echo $this->Form->input('backup_asunto', array('div' => false, 'label' => false, 'class'=>'form-control','id'=>'backup-asunto')); ?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo utf8_encode('Mensaje'); ?></label>
								<div class="col-sm-6">
									<?php echo $this->Form->input('backup_mensaje', array('div' => false, 'label' => false,'type'=>'textarea','rows'=>'5', 'class'=> 'txtInfDes5 form-control','id' =>'backup-mensaje')); ?>
								</div>
							</div>
							
							
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-2">
									<button type="button" class="btn btn-primary send-backup-email-trigger" style="margin-right:17px;"><?php echo __('Enviar'); ?></button>
									<button type="button" class="btn btn-white" onclick="javascript:document.getElementById('form_send_backup').reset();"><?php echo __('Limpiar'); ?></button>
								</div>
							</div>
						<?php echo $this->Form->end(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>