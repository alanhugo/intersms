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
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-4">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Busqueda, Criterios de Busqueda</h5>
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
				
				<div class="ibox-content" id="conteiner_all_rows" style="min-height: 500px;">
					<form action="" method="post" name="BuscarMonitoreo" accept-charset="utf-8">
						<div class="form-group">
						 	<label class="font-noraml">Por:</label>
			                <select data-placeholder="Selecciona un filtro" class="chosen-select-filtro" name="data[Tramite][filtro][]" style="width:350px;" tabindex="4" multiple>
				                <option value="f">Fechas</option>
				                <option value="e">Estados</option>
				                <option value="a">Asunto</option>
				                <option value="d">Descripci&oacute;n</option>
				                <option value="t">Tipo tramite</option>
			                </select>
						</div>
						<div class="form-group hide" id="cmbfechainicio">
							<label class="font-noraml">Fecha Inicio:</label>
							<div class="input-group date">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="data[Tramite][fecha_inicio]" class="form-control" value="08-09-2014">
							</div>
						</div>
						<div class="form-group hide" id="cmbfechafin">
							<label class="font-noraml">Fecha Fin:</label>
							<div class="input-group date">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="data[Tramite][fecha_fin]" class="form-control" value="<?php echo date('d-m-Y');?>">
							</div>
						</div>
						<div class="form-group hide" id="cmbestado">
						 	<label class="font-noraml">Estados:</label>
			                <select data-placeholder="Selecciona un estado" name="data[Tramite][estado][]" class="chosen-select-estado" style="width:350px;" tabindex="4" multiple>
				                <option value="r">Recibido</option>
				                <option value="d">Derivado</option>
				                <option value="a">Aprobado</option>
				                <option value="u">Rechazado</option>
			                </select>
						</div>
						<div class="form-group hide" id="txtasunto">
							<label class="font-noraml">Asunto:</label>
							<input type="text" name="data[Tramite][asunto]" class="form-control">
						</div>
						<div class="form-group hide" id="txtdescripcion">
							<label class="font-noraml">Descripci&oacute;n:</label>
							<input type="text" name="data[Tramite][descripcion]" class="form-control">
						</div>
						<div class="form-group hide" id="combotipotramite">
							<label class="font-noraml">Tipo tramite</label>
							<select name="data[Tramite][tipo_tramite]" class="form-control">
								<option value="I">Interno</option>
								<option value="E">Externo</option>
							</select>
						</div>
						<div>
							<button class="btn btn-sm btn-primary pull-right m-t-n-xs trigger-buscar-monitoreo" type="button"><strong>Buscar</strong></button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<div class="col-lg-8">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Monitoreo</h5>
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
				
				<div class="ibox-content" id="conteiner_all_rows" style="min-height: 500px;">
					 <div class="form-group">
						<div class="table-responsive">
							<div id="result-consul-monitoreo">
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