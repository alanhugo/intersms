$(document).ready(function(){
	
	Phonesclient = this;
	$body = $('body');
	
	phonesclient = {
		openAddEditPhonesclient: function(phonesclient_id){
			if(phonesclient_id == undefined || !phonesclient_id) {
				phonesclient_id ='';
			}
			
			$('div#phonesclient #add_edit_phonesclient_container').unbind();
			$('div#phonesclient #add_edit_phonesclient_container').load(env_webroot_script + 'phonesclients/add_edit_phonesclient/'+phonesclient_id,function(){
				$('.chosen-select').chosen();
			});
		},
		
		deletePhonesclient: function(phonesclient_id){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'phonesclients/delete_phonesclient',
				data:{
					'phonesclient_id': phonesclient_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					$('.phonesclient_row_container[phonesclient_id='+phonesclient_id+']').fadeOut(function(){$(this).remove()});
					$('#conteiner_all_rows').load(env_webroot_script + escape('phonesclients/ajax_listar'),function(){
						$('#dtable_phonesclients').DataTable();
					});
					toastr.success(data.msg);
				}else{
					toastr.error(value[0]);
				}
			});	
		}
	}
	
	/* Mostrar formulario: Crear phonesclient */
	$body.off('click','div#phonesclient .btn-nuevo-phonesclient');
	$body.on('click', 'div#phonesclient .btn-nuevo-phonesclient' , function(){
		phonesclient_id = $(this).attr('phonesclient_id');
		phonesclient.openAddEditPhonesclient(phonesclient_id);
	});
	
	/* Ocultar formulario Crear phonesclient*/
	$body.on('click','div#div-crear-phonesclient .btn-cancelar-crear-phonesclient', function(){
		$('#div-crear-phonesclient').fadeOut();
	});
	
	$body.off('click','.btn-crear-phonesclient-trigger');
	$body.on('click','.btn-crear-phonesclient-trigger',function(){
		$form = $(this).parents('form').eq(0);
		$.ajax({
			url: $form.attr('action'),
			data: $form.serialize(),
			dataType: 'json',
			type: 'post'
		}).done(function(data){
			if(data.success==true){
				$('#div-crear-phonesclient').hide();
				$('#conteiner_all_rows').load(env_webroot_script + escape('phonesclients/ajax_listar'),function(){
					$('#dtable_phonesclients').DataTable();
				});
				toastr.success(data.msg);
			}else{
				$.each(data.validation, function( key, value ) {
					toastr.error(value[0]);
					$('[name="data[Phonesclient]['+key+']"]').parent().addClass('control-group has-error');
					$('[name="data[Phonesclient]['+key+']"]').change(function() {
						$('[name="data[Phonesclient]['+key+']"]').parent().removeClass('control-group has-error');
					});
				});
			}
		});
	});

	$body.off('click','div#phonesclient .edit-phonesclient-trigger');
	$body.on('click','div#phonesclient .edit-phonesclient-trigger', function(){
		phonesclient_id = $(this).parents('.phonesclient_row_container').attr('phonesclient_id');
		phonesclient.openAddEditPhonesclient(phonesclient_id);
	});
	
	$body.off('click','div#phonesclient .open-model-delete-phonesclient');
	$body.on('click','div#phonesclient .open-model-delete-phonesclient', function(){
		phonesclient_id = $(this).parents('.phonesclient_row_container').attr('phonesclient_id');
		$('div#myModalDeletePhonesclient').attr('phonesclient_id', phonesclient_id);
	});
	
	$body.off('click','div#myModalDeletePhonesclient .eliminar-phonesclient-trigger');
	$body.on('click','div#myModalDeletePhonesclient .eliminar-phonesclient-trigger', function(){
		phonesclient_id = $('div#myModalDeletePhonesclient').attr('phonesclient_id');
		phonesclient.deletePhonesclient(phonesclient_id);
	});
	
});