<?php include('parts/menu.php')?>
        <!--Main Content Section Starts-->
        <div class = "maincontent">
            <div class = "wrapper">
                <h1>Detail Food</h1>
                <br />
                <?php
                    if(isset($_SESSION['add-cart']))
                    {
                        echo $_SESSION['add-cart']; 
                        unset($_SESSION['add-cart']); 
                    }

                ?>
                <br />
                <?php 
                    $id=$_GET['foodId'];

                    //Create SQL Query to Get the Details
                    $sql="SELECT * FROM food WHERE foodId='$id'";

                    //Execute the Query
                    $res=mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    //Check whether category is found
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
                ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <img src="<?php echo SITEURL; ?>images/<?php echo $image; ?>" width = "500px" class="img-curve">
                        </tr>
                        <tr>
                            <td>Food Name: <?php echo $foodName; ?></td>
                        </tr>

                        <tr>
                            <td>Category: <?php echo $category; ?></td>
                        </tr>

                        <tr>
                            <td>Description: <?php echo $description; ?></td>
                        </tr>

                        <tr>
                            <td>Price: $<?php echo $price; ?></td>
                            
                        </tr>
                        <tr>
                            <td>Quantity: <?php echo $quantity; ?></td>
                            
                        </tr>
                    
                        <tr>
                            <td colspan="2">
                                <input type="submit" name="submit" value="Add to Cart" class="btn-secondary">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
<?php include('parts/footer.php')?>
<?php
    if(isset($_POST['submit'])) {
        $userId = $_SESSION['userId'];
        $sql1 = "SELECT * FROM cart WHERE foodId = '$id' AND userId = '$userId'";
        $res1 = mysqli_query($conn, $sql1);
        $count = mysqli_num_rows($res1);
        if($count == 0) {
            $sql2 = "INSERT INTO cart (foodId, userId, quantity) 
                VALUES ('$id', '$userId', '1')";
            $res2 = mysqli_query($conn, $sql2);
            if($res2 == true) {
                $_SESSION['add-cart'] = "<div class='success'>Food Added to Cart Successfully!</div>";
            }
        } 
    }
?>

