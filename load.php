<?php include'includes/dbConnect.php';

$sql = "SELECT productID, productImage, productPrice, productName, productDesc, productTime, productRating FROM products WHERE productActive ='1' ORDER BY productID DESC";
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
        $additionalClass2 = ($e % 3) == 0 ? " </div>" : "";
        echo "<div class=' col-xs-4 col-sm-4 col-lg-4 col-md-4'>
       <div class='thumbnail'> <a href='site.php?". $row["productID"]."'> <img src='". $row["productImage"] ."' alt=''></a>
       <div class='caption'>
       <h4 class='pull-right'>" . $row["productPrice"].",-</h4>
       <h4><a href='site.php?". $row["productName"]."'>" . $row["productName"] . "</a> </h4>
       <p class='text'>" . $row["productDesc"] . "</p>
       </div>
       <div class='ratings'> <p class='pull-right bottom-align-text'>Added " . $row["productTime"] . "</p>
       <p class='bottom-align-stars'>";
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
       /*
       if ($count < 6 && $count > 0) {
           for ($a = 0; $a < $count; $a++) {
               echo $element;
           }
       }
       else {
           for ($a = 0; $a < $emptyCount; $a++) {
               echo $emptyElement;
           }
       }*/

        echo "</p></div></div></div></a>";
    }

} else {
    echo "0 results";

}
mysql_close($conn);?>
