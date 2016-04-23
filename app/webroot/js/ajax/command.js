$(document).ready(function(){
	
	Command = this;
	$body = $('body');
	
	command = {
		openAddEditCommand: function(command_id){
			if(command_id == undefined || !command_id) {
				command_id ='';
			}
			
			$('div#command #add_edit_command_container').unbind();
			$('div#command #add_edit_command_container').load(env_webroot_script + 'commands/add_edit_command/'+command_id,function(){

			});
		},
		
		deleteCommand: function(command_id){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'commands/delete_command',
				data:{
					'command_id': command_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					$('.command_row_container[command_id='+command_id+']').fadeOut(function(){$(this).remove()});
					$('#conteiner_all_rows').load(env_webroot_script + escape('commands/ajax_listar'),function(){
						$('#dtable_commands').DataTable();
					});
					toastr.success(data.msg);
				}else{
					toastr.error(value[0]);
				}
			});	
		}
	}
	
	/* Mostrar formulario: Crear Command */
	$body.off('click','div#command .btn-nuevo-command');
	$body.on('click', 'div#command .btn-nuevo-command' , function(){
		command_id = $(this).attr('command_id');
		command.openAddEditCommand(command_id);
	});
	
	/* Ocultar formulario Crear Command*/
	$body.on('click','div#div-crear-command .btn-cancelar-crear-command', function(){
		$('#div-crear-command').fadeOut();
	});
	
	$body.off('click','.btn-crear-command-trigger');
	$body.on('click','.btn-crear-command-trigger',function(){
		$form = $(this).parents('form').eq(0);
		$.ajax({
			url: $form.attr('action'),
			data: $form.serialize(),
			dataType: 'json',
			type: 'post'
		}).done(function(data){
			if(data.success==true){
				$('#div-crear-command').hide();
				$('#conteiner_all_rows').load(env_webroot_script + escape('commands/ajax_listar'),function(){
					$('#dtable_commands').DataTable();
				});
				toastr.success(data.msg);
			}else{
				$.each(data.validation, function( key, value ) {
					toastr.error(value[0]);
					$('[name="data[Command]['+key+']"]').parent().addClass('control-group has-error');
					$('[name="data[Command]['+key+']"]').change(function() {
						$('[name="data[Command]['+key+']"]').parent().removeClass('control-group has-error');
					});
				});
			}
		});
	});

	$body.off('click','div#command .edit-command-trigger');
	$body.on('click','div#command .edit-command-trigger', function(){
		command_id = $(this).parents('.command_row_container').attr('command_id');
		command.openAddEditCommand(command_id);
	});
	
	$body.off('click','div#command .open-model-delete-command');
	$body.on('click','div#command .open-model-delete-command', function(){
		command_id = $(this).parents('.command_row_container').attr('command_id');
		$('div#myModalDeleteCommand').attr('command_id', command_id);
	});
	
	$body.off('click','div#myModalDeleteCommand .eliminar-command-trigger');
	$body.on('click','div#myModalDeleteCommand .eliminar-command-trigger', function(){
		command_id = $('div#myModalDeleteCommand').attr('command_id');
		command.deleteCommand(command_id);
	});
	
});