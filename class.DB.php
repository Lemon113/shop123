<?php

class DB extends mysqli {
	
	function __construct (){
		parent::__construct('localhost', 'root', '', 'shop123');
	}
	// Метод для создания таблиц в БД
	function create_table ($sql){
		if ($this->query($sql)) {
			//echo "Table is created!";
		}else {
			echo $this->error."<br>";	
		}
	}
	// Метод для добавления товара в БД
	function add2catalog ($name, $description, $amount, $price){
		
		$sql = "INSERT INTO 
					catalog (name, description, amount, price)
				VALUES
					('$name', '$description', $amount, $price)";
		
		if ($this->query($sql)) {
			echo "<br> New stuff is added! <br>";
			header("location: add2catalog.php");
			exit;
		}else {
			echo $this->error."<br>";	
		}
	}
	//Метод получения данных о товарах для каталога
	function show_catalog(){
		$sql = "SELECT * FROM catalog";
		if ($res = $this->query($sql)) {
			
			$arr = array();
			$i = 0;
			while ($v = $res->fetch_array(MYSQLI_ASSOC)){
				$arr[$i]["id"] 			= $v["id"];
				$arr[$i]["name"] 		= $v["name"];
				$arr[$i]["description"] = $v["description"];
				$arr[$i]["amount"] 		= $v["amount"];
				$arr[$i]["price"] 		= $v["price"]; 
				$i++;
			}	
			return $arr;
		}else {
			echo $this->error."<br>";	
		}
	}
	
	
	//создание новой корзины:
	function new_basket($session_id){
		$sql = "SELECT * FROM basket
					 WHERE  id_session  = '".  $session_id."'";
		if ($res = $this->query($sql)) {
			$field_cnt = $res->num_rows;
			//echo var_dump($field_cnt);
			if ($field_cnt == 0) {
				$sql = "INSERT  INTO basket ( id_session )
					          VALUES ('" . $session_id . "')" ;
				$this->query($sql);
				$id =  $this->insert_id;
				return $id;
			}else {
				$id = $res->fetch_array(MYSQLI_ASSOC);
				return $id["id"];
			}
		}else {
			echo $this->error."<br>";	
		}
	}
	
	
	//добавление в корзину:
	 function add2basket($id, $stuff_id, $amount){
		 $sql = "INSERT INTO   basket_goods (id_basket, id_catalog, amount)
							VALUES (". $id .", ". $stuff_id.", ".$amount.")";
		if ($this->query($sql)) {
			//echo "Table is created!";
		}else {
			echo $this->error."<br>";	
		}
	 }
	 
	 
	 //Метод получения данных корзины
	function show_basket($id){
		$sql = "SELECT  catalog.price AS price,
									catalog.name AS name,
									basket_goods.amount AS amount,
									catalog.id AS id
					 FROM 	basket_goods, 
									basket,
									catalog
					 WHERE 
						basket_goods.id_basket =". $id."
						AND
						basket.id = basket_goods.id_basket
						AND
						catalog.id = basket_goods.id_catalog";
			$res = $this->query($sql);
			//echo var_dump ($res );
		if ($res) {
			
			$arr = array();
			$i = 0;
			//echo var_dump($res->fetch_array(MYSQLI_ASSOC));
			while ($v = $res->fetch_array(MYSQLI_ASSOC)){
				
				//echo var_dump($v);
				$arr[$i]["id"] 			= $v["id"];
				$arr[$i]["name"] 		= $v["name"];
				//$arr[$i]["description"] = $v["description"];
				$arr[$i]["amount"] 		= $v["amount"];
				$arr[$i]["price"] 		= $v["price"]; 
				$i++;
			}	
			return $arr;
		}else {
			echo $this->error."<br>";	
		}
	}
	
	
}



?>
