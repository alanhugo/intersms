<?php
App::uses('AppModel','Model');
  class Usuario extends AppModel {
	public $name = 'Usuario';
    
    function beforeFilter() {
    	parent::beforeFilter();
    }
    
    public function beforeSave($options = array()) {
    	/* password hashing */
    	if (isset($this->data[$this->alias]['password'])) {
    		$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
    	}
    	return true;
    }
    
    public $validate = array(
    		'username'    => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'El Username es requerido'
    				),
    				'unique' => array(
    						'rule' => array('isUnique'),
    						'message' => 'El Username ya existe'
    				)
    		),
    		'password'    => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'El Password es requerido',
    						'on' => 'create'
    				),
    				'length' => array(
    						'rule' => array('between', 6, 60),
    						'message' => 'El password debe tener entre 6 y 60 caracteres.',
    						'on' => 'create'
    				),
    		)
    );
	
	public function checkPasswordForUser($user_id, $current_pass = null){
    	$obj_user = $this->findById($user_id);

    	$old_pass = $obj_user ->getAttr('password');
    	$current_pass_hash = AuthComponent::password($current_pass);

    
    	if($current_pass_hash == $old_pass){
    		return true;
    	}
    	return false;
    }
    
    public function hashPasswords($data) {
    	if (isset($data['Usuario']['password'])) {
    		$data['Usuario']['password'] = md5($data['Usuario']['password']);
    		return $data;
    	}
    	return $data;
    }
  }
?>
