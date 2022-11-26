<?php include('parts/menu.php')?>

<!-- Food Section Starts Here -->
<section class="categories">
    <div class="container">
        <h1 class="textcenter">Food Menu</h1>
        <br><br><br>
        <?php 
            if(isset($_SESSION['add-cart']))
            {
                echo $_SESSION['add-cart']; 
                unset($_SESSION['add-cart']); 
            }
        ?>
        <br><br><br>
        <?php
            $category = $_GET['category'];
            //Sql Query
            $sql = "SELECT * FROM food WHERE category = '$category'";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Count Rows
            $count = mysqli_num_rows($res);

            //CHeck whether categories available or not
            if($count>0)
            {
                //CAtegories Available
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get the Values
                    $foodId = $row['foodId'];
                    $foodName = $row['foodName'];
                    $price = $row['price'];
                    $image = $row['image'];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <img src="<?php echo SITEURL; ?>images/<?php echo $image; ?>" class="img-responsive img-curve">
                        </div>

                        <div class="food-menu-desc">
                            <h3 class="float-text"><?php echo $foodName; ?></h3>
                            <h3 class="food-price">$<?php echo $price; ?></h3>
                            <td>
                                
                                <a href="<?php echo SITEURL; ?>user/detail-food.php?foodId=<?php echo $foodId; ?>" class="btn-secondary">Detail</a>
                                <a href="<?php echo SITEURL; ?>user/add-cart.php?foodId=<?php echo $foodId; ?>" class="btn-danger">Add to Cart</a>
                            </td>
                        </div>
                    </div>
                    <?php
                }
            }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<?php include('parts/footer.php')?>