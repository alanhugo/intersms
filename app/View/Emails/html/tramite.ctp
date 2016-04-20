<table class="main" width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td class="alert alert-good">Informacion: Te Notificamos que tu Tramite cambio de estado.</td>
	</tr>
	<tr>
		<td class="content-wrap">
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="content-block">Tu tramite de numero <strong><?php echo $num_tramite?></strong> que inicializo 
					en el area <strong><?php echo $nom_area_inicio?></strong> ahora se encuentra en <strong><?php echo $nom_area_actual?></strong>.
					</td>
				</tr>
				<tr>
					<td class="content-block">Te notificaremos cuando el tramite sea aceptado por las diferentes areas, 
					y finalmente cuando sea aprobado. En el enlace de abajo de este parrofo "Linea de tiempo del tramite" 
					podra ver las diferentes areas que paso su tramite</td>
				</tr>
				<tr>
					<td class="content-block"><a href="<?= ENV_WEBROOT_FULL_URL; ?>seguimiento_tramites/index/<?php echo $tramite_id;?>" class="btn-primary">Linea de tiempo del tramite</a></td>
				</tr>
				<tr>
					<td class="content-block">Gracias por escogernos, Altagora.</td>
				</tr>
			</table>
		</td>
	</tr>
</table>