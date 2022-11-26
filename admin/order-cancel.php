<?php 
    include('../config/constants.php');

    $orderId = $_GET['orderId'];
    $date = date("Y-m-d h:i:sa");
    $sql = "UPDATE orders SET
            status = 'Cancelled'
            WHERE orderId = '$orderId'";
    $res = mysqli_query($conn, $sql);
    if($res==true) {
        $_SESSION['confirm'] = "<div class='success'>Cancelled Order Successfully!</div>";
    } else{
        $_SESSION['confirm'] = "<div class='error'>Failed to cancel. Try Again Later!</div>";
    }
    header('location:'.SITEURL.'admin/manage-order.php');
?>