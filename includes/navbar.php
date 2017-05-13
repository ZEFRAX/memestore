
<nav class="navbar navbar-default navbar-fixed-top">
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
       <div id="navbar" class="navbar-collapse collapse">
         <ul class="nav navbar-nav">
           <li class="active"><a href="#">Back to Article</a></li>
           <li><a href="#">jQuery</a></li>
           <li><a href="#">PHP</a></li>
         </ul>
         <!-- Navbar dropdown meny-->
         <ul class="nav navbar-nav navbar-right">
           <li class="dropdown">
             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
    <span class="glyphicon glyphicon-user"></span>&nbsp;<?php if( isset($_SESSION['user']) ) {echo $userRow['userEmail'];}else{echo"Logg inn";}?>&nbsp;<span class="caret"></span></a>
             <ul class="dropdown-menu">
               <!-- Dynamic buttons based on user session -->
               <?php if ($userRow['userStat'] == '1') { echo "<li><a href='Kontrollpanel.php'><span class='glyphicon glyphicon-cog'></span>&nbsp;Kontrollpanel</a></li>";} ?>
               <?php if( isset($_SESSION['user']) ) { echo "<li><a href='usersettings.php'><span class='glyphicon glyphicon-user'></span>&nbsp;Bruker innstillinger</a></li>"; } ?>
               <?php if( !isset($_SESSION['user']) ) { echo "<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span>&nbsp;Logg inn</a></li>"; } ?>
               <?php if( isset($_SESSION['user']) ) { echo "<li><a href='logout.php?logout'><span class='glyphicon glyphicon-log-out'></span>&nbsp;Logg av</a></li>"; } ?>
             </ul>
           </li>
         </ul>
       </div><!--/.nav-collapse -->
     </div>
   </nav>
