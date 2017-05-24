<?php
 session_start();
 require_once 'includes/dbConnect.php';


 $res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow=mysql_fetch_array($res);

 $url = "$_SERVER[REQUEST_URI]";
 $url = str_replace("/delete.php?","",$url);

 $sql=mysql_query("SELECT * FROM products WHERE productID=".$url);
 $product=mysql_fetch_array($sql);

 if (!isset($_SESSION['user'])) {
   header("Location: indexd.php");
 }else if ($userRow['userStat'] != '1') {
   header("Location: index.php");}
   $query = "DELETE FROM products WHERE productID=".$url;
   $res = mysql_query($query);

   if ($res) {
         $errTyp = "success";
     $errMSG ="  Fjernet produktet med <u>ID</u>: ".$product['productName']."  <u>Navn</u>:   ".$product['productName'];
  }else {
    $errTyp = "danger";
    $errMSG ="  Fikk ikke fjernet produktet med <u>ID</u>: ".$product['productName']."  <u>Navn</u>:   ".$product['productName'];
  }


   ?>
   <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
   <link rel="stylesheet" href="assets/css/style.css" type="text/css" />
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div class="container top-buffer-60">

   <?php    if ( isset($errMSG) ) {

       ?>
       <div class="form-group ">
                <div class=" alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?> alert-dismissable fade in text-center">
        <a  style="font-size: 30px;" href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
       <span style="font-size: 30px; position: relative; bottom: 20px; "class="<?php if ($errTyp=="success") { echo "glyphicon glyphicon-floppy-saved";}else { echo "glyphicon glyphicon-floppy-remove";}?> text-center"></span>   <?php echo $errMSG; ?>
                   </div>
                </div>
                <div class="row">
                  <div class="col-xs-offset-5 col-sm-offset-5 col-md-offset-5 ">
                    <a href=index.php><button  type="button" class="btn">Tilbake til Memestore</button></a>
                  </div>
                </div>
                   <?php
      } ?>

    </div>
