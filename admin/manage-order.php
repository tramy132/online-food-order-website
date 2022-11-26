<?php include('parts/menu.php')?>

        <!--Main Content Section Starts-->
        <div class = "maincontent">
            <div class = "wrapper"> 
                <h1>Manage Order</h1>
                <br />
                <?php
                    if(isset($_SESSION['confirm']))
                    {
                        echo $_SESSION['confirm']; 
                        unset($_SESSION['confirm']); 
                    }
                   
                ?>
                <br /><br />
                <table class="tbl-full">
                    <tr>
                        <th>Username</th>
                        <th>Order Date</th>
                        <th>Shipped Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                        $sql = "SELECT * FROM orders";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        if($count>0) {
                            while($rows=mysqli_fetch_assoc($res)) {
                                $orderId = $rows['orderId'];
                                $orderDate = $rows['orderDate'];
                                $shippedDate = $rows['shippedDate'];
                                $status = $rows['status'];
                                $userId = $rows['userId'];

                                $sql1 = "SELECT * FROM users WHERE userId = '$userId'";
                                $res1 = mysqli_query($conn, $sql1);
                                $row=mysqli_fetch_assoc($res1);
                                $username = $row['username'];
                                ?>
                                <tr>
                                    <td><?php echo $username; ?></td>
                                    <td><?php echo $orderDate; ?></td>
                                    <td><?php echo $shippedDate; ?></td>
                                    <td><?php echo $status; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/show-order.php?orderId=<?php echo $orderId; ?>" class="btn-third">Show Order</a>
                                         
                                        <?php 
                                            if($status == 'Ordered') {
                                                ?>
                                                <a href="<?php echo SITEURL; ?>admin/order-confirm.php?orderId=<?php echo $orderId; ?>" class="btn-secondary">Confirm Order</a>
                                                <a href="<?php echo SITEURL; ?>admin/order-cancel.php?orderId=<?php echo $orderId; ?>" class="btn-danger">Cancel</a>
                                            <?php
                                            } 
                                            ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    ?>
                </table>
            </div>
            
        </div>
        <!--Main Content Section Ends-->

<?php include('parts/footer.php')?>