<?php
class PhonesclientsController extends AppController{
    
    public $name = 'Phonesclients';

    public function beforeFilter(){
		$this->layout = "default";
		parent::beforeFilter();
	}
	
	/**
	 * Lista de grupos cmd
	 * @author Alan Hugo
	 * @version 20 Abril 2015
	 */
	public function index() {
		$arr_phonesclients = $this->Phonesclient->findObjects('all',array(
				'conditions'=>array('Phonesclient.Status !=' => 0),
				'order'=> array('Phonesclient.created desc')));
		
		$this->set(compact('arr_phonesclients'));
	}

	/**
	 * Ajax Lista grupos
	 * @author Alan Hugo
	 * @version 07 Julio 2015
	 */
	public function ajax_listar() {
		$this->layout = 'ajax';
		$arr_phonesclients = $this->Phonesclient->findObjects('all',array(
				'conditions'=>array('Phonesclient.Status !=' => 0),
				'order'=> array('Phonesclient.created desc')));
	
		$this->set(compact('arr_phonesclients'));
	}

	/**
	 * Agrega y edita grupos
	 * @author Alan Hugo
	 * @version 05 Julio 2015
	 */
	public function add_edit_arr_phonesclient($phonesclient_id=null){
		$this->layout = 'ajax';
	
		if($this->request->is('post')  || $this->request->is('put')){
			if(isset($phonesclient_id) && intval($phonesclient_id) > 0){

				//update
				$this->request->data['Phonesclient']['IDPhoneclient'] = $phonesclient_id;
				if ($this->Phonesclient->save($this->request->data)) {
					echo json_encode(array('success'=>true,'msg'=>__('Guardado con &eacute;xito.'),'phonesclient_id'=>$phonesclient_id));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Phonesclient->validationErrors));
					exit();
				}
			}else{
	
				//insert
				$this->request->data['Phonesclient']['IDUser'] = $this->obj_logged_user->getID();		
				if ($this->Phonesclient->save($this->request->data)) {
					$phonesclient_id = $this->Phonesclient->IDPhoneclient;
					echo json_encode(array('success'=>true,'msg'=>__('El grupo fue agregado con &eacute;xito.'),'phonesclient_id'=>$phonesclient_id));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Phonesclient->validationErrors));
					exit();
				}
			}
		}else{
			if(isset($phonesclient_id)){
				$obj_phonesclient = $this->Phonesclient->findBy('IDPhoneclient', $phonesclient_id);
				$this->request->data = $obj_phonesclient->data;
				$this->set(compact('phonesclient_id','obj_phonesclient'));
			}
		}
	}

	/**
	 * Cambia de estado para un eliminado logico
	 * @author Alan Hugo
	 * @version 07 Julio 2015
	 */
	public function delete_phonesclient(){
		$this->layout = 'ajax';
	
		if($this->request->is('post')){
			$phonesclient_id = $this->request->data['phonesclient_id'];
	
			$obj_phonesclient = $this->Phonesclient->findBy('IDPhoneclient', $phonesclient_id);
			if($obj_phonesclient->saveField('Status', 0)){
				echo json_encode(array('success'=>true,'msg'=>__('Eliminado con &eacute;xito.')));
				exit();
			}else{
				echo json_encode(array('success'=>false,'msg'=>__('Error inesperado.')));
				exit();
			}
		}
	
	}
}
?>