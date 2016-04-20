<?php
class UsuariosController extends AppController{

	public $name = 'Usuarios';

	public function beforeFilter(){
		$this->Auth->allow(array('login','logout'));
		$this->layout = "default";
		parent::beforeFilter();
	}

	public function login() {
		$this->layout = "login";

		if($this->request->is('post')) {
			if($this->Auth->login()) {
				$this->request->data['Usuario']['id'] = $this->Auth->user('id');
				$this->request->data['Usuario']['ultimo_acceso'] = date('Y-m-d H:i:s');
				$this->Usuario->save($this->request->data);
				$this->redirect($this->Auth->redirectUrl());
			} else {
				$this->Session->setFlash(__('El Usuario o Contrase&ntilde;a es Incorrecto'),array(),'auth');
			}
		}else{
			if($this->Auth->user('id')){
				$this->redirect($this->Auth->redirect());
			}
		}
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}
	
	/**
	 * Lista usuarios
	 * @author Alan Hugo
	 * @version 07 Julio 2015
	 */
	public function index() {
		if($this->obj_logged_user->getAttr('tipo_usuario_id') == 2) {
        	$this->redirect(array('controller' => 'errors', 'action' => 'error_404'));
			exit();
        }
		
		$arr_usuarios = $this->Usuario->findObjects('all',array(
				'conditions'=>array('Usuario.estado !=' => 0, 'Usuario.id !=' => array($this->obj_logged_user->getID(), 1, 2)),
				'order'=> array('Usuario.created desc')));
		
		$this->set(compact('arr_usuarios'));
	}
	
	/**
	 * Ajax Lista usuarios
	 * @author Alan Hugo
	 * @version 07 Julio 2015
	 */
	public function ajax_listar() {
		$this->layout = 'ajax';
		$arr_usuarios = $this->Usuario->findObjects('all',array(
				'conditions'=>array('Usuario.estado !=' => 0, 'Usuario.id !=' => array($this->obj_logged_user->getID(), 1)),
				'order'=> array('Usuario.created desc')));
	
		$this->set(compact('arr_usuarios'));
	}
	
	/**
	 * Agrega y edita usuarios
	 * @author Alan Hugo
	 * @version 05 Julio 2015
	 */
	public function add_edit_usuario($usuario_id=null){
		$this->layout = 'ajax';
	
		if($this->request->is('post')  || $this->request->is('put')){
			if(isset($usuario_id) && intval($usuario_id) > 0){
	
				//update
				$this->Usuario->id = $usuario_id;
				
				if($this->request->data['Usuario']['foto']['name'] != ''){
					$imagen = $this->request->data['Usuario']['foto']['name'];
					$arr = explode(".", $imagen);
					$extension = strtolower(array_pop($arr));
					$new_file_name = time().'.'.$extension;
						
					$this->request->data['Usuario']['foto'] = $new_file_name;
						
					$uploaddir = APP.WEBROOT_DIR.'/files/fotos_usuario/';
					$uploadfile = $uploaddir . basename($new_file_name);
				
					move_uploaded_file($_FILES['data']['tmp_name']['Usuario']['foto'], $uploadfile);
				
				}else{
					unset($this->request->data['Usuario']['foto']);
				}
	
				if ($this->Usuario->save($this->request->data['Usuario'])) {
					echo json_encode(array('success'=>true,'msg'=>__('Guardado con &eacute;xito.'),'usuario_id'=>$usuario_id));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Usuario->validationErrors));
					exit();
				}
			}else{
	
				//insert
				$this->request->data['Usuario']['ultimo_acceso'] = '0000-00-00';
				
				if($this->request->data['Usuario']['foto']['name'] != ''){
					$this->request->data['Usuario']['foto'] = $this->request->data['Usuario']['foto']['name'];
				
					//$image_tmp = $this->request->data['Usuario']['foto']['tmp_name'];
					$uploaddir = APP.WEBROOT_DIR.'/files/fotos_usuario/';
					$uploadfile = $uploaddir . basename($_FILES['data']['name']['Usuario']['foto']);
				
					move_uploaded_file($_FILES['data']['tmp_name']['Usuario']['foto'], $uploadfile);
				
				}else{
					unset($this->request->data['Usuario']['foto']);
					
					$this->request->data['Usuario']['foto'] = "usuario_default.png";
				}

				if ($this->Usuario->save($this->request->data['Usuario'])) {
					$usuario_id = $this->Usuario->id;
					echo json_encode(array('success'=>true,'msg'=>__('El usuario fue agregado con &eacute;xito.'),'usuario_id'=>$usuario_id));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Usuario->validationErrors));
					exit();
				}
			}
		}else{
			if(isset($usuario_id)){
				$obj_usuario = $this->Usuario->findById($usuario_id);
	
				$this->request->data = $obj_usuario->data;
				$this->set(compact('usuario_id','obj_usuario'));
			}
		}
	}
	
	/**
	 * Cambia de estado para un eliminado logico
	 * @author Alan Hugo
	 * @version 07 Julio 2015
	 */
	public function delete_usuario(){
		$this->layout = 'ajax';
	
		if($this->request->is('post')){
			$usuario_id = $this->request->data['usuario_id'];
	
			$obj_usuario = $this->Usuario->findById($usuario_id);
			if($obj_usuario->saveField('estado', 0)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				exit();
			}
		}
	
	}
	
	public function change_password(){
		$this->layout = 'ajax';
		
		if($this->request->is('post')){
			$usuario_id = $this->request->data['usuario_id'];
			$password = $this->request->data['password'];
			
			$new_pass_hash= AuthComponent::password($password);
			$obj_user = $this->Usuario->findById($usuario_id);
			
			if($obj_user->saveField('password', $new_pass_hash)){
				echo json_encode(array('success'=>true,'msg'=>__('Su constrase&ntilde;a fue cambiada con &eacute;xito')));
				exit();
			}else{
				echo json_encode(array('success' =>false, 'msg' => __('No se pudo guardar')));
				exit();
			}
		}
	}
	
}
?>