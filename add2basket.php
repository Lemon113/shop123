<?php
session_start();
$session_id = session_id();

//более стабильный автолоад:
function __autoload ($name) {
	$str = "class." . $name . ".php";
	try {
		include $str;
	} catch (Exception $e) {
		echo 'Произошла ошибка: ',  $e->getMessage(), "<br>";
	}
}

//создание новой корзины:
$db = new DB();
$id = $db->new_basket($session_id);

$_SESSION["id_basket"] = $id;

//распатрониваем пришедший ассинхронным запросом ПОСТ:
if (isset($_POST["input"])) {
	
	$arr = explode(";", $_POST["input"]);
	$arr = array( explode(":", $arr[0]), explode(":", $arr[1]) );
	
	$stuff 	= $arr[0][1];
	$am 	= $arr[1][1];
	
	$db->add2basket($id, $stuff, $am);
}
?>

