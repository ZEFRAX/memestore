<?php
	session_start();
include_once'includes/dbConnect.php';


$items = $_SESSION['cart'];
$cartitems = explode(",", $items);

foreach ($cartitems as $id) {
$sql=mysql_query( "SELECT * FROM products WHERE productID = ".$id);
  while($r = @mysql_fetch_assoc($sql)) {
     ?>
       <div id="item" style="margin-bottom: 10px;  content: ""; display: table; clear: both;  box-sizing: border-box;"class="clearfix row">
         <img style="float: left; margin-right: 12px; max-height: 50px;"src="<?php echo $r['productImage']; ?>" alt="item1" />
         <span style="display: block;padding-top: 10px;font-size: 16px;"><?php echo $r['productName']; ?></span>
        <span onclick="deleteFromCart(<?php echo $r['productID']; ?>)" style="float:right; margin-top:-13px;" class=" btn-sm btn-danger glyphicon glyphicon-trash"></span>
         <span style="color: #6394F8; margin-right: 8px;"><?php echo $r['productPrice']; ?> Kr</span>
         <span style="color: #ABB0BE;">Quantity: 1</span>
       </div>
       <hr>
    <?php
}
}


?>
