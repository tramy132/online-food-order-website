<?php 
    include('../config/constants.php');

    $orderId = $_GET['orderId'];
    $date = date("Y-m-d h:i:sa");
    $sql = "UPDATE orders SET
            status = 'Deliveried',
            shippedDate = '$date'
            WHERE orderId = '$orderId'";
    $res = mysqli_query($conn, $sql);
    if($res==true) {
        $_SESSION['confirm'] = "<div class='success'>Deliveried Successfully!</div>";
    } else{
        $_SESSION['confirm'] = "<div class='error'>Failed to deliveried. Try Again Later!</div>";
    }
    header('location:'.SITEURL.'user/order.php');
?>