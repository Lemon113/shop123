<?php
session_start();
function __autoload ($name) {
	$str = "class." . $name . ".php";
	if (! include $str) echo ("НЕ получилось");
}
$data = new Data();

/*	Проверка массива POST на данные о новом товаре. 
	Запись товара в БД	*/
if (isset ($_POST['info'])){
	$info 		    = 	$data->check($_POST['info'],        "s");
	if ($info){
		$db = new DB();
		$db->create_order($info, $_SESSION["id_basket"]);
		echo "Заказ оформлен!<br>";
		echo "<a href='show_catalog.php'> Перейти к каталогу </a></body>
</html>";
		exit;
	}else{
		echo "<br> Введены некорректные данные!<br>";
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>
			create_order
		</title>
		<meta charset="utf-8">
	</head>
<body>
	<form action = "create_order.php" method= "POST">
		<label> Input info: </label><br>
		<textarea name="info">
		</textarea><br>
		<br><br>	
		<input type="submit" value = "отправить данные">
	</form>
</body>
</html>