
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




  // basic name validation
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

  //basic email validation
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

// productStock validation
if (empty($productRating)){
 $error = true;
 $productRatingError = "Skriv inn productRating";
}

  // if there's no error, continue to signup
  if( !$error ) {

   $query = "INSERT INTO products(productName,productDesc,productPrice, productStock, productImage, productRating) VALUES('$productName','$productDesc','$productPrice','$productStock','$productImage','$productRating')";
   $res = mysql_query($query);

   if ($res) {
    $errTyp = "success";
    $errMSG = "Successfully registered, you may login now";
    unset($productName);
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
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  // Check if image file is a actual image or fake image
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  // Check if $uploadOk is set to 0 by an error
  // Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

  if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
      } else {
          echo "Sorry, there was an error uploading your file.";
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
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="productName" class="form-control" placeholder="Varenavn" maxlength="50" value="<?php echo $productName ?>" />
                </div>
                <span class="text-danger"><?php echo $productNameError; ?></span>
            </div>

            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></span>
             <input type="text" name="productDesc" class="form-control" placeholder="Beskrivelse" maxlength="40" value="<?php echo $productDesc ?>" />
                </div>
                <span class="text-danger"><?php echo $productDescError; ?></span>
            </div>

            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></span>
             <input type="text" name="productPrice" class="form-control" placeholder="Pris" maxlength="8" value="<?php echo $productPrice ?>" />
                </div>
                <span class="text-danger"><?php echo $productPriceError; ?></span>
            </div>

            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
             <input type="text" name="productStock" class="form-control" placeholder="Stock" maxlength="15" value="<?php echo $productStock ?>"/>
                </div>
                <span class="text-danger"><?php echo $productStockError; ?></span>
            </div>

            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
             <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" placeholder="productImage link" maxlength="15" value="<?php echo $productImage ?>"/>
                </div>
                <span class="text-danger"><?php echo $productImageError; ?></span>
            </div>

            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
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
