<?php include('parts/menu.php')?>
        <!--Main Content Section Starts-->
        <div class = "maincontent">
            <div class = "wrapper"> 
                <h1>Update Food</h1>
                <br />

                <?php 
                    //Get the ID of Selected Admin
                    $id=$_GET['id'];

                    //Create SQL Query to Get the Details
                    $sql="SELECT * FROM food WHERE foodId='$id'";

                    //Execute the Query
                    $res=mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    if($count==1)
                    {
                        // Get the Details
                        $row=mysqli_fetch_assoc($res);

                        $foodName = $row['foodName'];
                        $category = $row['category'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $quantity = $row['quantityInStock'];
                        $image = $row['image'];
                    }
                    else
                    {
                        //Create a Session Variable to Display Message
                        $_SESSION['update'] = "<div class='error'>Food doesn't exist</div>";
                        //Redirect to Manage Admin PAge
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
        
                ?>
                <!-- Add Food Form Starts -->
                <form action="" method="POST" enctype="multipart/form-data">
                    <table  class="tbl-30">
                        <tr>
                            <td>Food Name: </td>
                            <td>
                                <input type="text" name="foodName" value=<?php echo $foodName; ?>>
                            </td>
                        </tr>

                        <tr>
                            <td>Category: </td>
                            <td>
                                <select name='category'>

                                    <?php 
                                        //Create PHP Code to display categories from Database
                                        $sql = "SELECT * FROM category";
                                        $res = mysqli_query($conn, $sql);
                                        $count = mysqli_num_rows($res);
                                        if($count>0)
                                        {
                                            $cnt = 1;
                                            while($rows=mysqli_fetch_assoc($res))
                                            {
                                                $category = $rows['category'];
                                                ?>
                                                <option value=<?php echo $category; ?>> <?php echo $category; ?> </option>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            //Do not have category
                                            $_SESSION['null'] = "<div class='error'>Failed to Add Food. Category is mustn't null. Please Add Category!</div>";
                                            header("location:".SITEURL.'admin/manage-food.php');
                                        }
                                    
                                    ?>

                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>Description: </td>
                            <td>
                                <textarea name="description" cols="30" rows="5" value=<?php echo $description; ?>></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>Price: </td>
                            <td>
                                <input type="number" name="price" value=<?php echo $price; ?>>
                            </td>
                        </tr>
                        <tr>
                            <td>Quantity: </td>
                            <td>
                                <input type="number" name="quantityInStock" value=<?php echo $quantity; ?>>
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
                <!-- Add Food Form Ends -->
            </div>
        
        </div>
        <!--Main Content Section Ends-->
<?php include('parts/footer.php')?>

<?php
    // Button is clicked or not
    if(isset($_POST['submit'])) {
        //Get the data from Form
        $foodName = $_POST['foodName'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantityInStock'];
        $image = $_FILES['image']['name'];
 

        //Check some things
        $check = true;
        if($foodName == '' || $category == '' || $description == '' || $price ==''|| $quantity =='') {
            $check = false;
            //Create a Session Variable to Display Message
            $_SESSION['null'] = "<div class='error'>Failed to Add Food. Data is mustn't null!</div>";
        } 
        
        if($check) {
            if($image != '') {
                //Remove current image
                    $path = "../images/".$image;
                    $remove = unlink($path);
                //Upload file image
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/".$image;
                    $upload = move_uploaded_file($source_path, $destination_path);
                    if($upload == false) {
                        //set message 
                        $_SESSION['upload'] = "<div class = 'error'>Failed to Upload Image</div>";
                    } 
                //Upload data image
                    $sql = "UPDATE food SET
                    image = '$image'
                    WHERE foodId = '$id'
                    ";
                    $res = mysqli_query($conn, $sql);
            }
           
            //Upload data
                //SQL Query to Save the data into database
                $sql = "UPDATE food SET
                        foodName =  '$foodName',
                        category =  '$category',
                        description = '$description',
                        price = '$price',
                        quantityInStock = '$quantity'
                        WHERE foodId = '$id'
                ";
                //Executing Query and Saving Data into Datbase
                $res = mysqli_query($conn, $sql); 
                //Check whether (Query is Executed) and display appropriate message
                if($res == TRUE) {
                    //Create a Session Variable to Display Message
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully!</div>";
                    header("location:".SITEURL.'admin/manage-food.php');
                } 
        } 
        //Redirect to Manage Admin Page
        header("location:".SITEURL.'admin/manage-food.php');
    }
?>
