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
 $userRow=mysql_fetch_array($res);

?>
<!DOCTYPE html>
<html>
<?php
include'includes/head.php';
include'includes/navbar.php'; ?>
<script>
window.setInterval(function(){
  load();

}, 5000);
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
</script>

<body onload="load();">

  <div id="wrapper">
    <div class="container top-buffer-40">
      <div class="row">
        <div class="col-lg-12">
          <h1>High quality memes</h1>
        </div>
      </div>
      <div class="container">
        <?php //include'load.php'; ?>
        <br>
        <div id="txtHint"></div>
    </div>
  </div>
</body>
</html>
<?php ob_end_flush(); ?>
