<?php include('parts/menu.php')?>
        <!--Main Content Section Starts-->
        <div class = "maincontent">
            <div class = "wrapper">
                <h1>Your Cart contains:</h1>
                <br />
                <?php
                    if(isset($_SESSION['checkout']))
                    {
                        echo $_SESSION['checkout']; 
                        unset($_SESSION['checkout']); 
                    }
                    if(isset($_SESSION['update-quantity']))
                    {
                        echo $_SESSION['update-quantity']; 
                        unset($_SESSION['update-quantity']); 
                    }
                ?>
                <br /> 
                    

                <table class="tbl-full">
                <tr>
                    <th>Image</th>
                    <th>Food Name</th>
                    <th>Max Quantity</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
                <?php
                    $userId = $_SESSION['userId'];
                    $sql = "SELECT * FROM cart WHERE userId = '$userId'";
                    $res = mysqli_query($conn, $sql) ;
                    $count = mysqli_num_rows($res);
                    if($count>0) {
                        $amount = 0;
                        while($rows=mysqli_fetch_assoc($res)) {
                            $foodId = $rows['foodId'];
                            $quantity = $rows['quantity'];
                            $sql1 = "SELECT * FROM food WHERE foodId = '$foodId'";
                            $res1 = mysqli_query($conn, $sql1);
                            $row = mysqli_fetch_assoc($res1);
                            $foodName = $row['foodName'];
                            $image = $row['image'];
                            $qis = $row['quantityInStock'];
                            $price = $row['price'];
                            $amount += $quantity * $price;

                            ?>
                            <tr>
                                <td>
                                    <?php  
                                        //display the image
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/<?php echo $image; ?>" width="200px"> 
                                </td>
                                <td><?php echo $foodName; ?></td>
                                <td><?php echo $qis; ?></td>
                                <td><?php echo $quantity; ?></td>
                                <td>$<?php echo $price; ?></td>

                                <td>
                                    <a href="<?php echo SITEURL; ?>user/cart-update-quantity.php?foodId=<?php echo $foodId; ?>" class="btn-secondary">Update Quantity</a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        <form action="" method="POST">
                            <td>Total Price:$<?php echo $amount; ?></td>
                            <td>
                                <input type="submit" name="submit" value="Checkout" class="btn-secondary">
                            </td>
                        </form>
                        <?php
                    }

                ?>
            </table>
        </div>
        
    </div>
<?php include('parts/footer.php')?>
<?php
    if(isset($_POST['submit'])) {
        $orderDate = date("Y-m-d h:i:sa");
        $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled
        // Insert order
        $sql1 = "INSERT INTO orders (orderDate, status, userId)
                VALUES ('$orderDate', '$status', '$userId')";
        $res1 = mysqli_query($conn, $sql1);
        
        // get orderId   
        $sql11 = "SELECT LAST_INSERT_ID() as orderId";
        $res11 = mysqli_query($conn, $sql11);
        $row = mysqli_fetch_assoc($res11);
        $orderId = $row['orderId'];

        // insert orderdetails
        $sql2 = "INSERT INTO orderdetails (orderId, foodId, quantity, priceEach) 
                SELECT o.orderId, f.foodId, c.quantity, f.price
                FROM (SELECT orderId, userId FROM orders WHERE orderId = '$orderId') as o 
                INNER JOIN cart as c ON o.userId = c.userId
                INNER JOIN food as f ON c.foodId = f.foodId";
        $res2 = mysqli_query($conn, $sql2);

        //update quantity in food 
        $userId = $_SESSION['userId'];
        $sql = "SELECT * FROM cart WHERE userId = '$userId'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if($count>0) {
            while($rows=mysqli_fetch_assoc($res)) {
                $foodId = $rows['foodId'];
                $quantity = $rows['quantity'];
                $sql1 = "UPDATE food SET
                        quantityInStock = quantityInStock - '$quantity' 
                        WHERE foodId = '$foodId'";
                $res1 = mysqli_query($conn, $sql1);    
            }
        }

        // delete cart
        $sql3 = "DELETE FROM cart WHERE userId ='$userId'";
        $res3 = mysqli_query($conn, $sql3);
        $_SESSION['checkout'] = "<div class='success'>Checkout Successfully!</div>";
        header("location:".SITEURL."user/cart.php");
    }
?>
