<?php include('parts/menu.php')?>

        <!--Main Content Section Starts-->
        <div class = "maincontent">
            <div class = "wrapper"> 
                <h1>Dashboard</h1>
                <?php 
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <a href="<?php echo SITEURL; ?>admin/manage-category.php">
                    <div class = "col-4 textcenter"> 
                        <?php 
                            //Sql Query 
                            $sql = "SELECT * FROM category";
                            //Execute Query
                            $res = mysqli_query($conn, $sql);
                            //Count Rows
                            $count = mysqli_num_rows($res);
                        ?>

                        <h1><?php echo $count; ?></h1>
                        <br />
                        Categories
                    </div>
                </a>

                <a href="<?php echo SITEURL; ?>admin/manage-food.php">
                    <div class = "col-4 textcenter"> 
                        <?php 
                            //Sql Query 
                            $sql = "SELECT * FROM food";
                            //Execute Query
                            $res = mysqli_query($conn, $sql);
                            //Count Rows
                            $count = mysqli_num_rows($res);
                        ?>

                        <h1><?php echo $count; ?></h1>
                        <br />
                        Foods
                    </div>
                </a>

                <a href="<?php echo SITEURL; ?>admin/manage-order.php">
                    <div class = "col-4 textcenter"> 
                        <?php 
                            //Sql Query 
                            $sql = "SELECT * FROM orders";
                            //Execute Query
                            $res = mysqli_query($conn, $sql);
                            //Count Rows
                            $count = mysqli_num_rows($res);
                        ?>

                        <h1><?php echo $count; ?></h1>
                        <br />
                        Total Orders
                    </div>
                </a>

                <a href="<?php echo SITEURL; ?>admin/manage-user.php">
                    <div class = "col-4 textcenter"> 
                        <?php 
                            //Sql Query 
                            $sql = "SELECT * FROM users";
                            //Execute Query
                            $res = mysqli_query($conn, $sql);
                            //Count Rows
                            $count = mysqli_num_rows($res);
                        ?>

                        <h1><?php echo $count; ?></h1>
                        <br />
                        Total Users
                    </div>
                </a>

                <div class="clearfix"></div>
            
            </div>
        </div>
        <!--Main Content Section Ends-->
<?php include('parts/footer.php')?>