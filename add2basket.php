<?php
session_start();
$session_id = session_id();

function __autoload ($name) {
	$str = "class." . $name . ".php";
	if (! include $str) echo ("НЕ получилось");
}

//создание новой корзины:
$db = new DB();
$id = $db->new_basket($session_id);

$_SESSION["id_basket"] = $id;

//echo $id."<br>";
if (isset($_POST["input"])) {
	$stuff = explode(":", explode(";",$_POST["input"])[0])[1];
	$am = explode(":", explode(";",$_POST["input"])[1])[1];
	
	$db->add2basket($id, $stuff, $am);
}
	//echo $stuff."<br>".$am;
	


?>

