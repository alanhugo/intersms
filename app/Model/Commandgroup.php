<?php
App::uses('AppModel','Model');
class Commandgroup extends AppModel {

    function beforeFilter() {
        parent::beforeFilter();
    }
    
    public $useTable = 'commandgroup';
    public $primaryKey = 'IDCommandgroup';
    
    public $belongsTo = array(
    		'Usuario' => array(
    				'className' => 'Usuario',
    				'foreignKey' => 'IDUser',
    				'conditions' => '',
    				'fields' => '',
    				'order' => ''
    		)
    );
    
}
?>