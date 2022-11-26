<?php 
    include('../config/constants.php');

    $orderId = $_GET['orderId'];
    // Delivery
    $sql = "UPDATE orders SET
            status = 'On Delivery'
            WHERE orderId = '$orderId' AND status = 'Ordered'";
    $res = mysqli_query($conn, $sql);
    if($res==true) {
        $_SESSION['confirm'] = "<div class='success'>status change to On Delivery!</div>";
    } else{
        $_SESSION['confirm'] = "<div class='error'>Failed to confirm. Try Again Later!</div>";
    }
    header('location:'.SITEURL.'admin/manage-order.php');
?>