<?php
 ob_start();
 session_start();
 require_once 'includes/dbConnect.php';
 // select loggedin users detail
 $res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow=mysql_fetch_array($res);

 $link = "$_SERVER[REQUEST_URI]";
 $link = str_replace("/site.php?","",$link);

 $sql=mysql_query("SELECT * FROM products WHERE productID=".$link);
 $product=mysql_fetch_array($sql);

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
        <h1><?php echo $product["productName"]?></h1>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="container">
	<div class="row">
   <div class="col-xs-4 item-photo">
                    <img style="max-width:100%;" src="<?php echo $product["productImage"] ?>" />
                </div>
                <div class="col-xs-5" style="border:0px solid gray">
                    <!-- Datos del vendedor y titulo del producto -->
                    <h3 style="display: inline;"><?php echo $product["productName"] ?>&nbsp;&nbsp;&nbsp;</h3><?php if ($userRow['userStat'] == '1') { echo "<button type='button' onclick='validation()'class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></button>";} ?>

                    <script>

                    function validation() {
                      var txt;
                      var r = confirm("Er du sikker på at du vil slette  <?php echo $product['productName']?>?\nVelg Ok eller Avbryt!");
                      if (r == true) {
                      var php_var = "<?php echo $product["productID"] ?>";
                        window.location.replace('delete.php?'+ php_var);
                      } else {
                        txt = "You pressed Cancel!";
                      }
                      document.getElementById("demo").innerHTML = txt;
                    }
                    </script>

                    <h5 style="font-size:20px">
                    <?php
                    $element = "<span class='glyphicon glyphicon-star'></span>";
                    $emptyElement = "<span class='glyphicon glyphicon-star-empty'></span>";
                    $emptyCount = 5;
                    $count = $product["productRating"];

            switch($count) {
                       case 0:
                           echo $emptyElement;
                           echo $emptyElement;
                           echo $emptyElement;
                           echo $emptyElement;
                           echo $emptyElement;
                           break;
                       case 1:
                           echo $element;
                           echo $emptyElement;
                           echo $emptyElement;
                           echo $emptyElement;
                           echo $emptyElement;
                           break;
                       case 2:
                           echo $element;
                           echo $element;
                           echo $emptyElement;
                           echo $emptyElement;
                           echo $emptyElement;
                           break;
                       case 3:
                           echo $element;
                           echo $element;
                           echo $element;
                           echo $emptyElement;
                           echo $emptyElement;
                           break;
                       case 4:
                           echo $element;
                           echo $element;
                           echo $element;
                           echo $element;
                           echo $emptyElement;
                           break;
                       case 5:
                           echo $element;
                           echo $element;
                           echo $element;
                           echo $element;
                           echo $element;
                           break;
                       default:
                           echo $emptyElement;
                           echo $emptyElement;
                           echo $emptyElement;
                           echo $emptyElement;
                           echo $emptyElement;
                           break;
                   } ?></h5>

                    <!-- Precios -->
                    <h6 class="title-price"><small>Pris</small></h6>
                    <h3 style="margin-top:0px;"><?php echo $product["productPrice"] ?>.- NOK</h3>
                    <div class="section" style="padding-bottom:20px;">
                        <h6 class="title-attr"><small>Antall</small></h6>
                        <div>
                            <div class="btn-minus"><span class="glyphicon glyphicon-minus"></span></div>
                            <input value="1"/><a href="#"></a>
                            <div class="btn-plus"><span class="glyphicon glyphicon-plus"></span></div>
                        </div>
                    </div>

                    <!-- Botones de compra -->
                    <div class="section" style="padding-bottom:20px;">
                        <button class="btn btn-success"><span style="margin-right:20px" class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Buy this shit</button>
                    </div>
                    <div class="section" style="padding-bottom:20px;">
                      <h6 class="title-price"><small>Tags</small></h6>
                      <span class="label label-default">Default Label</span>
                      <span class="label label-default">Default Label</span>
                    </div>
                    <div class="section" style="padding-bottom:20px;">
                      <h6 class="title-price"><small>Time Created:  <?php echo $product['productTime'] ?></small></h6>


                    </div>
                </div>

                <div class="col-xs-9">
                  <hr>
                    <div style="width:100%;">
                      <h3>Beskrivelse</h3>
                        <p style="padding:10px;">
                            <small><?php echo $product["productDesc"] ?></small>


                        </p>

                    </div>
                </div>
	</div>
</div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
<?php ob_end_flush(); ?>
