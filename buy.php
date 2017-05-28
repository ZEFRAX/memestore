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
$sql=mysql_query( "SELECT * FROM products WHERE productID = ".$id);
$date = $today = date("dhis");
$orderNumber = $date + $userid;
  while($r = @mysql_fetch_assoc($sql)) {
    $productId = $r['productID'];

    $query = "INSERT INTO orders(userId, productId, orderNumber) VALUES('$userid', '$productId', '$orderNumber')";
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
