	<table
		class="table table-striped table-bordered table-hover dataTables-example" id="dtable_personas">
		<thead>
			<tr>
				<th><?php echo utf8_encode(__('N°')); ?></th>
		          <th><?php echo __('Tipo Persona'); ?></th>
		          <th><?php echo utf8_encode(__('Nombre / Razón Social')); ?></th>
		          <th><?php echo utf8_encode(__('Correo electrónico')); ?></th>
		          <th><?php echo __('Nro. Documento'); ?></th>
		          <th><?php echo __('Sexo'); ?></th>
		          <th><?php echo utf8_encode(__('Teléfono')); ?></th>
		          <th><?php echo utf8_encode(__('Móvil')); ?></th>
				<th>Acci&oacute;n</th>
			</tr>
		</thead>
		<tbody>
			<?php $cont=1?>
			<?php foreach ($list_persona as $persona){ ?>
			<tr class="persona_row_container" persona_id="<?php echo $persona->getAttr('id'); ?>" persona_nombre="<?php echo utf8_encode($persona->getAttr('nombre')).' '. utf8_encode($persona->getAttr('apellido')); ?>">
						<td><?php echo $cont++; ?></td>
						<td><?php echo $persona->TipoPersona->getAttr('descripcion'); ?></td>
						<td><?php echo utf8_encode($persona->getAttr('nombre')).' '. utf8_encode($persona->getAttr('apellido')); ?></td>
						<td><?php echo $persona->getAttr('email'); ?></td>
						<td><?php echo $persona->getAttr('nro_documento'); ?></td>
						<td><?php echo $persona->getAttr('sexo'); ?></td>
						<td><?php echo $persona->getAttr('telefono'); ?></td>
						<td><?php echo $persona->getAttr('movil'); ?></td>
						<td><a><i class="fa fa-edit edit-persona-trigger text-navy"></i> </a> 
							<a href="#myModalDeletePersona" role="button" data-toggle="modal" data-target="#myModalDeletePersona"><i class="fa fa-trash-o text-navy"></i> </a>
							<a href="#" class="link_roles text-navy">Roles</a>
						</td>
			</tr>
			<?php }?>
		</tbody>
	</table>