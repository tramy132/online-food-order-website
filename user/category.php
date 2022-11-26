<?php include('parts/menu.php')?>

<!-- Category Section Starts Here -->
<div class = "maincontent">
    <div class = "wrapper container"> 
        <h1 class="textcenter pink-white">Explore Foods</h1>
        <br><br>

        <?php 
            //Sql Query
            $sql = "SELECT * FROM category";
            //Execute the Query
            $res = mysqli_query($conn, $sql);
            //Count Rows
            $count = mysqli_num_rows($res);
            //Check whether category available or not
            if($count>0)
            {
                //CAtegories Available
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get the Values
                    $category = $row['category'];
                    $image = $row['image'];
                    ?>
                    <a href="<?php echo SITEURL; ?>user/detail-category.php?category=<?php echo $category; ?>">
                        <div class="box-4 float-container">
                            <img src="<?php echo SITEURL; ?>images/<?php echo $image; ?>" class="img-responsive img-curve">
                                    
                            <h3 class="text-yellow"><?php echo $category; ?></h3>

                        </div>
                    </a>

                    <?php
                }
            }
        
        ?>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Categories Section Ends Here -->

<?php include('parts/footer.php')?>