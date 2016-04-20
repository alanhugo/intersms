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
			<td>
				<a href="<?= ENV_WEBROOT_FULL_URL; ?>seguimiento_tramites/index/<?php echo $obj_tramite->getEncodeHash($obj_tramite->getAttr('id')); ?>" role="button"><i
					class="fa fa-list-ul text-navy" data-toggle="tooltip" data-placement="top" data-original-title="Seguimiento Documento"></i></a>
				<?php echo ($obj_tramite->siEsEnviadoCopia($obj_logged_user))?"&nbsp;&nbsp;<strong>Copia</strong>":"";?>
				
				<?php 
				if($obj_tramite->siEsRechazadoDerivadoSinArea($obj_logged_user)){
					if($obj_tramite->siEsRechazadoAreaCreacion($obj_logged_user)){
						echo "&nbsp;&nbsp;<strong>Devuelto Definitivamente</strong>";
					}else{
						echo "&nbsp;&nbsp;<strong>Devuelto</strong>";
					}
				}
				?>
			</td>
		</tr>
		<?php }?>
	</tbody>
</table>
