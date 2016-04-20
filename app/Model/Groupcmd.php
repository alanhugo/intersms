<?php
App::uses('AppModel','Model');
  class Groupcmd extends AppModel {

    public $belongsTo = array(
    		'Usuario' => array(
    				'className' => 'Usuario',
    				'foreignKey' => 'usuario_id',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		)
    );
    
    public $validate = array(
    		'name'    => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'El Nombre es requerido'
    				)
    		)
    );
    
  }
?>
