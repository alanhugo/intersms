<?php
  class DashboardController extends AppController{
    
    public $name = 'Dashboard';

    public function beforeFilter(){
		$this->layout = "default";
		parent::beforeFilter();
	}
	
	/**
	 * Panel de dashboard
	 * @author Alan Hugo
	 * @version 20 Abril 2015
	 */
	public function index() {

	}
  }
?>