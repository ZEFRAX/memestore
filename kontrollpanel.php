
<?php
// DEFAULT ADMIN PAGE
 ob_start();
 session_start();
 require_once 'includes/dbConnect.php';

 // select loggedin users detail
 $res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow=mysql_fetch_array($res);
?>

<?php
include'includes/head.php';
include'includes/navbar.php';

if ($userRow['userStat'] != '1') {
  header("Location: home.php");}
  //Edit html under here  vvvv
?>

<!-- STYLE-->
<style media="screen">
  .top-buffer { margin-top: 30px;}
</style>
<!-- STYLE END-->


<!-- HTML START-->
<body>
 <div id="wrapper">
   <div class="container top-buffer">
     <div class="page-header ">
       <h3>The default admin page</h3>
     </div>
     <div class="row">
       <div class="col-lg-12">
         <h1>This is the standard admin page, users without the userStat set to 1 will not be able to access this page.</h1>
       </div>
     </div>
    </div>
  </div>
</body>
</html>
<!-- HTML END-->
<?php ob_end_flush(); ?>
