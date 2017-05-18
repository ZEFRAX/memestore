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
 $userRow=mysql_fetch_array($res);

?>
<!DOCTYPE html>
<html>
<?php
include'includes/head.php';
include'includes/navbar.php'; ?>

<body>

  <div id="wrapper">
    <div class="container top-buffer-30">
      <div class="page-header">
        <h3>Standard side</h3>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <h1>Standard side som alle kan se om man har en bruker eller ikke  </h1>
        </div>
      </div>
      <div class="container">


                <div class="row">

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="http://placehold.it/320x150" alt="">
                            <div class="caption">
                                <h4 class="pull-right">$24.99</h4>
                                <h4><a href="#">First Product</a>
                                </h4>
                                <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">15 reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="http://placehold.it/320x150" alt="">
                            <div class="caption">
                                <h4 class="pull-right">$64.99</h4>
                                <h4><a href="#">Second Product</a>
                                </h4>
                                <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">12 reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="http://placehold.it/320x150" alt="">
                            <div class="caption">
                                <h4 class="pull-right">$74.99</h4>
                                <h4><a href="#">Third Product</a>
                                </h4>
                                <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">31 reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="row">

                      <div class="col-sm-4 col-lg-4 col-md-4">
                          <div class="thumbnail">
                              <img src="http://placehold.it/320x150" alt="">
                              <div class="caption">
                                  <h4 class="pull-right">$24.99</h4>
                                  <h4><a href="#">Fourth Product</a>
                                  </h4>
                                  <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                              </div>
                              <div class="ratings">
                                  <p class="pull-right">15 reviews</p>
                                  <p>
                                      <span class="glyphicon glyphicon-star"></span>
                                      <span class="glyphicon glyphicon-star"></span>
                                      <span class="glyphicon glyphicon-star"></span>
                                      <span class="glyphicon glyphicon-star"></span>
                                      <span class="glyphicon glyphicon-star"></span>
                                  </p>
                              </div>
                          </div>
                      </div>

                      <div class="col-sm-4 col-lg-4 col-md-4">
                          <div class="thumbnail">
                              <img src="http://placehold.it/320x150" alt="">
                              <div class="caption">
                                  <h4 class="pull-right">$64.99</h4>
                                  <h4><a href="#">Fifth Product</a>
                                  </h4>
                                  <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                              </div>
                              <div class="ratings">
                                  <p class="pull-right">12 reviews</p>
                                  <p>
                                      <span class="glyphicon glyphicon-star"></span>
                                      <span class="glyphicon glyphicon-star"></span>
                                      <span class="glyphicon glyphicon-star"></span>
                                      <span class="glyphicon glyphicon-star"></span>
                                      <span class="glyphicon glyphicon-star-empty"></span>
                                  </p>
                              </div>
                          </div>
                      </div>

                      <div class="col-sm-4 col-lg-4 col-md-4">
                          <div class="thumbnail">
                              <img src="http://placehold.it/320x150" alt="">
                              <div class="caption">
                                  <h4 class="pull-right">$74.99</h4>
                                  <h4><a href="#">Sixth Product</a>
                                  </h4>
                                  <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                              </div>
                              <div class="ratings">
                                  <p class="pull-right">31 reviews</p>
                                  <p>
                                      <span class="glyphicon glyphicon-star"></span>
                                      <span class="glyphicon glyphicon-star"></span>
                                      <span class="glyphicon glyphicon-star"></span>
                                      <span class="glyphicon glyphicon-star"></span>
                                      <span class="glyphicon glyphicon-star-empty"></span>
                                  </p>
                              </div>
                          </div>
                      </div>


    </div>
  </div>
</body>
</html>
<?php ob_end_flush(); ?>
