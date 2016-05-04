<?php
App::uses('AppModel','Model');
class Phonesgroup extends AppModel {

    function beforeFilter() {
        parent::beforeFilter();
    }
    
    public $useTable = 'phonesgroup';
    public $primaryKey = 'IDphonesgroup';
    
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
