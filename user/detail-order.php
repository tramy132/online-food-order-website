<?php include('parts/menu.php')?>
        <!--Main Content Section Starts-->
        <div class = "maincontent">
            <div class = "wrapper">
                <h1>Detail Order</h1>
            
                <br /> 
                <table class="tbl-full">
                <tr>
                    <th>Image</th>
                    <th>Food Name</th>
                    <th>Quantity</th>
                    <th>Price Each</th>
                </tr>
                <?php
                    $orderId = $_GET['orderId'];
                    $sql = "SELECT * FROM orderdetails WHERE orderId = '$orderId'";
                    $res = mysqli_query($conn, $sql) ;
                    $count = mysqli_num_rows($res);
                    if($count>0) {
                        $amount = 0;
                        $totalq = 0;
                        while($rows=mysqli_fetch_assoc($res)) {
                            $foodId = $rows['foodId'];
                            $quantity = $rows['quantity'];
                            $price = $rows['priceEach'];
                            $sql1 = "SELECT * FROM food WHERE foodId = '$foodId'";
                            $res1 = mysqli_query($conn, $sql1);
                            $row = mysqli_fetch_assoc($res1);
                            $foodName = $row['foodName'];
                            $image = $row['image'];
                            $amount += $quantity * $price;
                            $totalq += $quantity;

                            ?>
                            <tr>
                                <td>
                                    <?php  
                                        //display the image
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/<?php echo $image; ?>" width="200px"> 
                                </td>
                                <td><?php echo $foodName; ?></td>
                                <td><?php echo $quantity; ?></td>
                                <td>$<?php echo $price; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td>Total Quantity: <?php echo $totalq; ?></td>
                        </tr>
                        <tr>
                            <td>Total Price: $<?php echo $amount; ?></td>
                        </tr>
                        <?php
                    }

                ?>
            </table>
        </div>
        
    </div>
<?php include('parts/footer.php')?>

