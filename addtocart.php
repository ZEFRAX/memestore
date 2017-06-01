<?php
	session_start();
$items = $_SESSION['cart'];
$cartitems = explode(",", $items);
$url = "$_SERVER[REQUEST_URI]";
$url = str_replace("/addtocart.php?","",$url);
echo $url;

if(in_array($url, $cartitems)){
	header('location: index.php?status=incart');
}else{
	$items .= "," . $url;
	$_SESSION['cart'] = $items;
	header('location: index.php?status=success');
}
?>
