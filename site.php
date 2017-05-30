<?php
 ob_start();
 session_start();
 require_once 'includes/dbConnect.php';
 // select loggedin users detail
 $res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow=@mysql_fetch_array($res);

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

<body id="body"onload="cartload(); total(); isColor();">
  <div id="wrapper">
    <div class="container top-buffer-30">
      <div id="txtHint" class="top-buffer-40">


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
                      }
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
                    </div>

                    <!-- Botones de compra -->
                    <div class="section" style="padding-bottom:20px;">
                        <a><button onclick="addToCart(<?php echo $product['productID']; ?>); cartload(); total(); totalc();"class="btn btn-success"><span style="margin-right:20px" class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Kjøp</button></a>
                    </div>
                    <div class="section" style="padding-bottom:20px;">
                      <h6 class="title-price"><small>Tags</small></h6>
                      <?php
                      $tags = $product['productTag'];
                      $extags = explode(",", $tags);

                      foreach ($extags as $id) {
                         ?><span class="label label-primary"><?php echo $id; ?></span>&nbsp;<?php
                      }
                       ?>

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
  </div>
</body>
</html>
<script type="text/javascript">
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
function isColor() {
  if(localStorage.getItem('color') == '0') {
    $("#body").css('background-color','#161616');
    document.getElementById("onoff").innerHTML = localStorage.getItem("color");
  }else {
    $("#body").css('background-color','white');}
    document.getElementById("onoff").innerHTML = localStorage.getItem("color");
}


function search(){

  var q = document.getElementById("search").value;

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
  xmlhttp.open("GET","search.php?q="+q,true);
  xmlhttp.send();
}

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
