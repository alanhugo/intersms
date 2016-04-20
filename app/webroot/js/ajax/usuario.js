$(document).ready(function(){
	
	Usuario = this;
	$body = $('body');
	
	usuario = {
		openAddEditUsuario: function(usuario_id){
			if(usuario_id == undefined || !usuario_id) {
				usuario_id ='';
			}
			
			$('div#usuario #add_edit_usuario_container').unbind();
			$('div#usuario #add_edit_usuario_container').load(env_webroot_script + 'usuarios/add_edit_usuario/'+usuario_id,function(){
			});
		},
		
		deleteUsuario: function(usuario_id){	
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'usuarios/delete_usuario',
				data:{
					'usuario_id': usuario_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					$('.usuario_row_container[usuario_id='+usuario_id+']').fadeOut(function(){$(this).remove()});
					toastr.success(data.msg);
				}else{
					toastr.error(value[0]);
				}
			});	
		},
		
		changePassword: function(usuario_id,password){	
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'usuarios/change_password',
				data:{
					'usuario_id': usuario_id,
					'password': password
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					toastr.success(data.msg);
				}else{
					toastr.error(value[0]);
				}
			});	
		}
	}
	
	/* Mostrar formulario: Crear Usuario */
	$body.off('click','div#usuario .btn-nuevo-usuario');
	$body.on('click', 'div#usuario .btn-nuevo-usuario' , function(){
		usuario_id = $(this).attr('usuario_id');
		usuario.openAddEditUsuario(usuario_id);
	});
	
	/* Ocultar formulario Crear Usuario*/
	$body.on('click','div#div-crear-usuario .btn-cancelar-crear-usuario', function(){
		$('#div-crear-usuario').fadeOut();
	});
	
	$body.off('click','.btn-crear-usuario-trigger');
	$body.on('click','.btn-crear-usuario-trigger',function(){
		//$form = $(this).parents('form').eq(0);
		var formData = new FormData($("#add_edit_usuario")[0]);
		$.ajax({
			url: $("#add_edit_usuario").attr('action'),
			data: formData,
			dataType: 'json',
			type: 'post',
			cache: false,
            contentType: false,
            processData: false,
		}).done(function(data){
			if(data.success==true){
				$('#div-crear-usuario').fadeOut();
				$('#conteiner_all_rows').load(env_webroot_script + 'usuarios/ajax_listar',function(){
					$('#dtable_usuarios').DataTable();
				});
				toastr.success(data.msg);
			}else{
				$.each(data.validation, function( key, value ) {
					toastr.error(value[0]);
					$('[name="data[Usuario]['+key+']"]').parent().addClass('control-group has-error');
					$('[name="data[Usuario]['+key+']"]').change(function() {
						$('[name="data[Usuario]['+key+']"]').parent().removeClass('control-group has-error');
					});
				});
			}
		});
	});

	$body.off('click','div#usuario .edit-usuario-trigger');
	$body.on('click','div#usuario .edit-usuario-trigger', function(){
		usuario_id = $(this).parents('.usuario_row_container').attr('usuario_id');
		usuario.openAddEditUsuario(usuario_id);
	});
	
	$body.off('click','div#usuario .open-model-delete-usuario');
	$body.on('click','div#usuario .open-model-delete-usuario', function(){
		usuario_id = $(this).parents('.usuario_row_container').attr('usuario_id');
		username = $(this).parents('.usuario_row_container').attr('username');
		$('div#myModalDeleteUsuario').attr('usuario_id', usuario_id);
		$('div#myModalDeleteUsuario .modal-title #username').text(username);
	});
	
	$body.off('click','div#myModalDeleteUsuario .eliminar-usuario-trigger');
	$body.on('click','div#myModalDeleteUsuario .eliminar-usuario-trigger', function(){
		usuario_id = $('div#myModalDeleteUsuario').attr('usuario_id');
		usuario.deleteUsuario(usuario_id);
	});
	
	$body.off('click','div#usuario .link_cambiar_clave');
	$body.on('click','div#usuario .link_cambiar_clave', function(){
		usuario_id = $('#UsuarioUserID').val();
		username = $('#UsuarioUserName').val();
		$('div#myModalChangePass').attr('usuario_id', usuario_id);
		$('#nombreUsuarioChange').text(username);
	});
	
	$body.off('click','div#myModalChangePass .cambiar-password-usuario-trigger');
	$body.on('click','div#myModalChangePass .cambiar-password-usuario-trigger', function(){
		usuario_id = $('div#myModalChangePass').attr('usuario_id');
		password = $('#password').val();
		usuario.changePassword(usuario_id,password);
	});
	
});