<?php
    include('../config/constants.php');
    $foodId = $_GET['foodId'];
    $userId = $_SESSION['userId'];
    $sql1 = "SELECT * FROM cart WHERE foodId = '$foodId' AND userId = '$userId'";
    $res1 = mysqli_query($conn, $sql1);
    $count = mysqli_num_rows($res1);
    if($count == 0) {
        $sql2 = "INSERT INTO cart (foodId, userId, quantity) 
            VALUES ('$foodId', '$userId', '1')";
        $res2 = mysqli_query($conn, $sql2);
        if($res2 == true) {
            $_SESSION['add-cart'] = "<div class='success'>Food Added to Cart Successfully!</div>";
        }
    }  
    header("location:".SITEURL.'user/food.php');
?>