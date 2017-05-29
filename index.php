<?php
 ob_start();
 session_start();
 require_once 'includes/dbConnect.php';

 // if session is not set this will redirect to login page
 #if( !isset($_SESSION['user']) ) {
  #header("Location: index.php");
  #exit;
 #}
 // select loggedin users detail
 $res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow=@mysql_fetch_array($res);
?>
<!DOCTYPE html>
<html>
<?php
include'includes/head.php';
include'includes/navbar.php'; ?>
<body onload="load(); cartload();">
  <div id="wrapper">
    <div class="container top-buffer-40">
      <div class="row">
        <div class="col-lg-12">
          <h1>High quality memes</h1>
        </div>
      </div>
      <div class="container">
        <div id="txtHint"></div>
    </div>
  </div>
</body>
</html>
<script>
window.setInterval(function(){
  load();
}, 30000);
function load() {
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
        xmlhttp.open("GET","load.php",true);
        xmlhttp.send();}


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
<?php ob_end_flush(); ?>
