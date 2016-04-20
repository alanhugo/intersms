<?php
class TramitesController extends AppController{

	public $name = 'Tramites';

	public function beforeFilter(){
		$this->Auth->allow(array('consultar','ajax_consultar_validar','ajax_consultar'));
		$this->layout = "default";
		parent::beforeFilter();
	}
	
	/**
	 * Lista tramites
	 * @author Alan Hugo
	 * @version 05 Julio 2015
	 */
	public function index() {
		$this->loadModel('Area');
		
		$arr_tramites = $this->Tramite->listadoTramitesPendientes($this->obj_logged_user->getAttr('area_id'), $this->obj_logged_user->getID());
		
		//debug($arr_tramites); exit();

		$arr_areas = $this->Area->findObjects('all',array(
				'conditions'=>array('Area.estado !=' => 0, 'Area.id !=' => $this->obj_logged_user->getAttr('area_id')),
				'order'=> array('Area.created desc')));
		
		$this->set(compact('arr_tramites','arr_areas'));
	}
	
	
	/**
	 * Lista Copias de tramites
	 * @author Vladimir TM
	 * @version 19 Agosto 2015
	 */
	public function ajax_listar_aceptados_rechazados() {
		$this->layout = 'ajax';
	
		$this->loadModel('Area');
	
		$arr_tramites = $this->Tramite->listadoTramitesAceptadosRechazados($this->obj_logged_user->getAttr('area_id'), $this->obj_logged_user->getID());
	
		$arr_areas = $this->Area->findObjects('all',array(
				'conditions'=>array('Area.estado !=' => 0, 'Area.id !=' => $this->obj_logged_user->getAttr('area_id')),
				'order'=> array('Area.created desc')));
	
		$this->set(compact('arr_tramites','arr_areas'));
	}
	
	/**
	 * Lista Copias de tramites
	 * @author Vladimir TM
	 * @version 19 Agosto 2015
	 */
	public function ajax_listar_copias() {
		$this->layout = 'ajax';
	
		$this->loadModel('Area');
	
		$arr_tramites = $this->Tramite->listadoCopiasTramites($this->obj_logged_user->getAttr('area_id'), $this->obj_logged_user->getID());
	
		$arr_areas = $this->Area->findObjects('all',array(
				'conditions'=>array('Area.estado !=' => 0, 'Area.id !=' => $this->obj_logged_user->getAttr('area_id')),
				'order'=> array('Area.created desc')));
	
		$this->set(compact('arr_tramites','arr_areas'));
	}
	
	/**
	 * Ajax Lista tramites
	 * @author Alan Hugo
	 * @version 05 Julio 2015
	 */
	public function ajax_listar() {
		$this->layout = 'ajax';
		$this->loadModel('Area');
		
		$arr_tramites = $this->Tramite->listadoTramitesPendientes($this->obj_logged_user->getAttr('area_id'), $this->obj_logged_user->getID());
		
		$arr_areas = $this->Area->findObjects('all',array(
				'conditions'=>array('Area.estado !=' => 0, 'Area.id !=' => $this->obj_logged_user->getAttr('area_id')),
				'order'=> array('Area.created desc')));
		
		$this->set(compact('arr_tramites','arr_areas'));
	}
	
