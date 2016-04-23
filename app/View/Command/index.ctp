<div id="command">
 <div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Comandos</h2>
		<ol class="breadcrumb">
			<li><a href="index.html">Inicio</a>
			</li>
			<li class="active"><strong>Grupos Comandos</strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-2" style="padding-top:30px"><button class="btn btn-primary btn-nuevo-command"><i class="icon-plus"></i> Agregar Grupo Comando</button></div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div id="add_edit_command_container">
	</div>
	<p>
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Matenimiento de Comandos</h5>
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
			      		echo $this->element('Command/command_row',$arr_commands);
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal inmodal" id="myModalDeleteCommand" tabindex="-1"
	role="dialog" aria-hidden="true" command_id=''>
	<div class="modal-dialog">
		<div class="modal-content animated fadeIn">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true"><i class="fa fa-times"></i></button>
				<i class="fa fa-trash-o modal-icon"></i>
				<h3 class="modal-title">
					&iquest;Estas seguro de querer Eliminar el Comando <span id="command"></span>?
				</h3>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">
					Cancelar
				</button>
				<button type="button"
					class="btn btn-primary eliminar-command-trigger"
					data-dismiss="modal">
					Aceptar
				</button>
			</div>
		</div>
	</div>
</div>
</div>