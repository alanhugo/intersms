$(document).ready(function(){
	
	Configuration = this;
	$body = $('body');
	
	configuration = {
			sendBackup: function(email_destino, asunto, mensaje){
				$('#spinner').show();
				$('#form_send_backup').hide();
				$.ajax({
					type: 'post',
					url: env_webroot_script + 'configurations/send_database',
					data:{
						'email_destino': email_destino,
						'asunto': asunto,
						'mensaje': mensaje
					},
					dataType: 'json'
				}).done(function(data){
					if(data.success == true){
						toastr.success(data.msg);
						$('#spinner').hide();
						$('#form_send_backup').show();
						//$('#form_send_backup').reset();
						document.getElementById('form_send_backup').reset();
					}else{
						$('#spinner').hide();
						$('#form_send_backup').show();
						$.each(data.validation, function( key, value ) {
							toastr.error(value[0]);
							$('[name="data[SendBackup]['+key+']"]').parent().addClass('control-group has-error');
							$('[name="data[SendBackup]['+key+']"]').change(function() {
							$('[name="data[SendBackup]['+key+']"]').parent().removeClass('control-group has-error');
							});
						});
					}
				});	
			}
	}
	
	$body.off('click','div#div-backup-db .send-backup-email-trigger');
	$body.on('click','div#div-backup-db .send-backup-email-trigger', function(){
		email_destino = $('div#div-backup-db #backup-e-destino').val();
		asunto = $('div#div-backup-db #backup-asunto').val();
		mensaje = $('div#div-backup-db #backup-mensaje').val();
		configuration.sendBackup(email_destino, asunto, mensaje);
	});
	
	
	$('#spinner').ajaxStart(function () {
		$('#div-backup-db').hide();
	    $(this).fadeIn('fast');
	 }).ajaxStop(function () {
	     $(this).stop().fadeOut('fast');
	     document.getElementById('form_send_backup').reset();
	     $('#div-backup-db').show();
	});
	
});