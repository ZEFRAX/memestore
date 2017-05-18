
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

  $productImage = trim($_POST['productImage']);
  $productImage = strip_tags($productImage);
  $productImage = htmlspecialchars($productImage);

  $productRating = trim($_POST['productRating']);
  $productRating = strip_tags($productRating);
  $productRating = htmlspecialchars($productRating);




  // basic production name
  if (empty($productName)) {
   $error = true;
   $productNameError = "Please enter your full productName.";
  } else if (strlen($productName) < 3) {
   $error = true;
   $productNameError = "Name must have atleat 3 characters.";
 } else if (!preg_match("/^[a-zA-Z ÆØÅæøå]+$/",$productName)) {
   $error = true;
   $productNameError = "productName must contain alphabets and space.";
  }

  //basic product Tag
  if (empty($productTag)) {
   $error = true;
   $productTagError = "Please enter valid productTag address.";
 }else{
   $productTag = strtolower($productTag);

 }

  //basic product description
  if (empty($productDesc)) {
   $error = true;
   $productDescError = "Please enter valid productDesc address.";
  }

  // basic productPrice validation
  if (empty($productPrice)) {
   $error = true;
   $productPriceError = "Please enter your full productPrice.";
 } else if (!preg_match("/^[0-9]+$/",$productPrice)) {
   $error = true;
   $productPriceError = "productPrice must contain alphabets and space.";
  }

  // productStock validation
  if (empty($productStock)){
   $error = true;
   $productStockError = "Skriv inn productStock";
 }

 // productImage validation
 if (empty($productImage)){
  $error = true;
  $productImageError = "Skriv inn productImage";
}
// productStock validation
if (empty($productRating)){
 $error = true;
 $productRatingError = "Skriv inn productRating";
}

  // if there's no error, continue to signup
  if( !$error ) {

   $query = "INSERT INTO products(productName,productTag, productDesc,productPrice, productStock, productImage, productRating) VALUES('$productName', '$productTag', '$productDesc','$productPrice','$productStock','$productImage','$productRating')";
   $res = mysql_query($query);

   if ($res) {
    $errTyp = "success";
    $errMSG = "Successfully registered, you may login now";
    unset($productName);
    unset($productTag);
    unset($productDesc);
    unset($productPrice);
    unset($productStock);
    unset($productImage);
    unset($productRating);
   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later...";
   }

  }


 }
?>
<!DOCTYPE html>
<html>
<head>
<title>Registrering</title>
</head>
<body>

<div class="container top-buffer-30">

 <div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

     <div class="col-md-12">

         <div class="form-group">
             <h2 class="">Legg til varer</h2>
            </div>

         <div class="form-group">
             <hr />
            </div>

            <?php
   if ( isset($errMSG) ) {

    ?>
    <div class="form-group ">
             <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
             </div>
                <?php
   }
   ?>

            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></span>
             <input type="text" name="productName" class="form-control" placeholder="Varenavn" maxlength="50" value="<?php echo $productName ?>" />
                </div>
                <span class="text-danger"><?php echo $productNameError; ?></span>
            </div>

            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></span>
             <input type="text" name="productTag" class="form-control" placeholder="Tag" maxlength="50" value="<?php echo $productTag ?>" />
                </div>
                <span class="text-danger"><?php echo $productNameError; ?></span>
            </div>

            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-edit"></span></span>
             <input type="text" name="productDesc" class="form-control" placeholder="Beskrivelse" maxlength="40" value="<?php echo $productDesc ?>" />
                </div>
                <span class="text-danger"><?php echo $productDescError; ?></span>
            </div>

            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
             <input type="text" name="productPrice" class="form-control" placeholder="Pris" maxlength="8" value="<?php echo $productPrice ?>" />
                </div>
                <span class="text-danger"><?php echo $productPriceError; ?></span>
            </div>

            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-inbox"></span></span>
             <input type="text" name="productStock" class="form-control" placeholder="Stock" maxlength="15" value="<?php echo $productStock ?>"/>
                </div>
                <span class="text-danger"><?php echo $productStockError; ?></span>
            </div>

            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-picture"></span></span>
             <input type="text" name="productImage" class="form-control" placeholder="productImage link" maxlength="15" value="<?php echo $productImage ?>"/>
                </div>
                <span class="text-danger"><?php echo $productImageError; ?></span>
            </div>

            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-star"></span></span>
             <input type="text" name="productRating" class="form-control" placeholder="Rating number" maxlength="15" value="<?php echo $productRating ?>"/>
                </div>
                <span class="text-danger"><?php echo $productRatingError; ?></span>
            </div>




            <div class="form-group">
             <hr />
            </div>

            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Lagre</button>
            </div>

            <div class="form-group">
             <hr />
            </div>
        </div>

    </form>
    </div>

</div>

</body>
</html>
<?php ob_end_flush(); ?>
