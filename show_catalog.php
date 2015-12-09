<?php
function __autoload ($name) {
	$str = "class." . $name . ".php";
	if (! include $str) echo ("не получилось");
}
?>


<!DOCTYPE html>
<html>
	<head>
		<title>
			Show catalog
		</title>
		<meta charset="utf-8">
		<script src="jquery.js"></script>
		<script>
			function generate_link (id, stuff){
				str = "#id"+id;
				//alert ($(str).val());
				amount = $(str).val();
				if  (amount == "") {
					alert ("Введите кол-во!");
				}else {
					$.ajax({
						type: 'POST',
						url:  'add2basket.php',
						data: 'input=stuff:' + stuff + '; amount:' + amount,
						success: function(data) {
								$('.result').html(data); 	
						}
					});		
				}
			}
		</script>
	</head>

<body>
	<h2>Это каталог товаров!</h2>
	
	<br>
	<a href="show_basket.php"> Перейти к корзине </a>
	<br>
	<br>
	<table border="1">
	<tr>
		<th> Наименование:</th>
		<th> Описание:</th>
		<th>Введите кол-во:</th>
		<th>Цена:</th>
		<th> </th>

	</tr>
	
<?php



	$db  = new DB();
	$arr = $db->show_catalog(); 
	$i=0;
	foreach ($arr as $val){
		echo "<tr>";
		echo "<td>".$val["name"]."</td>";
		echo "<td>".$val["description"]."</td>";
		echo "<td><input type='text' id='id".$i."' placeholder='1 - ".$val["amount"]."'></td>";
		echo "<td>".$val["price"]."</td>";
		echo "<td> <a href='javascript: generate_link (".$i.", ".$val["id"].")' > Добавить в корзину</a></td>";
		echo "</tr>";
		$i++;
	}

?>		
		
	</table>
	
	<div class='result'></div>
	<br>
	<a href="show_basket.php"> Перейти к корзине </a>
	<br>
</body>
</html>
