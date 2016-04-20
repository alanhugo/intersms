<div id="usuario">
 <div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Usuarios</h2>
		<ol class="breadcrumb">
			<li><a href="index.html">Inicio</a>
			</li>
			<li class="active"><strong>Usuarios</strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-2" style="padding-top:30px"><button class="btn btn-primary btn-nuevo-usuario"><i class="icon-plus"></i> Agregar Usuario</button></div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div id="add_edit_usuario_container">
	</div>
	<p>
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Matenimiento de Usuarios</h5>
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
			      		echo $this->element('Usuario/usuario_row',$arr_usuarios);
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal inmodal" id="myModalDeleteUsuario" tabindex="-1"
	role="dialog" aria-hidden="true" usuario_id=''>
	<div class="modal-dialog">
		<div class="modal-content animated fadeIn">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true"><i class="fa fa-times"></i></button>
				<i class="fa fa-trash-o modal-icon"></i>
				<h3 class="modal-title">
					&iquest;Estas seguro de querer Eliminar Usuario <span id="username"></span>?
				</h3>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">
					Cancelar
				</button>
				<button type="button"
					class="btn btn-primary eliminar-usuario-trigger"
					data-dismiss="modal">
					Aceptar
				</button>
			</div>
		</div>
	</div>
</div>
<div class="modal inmodal" id="myModalChangePass" tabindex="-1" 
	role="dialog" usuario_id= ''>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true"><i class="fa fa-times"></i></button>
				<h3 class="modal-title">Cambiar contraseña</h3>
			</div>
			<?php echo $this->Form->create('UserChangePass',array('method'=>'post', 'id'=>'form_change_pass','action'=> false));?>
			<div class="modal-body">
				<div id="nombreUsuarioChange"></div>
				<div class="row">
					<div class="span3 col-md-4 col-sm-6 col-xs-6">
						<label>Nueva Contraseña</label>
					</div>
					<div class="span3 col-md-5 col-sm-6 col-xs-6">
						<?php echo $this->Form->input('password', array('type' =>'password', 'div' => false, 'label' => false, 'class'=>'form-control','id'=>'password')); ?>
					</div>
				</div>
			</div>
			<?php echo $this->Form->end(); ?>
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">
					Cancelar
				</button>
				<button type="button"
					class="btn btn-primary cambiar-password-usuario-trigger"
					data-dismiss="modal">
					Aceptar
				</button>
			</div>
			
		</div>
	</div>
</div>
</div>