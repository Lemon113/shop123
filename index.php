<?php
echo "<!DOCTYPE html>
<html>
<head>
<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">
<title>Setup</title>
</head>
<body>";

$GLOBALS["setup"] = true;

function __autoload ($name) {
	$str = "class." . $name . ".php";
	try {
		include $str;
	} catch (Exception $e) {
		echo 'Произошла ошибка: ',  $e->getMessage(), "<br>";
		$GLOBALS["setup"] = false;
	}
}

function create_DB ($sql){
	$db = new DB();
	try {
		$db->create_table($sql);
	} catch (Exception $e) {
		echo 'Произошла ошибка: ',  $e->getMessage(), "<br>";
		$GLOBALS["setup"] = false;
	}
}

//Создание каталога
$sql = "CREATE TABLE catalog(
					id   INT(2) PRIMARY KEY AUTO_INCREMENT NOT NULL,
					name VARCHAR(255) NOT NULL, 
					description TEXT,
					price REAL NOT NULL,
					amount INT(3) NOT NULL) 
			default charset='UTF8'";
create_DB ($sql);
		
//Создание корзины
$sql = "CREATE TABLE basket(
			id   INT(2) PRIMARY KEY AUTO_INCREMENT NOT NULL,
			id_session VARCHAR(255) NOT NULL 
			) default charset='UTF8'";			
create_DB ($sql);

//Создание таблицы заказов
$sql = "CREATE TABLE orders(
			id   INT(2) PRIMARY KEY AUTO_INCREMENT NOT NULL,
			info TEXT NOT NULL 
			) default charset='UTF8'";			
create_DB ($sql);

//Создание связи между каталогом и корзиной
$sql = "CREATE TABLE basket_goods(
			id_basket INT(2),
			id_catalog INT(2),
			amount INT(2),
			FOREIGN KEY (id_basket) REFERENCES basket(id),
			FOREIGN KEY (id_catalog) REFERENCES catalog(id) 					
			) default charset='UTF8'";			
create_DB ($sql);	
			
//Создание связи между каталогом и заказами
$sql = "CREATE TABLE order_goods(
			id_orders INT(2),
			id_catalog INT(2),
			amount INT(2),
			FOREIGN KEY (id_orders) REFERENCES orders(id),
			FOREIGN KEY (id_catalog) REFERENCES catalog(id)
			) default charset='UTF8'";			
create_DB ($sql);	

if ($GLOBALS["setup"]) {
	echo "<h3>База данных (БД) успешно создана! </h3>
<br>
<a href=\"add2catalog.php\"> Перейти к заполнению БД товарами =></a>";
} else {
	echo "<br> Обратите внимание на ошибки. Исправьте их и попробуйте снова.";
}
?>