	/**
	 * Agrega y edita tramites
	 * @author Alan Hugo
	 * @version 05 Julio 2015
	 */
	public function add_edit_tramite($tramite_id=null){
		$this->layout = 'ajax';
		$this->loadModel('SeguimientoTramite');
		$this->loadModel('SeguimientoNrodocumento');
		$this->loadModel('Persona');
		$this->loadModel('TramiteFile');
		
		$list_all_remitentes = $this->Persona->listPersonas();
		$this->set(compact('list_all_remitentes'));

		if($this->request->is('post')  || $this->request->is('put')){
			//debug($this->request);exit();
			if(isset($tramite_id) && intval($tramite_id) > 0){
	
				//update
				$this->Tramite->id = $tramite_id;
				$this->request->data['Tramite']['tipo_tramite'] = $this->request->data['tipo_tramite'];
				$this->request->data['Tramite']['archivado'] = $this->request->data['archivado'];
				
				if(isset($this->request->data['archivado']) && $this->request->data['archivado'] == 1){ //Si check archivar tramite esta en 1
					$estado_inicial = 11; //estado archivado
					$this->request->data['Tramite']['area_id'] = NULL;
					$this->request->data['Tramite']['estimacion_dias'] = NULL;
				}else{
					$estado_inicial = 1; //estado recibido
				}


				$obj_tramite = $this->Tramite->findById($tramite_id);
				$seguimiento_tramite_id = $obj_tramite->SeguimientoTramite[0]->data['SeguimientoTramite']['id'];
	
				if ($this->Tramite->save($this->request->data)) {
					
					//En caso desee modificar estado archivado(11) a recibido(1) y viceversa

					$this->SeguimientoTramite->id = $seguimiento_tramite_id;
					$this->request->data['SeguimientoTramite']['estado_id'] = $estado_inicial;
					$this->SeguimientoTramite->save($this->request->data);

					//Agregar Files al tramite
					$tmp_arr_files_upload = $this->Session->read('tmp_arr_files_upload');
					if(!empty($tmp_arr_files_upload)){
						$this->TramiteFile->updateAll(array('TramiteFile.estado' => 0),array('TramiteFile.tramite_id' => $tramite_id));
						foreach ($tmp_arr_files_upload as $files){
							$this->TramiteFile->create();
							$this->request->data['TramiteFile']['tramite_id'] = $this->Tramite->id;
							$this->request->data['TramiteFile']['file_name'] = $files[0];
							$this->request->data['TramiteFile']['file_size'] = $files[1];
							$this->request->data['TramiteFile']['estado'] = 1;
							$this->TramiteFile->save($this->request->data);
						}
					}
					echo json_encode(array('success'=>true,'msg'=>__('Guardado con &eacute;xito.'),'tramite_id'=>$tramite_id));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Tramite->validationErrors));
					exit();
				}
			}else{
				
				//insert
				$error_validation = "";

				if(isset($this->request->data['archivado']) && $this->request->data['archivado'] == 1){ //Si check archivar tramite esta en 1
					$estado_inicial = 11; //estado archivado
					$this->request->data['Tramite']['area_id'] = NULL;
					$this->request->data['Tramite']['estimacion_dias'] = NULL;
				}else{
					$estado_inicial = 1; //estado recibido
					if($this->request->data['Tramite']['area_id'] == ""){
						$arr_validation['area_id'] = array('Debe seleccionar un &aacute;rea de destino');
						$error_validation = true ;
					}
				}

				if($error_validation == true){
					echo json_encode(array('success'=>false,'msg'=>'No se pudo guardar','validation'=>$arr_validation));
					exit();
				}

				$this->request->data['Tramite']['usuario_id'] = $this->obj_logged_user->getID();
				$this->request->data['Tramite']['tipo_tramite'] = $this->request->data['tipo_tramite'];
				$this->request->data['Tramite']['archivado'] = $this->request->data['archivado'];
				$this->request->data['Tramite']['area_creacion_id'] = $this->obj_logged_user->getAttr('area_id');

				$this->Tramite->create();
				if ($this->Tramite->save($this->request->data)) {
					
					$this->SeguimientoTramite->create();
					$this->request->data['SeguimientoTramite']['tramite_id'] = $this->Tramite->id;
					$this->request->data['SeguimientoTramite']['area_id'] = $this->obj_logged_user->getAttr('area_id');
					$this->request->data['SeguimientoTramite']['usuario_id'] = $this->obj_logged_user->getID();
					$this->request->data['SeguimientoTramite']['estado_id'] = $estado_inicial;//inicia como recibido o archivado
					if ($this->SeguimientoTramite->save($this->request->data)) {
						
						$this->SeguimientoNrodocumento->create();
						$this->request->data['SeguimientoNrodocumento']['tramite_id'] = $this->Tramite->id;
						$this->request->data['SeguimientoNrodocumento']['area_id'] = $this->obj_logged_user->getAttr('area_id');
						
						$total_registros = $this->SeguimientoNrodocumento->find('count', array('conditions' => array('SeguimientoNrodocumento.area_id' => $this->obj_logged_user->getAttr('area_id')))) + 1;
						$codigo_completo = $this->generarCodigo($total_registros);
						$this->request->data['SeguimientoNrodocumento']['nro_documento'] = $codigo_completo;
						$this->SeguimientoNrodocumento->save($this->request->data);
						
						$tramite_id = $this->Tramite->id;
					}
					//Agregar Files al tramite
					$tmp_arr_files_upload = $this->Session->read('tmp_arr_files_upload');
					if(!empty($tmp_arr_files_upload)){
						foreach ($tmp_arr_files_upload as $files){
							$this->TramiteFile->create();
							$this->request->data['TramiteFile']['tramite_id'] = $tramite_id;
							$this->request->data['TramiteFile']['file_name'] = $files[0];
							$this->request->data['TramiteFile']['file_size'] = $files[1];
							$this->request->data['TramiteFile']['estado'] = 1;
							$this->TramiteFile->save($this->request->data);
						}
					}
					echo json_encode(array('success'=>true,'msg'=>__('La Acci&oacute;n fue agregada con &eacute;xito.'),'tramite_id'=>$tramite_id));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Tramite->validationErrors));
					exit();
				}
			}
		}else{
			$this->loadModel('TipoDocumento');
			$this->loadModel('Accione');
			$this->loadModel('Area');
			
			$arr_documentos = $this->TipoDocumento->findObjects('all',array(
					'conditions'=>array('TipoDocumento.estado !=' => 0),
					'order'=> array('TipoDocumento.created desc')));
			$arr_acciones = $this->Accione->findObjects('all',array(
					'conditions'=>array('Accione.estado !=' => 0),
					'order'=> array('Accione.created desc')));
			$arr_areas = $this->Area->findObjects('all',array(
					'conditions'=>array('Area.estado !=' => 0, 'Area.id !=' => $this->obj_logged_user->getAttr('area_id')),
					'order'=> array('Area.created desc')));
			
			if(isset($tramite_id)){
				$obj_tramite = $this->Tramite->findById($tramite_id);
	
				$this->request->data = $obj_tramite->data;
				$this->set(compact('tramite_id','obj_tramite'));
			}
			
			$this->Session->write('tmp_arr_files_upload',array());
			
			$this->set(compact('arr_documentos','arr_acciones','arr_areas'));
		}
	}
	
	/**
	 * Aca se hara el upload file hacia un temporal "app/tmp"
	 * despues la funcion add_edit_tramite copiara de "app/tmp" hacia la ubicacion real
	 */
	public function add_edit_tramite_file($tramite_id=null){
		$this->layout = 'ajax';

		if (!empty($_FILES)) {
			foreach ($_FILES['file']['name'] as $key =>$files){
				$extension = end(explode('.', $_FILES['file']['name'][$key]));
				$tempFile = $_FILES['file']['tmp_name'][$key];
					
				$new_file_name = time().$key.'.'.$extension;
				move_uploaded_file($tempFile,APP.WEBROOT_DIR.'/files/upload/'.$new_file_name);
					
				$tmp_arr_files_upload = $this->Session->read('tmp_arr_files_upload');
				if(!empty($tmp_arr_files_upload)){
					$tmp_arr_files_upload = array_merge($tmp_arr_files_upload, array($_FILES['file']['name'][$key]=>array($new_file_name,$_FILES['file']['size'][$key])));
				}else{
					$tmp_arr_files_upload = array($_FILES['file']['name'][$key]=>array($new_file_name,$_FILES['file']['size'][$key]));
				}
				
				$this->Session->write('tmp_arr_files_upload',$tmp_arr_files_upload);
			}
			//debug($this->Session->read('tmp_arr_files_upload'));
		}
		
		exit();
	}
	
	/**
	 * Agregar files desde seguimiento del tramite
	 */
	public function add_edit_file_to_tramite($tramite_id=null){
		$this->layout = 'ajax';
		
		$this->loadModel('TramiteFile');
		//Agregar Files al tramite
		$tmp_arr_files_upload = $this->Session->read('tmp_arr_files_upload');
		if(!empty($tmp_arr_files_upload)){
			$this->TramiteFile->updateAll(array('TramiteFile.estado' => 0),array('TramiteFile.tramite_id' => $tramite_id));
			foreach ($tmp_arr_files_upload as $files){
				$this->TramiteFile->create();
				$this->request->data['TramiteFile']['tramite_id'] = $tramite_id;
				$this->request->data['TramiteFile']['file_name'] = $files[0];
				$this->request->data['TramiteFile']['file_size'] = $files[1];
				$this->request->data['TramiteFile']['estado'] = 1;
				$this->TramiteFile->save($this->request->data);
			}
		}
		echo json_encode(array('success'=>true,'msg'=>__('El archivo fue agregado con &eacute;xito.'),'tramite_id'=>$tramite_id));
		exit();
	}
	
	public function add_edit_tramite_file_delete($file=null){
		$this->layout = 'ajax';
	
		if (isset($file)) {
			$tmp_arr_files_upload = $this->Session->read('tmp_arr_files_upload');
			unlink(APP.WEBROOT_DIR.'/files/upload/'.$tmp_arr_files_upload[$file][0]);
			unset($tmp_arr_files_upload[$file]);
			$this->Session->write('tmp_arr_files_upload',$tmp_arr_files_upload);
		}
		//debug($this->Session->read('tmp_arr_files_upload'));
		exit();
	}
	
	public function add_edit_tramite_file_edit($tramite_id=null){
		$this->layout = 'ajax';
		header('Content-type: application/json');
		
		$result = array();
		$tmp_arr_files_upload = array();
		if($tramite_id){
			$obj_tramite = $this->Tramite->findById($tramite_id);
			foreach ($obj_tramite->TramiteFile as $obj_tramite_file){
				$files['name'] = $obj_tramite_file->getAttr('file_name');
				$files['size'] = $obj_tramite_file->getAttr('file_size');
				$result[] = $files;
				$tmp_arr_files_upload = array_merge($tmp_arr_files_upload, array($obj_tramite_file->getAttr('file_name')=>array($obj_tramite_file->getAttr('file_name'),$obj_tramite_file->getAttr('file_size'))));
			}
		}
		$this->Session->write('tmp_arr_files_upload',$tmp_arr_files_upload);
		//debug($this->Session->read('tmp_arr_files_upload'));
		echo json_encode($result);
		exit();
	}
	
	/**
	 * Cambia de estado para un eliminado logico
	 * @author Alan Hugo
	 * @version 05 Julio 2015
	 */
	public function delete_tramite(){
		$this->layout = 'ajax';
	
		if($this->request->is('post')){
			$tramite_id = $this->request->data['tramite_id'];
				
			$obj_tramite = $this->Tramite->findById($tramite_id);
			if($obj_tramite->saveField('estado', 0)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				exit();
			}
		}
	}
	
	/**
	 * Derivar Tramite
	 * @author Alan Hugo
	 * @version 12 Julio 2015
	 */
	public function derivar_tramite(){
		$this->layout = 'ajax';
		$this->loadModel('SeguimientoTramite');

		if($this->request->is('post')){
			if(isset($this->request->data['tramite_id']) && $this->request->data['tramite_id']!=''){
				$tramite_id = $this->request->data['tramite_id'];
				if(isset($this->request->data['area_id'])){
					$area_id = $this->request->data['area_id'];
				}else{
					$area_id = 0;
				}
				
				$area_envia_id = $this->request->data['area_derivar_id'];
				$arr_area_copia_id = $this->request->data['area_copia_id'];
				$observacion = $this->request->data['observacion'];
				$obj_tramite = $this->Tramite->findById($tramite_id);
				
				//Guardando data 2 registros en SeguimientoTramite
				$this->SeguimientoTramite->create();
				$this->request->data['SeguimientoTramite']['tramite_id'] = $tramite_id;
				$this->request->data['SeguimientoTramite']['area_id'] = $this->obj_logged_user->getAttr('area_id');
				$this->request->data['SeguimientoTramite']['usuario_id'] = $this->obj_logged_user->getID();
				$this->request->data['SeguimientoTramite']['estado_id'] = 2;//deriva
				$this->request->data['SeguimientoTramite']['observacion'] = $observacion;
				if ($this->SeguimientoTramite->save($this->request->data)) {
					
					$this->SeguimientoTramite->create();
					if($area_id==0){
						$this->request->data['SeguimientoTramite']['area_id'] = $area_envia_id;
					}else{
						$this->request->data['SeguimientoTramite']['area_id'] = $area_id;
					}
					$this->request->data['SeguimientoTramite']['estado_id'] = 3;//envia
					$this->SeguimientoTramite->save($this->request->data);
					
					if(is_array($arr_area_copia_id) && !empty($arr_area_copia_id)){
						$this->SeguimientoTramite->create();
						$this->request->data['SeguimientoTramite']['area_id'] = $this->obj_logged_user->getAttr('area_id');
						$this->request->data['SeguimientoTramite']['estado_id'] = 6;//Deriva copia
						$this->SeguimientoTramite->save($this->request->data);
						
						$this->SeguimientoTramite->create();
						$arr_seguimiento_tramite_copia = array();
						foreach ($arr_area_copia_id as $key => $area_copia_id) {
							$arr_seguimiento_tramite_copia[$key]['SeguimientoTramite']['tramite_id'] = $tramite_id;
							$arr_seguimiento_tramite_copia[$key]['SeguimientoTramite']['usuario_id'] = $this->obj_logged_user->getID();
							$arr_seguimiento_tramite_copia[$key]['SeguimientoTramite']['area_id'] = $area_copia_id;
							$arr_seguimiento_tramite_copia[$key]['SeguimientoTramite']['estado_id'] = 7;//envia copia
						}
						$this->SeguimientoTramite->saveAll($arr_seguimiento_tramite_copia);
					}
					echo json_encode(array('success'=>true,'msg'=>__('Derivado con &eacute;xito.')));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
					exit();
				}
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Usted debe escoger un area.')));
				exit();
			}
		}
		
	}

	/**
	 * Recibir Tramite
	 * @author Alan Hugo
	 * @version 13 Julio 2015
	 */
	public function recibir_tramite(){
		$this->layout = 'ajax';
		$this->loadModel('SeguimientoTramite');
		$this->loadModel('SeguimientoNrodocumento');
		
		if($this->request->is('post')){
			$tramite_id = $this->request->data['tramite_id'];
	
			$obj_tramite = $this->Tramite->findById($tramite_id);
			$this->SeguimientoTramite->create();
			$this->request->data['SeguimientoTramite']['tramite_id'] = $tramite_id;
			$this->request->data['SeguimientoTramite']['area_id'] = $this->obj_logged_user->getAttr('area_id');
			$this->request->data['SeguimientoTramite']['usuario_id'] = $this->obj_logged_user->getID();
			$this->request->data['SeguimientoTramite']['estado_id'] = 1;//recibir
			if ($this->SeguimientoTramite->save($this->request->data)) {
				
				//Guardando y generando Id de documento por tramite en cada area
				$this->SeguimientoNrodocumento->create();
				$this->request->data['SeguimientoNrodocumento']['tramite_id'] = $tramite_id;
				$this->request->data['SeguimientoNrodocumento']['area_id'] = $this->obj_logged_user->getAttr('area_id');
				
				$total_registros = $this->SeguimientoNrodocumento->find('count', array('conditions' => array('SeguimientoNrodocumento.area_id' => $this->obj_logged_user->getAttr('area_id')))) + 1;
				$codigo_completo = $this->generarCodigo($total_registros);
				
				$this->request->data['SeguimientoNrodocumento']['nro_documento'] = $codigo_completo;
				$this->SeguimientoNrodocumento->save($this->request->data);
				
				if($obj_tramite->getAttr('email')!=''){
					$this->loadModel('Area');
					$arr_area_inicio = $obj_tramite->obj_area_inicio();
					$obj_area_inicio = $this->Area->findById($arr_area_inicio['SeguimientoTramite']['area_id']);
					$codigo_completo = $obj_tramite->obj_nro_documento();
					$num_tramite = $obj_area_inicio->getID().'-'.$codigo_completo['SeguimientoNrodocumento']['nro_documento'].'-'.date('Y').' '.$obj_area_inicio->getAttr('sigla');
					$nom_area_inicio = $obj_area_inicio->getAttr('nombre');
					
					$obj_area_actual = $this->Area->findById($this->obj_logged_user->getAttr('area_id'));
					$nom_area_actual = $obj_area_actual->getAttr('nombre');
					$this->Tramite->sendNotificacionEmail($tramite_id, $num_tramite, $nom_area_inicio, $nom_area_actual, $obj_tramite->getAttr('email'), 'Notificacion de cambio de estado de su tramite');
				}
				
				echo json_encode(array('success'=>true,'msg'=>__('Recibido con &eacute;xito.')));
				exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				exit();
			}
		}
	}
	
	/**
	 * Recibir Copia
	 * @author Vladimir T.
	 * @version 06 Agosto 2015
	 */
	public function recibir_copia(){
		$this->layout = 'ajax';
		$this->loadModel('SeguimientoTramite');
		$this->loadModel('SeguimientoNrodocumento');
	
		if($this->request->is('post')){
			$tramite_id = $this->request->data['tramite_id'];
	
			$obj_tramite = $this->Tramite->findById($tramite_id);
			$this->SeguimientoTramite->create();
			$this->request->data['SeguimientoTramite']['tramite_id'] = $tramite_id;
			$this->request->data['SeguimientoTramite']['area_id'] = $this->obj_logged_user->getAttr('area_id');
			$this->request->data['SeguimientoTramite']['usuario_id'] = $this->obj_logged_user->getID();
			$this->request->data['SeguimientoTramite']['estado_id'] = 5;//recibir
			if ($this->SeguimientoTramite->save($this->request->data)) {
	
				//Guardando y generando Id de documento por tramite en cada area
				$this->SeguimientoNrodocumento->create();
				$this->request->data['SeguimientoNrodocumento']['tramite_id'] = $tramite_id;
				$this->request->data['SeguimientoNrodocumento']['area_id'] = $this->obj_logged_user->getAttr('area_id');
	
				$total_registros = $this->SeguimientoNrodocumento->find('count', array('conditions' => array('SeguimientoNrodocumento.area_id' => $this->obj_logged_user->getAttr('area_id')))) + 1;
				$codigo_completo = $this->generarCodigo($total_registros);
	
				$this->request->data['SeguimientoNrodocumento']['nro_documento'] = $codigo_completo;
				$this->SeguimientoNrodocumento->save($this->request->data);
	
				echo json_encode(array('success'=>true,'msg'=>__('Recibido con &eacute;xito.')));
				exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				exit();
			}
		}
	}
	
	/**
	 * Recibir Rechazado
	 * @author Vladimir T.
	 * @version 09 Agosto 2015
	 */
	public function recibir_rechazado(){
		$this->layout = 'ajax';
		$this->loadModel('SeguimientoTramite');
	
		if($this->request->is('post')){
			$tramite_id = $this->request->data['tramite_id'];
	
			$obj_tramite = $this->Tramite->findById($tramite_id);
			$this->SeguimientoTramite->create();
			$this->request->data['SeguimientoTramite']['tramite_id'] = $tramite_id;
			$this->request->data['SeguimientoTramite']['area_id'] = $this->obj_logged_user->getAttr('area_id');
			$this->request->data['SeguimientoTramite']['usuario_id'] = $this->obj_logged_user->getID();
			$this->request->data['SeguimientoTramite']['estado_id'] = 8;//recibido rechazado
			if ($this->SeguimientoTramite->save($this->request->data)) {
	
				echo json_encode(array('success'=>true,'msg'=>__('Recibido con &eacute;xito el documento rechazado.')));
				exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				exit();
			}
		}
	}
	
	/**
	 * Aprobar Tramite
	 * @author Alan Hugo
	 * @version 15 Julio 2015
	 */
	public function aprobar_tramite(){
		$this->layout = 'ajax';
		$this->loadModel('SeguimientoTramite');
	
		if($this->request->is('post')){
			$tramite_id = $this->request->data['tramite_id'];
	
			$obj_tramite = $this->Tramite->findById($tramite_id);
			$this->SeguimientoTramite->create();
			$this->request->data['SeguimientoTramite']['tramite_id'] = $tramite_id;
			$this->request->data['SeguimientoTramite']['area_id'] = $this->obj_logged_user->getAttr('area_id');
			$this->request->data['SeguimientoTramite']['usuario_id'] = $this->obj_logged_user->getID();
			$this->request->data['SeguimientoTramite']['estado_id'] = 4;//aprobado
			if ($this->SeguimientoTramite->save($this->request->data)) {
				echo json_encode(array('success'=>true,'msg'=>__('Aprobado con &eacute;xito.')));
				exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				exit();
			}
		}
	}
	
	/**
	 * Rechazar Tramite
	 * @author Vladimir T.
	 * @version 09 Agosto 2015
	 */
	public function rechazar_tramite(){
		$this->layout = 'ajax';
		$this->loadModel('SeguimientoTramite');
	
		if($this->request->is('post')){
			$tramite_id = $this->request->data['tramite_id'];
			$area_id = $this->request->data['area_id'];
			$observacion = $this->request->data['observacion'];
	
			if($area_id == ''){
				$area_id = $obj_tramite->areaRechazar($this->obj_logged_user);
			}
			
			$obj_tramite = $this->Tramite->findById($tramite_id);
			$this->SeguimientoTramite->create();
			$this->request->data['SeguimientoTramite']['tramite_id'] = $tramite_id;
			$this->request->data['SeguimientoTramite']['area_id'] = $this->obj_logged_user->getAttr('area_id');
			$this->request->data['SeguimientoTramite']['usuario_id'] = $this->obj_logged_user->getID();
			$this->request->data['SeguimientoTramite']['estado_id'] = 9;//derivado rechazado
			$this->request->data['SeguimientoTramite']['observacion'] = $observacion;
			if ($this->SeguimientoTramite->save($this->request->data)) {
				if($obj_tramite->getAttr('area_creacion_id') == $this->obj_logged_user->getAttr('area_id')){
					echo json_encode(array('success'=>true,'msg'=>__('Rechazado con &eacute;xito.')));
					exit();
				}else{
					$this->SeguimientoTramite->create();
					$this->request->data['SeguimientoTramite']['area_id'] = $area_id;
					$this->request->data['SeguimientoTramite']['estado_id'] = 10;//Enviado rechazado
					$this->SeguimientoTramite->save($this->request->data);
					echo json_encode(array('success'=>true,'msg'=>__('Rechazado con &eacute;xito.')));
					exit();
				}
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				exit();
			}
		}
	}
	
	/**
	 * Consultar Tramite
	 * @author Vladimir
	 * @version 18 Julio 2015
	 */
	public function consultar() {
		$this->layout = "externo";
	
	}
	
	public function ajax_consultar_validar() {
		$this->layout = "ajax";
		$this->loadModel('SeguimientoTramite');
		$tramite_id = "";
		if($this->request->is('post')){
			$nro_tramite = $this->request->data['nro_tramite'];
			$nro_tramite = explode('-',$nro_tramite);
			
			$area_id = $nro_tramite[0];
			$nro_doc = $nro_tramite[1];
			$year = substr($nro_tramite[2], 0, 4);
			
			//debug("xxx".$area_id."-".$nro_doc."-".$year);

			$seg_tramite = $this->SeguimientoTramite->SeguimientoByNroDoc($area_id, $nro_doc, $year);
			
			foreach($seg_tramite as $seguimiento){
				$tramite_id = $seguimiento->getAttr('tramite_id');
			}
			
			$obj_tramite = $this->Tramite->findById($tramite_id);
			$tipo_tramite = $obj_tramite->getAttr('tipo_tramite');

			//if(!is_array($seg_tramite) || empty($seg_tramite)){
			/*if(empty($this->obj_logged_user) && $tipo_tramite == 'E'){
				echo json_encode(array('success'=>true,'nro_documento'=>$area_id.'-'.$nro_doc.'-'.$year,'msg'=>__('Exitosamente se encontr&onbsp; su tramite.')));
				exit();
			}elseif($this->obj_logged_user->getID() != "" || !empty($this->obj_logged_user)){
				echo json_encode(array('success'=>true,'nro_documento'=>$area_id.'-'.$nro_doc.'-'.$year,'msg'=>__('Exitosamente se encontr&onbsp; su tramite.')));
				exit();
			}elseif(!is_array($seg_tramite) || empty($seg_tramite)){
				echo json_encode(array('success'=>false,'msg'=>__('N&uacute;mero de expediente no existe.')));
				exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('N&uacute;mero de expediente no existe.')));
				exit();
			}*/
			
			
			if(!is_array($seg_tramite) || empty($seg_tramite)){
				echo json_encode(array('success'=>false,'msg'=>__('N&uacute;mero de expediente no existe.')));
				exit();
			}else{
				if(!empty($this->obj_logged_user)){
					if($tipo_tramite == 'E' || $tipo_tramite == 'I'){
						echo json_encode(array('success'=>true,'nro_documento'=>$area_id.'-'.$nro_doc.'-'.$year,'msg'=>__('Exitosamente se encontr&onbsp; su tramite.')));
						exit();
					}else{
						echo json_encode(array('success'=>false,'msg'=>__('N&uacute;mero de expediente no existe.')));
						exit();
					}
				}else{
					//debug("XXX".$tipo_tramite);
					if($tipo_tramite == 'E'){
						echo json_encode(array('success'=>true,'nro_documento'=>$area_id.'-'.$nro_doc.'-'.$year,'msg'=>__('Exitosamente se encontr&onbsp; su tramite.')));
						exit();
					}else{
						echo json_encode(array('success'=>false,'msg'=>__('N&uacute;mero de expediente no existe.')));
						exit();
					}
				}
			}
		}
	}
	
	public function ajax_consultar($nro_tramite) {
		$this->layout = "ajax";
		$this->loadModel('SeguimientoTramite');
		$this->loadModel('Area');
		if(isset($nro_tramite)){			
			$nro_tramite = explode('-',$nro_tramite);
			
			$area_id = $nro_tramite[0];
			$nro_doc = $nro_tramite[1];
			$year = substr($nro_tramite[2], 0, 4);
	
			$arr_obj_seg_tramite = $this->SeguimientoTramite->SeguimientoByNroDoc($area_id, $nro_doc, $year);
			$obj_area = $this->Area->findById($area_id);
		}
	
		$this->set(compact('arr_obj_seg_tramite','nro_doc','year','obj_area'));
	}
	
	
	/**
	 * generar Código
	 * @author Vlady
	 * @version 17 Jul 2015
	 */
	function generarCodigo($num){
		if(isset($num)){
			
			$codigo = str_pad($num, 4, "0", STR_PAD_LEFT);
			//$string_complement = " DEPG-UDCH".date('Y');
				
			$codigo_completo = $codigo;
		}
	
		return $codigo_completo;
	}
	
	/**
	 * Listas las areas disponibles para derivar
	 * @author Alan Hugo
	 * @version 21 Julio 2015
	 */
	public function ajax_modal_area($tramite_id,$mas_una_recibido = null) {
		$this->layout = "ajax";
		$this->loadModel('SeguimientoTramite');
		$this->loadModel('Area');
	
		if(isset($tramite_id)){
			
			$arr_seg_tramite = $this->SeguimientoTramite->find('all',array('fields'=>'area_id',
					'conditions'=>array('SeguimientoTramite.tramite_id' => $tramite_id),'group'=>array('SeguimientoTramite.area_id')));

			foreach($arr_seg_tramite as $key => $seg_tramite){
				$arr_id_area_seguimiento[$key] = $seg_tramite['SeguimientoTramite']['area_id'];
			}
			$arr_id_area_seguimiento[$key+1] = $this->obj_logged_user->getAttr('area_id');
			
			$obj_tramite = $this->Tramite->findById($tramite_id);
			$arr_id_area_seguimiento[$key+2] = $obj_tramite->getAttr('area_id');

			$arr_areas = $this->Area->findObjects('all',array(
					'conditions'=>array('Area.estado !=' => 0, 'Area.id !=' =>$arr_id_area_seguimiento),
					'order'=> array('Area.nombre desc')));
		}
		
		$this->set(compact('arr_areas','mas_una_recibido'));
	}
	
	/**
	 * Listas las areas disponibles para derivar rechazado
	 * @author Alan Hugo
	 * @version 18 Octubre 2015
	 */
	public function ajax_modal_area_rechazado($tramite_id) {
		$this->layout = "ajax";
		$this->loadModel('SeguimientoTramite');
		$this->loadModel('Area');
	
		$arr_areas_derivar = array();
		if(isset($tramite_id)){
			
			$arr_seg_tramite = $this->SeguimientoTramite->find('all',array('fields'=>'area_id',
					'conditions'=>array('SeguimientoTramite.tramite_id' => $tramite_id),'group'=>array('SeguimientoTramite.area_id')));

			foreach($arr_seg_tramite as $key => $seg_tramite){
				$arr_id_area_seguimiento[$key] = $seg_tramite['SeguimientoTramite']['area_id'];
			}
			$arr_id_area_seguimiento[$key+1] = $this->obj_logged_user->getAttr('area_id');
			
			$obj_tramite = $this->Tramite->findById($tramite_id);
			$arr_id_area_seguimiento[$key+2] = $obj_tramite->getAttr('area_id');

			$arr_areas_derivar = $this->Area->findObjects('all',array(
					'conditions'=>array('Area.estado !=' => 0, 'Area.id' =>$arr_id_area_seguimiento, 'Area.id !=' => $this->obj_logged_user->getAttr('area_id')),
					'order'=> array('Area.nombre desc')));
		}

		$this->set(compact('arr_areas_derivar'));
	}

	/**
	 * Mostrar la observación del área que hizo la derivación
	 * @author Vladimir TM
	 * @version 23 Julio 2015
	 */
	public function ajax_modal_observacion($tramite_id, $area_id) {
		$this->layout = "ajax";
		$this->loadModel('SeguimientoTramite');
	
		if(isset($tramite_id) && isset($area_id)){
				
			$arr_seg_tramite = $this->SeguimientoTramite->find('all',array(
					'fields'=>'observacion',
					'conditions'=>array(
							'AND' => array(
										'SeguimientoTramite.tramite_id' => $tramite_id,
										'SeguimientoTramite.area_id' => $area_id,
										'SeguimientoTramite.estado_id' => 3,
									)
							)
					)
				);
			
		}
	
		$this->set(compact('arr_seg_tramite'));
	}
	
	/**
	 * Mostrar la observación del área que hizo el rechazo
	 * @author Vladimir TM
	 * @version 08 Sept 2015
	 */
	public function ajax_modal_observacion_devuelto($tramite_id, $area_id) {
		$this->layout = "ajax";
		$this->loadModel('SeguimientoTramite');
	
		if(isset($tramite_id) && isset($area_id)){
	
			$arr_seg_tramite = $this->SeguimientoTramite->find('all',array(
					'fields'=>'observacion',
					'conditions'=>array(
							'AND' => array(
									'SeguimientoTramite.tramite_id' => $tramite_id,
									'SeguimientoTramite.area_id' => $area_id,
									'SeguimientoTramite.estado_id' => 10,
							)
					)
			)
			);
				
		}
	
		$this->set(compact('arr_seg_tramite'));
	}
	
	public function buscar_tramite(){
		$this->loadModel('Area');
		$obj_area = $this->Area->findById($this->obj_logged_user->getAttr('area_id'));
		$this->set(compact('obj_area'));
	}
	
	public function monitoreo(){
		
	}
	
	/**
	 * AJax que muestra el buscador de tramite
	 * @author Alan Hugo
	 * @version 21 Agosto 2015
	 */
	public function ajax_search_monitoreo() {
		$this->layout = "ajax";
		$this->loadModel('SeguimientoTramite');
	
		//debug($this->request->data);
		
		$arr_tramites = array();
		$arr_conditions = array();
		
		$criterio = array();
		if (isset($this->request->data['Tramite']['filtro'])){
			$criterio = $this->request->data['Tramite']['filtro'];
			$arr_conditions['Tramite.estado !='] = 0;
			$arr_conditions['SeguimientoTramiteJoin.area_id'] = $this->obj_logged_user->getAttr('area_id');
		}
		
		if (in_array('f',$criterio)) {
			$fecha_inicio = $this->request->data['Tramite']['fecha_inicio'];
			$fecha_fin = $this->request->data['Tramite']['fecha_fin'];
			$arr_conditions['SeguimientoTramiteJoin.created >='] = date("Y-m-d", strtotime($fecha_inicio)).' 00:00:00';
			$arr_conditions['SeguimientoTramiteJoin.created <='] = date("Y-m-d", strtotime($fecha_fin)).' 59:59:59';
		}
		
		if (in_array('a',$criterio)) {
			$asunto = $this->request->data['Tramite']['asunto'];
			$arr_conditions['Tramite.asunto like'] = "%".trim($asunto)."%";
		}
		
		if (in_array('d',$criterio)) {
			$descripcion = $this->request->data['Tramite']['descripcion'];
			$arr_conditions['Tramite.descripcion like'] = "%".trim($descripcion)."%";
		}
		
		if (in_array('t',$criterio)) {
			$tipo_tramite = $this->request->data['Tramite']['tipo_tramite'];
			$arr_conditions['Tramite.tipo_tramite ='] = $tipo_tramite;
		}
		
		if (in_array('e',$criterio)) {
			$arr_estado = $this->request->data['Tramite']['estado'];
			if (in_array('r',$arr_estado)) {
				$arr_conditions['Tramite.estado_id'] = array(1);
			}
			if (in_array('d',$arr_estado)) {
				$arr_conditions['Tramite.estado_id'] = array(2,6,9);
			}
			if (in_array('a',$arr_estado)) {
				$arr_conditions['Tramite.estado_id'] = array(4);
			}
			if (in_array('u',$arr_estado)) {
				$arr_conditions['Tramite.estado_id'] = array(8,9,10);
			}
		}
		
		//debug($arr_conditions);
		if(($this->request->is('post')  || $this->request->is('put')) && !empty($criterio)){
			$arr_tramites = $this->Tramite->findObjects('all',array(
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
					'conditions'=> $arr_conditions,
					'order'=> array('Tramite.created desc'),
					'group' => 'Tramite.id'
					));
		}
		
		$this->set(compact('arr_tramites'));
	}

	public function add_combo_area_copy(){
		$this->loadModel('Area');
		$this->layout = "ajax";

		$arr_areas = $this->Area->findObjects('all',array(
				'conditions'=>array('Area.estado !=' => 0, 'Area.id !=' => $this->obj_logged_user->getAttr('area_id')),
				'order'=> array('Area.created desc')));
		
		$this->set(compact('arr_areas'));
	}
	
	public function descargar($id){
		
		$enlace = ENV_WEBROOT_FULL_URL."/files/upload/".$id; 

				$sDocumento = base64_decode($enlace);
	
				$archivo = explode('/', base64_decode($enlace));
	
				$rev = array_reverse($archivo);
	
				$nombre = $rev[0];
	
	
	
				if (file_exists($sDocumento))
				{
					header("Content-type: application/force-download");
					header("Content-Disposition: attachment;filename=".basename($id));
					header("Content-Transfer-Encoding: binary");
					header("Content-Length: ".filesize($sDocumento));
					readfile($sDocumento);
				}

			//exit();
	}
}
?>