<div id="tramite">
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
	<div class="col-lg-2" style="padding-top:30px"><button class="btn btn-primary btn-nuevo-tramite"><i class="icon-plus"></i> Agregar Tr&aacute;mite</button></div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Busqueda, Ingresar Tr&aacute;mite</h5>
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
						 <div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<input type="text" class="form-control" id="txt-nro-tramite" data-mask="99-9999-9999 <?php echo $obj_area->getAttr('sigla');?>" required> <span class="input-group-btn">
									<input type="hidden" id="hidden-tipo-tramite" value="I" style="display:none;"> 
									<button type="button" class="btn btn-primary btn-consultar-trigger">Buscar</button> </span>
								</div>
								<span class="help-block"><strong>Ejemplo:</strong> 05-0001-2015 <?php echo $obj_area->getAttr('sigla');?></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="ibox float-e-margins">
				<div class="ibox-content" id="conteiner_all_rows">
					<div class="table-responsive">
						 <div class="form-group">
							<div class="col-sm-12" id="content-consult">
								<div id="result-consul-exter">
									<div class="alert alert-info alert-dismissable">
		                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
		                                Realice su busqueda, aca se motrara su resultado.
		                            </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>