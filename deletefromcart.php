<?php
session_start();
require_once 'includes/dbConnect.php';
$url = "$_SERVER[REQUEST_URI]";
$url = str_replace("/deletefromcart.php?","",$url);

$items = $_SESSION['cart'];
$cartitems = explode(",", $items);
if(($key = array_search($url, $cartitems)) !== false) {
    unset($cartitems[$key]);
    $items=implode(",",$cartitems);

    $_SESSION['cart'] = $items;
}
print_r($items);
 ?>
