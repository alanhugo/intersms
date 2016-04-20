<div id="tramite" class="tramite-index">
	 <div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Tr&aacute;mites</h2>
			<ol class="breadcrumb">
				<li><a href="index.html">Inicio</a>
				</li>
				<li class="active"><strong>Tr&aacute;mites</strong>
				</li>
			</ol>
		</div>
		<?php if ($obj_logged_user->Area->getAttr('permiso')==1){?>
			<div class="col-lg-2" style="padding-top:30px"><button class="btn btn-primary btn-nuevo-tramite"><i class="icon-plus"></i> Agregar Tr&aacute;mite</button></div>
		<?php }?>
	</div>
	
	<div class="wrapper wrapper-content animated fadeInRight">
		<div id="add_edit_tramite_container">
		</div>
		<p>
		<div class="row">
			<div class="col-lg-12">
				<!--  <div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Matenimiento de Tr&aacute;mites</h5>
						<div class="ibox-tools">
							<a class="collapse-link"> <i class="fa fa-chevron-up"></i>
							</a> <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i
								class="fa fa-wrench"></i>
							</a>
							<ul class="dropdown-menu dropdown-user">
								<li><a href="#">Config option 1</a>
								</li>
								<li><a href="#">Config option 2</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="ibox-content" id="conteiner_all_rows">
						<div class="table-responsive">
							<?php 
				      		//echo $this->element('Tramite/tramite_row',$arr_tramites);
							?>
						</div>
					</div>
				</div>-->
				
				<div class="tabs-container">
	                        <ul class="nav nav-tabs">
	                            <li class="active" id="tab-tramites-pendientes"><a data-toggle="tab" class="link-tab-pendientes" href="#tab-1" aria-expanded="true"> Pendientes</a></li>
	                            <li class="" id="tab-tramites_acept_rechaz"><a data-toggle="tab" href="#tab-2">Derivados / Aprobados / Devueltos</a></li>
	                            <li class="" id="tab-tramites_copias"><a data-toggle="tab" href="#tab-3">Copias / Archivados</a></li>
	                        </ul>
	                        <div class="tab-content">
	                            <div id="tab-1" class="tab-pane active">
	                                <div class="panel-body">
	                                    <div class="ibox-content" id="conteiner_all_rows">
											<div class="table-responsive">
												<?php 
									      			echo $this->element('Tramite/tramite_row',$arr_tramites);
												?>
											</div>
										</div>
										<div class="col-lg-6">
												<table class="table">
														<tr>
															<td style="vertical-align:middle">
																<button type="button" class="btn m-r-sm">&nbsp;&nbsp;</button>
																Normal
															</td>
															<td style="vertical-align:middle">
																<button type="button" class="btn m-r-sm" style="background-color:LemonChiffon">&nbsp;&nbsp;</button>
																Un d&iacute;a para cumplir el plazo
															</td>
															<td style="vertical-align:middle">
																<button type="button" class="btn m-r-sm" style="background-color:#FFE4E1">&nbsp;&nbsp;</button>
																Plazo cumplido
															</td>
														</tr>
												</table>
										</div>
	                                </div>
	                            </div>
	                            <div id="tab-2" class="tab-pane">
	                                <div class="panel-body">
	                                    <div class="ibox-content" id="conteiner_all_rows_acept_rechaz">
											<div class="table-responsive">
	
											</div>
											
										</div>
										<div class="col-lg-6">
												<table class="table">
														<tr>
															<td style="vertical-align:middle">
																<button type="button" class="btn m-r-sm">&nbsp;&nbsp;</button>
																Normal
															</td>
															<td style="vertical-align:middle">
																<button type="button" class="btn m-r-sm" style="background-color:LemonChiffon">&nbsp;&nbsp;</button>
																Un d&iacute;a para cumplir el plazo
															</td>
															<td style="vertical-align:middle">
																<button type="button" class="btn m-r-sm" style="background-color:#FFE4E1">&nbsp;&nbsp;</button>
																Plazo cumplido
															</td>
														</tr>
												</table>
										</div>
	                                </div>
	                            </div>
	                            <div id="tab-3" class="tab-pane">
	                                <div class="panel-body">
	                                    <div class="ibox-content" id="conteiner_all_rows_copias">
											<div class="table-responsive">
	
											</div>
										</div>
										<div class="col-lg-6">
												<table class="table">
														<tr>
															<td style="vertical-align:middle">
																<button type="button" class="btn m-r-sm">&nbsp;&nbsp;</button>
																Normal
															</td>
															<td style="vertical-align:middle">
																<button type="button" class="btn m-r-sm" style="background-color:LemonChiffon">&nbsp;&nbsp;</button>
																Un d&iacute;a para cumplir el plazo
															</td>
															<td style="vertical-align:middle">
																<button type="button" class="btn m-r-sm" style="background-color:#FFE4E1">&nbsp;&nbsp;</button>
																Plazo cumplido
															</td>
														</tr>
												</table>
										</div>
	                                </div>
	                            </div>
	                        </div>
	            </div>
	             
			</div>
		</div>
	</div>
	
	<div class="modal inmodal" id="myModalDeleteTramite" tabindex="-1"
		role="dialog" aria-hidden="true" tramite_id=''>
		<div class="modal-dialog">
			<div class="modal-content animated fadeIn">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
					</button>
					<i class="fa fa-trash-o modal-icon"></i>
					<h3 class="modal-title">
						&iquest;Estas seguro de querer Eliminar el Numero de Documento <span id="num-doc"></span>?
					</h3>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">
						Cancelar
					</button>
					<button type="button"
						class="btn btn-primary eliminar-tramite-trigger"
						data-dismiss="modal">
						Aceptar
					</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal inmodal" id="myModalDerivarTramite" tabindex="-1"
		role="dialog" aria-hidden="true" tramite_id='' area_derivar_id=''>
		<div class="modal-dialog">
			<div class="modal-content animated fadeIn">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
					</button>
					<i class="fa fa-send modal-icon"></i>
					<h3 class="modal-title">
						&iquest;Estas seguro de querer derivar el Documento <span id="num-doc"></span>?
					</h3>
					<br>
					<div align="left"><strong>Si tiene alguna observaci&oacute;n puede escribirla aqu&iacute;:</strong></div>
					<textarea name="data[SeguimientoTramite][observacion]" id="TramiteObservacion" class="form-control"><?php //echo (isset($obj_tramite))?$obj_tramite->getAttr('descripcion'):''?></textarea>
				</div>
				<div class="modal-body">				
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">
						Cancelar
					</button>
					<button type="button"
						class="btn btn-primary derivar-tramite-trigger"
						data-dismiss="modal">
						Aceptar
					</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal inmodal" id="myModalRecibirTramite" tabindex="-1"
		role="dialog" aria-hidden="true" tramite_id=''>
		<div class="modal-dialog">
			<div class="modal-content animated fadeIn">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
					</button>
					<i class="fa fa-download modal-icon"></i>
					<h3 class="modal-title">
						&iquest;Estas seguro de querer recibir el Documento?
					</h3>
					<br>
					<div class="modal-body" align="left">
						<div class="container-observacion"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">
						Cancelar
					</button>
					<button type="button"
						class="btn btn-primary recibir-tramite-trigger"
						data-dismiss="modal">
						Aceptar
					</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal inmodal" id="myModalRecibirCopia" tabindex="-1"
		role="dialog" aria-hidden="true" tramite_id=''>
		<div class="modal-dialog">
			<div class="modal-content animated fadeIn">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
					</button>
					<i class="fa fa-download modal-icon"></i>
					<h3 class="modal-title">
						&iquest;Estas seguro de querer recibir la copia del Documento?
					</h3>
					<br>
					<div class="modal-body" align="left">
						<div class="container-observacion"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">
						Cancelar
					</button>
					<button type="button"
						class="btn btn-primary recibir-copia-trigger"
						data-dismiss="modal">
						Aceptar
					</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal inmodal" id="myModalAprobarTramite" tabindex="-1"
		role="dialog" aria-hidden="true" tramite_id=''>
		<div class="modal-dialog">
			<div class="modal-content animated fadeIn">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
					</button>
					<i class="fa fa-check modal-icon"></i>
					<h3 class="modal-title">
						&iquest;Estas seguro de querer Aprobar el Documento <span id="num-doc"></span>?
					</h3>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">
						Cancelar
					</button>
					<button type="button"
						class="btn btn-primary aprobar-tramite-trigger"
						data-dismiss="modal">
						Aceptar
					</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal inmodal" id="myModalRechazarTramite" tabindex="-1"
		role="dialog" aria-hidden="true" tramite_id=''>
		<div class="modal-dialog">
			<div class="modal-content animated fadeIn">
				<div class="modal-header">
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">
						Cancelar
					</button>
					<button type="button"
						class="btn btn-primary rechazar-tramite-trigger"
						data-dismiss="modal">
						Aceptar
					</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal inmodal" id="myModalRecibirRechazado" tabindex="-1"
		role="dialog" aria-hidden="true" tramite_id=''>
		<div class="modal-dialog">
			<div class="modal-content animated fadeIn">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
					</button>
					<i class="fa fa-check modal-icon"></i>
					<h3 class="modal-title">
						&iquest;Estas seguro de Recibir el Documento Devuelto?
					</h3>
					<br>
					<div class="modal-body" align="left">
						<div class="container-observacion-devuelto"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">
						Cancelar
					</button>
					<button type="button"
						class="btn btn-primary recibir-rechazar-tramite-trigger"
						data-dismiss="modal">
						Aceptar
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php echo $this->Element('Persona/modal_add_remitente'); ?>