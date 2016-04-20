<?php
App::uses('AppModel','Model');
  class Tramite extends AppModel {
    public $name = 'Tramite';


    public $belongsTo = array(
    		'TipoDocumento' => array(
    				'className' => 'TipoDocumento',
    				'foreignKey' => 'tipo_doc_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		),
    		'Accione' => array(
    				'className' => 'Accione',
    				'foreignKey' => 'accion_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		),
    		'Persona' => array(
    				'className' => 'Persona',
    				'foreignKey' => 'remitente_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		),
    		'Area' => array(
    				'className' => 'Area',
    				'foreignKey' => 'area_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		),
    		'Usuario' => array(
    				'className' => 'Usuario',
    				'foreignKey' => 'usuario_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		)
    );
    
    public $hasMany = array(
    		'SeguimientoTramite' => array(
    				'className' => 'SeguimientoTramite',
    				'foreignKey' => 'tramite_id',
    				'dependent' => false,
    				'conditions' => '',
    				'fields' => '',
    				'order' => '',
    				'limit' => '',
    				'offset' => '',
    				'exclusive' => '',
    				'finderQuery' => '',
    				'counterQuery' => ''
    		),
    		'SeguimientoNrodocumento' => array(
    				'className' => 'SeguimientoNrodocumento',
    				'foreignKey' => 'tramite_id',
    				'dependent' => false,
    				'conditions' => '',
    				'fields' => '',
    				'order' => '',
    				'limit' => '',
    				'offset' => '',
    				'exclusive' => '',
    				'finderQuery' => '',
    				'counterQuery' => ''
    		),
    		'TramiteFile' => array(
    				'className' => 'TramiteFile',
    				'foreignKey' => 'tramite_id',
    				'dependent' => false,
    				'conditions' => array('estado'=>1),
    				'fields' => '',
    				'order' => '',
    				'limit' => '',
    				'offset' => '',
    				'exclusive' => '',
    				'finderQuery' => '',
    				'counterQuery' => ''
    		),
    		'Bitacora' => array(
    				'className' => 'Bitacora',
    				'foreignKey' => 'tramite_id',
    				'dependent' => false,
    				'conditions' => '',
    				'fields' => '',
    				'order' => '',
    				'limit' => '',
    				'offset' => '',
    				'exclusive' => '',
    				'finderQuery' => '',
    				'counterQuery' => ''
    		)
    );
    
    public $validate = array(
    		'asunto'    => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'El Asunto es requerido'
    				)
    		),
    		'tipo_doc_id'    => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'El Tipo de Documento es requerido'
    				)
    		),
    		'accion_id'    => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'La accion es requerido'
    				)
    		),
    		'area_destino_id'    => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'La area de destino es requerido'
    				)
    		),
    );
    
    /* LISTADO TABS */
    public function listadoTramitesPendientes($area_id, $usuario_id){
    	//debug($area_id);
    	$model_seguimiento = $this->loadModel('SeguimientoTramite');
    	// Array tramite rechazados
    	$arr_tramites_rechazados = $model_seguimiento->find('all',array(
    			'fields' => array('SeguimientoTramite.tramite_id'),
    			'conditions'=>array(
    					'SeguimientoTramite.estado_id'=> array(8,9,10),
    					'SeguimientoTramite.area_id' => $area_id
    			),
    			'group'=> array('SeguimientoTramite.tramite_id')
    	));
    	 
    	$arr_ids_tramites_rechazados = array();
    	foreach ($arr_tramites_rechazados as $key => $tramite_id) {
    		$arr_ids_tramites_rechazados[] = $tramite_id['SeguimientoTramite']['tramite_id'];
    	}
    	//debug($arr_ids_tramites_rechazados);
    	 
    	$arr_ids_tramites_rechazados_pendientes = array();
    	$arr_ids_tramites_rechazados_pendientes2 = array();
    	$arr_ids_tramites_rechazados_completos = array();
    	foreach ($arr_ids_tramites_rechazados as $ids_tramites_rechazados){
    		$result_enviado_rechazado_inicio = $model_seguimiento->find('count',array(
    				'joins' => array(
    						array(
    								'table' => 'tramites',
    								'alias' => 'Tramite',
    								'type' => 'INNER',
    								'conditions' => array(
    										'SeguimientoTramite.tramite_id = Tramite.id'
    								)
    						)
    				),
    				'conditions'=> array(
    						'SeguimientoTramite.tramite_id'=>$ids_tramites_rechazados,
    						'SeguimientoTramite.area_id' => $area_id,
    						'Tramite.area_creacion_id' => $area_id,
    						'SeguimientoTramite.estado_id' => array(10)
    				)
    		));
    		//debug($result_enviado_rechazado_inicio);
    		$result_enviados = $model_seguimiento->find('count',array(
    				'conditions'=> array(
    						'SeguimientoTramite.tramite_id'=>$ids_tramites_rechazados,
    						'SeguimientoTramite.area_id' => $area_id,
    						'SeguimientoTramite.estado_id' => array(3,10)
    				)
    		));
    		//debug($result_enviados);
    		$result_recibidos = $model_seguimiento->find('count',array(
    				'conditions'=> array(
    						'SeguimientoTramite.tramite_id'=>$ids_tramites_rechazados,
    						'SeguimientoTramite.area_id' => $area_id,
    						'SeguimientoTramite.estado_id' => array(1,8)
    				)
    		));
    		//debug($result_recibidos);
    		$result_derivados = $model_seguimiento->find('count',array(
    				'conditions'=> array(
    						'SeguimientoTramite.tramite_id'=>$ids_tramites_rechazados,
    						'SeguimientoTramite.area_id' => $area_id,
    						'SeguimientoTramite.estado_id' => array(2,9)
    				)
    		));
    		//debug($result_derivados);
    		$result_aprobados = $model_seguimiento->find('count',array(
    				'conditions'=> array(
    						'SeguimientoTramite.tramite_id'=>$ids_tramites_rechazados,
    						'SeguimientoTramite.area_id' => $area_id,
    						'SeguimientoTramite.estado_id' => array(4)
    				)
    		));
    		//debug($result_aprobados);
    		if(($result_enviados + $result_enviado_rechazado_inicio) > $result_recibidos && $result_aprobados==0){
    			$arr_ids_tramites_rechazados_pendientes[] = $ids_tramites_rechazados;
    		}
    		if($result_derivados < $result_recibidos && $result_aprobados==0){
    			$arr_ids_tramites_rechazados_pendientes2[] = $ids_tramites_rechazados;
    		}
    	}
    	//debug($arr_ids_tramites_rechazados_completos);
    	//debug($arr_ids_tramites_rechazados_pendientes);
    	//debug($arr_ids_tramites_rechazados_pendientes2);
    	// Fin
    	 
    	$arr_tramites_x_recibir = $model_seguimiento->find('all',array(
    			'fields' => array('SeguimientoTramite.tramite_id'),
    			'conditions'=>array(
    					'SeguimientoTramite.estado_id'=> array(1,3,7),
    					'SeguimientoTramite.area_id' => $area_id
    			),
    			'group'=> array('SeguimientoTramite.tramite_id')
    	));
    
    	$arr_ids_tramites_x_recibir = array();
    	foreach ($arr_tramites_x_recibir as $key => $tramite_id) {
    		$arr_ids_tramites_x_recibir[] = $tramite_id['SeguimientoTramite']['tramite_id'];
    	}
    
    	//debug($arr_ids_tramites_x_recibir);
    	$arr_mergue_rechazados_recibidos = array_merge($arr_ids_tramites_rechazados_pendientes,$arr_ids_tramites_rechazados_pendientes2,$arr_ids_tramites_x_recibir);
    	//debug(array_unique($arr_mergue_rechazados_recibidos, SORT_REGULAR));
    
    	$arr_tramites_derivados_copiados = $model_seguimiento->find('all',array(
    			'fields' => array('SeguimientoTramite.tramite_id'),
    			'conditions'=>array(
    					'SeguimientoTramite.estado_id'=> array(2,4,5,9), //Aquellos q son derivados y aquellas copias recibidas
    					'SeguimientoTramite.area_id' => $area_id
    			)
    	));
    
    	$arr_ids_tramites_derivados_cop = array();
    	foreach ($arr_tramites_derivados_copiados as $key => $tramite_id) {
    		if(!in_array($tramite_id['SeguimientoTramite']['tramite_id'], array_merge($arr_ids_tramites_rechazados_pendientes,$arr_ids_tramites_rechazados_pendientes2))){
    			$arr_ids_tramites_derivados_cop[] = $tramite_id['SeguimientoTramite']['tramite_id'];
    		}
    	}
    
    	//debug($arr_ids_tramites_derivados_cop);
    
    	$arr_obj_tramites_final = $this->findObjects('all',array(
    			'conditions'=>array(
    					'Tramite.id'=> array_unique($arr_mergue_rechazados_recibidos, SORT_REGULAR),
    					'Tramite.id !='=>$arr_ids_tramites_derivados_cop,
    			),
    			'order'=> array('Tramite.created desc')
    	));
    
    
    	return $arr_obj_tramites_final;
    }
    
    public function listadoTramitesAceptadosRechazados($area_id, $usuario_id){
    	$model_seguimiento = $this->loadModel('SeguimientoTramite');
    	// Array tramite rechazados
    	$arr_tramites_rechazados = $model_seguimiento->find('all',array(
    			'fields' => array('SeguimientoTramite.tramite_id'),
    			'conditions'=>array(
    					'SeguimientoTramite.estado_id'=> array(8,9,10),
    					'SeguimientoTramite.area_id' => $area_id
    			),
    			'group'=> array('SeguimientoTramite.tramite_id')
    	));
    
    	$arr_ids_tramites_rechazados = array();
    	foreach ($arr_tramites_rechazados as $key => $tramite_id) {
    		$arr_ids_tramites_rechazados[] = $tramite_id['SeguimientoTramite']['tramite_id'];
    	}
    	//debug($arr_ids_tramites_rechazados);
    
    	$arr_ids_tramites_rechazados_completos = array();
    	$arr_ids_tramites_rechazados_pendientes = array();
    	$arr_ids_tramites_rechazados_pendientes2 = array();
    	foreach ($arr_ids_tramites_rechazados as $ids_tramites_rechazados){
    		$result_enviado_rechazado_inicio = $model_seguimiento->find('count',array(
    				'joins' => array(
    						array(
    								'table' => 'tramites',
    								'alias' => 'Tramite',
    								'type' => 'INNER',
    								'conditions' => array(
    										'SeguimientoTramite.tramite_id = Tramite.id'
    								)
    						)
    				),
    				'conditions'=> array(
    						'SeguimientoTramite.tramite_id'=>$ids_tramites_rechazados,
    						'SeguimientoTramite.area_id' => $area_id,
    						'Tramite.area_creacion_id' => $area_id,
    						'SeguimientoTramite.estado_id' => array(10)
    				)
    		));
    
    		$result_enviados = $model_seguimiento->find('all',array(
    				'fields'=> array('count(*) as count'),
    				'conditions'=> array(
    						'SeguimientoTramite.tramite_id'=>$ids_tramites_rechazados,
    						'SeguimientoTramite.area_id' => $area_id,
    						'SeguimientoTramite.estado_id' => array(3,10)
    				)
    		)
    		);
    
    		$result_recibidos = $model_seguimiento->find('all',array(
    				'fields'=> array('count(*) as count'),
    				'conditions'=> array(
    						'SeguimientoTramite.tramite_id'=>$ids_tramites_rechazados,
    						'SeguimientoTramite.area_id' => $area_id,
    						'SeguimientoTramite.estado_id' => array(1,8)
    				)
    		)
    		);
    
    		$result_derivados = $model_seguimiento->find('all',array(
    				'fields'=> array('count(*) as count'),
    				'conditions'=> array(
    						'SeguimientoTramite.tramite_id'=>$ids_tramites_rechazados,
    						'SeguimientoTramite.area_id' => $area_id,
    						'SeguimientoTramite.estado_id' => array(2,9)
    				)
    		)
    		);
    		$result_aprobados = $model_seguimiento->find('all',array(
    				'fields'=> array('count(*) as count'),
    				'conditions'=> array(
    						'SeguimientoTramite.tramite_id'=>$ids_tramites_rechazados,
    						'SeguimientoTramite.area_id' => $area_id,
    						'SeguimientoTramite.estado_id' => array(4)
    				)
    		)
    		);
    		//debug($result_enviados[0][0]['count']);
    		//debug($result_recibidos[0][0]['count']);
    		if(($result_enviados[0][0]['count'] + $result_enviado_rechazado_inicio) ==$result_recibidos[0][0]['count']){
    			$arr_ids_tramites_rechazados_completos[] = $ids_tramites_rechazados;
    		}
    		if(($result_enviados[0][0]['count'] + $result_enviado_rechazado_inicio)>$result_recibidos[0][0]['count'] && $result_aprobados[0][0]['count'] == 0){
    			$arr_ids_tramites_rechazados_pendientes[] = $ids_tramites_rechazados;
    		}
    		if($result_derivados[0][0]['count']<$result_recibidos[0][0]['count'] && $result_aprobados[0][0]['count'] == 0){
    			$arr_ids_tramites_rechazados_pendientes2[] = $ids_tramites_rechazados;
    		}
    	}
    	//debug($arr_ids_tramites_rechazados_completos);
    	//debug($arr_ids_tramites_rechazados_pendientes);
    	// Fin
    	 
    	$arr_tramites_completos = $model_seguimiento->find('all',array(
    			'fields' => array('SeguimientoTramite.tramite_id'),
    			'conditions'=>array(
    					'SeguimientoTramite.area_id' => $area_id,
    					'SeguimientoTramite.estado_id '=> array(2,4)
    			),
    			'group'=> array('SeguimientoTramite.tramite_id')
    	));
    	 
    	$arr_ids_tramites_completos = array();
    	foreach ($arr_tramites_completos as $key => $tramite_id) {
    		$arr_ids_tramites_completos[] = $tramite_id['SeguimientoTramite']['tramite_id'];
    	}
    	 
    	$arr_mergue_rechazados_completos = array_merge($arr_ids_tramites_rechazados_completos,$arr_ids_tramites_completos);
    	//debug(array_unique($arr_mergue_rechazados_completos, SORT_REGULAR));
    	 
    	$arr_obj_tramites_final = $this->findObjects('all',array(
    			'conditions'=>array(
    					'Tramite.id'=> array_unique($arr_mergue_rechazados_completos, SORT_REGULAR),
    					'Tramite.id !='=>array_merge($arr_ids_tramites_rechazados_pendientes,$arr_ids_tramites_rechazados_pendientes2)
    			),
    			'order'=> array('Tramite.created desc')
    	));
    
    	return $arr_obj_tramites_final;
    }
    
    public function listadoCopiasTramites($area_id, $usuario_id){
    	$arr_tramites = $this->findObjects('all',array(
    			'joins' => array(
    					array(
    							'table' => 'seguimiento_tramites',
    							'alias' => 'SeguimientoTramiteJoin',
    							'type' => 'INNER',
    							'conditions' => array(
    									'SeguimientoTramiteJoin.tramite_id = Tramite.id'
    							)
    					)
    			),
    			'conditions'=>array('Tramite.estado !=' => 0,
    					'SeguimientoTramiteJoin.area_id' => $area_id,
    					'SeguimientoTramiteJoin.estado_id '=> array(5,11)
    			),
    			'order'=> array('Tramite.created desc'),
    			'group' => 'Tramite.id'
    	));
    	 
    	return $arr_tramites;
    }
    
    
    
    public function siDerivo($obj_user){
    	$model_seguimiento = $this->loadModel('SeguimientoTramite');
    	 
    	$result = $model_seguimiento->find('first',array(
				'conditions'=> array(
						'SeguimientoTramite.tramite_id'=>$this->getID(),
						'SeguimientoTramite.area_id' => $obj_user->getAttr('area_id'),
						'SeguimientoTramite.estado_id' => 2
				)
			)
		);
    	
		return $result ? true : false;
    }

  	public function masUnaDerivado($obj_user){
    	$model_seguimiento = $this->loadModel('SeguimientoTramite');
    
    	$result = $model_seguimiento->find('all',array(
    			'fields'=> array('count(*) as count'),
    			'conditions'=> array(
    					'SeguimientoTramite.tramite_id'=>$this->getID(),
    					'SeguimientoTramite.area_id' => $obj_user->getAttr('area_id'),
    					'SeguimientoTramite.estado_id' => array(2,9)
    			)
    	)
    	);
    	
    	return $result[0][0]['count']>1 ? true : false;
    }
    
    public function siRecibido($obj_user){
    	$model_seguimiento = $this->loadModel('SeguimientoTramite');
    
    	$result = $model_seguimiento->find('first',array(
    			'conditions'=> array(
    					'SeguimientoTramite.tramite_id'=>$this->getID(),
    					'SeguimientoTramite.area_id' => $obj_user->getAttr('area_id'),
    					'SeguimientoTramite.estado_id' => 1
    			)
    	)
    	);
    	 
    	return $result ? true : false;
    }
    
    public function masUnaRecibidoUser($obj_user){
    	$model_seguimiento = $this->loadModel('SeguimientoTramite');
    
    	$result = $model_seguimiento->find('all',array(
    			'fields'=> array('count(*) as count'),
    			'conditions'=> array(
    					'SeguimientoTramite.tramite_id'=>$this->getID(),
    					'SeguimientoTramite.area_id' => $obj_user->getAttr('area_id'),
    					'SeguimientoTramite.estado_id' => 1
    			)
    	)
    	);
    	 
    	return $result[0][0]['count']>1 ? true : false;
    }
    
    public function siRecibidoGeneral($obj_user){
    	$model_seguimiento = $this->loadModel('SeguimientoTramite');
    
    	$result = $model_seguimiento->find('first',array(
    			'conditions'=> array(
    					'SeguimientoTramite.tramite_id'=>$this->getID(),
    					'SeguimientoTramite.area_id' => $obj_user->getAttr('area_id'),
    					'SeguimientoTramite.estado_id' => array(1,5,8,11)
    			)
    	)
    	);
    
    	return $result ? true : false;
    }
    
    public function masUnaRecibido(){
    	$model_seguimiento = $this->loadModel('SeguimientoTramite');
    
    	$result = $model_seguimiento->find('all',array(
    			'fields'=> array('count(*) as count'),
    			'conditions'=> array(
    					'SeguimientoTramite.tramite_id'=>$this->getID(),
    					'SeguimientoTramite.estado_id' => 1
    			)
    	)
    	);
    	
    	return $result[0][0]['count']>1 ? true : false;
    }
    
    public function masUnaRechazado($obj_user){
    	$model_seguimiento = $this->loadModel('SeguimientoTramite');
    
    	$result = $model_seguimiento->find('all',array(
    			'fields'=> array('count(*) as count'),
    			'conditions'=> array(
    					'SeguimientoTramite.tramite_id'=>$this->getID(),
						'SeguimientoTramite.area_id' => $obj_user->getAttr('area_id'),
    					'SeguimientoTramite.estado_id' => 8
    			)
    	)
    	);
    	 
    	return $result[0][0]['count']>=1 ? true : false;
    }

    public function siAprobo(){
    	$model_seguimiento = $this->loadModel('SeguimientoTramite');
    
    	$result = $model_seguimiento->find('first',array(
    			'conditions'=> array(
    					'SeguimientoTramite.tramite_id'=>$this->getID(),
    					'SeguimientoTramite.estado_id' => 4
    			)
    	)
    	);
    
    	return $result ? true : false;
    }
    
    public function siEsEnviadoCopia($obj_user){
    	$model_seguimiento = $this->loadModel('SeguimientoTramite');
    
    	$result = $model_seguimiento->find('first',array(
    			'conditions'=> array(
    					'SeguimientoTramite.tramite_id'=>$this->getID(),
    					'SeguimientoTramite.area_id' => $obj_user->getAttr('area_id'),
    					'SeguimientoTramite.estado_id' => 7
    			)
    	)
    	);
    
    	return $result ? true : false;
    }
    
    public function siEsEnviadoRechazado($obj_user){
    	$model_seguimiento = $this->loadModel('SeguimientoTramite');
    
    	$result = $model_seguimiento->find('first',array(
    			'conditions'=> array(
    					'SeguimientoTramite.tramite_id'=>$this->getID(),
    					'SeguimientoTramite.area_id' => $obj_user->getAttr('area_id'),
    					'SeguimientoTramite.estado_id' => 10
    			)
    	)
    	);
    
    	return $result ? true : false;
    }
    
    public function siEsEnviado($obj_user){
    	$model_seguimiento = $this->loadModel('SeguimientoTramite');
    
    	$result = $model_seguimiento->find('first',array(
    			'conditions'=> array(
    					'SeguimientoTramite.tramite_id'=>$this->getID(),
    					'SeguimientoTramite.area_id' => $obj_user->getAttr('area_id'),
    					'SeguimientoTramite.estado_id' => 3
    			)
    	)
    	);
    
    	return $result ? true : false;
    }
	
	public function siNumRecibidosEsMenorEnviados($obj_user){
    	$model_seguimiento = $this->loadModel('SeguimientoTramite');
    
    	$result_enviados = $model_seguimiento->find('all',array(
    			'fields'=> array('count(*) as count'),
    			'conditions'=> array(
    					'SeguimientoTramite.tramite_id'=>$this->getID(),
						'SeguimientoTramite.area_id' => $obj_user->getAttr('area_id'),
    					'SeguimientoTramite.estado_id' => 3
    			)
    	)
    	);
		
		$result_recibidos = $model_seguimiento->find('all',array(
    			'fields'=> array('count(*) as count'),
    			'conditions'=> array(
    					'SeguimientoTramite.tramite_id'=>$this->getID(),
						'SeguimientoTramite.area_id' => $obj_user->getAttr('area_id'),
    					'SeguimientoTramite.estado_id' => 1
    			)
    	)
    	);
    	
    	return $result_enviados[0][0]['count']>$result_recibidos[0][0]['count'] ? true : false;
    }
	
	public function siNumDerivadoEsMenorRecibidos($obj_user){
    	$model_seguimiento = $this->loadModel('SeguimientoTramite');

		$result_recibidos = $model_seguimiento->find('all',array(
    			'fields'=> array('count(*) as count'),
    			'conditions'=> array(
    					'SeguimientoTramite.tramite_id'=>$this->getID(),
						'SeguimientoTramite.area_id' => $obj_user->getAttr('area_id'),
    					'SeguimientoTramite.estado_id' => 1
    			)
    	)
    	);
    	
		$result_derivados = $model_seguimiento->find('all',array(
    			'fields'=> array('count(*) as count'),
    			'conditions'=> array(
    					'SeguimientoTramite.tramite_id'=>$this->getID(),
						'SeguimientoTramite.area_id' => $obj_user->getAttr('area_id'),
    					'SeguimientoTramite.estado_id' => array(2,9)
    			)
    	)
    	);
		
    	return $result_recibidos[0][0]['count']>$result_derivados[0][0]['count'] ? true : false;
    }
    
    public function siEsRecibidoCopia($obj_user){
    	$model_seguimiento = $this->loadModel('SeguimientoTramite');
    
    	$result = $model_seguimiento->find('first',array(
    			'conditions'=> array(
    					'SeguimientoTramite.tramite_id'=>$this->getID(),
    					'SeguimientoTramite.area_id' => $obj_user->getAttr('area_id'),
    					'SeguimientoTramite.estado_id' => 5
    			)
    	)
    	);
    
    	return $result ? true : false;
    }

    public function siEsArchivado($obj_user){
        $model_seguimiento = $this->loadModel('SeguimientoTramite');
    
        $result = $model_seguimiento->find('first',array(
                'conditions'=> array(
                        'SeguimientoTramite.tramite_id'=>$this->getID(),
                        'SeguimientoTramite.area_id' => $obj_user->getAttr('area_id'),
                        'SeguimientoTramite.estado_id' => 11
                )
        )
        );
    
        return $result ? true : false;
    }
    
    public function siEsRecibidoRechazado($obj_user){
    	$model_seguimiento = $this->loadModel('SeguimientoTramite');
    
    	$result = $model_seguimiento->find('first',array(
    			'conditions'=> array(
    					'SeguimientoTramite.tramite_id'=>$this->getID(),
    					'SeguimientoTramite.area_id' => $obj_user->getAttr('area_id'),
    					'SeguimientoTramite.estado_id' => 8
    			)
    	)
    	);
    
    	return $result ? true : false;
    }
    
    public function siEsRechazadoDerivado($obj_user){
    	$model_seguimiento = $this->loadModel('SeguimientoTramite');
    
    	$result = $model_seguimiento->find('first',array(
    			'conditions'=> array(
    					'SeguimientoTramite.tramite_id'=>$this->getID(),
    					'SeguimientoTramite.area_id' => $obj_user->getAttr('area_id'),
    					'SeguimientoTramite.estado_id' => 9
    			)
    	)
    	);
    
    	return $result ? true : false;
    }
    
    public function siEsRechazadoDerivadoSinArea($obj_user){
    	$model_seguimiento = $this->loadModel('SeguimientoTramite');
    
    	$result = $model_seguimiento->find('first',array(
    			'conditions'=> array(
    					'SeguimientoTramite.tramite_id'=>$this->getID(),
    					'SeguimientoTramite.estado_id' => 9
    			)
    	)
    	);
    
    	return $result ? true : false;
    }
    
    public function siEsRechazadoAreaCreacion($obj_user){    
    	$result = $this->find('first',array(
    			'joins' => array(
    					array(
    							'table' => 'seguimiento_tramites',
    							'alias' => 'SeguimientoTramite',
    							'type' => 'INNER',
    							'conditions' => array(
    									'SeguimientoTramite.tramite_id = Tramite.id'
    							)
    					)
    			),
    			'conditions'=> array(
    					'SeguimientoTramite.tramite_id'=>$this->getID(),
    					'SeguimientoTramite.area_id'=>$obj_user->getAttr('area_id'),
    					'Tramite.area_creacion_id' => $obj_user->getAttr('area_id'),
    					'SeguimientoTramite.estado_id' => 9
    			)
    	)
    	);
    
    	return $result ? true : false;
    }
    
    public function nroDocumento($area_id){
    	$model_seguimiento_nrodocumento = $this->loadModel('SeguimientoNrodocumento');
    
    	$result = $model_seguimiento_nrodocumento->find('first',array(
    			'conditions'=> array(
    					'SeguimientoNrodocumento.tramite_id'=>$this->getID(),
    					'SeguimientoNrodocumento.area_id' => $area_id
    			)
    	)
    	);
    
    	return !isset($result['SeguimientoNrodocumento']['nro_documento']) ? '' : $result['SeguimientoNrodocumento']['nro_documento'];
    }
    
    public function nroReferencia($obj_usuario){
    	$model_seguimiento_tramite = $this->loadModel('SeguimientoTramite');
    	$model_seguimiento_nrodocumento = $this->loadModel('SeguimientoNrodocumento');
    	$model_area = $this->loadModel('Area');
    
    	$result_enviado = $model_seguimiento_tramite->find('first',array(
    			'conditions'=> array(
    					'SeguimientoTramite.tramite_id'=>$this->getID(),
    					'SeguimientoTramite.area_id' => $obj_usuario->getAttr('area_id'),
    					'SeguimientoTramite.estado_id' => array(3,7)
    			)
    	)
    	);
    	
    	$result_derivado = $model_seguimiento_tramite->find('first',array(
    			'conditions'=> array(
    					'SeguimientoTramite.tramite_id'=>$this->getID(),
    					'SeguimientoTramite.estado_id' => 2,
    					'SeguimientoTramite.usuario_id' => $result_enviado['SeguimientoTramite']['usuario_id']
    			)
    	)
    	);
    	
    	$result_nro_documento = $model_seguimiento_nrodocumento->find('first',array(
    			'conditions'=> array(
    					'SeguimientoNrodocumento.tramite_id'=>$this->getID(),
    					'SeguimientoNrodocumento.area_id' => $result_derivado['SeguimientoTramite']['area_id']
    			)
    	)
    	);
    	
    	$result_area = $model_area->findById($result_derivado['SeguimientoTramite']['area_id']);
    
    	return !isset($result_nro_documento['SeguimientoNrodocumento']['nro_documento']) ? '' : '0'.$result_derivado['SeguimientoTramite']['area_id'].'-'.$result_nro_documento['SeguimientoNrodocumento']['nro_documento'].'-'.date('Y').' '.$result_area->getAttr('sigla');
    }
    
    public function areaRechazar($obj_usuario){
    	$model_seguimiento_tramite = $this->loadModel('SeguimientoTramite');
    
    	$result_enviado = $model_seguimiento_tramite->find('first',array(
    			'conditions'=> array(
    					'SeguimientoTramite.tramite_id'=>$this->getID(),
    					'SeguimientoTramite.area_id' => $obj_usuario->getAttr('area_id'),
    					'SeguimientoTramite.estado_id' => array(3)
    			)
    	)
    	);
    	
    	$result_derivado = $model_seguimiento_tramite->find('first',array(
    			'conditions'=> array(
    					'SeguimientoTramite.tramite_id'=>$this->getID(),
    					'SeguimientoTramite.estado_id' => 2,
    					'SeguimientoTramite.usuario_id' => $result_enviado['SeguimientoTramite']['usuario_id']
    			)
    	)
    	);
    
    	return !isset($result_derivado['SeguimientoTramite']['area_id']) ? '' : $result_derivado['SeguimientoTramite']['area_id'];
    }
    
    public function areaDerivarRechazar($obj_usuario){
    	$model_seguimiento_tramite = $this->loadModel('SeguimientoTramite');
    
    	$result_enviado = $model_seguimiento_tramite->find('first',array(
    			'conditions'=> array(
    					'SeguimientoTramite.tramite_id'=>$this->getID(),
    					'SeguimientoTramite.area_id' => $obj_usuario->getAttr('area_id'),
    					'SeguimientoTramite.estado_id' => array(10)
    			)
    	)
    	);
    	 
    	$result_derivado = $model_seguimiento_tramite->find('first',array(
    			'conditions'=> array(
    					'SeguimientoTramite.tramite_id'=>$this->getID(),
    					'SeguimientoTramite.estado_id' => 9,
    					'SeguimientoTramite.usuario_id' => $result_enviado['SeguimientoTramite']['usuario_id']
    			)
    	)
    	);
    
    	return !isset($result_derivado['SeguimientoTramite']['area_id']) ? '' : $result_derivado['SeguimientoTramite']['area_id'];
    }
    
    public function sendNotificacionEmail($id_tramite, $num_tramite, $nom_area_inicio, $nom_area_actual, $email_destino, $asunto){
    	App::uses('CakeEmail', 'Network/Email');
    	 
    	$Email = new CakeEmail('sistrado');
    	$Email->from(array('informes@mym-iceperu.com' => 'Altagora'));
    	$Email->emailFormat('html');
    	$Email->template('tramite','seguimiento_tramite');
    	$Email->viewVars(array('tramite_id' => $id_tramite,
    				'num_tramite'=> $num_tramite,
    			 	'nom_area_inicio'=> $nom_area_inicio,
    				'nom_area_actual'=> $nom_area_actual
    				));
    	$Email->to($email_destino);
    	$Email->subject($asunto);
    	$Email->send('Mi Mensaje');
    }
	
    public function obj_area_inicio(){
    	$model_seguimiento_tramite = $this->loadModel('SeguimientoTramite');
    
    	$result = $model_seguimiento_tramite->find('first',array(
    			'conditions'=> array(
    					'SeguimientoTramite.tramite_id'=>$this->getID(),
    			),
    			'order'=> array('SeguimientoTramite.created asc')
    	)
    	);
    
    	return $result;
    }
    
    public function obj_nro_documento(){
    	$model_seguimiento_nro_documento = $this->loadModel('SeguimientoNrodocumento');
    
    	$result = $model_seguimiento_nro_documento->find('first',array(
    			'conditions'=> array(
    					'SeguimientoNrodocumento.tramite_id'=>$this->getID(),
    			),
    			'order'=> array('SeguimientoNrodocumento.created asc')
    	)
    	);
    
    	return $result;
    }
  }
?>
