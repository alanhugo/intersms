<?php
App::uses('AppModel','Model');
class Command extends AppModel {

    function beforeFilter() {
        parent::beforeFilter();
    }
    
    public $useTable = 'commands';
    public $primaryKey = 'IDCommand';
    
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
    		'Command'    => array(
    				'notempty' => array(
    						'rule' => array('notEmpty'),
    						'message' => 'El Nombre es requerido'
    				)
    		),
            'FlagCMD'    => array(
                    'notempty' => array(
                            'rule' => array('notEmpty'),
                            'message' => 'FlagCMD es requerido'
                    ),
                    'isUnique' => array(
                        'rule' => 'isUnique',
                        'message' => 'El FlagCMD ya esta siendo utilizado'
                    )
            ),
            'PhoneID'    => array(
                    'notempty' => array(
                            'rule' => array('notEmpty'),
                            'message' => 'FlagCMD es requerido'
                    )
            ),
    );
}
?>