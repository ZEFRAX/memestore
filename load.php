<?php
include 'includes/dbConnect.php';

$sql    = "SELECT productImage, productPrice, productName, productDesc, productTime, productRating FROM products";
$result = mysql_query($sql);
if (mysql_num_rows($result) > 0) {
    // output data of each row
    $i = 0;
    $e = 0;
    while ($row = mysql_fetch_assoc($result)) {
        $i++;
        $e++;

        $element      = "<span class='glyphicon glyphicon-star'></span>";
        $emptyElement = "<span class='glyphicon glyphicon-star-empty'></span>";
        $emptyCount   = 5;
        $count        = $row["productRating"];

        $additionalClass  = ($i % 3) == 0 ? " <div class='row'>" : "";
        $additionalClass2 = ($e % 3) == 0 ? " </div>" : "";
        echo "" . $additionalClass . "<div class=' col-xs-4 col-sm-4 col-lg-4 col-md-4'>
       <div class='thumbnail cube'> <img src='" . $row["productImage"] . "' alt=''>
       <div class='caption'>
       <h4 class='pull-right'>" . $row["productPrice"] . ",-</h4>
       <h4><a href='#'>" . $row["productName"] . "</a> </h4>
       <p class='text'>" . $row["productDesc"] . "</p>
       </div>
       <div class='ratings'> <p class='pull-right bottom-align-text'>Added " . $row["productTime"] . "</p>
       <p class='bottom-align-stars'>";

        if ($count < 6 && $count > 0) {
            for ($a = 0; $a < $count; $a++) {
                echo $element;
            }
        } else {
            for ($a = 0; $a < $emptyCount; $a++) {
                echo $emptyElement;
            }
        }

        echo "</p></div></div></div>" . $additionalClass2 . "";
    }

} else {
    echo "0 results";

}
mysql_close($conn);
?>
