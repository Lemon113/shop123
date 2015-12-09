<?php
function __autoload ($name) {
	$str = "class." . $name . ".php";
	if (! include $str) echo ("НЕ получилось");
}
$data = new Data();

/*	Проверка массива POST на данные о новом товаре. 
	Запись товара в БД	*/
if (isset ($_POST['name'])){
	$name 		    = 	$data->check($_POST['name'],        "s");
	$description    = 	$data->check($_POST['description'], "s");
	$amount 		= 	$data->check($_POST['amount'],      "i");
	$price          = 	$data->check($_POST['price'],       "r");
	
	if ($name && $description && $amount && $price){
		$db = new DB();
		$db->add2catalog($name, $description, $amount, $price);
	}else{
		echo "<br> Введены некорректные данные!<br>";
	}
}

?>


<!DOCTYPE html>
<html>
	<head>
		<title>
			add2Catalog
		</title>
		<meta charset="utf-8">
	</head>
<body>
	<a href="show_catalog.php"> Перейти к каталогу </a> <br>
	<form action = "add2catalog.php" method= "POST">
		<label> Input name: </label><br>
		<input type="text" name="name"><br>
		<label> Input description: </label><br>
		<textarea name="description">
		</textarea><br>
		<label> Input amount: </label><br>
		<input type="text" name="amount"><br>
		<label> Input price: </label><br>
		<input type="text" name="price">
		<br><br>	
		<input type="submit">
	</form>
</body>
</html>