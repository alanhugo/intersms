<table class="table table-striped table-bordered table-hover dataTables-example">
	<thead>
		<tr>
			<th></th>
			<th>Nombre</th>
			<th>Estado</th>
			<th>Acci&oacute;n</th>
		</tr>
	</thead>
	<tbody>
	<?php $cont=1?>
		<?php foreach ($arr_groupcmds as $key => $groupcmd){?>
		<tr class="groupcmd_row_container"
				groupcmd_id="<?php echo $groupcmd->getID(); ?>" groupcmd_name="<?php echo $groupcmd->getAttr('DGroup')?>">
			<td><?php echo $cont++?></td>
			<td><?php echo $groupcmd->getAttr('DGroup')?></td>
			<td><?php echo ($groupcmd->getAttr('Status')==1)?"Habilitado":"Deshabilitado"?></td>
			<td><a><i class="fa fa-edit text-navy edit-groupcmd-trigger"></i></a>&nbsp;&nbsp;
				<a href="#myModalDeleteGroupcmd" role="button" data-toggle="modal"
				data-target="#myModalDeleteGroupcmd"><i
					class="fa fa-trash-o text-navy open-model-delete-groupcmd"></i> </a>
			</td>
		</tr>
		<?php }?>
	</tbody>
</table>