<?php
class GroupcmdsController extends AppController{
    
    public $name = 'Groupcmds';

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
		$arr_groupcmds = $this->Groupcmd->findObjects('all',array(
				'conditions'=>array('Groupcmd.Status !=' => 0),
				'order'=> array('Groupcmd.created desc')));
		
		$this->set(compact('arr_groupcmds'));
	}

	/**
	 * Ajax Lista grupos
	 * @author Alan Hugo
	 * @version 07 Julio 2015
	 */
	public function ajax_listar() {
		$this->layout = 'ajax';
		$arr_groupcmds = $this->Groupcmd->findObjects('all',array(
				'conditions'=>array('Groupcmd.Status !=' => 0),
				'order'=> array('Groupcmd.created desc')));
	
		$this->set(compact('arr_groupcmds'));
	}

	/**
	 * Agrega y edita grupos
	 * @author Alan Hugo
	 * @version 05 Julio 2015
	 */
	public function add_edit_groupcmd($groupcmd_id=null){
		$this->layout = 'ajax';
	
		if($this->request->is('post')  || $this->request->is('put')){
			if(isset($groupcmd_id) && intval($groupcmd_id) > 0){

				//update
				$this->request->data['Groupcmd']['IDGroup'] = $groupcmd_id;
				if ($this->Groupcmd->save($this->request->data['Groupcmd'])) {
					echo json_encode(array('success'=>true,'msg'=>__('Guardado con &eacute;xito.'),'groupcmd_id'=>$groupcmd_id));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Groupcmd->validationErrors));
					exit();
				}
			}else{
	
				//insert
				$this->request->data['Groupcmd']['IDUser'] = $this->obj_logged_user->getID();		
				if ($this->Groupcmd->save($this->request->data['Groupcmd'])) {
					$groupcmd_id = $this->Groupcmd->IDGroup;
					echo json_encode(array('success'=>true,'msg'=>__('El grupo fue agregado con &eacute;xito.'),'groupcmd_id'=>$groupcmd_id));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Groupcmd->validationErrors));
					exit();
				}
			}
		}else{
			if(isset($groupcmd_id)){
				$obj_groupcmd = $this->Groupcmd->findBy('IDGroup', $groupcmd_id);
				$this->request->data = $obj_groupcmd->data;
				$this->set(compact('groupcmd_id','obj_groupcmd'));
			}
		}
	}

	/**
	 * Cambia de estado para un eliminado logico
	 * @author Alan Hugo
	 * @version 07 Julio 2015
	 */
	public function delete_groupcmd(){
		$this->layout = 'ajax';
	
		if($this->request->is('post')){
			$groupcmd_id = $this->request->data['groupcmd_id'];
	
			$obj_groupcmd = $this->Groupcmd->findBy('IDGroup', $groupcmd_id);
			if($obj_groupcmd->saveField('Status', 0)){
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