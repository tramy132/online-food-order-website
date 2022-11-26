<?php 

    //Include constants.php file here
    include('../config/constants.php');
    //get the category and image of Category to be deleted
    $id = $_GET['id']; 
    $image = $_GET['image'];
    //Remove image file
        $path = "../images/".$image;
        $remove = unlink($path);
    
    //Delete
        //Create SQL Query to Delete Catetory
        $sql = "DELETE FROM food WHERE foodId = '$id'";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        // Check whether the query is executed  or not
        if($res == true) {
            //Create Session Variable to Display Message
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully!</div>";
        } else{
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category. Try Again Later!</div>";
        }
    //Redirect to Manage Admin Page
    header('location:'.SITEURL.'admin/manage-food.php');
?>