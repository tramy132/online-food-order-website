<?php include('parts/menu.php')?>
        <!--Main Content Section Starts-->
        <div class = "maincontent">
            <div class = "wrapper"> 
                <h1>Update Quantity</h1>
                <br />
                <!-- Update Quantity Form Starts -->
                <?php
                    $foodId = $_GET['foodId'];
                    $userId = $_SESSION['userId'];
                    $sql = "SELECT * FROM cart WHERE foodId = '$foodId' AND userId = '$userId'";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($res);
                    $quantity = $row['quantity'];

                    $sql1 = "SELECT * FROM food WHERE foodId = '$foodId'";
                    $res1 = mysqli_query($conn, $sql1);
                    $row1 = mysqli_fetch_assoc($res1);
                    $qit = $row1['quantityInStock'];
                ?>

                <form action="" method="POST">
                    <table>
                        <tr>
                            <td>Quantity: </td>
                            <td>
                                <input type="number" name="quantity" value=<?php echo $quantity; ?> max = <?php echo $qit; ?>>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <input type="submit" name="submit" value="Update" class="btn-secondary">
                            </td>
                        </tr>
            
                    </table>
                </form>
                <!-- Update Quantity Form Ends -->
            </div>
        
        </div>
        <!--Main Content Section Ends-->
<?php include('parts/footer.php')?>

<?php
    // Button is clicked or not
    if(isset($_POST['submit'])) {
        //Get the data from Form
        $quantity = $_POST['quantity'];

        if($quantity == 0) {
            // Delete food in cart
            $sql = "DELETE FROM cart WHERE foodId = '$foodId' AND userId = '$userId'";
            $res = mysqli_query($conn, $sql);
            if($res == TRUE) {
                $_SESSION['update-quantity'] = "<div class = 'success'> Update Quantity Successfull!</div>";
            } 
        } else {
            // update quantity
            $sql = "UPDATE cart SET
                    quantity = '$quantity'
                    WHERE foodId = '$foodId' AND userId = '$userId'";
            $res = mysqli_query($conn, $sql);
            if($res == TRUE) {
                $_SESSION['update-quantity'] = "<div class = 'success'> Update Quantity Successfull!</div>";
            }
        }

        
        //Redirect Page to cart.php
        header("location:".SITEURL.'user/cart.php');
    }
?>
