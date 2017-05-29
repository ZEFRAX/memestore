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

 $sql = ("SELECT COUNT(orderNumber), orderTime, orderTotal, orderNumber  FROM orders WHERE userId=".$_SESSION['user'] ." GROUP BY orderNumber ORDER BY orderTime DESC");
 $result = mysql_query($sql);


?>


<?php
include'includes/head.php';
include'includes/navbar.php'; ?>

<html>
<body id="body"onload="cartload(); total(); counttr(); isColor();">
 <div id="wrapper">

 <div class="container top-buffer-40">
        <div class="row">
        <div class="col-lg-12">
        <h1>Min side</h1>
        </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" href="#collapse">Mine ordre</a><span id="badge" style="background-color: #6394F8; margin-left: 20px;"onload="counttr()"class="badge">0</span>
            </h4>
          </div>
          <div id="collapse" class="collapse panel-body">
            <table class="table">
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
               while($orders = mysql_fetch_assoc($result)) {?>
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


    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" href="#settings">Innstillinger</a>
        </h4>
      </div>
      <div id="settings" class="collapse panel-body">
        <div class="">
                  <button onclick="changecolor();" type="button" name="button">Click me</button><span id="onoff"> Hello?</span>

        </div>

        <script>
        function changecolor() {
          if (typeof(Storage) !== "undefined") {
            document.getElementById("onoff").innerHTML = localStorage.getItem("color");
            if (localStorage.getItem("color") == "1") {
              $("#body").css("background-color","#161616");
              document.getElementById("onoff").innerHTML = "Mørk";
              localStorage.setItem("color", "0");
            }else {
              $("#body").css("background-color","white");
              document.getElementById("onoff").innerHTML = "Lys";
              localStorage.setItem("color", "1");
            }
          } else {
            document.getElementById("onoff").innerHTML = "Sorry, your browser does not support Web Storage...";
          }
        }
        </script>
    </div>
  </div>
</body>
</html>
<script>
function counttr() {
  var numItems = $('.tr').length
  $("#badge").text(numItems);
}

function isColor() {
  if(localStorage.getItem('color') == '0') {
    $("#body").css('background-color','#161616');
    document.getElementById("onoff").innerHTML = localStorage.getItem("color");
  }else {
    $("#body").css('background-color','white');}
    document.getElementById("onoff").innerHTML = localStorage.getItem("color");
}
</script>
<?php ob_end_flush(); ?>
