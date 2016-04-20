$(document).ready(function(){
	
	TipoDocumento = this;
	$body = $('body');
	
	tipo_documento = {
		openAddEditTipoDocumento: function(tipo_documento_id){
			if(tipo_documento_id == undefined || !tipo_documento_id) {
				tipo_documento_id ='';
			}
			
			$('div#tipo_documento #add_edit_tipo_documento_container').unbind();
			$('div#tipo_documento #add_edit_tipo_documento_container').load(env_webroot_script + 'tipo_documentos/add_edit_tipo_documento/'+tipo_documento_id,function(){

			});
		},
		
		deleteTipoDocumento: function(tipo_documento_id){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'tipo_documentos/delete_tipo_documento',
				data:{
					'tipo_documento_id': tipo_documento_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					$('.tipo_documento_row_container[tipo_documento_id='+tipo_documento_id+']').fadeOut(function(){$(this).remove()});
					$('#conteiner_all_rows').load(env_webroot_script + escape('tipo_documentos/find_tipo_documentos/1/'+null+'/'+null+'/'+''+'/'+''),function(){
						$('#dtable_tipo_documentos').DataTable();
					});
					toastr.success(data.msg);
				}else{
					toastr.error(value[0]);
				}
			});	
		}
	}
	
	/* Mostrar formulario: Crear TipoDocumento */
	$body.off('click','div#tipo_documento .btn-nuevo-tipo-documento');
	$body.on('click', 'div#tipo_documento .btn-nuevo-tipo-documento' , function(){
		tipo_documento_id = $(this).attr('tipo_documento_id');
		tipo_documento.openAddEditTipoDocumento(tipo_documento_id);
	});
	
	/* Ocultar formulario Crear TipoDocumento*/
	$body.on('click','div#div-crear-tipo-documento .btn-cancelar-crear-tipo-documento', function(){
		$('#div-crear-tipo-documento').fadeOut();
	});
	
	$body.off('click','.btn-crear-tipo-documento-trigger');
	$body.on('click','.btn-crear-tipo-documento-trigger',function(){
		$form = $(this).parents('form').eq(0);
		$.ajax({
			url: $form.attr('action'),
			data: $form.serialize(),
			dataType: 'json',
			type: 'post'
		}).done(function(data){
			if(data.success==true){
				$('#div-crear-tipo-documento').hide();
				$('#conteiner_all_rows').load(env_webroot_script + escape('tipo_documentos/find_tipo_documentos/1/'+null+'/'+null+'/'+''+'/'+''),function(){
					$('#dtable_tipo_documentos').DataTable();
				});
				toastr.success(data.msg);
			}else{
				$.each(data.validation, function( key, value ) {
					toastr.error(value[0]);
					$('[name="data[TipoDocumento]['+key+']"]').parent().addClass('control-group has-error');
					$('[name="data[TipoDocumento]['+key+']"]').change(function() {
						$('[name="data[TipoDocumento]['+key+']"]').parent().removeClass('control-group has-error');
					});
				});
			}
		});
	});

	$body.off('click','div#tipo_documento .edit-tipo-documento-trigger');
	$body.on('click','div#tipo_documento .edit-tipo-documento-trigger', function(){
		tipo_documento_id = $(this).parents('.tipo_documento_row_container').attr('tipo_documento_id');
		tipo_documento.openAddEditTipoDocumento(tipo_documento_id);
	});
	
	$body.off('click','div#tipo_documento .open-model-delete-tipo-documento');
	$body.on('click','div#tipo_documento .open-model-delete-tipo-documento', function(){
		tipo_documento_id = $(this).parents('.tipo_documento_row_container').attr('tipo_documento_id');
		$('div#myModalDeleteTipoDocumento').attr('tipo_documento_id', tipo_documento_id);
	});
	
	$body.off('click','div#myModalDeleteTipoDocumento .eliminar-tipo-documento-trigger');
	$body.on('click','div#myModalDeleteTipoDocumento .eliminar-tipo-documento-trigger', function(){
		tipo_documento_id = $('div#myModalDeleteTipoDocumento').attr('tipo_documento_id');
		tipo_documento.deleteTipoDocumento(tipo_documento_id);
	});
	
});