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

<body>

  <div id="wrapper">
    <div class="container top-buffer-30">
      <div class="page-header">
        <h3>Standard side</h3>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <h1>Standard side som alle kan se om man har en bruker eller ikke  </h1>
        </div>
      </div>
      <div class="container">
        <?php include'load.php'; ?>

    </div>
  </div>
</body>
</html>
<?php ob_end_flush(); ?>
