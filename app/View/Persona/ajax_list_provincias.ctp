<?php
	if (isset($array_provincia)){
		foreach ($array_provincia as $id => $provincia):
			echo "<option value = ".$id.">".$provincia."</option>";
		endforeach;
	}