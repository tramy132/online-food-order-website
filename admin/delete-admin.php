<?php 

    //Include constants.php file here
    include('../config/constants.php');

    //get the ID of Admin to be deleted
    $id = $_GET['id'];
    //Create SQL Query to Delete Admin
    $sql = "DELETE FROM admins WHERE adminId = $id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    // Check whether the query is executed  or not
    if($res==true) {
        //Create Session Variable to Display Message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully!</div>";
        //Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
    } else{
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again Later!</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

?>