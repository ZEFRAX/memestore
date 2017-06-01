<?php
 ob_start();
 session_start();
 require_once 'includes/dbConnect.php';

 // if session is not set this will redirect to login page
 #if( !isset($_SESSION['user']) ) {
  #header("Location: index.php");
  #exit;
 #}
 // select loggedin users detail
 $res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow=@mysql_fetch_array($res);
 $sql = "SELECT productCategory FROM products WHERE productCategory != '' GROUP BY productCategory";
 $result = mysql_query($sql);

?>
<!DOCTYPE html>
<html>
<?php
include'includes/head.php';
include'includes/navbar.php'; ?>
<body id="body"onload="load(); cartload(); isColor();">
  <div id="wrapper">
    <div class=" container top-buffer-40">
      <div class="">
        <div class="col-lg-12">
          <h1>High quality memes
            <div style="float:right; display:inline-block;"class="form-group form-inline">
              <select id="sort" onchange="loadCatSort()"class="form-control" style="margin-top:5px;">
                <option value=''>Sorter</option>
                <option value='priceLow'>Pris Lav til høy</option>
                <option value='priceHigh'>Pris Høy til lav</option>
                <option value='new'>Nyeste</option>
                <option value='old'>Eldste</option>
              </select>

              <select id="category"onchange="loadCatSort()"class="form-control" style=" margin-top:5px ">
                <option value=''>Velg kategori</option>
              <?php
              if (mysql_num_rows($result) > 0) {
                  while($row = mysql_fetch_assoc($result)) {
                  echo "<option value='".$row['productCategory']."'>".$row['productCategory']."</option>";
                  }}?>

                    </select>
                    </div></h1>

        </div>
      </div>
      <div class="">
        <div id="txtHint"></div>
        <div id="txtHint2"></div>
    </div>
    </div>
  </div>
</body>
</html>
<script>
window.setInterval(function(){
}, 30000);
function load() {
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
        xmlhttp.open("GET","load.php",true);
        xmlhttp.send();}
        var q;


        function loadCatSort() {
          var cat = document.getElementById("category").value;
          var sort = document.getElementById("sort").value;
          var q= "";

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
                if (cat !="") {
                  q = "category=" +cat;
                }

                if (sort !="") {
                  q = "sort=" +sort;
                  if (cat !="") {
                    q = q + "&" + "category="+cat;

                  }
                }
                xmlhttp.open("GET","load.php?"+q,true);
                xmlhttp.send();}


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
          }else {
            $("#body").css('background-color','white');}
        }
</script>
<?php ob_end_flush(); ?>
