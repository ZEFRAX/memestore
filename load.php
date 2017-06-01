<?php include'includes/dbConnect.php';

$sql = "SELECT productID, productImage, productPrice, productName, productDesc, productTime, productRating FROM products WHERE productActive ='1' ORDER BY productID DESC";

if (isset($_GET['category'])) {
    $sql = "SELECT productID, productImage, productPrice, productName, productDesc, productTime, productRating
    FROM products WHERE productActive ='1' and productCategory = '".$_GET['category']."' ORDER BY productID DESC";
}
if (isset($_GET['sort'])) {
  switch ($_GET['sort']) {

    case 'priceLow':
    $cat="";
    if (isset($_GET['category'])) {
      $cat = "and productCategory = '".$_GET['category']."'";
    }
    $sql = "SELECT productID, productImage, productPrice, productName, productDesc, productTime, productRating
    FROM products WHERE productActive ='1' ".$cat." ORDER BY productPrice ASC";
      break;

    case 'priceHigh':
    if (isset($_GET['category'])) {
      $cat = "and productCategory = '".$_GET['category']."'";
    }
    $sql = "SELECT productID, productImage, productPrice, productName, productDesc, productTime, productRating
    FROM products WHERE productActive ='1' ".$cat." ORDER BY productPrice DESC";
      break;

    case 'new':
    if (isset($_GET['category'])) {
      $cat = "and productCategory = '".$_GET['category']."'";
    }
    $sql = "SELECT productID, productImage, productPrice, productName, productDesc, productTime, productRating
    FROM products WHERE productActive ='1' ".$cat." ORDER BY productID DESC";
      break;

    case 'old':
    if (isset($_GET['category'])) {
      $cat = "and productCategory = '".$_GET['category']."'";
    }
    $sql = "SELECT productID, productImage, productPrice, productName, productDesc, productTime, productRating
    FROM products WHERE productActive ='1' ".$cat." ORDER BY productID ASC";
      break;
  }
}
$result = mysql_query($sql);
if (mysql_num_rows($result) > 0) {
    // output data of each row
    $i = 0;
    $e = 0;
    while($row = mysql_fetch_assoc($result)) {
        $i++;
        $e++;

        $element = "<span class='glyphicon glyphicon-star'></span>";
        $emptyElement = "<span class='glyphicon glyphicon-star-empty'></span>";
        $emptyCount = 5;
        $count = $row["productRating"];

        $additionalClass = ($i % 3) == 0 ? " <div class='row'>" : "";
        $additionalClass2 = ($e % 3) == 0 ? " </div>" : "";?>
        <?php echo $additionalClass ?>

            <div class="col-sm-4">
                <div class="col-item">
                  <a href="site.php?<?php echo $row["productID"] ?>">
                    <div style="width:100%; max-height: 300px; overflow:auto;"class="photo">
                      <?php
                      $target_file = $row["productImage"];
                      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                      if ($imageFileType == "mp4" || $imageFileType == "webm") {
                        echo "<video style='width:100%' loop muted src='".$row["productImage"]."'autoplay ></video>";
                    }
                      else {
                      echo "<img style=''src='". $row["productImage"] ."'class='img-responsive' alt='a' />";
                    }?>
                    </div>
                    </a>
                    <div class="info">
                        <div class="row">
                            <div class="price col-md-6">
                              <a href="site.php?<?php echo $row["productID"] ?>">
                                <h4 style="color:black;">
                                    <?php echo $row["productName"] ?></h4></a>
                                <h5 class="price-text-color">
                                    <?php echo $row["productPrice"] ?>,- Kr</h5>
                            </div>
                            <div class="rating hidden-sm col-md-6">
                                     <?php
                                       // Rating System
                                       switch($count) {
                                           case 0:
                                               echo $emptyElement;
                                               echo $emptyElement;
                                               echo $emptyElement;
                                               echo $emptyElement;
                                               echo $emptyElement;
                                               break;
                                           case 1:
                                               echo $element;
                                               echo $emptyElement;
                                               echo $emptyElement;
                                               echo $emptyElement;
                                               echo $emptyElement;
                                               break;
                                           case 2:
                                               echo $element;
                                               echo $element;
                                               echo $emptyElement;
                                               echo $emptyElement;
                                               echo $emptyElement;
                                               break;
                                           case 3:
                                               echo $element;
                                               echo $element;
                                               echo $element;
                                               echo $emptyElement;
                                               echo $emptyElement;
                                               break;
                                           case 4:
                                               echo $element;
                                               echo $element;
                                               echo $element;
                                               echo $element;
                                               echo $emptyElement;
                                               break;
                                           case 5:
                                               echo $element;
                                               echo $element;
                                               echo $element;
                                               echo $element;
                                               echo $element;
                                               break;
                                           default:
                                               echo $emptyElement;
                                               echo $emptyElement;
                                               echo $emptyElement;
                                               echo $emptyElement;
                                               echo $emptyElement;
                                               break;
                                       }
                                     ?>
                            </div>
                        </div>
                        <div class="separator clear-left">
                          <a onclick="addToCart(<?php echo $row['productID']; ?>); cartload(); total();" class="hidden-sm">
                            <p class="btn btn-add">
                                <i class="glyphicon glyphicon-shopping-cart-"></i>Kjøp</p></a>
                            <p class=" btn btn-details">
                                <i class="fa fa-list"></i><a href="site.php?<?php echo $row["productID"] ?>" class="hidden-sm">Fler detaljer</a></p>
                              </div>
                              <div class="clearfix">
                        </div>
                    </div>
                </div>
            </div>
      <?php echo $additionalClass2;?>
<?php
    }

} else {
    echo "0 results";

}
mysql_close($conn);?>
