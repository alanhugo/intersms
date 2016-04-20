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
<div class="row">
	<div class="col-md-12">
		<h2>Enviar Copia de Seguridad de la Base de Datos</h2>
	</div>
</div>
<hr />
<div id="spinner">
    <img src="<?= ENV_WEBROOT_FULL_URL; ?>img/ajax-loader.gif" alt="Loading..."/><br>
    <label>Espere un momento...</label>
</div>
<div id="div-backup-db">
	<div class="col-md-12">
	<?php echo $this->Form->create('SendBackup',array('method'=>'post', 'id'=>'form_send_backup','action'=> false));?>
							<div class="row">
								<div class="span3 col-md-2 col-sm-6 col-xs-6">
									<label><?php echo utf8_encode(__('Correo de destino:')); ?> </label>
								</div>
								<div class="span3 col-md-3 col-sm-6 col-xs-6">
									<?php echo $this->Form->input('backup_e_destino', array('div' => false, 'label' => false, 'class'=>'form-control','id'=>'backup-e-destino', 'value'=>'')); ?>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="span3 col-md-2 col-sm-6 col-xs-6">
									<label><?php echo utf8_encode(__('Asunto:')); ?> </label>
								</div>
								<div class="span3 col-md-3 col-sm-6 col-xs-6">
									<?php echo $this->Form->input('backup_asunto', array('div' => false, 'label' => false, 'class'=>'form-control','id'=>'backup-asunto')); ?>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="span3 col-md-2 col-sm-6 col-xs-6">
									<label><?php echo utf8_encode(__('Mensaje:')); ?> </label>
								</div>
								<div class="span3 col-md-3 col-sm-6 col-xs-6">
									<?php echo $this->Form->input('backup_mensaje', array('div' => false, 'label' => false,'type'=>'textarea','rows'=>'5', 'class'=> 'txtInfDes5 form-control','id' =>'backup-mensaje')); ?>
								</div>
							</div>
	<?php echo $this->Form->end(); ?>
	<br>
			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-6" style="text-align:right;">
				<button class="btn" onclick="javascript:document.getElementById('form_send_backup').reset();"><?php echo __('Limpiar'); ?></button>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6">
				<button class="btn btn-danger send-backup-email-trigger"><?php echo __('Enviar'); ?></button>
				</div>
		    </div>
	</div>
</div>