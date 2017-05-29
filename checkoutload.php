<?php
	session_start();
include_once'includes/dbConnect.php';


$items = $_SESSION['cart'];
$cartitems = explode(",", $items);

foreach ($cartitems as $id) {
$sql=mysql_query( "SELECT * FROM products WHERE productID = ".$id);
  while($r = @mysql_fetch_assoc($sql)) {
     ?>

<div id="<?php echo $r['productID']; ?>1">
     <div class="row">
       <div class="col-xs-2"><img style=" max-height:80px;" class="img-responsive" src="<?php echo $r['productImage']; ?>">
       </div>
       <div class="col-xs-4">
         <h4 class="product-name"><strong><?php echo $r['productName']; ?></strong></h4><h4><small><?php echo $r['productDesc']; ?></small></h4>
       </div>
       <div class="col-xs-6">
         <div class="col-xs-6 text-right">
           <h6><strong><?php echo $r['productPrice'];?><span class="text-muted"></span>,- Kr</strong></h6>
         </div>
         <div class="col-xs-4">
         </div>
         <div class="col-xs-2">
           <button onclick="removejs2(<?php echo $r['productID']; ?>1); deleteFromCart(<?php echo $r['productID'];?>); totalc(); total();" type="button" class="btn btn-link btn-xs">
             Fjern <span class="glyphicon glyphicon-trash"> </span>
           </button>
         </div>
       </div>
     </div>
     <hr>
     </div>
    <?php
}
}
?>
