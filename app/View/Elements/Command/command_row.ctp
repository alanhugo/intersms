<table class="table table-striped table-bordered table-hover dataTables-example">
	<thead>
		<tr>
			<th></th>
			<th>Nombre</th>
			<th>PhoneID</th>
			<th>Terminador</th>
			<th>Acci&oacute;n</th>
		</tr>
	</thead>
	<tbody>
	<?php $cont=1?>
		<?php foreach ($arr_commands as $key => $command){?>
		<tr class="command_row_container"
				command_id="<?php echo $command->getID(); ?>" command_name="<?php echo $command->getAttr('Command')?>">
			<td><?php echo $cont++?></td>
			<td><?php echo $command->getAttr('Command')?></td>
			<td><?php echo $command->getAttr('PhoneID')?></td>
			<td><?php echo $command->getAttr('Terminator')?></td>
			<td><a><i class="fa fa-edit text-navy edit-command-trigger"></i></a>&nbsp;&nbsp;
				<a href="#myModalDeleteCommand" role="button" data-toggle="modal"
				data-target="#myModalDeleteCommand"><i
					class="fa fa-trash-o text-navy open-model-delete-command"></i> </a>
			</td>
		</tr>
		<?php }?>
	</tbody>
</table>