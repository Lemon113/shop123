<?php
function __autoload ($name) {
	$str = "class." . $name . ".php";
	if (! include $str) echo ("НЕ ЧЕГО НЕ получилось");
}


$db = new DB();

//Создание каталога
$sql = "CREATE TABLE catalog(
			id   INT(2) PRIMARY KEY AUTO_INCREMENT NOT NULL,
			name VARCHAR(255) NOT NULL, 
			description TEXT,
			price REAL NOT NULL,
			amount INT(3) NOT NULL) default charset='UTF8'";
$db->create_table($sql);
		
//Создание корзины
$sql = "CREATE TABLE basket(
			id   INT(2) PRIMARY KEY AUTO_INCREMENT NOT NULL,
			id_session VARCHAR(255) NOT NULL 
			) default charset='UTF8'";			
$db->create_table($sql);

//Создание таблицы заказов
$sql = "CREATE TABLE orders(
			id   INT(2) PRIMARY KEY AUTO_INCREMENT NOT NULL,
			info TEXT NOT NULL 
			) default charset='UTF8'";			
$db->create_table($sql);

//Создание связи между каталогом и корзиной
$sql = "CREATE TABLE basket_goods(
			id_basket INT(2),
			id_catalog INT(2),
			amount INT(2),
			FOREIGN KEY (id_basket) REFERENCES basket(id),
			FOREIGN KEY (id_catalog) REFERENCES catalog(id) 					
			) default charset='UTF8'";			
$db->create_table($sql);		
			
//Создание связи между каталогом и заказами
$sql = "CREATE TABLE order_goods(
			id_orders INT(2),
			id_catalog INT(2),
			amount INT(2),
			FOREIGN KEY (id_orders) REFERENCES orders(id),
			FOREIGN KEY (id_catalog) REFERENCES catalog(id)
			) default charset='UTF8'";			
$db->create_table($sql);		

header("location: show_catalog.php");
exit;



		
?>
