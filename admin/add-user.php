<?php include('parts/menu.php')?>
        <!--Main Content Section Starts-->
        <div class = "maincontent">
            <div class = "wrapper"> 
                <h1>Add User</h1>
                <br />
                <form action="" method="POST">
                    <table>
                        <tr>
                            <td>Full Name: </td>
                            <td>
                                <input type="text" name="fullname" placeholder="Enter Name">
                            </td>
                        </tr>

                        <tr>
                            <td>Username: </td>
                            <td>
                                <input type="text" name="username" placeholder="Enter Your Username">
                            </td>
                        </tr>

                        <tr>
                            <td>Email: </td>
                            <td>
                                <input type="email" name="email" placeholder="Enter Your Email">
                            </td>
                        </tr>

                        <tr>
                            <td>Password: </td>
                            <td>
                                <input type="password" name="password" placeholder="Enter Your Password">
                            </td>
                        </tr>

                        <tr>
                            <td>Phone: </td>
                            <td>
                                <input type="text" name="phone" placeholder="Enter Your Phone">
                            </td>
                        </tr>

                        <tr>
                            <td>Address: </td>
                            <td>
                                <input type="text" name="address" placeholder="Enter Your address">
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
            $_SESSION['null'] = "<div class='error'>Failed to Add User. Data is mustn't null!</div>";
        } 
        $sql1 = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
        $res1 = mysqli_query($conn, $sql1); 
        $count1 = mysqli_num_rows($res1);
        if($count1 > 0) {
            $check = false;
            //Create a Session Variable to Display Message
            $_SESSION['exsit'] = "<div class='error'>Failed to Add User. Username or Email already exsits!</div>";
        }
        
        if($check) {
            //SQL Query
            $sql = "INSERT INTO users (fullname, username, email, password, phone, address) 
                    VALUES ('$fullname', '$username', '$email','$password', '$phone', '$address')";
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
