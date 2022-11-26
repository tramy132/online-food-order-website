<?php include('parts/menu.php')?>

        <!--Main Content Section Starts-->
        <div class = "maincontent">
            <div class = "wrapper"> 
                <h1>Manage Food</h1>
                <br />
                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add']; //Displaying Session Message
                        unset($_SESSION['add']); //Removing Session Message
                    }
                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    } 
                    if(isset($_SESSION['null']))
                    {
                        echo $_SESSION['null']; 
                        unset($_SESSION['null']); 
                    }
                    if(isset($_SESSION['exsit']))
                    {
                        echo $_SESSION['exsit']; 
                        unset($_SESSION['exsit']);
                    }
                   
                ?>
                <br /><br />
                <a href="add-food.php" class="btn-primary">Add Food</a>
                <br /><br /><br />
                <table class="tbl-full">
                    <tr>
                        <th>Image</th>
                        <th>Food Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                        //Query to get all Admin
                        $sql = "SELECT * FROM food";
                        //Execute the Query
                        $res = mysqli_query($conn, $sql) ;
                        //Check whether the Query is Executed or not

                        if($res == TRUE) {
                            $count = mysqli_num_rows($res);
                            //Check whether have data (rows > 0)
                            if($count>0) {
                                while($rows=mysqli_fetch_assoc($res)) {
                                    $id = $rows['foodId'];
                                    $foodName = $rows['foodName'];
                                    $category = $rows['category'];
                                    $price = $rows['price'];
                                    $quantity = $rows['quantityInStock'];
                                    $image = $rows['image'];
                                    ?>
                                    <tr>
                                        <td>
                                            <?php  
                                                //display the image
                                                ?>
                                                <img src="<?php echo SITEURL; ?>images/<?php echo $image; ?>" width="200px"> 
                                        </td>
                                        <td><?php echo $foodName; ?></td>
                                        <td><?php echo $category; ?></td>
                                        <td>$<?php echo $price; ?></td>
                                        <td><?php echo $quantity; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?> &image=<?php echo $image; ?>" class="btn-danger">Delete Food</a>
                                       
                                        </td>
                                    </tr>
                                    <?php

                                }
                            }
                        }
                    ?>
                </table>
            </div>
            
        </div>
        <!--Main Content Section Ends-->

<?php include('parts/footer.php')?>