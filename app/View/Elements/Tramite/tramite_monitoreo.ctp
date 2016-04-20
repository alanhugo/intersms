<?php if(!empty($arr_tramites)){?>
<table class="table table-striped table-bordered table-hover issue-tracker" id="dtable_tramites">
	<thead>
		<tr>
			<th>Estado</th>
			<th>Nro. Documento</th>
			<th>Nro. Referencia</th>
			<th>Tipo de Documento</th>
			<th>Asunto</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $cont=1?>
		<?php foreach ($arr_tramites as $key => $obj_tramite){?>
		<tr class="tramite_row_container <?php echo ($obj_tramite->masUnaRecibido()?'masUnaRecibido':'')?> <?php echo ($obj_tramite->masUnaRechazado($obj_logged_user)?'masUnaRechazado':'')?>"
				tramite_id="<?php echo $obj_tramite->getAttr('id'); ?>"
				area_id = "<?php echo $obj_logged_user->getAttr('area_id'); ?>"
				num_doc = "<?php echo ($obj_tramite->siRecibidoGeneral($obj_logged_user))?"0".$obj_logged_user->getAttr('area_id')."-".$obj_tramite->nroDocumento($obj_logged_user->getAttr('area_id'))."-".date('Y')." ".$obj_logged_user->Area->getAttr('sigla'):''; ?>"
		>
			<td>
			<?php if(($obj_tramite->siEsEnviado($obj_logged_user) && !$obj_tramite->siRecibido($obj_logged_user)) || ($obj_tramite->siEsRechazadoDerivado($obj_logged_user) && $obj_tramite->siNumRecibidosEsMenorEnviados($obj_logged_user))){?>
				<span class="label label-primary">Por recibir</span>
			<?php }elseif($obj_tramite->siNumDerivadoEsMenorRecibidos($obj_logged_user) && !$obj_tramite->siAprobo()){?>
				<span class="label label-warning">Por Derivar</span>
			<?php }elseif($obj_tramite->siEsEnviadoCopia($obj_logged_user) && !$obj_tramite->siEsRecibidoCopia($obj_logged_user)){?>
				<span class="label label-info">Copia por recibir </span>
			<?php }elseif($obj_tramite->siAprobo()){?>
				<span class="label label-success">Aprobado </span>
			<?php }elseif($obj_tramite->siEsRecibidoCopia($obj_logged_user)){?>
				<span class="label">Copiado </span>
			<?php }else{?>
				<span class="label label-info">Derivado </span>
			<?php }?>
			</td>
			<td><?php echo ($obj_tramite->siRecibidoGeneral($obj_logged_user))?"0".$obj_logged_user->getAttr('area_id')."-".$obj_tramite->nroDocumento($obj_logged_user->getAttr('area_id'))."-".date('Y')." ".$obj_logged_user->Area->getAttr('sigla'):''; ?></td>
			<td><?php echo ($obj_tramite->getAttr('usuario_id')==$obj_logged_user->getID())?'--':$obj_tramite->nroReferencia($obj_logged_user);?></td>
			<td><?php echo $obj_tramite->TipoDocumento->getAttr('descripcion')?></td>
			<td><?php echo $obj_tramite->getAttr('asunto')?></td>
			<td>
			<?php 
				$dias_est = $obj_tramite->getAttr('estimacion_dias');
				$hoy = date_create(date('y-m-d H:i:s'));
				$fecha_creacion =  date_create($obj_tramite->getAttr('created'));
				
				$arr_dif = date_diff($hoy, $fecha_creacion);
				$dias_transcurridos = $arr_dif->days;

			?>
			<span class="pie"><?php echo $dias_transcurridos.'/'.$dias_est; ?></span>
                              <?php echo $dias_transcurridos; ?>d
			</td>
		</tr>
		<?php }?>
	</tbody>
</table>
<?php }else{?>
<div class="alert alert-danger alert-dismissable">
	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
    	No se encontraron resultados
</div>
<?php }?>
