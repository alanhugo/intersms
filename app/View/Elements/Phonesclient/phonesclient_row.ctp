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
		<?php foreach ($arr_phonesclients as $key => $phonesclient){?>
		<tr class="phonesclient_row_container"
				phonesclient_id="<?php echo $phonesclient->getID(); ?>" phonesclient_name="<?php echo $phonesclient->getAttr('PhoneNumber')?>">
			<td><?php echo $cont++?></td>
			<td><?php echo $phonesclient->getAttr('PhoneNumber')?></td>
			<td><?php echo ($phonesclient->getAttr('Status')==1)?"Habilitado":"Deshabilitado"?></td>
			<td><a><i class="fa fa-edit text-navy edit-phonesclient-trigger"></i></a>&nbsp;&nbsp;
				<a href="#myModalDeletePhonesclient" role="button" data-toggle="modal"
				data-target="#myModalDeletePhonesclient"><i
					class="fa fa-trash-o text-navy open-model-delete-phonesclient"></i> </a>
			</td>
		</tr>
		<?php }?>
	</tbody>
</table>