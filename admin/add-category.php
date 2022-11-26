<?php include('parts/menu.php')?>
        <!--Main Content Section Starts-->
        <div class = "maincontent">
            <div class = "wrapper"> 
                <h1>Add Category</h1>
                <br />
                <!-- Add Category Form Starts -->
                <form action="" method="POST" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td>Category: </td>
                            <td>
                                <input type="text" name="category" placeholder="Enter Category">
                            </td>
                        </tr>

                        <tr>
                            <td>Image: </td>
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
                <!-- Add Category Form Ends -->
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
        if($category == '' || $image =='') {
            $check = false;
            //Create a Session Variable to Display Message
            $_SESSION['null'] = "<div class='error'>Failed to Add Category. Data is mustn't null!</div>";
        } 
        $sql1 = "SELECT * FROM category WHERE category = '$category'";
        $res1 = mysqli_query($conn, $sql1); 
        $count1 = mysqli_num_rows($res1);
        if($count1 > 0) {
            $check = false;
            //Create a Session Variable to Display Message
            $_SESSION['exsit'] = "<div class='error'>Failed to Add Category. Category already exsits!</div>";
        }
        
        if($check) {
            //Upload image we need source path and destination path
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/".$image;
            $upload = move_uploaded_file($source_path, $destination_path);
            if($upload == false) {
                //set message 
                $_SESSION['upload'] = "<div class = 'error'>Failed to Upload Image</div>";
            }
            //SQL Query
            $sql = "INSERT INTO category (category, image) 
                    VALUES ('$category', '$image')";
            //Executing Query
            $res = mysqli_query($conn, $sql); 
            //Check whether (Query is Executed) and display appropriate message
            if($res == TRUE) {
                //Create a Session Variable to Display Message
                $_SESSION['add'] = "<div class='success'>Category Added Successfully!</div>";;
            } 
        } 
        
        //Redirect Page to Manage Category
        header("location:".SITEURL.'admin/manage-category.php');
    }
?>
