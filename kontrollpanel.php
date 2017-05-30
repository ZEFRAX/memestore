
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
// direct users if they do not have 1 as their user stat.
if ($userRow['userStat'] != '1') {
  header("Location: index.php");}
  //Edit html under here  vvvv


 $error = false;

 if ( isset($_POST['btn-signup']) ) {

  // clean user inputs to prevent sql injections
  $productName = trim($_POST['productName']);
  $productName = strip_tags($productName);
  $productName = htmlspecialchars($productName);

  $productTag = trim($_POST['productTag']);
  $productTag = strip_tags($productTag);
  $productTag = htmlspecialchars($productTag);

  $productDesc = trim($_POST['productDesc']);
  $productDesc = strip_tags($productDesc);
  $productDesc = htmlspecialchars($productDesc);

  $productPrice = trim($_POST['productPrice']);
  $productPrice = strip_tags($productPrice);
  $productPrice = htmlspecialchars($productPrice);

  $productStock = trim($_POST['productStock']);
  $productStock = strip_tags($productStock);
  $productStock = htmlspecialchars($productStock);

  $productImage = htmlspecialchars($target_file);

  $productRating = trim($_POST['productRating']);
  $productRating = strip_tags($productRating);
  $productRating = htmlspecialchars($productRating);

  $productActive = trim($_POST['productActive']);
  $productActive = strip_tags($productActive);
  $productActive = htmlspecialchars($productActive);

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if file already exists
if (file_exists($target_file)) {
  $errTyp = "danger";
  $errMSG = "Filen finnes allerede";
  $error = true;
}
// Check file size
// Allow certain file formats
  // if there's no error, continue to signup
  if( !$error ) {

   $query = "INSERT INTO products(productName,productTag, productDesc,productPrice, productStock, productImage, productRating, productActive) VALUES('$productName', '$productTag', '$productDesc','$productPrice','$productStock','$target_file','$productRating','$productActive')";
   $res = mysql_query($query);

   if ($res && move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $errTyp = "success";
    $errMSG = "Produktet ble lagt til!";
    unset($productName);
    unset($productTag);
    unset($productDesc);
    unset($productPrice);
    unset($productStock);
    unset($productRating);
  } else {
    $errTyp = "danger";
    $errMSG = "Noe gikk galt :( Prøv igjen senere!)";
  }
}
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Registrering</title>
</head>
<body id="body" onload="isColor();">

<div class="container top-buffer-40">
  <div id="txtHint" class="top-buffer-40">
  <hr />
  <?php    if ( isset($errMSG) ) {

      ?>
      <div class="form-group ">
               <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?> fade in">
              <a href="index.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <span style="font-size: 30px;"class="<?php if ($errTyp=="success") { echo "glyphicon glyphicon-saved";}else { echo "glyphicon glyphicon-remove";}?>"></span> <?php echo $errMSG; ?>
                  </div>
               </div>
                  <?php
     } ?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" href="#collapse">Legg til varer</a>
      </h4>
    </div>
    <div id="collapse" class="collapse panel-body">
      <div id="login-form">
        <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"autocomplete="off">
         <div class="form-group">
            </div>
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></span>
             <input type="text" name="productName" class="form-control" placeholder="Varenavn" maxlength="50" required value="<?php echo $productName ?>" />
                </div>
                <span class="text-danger"><?php echo $productNameError; ?></span>
            </div>

            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></span>
                <input type="text" name="productTag" class="form-control" placeholder="Separer Tags med komma" maxlength="50" required value="<?php echo $productTag ?>" />
                </div>
                <span class="text-danger"><?php echo $productTagError; ?></span>
            </div>


            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-edit"></span></span>
             <textarea  type="text" name="productDesc" class="form-control" required placeholder="Beskrivelse"cols="40" rows="5"><?php if(isset($_POST['productDesc'])) { echo htmlentities ($_POST['productDesc']); }?></textarea>
                </div>
                <span class="text-danger"><?php echo $productDescError; ?></span>
            </div>


            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
             <input type="text" name="productPrice" class="form-control" placeholder="Pris" required pattern="[0-9].{0,9}" title="Må inneholde ett tall fra 0 til 9999999" required maxlength="7" value="<?php echo $productPrice ?>" />
                </div>
                <span class="text-danger"><?php echo $productPriceError; ?></span>
            </div>
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-inbox"></span></span>
             <input type="text" name="productStock" class="form-control" placeholder="Stock" required pattern="[0-9].{0,9}" title="Må kun inneholde tall. Minst ett!" maxlength="4" value="<?php echo $productStock ?>"/>
                </div>
                <span class="text-danger"><?php echo $productStockError; ?></span>
            </div>
            <script type="text/javascript">
            function update() {
              var fullPath = document.getElementById('fileToUpload').value;
              var filenamepath = fullPath.replace(/^.*[\\\/]/, '')
              var ext = filenamepath.substring(filenamepath.lastIndexOf('.')+1, filenamepath.length) || filenamepath;
              var checkmark = document.getElementById('checkdiv');
              if(ext !="jpeg" && ext !="png" && ext !="jpg" && ext !="webm" && ext !="gif" && ext !="mp4"){
                document.getElementById("warning").innerHTML = "Filen må være av typen JPEG, PNG, JPG, WEBM, GIF og MP4";
                document.getElementById("fileToUpload").value = "";
              }else {
                document.getElementById("warning").innerHTML = "";
            }
            }
            </script>
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-picture"><span id="checkdiv" class=""></span></span></span>
                <input type="file" placeholder="Last opp bilde" name="fileToUpload" required onchange="update();" id="fileToUpload" class="form-control"/>
              </div>
              <span id="warning" class= "text-danger"><?php echo $productImageError; ?></span>
            </div>

            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-star"></span></span>
             <input type="text" name="productRating" class="form-control" placeholder="Rating number 0 - 5" required pattern="[0-5]" title="Må inneholde ett tall fra 0 til 5" maxlength="1" value="<?php echo $productRating ?>"/>
                </div>
                <span class="text-danger"><?php echo $productRatingError ?></span>
            </div>
            <div class="form-group">
              <label for="sel1">Er produktet aktivt?</label><br>
              <select name="productActive" class="form-control" >
                <option value="1">Ja</option>
                <option value="0">Nei</option>
                </select>
              </div>
            <div class="form-group">
             <hr />
            </div>
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Lagre</button>
            </div>
            <hr>
            <div class="form-group text-center">
              <a data-toggle="collapse" href="#collapse">Lukk</a>
            </div>
    </form>
    </div>
    </div>
    </div>
    <hr>
    </div>
</div>
</body>
</html>
<script>
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
