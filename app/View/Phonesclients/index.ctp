<div id="phonesclient">
 <div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Numero de Clientes</h2>
		<ol class="breadcrumb">
			<li><a href="index.html">Inicio</a>
			</li>
			<li class="active"><strong>Numeros de Clientes</strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-2" style="padding-top:30px"><button class="btn btn-primary btn-nuevo-phonesclient"><i class="icon-plus"></i> Agregar Num. de Clientes</button></div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div id="add_edit_phonesclient_container">
	</div>
	<p>
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Matenimiento de Numero de Clientes</h5>
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
			      		echo $this->element('Phonesclient/phonesclient_row',$arr_phonesclients);
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal inmodal" id="myModalDeletePhonesclient" tabindex="-1"
	role="dialog" aria-hidden="true" phonesclient_id=''>
	<div class="modal-dialog">
		<div class="modal-content animated fadeIn">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true"><i class="fa fa-times"></i></button>
				<i class="fa fa-trash-o modal-icon"></i>
				<h3 class="modal-title">
					&iquest;Estas seguro de querer Eliminar el Grupo <span id="phonesclient"></span>?
				</h3>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">
					Cancelar
				</button>
				<button type="button"
					class="btn btn-primary eliminar-phonesclient-trigger"
					data-dismiss="modal">
					Aceptar
				</button>
			</div>
		</div>
	</div>
</div>
</div>