<?php
	session_start();
include_once'includes/dbConnect.php';


$items = $_SESSION['cart'];
$cartitems = explode(",", $items);

foreach ($cartitems as $id) {
$sql=mysql_query( "SELECT * FROM products WHERE productID = ".$id);
  while($r = @mysql_fetch_assoc($sql)) {
     ?>
		 <div id="<?php echo $r['productID']; ?>">
       <div id="item" style="margin-bottom: 10px;  content: ""; display: table; clear: both;  box-sizing: border-box;"class="clearfix row"><a style="" href="site.php?<?php echo $r['productID']; ?>">
				 <?php
													$target_file = $r["productImage"];
													$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

													if ($imageFileType == "mp4" || $imageFileType == "webm") {

														echo "<video style='float: left; margin-right: 12px; max-height: 50px;' loop muted src='".$r["productImage"]."'autoplay poster='posterimage.jpg'></video>";
												}
													else {
													echo "<img style='float: left; margin-right: 12px; max-height: 50px;' src='". $r["productImage"] ."'class='img-responsive' alt='a' />";
												}
					?>
         <span style="display: block;padding-top: 10px;font-size: 16px;"><?php echo $r['productName']; ?></span>
         <span style="color: #6394F8; margin-right: 8px;"><?php echo $r['productPrice']; ?> Kr</span>
         <span style="color: #ABB0BE;">Quantity: 1</span></a>
				 <span onclick="removejs(<?php echo $r['productID']; ?>); deleteFromCart(<?php echo $r['productID']; ?>); total(); totalc();" style="float:right; margin-top:-50px; margin-right:10px;" class=" btn-sm btn-danger glyphicon glyphicon-trash"></span>
       </div>
       <hr>
			 </div>

    <?php
}
}
?>
