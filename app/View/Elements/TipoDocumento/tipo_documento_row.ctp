	<table
		class="table table-striped table-bordered table-hover dataTables-example" id="dtable_tipo_documentos">
		<thead>
			<tr>
				<th></th>
				<th><?php echo utf8_encode(__('Tipo Documento')); ?></th>
				<th>Acci&oacute;n</th>
			</tr>
		</thead>
		<tbody>
			<?php $cont=1?>
			<?php foreach ($list_tipo_documentos as $tipo_documento){ ?>
			<tr class="tipo_documento_row_container"
				tipo_documento_id="<?php echo $tipo_documento->getAttr('id'); ?>">
				<td><?php echo $cont++?></td>
				<td><?php echo utf8_encode($tipo_documento->getAttr('descripcion')); ?></td>
				<td><a><i class="fa fa-edit text-navy edit-tipo-documento-trigger"></i> </a>
					<a href="#myModalDeleteTipoDocumento" role="button" data-toggle="modal"
					data-target="#myModalDeleteTipoDocumento"><i
						class="fa fa-trash-o text-navy open-model-delete-tipo-documento"></i> </a>
				</td>
			</tr>
			<?php }?>
		</tbody>
	</table>