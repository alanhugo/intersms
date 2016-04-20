<table
	class="table table-striped table-bordered table-hover dataTables-example"
	id="dtable_rol_personas">
	<thead>
		<tr>
			<th><?php echo utf8_encode(__('N°')); ?></th>
			<th><?php echo __('Rol'); ?></th>

			<th><?php echo __('Operaciones'); ?></th>
		</tr>
	</thead>
	<?php $cont=1?>
	<?php foreach ($list_rol_persona as $rol_persona){ ?>
	<tbody>
		<tr class="rol_persona_row_container"
			rol_persona_id="<?php echo $rol_persona->getAttr('id'); ?>">
			<td><?php echo $cont++; ?></td>
			<td><?php echo $rol_persona->Role->getAttr('descripcion'); ?></td>
			<td><a href="#myModalDeleteRolPersona" role="button"
				data-toggle="modal" data-target="#myModalDeleteRolPersona"><i
					class="fa fa-trash-o text-navy open-modal-delete-rol-persona"></i> </a>
			</td>
		</tr>
		<?php 
}
?>
	</tbody>
</table>