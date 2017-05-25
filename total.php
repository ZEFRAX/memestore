<?php

	session_start();
include_once'includes/dbConnect.php';
$items = $_SESSION['cart'];
$cartitems = explode(",", $items);

foreach ($cartitems as $id) {
$sql=mysql_query( "SELECT productPrice FROM products WHERE productID = ".$id);
  while($r = @mysql_fetch_assoc($sql)) {
    echo ",".$r['productPrice'];
}
}
 ?>
