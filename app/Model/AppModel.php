<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');
App::uses('CakeTime', 'Utility');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model { 

	public $recursive = -1;

	/**
	* Include a Model, create an empty object and return the instance.
	* @param string $modelClassName -> Name of the model that you want to load
	* @return Model
	*/
	protected function &loadModel($modelClassName){
		ClassRegistry::removeObject($modelClassName);
			
		if(ClassRegistry::getObject($modelClassName)){
			$model = ClassRegistry::getObject($modelClassName);
			//$model->locale = $this->getSessionLanguage();
			return $model;
		}else{
			unset($this->$modelClassName);
			if(isset($this->{$modelClassName}) && is_object($this->$modelClassName)){
				$model = $this->$modelClassName;
				//$model->locale = $this->getSessionLanguage();
				return $model;
			}
			$x = ClassRegistry::init($modelClassName);
			$this->$modelClassName = $x;
			$model = $this->$modelClassName;
			//$model->locale = $this->getSessionLanguage();
			return $model;
		}
	}
	
	/**
	* Return an array with objects populated with the data provided on the parameter
	* 
	* @param array $data -> Data fetched using $this->find
	* @param int $buildBelongingObjects Defines if associated models(belongsTo) have to be instanciated as well.
	*          (
	*              0 => It is not instanciated any related model
	*              1 => The direct related models are instanciated
	*              2 => The related models of related models are instanciate 
	*          )
	* 
	* @return Model
	*/
	protected function buildObjectList($data, $buildBelongingObjects = 0){
		if(is_array($data)){
			$arrReturn = array();
			foreach($data as $key => $value){
				$arrReturn[] = $this->buildObject($value,$buildBelongingObjects);
			}
		}else{
			return true;
		}
		
		return $arrReturn;
	}
	
	/**
	* Return a populated object with the data provided on the parameter
	*
	* @param array $data -> Data fetched using $this->find
	* @param int $buildBelongingObjects Defines if associated models(belongsTo) have to be instanciated as well.
	*          (
	*              0 => It is not instanciated any related model
	*              1 => The direct related models are instanciated
	*              2 => The related models of related models are instanciate
	*          )
	*
	* @return Model
	*/
	protected function buildObject($data, $buildBelongingObjects = 0, $className = null){
		$tmpObject = clone $this;
		if($className && count($data[$className]) > 0){
			$tmpObject->data[$this->alias]   = $data[$className];
			$tmpObject->id					 = $data[$className][$tmpObject->primaryKey];
		}else{
			$tmpObject->data[$this->alias]   = $data[$this->alias];
			$tmpObject->id					 = $data[$this->alias][$tmpObject->primaryKey];	
		}
		
		if($buildBelongingObjects > 0){
			if($buildBelongingObjects > 0){
				$buildBelongingObjects--;
			}
			foreach($this->belongsTo as $key => $value){
			
				if(isset($data[$key])){
					$belongObj = $this->loadModel($value['className']);
					$tmpObject->$key = $belongObj->buildObject($data,$buildBelongingObjects,$key);
				}   
			
			}
			
			foreach($this->hasOne as $key => $value){
				if(isset($data[$key])){
					$hasOneObj = $this->loadModel($value['className']);
					$tmpObject->$key = $hasOneObj->buildObject($data,$buildBelongingObjects,$key);
				}
			}
			
		}else{
			$belongsToAlias = array();
			foreach($this->belongsTo as $key => $value){
				$belongsToAlias[] = $key;
			}

			$hasOneAlias = array();
			foreach($this->hasOne as $key => $value){
				$hasOneAlias[] = $key;
			}

			foreach($tmpObject as $k => $v){
				if(is_object($v) && isset($v->alias) && (in_array($v->alias,$belongsToAlias) || in_array($v->alias,$hasOneAlias))){
					unset($tmpObject->$k);
				}
			}
			
			
		}
		
		return $tmpObject;
	}
	
	function findObjects($type='first', $query=array(),$buildBelongingObjects=0){
		if($buildBelongingObjects == 0){
			$query['recursive'] = -1;
		}
		if(!isset($query['recursive'])){
			$query['recursive'] = 0;
		}
		
		if($buildBelongingObjects >= 1){
			$query['recursive'] = 0;
		}
		
		if($query['recursive'] == -1){
			$buildBelongingObjects = 0;
		}
		
			
		if($type == 'first'){
			return $this->buildObject($this->find($type,$query),$buildBelongingObjects);
		}else{
			return $this->buildObjectList($this->find($type,$query),$buildBelongingObjects);
		}
	}
	
	function findById($id,$query=array(),$buildBelongingObjects=0){
		$cache = Configure::read('cache_find_by_id');
		if($cache == true){
			$cache_key	= 'find_by_id::'.$this->alias."::".$id;
			$cached		= Cache::read($cache_key,'redis');
			if($cached !== false){
				return $cached;
			}
		}

		if(!$query){
			$query = array();
		}
		
		$query['conditions'][$this->alias.'.id'] = $id;
		
		$result = $this->findObjects('first',$query,$buildBelongingObjects);

		if($cache === true && is_object($result) && $id){
			Cache::write($cache_key,$result,'redis');
		}
		return $result;
	}
	
	function findBy($fieldName,$fieldValue, $type='first', $query=array(),$buildBelongingObjects=0){
		if(!$query){
			$query = array();
		}
		
		$query['conditions'][$this->alias.'.'.$fieldName] = $fieldValue;
		
		return $this->findObjects($type,$query,$buildBelongingObjects);
	}
	
	/**
	* Build one belongsTo relation
	* @param: $modelName Model Name
	**/
	function buildBelong($modelName){
		if(!isset($this->belongsTo[$modelName])){
			throw new Exception("Model ".$modelName.' doesn\'t belong to '.get_class($this), 1);
		}
		$fkName = $this->belongsTo[$modelName]['foreignKey'];
		if($this->getAttr($fkName) !== null){
			if(!is_object($this->$modelName)){
				$this->$modelName = $this->loadModel($modelName);
			}
			$this->$modelName = $this->$modelName->findById($this->getAttr($fkName),array(),0);
		}   
	}
	
	function buildHasMany($hasManyModelName,$query=array(),$buildBelongingObjects=0){    
		if(!array_key_exists($hasManyModelName,$this->hasMany)){
			exit('Model name '.$hasManyModelName.'  doesn\'t exists in hasMany');
		}
		
		$finalQuery = array();
		$finalQuery['recursive'] = -1;
		$finalQuery['conditions'] = array($hasManyModelName.'.'.$this->hasMany[$hasManyModelName]['foreignKey'] => $this->getID());
		if(isset($this->hasMany[$hasManyModelName]['conditions']) && is_array($this->hasMany[$hasManyModelName]['conditions'])){
			foreach($this->hasMany[$hasManyModelName]['conditions'] as $key => $value){
				$finalQuery['conditions'][$key] = $value;
			}
		}
		
		if(isset($query['conditions'])){
			foreach($query['conditions'] as $key => $value){
				$finalQuery['conditions'][] = $value;
			}
		}
		
		foreach($query as $key => $value){
			if(!isset($finalQuery[$key])){
				$finalQuery[$key] = $value;
			}
		}
		
		
		$this->loadModel($hasManyModelName);
		
		$this->$hasManyModelName = $this->$hasManyModelName->findObjects('all',$finalQuery,$buildBelongingObjects);
		
		
	}
	
	function buildHasManyAll(){
		foreach($this->hasMany as $key => $value){
			$this->loadModel($key);
			$this->$key = $this->$key->findObjects('all',array('recursive'=>-1,array('conditions'=>$key.'.'.$value['foreignKey'])),0);
		}
	}
	
	/**
	* Returns the value of $this->data[ModelName][$attrName]
	*/
	function getAttr($attrName){
		if(isset($this->data[$this->alias][$attrName])){
			return $this->data[$this->alias][$attrName];
		}else{
			return null;
		}
	}

	/**
	* Set the value of $this->data[ModelName][$attrName]
	*/
	function setAttr($attrName, $value){
		if(isset($this->data[$this->alias])){
			$this->data[$this->alias][$attrName] = $value;
		}
	}
	
	/**
	* Returns the ID of current object
	*/
	function getPrimaryId(){
		if(is_numeric($this->getID()) && $this->getID()){
			return $this->getID();
		}else{
			if(isset($this->data[$this->alias]['id'])){
				return $this->data[$this->alias]['id'];
			}
		}
	}
	
	/**
	*	Returns the instance of the objectRequested. If it doesn't exists the methods tries to load
	*   @param: $modelName
	*   Example of usage:
			on the controller:
				$objUser = $this->User->findById('123',array(),0); //Doesnt Load the belongsTo Picture
				$objPicture = $this->getModelObject('Picture');
	**/
	function getModelObject($modelName){
		
		if(!is_object($this->$modelName) || !$this->$modelName->getID() || !$this->$modelName->data){
			if(array_key_exists($modelName , $this->belongsTo)){
				
				//$$modelName = $this->loadModel($modelName);
				$this->{$modelName} = $this->loadModel($modelName);
				
				$fk = $this->belongsTo[$modelName]['foreignKey'];

				$conditions['conditions'] = array();
				if(isset($this->belongsTo[$modelName]['conditions']) && is_array($this->belongsTo[$modelName]['conditions'])){
					$conditions['conditions'] = $this->belongsTo[$modelName]['conditions'];
				}
				
				if($this->{$modelName}->alias != $modelName){
					$this->{$modelName}->alias = $modelName;
				}
				
				if(strlen($this->getAttr($fk)) !== 0){
					$this->$modelName = $this->$modelName->findById($this->getAttr($fk),$conditions,0);
				}else{
					$this->$modelName = $this->$modelName;
				}
			}
			if(array_key_exists($modelName , $this->hasOne)){
				
				//$$modelName = $this->loadModel($modelName);
				$this->{$modelName} = $this->loadModel($modelName);
				
				$fk = $this->hasOne[$modelName]['foreignKey'];
				$conditions['conditions'] = array();
				if(isset($this->hasOne[$modelName]['conditions']) && is_array($this->hasOne[$modelName]['conditions'])){
					$conditions['conditions'] = $this->hasOne[$modelName]['conditions'];
				}
				
				if($this->{$modelName}->alias != $modelName){
					$this->{$modelName}->alias = $modelName;
				}
				
				if(strlen($this->getPrimaryId()) !== 0){
					$this->$modelName = $this->$modelName->findBy($fk,$this->getPrimaryId(),'first',$conditions,0);
				}else{
					$this->$modelName = $this->$modelName;
				}
			}
		}
		
		if(is_object($this->$modelName)){
			return $this->$modelName;
		}
	}
	
	/**
	* 
	* Loads the Obj pass as parameters. The loaded Object must be : belongsTo
	* 
	* @param Obj $modelName
	*/
	public function &loadObject($modelName){
		$this->getModelObject($modelName);
		return $this;
	}

	public function __get($name){
		if(isset($this->data[$this->alias][$name]) && $this->data[$this->alias][$name] != false){
			return $this->data[$this->alias][$name];
		}
		if(isset($this->belongsTo[$name]) || isset($this->hasOne[$name])){
			if(!isset($this->{$name}) || !is_object($this->{$name}) || !$this->{$name}->getID()){
				$this->loadObject($name);
				return $this->{$name};
			}
			return $this->{$name};
		}
		if(isset($this->hasMany[$name])){
			$conditions['conditions'] = array();
			if(isset($this->hasMany[$name]['conditions']) && is_array($this->hasMany[$name]['conditions'])){
				$conditions['conditions'] = $this->hasMany[$name]['conditions'];
			}
			$this->buildHasMany($name,$conditions);
			return $this->{$name};
		}
		return parent::__get($name);

	}
	
	public function savePersist($data = null, $validate = true, $fieldList = array()){	
		$tmpObj = clone $this;
	
		$data = $tmpObj->save($data,$validate,$fieldList);
		if($data){
			$pk = $tmpObj->primaryKey;
			if(isset($data[$tmpObj->alias][$pk]) && $data[$tmpObj->alias][$pk] && !$this->$pk){
				$this->$pk = $data[$tmpObj->alias][$pk];
			}
			if(isset($this->$pk) && $this->$pk && (!isset($this->data[$tmpObj->alias][$pk]) || !$this->data[$tmpObj->alias][$pk])){
				$this->data[$tmpObj->alias][$pk] = $this->$pk;
			}

		}
		return $data;
	}
	
	public function listValidationErrors(){
		if(is_array($this->validationErrors)){
			$arrReturn = array();
			foreach($this->validationErrors as $key => $value){
				foreach($value as $k => $v){
					$arrReturn[] = $v;
				}
			}
			return $arrReturn;
		}
	}	

	/**
	* The urlToWebrootImg static method fixe the bug of the Cakephp 2.1. The Helpers can not reached in the CakeEmail template
	* This is the email template image
	*
	* @TODO: update cakephp to 2.2.4
	*
	* @return String URL to webroot.img
	*
	*/
	static function urlToWebrootImg(){
		$url_domain = Configure::read('LivingAlpha.url');
		if(ENV_WEBROOT!=''){
			return $url_domain.substr(ENV_WEBROOT,1).'/img/';
		}else{
			return $url_domain.'img/';
		}
	}

	/**
	* Sends an email to developers alerting that an exception happened
	* @param: Exception $e
	*/
	public function reportException(Exception $e){
		AppExceptionHandler::reportUnknownException($e);
	}
	
	function debugSQL(){
		if (!class_exists('ConnectionManager') || Configure::read('debug') < 2) {
			return false;
		}
		$noLogs = !isset($logs);
		if ($noLogs):
			$sources = ConnectionManager::sourceList();
			
			$logs = array();
			foreach ($sources as $source):
				$db = ConnectionManager::getDataSource($source);
				if (!method_exists($db, 'getLog')):
					continue;
				endif;
				$logs[$source] = $db->getLog();
			endforeach;
		endif;
		
		if ($noLogs || isset($_forced_from_dbo_)):
			foreach ($logs as $source => $logInfo):
				$text = $logInfo['count'] > 1 ? 'queries' : 'query';
				printf(
						'<table class="cake-sql-log" id="cakeSqlLog_%s" summary="Cake SQL Log" cellspacing="0">',
						preg_replace('/[^A-Za-z0-9_]/', '_', uniqid(time(), true))
				);
				printf('<caption>(%s) %s %s took %s ms</caption>', $source, $logInfo['count'], $text, $logInfo['time']);
				echo '
				<thead>
				<tr><th>Nr</th><th>Query</th><th>Error</th><th>Affected</th><th>Num. rows</th><th>Took (ms)</th></tr>
				</thead>
				<tbody>';
				
				foreach ($logInfo['log'] as $k => $i) :
					$i += array('error' => '');
					if (!empty($i['params']) && is_array($i['params'])) {
						$bindParam = $bindType = null;
						if (preg_match('/.+ :.+/', $i['query'])) {
							$bindType = true;
						}
						foreach ($i['params'] as $bindKey => $bindVal) {
							if ($bindType === true) {
								$bindParam .= h($bindKey) ." => " . h($bindVal) . ", ";
							} else {
								$bindParam .= h($bindVal) . ", ";
							}
						}
						$i['query'] .= " , params[ " . rtrim($bindParam, ', ') . " ]";
					}
					echo "<tr><td>" . ($k + 1) . "</td><td>" . h($i['query']) . "</td><td>{$i['error']}</td><td style = \"text-align: right\">{$i['affected']}</td><td style = \"text-align: right\">{$i['numRows']}</td><td style = \"text-align: right\">{$i['took']}</td></tr>\n";
				endforeach;
				echo '
				</tbody></table>';
			
			endforeach;
		else:
			echo '<p>Encountered unexpected $logs cannot generate SQL log</p>';
		endif;
		
		echo '</div>';
	}

	public function checkSecurity($obj_logged_user){
		//Include validation user anonymous
		if((isset($obj_logged_user) && intval($this->getAttr('user_id')) != $obj_logged_user->getPrimaryId()) || (!isset($obj_logged_user) && intval($this->getAttr('user_id'))!=1)){
			throw new InternalException("User trying to access content that he or she is not suposed to access");
		}
	}
	
	/**
	 * Get Friendly URL
	 * @author Geynen
	 * @version 14 Nov 2013
	 * @see AppController::__to_slug
	 */
	public function __to_slug($string,$id=null,$model) {
		$slug = Inflector::slug ($string,'-');
		$slug = strtolower ($slug);
		$i = 0;
		$params = array ();
		$params ['conditions']= array();
		$params ['conditions'][$model.'.slug']= $slug;
		if (!is_null($id)) {
			$params ['conditions']['not'] = array($model.'.id'=>$id);
		}
		$this->loadModel($model);
		while (count($this->$model->find('all',$params))) {
			if (!preg_match ('/-{1}[0-9]+$/', $slug )) {
				$slug .= '-' . ++$i;
			} else {
				$slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
			}
			$params ['conditions'][$model . '.slug']= $slug;
		}
		return $slug;
	}
	
	/**
	 * Encrypt hash
	 * @param $hash
	 * @return hash_encode
	 * @author Vladimir
	 * @version 01 Septiembre 2015
	 */
	public function getEncodeHash($hash){
		App::uses('SistraEncodeComponent', 'Controller/Component');
		$component_colection = ClassRegistry::init('ComponentCollection');
		if(!is_object($component_colection) || get_class($component_colection) != 'ComponentCollection'){
			App::uses('ComponentCollection', 'Controller');
			$component_colection = new ComponentCollection();
		}
		$objEncode = new SistraEncodeComponent($component_colection);
		return $objEncode->myUrlEncode($objEncode->myEncode($hash));
	}
	
	/**
	 * Decrypt hash
	 * @param $hash
	 * @return hash_decode
	 * @author Vladimir
	 * @version 01 Septiembre 2015
	 */
	public function getDecodeHash($hash){
		App::uses('SistraEncodeComponent', 'Controller/Component');
		$component_colection = ClassRegistry::init('ComponentCollection');
		if(!is_object($component_colection) || get_class($component_colection) != 'ComponentCollection'){
			App::uses('ComponentCollection', 'Controller');
			$component_collection = new ComponentCollection();
		}
		$objEncode = new SistraEncodeComponent($component_colection);
	
		return $objEncode->myDecode($objEncode->myUrlDecode($hash));
	}

	public function isEmpty(){
		if(!$this->getID() || empty($this->data)){
			return true;
		}
		return false;
	}
}
