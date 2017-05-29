<?php
 ob_start();
 session_start();
 require_once 'includes/dbConnect.php';


 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: index.php");
  exit;
 }
 // select loggedin users detail
 $res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow=mysql_fetch_array($res);

 $sql = ("SELECT DISTINCT orderNumber, orderTime, orderTotal FROM orders WHERE userId=".$_SESSION['user']);
 $result = mysql_query($sql);


?>


<?php
include'includes/head.php';
include'includes/navbar.php'; ?>

<html>
<body onload="counttr();">
 <div id="wrapper">

 <div class="container top-buffer-40">
        <div class="row">
        <div class="col-lg-12">
        <h1>Bruker instillinger</h1>
        </div>


        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" href="#collapse">Mine ordre</a><span id="badge" style="background-color: #6394F8; margin-left: 20px;"onload="counttr()"class="badge">0</span>
            </h4>
          </div>
          <div id="collapse" class="collapse panel-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Status</th>
                  <th>Bestilt</th>
                  <th>Ordrenr</th>
                  <th>Totalpris</th>
                </tr>
              </thead>
              <tbody>

           <?php

           if (mysql_num_rows($result) > 0) {
               while($orders = mysql_fetch_assoc($result)) {

?>
                 <tr class="tr" onclick="document.location='order.php?ordernr=<?php echo $orders["orderNumber"] ?>'" style="cursor:hand" >
                   <td >Ferdig</th>
                   <td ><?php echo date_format( new DateTime($orders['orderTime']), 'd-m-Y' )?></td>
                   <td ><?php echo $orders['orderNumber']; ?></td>
                   <td ><?php echo $orders['orderTotal']; ?>,- Kr</td>

                 </tr>



                 <?php



               }
             }
               ?>
               <script>
               $(".tr").hover(function(){
                 $(this).css("background-color", "lightgrey");
               }, function(){
                 $(this).css("background-color", "white");
               });
               </script>

             </tbody>

           </table>
           <?php if (mysql_num_rows($result) > 0) {}else {echo "Ingen ordre";} ?>
          </div>
    </div>
    </div>
</body>
</html>
<script>
function counttr() {
  var numItems = $('.tr').length
  $("#badge").text(numItems);
}
</script>
<?php ob_end_flush(); ?>
