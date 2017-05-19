
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
   $productDescError = "Please enter valid productDesc";
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

// productStock validation
if (empty($productRating)){
 $error = true;
 $productRatingError = "Skriv inn productRating";
}





$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

// Check if file already exists
if (file_exists($target_file)) {
  $productImageColor = "text-danger";
  $productImageError = "Filen finnes allerede!";
  $error = true;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 10000000) {
  $productImageColor = "text-danger";
  $productImageError = "Filen er for stor!";
  $error = true;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $productImageColor = "text-danger";
  $productImageError = "Beklager b are JPG, JPEG, PNG, MP4, WEBM & GIF filer er tillat.";
  $error = true;
}

  // if there's no error, continue to signup
  if( !$error ) {

   $query = "INSERT INTO products(productName,productTag, productDesc,productPrice, productStock, productImage, productRating) VALUES('$productName', '$productTag', '$productDesc','$productPrice','$productStock','$target_file','$productRating')";
   $res = mysql_query($query);

   if ($res & move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $errTyp = "success";

    $errMSG = "Produktet ble lagt till!";
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
<body>

<div class="container top-buffer-30">

 <div id="login-form">
    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"autocomplete="off">

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
                <span class="text-danger"><?php echo $productTagError; ?></span>
            </div>

            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-edit"></span></span>
             <textarea  type="text" name="productDesc" class="form-control" placeholder="Beskrivelse"cols="40" rows="5" value="<?php echo $productDesc ?>"></textarea>
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
             <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" placeholder="productImage link" maxlength="9999999999" value=""/>

                </div>
                <span class= <?php echo $productImageColor;?> ><?php echo $productImageError; ?></span>
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
