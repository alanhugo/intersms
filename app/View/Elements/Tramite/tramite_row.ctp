<table class="table table-striped table-bordered table-hover issue-tracker" id="dtable_tramites">
	<thead>
		<tr>
			<th>Estado</th>
			<th>Nro. Documento</th>
			<th>Nro. Referencia</th>
			<th>Tipo de Documento</th>
			<th>Asunto</th>
			<th></th>
			<th>Acci&oacute;n</th>
		</tr>
	</thead>
	<tbody>
		<?php $cont=1?>
		<?php foreach ($arr_tramites as $key => $obj_tramite){?>
		<tr class="tramite_row_container <?php echo ($obj_tramite->masUnaRecibido()?'masUnaRecibido':'')?> <?php echo ($obj_tramite->masUnaRechazado($obj_logged_user)?'masUnaRechazado':'')?>"
				tramite_id="<?php echo $obj_tramite->getAttr('id'); ?>"
				area_id = "<?php echo $obj_logged_user->getAttr('area_id'); ?>"
				num_doc = "<?php echo ($obj_tramite->siRecibidoGeneral($obj_logged_user))?"0".$obj_logged_user->getAttr('area_id')."-".$obj_tramite->nroDocumento($obj_logged_user->getAttr('area_id'))."-".date('Y')." ".$obj_logged_user->Area->getAttr('sigla'):''; ?>"
				style="<?php
				$dias_est = $obj_tramite->getAttr('estimacion_dias');

				$fecha_creacion = strtotime($obj_tramite->getAttr('created'));
				$hoy = strtotime("now");
				$cont = 0;
				for($fecha_creacion;$fecha_creacion<=$hoy;$fecha_creacion=strtotime('+1 day ' . date('Y-m-d',$fecha_creacion))){
					if((strcmp(date('D',$fecha_creacion),'Sun')!=0) && (strcmp(date('D',$fecha_creacion),'Sat')!=0)){
						//echo date('Y-m-d D',$fecha_creacion) . '<br />';
						$cont++;
					}
				}
						
					$dias_transcurridos = $cont;
						
					if(($dias_est - $dias_transcurridos) == 1){
						echo 'background-color:LemonChiffon';
					}elseif($dias_transcurridos >= $dias_est){
						echo 'background-color:#FFE4E1';
					}else{
						echo '';
					}
				?>"
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
			<?php }elseif($obj_tramite->siEsArchivado($obj_logged_user)){?>
				<span class="label label-success">Archivado </span>
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

				$fecha_creacion = strtotime($obj_tramite->getAttr('created'));
				$hoy = strtotime("now");
				$cont = 0;
				for($fecha_creacion;$fecha_creacion<=$hoy;$fecha_creacion=strtotime('+1 day ' . date('Y-m-d',$fecha_creacion))){
					if((strcmp(date('D',$fecha_creacion),'Sun')!=0) && (strcmp(date('D',$fecha_creacion),'Sat')!=0)){
						$cont++;
					}
				}
				$dias_transcurridos = $cont;
			?>
			<span class="pie"><?php echo $dias_transcurridos.'/'.$dias_est; ?></span>
                              <?php echo $dias_transcurridos; ?>d
			</td>
			<td><?php if($obj_tramite->getAttr('usuario_id')==$obj_logged_user->getID() && (!$obj_tramite->siDerivo($obj_logged_user) || !$obj_tramite->siEsRechazadoAreaCreacion($obj_logged_user))){?>
				<a><i class="fa fa-edit text-navy edit-tramite-trigger" data-toggle="tooltip" data-placement="top" data-original-title="Editar Documento"></i></a>&nbsp;&nbsp;
				<a href="#myModalDeleteTramite" role="button" data-toggle="modal"
				data-target="#myModalDeleteTramite"><i data-toggle="tooltip" data-placement="top" data-original-title="Eliminar Documento"
					class="fa fa-trash-o text-navy open-model-delete-tramite"></i></a>&nbsp;&nbsp;
				<?php }?>
				
				<?php if($obj_tramite->siEsEnviadoCopia($obj_logged_user) && !$obj_tramite->siEsRecibidoCopia($obj_logged_user)){?>
				<a href="#myModalRecibirCopia" role="button" data-toggle="modal"
				data-target="#myModalRecibirCopia"><i data-toggle="tooltip" data-placement="top" data-original-title="Recibir Copia"
					class="fa fa-download text-navy open-model-recibir-copia"></i></a>&nbsp;&nbsp;
				<?php }else if($obj_tramite->siEsEnviadoRechazado($obj_logged_user) && !$obj_tramite->siEsRecibidoRechazado($obj_logged_user)){?>
				<a href="#myModalRecibirRechazado" role="button" data-toggle="modal"
				data-target="#myModalRecibirRechazado"><i data-toggle="tooltip" data-placement="top" data-original-title="Recibir Devuelto"
					class="fa fa-download text-navy open-model-recibir-rechazado"></i></a>&nbsp;&nbsp;
				<?php }else if(($obj_tramite->siEsEnviado($obj_logged_user) && !$obj_tramite->siRecibido($obj_logged_user)) || ($obj_tramite->siEsRechazadoDerivado($obj_logged_user) && $obj_tramite->siNumRecibidosEsMenorEnviados($obj_logged_user))){?>
				<a href="#myModalRecibirTramite" role="button" data-toggle="modal"
				data-target="#myModalRecibirTramite"><i data-toggle="tooltip" data-placement="top" data-original-title="Recibir Documento"
					class="fa fa-download text-navy open-model-recibir-tramite"></i></a>&nbsp;&nbsp;
				<?php }?>
				
				<?php if($obj_tramite->siNumDerivadoEsMenorRecibidos($obj_logged_user) && !$obj_tramite->siAprobo()){?>
				<a href="#myModalDerivarTramite" role="button" data-toggle="modal"
				data-target="#myModalDerivarTramite"><i data-toggle="tooltip" data-placement="top" data-original-title="Derivar Documento"
					area_derivar_id="<?php echo $obj_tramite->getAttr('area_id')?>" class="fa fa-send text-navy open-model-derivar-tramite"></i></a>&nbsp;&nbsp;
				<a href="#myModalRechazarTramite" role="button" data-toggle="modal"
				data-target="#myModalRechazarTramite"><i data-toggle="tooltip" data-placement="top" data-original-title="Devolver Documento"
					class="fa fa-times-circle text-navy open-model-rechazar-tramite"></i></a>&nbsp;&nbsp;
				<a href="#myModalAprobarTramite" role="button" data-toggle="modal"
				data-target="#myModalAprobarTramite"><i data-toggle="tooltip" data-placement="top" data-original-title="Aceptar Documento"
					class="fa fa-check text-navy open-model-aprobar-tramite"></i></a>&nbsp;&nbsp;
				<?php }?>

				<?php if($obj_tramite->siEsRecibidoRechazado($obj_logged_user) && !$obj_tramite->masUnaDerivado($obj_logged_user)){?>
				<a href="#myModalDerivarTramite" role="button" data-toggle="modal"
				data-target="#myModalDerivarTramite"><i data-toggle="tooltip" data-placement="top" data-original-title="Derivar Documento Devuelto"
					area_derivar_id="<?php echo $obj_tramite->areaDerivarRechazar($obj_logged_user)?>" class="fa fa-send text-navy open-model-derivar-tramite"></i></a>&nbsp;&nbsp;
				<a href="#myModalRechazarTramite" role="button" data-toggle="modal"
				data-target="#myModalRechazarTramite"><i data-toggle="tooltip" data-placement="top" data-original-title="Rechazar Documento Devuelto"
					class="fa fa-times-circle text-navy open-model-rechazar-tramite"></i></a>&nbsp;&nbsp;
				<?php }?>
				
				<a href="<?= ENV_WEBROOT_FULL_URL; ?>seguimiento_tramites/index/<?php echo $obj_tramite->getEncodeHash($obj_tramite->getAttr('id')); ?>" role="button"><i
					class="fa fa-list-ul text-navy" data-toggle="tooltip" data-placement="top" data-original-title="Seguimiento Documento"></i></a>
				<?php echo ($obj_tramite->siEsEnviadoCopia($obj_logged_user))?"&nbsp;&nbsp;<strong>Copia</strong>":"";?>
				
				<?php echo ($obj_tramite->siEsRechazadoDerivadoSinArea($obj_logged_user))?"&nbsp;&nbsp;<strong>Devuelto</strong>":"";?>
			</td>
		</tr>
		<?php }?>
	</tbody>
</table>
