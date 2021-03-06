<?php
class CommandsController extends AppController{

	public $name = 'Commands';

	public function beforeFilter(){
		$this->layout = "default";
		parent::beforeFilter();
	}
	
	/**
	 * Lista de comandos
	 * @author Alan Hugo
	 * @version 23 Abril 2015
	 */
	public function index() {
		$arr_commands = $this->Command->findObjects('all',array(
				'conditions'=>array('Command.Status !=' => 0),
				'order'=> array('Command.created asc')));
		
		$this->set(compact('arr_commands'));
	}

	/**
	 * Ajax Lista comandos
	 * @author Alan Hugo
	 * @version 23 Abril 2015
	 */
	public function ajax_listar() {
		$this->layout = 'ajax';
		$arr_commands = $this->Command->findObjects('all',array(
				'conditions'=>array('Command.Status !=' => 0),
				'order'=> array('Command.created asc')));
	
		$this->set(compact('arr_commands'));
	}

	/**
	 * Agrega y edita comandos
	 * @author Alan Hugo
	 * @version 23 Abril 2015
	 */
	public function add_edit_command($command_id=null){
		$this->layout = 'ajax';
	
		if($this->request->is('post')  || $this->request->is('put')){
			if(isset($command_id) && intval($command_id) > 0){

				//update
				$this->request->data['Command']['IDCommand'] = $command_id;
				if ($this->Command->save($this->request->data)) {
					$this->loadModel('Commandgroup');
					$this->Commandgroup->deleteAll($command_id);

					$arr_commandsgroup = array();
					if(isset($this->request->data['Groupcmd']['IDGroup'])){
						foreach ($this->request->data['Groupcmd']['IDGroup'] as $key => $value) {
							$arr = array("IDCommand" => $command_id, "IDGroup" => $value, "IDUser" => $this->obj_logged_user->getID());
							$arr_commandsgroup[$key] = $arr;
						}
					}
					//debug($arr_commandsgroup);exit();
					$this->Commandgroup->saveAll($arr_commandsgroup);
					echo json_encode(array('success'=>true,'msg'=>__('Guardado con &eacute;xito.'),'command_id'=>$command_id));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Command->validationErrors));
					exit();
				}
			}else{
	
				//insert
				$this->request->data['Command']['IDUser'] = $this->obj_logged_user->getID();		
				if ($this->Command->save($this->request->data)) {
					$command_id = $this->Command->IDCommand;
					echo json_encode(array('success'=>true,'msg'=>__('El comando fue agregado con &eacute;xito.'),'command_id'=>$command_id));
					exit();
				}else{
					echo json_encode(array('success'=>false,'msg'=>__('Su informaci&oacute;n es incorrecta'),'validation'=>$this->Command->validationErrors));
					exit();
				}
			}
		}else{
			if(isset($command_id)){
				$this->loadModel('Commandgroup');
				$this->loadModel('Groupcmd');

				$arr_obj_commandgroup = $this->Commandgroup->find('all',
					array('conditions'=>array('Commandgroup.IDCommand' => $command_id)));

				$arr_commandgroup_idgroup = array();
				foreach ($arr_obj_commandgroup as $key => $obj_commandgroup) {
					$arr_commandgroup_idgroup[] = $obj_commandgroup['Commandgroup']['IDGroup'];
				}

				$arr_obj_groupcmds = $this->Groupcmd->findObjects('all',array(
					'conditions'=>array('Groupcmd.Status !=' => 0),
					'order'=> array('Groupcmd.DGroup desc')));

				$obj_command = $this->Command->findBy('IDCommand', $command_id);
				$this->request->data = $obj_command->data;
				$this->set(compact('command_id','obj_command','arr_obj_groupcmds','arr_commandgroup_idgroup'));
			}else{
				
				$this->loadModel('Groupcmd');
				$arr_commandgroup_idgroup = array();
				$arr_obj_groupcmds = $this->Groupcmd->findObjects('all',array(
					'conditions'=>array('Groupcmd.Status !=' => 0),
					'order'=> array('Groupcmd.DGroup desc')));
				$this->set(compact('arr_obj_groupcmds','arr_commandgroup_idgroup'));
			}
		}
	}

	/**
	 * Cambia de estado para un eliminado logico
	 * @author Alan Hugo
	 * @version 23 Abril 2015
	 */
	public function delete_command(){
		$this->layout = 'ajax';
	
		if($this->request->is('post')){
			$command_id = $this->request->data['command_id'];
	
			$obj_command = $this->Command->findBy('IDCommand', $command_id);
			if($obj_command->saveField('Status', 0)){
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