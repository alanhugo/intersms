$(document).ready(function(){
	
	Area = this;
	$body = $('body');
	
	area = {
		openAddEditArea: function(area_id){
			if(area_id == undefined || !area_id) {
				area_id ='';
			}
			
			$('div#area #add_edit_area_container').unbind();
			$('div#area #add_edit_area_container').load(env_webroot_script + 'areas/add_edit_area/'+area_id,function(){

			});
		},
		
		deleteArea: function(area_id){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'areas/delete_area',
				data:{
					'area_id': area_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					$('.area_row_container[area_id='+area_id+']').fadeOut(function(){$(this).remove()});
					$('#conteiner_all_rows').load(env_webroot_script + escape('areas/find_areas/1/'+null+'/'+null+'/'+''+'/'+''),function(){
						$('#dtable_areas').DataTable();
					});
					toastr.success(data.msg);
				}else{
					toastr.error(value[0]);
				}
			});	
		}
	}
	
	/* Mostrar formulario: Crear Area */
	$body.off('click','div#area .btn-nuevo-area');
	$body.on('click', 'div#area .btn-nuevo-area' , function(){
		area_id = $(this).attr('area_id');
		area.openAddEditArea(area_id);
	});
	
	/* Ocultar formulario Crear Area*/
	$body.on('click','div#div-crear-area .btn-cancelar-crear-area', function(){
		$('#div-crear-area').fadeOut();
	});
	
	$body.off('click','.btn-crear-area-trigger');
	$body.on('click','.btn-crear-area-trigger',function(){
		$form = $(this).parents('form').eq(0);
		$.ajax({
			url: $form.attr('action'),
			data: $form.serialize(),
			dataType: 'json',
			type: 'post'
		}).done(function(data){
			if(data.success==true){
				$('#div-crear-area').hide();
				$('#conteiner_all_rows').load(env_webroot_script + escape('areas/find_areas/1/'+null+'/'+null+'/'+''+'/'+''),function(){
					$('#dtable_areas').DataTable();
				});
				toastr.success(data.msg);
			}else{
				$.each(data.validation, function( key, value ) {
					toastr.error(value[0]);
					$('[name="data[Area]['+key+']"]').parent().addClass('control-group has-error');
					$('[name="data[Area]['+key+']"]').change(function() {
						$('[name="data[Area]['+key+']"]').parent().removeClass('control-group has-error');
					});
				});
			}
		});
	});

	$body.off('click','div#area .edit-area-trigger');
	$body.on('click','div#area .edit-area-trigger', function(){
		area_id = $(this).parents('.area_row_container').attr('area_id');
		area.openAddEditArea(area_id);
	});
	
	$body.off('click','div#area .open-model-delete-area');
	$body.on('click','div#area .open-model-delete-area', function(){
		area_id = $(this).parents('.area_row_container').attr('area_id');
		$('div#myModalDeleteArea').attr('area_id', area_id);
	});
	
	$body.off('click','div#myModalDeleteArea .eliminar-area-trigger');
	$body.on('click','div#myModalDeleteArea .eliminar-area-trigger', function(){
		area_id = $('div#myModalDeleteArea').attr('area_id');
		area.deleteArea(area_id);
	});
	
});