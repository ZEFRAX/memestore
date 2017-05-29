<?php
 ob_start();
 session_start();
 require_once 'includes/dbConnect.php';

 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: index.php");
  exit;
  }
  $res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
  $userRow=mysql_fetch_array($res);


$link = htmlspecialchars($_GET["ordernr"]);
$qwe=mysql_query("SELECT DISTINCT userId FROM orders WHERE orderNumber =".$link);
$wer=mysql_fetch_array($qwe);

$asdf=mysql_query("SELECT DISTINCT orderTotal FROM orders WHERE orderNumber =".$link);
$sdfg=mysql_fetch_array($asdf);


 // select loggedin users detail
 $sql2 = "SELECT orders.productId, orders.orderNumber, orders.userId,orders.productPriceAt,orders.orderTotal, orders.orderTime, products.productName, products.productImage ,products.productID, products.productImage
 FROM orders
 INNER JOIN products ON orders.productId=products.productID WHERE orderNumber =".$link;
 $result2 = mysql_query($sql2);

 if( $userRow['userId'] !== $wer['userId']) {
   header("Location: index.php");
  }


?>
<style media="screen">
  .top-buffer { margin-top: 30px;}
</style>
<!DOCTYPE html>
<html>
<?php
include_once'includes/head.php';
include_once'includes/navbar.php'; ?>

<body>
 <div id="wrapper">

 <div class="container top-buffer-40">
   <hr>
   <div id="txtHint" class="">


        <div style="margin-top:-30px;"class="row">
        <h1 class="text-center">Ordrenr <u><?php echo $link; ?></u></h1>
        <div class="row">
          <h4 onclick="document.location='usersettings.php'" style="cursor:hand; width:150px;"><u>Min side</u></h4>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th>Produkt bilde</th>
              <th>Produkt Navn</th>
              <th>Bestilt</th>
              <th>Product ID</th>
              <th>Pris</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td><strong>Total: </strong></td>
              <td><strong> <?php echo $sdfg["orderTotal"] ?>,-</strong></td>
            </tr>
          </tfoot>

          <tbody>
          <?php  if (mysql_num_rows($result2) > 0) {
               while($porow = mysql_fetch_assoc($result2)) {?>

                 <tr class="tr" onclick="document.location='site.php?<?php echo $porow ["productID"] ?>'" style="cursor:hand" >
                   <td ><img style="max-height: 70px; max-width: 140px;"src="<?php echo $porow ['productImage']; ?>" alt=""></th>
                     <td ><?php echo $porow ['productName']; ?></td>
                   <td ><?php echo date_format( new DateTime($porow['orderTime']), 'd-m-Y H:i' )?></td>
                   <td ><?php echo $porow ['productID']; ?></td>
                   <td ><?php echo $porow ['productPriceAt']; ?>,-</td>
                 </tr>
               <?php
             }
           }else{
             echo "Error getting products";
             echo $link;
           }

               ?>
             </tbody>
           </table>
           <script>
           $(".tr").hover(function(){
             $(this).css("background-color", "lightgrey");
           }, function(){
             $(this).css("background-color", "white");
           });





           function search(){

             var q = document.getElementById("search").value;

             if (window.XMLHttpRequest) {
                 // code for IE7+, Firefox, Chrome, Opera, Safari
                 xmlhttp = new XMLHttpRequest();
             } else {
                 // code for IE6, IE5
                 xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
             }
             xmlhttp.onreadystatechange = function() {
                 if (this.readyState == 4 && this.status == 200) {
                   document.getElementById("txtHint").innerHTML = this.responseText;
                 }
             };
             xmlhttp.open("GET","search.php?q="+q,true);
             xmlhttp.send();
           }

           function addToCart(val2){
             if (window.XMLHttpRequest) {
                 // code for IE7+, Firefox, Chrome, Opera, Safari
                 xmlhttp = new XMLHttpRequest();
             } else {
                 // code for IE6, IE5
                 xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
             }
             xmlhttp.onreadystatechange = function() {
                 if (this.readyState == 4 && this.status == 200) {
                 }
             };
             xmlhttp.open("GET","addtocart.php?"+val2,true);
             xmlhttp.send();

           }
           </script>

    </div>
  </div>
    </div>
</body>
</html>

<?php ob_end_flush(); ?>
