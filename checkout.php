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
<style media="screen">
  .top-buffer { margin-top: 30px;}
</style>
<!DOCTYPE html>
<html>
<?php
include'includes/head.php';
include'includes/navbar.php'; ?>

<body>
 <div id="wrapper">

 <div class="container top-buffer">

     <div class="page-header"></div>
        <div class="row">
        <div class="col-lg-12">
        <h1 class="text-center">Handlevogn</h1>
        </div>
      </div>
    </div>




    </div>
  </body>
</html>

<?php ob_end_flush(); ?>
