<?php
  class DashboardController extends AppController{
       var $name = 'Dashboard';
       
       public function index(){
           $this->layout = "default";
           
           $this->loadModel('SeguimientoTramite');
           $this->loadModel('Usuario');
           
           $contar_todos_tramites = count($this->SeguimientoTramite->listTramiteGeneral($this->obj_logged_user));
           $contar_tramites_derivados = count($this->SeguimientoTramite->listTramitesDerivados($this->obj_logged_user));
           $contar_tramites_pendientes = count($this->SeguimientoTramite->listTramitesPendientes($this->obj_logged_user));
           $contar_tramites_aceptados = count($this->SeguimientoTramite->listTramitesAceptados($this->obj_logged_user));
           
           $area_id = $this->obj_logged_user->getAttr('area_id');
           $usuario_id = $this->obj_logged_user->getID();
           $contar_tramites_anio_actual = $this->SeguimientoTramite->contarTramiteAnioActual($area_id, $usuario_id);
           $contar_tramites_ultimo_mes = $this->SeguimientoTramite->contarTramiteUltimoMes($area_id, $usuario_id);
           $contar_tramites_mes_actual = $this->SeguimientoTramite->contarTramiteMesActual($area_id, $usuario_id);

           $arr_obj_usuarios = $this->Usuario->findObjects('all',array(
				'conditions'=>array('Usuario.estado !=' => 0, 'Usuario.id !=' => 1),
				'order'=> array('Usuario.created desc')));
           
           $area_logged_user = $this->obj_logged_user->getAttr('area_id');
           
           $this->set(compact('contar_todos_tramites','contar_tramites_derivados','contar_tramites_pendientes','contar_tramites_aceptados','area_logged_user','contar_tramites_anio_actual','contar_tramites_ultimo_mes','contar_tramites_mes_actual','arr_obj_usuarios'));
       }
       
       public function load_graf_tramite_periodo($usuario_id = null, $area_id = null){
       	$this->loadModel('SeguimientoTramite');
       	$this->autoRender = false;

       	$x ="";
       	$y ="";

       	if(isset($usuario_id) && $usuario_id != null){
       		$usuario_id = $usuario_id;
       	}else{
       		$usuario_id = $this->obj_logged_user->getID();
       	}

       	if(isset($area_id) && $area_id != null){
       		$area_id = $area_id;
       	}else{
       		$area_id = $this->obj_logged_user->getAttr('area_id');
       	}
       	 
       	$arr_meses = array(1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre');
       	$arr_periodo = array();

       	foreach ($arr_meses as $key => $mes){
       		$arr_periodo[$key]['num_mes'] = $key;
       		$arr_periodo[$key]['nom_mes'] = $mes;
       		$arr_periodo[$key]['cantidad'] = $this->SeguimientoTramite->listTramitesPorAnioActual($key, $area_id, $usuario_id);
       		 
       		$x[] = $arr_periodo[$key]['nom_mes'];
       		$y[] = intval($arr_periodo[$key]['cantidad']);
       	}
       	 
       	return json_encode(array('success'=>true,'meses'=>$x, 'name'=>'Meses', 'data'=>$y));
       }
       
       public function load_graf_tramite_ult_mes($usuario_id = null, $area_id = null){
       	$this->loadModel('SeguimientoTramite');
       	$this->autoRender = false;
       	 
       	$x ="";
       	$y ="";

       	if(isset($usuario_id) && $usuario_id != null){
       		$usuario_id = $usuario_id;
       	}else{
       		$usuario_id = $this->obj_logged_user->getID();
       	}

       	if(isset($area_id) && $area_id != null){
       		$area_id = $area_id;
       	}else{
       		$area_id = $this->obj_logged_user->getAttr('area_id');
       	}
       	 

       	$ultimo_mes = intval(date("m"))-1;
       	$anio_actual = date("Y");
       	$numero_dias = cal_days_in_month(CAL_GREGORIAN, $ultimo_mes, $anio_actual);
       	 
       	$arr_ult_mes = array();
       	 
       	for($i=1; $i<= $numero_dias; $i++){
       		$arr_dias[] = $i;
       	}
       	 
       	foreach ($arr_dias as $dia){
       		$arr_ult_mes[$dia]['num_dia'] = $dia;
       		$arr_ult_mes[$dia]['cantidad'] = $this->SeguimientoTramite->listTramitesPorUltimoMes($dia, $area_id, $usuario_id);
       		 
       		$x[] = $arr_ult_mes[$dia]['num_dia'];
       		$y[] = intval($arr_ult_mes[$dia]['cantidad']);
       	}
       	 
       	return json_encode(array('success'=>true,'meses'=>$x, 'name'=>utf8_encode('Días'), 'data'=>$y));
       }
       
       public function load_graf_tramite_mes_actual($usuario_id=null, $area_id = null){

       	$this->loadModel('SeguimientoTramite');
       	$this->autoRender = false;
       	 
       	$x ="";
       	$y ="";
       	 
       	if(isset($usuario_id) && $usuario_id != null){
       		$usuario_id = $usuario_id;
       	}else{
       		$usuario_id = $this->obj_logged_user->getID();
       	}

       	if(isset($area_id) && $area_id != null){
       		$area_id = $area_id;
       	}else{
       		$area_id = $this->obj_logged_user->getAttr('area_id');
       	}

       	$ultimo_mes = intval(date("m"));
       	$anio_actual = date("Y");
       	$numero_dias = cal_days_in_month(CAL_GREGORIAN, $ultimo_mes, $anio_actual);

       	$arr_ult_mes = array();

       	for($i=1; $i<= $numero_dias; $i++){
       		$arr_dias[] = $i;
       	}

       	foreach ($arr_dias as $dia){
       		$arr_ult_mes[$dia]['num_dia'] = $dia;
       		$arr_ult_mes[$dia]['cantidad'] = $this->SeguimientoTramite->listTramitesPorMesActual($dia, $area_id, $usuario_id);
       		 
       		$x[] = $arr_ult_mes[$dia]['num_dia'];
       		$y[] = intval($arr_ult_mes[$dia]['cantidad']);
       	}
       	 
       	return json_encode(array('success'=>true,'meses'=>$x, 'name'=>utf8_encode('Días'), 'data'=>$y));
       }
  }
?>
