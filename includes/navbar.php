
<nav class="navbar navbar-inverse navbar-fixed-top">
     <div class="container">
       <div class="navbar-header">
         <a class="navbar-brand" href="index.php">MemeStore</a>
       </div>
       <?php $site = $_SERVER['REQUEST_URI']; ?>


       <div id="navbar" class="navbar-collapse collapse">
         <ul class="nav navbar-nav">
           <!--replace                       vvvvvv with the site that you are on.    vvvvvvv-->
           <li class="<?php if ($site == "/index.php") {echo "active";} ?>"><a href="index.php">Hjem</a></li>
         </ul>
         <!-- Navbar dropdown meny-->
         <ul class="nav navbar-nav navbar-right">
           <li class="dropdown">
             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
    <span class="glyphicon glyphicon-user"></span>&nbsp;<?php if( isset($_SESSION['user']) ) {echo $userRow['userEmail'];}else{echo"Logg inn / Registrer";}?>&nbsp;<span class="caret"></span></a>
             <ul class="dropdown-menu">
               <!-- Dynamic buttons based on user session -->
               <?php if ($userRow['userStat'] == '1') { echo "<li><a href='Kontrollpanel.php'><span class='glyphicon glyphicon-wrench'></span>&nbsp;Kontrollpanel</a></li>";} ?>
               <?php if( isset($_SESSION['user']) ) { echo "<li><a href='usersettings.php'><span class='glyphicon glyphicon-cog'></span>&nbsp;Bruker innstillinger</a></li>"; } ?>
               <?php if( !isset($_SESSION['user']) ) { echo "<li><a href='register.php'><span class='glyphicon glyphicon-edit'></span>&nbsp;Registrer</a></li>"; } ?>
               <?php if( !isset($_SESSION['user']) ) { echo "<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span>&nbsp;Logg inn</a></li>"; } ?>
               <?php if( isset($_SESSION['user']) ) { echo "<li><a href='logout.php?logout'><span class='glyphicon glyphicon-log-out'></span>&nbsp;Logg av</a></li>"; } ?>
             </ul>
           </li>
         </ul>
         <ul class="nav navbar-nav navbar-right">

        <li class="dropdown">
          <a href="#" class="dropdown" > <i class="glyphicon glyphicon-shopping-cart"></i></span> Handlevogn <span id="count"class="badge">0</span></a>
          <ul class="dropdown-content">
            <div class="container2">
              <div class="shopping-cart">
              <div class="shopping-cart-header">
                <i class="glyphicon glyphicon-shopping-cart"></i></span> Handlevogn <span id="count1" class="badge">0</span>
                <div style="float:right;"class="shopping-cart-total">
                  <span class="lighter-text">Total:</span>
                  <span id="total"class="main-color-text">0.-</span>
                </div>
              </div>
              <hr>
            <?php  ?>
            <div style="max-height: 800px; overflow:scroll; overflow-x: hidden;"class="">


            <script>
            function deleteFromCart(val){
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
              xmlhttp.open("GET","deletefromcart.php?"+val,true);
              xmlhttp.send();

            }
            function getSum(total, num) {
              return total + num;
            }
            function total(){
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

                    cartload();
                      document.getElementById("total").innerHTML = b.reduce(getSum)+" Kr";

                  }
              };
              xmlhttp.open("GET","total.php",true);
              xmlhttp.send();}


                    function cartload() {
                            if (window.XMLHttpRequest) {
                                // code for IE7+, Firefox, Chrome, Opera, Safari
                                xmlhttp = new XMLHttpRequest();
                            } else {
                                // code for IE6, IE5
                                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                            }
                            xmlhttp.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    document.getElementById("cartload").innerHTML = this.responseText;
                                }
                            };
                            xmlhttp.open("GET","cartload.php",true);
                            xmlhttp.send();}


                            function removejs(rem) {
                              var del = document.getElementById(rem);
                                del.remove();
                            }



            </script>


            <div id="cartload"></div>
            </div>
            <script type="text/javascript">
            window.setInterval(function(){
              total();

            }, 5000);
            window.setInterval(function(){
              var count = $('div[id^=item]').length
              document.getElementById("count").innerHTML = count;
              document.getElementById("count1").innerHTML = count;
            }, 50);
            </script>


            <div class="text-center">
              <a href="checkout.php"><div class="btn btn-success">Vis handlevogn</div></a></div>
              </div>
            </div> <!--end of container-->
          </ul>

        </li>
      </ul>
       </div><!--/.nav-collapse -->
     </div>
   </nav>
