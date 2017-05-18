<?php
include_once'includes/dbConnect.php';

$sql = "SELECT productImage, productPrice, productName, productDesc, productTime FROM products";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "                    <div class='col-sm-4 col-lg-4 col-md-4'>
                                <div class='thumbnail'>
                                    <img src='". $row["productImage"] ."' alt=''>
                                    <div class='caption'>
                                        <h4 class='pull-right'>" . $row["productPrice"].",-</h4>
                                        <h4><a href='#'>" . $row["productName"] . "</a>
                                        </h4>
                                        <p>" . $row["productDesc"] . "</p>
                                    </div>
                                    <div class='ratings'>
                                        <p class='pull-right'>Added " . $row["productTime"] . "</p>
                                        <p>
                                            <span class='glyphicon glyphicon-star'></span>
                                            <span class='glyphicon glyphicon-star'></span>
                                            <span class='glyphicon glyphicon-star'></span>
                                            <span class='glyphicon glyphicon-star'></span>
                                            <span class='glyphicon glyphicon-star'></span>
                                        </p>
                                    </div>
                                </div>
                            </div>";
                          }
                        } else {
                          echo "0 results";
                        }
                        ?>
