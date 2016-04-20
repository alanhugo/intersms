<?php
App::uses('Component', 'Controller');
App::uses('Security', 'Utility');
class SistraEncodeComponent extends Component {

	function myUrlEncode($var){
		$var = str_replace('/','_b_',$var);
		$var = str_replace('+','_p_',$var);
		$var = str_replace('=','_e_',$var);
		return $var;
	}

	function myUrlDecode($var){
		$var = str_replace('_b_','/',$var);
		$var = str_replace('_p_','+',$var);
		$var = str_replace('_e_','=',$var);
		return $var;
	}

	function myEncode($variable){
		return base64_encode(Security::cipher(json_encode($variable), Configure::read('Security.cipherSeed')));
	}

	function myDecode($variable){
		$x = json_decode(Security::cipher(base64_decode($variable),Configure::read('Security.cipherSeed')));
		if(is_object($x)){
			return (array) $x;
		}
		return $x;
	}
}
?>
