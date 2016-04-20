$(document).ready(function(){
	
	Tramite = this;
	$body = $('body');
	
	tramite = {
		openAddEditTramite: function(tramite_id){
			if(tramite_id == undefined || !tramite_id) {
				tramite_id ='';
			}
			
			$('div#tramite #add_edit_tramite_container').unbind();
			$('div#tramite #add_edit_tramite_container').load(env_webroot_script + 'tramites/add_edit_tramite/'+tramite_id,function(){
				$(".cbo-remitente-select2").chosen();
				tramite.checkEmail();
				tramite.checkExterno();
				tramite.checkArchivo();
				tramite.checkArchivar();
			});
		},
		
		deleteTramite: function(tramite_id){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'tramites/delete_tramite',
				data:{
					'tramite_id': tramite_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					$('[data-toggle="tooltip"]').tooltip();
					$('.tramite_row_container[tramite_id='+tramite_id+']').fadeOut(function(){$(this).remove()});
					toastr.success(data.msg);
				}else{
					toastr.error(value[0]);
				}
			});
		},
		
		derivarTramite: function(tramite_id,area_derivar_id,area_id,arr_areas_copy_id,observacion){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'tramites/derivar_tramite',
				data:{
					'tramite_id': tramite_id,
					'area_derivar_id': area_derivar_id,
					'area_id': area_id,
					'area_copia_id':arr_areas_copy_id,
					'observacion': observacion
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					toastr.success(data.msg);
					$('#conteiner_all_rows').load(env_webroot_script + 'tramites/ajax_listar',function(){
						$('#dtable_tramites').DataTable();
					});
				}else{
					toastr.error(data.msg);
				}
			});
		},
		
		recibirTramite: function(tramite_id){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'tramites/recibir_tramite',
				data:{
					'tramite_id': tramite_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					toastr.success(data.msg);
					$('#conteiner_all_rows').load(env_webroot_script + 'tramites/ajax_listar',function(){
						$('#dtable_tramites').DataTable();
					});
				}else{
					toastr.error(value[0]);
				}
			});
		},
		
		recibirCopia: function(tramite_id){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'tramites/recibir_copia',
				data:{
					'tramite_id': tramite_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					toastr.success(data.msg);
					$('#conteiner_all_rows').load(env_webroot_script + 'tramites/ajax_listar',function(){
						$('#dtable_tramites').DataTable();
					});
				}else{
					toastr.error(value[0]);
				}
			});
		},
		
		recibirRechazar: function(tramite_id){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'tramites/recibir_rechazado',
				data:{
					'tramite_id': tramite_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					toastr.success(data.msg);
					$('#conteiner_all_rows').load(env_webroot_script + 'tramites/ajax_listar',function(){
						$('#dtable_tramites').DataTable();
					});
				}else{
					toastr.error(value[0]);
				}
			});
		},
		
		aprobarTramite: function(tramite_id){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'tramites/aprobar_tramite',
				data:{
					'tramite_id': tramite_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					toastr.success(data.msg);
					$('#conteiner_all_rows').load(env_webroot_script + 'tramites/ajax_listar',function(){
						$('#dtable_tramites').DataTable();
					});
				}else{
					toastr.error(value[0]);
				}
			});
		},
		
		rechazarTramite: function(tramite_id, area_id, observacion){
			$.ajax({
				type: 'post',
				url: env_webroot_script + 'tramites/rechazar_tramite',
				data:{
					'tramite_id': tramite_id,
					'observacion': observacion,
					'area_id': area_id
				},
				dataType: 'json'
			}).done(function(data){
				if(data.success == true){
					toastr.success(data.msg);
					$('#conteiner_all_rows').load(env_webroot_script + 'tramites/ajax_listar',function(){
						$('#dtable_tramites').DataTable();
					});
				}else{
					toastr.error(value[0]);
				}
			});
		},
		
		checkRechazar: function(){
			$('#myModalRechazarTramite .marcarAreaRechazar').iCheck({
				checkboxClass: 'icheckbox_square-blue',
			});
			$('#myModalRechazarTramite .marcarAreaRechazar').on('ifChecked', function(event){
				$('#myModalRechazarTramite #modalTramiteRechazarAreaId').removeClass('hide');
			});
			$('#myModalRechazarTramite .marcarAreaRechazar').on('ifUnchecked', function(event){
				$('#myModalRechazarTramite #modalTramiteRechazarAreaId').addClass('hide');
			});
		},

		checkCopia: function(){
			$('#myModalDerivarTramite .marcarCopia').iCheck({
				checkboxClass: 'icheckbox_square-blue',
			});
			$('#myModalDerivarTramite .marcarCopia').on('ifChecked', function(event){
				$('#myModalDerivarTramite #modalTramiteCopiaAreaId').removeClass('hide');
				$('#myModalDerivarTramite .btn-more-area-copy').removeClass('hide');
			});
			$('#myModalDerivarTramite .marcarCopia').on('ifUnchecked', function(event){
				$('#myModalDerivarTramite #modalTramiteCopiaAreaId').addClass('hide');
				$('#myModalDerivarTramite .btn-more-area-copy').addClass('hide');
			});
		},
		
		checkEmail: function(){
			$('.marcarEmail').iCheck({
				checkboxClass: 'icheckbox_square-blue',
			});
			
			$('.marcarEmail').on('ifChecked', function(event){
				//$('#myModalDerivarTramite #modalTramiteCopiaAreaId').removeClass('hide');
				$('#TramiteEmail').removeClass('hide');
			});
			$('.marcarEmail').on('ifUnchecked', function(event){
				//$('#myModalDerivarTramite #modalTramiteCopiaAreaId').addClass('hide');
				$('#TramiteEmail').addClass('hide');
			});
			
			if($('#TramiteEmail').val() != ''){
				$('.icheckbox_square-blue').addClass('checked');
			}
		},
		
		checkArchivo: function(){
			$('.marcarArchivos').iCheck({
				checkboxClass: 'icheckbox_square-blue',
			});
			
			$('.marcarArchivos').on('ifChecked', function(event){
				//$('#myModalDerivarTramite #modalTramiteCopiaAreaId').removeClass('hide');
				$('#my-awesome-dropzone').removeClass('hide');
			});
			$('.marcarArchivos').on('ifUnchecked', function(event){
				//$('#myModalDerivarTramite #modalTramiteCopiaAreaId').addClass('hide');
				$('#my-awesome-dropzone').addClass('hide');
			});
			
			/*if($('#marcarArchivos').val() != ''){
				$('.icheckbox_square-blue').addClass('checked');
			}*/
		},
		
		checkExterno: function(){
			$('.marcarExterno').iCheck({
				checkboxClass: 'icheckbox_square-blue',
			});
			
			$('.marcarExterno').on('ifChecked', function(event){
				$(".cbo-remitente-select2").chosen();
				$('#div-remitente').removeClass('hide');
				$('.marcarExterno').attr('checked','checked');
				$('.marcarExterno').val('E');
			});
			$('.marcarExterno').on('ifUnchecked', function(event){
				$('#div-remitente').addClass('hide');
				$('.marcarExterno').removeAttr('checked');
				$('.marcarExterno').val('I');
			});
			
			if($('.marcarExterno').val() == 'I'){
				$('.div-check-externo .icheckbox_square-blue').removeClass('checked');
				$('#div-remitente').addClass('hide');
				$('.marcarExterno').removeAttr('checked');
			}else{
				$('.div-check-externo .icheckbox_square-blue').addClass('checked');
				$('#div-remitente').removeClass('hide');
				$('.marcarExterno').attr('checked','checked');
			}
			
			/*if($('.cbo-remitente-select2').val() == '' || $('.cbo-remitente-select2').val() == 0 || $('.cbo-remitente-select2').val() == null){
				$('.div-check-externo .icheckbox_square-blue').removeClass('checked');
				$('#div-remitente').addClass('hide');
			}else{
				$('.div-check-externo .icheckbox_square-blue').addClass('checked');
				$('#div-remitente').removeClass('hide');
			}*/
			
			
		},

		checkArchivar: function(){
			$('.marcarArchivar').iCheck({
				checkboxClass: 'icheckbox_square-blue',
			});
			
			$('.marcarArchivar').on('ifChecked', function(event){
				//$(".cbo-remitente-select2").chosen();
				//$('#div-remitente').removeClass('hide');
				
				$('.marcarArchivar').attr('checked','checked');
				$('.marcarArchivar').val(1); // 1 será archivado

				$('.div-estimacion').fadeOut().addClass('hide');
				$('.lbl-estimacion').fadeOut().addClass('hide');
				$('.lbl-area-destino').fadeOut().addClass('hide');
				$('.cbx-area-destino').fadeOut().addClass('hide');
			});
			$('.marcarArchivar').on('ifUnchecked', function(event){
				
				$('.marcarArchivar').val(0); // 0 no será archivado
				$('.marcarArchivar').removeAttr('checked');
				$('.div-estimacion').fadeIn().removeClass('hide');
				$('.lbl-estimacion').fadeIn().removeClass('hide');
				$('.lbl-area-destino').fadeIn().removeClass('hide');
				$('.cbx-area-destino').fadeIn().removeClass('hide');
				/*$('.div-estimacion').removeClass('hide');
				$('.lbl-estimacion').removeClass('hide');
				$('.lbl-area-destino').removeClass('hide');
				$('.cbx-area-destino').removeClass('hide');*/
			});
			
			if($('.marcarArchivar').val() == 0){
				$('.div-check-archivar .icheckbox_square-blue').removeClass('checked');
				//$('#div-remitente').addClass('hide');
				$('.marcarArchivar').removeAttr('checked');
				$('.div-estimacion').removeClass('hide');
				$('.lbl-estimacion').removeClass('hide');
				$('.lbl-area-destino').removeClass('hide');
				$('.cbx-area-destino').removeClass('hide');

			}else{
				$('.div-check-archivar .icheckbox_square-blue').addClass('checked');
				$('.div-estimacion').addClass('hide');
				$('.lbl-estimacion').addClass('hide');
				$('.lbl-area-destino').addClass('hide');
				$('.cbx-area-destino').addClass('hide');
				$('.marcarArchivar').attr('checked','checked');
			}
		},
		
		consultaTramite: function(nro_tramite){
			var vnum_tramite = nro_tramite;
			$.ajax({
				url: env_webroot_script + 'tramites/ajax_consultar_validar',
				data:{
					'nro_tramite': vnum_tramite,
				},
				dataType: 'json',
				type: 'post'
			}).done(function(data){
				if(data.success==true){
					$('#form-consul-exter').fadeOut();
					$('div#content-consult #result-consul-exter').load(env_webroot_script + 'tramites/ajax_consultar/'+data.nro_documento);
					toastr.success(data.msg);
				}else{
					$('div#content-consult #result-consul-exter').html('<div class="alert alert-danger alert-dismissable" style="margin-top: 17px"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>No se encontro resultados.</div>');
					toastr.error(data.msg);
				}
			});
		},
		
		listarTramitesPendientes: function(){
			$('div#tramite #conteiner_all_rows').unbind();
			$('div#tramite #conteiner_all_rows').load(env_webroot_script + 'tramites/ajax_listar',function(){
				$('#conteiner_all_rows #dtable_tramites').DataTable();
				$("span.pie").peity("pie", {
					fill: ['#1ab394', '#d7d7d7', '#ffffff']
				})
			});
		},
		
		listarTramitesAceptadosRechazados: function(){
			$('div#tramite #conteiner_all_rows_acept_rechaz').unbind();
			$('div#tramite #conteiner_all_rows_acept_rechaz').load(env_webroot_script + 'tramites/ajax_listar_aceptados_rechazados',function(){
				$('#conteiner_all_rows_acept_rechaz #dtable_tramites').DataTable();
				$("span.pie").peity("pie", {
					fill: ['#1ab394', '#d7d7d7', '#ffffff']
				})
			});
		},
		
		listarCopiasTramites: function(){
			$('div#tramite #conteiner_all_rows_copias').unbind();
			$('div#tramite #conteiner_all_rows_copias').load(env_webroot_script + 'tramites/ajax_listar_copias',function(){
				$('#conteiner_all_rows_copias #dtable_tramites').DataTable();
				$("span.pie").peity("pie", {
					fill: ['#1ab394', '#d7d7d7', '#ffffff']
				})
			});
		}
	}
	
	/* Listar Tabs */
	var time_pendientes = 0;
	
	//Listar pendientes 
	$body.off('click','div#tramite #tab-tramites-pendientes');
	$body.on('click', 'div#tramite #tab-tramites-pendientes' , function(){
		tramite.listarTramitesPendientes();
		time_pendientes = 0;
	});
	
	//Listar aceptados y rechazados 
	$body.off('click','div#tramite #tab-tramites_acept_rechaz');
	$body.on('click', 'div#tramite #tab-tramites_acept_rechaz' , function(){
		tramite.listarTramitesAceptadosRechazados();
		time_pendientes = 1;
	});
	
	//Listar copias
	$body.off('click','div#tramite #tab-tramites_copias');
	$body.on('click', 'div#tramite #tab-tramites_copias' , function(){
		tramite.listarCopiasTramites();
		time_pendientes = 1;
	});
	
	/* Ejecutar ajax de listado de pendientes cada 5 min*/
	if($('.tramite-index').length != 0){
		var call_pendientes = setInterval(function(){
			if(time_pendientes == 0){
				tramite.listarTramitesPendientes();
			}
	    }, 300000);
	}else{
		clearInterval(call_pendientes);
	}
	
	
	/* Mostrar formulario: Crear Tramite */
	$body.off('click','div#tramite .btn-nuevo-tramite');
	$body.on('click', 'div#tramite .btn-nuevo-tramite' , function(){
		tramite_id = $(this).attr('tramite_id');
		tramite.openAddEditTramite(tramite_id);
	});
	
	/* Ocultar formulario Crear Tramite*/
	$body.on('click','div#div-crear-tramite .btn-cancelar-crear-tramite', function(){
		$('#div-crear-tramite').fadeOut();
	});
	
	$body.off('click','.btn-crear-tramite-trigger');
	$body.on('click','.btn-crear-tramite-trigger',function(){
		$form = $(this).parents('form').eq(0);
		var tipo_tramite = $('#chbx-externo').val();
		var archivado = $('#chbx-archivar').val();
		$.ajax({
			url: $form.attr('action'),
			data: $form.serialize() + '&tipo_tramite=' + tipo_tramite + '&archivado=' + archivado,
			dataType: 'json',
			type: 'post'
		}).done(function(data){
			if(data.success==true){
				$('#div-crear-tramite').fadeOut();
				$('#conteiner_all_rows').load(env_webroot_script + 'tramites/ajax_listar',function(){
					$('#dtable_tramites').DataTable();
					$("span.pie").peity("pie", {
						fill: ['#1ab394', '#d7d7d7', '#ffffff']
					})
				});
				toastr.success(data.msg);
				tramite.listarCopiasTramites();
			}else{
				$.each(data.validation, function( key, value ) {
					toastr.error(value[0]);
					$('[name="data[Tramite]['+key+']"]').parent().addClass('control-group has-error');
					$('[name="data[Tramite]['+key+']"]').change(function() {
						$('[name="data[Tramite]['+key+']"]').parent().removeClass('control-group has-error');
					});
				});
			}
		});
	});

	/* Editar el Tramite*/
	$body.off('click','div#tramite .edit-tramite-trigger');
	$body.on('click','div#tramite .edit-tramite-trigger', function(){
		tramite_id = $(this).parents('.tramite_row_container').attr('tramite_id');
		tramite.openAddEditTramite(tramite_id);
	});
	
	/* Eliminar el Tramite*/
	$body.off('click','div#tramite .open-model-delete-tramite');
	$body.on('click','div#tramite .open-model-delete-tramite', function(){
		tramite_id = $(this).parents('.tramite_row_container').attr('tramite_id');
		num_doc = $(this).parents('.tramite_row_container').attr('num_doc');
		$('div#myModalDeleteTramite').attr('tramite_id', tramite_id);
		$('div#myModalDeleteTramite .modal-title #num-doc').text(num_doc);
	});
	
	$body.off('click','div#myModalDeleteTramite .eliminar-tramite-trigger');
	$body.on('click','div#myModalDeleteTramite .eliminar-tramite-trigger', function(){
		tramite_id = $('div#myModalDeleteTramite').attr('tramite_id');
		tramite.deleteTramite(tramite_id);
	});
	
	/* Derivar el Tramite*/
	$body.off('click','div#tramite .open-model-derivar-tramite');
	$body.on('click','div#tramite .open-model-derivar-tramite', function(){
		tramite_id = $(this).parents('.tramite_row_container').attr('tramite_id');
		area_derivar_id = $(this).attr('area_derivar_id');
		num_doc = $(this).parents('.tramite_row_container').attr('num_doc');
		$('div#myModalDerivarTramite #TramiteObservacion').val("");
		if ($(this).parents('.tramite_row_container').hasClass("masUnaRecibido")) {
			masUnaRecibidoRechazado = 1;
			
			if ($(this).parents('.tramite_row_container').hasClass("masUnaRechazado")) {
				masUnaRecibidoRechazado = 0;
			}else{
				masUnaRecibidoRechazado = 1;
			}
			
		}else{
			masUnaRecibidoRechazado = 0;
		}
		
		$('div#myModalDerivarTramite .modal-body').load(env_webroot_script + 'tramites/ajax_modal_area/'+tramite_id+'/'+masUnaRecibidoRechazado, function(){
			tramite.checkCopia();
			$('div#myModalDerivarTramite').attr('tramite_id', tramite_id);
			$('div#myModalDerivarTramite').attr('area_derivar_id', area_derivar_id);
			$('div#myModalDerivarTramite .modal-title #num-doc').text(num_doc);
		});
	});
	
	$body.off('click','div#myModalDerivarTramite .derivar-tramite-trigger');
	$body.on('click','div#myModalDerivarTramite .derivar-tramite-trigger', function(){
		tramite_id = $('div#myModalDerivarTramite').attr('tramite_id');
		area_derivar_id = $('div#myModalDerivarTramite').attr('area_derivar_id');
		observacion = $('div#myModalDerivarTramite #TramiteObservacion').val();
		
		if ($('div#myModalDerivarTramite .modal-body').hasClass("hide")) {
			area_id = 0;
		}else{
			area_id = $("#modalTramiteAreaId").val();
			//area_copia_id = $("#modalTramiteCopiaAreaId").val();
		}
		
		tramite.derivarTramite(tramite_id,area_derivar_id,area_id,arr_areas_copy_id,observacion);
	});

	//Agregando Combos de áreas para enviar copias.
	$body.off('click','.btn-more-area-copy');
	$body.on('click','.btn-more-area-copy', function(){
		$.ajax({
	        type: "POST",
	        url: env_webroot_script + "tramites/add_combo_area_copy",
	        cache: false,
	        success: function(html)
	         {
		       	 $('.container-select:last').after(html);
	         }
		 });
	});

	var arr_areas_copy_id = [];
	$body.off('change','#modalTramiteCopiaAreaId');
	$body.on('change','#modalTramiteCopiaAreaId', function(){
		arr_areas_copy_id = [];
		$('.modalTramiteCopiaAreaId').each(function(index, value) {
            	arr_areas_copy_id.push(value.value);
        });
	});

	
	/* Recibir el Tramite*/
	$body.off('click','div#tramite .open-model-recibir-tramite');
	$body.on('click','div#tramite .open-model-recibir-tramite', function(){
		tramite_id = $(this).parents('.tramite_row_container').attr('tramite_id');
		area_id = $(this).parents('.tramite_row_container').attr('area_id');
		num_doc = $(this).parents('.tramite_row_container').attr('num_doc');
		$('div#myModalRecibirTramite').attr('tramite_id', tramite_id);
		$('div#myModalRecibirTramite .modal-title #num-doc').text(num_doc);
		
		$('div#myModalRecibirTramite .container-observacion').load(env_webroot_script + 'tramites/ajax_modal_observacion/'+tramite_id+'/'+area_id);
	});
	
	$body.off('click','div#myModalRecibirTramite .recibir-tramite-trigger');
	$body.on('click','div#myModalRecibirTramite .recibir-tramite-trigger', function(){
		tramite_id = $('div#myModalRecibirTramite').attr('tramite_id');
		tramite.recibirTramite(tramite_id);
	});
	
	/* Recibir Copia */
	$body.off('click','div#tramite .open-model-recibir-copia');
	$body.on('click','div#tramite .open-model-recibir-copia', function(){
		tramite_id = $(this).parents('.tramite_row_container').attr('tramite_id');
		area_id = $(this).parents('.tramite_row_container').attr('area_id');
		num_doc = $(this).parents('.tramite_row_container').attr('num_doc');
		$('div#myModalRecibirCopia').attr('tramite_id', tramite_id);
		$('div#myModalRecibirCopia .modal-title #num-doc').text(num_doc);
		
	});
	
	$body.off('click','div#myModalRecibirCopia .recibir-copia-trigger');
	$body.on('click','div#myModalRecibirCopia .recibir-copia-trigger', function(){
		tramite_id = $('div#myModalRecibirCopia').attr('tramite_id');
		tramite.recibirCopia(tramite_id);
	});
	
	/* Recibir Rechazado */
	$body.off('click','div#tramite .open-model-recibir-rechazado');
	$body.on('click','div#tramite .open-model-recibir-rechazado', function(){
		tramite_id = $(this).parents('.tramite_row_container').attr('tramite_id');
		area_id = $(this).parents('.tramite_row_container').attr('area_id');
		num_doc = $(this).parents('.tramite_row_container').attr('num_doc');
		$('div#myModalRecibirRechazado').attr('tramite_id', tramite_id);
		$('div#myModalRecibirRechazado .modal-title #num-doc').text(num_doc);
		
		$('div#myModalRecibirRechazado .container-observacion-devuelto').load(env_webroot_script + 'tramites/ajax_modal_observacion_devuelto/'+tramite_id+'/'+area_id);
	});
	
	$body.off('click','div#myModalRecibirRechazado .recibir-rechazar-tramite-trigger');
	$body.on('click','div#myModalRecibirRechazado .recibir-rechazar-tramite-trigger', function(){
		tramite_id = $('div#myModalRecibirRechazado').attr('tramite_id');
		tramite.recibirRechazar(tramite_id);
	});
	
	/* Aprobar el Tramite */
	$body.off('click','div#tramite .open-model-aprobar-tramite');
	$body.on('click','div#tramite .open-model-aprobar-tramite', function(){
		tramite_id = $(this).parents('.tramite_row_container').attr('tramite_id');
		num_doc = $(this).parents('.tramite_row_container').attr('num_doc');
		$('div#myModalAprobarTramite').attr('tramite_id', tramite_id);
		$('div#myModalAprobarTramite .modal-title #num-doc').text(num_doc);
	});
	
	$body.off('click','div#myModalAprobarTramite .aprobar-tramite-trigger');
	$body.on('click','div#myModalAprobarTramite .aprobar-tramite-trigger', function(){
		tramite_id = $('div#myModalAprobarTramite').attr('tramite_id');
		tramite.aprobarTramite(tramite_id);
	});
	
	/* Rechazar el Tramite */
	$body.off('click','div#tramite .open-model-rechazar-tramite');
	$body.on('click','div#tramite .open-model-rechazar-tramite', function(){
		tramite_id = $(this).parents('.tramite_row_container').attr('tramite_id');
		num_doc = $(this).parents('.tramite_row_container').attr('num_doc');
		
		$('div#myModalRechazarTramite .modal-header').load(env_webroot_script + 'tramites/ajax_modal_area_rechazado/'+tramite_id, function(){
			tramite.checkRechazar();
			$('div#myModalRechazarTramite').attr('tramite_id', tramite_id);
			$('div#myModalRechazarTramite .modal-title #num-doc').text(num_doc);
		});
	});
	
	$body.off('click','div#myModalRechazarTramite .rechazar-tramite-trigger');
	$body.on('click','div#myModalRechazarTramite .rechazar-tramite-trigger', function(){
		tramite_id = $('div#myModalRechazarTramite').attr('tramite_id');
		area_id = $('div#myModalRechazarTramite #modalTramiteRechazarAreaId').val();
		observacion = $('div#myModalRechazarTramite #TramiteObservacionRechazado').val();
		tramite.rechazarTramite(tramite_id, area_id, observacion);
	});
	
	/* Buscar tramite */
	$body.off('click','.btn-consultar-trigger');
	$body.on('click','.btn-consultar-trigger',function(){
		nro_tramite = $('#txt-nro-tramite').val();
		tramite.consultaTramite(nro_tramite);
	});
	
	$(".chosen-select-filtro").chosen({width:"100%"});
	$(".chosen-select-estado").chosen({width:"100%"});
	$body.on('change','.chosen-select-filtro', function(){
		//alert($(this).val());
		filtro = $(this).val();
		console.log("change "+filtro);
        
		if(filtro!=null && filtro.indexOf("a")>-1){
			$('#txtasunto').removeClass('hide');
        }else{
        	$('#txtasunto').addClass('hide');
        }
		
		if(filtro!=null && filtro.indexOf("d")>-1){
			$('#txtdescripcion').removeClass('hide');
        }else{
        	$('#txtdescripcion').addClass('hide');
        }
        
        if(filtro!=null && filtro.indexOf("e")>-1){
        	$('#cmbestado').removeClass('hide');
        }else{
        	$('#cmbestado').addClass('hide');
        }
        
        if(filtro!=null && filtro.indexOf("f")>-1){
        	$('#cmbfechainicio').removeClass('hide');
        	$('#cmbfechafin').removeClass('hide');
        }else{
        	$('#cmbfechainicio').addClass('hide');
        	$('#cmbfechafin').addClass('hide');
        }
        
        if(filtro!=null && filtro.indexOf("t")>-1){
        	$('#combotipotramite').removeClass('hide');
        }else{
        	$('#combotipotramite').addClass('hide');
        }
	});
	
	$('#cmbfechainicio .input-group.date, #cmbfechafin .input-group.date').datepicker({
        startView: 1,
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd-mm-yyyy"
    });
	
	/* Buscar Monitoreo */
	$body.off('click','.trigger-buscar-monitoreo');
	$body.on('click','.trigger-buscar-monitoreo',function(){
		$form = $(this).parents('form').eq(0);
		$.ajax({
			url: env_webroot_script + 'tramites/ajax_search_monitoreo',
			data: $form.serialize(),
			type: 'post',
			dataType: 'html'
		}).done(function(data){
			$('#result-consul-monitoreo').html(data);
			$("span.pie").peity("pie", {
				fill: ['#1ab394', '#d7d7d7', '#ffffff']
			})
		});
	});
	
	$('#conteiner_all_rows #dtable_tramites').DataTable();
});