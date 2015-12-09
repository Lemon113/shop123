<?php
//более стабильный автолоад:
function __autoload ($name) {
	$str = "class." . $name . ".php";
	try {
		include $str;
	} catch (Exception $e) {
		echo 'Произошла ошибка: ',  $e->getMessage(), "<br>";
	}
}

if (isset($_POST["input"])) {
	$arr = explode(";", $_POST["input"]);
	
	$id_basket 	= $arr[0];
	$id_catalog = $arr[1];
	
	$db = new DB();
	$db->delete_basket($id_basket, $id_catalog);
}
?>