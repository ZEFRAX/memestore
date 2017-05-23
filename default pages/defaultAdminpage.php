
<?php
// DEFAULT ADMIN PAGE
 ob_start();
 session_start();
 require_once 'includes/dbConnect.php';

 // select loggedin users detail
 $res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow=mysql_fetch_array($res);

include'includes/head.php';
include'includes/navbar.php';
// direct users if they do not have 1 as their user stat.
if ($userRow['userStat'] != '1') {
  header("Location: index.php");}
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
       <h3>Standard Administrator side</h3>
     </div>
     <div class="row">
       <div class="col-lg-12">
         <h1>Dette er en standard Administrator side, personer uten userStat satt til 1 vill ikke kunne se denne siden.</h1>
       </div>
     </div>
    </div>
  </div>
</body>
</html>
<!-- HTML END-->
<?php ob_end_flush(); ?>
