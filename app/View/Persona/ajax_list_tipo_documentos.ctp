<?php
	if (isset($obj_tipo_documentos)){
		foreach ($obj_tipo_documentos as $obj_tipo_documento):
			if(isset($obj_persona)){
				if($obj_tipo_documento->getAttr('id') == $obj_persona->getAttr('tipo_documento_id')){
					$selected = " selected = 'selected'";
				}else{
					$selected = "";
				}
			
			}else{
				$selected = "";
			}
			echo "<option value = ".$obj_tipo_documento->TipoDocIdentidade->getAttr('id').$selected.">".$obj_tipo_documento->TipoDocIdentidade->getAttr('descripcion')."</option>";
		endforeach;
	}