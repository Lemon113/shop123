<?php
session_start();
function __autoload ($name) {
	$str = "class." . $name . ".php";
	if (! include $str) echo ("НЕ получилось");
}

$session_id = session_id();

//вывод корзины:
$db = new DB();
$arr = $db->show_basket($_SESSION["id_basket"]);


?>


<!DOCTYPE html>
<html>
	<head>
		<title>
			Show catalog
		</title>
		<meta charset="utf-8">
	</head>

	
	<body>
<h2>Это каталог товаров!</h2>
	
	<br>
	<a href="show_catalog.php"> Перейти к каталогу </a>
	<br>
	<br>
	<table border="1">
	<tr>
		<th> Наименование:</th>
		<th>Кол-во:</th>
		<th>Цена:</th>
		<th> </th>

	</tr>
	
<?php

	//$i=0;
	foreach ($arr as $val){
		echo "<tr>";
		echo "<td>".$val["name"]."</td>";
		echo "<td>".$val["amount"]."</td>";
		echo "<td>".$val["price"]."</td>";
		//echo "<td> <a href='javascript: generate_link (".$i.", ".$val["id"].")' > Добавить в корзину</a></td>";
		echo "</tr>";
		//$i++;
	}

?>		
		
	</table>

</body>
</html>