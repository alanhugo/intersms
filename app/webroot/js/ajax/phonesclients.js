$(document).ready(function(){
	
	Groupcmd = this;
	$body = $('body');
	
	groupcmd = {
		openAddEditGroupcmd: function(groupcmd_id){
			if(groupcmd_id == undefined || !groupcmd_id) {
				groupcmd_id ='';
			}
			
			$('div#groupcmd #add_edit_groupcmd_container').unbind();
			$('div#groupcmd #add_edit_groupcmd_container').load(env_webroot_script + 'groupcmds/add_edit_groupcmd/'+groupcmd_id,function(){

			});
		},
		
		deleteGroupcmd: function(groupcmd_id){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'groupcmds/delete_groupcmd',
				data:{
					'groupcmd_id': groupcmd_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					$('.groupcmd_row_container[groupcmd_id='+groupcmd_id+']').fadeOut(function(){$(this).remove()});
					$('#conteiner_all_rows').load(env_webroot_script + escape('groupcmds/ajax_listar'),function(){
						$('#dtable_groupcmds').DataTable();
					});
					toastr.success(data.msg);
				}else{
					toastr.error(value[0]);
				}
			});	
		}
	}
	
	/* Mostrar formulario: Crear Groupcmd */
	$body.off('click','div#groupcmd .btn-nuevo-groupcmd');
	$body.on('click', 'div#groupcmd .btn-nuevo-groupcmd' , function(){
		groupcmd_id = $(this).attr('groupcmd_id');
		groupcmd.openAddEditGroupcmd(groupcmd_id);
	});
	
	/* Ocultar formulario Crear Groupcmd*/
	$body.on('click','div#div-crear-groupcmd .btn-cancelar-crear-groupcmd', function(){
		$('#div-crear-groupcmd').fadeOut();
	});
	
	$body.off('click','.btn-crear-groupcmd-trigger');
	$body.on('click','.btn-crear-groupcmd-trigger',function(){
		$form = $(this).parents('form').eq(0);
		$.ajax({
			url: $form.attr('action'),
			data: $form.serialize(),
			dataType: 'json',
			type: 'post'
		}).done(function(data){
			if(data.success==true){
				$('#div-crear-groupcmd').hide();
				$('#conteiner_all_rows').load(env_webroot_script + escape('groupcmds/ajax_listar'),function(){
					$('#dtable_groupcmds').DataTable();
				});
				toastr.success(data.msg);
			}else{
				$.each(data.validation, function( key, value ) {
					toastr.error(value[0]);
					$('[name="data[Groupcmd]['+key+']"]').parent().addClass('control-group has-error');
					$('[name="data[Groupcmd]['+key+']"]').change(function() {
						$('[name="data[Groupcmd]['+key+']"]').parent().removeClass('control-group has-error');
					});
				});
			}
		});
	});

	$body.off('click','div#groupcmd .edit-groupcmd-trigger');
	$body.on('click','div#groupcmd .edit-groupcmd-trigger', function(){
		groupcmd_id = $(this).parents('.groupcmd_row_container').attr('groupcmd_id');
		groupcmd.openAddEditGroupcmd(groupcmd_id);
	});
	
	$body.off('click','div#groupcmd .open-model-delete-groupcmd');
	$body.on('click','div#groupcmd .open-model-delete-groupcmd', function(){
		groupcmd_id = $(this).parents('.groupcmd_row_container').attr('groupcmd_id');
		$('div#myModalDeleteGroupcmd').attr('groupcmd_id', groupcmd_id);
	});
	
	$body.off('click','div#myModalDeleteGroupcmd .eliminar-groupcmd-trigger');
	$body.on('click','div#myModalDeleteGroupcmd .eliminar-groupcmd-trigger', function(){
		groupcmd_id = $('div#myModalDeleteGroupcmd').attr('groupcmd_id');
		groupcmd.deleteGroupcmd(groupcmd_id);
	});
	
});