<?php
session_start();

//более стабильный автолоад:
function __autoload ($name) {
	$str = "class." . $name . ".php";
	try {
		include $str;
	} catch (Exception $e) {
		echo 'Произошла ошибка: ',  $e->getMessage(), "<br>";
	}
}
$session_id = session_id();

?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			Show basket
		</title>
		<meta charset="utf-8">
		<script src="jquery.js"></script>
		<script>
			function generate_link (session, stuff){
				$.ajax({
					type: 'POST',
					url:  'delete_basket.php',
					data: 'input=' + session + ';' + stuff,
					// success: function(data) {
							// $('.result').html(data); 	
					// }
					success: function() {
						//$("table").load(location.href+" table>*","");
						window.location.reload();
					}
				});		
			}
		</script>
	</head>
	<body>
<h2>Это каталог товаров!</h2>
	<br>
	<a href="show_catalog.php"> Перейти к каталогу </a>
	<br>
	<br>
<?php
//вывод корзины:
$db = new DB();
$arr = $db->show_basket($_SESSION["id_basket"]);
?>	
	<table border="1">
	<tr>
		<th>Наименование:</th>
		<th>Кол-во:</th>
		<th>Цена:</th>
		<th> </th>
	</tr>
<?php
	foreach ($arr as $val){
		echo "<tr>";
		echo "<td>".$val["name"]."</td>";
		echo "<td>".$val["amount"]."</td>";
		echo "<td>".$val["price"]."</td>";
		echo "<td> <a href='javascript: generate_link (".$_SESSION["id_basket"].", ".$val["id"].")'> удалить из корзины</a></td>";
		echo "</tr>";
	}
?>		
	</table>
	<div class='result'></div>
</body>
</html>