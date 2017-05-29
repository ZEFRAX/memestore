<?php
	session_start();
include_once'includes/dbConnect.php';

if( !isset($_SESSION['user']) ) {
 header("Location: checkout.php?usermustbelogedin");
 exit;}

$res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);
$userid = $userRow['userId'];


$items = $_SESSION['cart'];
$cartitems = explode(",", $items);

foreach ($cartitems as $id) {
$sql=mysql_query( "SELECT productPrice FROM products WHERE productID = ".$id);
  while($r = @mysql_fetch_assoc($sql)) {
    $tot = $r['productPrice'] + $tot;
}
}

foreach ($cartitems as $id) {
$sql=mysql_query( "SELECT * FROM products WHERE productID = ".$id);
$date = $today = date("dhis");
$orderNumber = $date + $userid;

  while($r = @mysql_fetch_assoc($sql)) {
    $productId = $r['productID'];
		$productPrice = $r['productPrice'];


    $query = "INSERT INTO orders(userId, productId, orderNumber, productPriceAt, orderTotal) VALUES('$userid', '$productId', '$orderNumber', '$productPrice', '$tot')";
    $res = mysql_query($query);
    if ($res) {
      header("Location: checkout.php?ordercomplete=".$orderNumber);
      unset($_SESSION['cart']);
    }else {
      header("Location: checkout.php?errorwithpurchase");

    }
     ?>
    <?php
}
}
?>
