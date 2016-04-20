<div class="modal inmodal" id="myModalAddRemitente" tabindex="-1"
	role="dialog" aria-hidden="true" tramite_id=''>
	<div class="modal-dialog">
		<div class="modal-content animated fadeIn">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<i class="fa fa-check modal-icon"></i>
				<h3 class="modal-title">
					Crear Remitente  <span id="num-doc"></span>?
				</h3>
			</div>
			<div class="modal-body">
				<form action="<?= ENV_WEBROOT_FULL_URL; ?>persona/add_remitente" method="post" id="form_create_remitente" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
								<div class="row">
									<div class="span3 col-md-4 col-sm-6 col-xs-6">
										<label><?php echo utf8_encode(__('Apellidos y Nombres:')); ?> </label>
									</div>
									<div class="span3 col-md-6 col-sm-6 col-xs-6">
										<input name="data[Persona][nombre]" class= 'form-control' id ='txt-apellido-nombre'/>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="span3 col-md-4 col-sm-6 col-xs-6">
										<label><?php echo utf8_encode(__('DNI:')); ?> </label>
									</div>
									<div class="span3 col-md-6 col-sm-6 col-xs-6">
										<input name="data[Persona][nro_documento]" class= 'form-control' id ='txt-nro-documento' maxlength='8' />
									</div>
								</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">
					Cancelar
				</button>
				<button type="button"
					class="btn btn-primary save-remitente-modal-trigger"
					data-dismiss="modal">
					Crear
				</button>
			</div>
		</div>
	</div>
</div>