<div id="area">
 <div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Areas</h2>
		<ol class="breadcrumb">
			<li><a href="index.html">Inicio</a>
			</li>
			<li class="active"><strong>Areas</strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-2" style="padding-top:30px"><button class="btn btn-primary btn-nuevo-area"><i class="icon-plus"></i> <?php echo utf8_encode(__('Agregar Área')); ?></button></div>
 </div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div id="add_edit_area_container">
	</div>
	<p>
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Matenimiento de Areas</h5>
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
					<?php 
						if(isset($list_areas)){
			      			echo $this->element('Area/area_row');
						}
					?>
				</div>
			</div>
		</div>
	</div>
 </div>

	<div class="modal inmodal" id="myModalDeleteArea" tabindex="-1"
		role="dialog" aria-hidden="true" area_id=''>
		<div class="modal-dialog">
			<div class="modal-content animated fadeIn">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
					</button>
					<i class="fa fa-clock-o modal-icon"></i>
					<h4 class="modal-title">
						<?php echo utf8_encode(__('Confirmar Eliminación')); ?>
					</h4>
				</div>
				<div class="modal-body">
					<p>
						<strong><?php echo utf8_encode(__('¿Estas seguro de querer Eliminar el Área?')); ?>
						</strong>
					</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">
						<?php echo __('Cancelar'); ?>
					</button>
					<button type="button"
						class="btn btn-primary eliminar-area-trigger"
						data-dismiss="modal">
						<?php echo __('Aceptar'); ?>
					</button>
				</div>
			</div>
		</div>
	</div>

</div>