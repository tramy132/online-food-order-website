<?php include('parts/menu.php')?>
        <!--Main Content Section Starts-->
        <div class = "maincontent">
            <div class = "wrapper"> 
                <h1>Add Admin</h1>
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
                                <input type="text" name="username" placeholder="Your Username">
                            </td>
                        </tr>

                        <tr>
                            <td>Password: </td>
                            <td>
                                <input type="password" name="password" placeholder="Your Password">
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
        $password = $_POST['password'];

        //Check some things
        $check = true;
        if($fullname == '' || $username == '' || $password =='') {
            $check = false;
            //Create a Session Variable to Display Message
            $_SESSION['null'] = "<div class='error'>Failed to Add Admin. Data is mustn't null!</div>";
        } 
        $sql1 = "SELECT * FROM admins WHERE username = '$username'";
        $res1 = mysqli_query($conn, $sql1); 
        $count1 = mysqli_num_rows($res1);
        if($count1 > 0) {
            $check = false;
            //Create a Session Variable to Display Message
            $_SESSION['exsit'] = "<div class='error'>Failed to Add Admin. Username already exsits!</div>";
        }
        
        if($check) {
            //SQL Query
            $sql = "INSERT INTO admins (fullname, username, password) 
                    VALUES ('$fullname', '$username', '$password')";
            //Executing Query
            $res = mysqli_query($conn, $sql); 
            //Check whether (Query is Executed) and display appropriate message
            if($res == TRUE) {
                //Create a Session Variable to Display Message
                $_SESSION['add'] = "<div class='success'>Admin Added Successfully!</div>";;
            } 
        } 

        //Redirect Page to Manage Admin
        header("location:".SITEURL.'admin/manage-admin.php');
    }
?>
