<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Online Food Order System</title>
        <link rel="stylesheet" href="../css/user.css">
    </head>
    <body>
        
        <div class="login">
            <h1 class="textcenter">Login</h1>
            <br><br>

            <?php 
                if(isset($_SESSION['sign-up']))
                {
                    echo $_SESSION['sign-up'];
                    unset($_SESSION['sign-up']);
                }

                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>
            <br><br>

            <!-- Login Form Starts Here -->
            <form action="" method="POST">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>

            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <a href="signup.php" class = "not-line">Sign up</a>
            <br><br>
            </form>
            <!-- Login Form Ends Here -->
        </div>

    </body>
</html>

<?php 

    if(isset($_POST['submit']))
    {
        //Process for Login
        //1. Get the Data from Login form
        $username = $_POST['username'];
        $password = $_POST['password'];

        //2. SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";

        //3. Execute the Query
        $res = mysqli_query($conn, $sql);

        //4. Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //User Available and Login Success
            $_SESSION['login'] = "<div class='success'>Login Successful!</div>";
            $row=mysqli_fetch_assoc($res);
            $userId = $row['userId'];
            $_SESSION['userId'] = $userId;
            //REdirect to Home Page/Dashboard
            header('location:'.SITEURL.'user/');
        }
        else
        {
            //User not Available and Login FAil
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            //REdirect to HOme Page/Dashboard
            header('location:'.SITEURL.'user/login-user.php');
        }
    }
?>