$(document).ready(function(){
	
	Accione = this;
	$body = $('body');
	
	accion = {
		openAddEditAccione: function(accion_id){
			if(accion_id == undefined || !accion_id) {
				accion_id ='';
			}
			
			$('div#accion #add_edit_accion_container').unbind();
			$('div#accion #add_edit_accion_container').load(env_webroot_script + 'acciones/add_edit_accion/'+accion_id,function(){

			});
		},
		
		deleteAccione: function(accion_id){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'acciones/delete_accion',
				data:{
					'accion_id': accion_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					$('.accion_row_container[accion_id='+accion_id+']').fadeOut(function(){$(this).remove()});
					$('#conteiner_all_rows').load(env_webroot_script + escape('acciones/find_acciones/1/'+null+'/'+null+'/'+''+'/'+''),function(){
						$('#dtable_acciones').DataTable();
					});
					toastr.success(data.msg);
				}else{
					toastr.error(value[0]);
				}
			});	
		}
	}
	
	/* Mostrar formulario: Crear Accion */
	$body.off('click','div#accion .btn-nuevo-accion');
	$body.on('click', 'div#accion .btn-nuevo-accion' , function(){
		accion_id = $(this).attr('accion_id');
		accion.openAddEditAccione(accion_id);
	});
	
	/* Ocultar formulario Crear Accion*/
	$body.on('click','div#div-crear-accion .btn-cancelar-crear-accion', function(){
		$('#div-crear-accion').fadeOut();
	});
	
	$body.off('click','.btn-crear-accion-trigger');
	$body.on('click','.btn-crear-accion-trigger',function(){
		$form = $(this).parents('form').eq(0);
		$.ajax({
			url: $form.attr('action'),
			data: $form.serialize(),
			dataType: 'json',
			type: 'post'
		}).done(function(data){
			if(data.success==true){
				$('#div-crear-accion').hide();
				$('#conteiner_all_rows').load(env_webroot_script + escape('acciones/find_acciones/1/'+null+'/'+null+'/'+''+'/'+''),function(){
					$('#dtable_acciones').DataTable();
				});
				toastr.success(data.msg);
			}else{
				$.each(data.validation, function( key, value ) {
					toastr.error(value[0]);
					$('[name="data[Accione]['+key+']"]').parent().addClass('control-group has-error');
					$('[name="data[Accione]['+key+']"]').change(function() {
						$('[name="data[Accione]['+key+']"]').parent().removeClass('control-group has-error');
					});
				});
			}
		});
	});

	$body.off('click','div#accion .edit-accion-trigger');
	$body.on('click','div#accion .edit-accion-trigger', function(){
		accion_id = $(this).parents('.accion_row_container').attr('accion_id');
		accion.openAddEditAccione(accion_id);
	});
	
	$body.off('click','div#accion .open-model-delete-accion');
	$body.on('click','div#accion .open-model-delete-accion', function(){
		accion_id = $(this).parents('.accion_row_container').attr('accion_id');
		$('div#myModalDeleteAccion').attr('accion_id', accion_id);
	});
	
	$body.off('click','div#myModalDeleteAccion .eliminar-accion-trigger');
	$body.on('click','div#myModalDeleteAccion .eliminar-accion-trigger', function(){
		accion_id = $('div#myModalDeleteAccion').attr('accion_id');
		accion.deleteAccione(accion_id);
	});
	
});