	<table
		class="table table-striped table-bordered table-hover dataTables-example" id="dtable_areas">
		<thead>
			<tr>
				<th></th>
				<th><?php echo utf8_encode(__('Nombre de Área')); ?></th>
				<th>Acci&oacute;n</th>
			</tr>
		</thead>
		<tbody>
			<?php $cont=1?>
			<?php foreach ($list_areas as $area){ ?>
			<tr class="area_row_container"
				area_id="<?php echo $area->getAttr('id'); ?>">
				<td><?php echo $cont++?></td>
				<td><?php echo utf8_encode($area->getAttr('nombre')); ?></td>
				<td><a><i class="fa fa-edit text-navy edit-area-trigger"></i> </a>
					<a href="#myModalDeleteArea" role="button" data-toggle="modal"
					data-target="#myModalDeleteArea"><i
						class="fa fa-trash-o text-navy open-model-delete-area"></i> </a>
				</td>
			</tr>
			<?php }?>
		</tbody>
	</table>