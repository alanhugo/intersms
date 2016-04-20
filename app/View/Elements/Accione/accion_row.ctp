	<table
		class="table table-striped table-bordered table-hover dataTables-example" id="dtable_acciones">
		<thead>
			<tr>
				<th></th>
				<th><?php echo utf8_encode(__('Descripción')); ?></th>
				<th>Acci&oacute;n</th>
			</tr>
		</thead>
		<tbody>
			<?php $cont=1?>
			<?php foreach ($list_acciones as $accion){ ?>
			<tr class="accion_row_container"
				accion_id="<?php echo $accion->getAttr('id'); ?>">
				<td><?php echo $cont++?></td>
				<td><?php echo utf8_encode($accion->getAttr('descripcion')); ?></td>
				<td><a><i class="fa fa-edit text-navy edit-accion-trigger"></i> </a>
					<a href="#myModalDeleteAccion" role="button" data-toggle="modal"
					data-target="#myModalDeleteAccion"><i
						class="fa fa-trash-o text-navy open-model-delete-accion"></i> </a>
				</td>
			</tr>
			<?php }?>
		</tbody>
	</table>