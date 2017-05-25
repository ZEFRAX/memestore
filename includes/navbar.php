
<nav class="navbar navbar-inverse navbar-fixed-top">
     <div class="container">
       <div class="navbar-header">
         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
           <span class="sr-only">Toggle navigation</span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
         </button>
         <a class="navbar-brand" href="index.php">MemeStore</a>
       </div>
       <?php $site = $_SERVER['REQUEST_URI']; ?>


       <div id="navbar" class="navbar-collapse collapse">
         <ul class="nav navbar-nav">
           <!--replace                       vvvvvv with the site that you are on.    vvvvvvv-->
           <li class="<?php if ($site == "/index.php") {echo "active";} ?>"><a href="index.php">Hjem</a></li>
           <li class="<?php if ($site == "/register.php") {echo "active";} ?>"><a href="register.php">Registrer</a></li>
           <li class="<?php if ($site == "/login.php") {echo "active";} ?>"><a href="login.php">Logg inn</a></li>
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
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="glyphicon glyphicon-shopping-cart"></span> 7 - Items<span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-cart" role="menu">
            <li class="top-buffer-10 text-center" href="">Handlevogn</li>
            <li class="divider"></li>

              <li>
                  <span class="item">
                    <span class="item-left">
                        <img src="http://lorempixel.com/50/50/" alt="" />
                        <span class="item-info">
                            <span>Item name</span>
                            <span>23$</span>
                            <span>Antall: 1</span>
                        </span>
                    </span>
                    <span class="item-right">
                        <button class="btn btn-xs btn-danger pull-right">x</button>
                    </span>
                </span>
              </li>
              <li>
                  <span class="item">
                    <span class="item-left">
                        <img src="http://lorempixel.com/50/50/" alt="" />
                        <span class="item-info">
                            <span>Item name</span>
                            <span>23$</span>
                            <span>Antall: 1</span>
                        </span>
                    </span>
                    <span class="item-right">
                        <button class="btn btn-xs btn-danger pull-right">x</button>
                    </span>
                </span>
              </li>



              <li class="divider"></li>
              <li><a class="text-center" href="">View Cart</a></li>
          </ul>
        </li>
      </ul>
      <style media="screen">
      ul.dropdown-cart{
  min-width:250px;
}
ul.dropdown-cart li .item{
  display:block;
  padding:3px 10px;
  margin: 3px 0;
}
ul.dropdown-cart li .item:hover{
  background-color:#f3f3f3;
}
ul.dropdown-cart li .item:after{
  visibility: hidden;
  display: block;
  font-size: 0;
  content: " ";
  clear: both;
  height: 0;
}

ul.dropdown-cart li .item-left{
  float:left;
}
ul.dropdown-cart li .item-left img,
ul.dropdown-cart li .item-left span.item-info{
  float:left;
}
ul.dropdown-cart li .item-left span.item-info{
  margin-left:10px;
}
ul.dropdown-cart li .item-left span.item-info span{
  display:block;
}
ul.dropdown-cart li .item-right{
  float:right;
}
ul.dropdown-cart li .item-right button{
  margin-top:14px;
}
      </style>



       </div><!--/.nav-collapse -->
     </div>
   </nav>
