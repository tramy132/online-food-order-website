<?php include('parts/menu.php')?>

        <!--Main Content Section Starts-->
        <div class = "maincontent">
            <div class = "wrapper"> 
                <h1>Update Category</h1>
                <br />
                <?php 
                    //Get the ID of Selected Admin
                    $id=$_GET['id'];

                    //Create SQL Query to Get the Details
                    $sql="SELECT * FROM category WHERE category='$id'";

                    //Execute the Query
                    $res=mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    //Check whether category is found
                    if($count==1)
                    {
                        // Get the Details
                        $row=mysqli_fetch_assoc($res);

                        $category = $row['category'];
                        $image = $row['image'];
                    }
                    else
                    {
                        //Create a Session Variable to Display Message
                        $_SESSION['update'] = "<div class='error'>Category doesn't exist</div>";
                        //Redirect to Manage Admin PAge
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
        
                ?>

                <form action="" method="POST" enctype="multipart/form-data">
                    <table  class="tbl-30">
                        <tr>
                            <td>Category: </td>
                            <td>
                                <input type="text" name="category" value=<?php echo $category; ?>>
                            </td>
                        </tr>

                        <tr>
                            <td>Current Image: </td>
                            <td>
                                    <?php  
                                    //display the image
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/<?php echo $image; ?>" width="100px"> 
                            </td>
                        </tr>

                        <tr>
                            <td>New Image: </td>
                            <td>
                                <input type="file" name="image">
                            </td>
                        </tr>
                    
                        <tr>
                            <td colspan="2">
                                <input type="submit" name="submit" value="Submit" class="btn-secondary">
                            </td>
                        </tr>
            
                    </table>
                </form>
            </div>
        
        </div>
        <!--Main Content Section Ends-->
<?php include('parts/footer.php')?>

<?php
    // Button is clicked or not
    if(isset($_POST['submit'])) {
        //Get the data from Form
            $category = $_POST['category'];
            $image = $_FILES['image']['name'];

        //Check some things
            $check = true;
            if($category == '') {
                $check = false;
                //Create a Session Variable to Display Message
                $_SESSION['null'] = "<div class='error'>Failed to Add Category. Data is mustn't null!</div>";
            } 
            $cur_category = $row['category'];
            $sql1 = "SELECT * FROM category WHERE category = '$category' && category != '$cur_category'";
            $res1 = mysqli_query($conn, $sql1); 
            $count1 = mysqli_num_rows($res1);
            if($count1 > 0) {
                $check = false;
                //Create a Session Variable to Display Message
                $_SESSION['exsit'] = "<div class='error'>Failed to Add Category. Category already exsits!</div>";
            }

        //If have not error => update
        if($check) {
            $cur_category = $row['category'];
            //Upload image we need source path and destination path
            if($image != '') {
                //Remove current image
                    $path = "../images/".$image;
                    $remove = unlink($path);
                //Upload new image
                    //Upload file
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/".$image;
                        $upload = move_uploaded_file($source_path, $destination_path);
                        if($upload == false) {
                            //set message 
                            $_SESSION['upload'] = "<div class = 'error'>Failed to Upload Image</div>";
                        }
                    //Upload data
                        $sql = "UPDATE category SET
                            image = '$image'
                            WHERE category = '$cur_category'
                        ";
                        $res = mysqli_query($conn, $sql);
            }
            //Update
                //Create a SQL Query to Update Admin
                $sql = "UPDATE category SET
                    category = '$category'
                    WHERE category = '$cur_category'
                ";
                //Executing Query and Saving Data into Datbase
                $res = mysqli_query($conn, $sql);
                //Check whether (Query is Executed) and display appropriate message
                if($res == TRUE) {
                    //Create a Session Variable to Display Message
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfully</div>";
                } else {
                    //Create a Session Variable to Display Message
                    $_SESSION['update'] = "<div class='error'>Failed to Update Admin</div>";
                }
        } 
        
        //Redirect Page to Manage Admin
        header("location:".SITEURL.'admin/manage-category.php');
    }
?>