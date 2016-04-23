<?php
App::uses('AppModel','Model');
class Groupcmd extends AppModel {

    function beforeFilter() {
        parent::beforeFilter();
    }
    
    public $useTable = 'groupcmd';
    public $primaryKey = 'IDGroup';
    
    public $belongsTo = array(
    		'Usuario' => array(
    				'className' => 'Usuario',
    				'foreignKey' => 'IDUser',
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
