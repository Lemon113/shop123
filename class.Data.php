<?php

class Data {
	
	//проверка данных на корректность:
	function check ($data, $type){
		switch ($type){
			case "s":
					$data = trim($data);
					$data = strip_tags($data);
					if ($data == "") $data = false; 
				break;
			case "i":
			case "r":
					if (!(is_numeric($data))) $data = false;
				break;				
		}
		return $data;
	}
	
}

?>