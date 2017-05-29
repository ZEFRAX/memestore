<?php
 ob_start();
 session_start();
 require_once 'includes/dbConnect.php';
 if (isset($_GET['errorwithpurchase'])) {
   $errMSG = "Beklager det var en feil med bestillingen!. Prøv igjen senere.";
   $errTyp = "danger";
 }
 if (isset($_GET['ordercomplete'])) {
   $errMSG = "Bestillingen er lagt til. Ditt bestillings nr er <a href='order.php?ordernr=".htmlspecialchars($_GET["ordercomplete"])."'><u>".htmlspecialchars($_GET["ordercomplete"])."</u></a>";
   $errTyp = "success";
 }
 if (isset($_GET['usermustbelogedin'])) {
   $errMSG = "Du må loggge inn for å kjøpe varer.";
   $errTyp = "danger";
 }


 // if session is not set this will redirect to login page
 #if( !isset($_SESSION['user']) ) {
  #header("Location: index.php");
  #exit;
 #}
 // select loggedin users detail
 $res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow=mysql_fetch_array($res);

?>
<style media="screen">
  .top-buffer { margin-top: 30px;}
</style>
<!DOCTYPE html>
<html>
<?php
include'includes/head.php';
include'includes/navbar.php'; ?>

<body onload="totalc(); checkload(); total();">
 <div id="wrapper">

 <div class="container top-buffer">

     <div class="page-header"></div>
        <div class="row">
        <div class="col-lg-12">
        <h1 class="text-center">Sjekk ut</h1>
        </div>
      </div>

      <?php    if ( isset($errMSG) ) {

          ?>
          <div class="form-group ">
                   <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?> fade in">
                  <a href="index.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <span style="font-size: 30px;"class="<?php if ($errTyp=="success") { echo "glyphicon glyphicon-saved";}else { echo "glyphicon glyphicon-remove";}?>"></span> <?php echo $errMSG; ?>
                      </div>
                   </div>
                   <?php if ($errTyp=="success" || $errTyp=="danger") {?><div class="row"><div class="col-xs-offset-5 col-sm-offset-5 col-md-offset-5 ">
                     <a href=index.php><button  type="button" class="btn">Tilbake til Memestore</button></a>
                   </div>
                 </div><?php }?>
                      <?php
         } ?>

      <div class="panel panel-info top-buffer-20">

				<div class="panel-heading">
					<div class="panel-title">
						<div class="row">
							<div class="col-xs-6">
								<h5><span class="glyphicon glyphicon-shopping-cart"></span> Varer</h5>
							</div>
							<div class="col-xs-6">
                <a href="index.php">
								<button type="button" class="btn btn-primary btn-sm btn-block">
									<span class="glyphicon glyphicon-share-alt"></span> Fortsett å handle
								</button>
                </a>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-body">
          <div id="checkload"></div>
          <div id="emptycart"></div>
					<div class="row">
						<div class="text-center">
							<div class="col-xs-9">
								<h6 class="text-right">Lagt til mer?</h6>
							</div>
							<div class="col-xs-3">
								<button onclick="totalc(); checkload()"type="button" class="btn btn-default btn-sm btn-block">
									Oppdater handlekurv
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<div class="row text-center">
						<div class="col-xs-9">
							<h4 class="text-right">Total: <strong id="totalc">0 Kr</strong></h4>
						</div>
						<div class="col-xs-3">
              <a id="atag" href="<?php if( !isset($_SESSION['user']) ) { echo "login.php";}else{ echo"buy.php";}?>">
							<button id="btag"type="button" class="btn btn-success btn-block">
								<?php if( !isset($_SESSION['user']) ) { echo "Logg inn";}else {echo "Kjøp"; }?>
							</button>
              </a>
						</div>
					</div>
				</div>
			</div>
    </div>
    </div>
    <?php
 ?>

  </body>
</html>
<script>
function removejs2(rem2) {
  var del2 = document.getElementById(rem2);
    del2.remove();
    totalc();
    total();
}
window.setInterval(function(){
  var count = $('div[id^=item]').length
  document.getElementById("count").innerHTML = count;
  document.getElementById("count1").innerHTML = count;
}, 500);

function getSumc(total, num) {
  return total + num;
}
function checkload() {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("checkload").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","checkoutload.php",true);
        xmlhttp.send();}


function totalc(){
  if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
  } else {
      // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var b = this.responseText.split(',').map(Number);
        checkload();
          document.getElementById("totalc").innerHTML = b.reduce(getSumc)+" Kr";
          if (b.reduce(getSumc) == 0) {
            document.getElementById("emptycart").innerHTML = "Handlekurven er tom.";
            document.getElementById("atag").href = "index.php";
            document.getElementById("btag").innerHTML = "Handle";
          }
      }
  };


  xmlhttp.open("GET","total.php",true);
  xmlhttp.send();}

</script>

<?php ob_end_flush(); ?>
