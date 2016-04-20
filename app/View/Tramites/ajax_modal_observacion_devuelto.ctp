<?php if(isset($arr_seg_tramite[0]['SeguimientoTramite']['observacion']) && $arr_seg_tramite[0]['SeguimientoTramite']['observacion'] != ''){
	echo "<strong>Observaciones:</strong><br>";
	echo $arr_seg_tramite[0]['SeguimientoTramite']['observacion'];
}
?>