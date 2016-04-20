<?php
	if (isset($array_distritos)){
		foreach ($array_distritos as $id => $distrito):
		echo "<option value = ".$id.">".$distrito."</option>";
		endforeach;
	}