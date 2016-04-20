<?php
class ErrorsController extends AppController{
	
	public function error_404() {
		$this->layout = "page_not_found";
	}	
}