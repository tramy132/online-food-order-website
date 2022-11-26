<?php include('parts/menu.php')?>

        <!--Main Content Section Starts-->
        <div class = "maincontent">
            <div class = "wrapper"> 
                <h1>Your Order</h1>
                <br />
                <?php
                    if(isset($_SESSION['']))
                    {
                        echo $_SESSION['add']; 
                        unset($_SESSION['add']); 
                    }
                   
                ?>
                <br /><br />
                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Order Date</th>
                        <th>Shipped Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                        $userId = $_SESSION['userId'];
                        $sql = "SELECT * FROM orders WHERE userId = '$userId'";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        if($count>0) {
                            $cnt = 0;
                            while($rows=mysqli_fetch_assoc($res)) {
                                $orderId = $rows['orderId'];
                                $orderDate = $rows['orderDate'];
                                $shippedDate = $rows['shippedDate'];
                                $status = $rows['status'];
                                ?>
                                <tr>
                                    <td><?php echo ++$cnt; ?></td>
                                    <td><?php echo $orderDate; ?></td>
                                    <td><?php echo $shippedDate; ?></td>
                                    <td><?php echo $status; ?></td>
                                    <td> 
                                            <a href="<?php echo SITEURL; ?>user/detail-order.php?orderId=<?php echo $orderId; ?>" class="btn-secondary">Detail Order</a>
                                            <?php 
                                                if($status == "On Delivery") {
                                                    ?>
                                                    <a href="<?php echo SITEURL; ?>user/order-deliveried.php?orderId=<?php echo $orderId; ?>" class="btn-third">Deliveried</a>
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