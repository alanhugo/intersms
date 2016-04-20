<?php
class CommandsController extends AppController{

	public $name = 'Commands';

	public function beforeFilter(){
		$this->layout = "default";
		parent::beforeFilter();
	}
	
	/**
	 * Lista comandos
	 * @author Alan Hugo
	 * @version 20 Abril 2015
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
}
?>