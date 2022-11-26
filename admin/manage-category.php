<?php include('parts/menu.php')?>

        <!--Main Content Section Starts-->
        <div class = "maincontent">
            <div class = "wrapper"> 
                <h1>Manage Category</h1>
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
                <a href="add-category.php" class="btn-primary">Add Category</a>
                <br /><br /><br />
                <table class="tbl-full">
                    <tr>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                        //Query to get all Admin
                        $sql = "SELECT * FROM category";
                        //Execute the Query
                        $res = mysqli_query($conn, $sql) ;
                        //Check whether the Query is Executed or not

                        if($res == TRUE) {
                            $count = mysqli_num_rows($res);
                            //Check whether have data (rows > 0)
                            if($count>0) {
                                while($rows=mysqli_fetch_assoc($res)) {
                                    $category = $rows['category'];
                                    $image = $rows['image'];
                                    ?>
                                    <tr>
                                        <td>
                                            <?php  
                                                //display the image
                                                ?>
                                                <img src="<?php echo SITEURL; ?>images/<?php echo $image; ?>" width="200px"> 
                                        </td>
                                        <td><?php echo $category; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $category; ?>" class="btn-secondary">Update Category</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $category; ?> &image=<?php echo $image; ?>" class="btn-danger">Delete Category</a>
                                       
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