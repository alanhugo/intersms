<table class="table table-striped table-bordered table-hover dataTables-example">
	<thead>
		<tr>
			<th></th>
			<th>UserName</th>
			<th>Nombre</th>
			<th>Ultimo Acceso</th>
			<th>Estado</th>
			<th>Acci&oacute;n</th>
		</tr>
	</thead>
	<tbody>
	<?php $cont=1?>
		<?php foreach ($arr_usuarios as $key => $usuario){?>
		<tr class="usuario_row_container"
				usuario_id="<?php echo $usuario->getID(); ?>" username="<?php echo $usuario->getAttr('username')?>">
			<td><?php echo $cont++?></td>
			<td><?php echo $usuario->getAttr('username')?></td>
			<td><?php echo $usuario->getAttr('nombre')?></td>
			<td><?php echo $usuario->getAttr('ultimo_acceso')?></td>
			<td><?php echo ($usuario->getAttr('estado')==1)?"Habilitado":"Deshabilitado"?></td>
			<td><a><i class="fa fa-edit text-navy edit-usuario-trigger"></i></a>&nbsp;&nbsp;
				<a href="#myModalDeleteUsuario" role="button" data-toggle="modal"
				data-target="#myModalDeleteUsuario"><i
					class="fa fa-trash-o text-navy open-model-delete-usuario"></i> </a>
			</td>
		</tr>
		<?php }?>
	</tbody>
</table>
