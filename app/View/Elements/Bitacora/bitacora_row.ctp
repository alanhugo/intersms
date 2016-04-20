	<table
		class="table table-striped table-bordered table-hover dataTables-example" id="dtable_areas">
		<thead>
			<tr>
				<th><?php echo utf8_encode(__('ID Tramite')); ?></th>
				<th><?php echo utf8_encode(__('Área')); ?></th>
				<th><?php echo utf8_encode(__('Usuario')); ?></th>
				<th style="width: 550px;"><?php echo utf8_encode(__('Valores')); ?></th>
				<th><?php echo utf8_encode(__('Fecha de creación')); ?></th>
				<th><?php echo utf8_encode(__('Acción')); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($list_bitacoras as $bitacora){ ?>
			<tr class="area_row_container"
				bitacora_id="<?php echo $bitacora->getAttr('id'); ?>">
				<td><?php echo $bitacora->getAttr('tramite_id'); ?></td>
				<td><?php echo utf8_encode($bitacora->Area->getAttr('nombre')); ?></td>
				<td><?php echo $bitacora->Usuario->getAttr('username'); ?></td>
				<td><?php echo utf8_encode($bitacora->getAttr('valores')); ?></td>
				<td><?php echo $bitacora->getAttr('created'); ?></td>
				<td><?php echo $bitacora->getAttr('accion'); ?></td>
			</tr>
			<?php }?>
		</tbody>
	</table>