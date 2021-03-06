<?php
 ob_start();
 session_start();
 require_once 'includes/dbConnect.php';
 include'includes/head.php';
 include'includes/navbar.php';

 // it will never let you open index(login) page if session is set

 if ( isset($_SESSION['user'])!="" ) {
  header("Location: index.php");
  exit;
 }



 $error = false;

 if( isset($_POST['btn-login']) ) {

  // prevent sql injections/ clear user invalid inputs
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  // prevent sql injections / clear user invalid inputs

  if(empty($email)){
   $error = true;
   $emailError = "Please enter your email address.";
  } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  }

  if(empty($pass)){
   $error = true;
   $passError = "Please enter your password.";
  }

  // if there's no error, continue to login
  if (!$error) {

   $password = hash('sha256', $pass); // password hashing using SHA256

   $res=mysql_query("SELECT userId, userName, userPass FROM users WHERE userEmail='$email'");
   $row=mysql_fetch_array($res);
   $count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row

   if( $count == 1 && $row['userPass']==$password ) {
    $_SESSION['user'] = $row['userId'];
    header("Location: index.php");
   } else {
    $errMSG = "Incorrect Credentials, Try again...";
   }

  }

 }


 if (isset($_GET['success'])) {
   $succMSG = "Success creating account, Please login below!";

 }



?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login to the store</title>

<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
</head>
<body>

<div class="container">

 <div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

     <div class="col-md-12">

         <div class="form-group">
             <h2 class="top-buffer-50">Logg inn.</h2>
            </div>

         <div class="form-group">
             <hr />
            </div>

<!--success message -->
            <?php
   if ( isset($errMSG) ) {


    ?>
    <div class="form-group">
             <div class="alert alert-danger">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
             </div><?php
           }
?>

    <?php
if ( isset($succMSG) ) {


?>
<div class="form-group">
     <div class="alert alert-success">
<span class="glyphicon glyphicon-info-sign"></span> <?php echo $succMSG; ?>
        </div>
     </div>

<?php
}
?>
<!--success message END -->


            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
             <input type="email" name="email" class="form-control" placeholder="Din Epostadresse" value="<?php echo $email; ?>" maxlength="40" />
                </div>
                <span class="text-danger"><?php echo $emailError; ?></span>
            </div>

            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
             <input type="password" name="pass" class="form-control" placeholder="Ditt Passord" maxlength="15" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>

            <div class="form-group">
             <hr />
            </div>

            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-login">Logg inn</button>
            </div>

            <div class="form-group">
             <hr />
            </div>

            <div class="form-group">
             <a href="register.php">Registrer deg her...</a>
            </div>

        </div>

    </form>
    </div>

</div>

</body>
</html>


<?php ob_end_flush(); ?>
