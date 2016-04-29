<?php
App::uses('AppModel','Model');
class Phonesclient extends AppModel {

    function beforeFilter() {
        parent::beforeFilter();
    }
    
    public $useTable = 'phonesclients';
    public $primaryKey = 'IDPhoneclient';
    
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
    		'PhoneNumber'    => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'El PhoneNumber es requerido'
    				)
    		),
            'UserPhone'    => array(
                    'notempty' => array(
                            'rule' => array('notEmpty'),
                            'message' => 'El UserPhone es requerido'
                    )
            )
    );
}
?>
