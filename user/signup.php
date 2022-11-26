<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Online Food Order System</title>
        <link rel="stylesheet" href="../css/user.css">
    </head>
    <body>
        
        <div class="login">
            <h1 class="textcenter">Sign Up</h1>

            <?php 
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
            <br><br>

            <!-- Sign up Form Starts Here -->
            <form action="" method="POST">
                    <table>
                        Full Name: <br>
                        <input type="text" name="fullname" placeholder="Enter Full Name">
                        <br>
                        Username: <br>
                        <input type="text" name="username" placeholder="Enter Your Username">
                        <br>
                        Email: <br>
                        <input type="email" name="email" placeholder="Enter Your Email">
                        <br>
                        Password: <br>
                        <input type="password" name="password" placeholder="Enter Your Password">
                        <br>
                        Phone: <br>
                        <input type="text" name="phone" placeholder="Enter Your Phone">
                        <br>
                        Address: <br>
                        <input type="text" name="address" placeholder="Enter Your address">
                        <br>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Sign up" class="btn-secondary">
                        </td>
                    
                    </table>
                </form>
        
            <!-- Signup Form Ends Here -->
        </div>

    </body>
</html>

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
            //Create Message
            $_SESSION['null'] = "<div class='error'>Data is mustn't null!</div>";
            header("location:".SITEURL.'user/signup.php');
        } 
        $sql1 = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
        $res1 = mysqli_query($conn, $sql1); 
        $count1 = mysqli_num_rows($res1);
        if($count1 > 0) {
            $check = false;
            $_SESSION['exsit'] = "<div class='error'>Username or Email already exsits!</div>";
            header("location:".SITEURL.'user/signup.php');
        }
        
        if($check) {
            //SQL Query
            $sql = "INSERT INTO users (fullname, username, email, password, phone, address) 
                    VALUES ('$fullname', '$username', '$email','$password', '$phone', '$address')";
            //Executing Query
            $res = mysqli_query($conn, $sql); 
            if($res == TRUE) {
                //Create Message
                $_SESSION['sign-up'] = "<div class='success'>Sign up Successfully!</div>";
                //Redirect Page to login User
                 header("location:".SITEURL.'user/login-user.php');  
            } 
        } 
    }
?>