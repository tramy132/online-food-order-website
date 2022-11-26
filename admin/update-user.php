<?php include('parts/menu.php')?>
        <!--Main Content Section Starts-->
        <div class = "maincontent">
            <div class = "wrapper"> 
                <h1>Add User</h1>
                <br />
                <?php 
                    //Get the ID of Selected Admin
                    $id=$_GET['id'];

                    //Create SQL Query to Get the Details
                    $sql="SELECT * FROM users WHERE userId='$id'";

                    //Execute the Query
                    $res=mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    //Check whether category is found
                    if($count==1)
                    {
                        // Get the Details
                        $row=mysqli_fetch_assoc($res);

                        $fullname = $row['fullname'];
                        $username = $row['username'];
                        $email = $row['email'];
                        $password = $row['password'];
                        $phone = $row['phone'];
                        $address = $row['address'];
                    }
                    else
                    {
                        //Create a Session Variable to Display Message
                        $_SESSION['update'] = "<div class='error'>Food doesn't exist</div>";
                        //Redirect to Manage Admin PAge
                        header('location:'.SITEURL.'admin/manage-user.php');
                    }
        
                ?>
                <form action="" method="POST">
                    <table  class="tbl-30">
                        <tr>
                            <td>Full Name: </td>
                            <td>
                                <input type="text" name="fullname" value=<?php echo $fullname; ?> >
                            </td>
                        </tr>

                        <tr>
                            <td>Username: </td>
                            <td>
                                <input type="text" name="username" value=<?php echo $username; ?>>
                            </td>
                        </tr>

                        <tr>
                            <td>Email: </td>
                            <td>
                                <input type="email" name="email" value=<?php echo $email; ?>>
                            </td>
                        </tr>

                        <tr>
                            <td>Password: </td>
                            <td>
                                <input type="password" name="password" value=<?php echo $password; ?>>
                            </td>
                        </tr>

                        <tr>
                            <td>Phone: </td>
                            <td>
                                <input type="text" name="phone" value=<?php echo $phone; ?>>
                            </td>
                        </tr>

                        <tr>
                            <td>Address: </td>
                            <td>
                                <input type="text" name="address" value=<?php echo $address; ?>>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <input type="submit" name="submit" value="Submit" class="btn-secondary">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        
        </div>
        <!--Main Content Section Ends-->
<?php include('parts/footer.php')?>

<?php
    // Button is clicked or not
    if(isset($_POST['submit'])) {
        //Get the Data from form
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        //Check some things
        $check = true;
        if($fullname == '' || $username == '' || $email =='' || $password == '' || $phone == '' || $address == '') {
            $check = false;
            //Create a Session Variable to Display Message
            $_SESSION['null'] = "<div class='error'>Failed to Update User. Data is mustn't null!</div>";
        } 
        $sql1 = "SELECT * FROM users WHERE userID != '$id' AND (username = '$username' OR email = '$email')";
        $res1 = mysqli_query($conn, $sql1); 
        $count1 = mysqli_num_rows($res1);
        if($count1 > 0) {
            $check = false;
            //Create a Session Variable to Display Message
            $_SESSION['exsit'] = "<div class='error'>Failed to Update User. Username or Email already exsits!</div>";
        }
        
        if($check) {
            //SQL Query
            $sql = "UPDATE users SET 
                    fullname = '$fullname', 
                    username = '$username', 
                    email = '$email', 
                    password = '$password', 
                    phone = '$phone', 
                    address = '$address'
                    WHERE userID = '$id'
                    ";
            //Executing Query
            $res = mysqli_query($conn, $sql); 
            //Check whether (Query is Executed) and display appropriate message
            if($res == TRUE) {
                //Create a Session Variable to Display Message
                $_SESSION['add'] = "<div class='success'>User Added Successfully!</div>";
            } 
        } 

        //Redirect Page to Manage User
        header("location:".SITEURL.'admin/manage-user.php');
    }
?>
