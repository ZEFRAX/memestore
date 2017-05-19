<?php include'includes/dbConnect.php';

$sql = "SELECT productImage, productPrice, productName, productDesc, productTime FROM products";
$result = mysql_query($sql);
 if (mysql_num_rows($result) > 0) {
    // output data of each row
    $i = 0;
    $e = 0;
    while($row = mysql_fetch_assoc($result)) {
      $i++;
      $e++;

      $additionalClass = ($i % 3) == 0 ? " <div class='row'>" : "";
      $additionalClass2 = ($e % 3) == 0 ? " </div>" : "";
       echo "".$additionalClass."<div class 'row'><div class=' col-xs-4 col-sm-4 col-lg-4 col-md-4'>
       <div class='thumbnail cube'> <img src='". $row["productImage"] ."' alt=''>
       <div class='caption'>
       <h4 class='pull-right'>" . $row["productPrice"].",-</h4>
       <h4><a href='#'>" . $row["productName"] . "</a> </h4>
       <p class='text'>" . $row["productDesc"] . "</p>
       </div>
       <div class='ratings'> <p class='pull-right bottom-align-text'>Added " . $row["productTime"] . "</p>
       <p class='bottom-align-stars'> <span class='glyphicon glyphicon-star'></span>
       <span class='glyphicon glyphicon-star'></span>
       <span class='glyphicon glyphicon-star'></span>
       <span class='glyphicon glyphicon-star'></span>
       <span class='glyphicon glyphicon-star'></span>
       </p>
       </div>
        </div>
        </div>
        </div>".$additionalClass2."";

      }


     } else {
       echo "0 results";

     }
     mysql_close($conn);?>
